<?php

namespace Wallo\FilamentCompanies\Http\Controllers;

use Filament\Notifications\Notification;
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
            return $this->handleError($request);
        }

        $providerAccount = null;

        try {
            $providerAccount = $resolver->resolve($provider);
        } catch (InvalidStateException $e) {
            $this->invalidStateHandler->handle($e);
        }

        if ($providerAccount === null) {
            return $this->handleError($request);
        }

        $account = Socialite::findConnectedAccountForProviderAndId($provider, $providerAccount->getId());

        if (($user = Auth::user()) !== null) {
            return $this->alreadyAuthenticated($user, $account, $provider, $providerAccount);
        }

        $previousUrl = session('filament-companies.previous_url');

        if ($this->shouldRegister($account, $previousUrl)) {
            return $this->handleRegistration($providerAccount, $provider);
        }

        if (!$account && !Socialite::hasCreateAccountOnFirstLoginFeatures()) {
            return $this->handleSignInNotFound($provider);
        }

        if (!$account && Socialite::hasCreateAccountOnFirstLoginFeatures()) {
            return $this->handleCreateAccountOnFirstLogin($providerAccount, $provider);
        }

        $user = $account->user;

        $this->updatesConnectedAccounts->update($user, $account, $provider, $providerAccount);

        $user->forceFill([
            'current_connected_account_id' => $account->id,
        ])->save();

        return $this->login($user);
    }

    protected function handleError(Request $request): RedirectResponse
    {
        $messageBag = new MessageBag;
        $messageBag->add('filament-companies', $request->error_description);

        return Auth::check()
            ? redirect(config('fortify.home'))->dangerBanner($request->error_description)
            : redirect()->route(
                FortifyFeatures::enabled(FortifyFeatures::registration()) ? 'register' : 'login'
            )->withErrors($messageBag);
    }

    protected function shouldRegister(ConnectedAccount|null $account, string $previousUrl): bool
    {
        return !$account && FortifyFeatures::enabled(FortifyFeatures::registration()) &&
            (
                $previousUrl === route('register') ||
                (Socialite::hasCreateAccountOnFirstLoginFeatures() && $previousUrl === route('login'))
            );
    }

    protected function handleRegistration(ProviderUser $providerAccount, string $provider): RedirectResponse|LoginResponse
    {
        $user = FilamentCompanies::newUserModel()->where('email', $providerAccount->getEmail())->first();

        $account = Socialite::findConnectedAccountForProviderAndId($provider, $providerAccount->getId());

        if ($user) {
            return $this->handleUserAlreadyRegistered($user, $account, $provider, $providerAccount);
        }

        return $this->register($provider, $providerAccount);
    }

    protected function handleSignInNotFound(string $provider): RedirectResponse
    {
        $messageBag = new MessageBag;
        $messageBag->add(
            'filament-companies',
            __('filament-companies::default.errors.provider_sign_in_not_found', compact('provider'))
        );

        return redirect()->route('login')->withErrors($messageBag);
    }

    protected function handleCreateAccountOnFirstLogin(ProviderUser $providerAccount, string $provider): RedirectResponse|LoginResponse
    {
        if (FilamentCompanies::newUserModel()->where('email', $providerAccount->getEmail())->exists()) {
            $messageBag = new MessageBag;
            $messageBag->add(
                'filament-companies',
                __('filament-companies::default.errors.provider_sign_in_already_connected', compact('provider'))
            );

            return redirect()->route('login')->withErrors($messageBag);
        }

        $user = $this->createsUser->create($provider, $providerAccount);

        return $this->login($user);
    }

    /**
     * Handle connection of accounts for an already authenticated user.
     */
    protected function alreadyAuthenticated(Authenticatable $user, ConnectedAccount|null $account, string $provider, ProviderUser $providerAccount): RedirectResponse
    {
        if ($account && $account->user_id !== $user->getAuthIdentifier()) {

            $title = __('filament-companies::default.notifications.provider_sign_in_belongs_to_another_user.title');
            $body = __('filament-companies::default.notifications.provider_sign_in_belongs_to_another_user.body', compact('provider'));
            $notification = Notification::make()->title($title)->danger()->body($body)->send();

            return redirect(Profile::getUrl())->with('notification.error.belongs_to_another_user', $notification);
        }

        if (! $account) {
            $this->createsConnectedAccounts->create($user, $provider, $providerAccount);

            $title = __('filament-companies::default.notifications.provider_sign_in_successfully_connected.title');
            $body = __('filament-companies::default.notifications.provider_sign_in_successfully_connected.body', compact('provider'));
            $notification = Notification::make()->title($title)->success()->body($body)->send();

            return redirect(Profile::getUrl())->with('notification.success.successfully_connected', $notification);
        }

        $title = __('filament-companies::default.notifications.provider_sign_in_already_associated_with_your_user.title');
        $body = __('filament-companies::default.notifications.provider_sign_in_already_associated_with_your_user.body', compact('provider'));
        $notification = Notification::make()->title($title)->danger()->body($body)->send();

        return redirect(Profile::getUrl())->with('notification.error.already_associated_with_your_user', $notification);
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
        $messageBag->add('filament-companies', __('filament-companies::default.errors.provider_sign_in_already_associated_with_account', compact('provider')));

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
                __('filament-companies::default.errors.no_email_associated_with_provider_account', compact('provider'))
            );

            return redirect()->route('register')->withErrors($messageBag);
        }

        if (FilamentCompanies::newUserModel()->where('email', $providerAccount->getEmail())->exists()) {
            $messageBag = new MessageBag;
            $messageBag->add(
                'filament-companies',
                __('filament-companies::default.errors.email_already_associated_with_another_account', compact('provider'))
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
