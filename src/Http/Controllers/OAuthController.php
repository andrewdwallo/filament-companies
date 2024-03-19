<?php

namespace Wallo\FilamentCompanies\Http\Controllers;

use Filament\Facades\Filament;
use Filament\Http\Responses\Auth\LoginResponse;
use Filament\Notifications\Notification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
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
use Wallo\FilamentCompanies\Enums\Feature;
use Wallo\FilamentCompanies\FilamentCompanies;
use Wallo\FilamentCompanies\Pages\User\Profile;

class OAuthController extends Controller
{
    protected StatefulGuard $guard;

    protected ?string $registrationUrl;

    protected ?string $loginUrl;

    protected string $userPanel;

    /**
     * Create a new controller instance.
     */
    public function __construct(
        protected CreatesUserFromProvider $createsUser,
        protected CreatesConnectedAccounts $createsConnectedAccounts,
        protected UpdatesConnectedAccounts $updatesConnectedAccounts,
        protected HandlesInvalidState $invalidStateHandler
    ) {
        $this->guard = Filament::auth();
        $this->registrationUrl = Filament::getRegistrationUrl();
        $this->loginUrl = Filament::getLoginUrl();
        $this->userPanel = FilamentCompanies::getUserPanel();
    }

    /**
     * Get the redirect for the given Socialite provider.
     */
    public function redirectToProvider(string $provider, GeneratesProviderRedirect $generator): SymfonyRedirectResponse
    {
        session()->put('filament-companies.previous_url', url()->previous());

        return $generator->generate($provider);
    }

    /**
     * Attempt to log the user in via the provider user returned from Socialite.
     */
    public function handleProviderCallback(Request $request, string $provider, ResolvesSocialiteUsers $resolver): RedirectResponse | LoginResponse
    {
        if ($request->has('error')) {
            return $this->handleError($request);
        }

        try {
            $providerAccount = $resolver->resolve($provider);
        } catch (InvalidStateException $e) {
            $this->invalidStateHandler->handle($e);

            return $this->handleError($request);
        }

        $account = FilamentCompanies::findConnectedAccountForProviderAndId($provider, $providerAccount->getId());
        $user = $this->guard->user();

        return $this->handleNewOrReturningUser($providerAccount, $provider, $account, $user);
    }

    protected function handleNewOrReturningUser(ProviderUser $providerAccount, string $provider, ?ConnectedAccount $account, ?Authenticatable $user)
    {
        $previousUrl = session('filament-companies.previous_url');

        if ($user) {
            return $this->alreadyAuthenticated($user, $account, $provider, $providerAccount);
        }

        if ($this->shouldRegister($account, $previousUrl)) {
            return $this->handleRegistration($providerAccount, $provider);
        }

        return $this->handleAccountDecision($account, $providerAccount, $provider);
    }

    /**
     * Handle the decision for the account.
     */
    protected function handleAccountDecision(?ConnectedAccount $account, ProviderUser $providerAccount, string $provider): RedirectResponse | LoginResponse
    {
        if ($account === null) {
            return $this->handleAccountAbsence($providerAccount, $provider);
        }

        return $this->handleAccountPresent($account, $provider, $providerAccount);
    }

    protected function handleAccountAbsence(ProviderUser $providerAccount, string $provider): RedirectResponse | LoginResponse
    {
        if (Feature::CreateAccountOnFirstLogin->isEnabled()) {
            return $this->handleCreateAccountOnFirstLogin($providerAccount, $provider);
        }

        return $this->handleSignInNotFound($provider);
    }

    /**
     * Handle the account present in the database.
     */
    protected function handleAccountPresent(ConnectedAccount $connectedAccount, string $provider, ProviderUser $providerAccount): LoginResponse
    {
        $this->updatesConnectedAccounts->update($user = $connectedAccount->user, $connectedAccount, $provider, $providerAccount);

        $user->forceFill(['current_connected_account_id' => $connectedAccount->id])->save();

        return $this->login($user);
    }

    /**
     * Handle error and return appropriate response.
     */
    protected function handleError(Request $request): RedirectResponse
    {
        $error_description = $request->input('error_description');

        $targetUrl = $this->guard->check() ? filament()->getHomeUrl() : null;

        if ($targetUrl === null) {
            $targetUrl = $this->registrationUrl ?: $this->loginUrl;
        }

        return $this->redirectToWithError($error_description, $targetUrl);
    }

    /**
     * Determine if the user should be registered.
     */
    protected function shouldRegister(?ConnectedAccount $account, string $previousUrl): bool
    {
        if ($account !== null) {
            return false;
        }

        $isOnRegistrationPage = $previousUrl === url($this->registrationUrl);
        $isOnLoginPageWithFirstLoginFeature = Feature::CreateAccountOnFirstLogin->isEnabled() && $previousUrl === url($this->loginUrl);

        return $isOnRegistrationPage || $isOnLoginPageWithFirstLoginFeature;
    }

