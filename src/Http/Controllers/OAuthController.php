<?php

namespace Wallo\FilamentCompanies\Http\Controllers;

use Filament\Exceptions\NoDefaultPanelSetException;
use Filament\Facades\Filament;
use Filament\Notifications\Notification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Str;
use Filament\Http\Responses\Auth\LoginResponse;
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
    protected string $registrationUrl;
    protected string $loginUrl;

    protected string $userPanel;

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
        $this->registrationUrl = Filament::getRegistrationUrl();
        $this->loginUrl = Filament::getLoginUrl();
        $this->userPanel = FilamentCompanies::getUserPanel();
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
     * @throws NoDefaultPanelSetException
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

        if (!$account && !Socialite::hasCreateAccountOnFirstLoginFeature()) {
            return $this->handleSignInNotFound($provider);
        }

        if (!$account && Socialite::hasCreateAccountOnFirstLoginFeature()) {
            return $this->handleCreateAccountOnFirstLogin($providerAccount, $provider);
        }

        $user = $account->user;

        $this->updatesConnectedAccounts->update($user, $account, $provider, $providerAccount);

        $user->forceFill([
            'current_connected_account_id' => $account->id,
        ])->save();

        return $this->login($user);
    }

    /**
     * @throws NoDefaultPanelSetException
     */
    protected function handleError(Request $request): RedirectResponse
    {
        $messageBag = new MessageBag;
        $messageBag->add('filament-companies', $request->error_description);

        if (Auth::check()) {
            return redirect(filament()->getHomeUrl())->withErrors($request->error_description);
        }

        $route = $this->registrationUrl ?: $this->loginUrl;

        return redirect(url($route))->withErrors($messageBag);
    }

    protected function shouldRegister(ConnectedAccount|null $account, string $previousUrl): bool
    {
        return !$account && $this->registrationUrl &&
            (
                $previousUrl === url($this->registrationUrl) ||
                (Socialite::hasCreateAccountOnFirstLoginFeature() && $previousUrl === url($this->loginUrl))
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
            __('filament-companies::default.errors.signin_not_found', compact('provider'))
        );

        return redirect(url($this->loginUrl))->withErrors($messageBag);
    }

    protected function handleCreateAccountOnFirstLogin(ProviderUser $providerAccount, string $provider): RedirectResponse|LoginResponse
    {
        if (FilamentCompanies::newUserModel()->where('email', $providerAccount->getEmail())->exists()) {
            $messageBag = new MessageBag;
            $messageBag->add(
                'filament-companies',
                __('filament-companies::default.errors.already_connected', compact('provider'))
            );

            return redirect(url($this->loginUrl))->withErrors($messageBag);
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

            $title = __('filament-companies::default.notifications.belongs_to_other_user.title');
            $body = __('filament-companies::default.notifications.belongs_to_other_user.body', compact('provider'));
            $notification = Notification::make()->title($title)->danger()->body(Str::inlineMarkdown($body))->send();

            return redirect(route(Profile::getRouteName(panel: $this->userPanel)))->with('notification.error.belongs_to_other_user', $notification);
        }

        if (! $account) {
            $this->createsConnectedAccounts->create($user, $provider, $providerAccount);

            $title = __('filament-companies::default.notifications.successfully_connected.title');
            $body = __('filament-companies::default.notifications.successfully_connected.body', compact('provider'));
            $notification = Notification::make()->title($title)->success()->body(Str::inlineMarkdown($body))->send();

            return redirect(route(Profile::getRouteName(panel: $this->userPanel)))->with('notification.success.successfully_connected', $notification);
        }

        $title = __('filament-companies::default.notifications.already_associated.title');
        $body = __('filament-companies::default.notifications.already_associated.body', compact('provider'));
        $notification = Notification::make()->title($title)->danger()->body(Str::inlineMarkdown($body))->send();

        return redirect(route(Profile::getRouteName(panel: $this->userPanel)))->with('notification.error.already_associated', $notification);
    }

    /**
     * Handle when a user is already registered.
     */
    protected function handleUserAlreadyRegistered(Authenticatable $user, ?ConnectedAccount $account, string $provider, ProviderUser $providerAccount): RedirectResponse|LoginResponse
    {
        if (Socialite::hasLoginOnRegistrationFeature()) {
            // The user exists, but they're not registered with the given provider.
            if (! $account) {
                $this->createsConnectedAccounts->create($user, $provider, $providerAccount);
            }

            return $this->login($user);
        }

        $messageBag = new MessageBag;
        $messageBag->add('filament-companies', __('filament-companies::default.errors.already_associated_account', compact('provider')));

        return redirect(url($this->registrationUrl))->withErrors($messageBag);
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
                __('filament-companies::default.errors.no_email_with_account', compact('provider'))
            );

            return redirect(url($this->registrationUrl))->withErrors($messageBag);
        }

        if (FilamentCompanies::newUserModel()->where('email', $providerAccount->getEmail())->exists()) {
            $messageBag = new MessageBag;
            $messageBag->add(
                'filament-companies',
                __('filament-companies::default.errors.email_already_associated', compact('provider'))
            );

            return redirect(url($this->registrationUrl))->withErrors($messageBag);
        }

        $user = $this->createsUser->create($provider, $providerAccount);

        return $this->login($user);
    }

    /**
     * Authenticate the given user and return a login response.
     */
    protected function login(Authenticatable $user): LoginResponse
    {
        event(new Registered($user));

        Filament::auth()->login($user, Socialite::hasRememberSessionFeature());

        session()->regenerate();

        return app(LoginResponse::class);
    }
}
