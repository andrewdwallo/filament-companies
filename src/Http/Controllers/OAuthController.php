<?php

namespace Wallo\FilamentCompanies\Http\Controllers;

use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;
use Wallo\FilamentCompanies\Contracts\CreatesConnectedAccounts;
use Wallo\FilamentCompanies\Contracts\CreatesUserFromProvider;
use Wallo\FilamentCompanies\Contracts\GeneratesProviderRedirect;
use Wallo\FilamentCompanies\Contracts\HandlesInvalidState;
use Wallo\FilamentCompanies\Contracts\ResolvesSocialiteUsers;
use Wallo\FilamentCompanies\Contracts\UpdatesConnectedAccounts;
use Wallo\FilamentCompanies\Features;
use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Features as FortifyFeatures;
use Wallo\FilamentCompanies\FilamentCompanies;
use Laravel\Socialite\Two\InvalidStateException;
use Wallo\FilamentCompanies\Pages\User\Profile;
use Wallo\FilamentCompanies\Socialite;

class OAuthController extends Controller
{
    /**
     * The guard implementation.
     *
     * @var \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected $guard;

    /**
     * The creates user implementation.
     *
     * @var \Wallo\FilamentCompanies\Contracts\CreatesUserFromProvider;
     */
    protected $createsUser;

    /**
     * The creates connected accounts implementation.
     *
     * @var \Wallo\FilamentCompanies\Contracts\CreatesConnectedAccounts;
     */
    protected $createsConnectedAccounts;

    /**
     * The updates connected accounts implementation.
     *
     * @var \Wallo\FilamentCompanies\Contracts\UpdatesConnectedAccounts;
     */
    protected $updatesConnectedAccounts;

    /**
     * The handler for Socialite's InvalidStateException.
     *
     * @var \Wallo\FilamentCompanies\Contracts\CreatesConnectedAccounts;
     */
    protected $invalidStateHandler;

    /**
     * Create a new controller instance.
     *
     * @param  \Illuminate\Contracts\Auth\StatefulGuard  $guard
     * @return void
     */
    public function __construct(
        StatefulGuard $guard,
        CreatesUserFromProvider $createsUser,
        CreatesConnectedAccounts $createsConnectedAccounts,
        UpdatesConnectedAccounts $updatesConnectedAccounts,
        HandlesInvalidState $invalidStateHandler
    ) {
        $this->guard = $guard;
        $this->createsUser = $createsUser;
        $this->createsConnectedAccounts = $createsConnectedAccounts;
        $this->updatesConnectedAccounts = $updatesConnectedAccounts;
        $this->invalidStateHandler = $invalidStateHandler;
    }

    /**
     * Get the redirect for the given Socialite provider.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $provider
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToProvider(Request $request, string $provider, GeneratesProviderRedirect $generator)
    {
        session()->put('filament-companies.previous_url', back()->getTargetUrl());

        return $generator->generate($provider);
    }

    /**
     * Attempt to log the user in via the provider user returned from Socialite.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $provider
     * @return mixed
     */
    public function handleProviderCallback(Request $request, string $provider, ResolvesSocialiteUsers $resolver)
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
            FortifyFeatures::enabled(FortifyFeatures::registration()) && ! $account &&
            (
                $previousUrl === route('register') ||
                (Features::hasCreateAccountOnFirstLoginFeatures() && $previousUrl === route('login'))
            )
        ) {
            $user = FilamentCompanies::newUserModel()->where('email', $providerAccount->getEmail())->first();

            if ($user) {
                return $this->handleUserAlreadyRegistered($user, $account, $provider, $providerAccount);
            }

            return $this->register($account, $provider, $providerAccount);
        }

        if (! Features::hasCreateAccountOnFirstLoginFeatures() && ! $account) {
            $messageBag = new MessageBag;
            $messageBag->add(
                'filament-companies',
                __('An account with this :Provider sign in was not found. Please register or try a different sign in method.', ['provider' => $provider])
            );

            return redirect()->route('login')->withErrors(
                $messageBag
            );
        }

        if (Features::hasCreateAccountOnFirstLoginFeatures() && ! $account) {
            if (FilamentCompanies::newUserModel()->where('email', $providerAccount->getEmail())->exists()) {
                $messageBag = new MessageBag;
                $messageBag->add(
                    'filament-companies',
                    __('An account with that email address already exists. Please login to connect your :Provider account.', ['provider' => $provider])
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
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  \Wallo\FilamentCompanies\ConnectedAccount  $account
     * @param  string  $provider
     * @param  \Laravel\Socialite\AbstractUser  $providerAccount
     * @return mixed
     */
    protected function alreadyAuthenticated($user, $account, $provider, $providerAccount)
    {
        if ($account && $account->user_id !== $user->id) {
            return redirect()->to(Profile::getUrl())->dangerBanner(
                __('This :Provider sign in account is already associated with another user. Please try a different account.', ['provider' => $provider]),
            );
        }

        if (! $account) {
            $this->createsConnectedAccounts->create($user, $provider, $providerAccount);

            return redirect()->to(Profile::getUrl())->banner(
                __('You have successfully connected :Provider to your account.', ['provider' => $provider])
            );
        }

        return redirect()->to(Profile::getUrl())->dangerBanner(
            __('This :Provider sign in account is already associated with your user.', ['provider' => $provider]),
        );
    }

    /**
     * Handle when a user is already registered.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  \Wallo\FilamentCompanies\ConnectedAccount  $account
     * @param  string  $provider
     * @param  \Laravel\Socialite\AbstractUser  $providerAccount
     * @return mixed
     */
    protected function handleUserAlreadyRegistered($user, $account, $provider, $providerAccount)
    {
        if (Features::hasLoginOnRegistrationFeatures()) {

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
     *
     * @param  \Wallo\FilamentCompanies\ConnectedAccount  $account
     * @param  string  $provider
     * @param  \Laravel\Socialite\AbstractUser  $providerAccount
     * @return mixed
     */
    protected function register($account, $provider, $providerAccount)
    {
        if (! $providerAccount->getEmail()) {
            $messageBag = new MessageBag;
            $messageBag->add(
                'filament-companies',
                __('No email address is associated with this :Provider account. Please try a different account.', ['provider' => $provider])
            );

            return redirect()->route('register')->withErrors($messageBag);
        }

        if (FilamentCompanies::newUserModel()->where('email', $providerAccount->getEmail())->exists()) {
            $messageBag = new MessageBag;
            $messageBag->add(
                'filament-companies',
                __('An account with that email address already exists. Please login to connect your :Provider account.', ['provider' => $provider])
            );

            return redirect()->route('register')->withErrors($messageBag);
        }

        $user = $this->createsUser->create($provider, $providerAccount);

        return $this->login($user);
    }

    /**
     * Authenticate the given user and return a login response.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable|mixed  $user
     * @return mixed
     */
    protected function login($user)
    {
        $this->guard->login($user, Socialite::hasRememberSessionFeatures());

        return app(LoginResponse::class);
    }
}