    /**
     * Handle the registration process for the user.
     */
    protected function handleRegistration(ProviderUser $providerAccount, string $provider): RedirectResponse | LoginResponse
    {
        $user = FilamentCompanies::newUserModel()->where('email', $providerAccount->getEmail())->first();

        $account = FilamentCompanies::findConnectedAccountForProviderAndId($provider, $providerAccount->getId());

        if ($user) {
            return $this->handleUserAlreadyRegistered($user, $account, $provider, $providerAccount);
        }

        return $this->register($provider, $providerAccount);
    }

    /**
     * Handle the case where the sign-in was not found.
     */
    protected function handleSignInNotFound(string $provider): RedirectResponse
    {
        return $this->redirectToWithError(
            __('filament-companies::default.errors.signin_not_found', compact('provider')),
            $this->loginUrl,
        );
    }

    /**
     * Handle account creation on first login.
     */
    protected function handleCreateAccountOnFirstLogin(ProviderUser $providerAccount, string $provider): RedirectResponse | LoginResponse
    {
        if (FilamentCompanies::newUserModel()->where('email', $providerAccount->getEmail())->exists()) {
            return $this->redirectToWithError(__('filament-companies::default.errors.already_connected', compact('provider')), $this->loginUrl);
        }

        $user = $this->createsUser->create($provider, $providerAccount);

        return $this->login($user);
    }

    /**
     * Handle connection of accounts for an already authenticated user.
     */
    protected function alreadyAuthenticated(Authenticatable $user, ?ConnectedAccount $account, string $provider, ProviderUser $providerAccount): RedirectResponse
    {
        $profileRoute = route(Profile::getRouteName(panel: $this->userPanel));

        if ($account && $account->user_id !== $user->getAuthIdentifier()) {
            return $this->redirectToProfileWithNotification('belongs_to_other_user', 'danger', compact('provider'), $profileRoute);
        }

        if ($account === null) {
            $this->createsConnectedAccounts->create($user, $provider, $providerAccount);

            return $this->redirectToProfileWithNotification('successfully_connected', 'success', compact('provider'), $profileRoute);
        }

        return $this->redirectToProfileWithNotification('already_associated', 'danger', compact('provider'), $profileRoute);
    }

    protected function redirectToProfileWithNotification(string $translationKey, string $notificationType, array $translationParameters, string $redirectTo): RedirectResponse
    {
        $title = __("filament-companies::default.notifications.{$translationKey}.title");
        $body = __("filament-companies::default.notifications.{$translationKey}.body", $translationParameters);
        $notification = Notification::make()->title($title)->{$notificationType}()->body(Str::inlineMarkdown($body))->send();

        return redirect($redirectTo)->with("notification.{$notificationType}.{$translationKey}", $notification);
    }

    /**
     * Handle when a user is already registered.
     */
    protected function handleUserAlreadyRegistered(Authenticatable $user, ?ConnectedAccount $account, string $provider, ProviderUser $providerAccount): RedirectResponse | LoginResponse
    {
        if (Feature::LoginOnRegistration->isEnabled()) {
            if ($account === null) {
                $this->createsConnectedAccounts->create($user, $provider, $providerAccount);
            }

            return $this->login($user);
        }

        return $this->redirectToWithError(
            __('filament-companies::default.errors.already_associated_account', compact('provider')),
            $this->registrationUrl,
        );
    }

    /**
     * Handle the registration of a new user.
     */
    protected function register(string $provider, ProviderUser $providerAccount): RedirectResponse | LoginResponse
    {
        $email = $providerAccount->getEmail();

        if ($email === null) {
            return $this->redirectToWithError(__('filament-companies::default.errors.no_email_with_account', compact('provider')), $this->registrationUrl);
        }

        if (FilamentCompanies::newUserModel()->where('email', $email)->exists()) {
            return $this->redirectToWithError(__('filament-companies::default.errors.email_already_associated', compact('provider')), $this->registrationUrl);
        }

        $user = $this->createsUser->create($provider, $providerAccount);

        return $this->login($user);
    }

    protected function redirectToWithError(string $message, string $url): RedirectResponse
    {
        return redirect($url)->withErrors(['filament-companies' => $message]);
    }

    /**
     * Authenticate the given user and return a login response.
     */
    protected function login(Authenticatable $user): LoginResponse
    {
        event(new Registered($user));

        $this->guard->login($user, Feature::RememberSession->isEnabled());

        session()->regenerate();

        return app(LoginResponse::class);
    }
}
