<?php

namespace Wallo\FilamentCompanies\Http\Controllers;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;
use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Features as FortifyFeatures;
use Laravel\Socialite\Contracts\User as ProviderUser;
use Laravel\Socialite\Two\InvalidStateException;
use Symfony\Component\HttpFoundation\RedirectResponse as SymfonyRedirectResponse;
use Wallo\FilamentCompanies\ConnectedAccount;
use Wallo\FilamentCompanies\Contracts\CreatesConnectedAccounts;
use Wallo\FilamentCompanies\Contracts\CreatesUserFromProvider;
use Wallo\FilamentCompanies\Contracts\GeneratesProviderRedirect;
use Wallo\FilamentCompanies\Contracts\HandlesInvalidState;
use Wallo\FilamentCompanies\Contracts\ResolvesSocialiteUsers;
use Wallo\FilamentCompanies\Contracts\UpdatesConnectedAccounts;
use Wallo\FilamentCompanies\FilamentCompanies;
use Wallo\FilamentCompanies\Pages\User\Profile;
use Wallo\FilamentCompanies\Socialite;

class OAuthController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        protected StatefulGuard $guard,
        protected CreatesUserFromProvider $createsUser,
        protected CreatesConnectedAccounts $createsConnectedAccounts,
        protected UpdatesConnectedAccounts $updatesConnectedAccounts,
        protected HandlesInvalidState $invalidStateHandler
    ) {
        //
    }

    /**
     * Get the redirect for the given Socialite provider.
     */
    public function redirectToProvider(string $provider, GeneratesProviderRedirect $generator): SymfonyRedirectResponse
    {
        session()->put('filament-companies.previous_url', back()->getTargetUrl());

        return $generator->generate($provider);
    }

    /**
     * Attempt to log the user in via the provider user returned from Socialite.
     */
    public function handleProviderCallback(Request $request, string $provider, ResolvesSocialiteUsers $resolver): Response|RedirectResponse|LoginResponse
    {
        if ($request->has('error')) {
            $messageBag = new MessageBag;
            $messageBag->add('filament-companies', $request->error_description);

            return Auth::check()
                ? redirect(config('fortify.home'))->dangerBanner($request->error_description)
                : redirect()->route(
                    FortifyFeatures::enabled(FortifyFeatures::registration()) ? 'register' : 'login'
                )->withErrors($messageBag);
        }

        try {
            $providerAccount = $resolver->resolve($provider);
        } catch (InvalidStateException $e) {
            $this->invalidStateHandler->handle($e);
        }

        $account = Socialite::findConnectedAccountForProviderAndId($provider, $providerAccount->getId());

        // Authenticated...
        if (! is_null($user = Auth::user())) {
            return $this->alreadyAuthenticated($user, $account, $provider, $providerAccount);
        }

        // Registration...
        $previousUrl = session()->get('filament-companies.previous_url');

        if (
            ! $account && FortifyFeatures::enabled(FortifyFeatures::registration()) &&
            (
                $previousUrl === route('register') ||
                (Socialite::hasCreateAccountOnFirstLoginFeatures() && $previousUrl === route('login'))
            )
        ) {
            $user = FilamentCompanies::newUserModel()->where('email', $providerAccount->getEmail())->first();

            if ($user) {
                return $this->handleUserAlreadyRegistered($user, $account, $provider, $providerAccount);
            }

            return $this->register($provider, $providerAccount);
        }

        if (! $account && ! Socialite::hasCreateAccountOnFirstLoginFeatures()) {
            $messageBag = new MessageBag;
            $messageBag->add(
                'filament-companies',
                __('filament-companies::default.errors.provider_sign_in_not_found', ['provider' => $provider])
            );

            return redirect()->route('login')->withErrors(
                $messageBag
            );
        }

        if (! $account && Socialite::hasCreateAccountOnFirstLoginFeatures()) {
            if (FilamentCompanies::newUserModel()->where('email', $providerAccount->getEmail())->exists()) {
                $messageBag = new MessageBag;
                $messageBag->add(
                    'filament-companies',
                    __('filament-companies::default.errors.provider_sign_in_already_connected', ['provider' => $provider])
                );

                return redirect()->route('login')->withErrors(
                    $messageBag
                );
            }

            $user = $this->createsUser->create($provider, $providerAccount);

            return $this->login($user);
        }

        $user = $account->user;

        $this->updatesConnectedAccounts->update($user, $account, $provider, $providerAccount);

        $user->forceFill([
            'current_connected_account_id' => $account->id,
        ])->save();

        return $this->login($user);
    }

    /**
     * Handle connection of accounts for an already authenticated user.
     */
    protected function alreadyAuthenticated(Authenticatable $user, ?ConnectedAccount $account, string $provider, ProviderUser $providerAccount): RedirectResponse
    {
        if ($account && $account->user_id !== $user->id) {
            return redirect(Profile::getUrl())->dangerBanner(
                __('filament-companies::default.errors.provider_sign_in_belongs_to_another_user', ['provider' => $provider]),
            );
        }

        if (! $account) {
            $this->createsConnectedAccounts->create($user, $provider, $providerAccount);

            return redirect(Profile::getUrl())->banner(
                __('filament-companies::default.errors.provider_sign_in_successfully_connected', ['provider' => $provider])
            );
        }

        return redirect(Profile::getUrl())->dangerBanner(
            __('provider_sign_in_already_associated_with_your_user', ['provider' => $provider]),
        );
    }

    /**
     * Handle when a user is already registered.
     */
    protected function handleUserAlreadyRegistered(Authenticatable $user, ?ConnectedAccount $account, string $provider, ProviderUser $providerAccount): RedirectResponse|LoginResponse
    {
        if (Socialite::hasLoginOnRegistrationFeatures()) {
            // The user exists, but they're not registered with the given provider.
            if (! $account) {
                $this->createsConnectedAccounts->create($user, $provider, $providerAccount);
            }

            return $this->login($user);
        }

        $messageBag = new MessageBag;
        $messageBag->add('filament-companies', __('An account with that :Provider sign in already exists, please login.', ['provider' => $provider]));

        return redirect()->route('register')->withErrors($messageBag);
    }

    /**
     * Handle the registration of a new user.
     */
    protected function register(string $provider, ProviderUser $providerAccount): RedirectResponse|LoginResponse
    {
        if (! $providerAccount->getEmail()) {
            $messageBag = new MessageBag;
            $messageBag->add(
                'filament-companies',
                __('filament-companies::default.errors.no_email_associated_with_provider_account', ['provider' => $provider])
            );

            return redirect()->route('register')->withErrors($messageBag);
        }

        if (FilamentCompanies::newUserModel()->where('email', $providerAccount->getEmail())->exists()) {
            $messageBag = new MessageBag;
            $messageBag->add(
                'filament-companies',
                __('filament-companies::default.errors.email_already_associated_with_another_account', ['provider' => $provider])
            );

            return redirect()->route('register')->withErrors($messageBag);
        }

        $user = $this->createsUser->create($provider, $providerAccount);

        return $this->login($user);
    }

    /**
     * Authenticate the given user and return a login response.
     */
    protected function login(Authenticatable $user): LoginResponse
    {
        $this->guard->login($user, Socialite::hasRememberSessionFeatures());

        return app(LoginResponse::class);
    }
}
