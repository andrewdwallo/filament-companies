<?php

namespace Wallo\FilamentCompanies;

use App\Models\ConnectedAccount;
use Closure;
use Filament\Facades\Filament;
use Wallo\FilamentCompanies\Contracts\CreatesConnectedAccounts;
use Wallo\FilamentCompanies\Contracts\CreatesUserFromProvider;
use Wallo\FilamentCompanies\Contracts\GeneratesProviderRedirect;
use Wallo\FilamentCompanies\Contracts\HandlesInvalidState;
use Wallo\FilamentCompanies\Contracts\ResolvesSocialiteUsers;
use Wallo\FilamentCompanies\Contracts\SetsUserPasswords;
use Wallo\FilamentCompanies\Contracts\UpdatesConnectedAccounts;
use Wallo\FilamentCompanies\Http\Livewire\ConnectedAccountsForm;
use Wallo\FilamentCompanies\Http\Livewire\SetPasswordForm;

class Socialite
{
    /**
     * The user model that should be used by FilamentCompanies.
     */
    public static string $connectedAccountModel = ConnectedAccount::class;

    /**
     * Determine if the application is using any socialite features.
     */
    public static bool $hasSocialiteFeatures = false;

    /**
     * The socialite providers that should be used by Company.
     */
    public static array $supportedSocialiteProviders = [
        'github' => false,
        'gitlab' => false,
        'google' => false,
        'facebook' => false,
        'linkedin' => false,
        'bitbucket' => false,
        'twitter' => false,
        'twitter-oauth-2' => false,
    ];

    /**
     * The socialite features that should be used by Company.
     */
    public static array $supportedSocialiteFeatures = [
        'remember-session' => false,
        'refresh-oauth-tokens' => false,
        'provider-avatars' => false,
        'generate-missing-emails' => false,
        'login-on-registration' => false,
        'create-account-on-first-login' => false,
    ];

    /**
     * Determine if the application can set a user's password.
     */
    public static bool $canSetPasswords = false;

    /**
     * Determine if the application can manage connected accounts.
     */
    public static bool $canManageConnectedAccounts = false;

    /**
     * The component that should be used when displaying the "Set Password" form.
     */
    public static string $setPasswordForm = SetPasswordForm::class;

    /**
     * The component that should be used when displaying the "Connected Accounts" form.
     */
    public static string $connectedAccountsForm = ConnectedAccountsForm::class;

    /**
     * The sort order of the components.
     */
    public static array $componentSortOrder = [];

    public function enableSocialite(bool|Closure|null $condition = true): static
    {
        static::$hasSocialiteFeatures = $condition instanceof Closure ? $condition() : $condition;

        return $this;
    }

    public function setProviders(array $providers = null): static
    {
        if (is_array($providers) && static::$hasSocialiteFeatures) {
            foreach ($providers as $provider) {
                if (array_key_exists($provider, static::$supportedSocialiteProviders)) {
                    static::$supportedSocialiteProviders[$provider] = true;
                }
            }
        }

        return $this;
    }

    public function setFeatures(array $features = null): static
    {
        if (is_array($features) && static::$hasSocialiteFeatures) {
            foreach ($features as $feature) {
                if (array_key_exists($feature, static::$supportedSocialiteFeatures)) {
                    static::$supportedSocialiteFeatures[$feature] = true;
                }
            }
        }

        return $this;
    }

    /**
     * Determine if the application supports setting user passwords.
     */
    public function setPasswords(bool|Closure|null $condition = true, $component = SetPasswordForm::class, int $sort = 2): static
    {
        static::$canSetPasswords = $condition instanceof Closure ? $condition() : $condition;
        static::$setPasswordForm = $component;
        static::$componentSortOrder[$component] = $sort;

        return $this;
    }

    /**
     * Determine if the application supports managing connected accounts.
     */
    public function connectedAccounts(bool|Closure|null $condition = true, $component = ConnectedAccountsForm::class, int $sort = 3): static
    {
        static::$canManageConnectedAccounts = $condition instanceof Closure ? $condition() : $condition;
        static::$connectedAccountsForm = $component;
        static::$componentSortOrder[$component] = $sort;

        return $this;
    }

    /**
     * Determine if the application has support for socialite.
     */
    public static function hasSocialiteFeatures(): bool
    {
        return static::$hasSocialiteFeatures;
    }

    /**
     * Determine if the application has support for Remembering Sessions.
     */
    public static function hasRememberSessionFeature(): bool
    {
        return static::$supportedSocialiteFeatures['remember-session'];
    }

    /**
     * Determine if the application has support for Refreshing OAuth Tokens.
     */
    public static function hasRefreshOAuthTokensFeature(): bool
    {
        return static::$supportedSocialiteFeatures['refresh-oauth-tokens'];
    }

    /**
     * Determine if the application has support for Provider Avatars.
     */
    public static function hasProviderAvatarsFeature(): bool
    {
        return static::$supportedSocialiteFeatures['provider-avatars'];
    }

    /**
     * Determine if the application has support for Generating Missing Emails.
     */
    public static function generatesMissingEmails(): bool
    {
        return static::$supportedSocialiteFeatures['generate-missing-emails'];
    }

    /**
     * Determine if the application has support for Logging in on Registration.
     */
    public static function hasLoginOnRegistrationFeature(): bool
    {
        return static::$supportedSocialiteFeatures['login-on-registration'];
    }

    /**
     * Determine if the application has support for Creating Accounts on First Login.
     */
    public static function hasCreateAccountOnFirstLoginFeature(): bool
    {
        return static::$supportedSocialiteFeatures['create-account-on-first-login'];
    }

    /**
     * Determine if the application can set user passwords.
     */
    public static function canSetPasswords(): bool
    {
        $hasSocialiteFeatures = static::hasSocialiteFeatures();
        $canSetPasswords = static::$canSetPasswords;

        return $hasSocialiteFeatures && $canSetPasswords;
    }

    /**
     * Determine if the application can manage connected accounts.
     */
    public static function canManageConnectedAccounts(): bool
    {
        $hasSocialiteFeatures = static::hasSocialiteFeatures();
        $canManageConnectedAccounts = static::$canManageConnectedAccounts;

        return $hasSocialiteFeatures && $canManageConnectedAccounts;
    }

    /**
     * Enabled the generate missing emails feature.
     */
    public static function generateMissingEmails(): string
    {
        return 'generate-missing-emails';
    }

    /**
     * Enable the create account on first login feature.
     */
    public static function createAccountOnFirstLogin(): string
    {
        return 'create-account-on-first-login';
    }

    /**
     * Enable the login on registration feature.
     */
    public static function loginOnRegistration(): string
    {
        return 'login-on-registration';
    }

    /**
     * Enable the provider avatars feature.
     */
    public static function providerAvatars(): string
    {
        return 'provider-avatars';
    }

    /**
     * Enable the remember session feature for logging in.
     */
    public static function rememberSession(): string
    {
        return 'remember-session';
    }

    /**
     * Enable the automatic refresh token update on token retrieval.
     */
    public static function refreshOauthTokens(): string
    {
        return 'refresh-oauth-tokens';
    }

    /**
     * Get all the socialite providers and whether the application supports them.
     */
    public static function providers(): array
    {
        return array_keys(array_filter(static::$supportedSocialiteProviders));
    }

    /**
     * Find a connected account instance for a given provider and provider ID.
     */
    public static function findConnectedAccountForProviderAndId(string $provider, string $providerId): mixed
    {
        return static::newConnectedAccountModel()
            ->where('provider', $provider)
            ->where('provider_id', $providerId)
            ->first();
    }

    /**
     * Get the name of the connected account model used by the application.
     */
    public static function connectedAccountModel(): string
    {
        return static::$connectedAccountModel;
    }

    /**
     * Get a new instance of the connected account model.
     */
    public static function newConnectedAccountModel(): mixed
    {
        $model = static::connectedAccountModel();

        return new $model;
    }

    /**
     * Specify the connected account model that should be used by FilamentCompanies.
     */
    public static function useConnectedAccountModel(string $model): static
    {
        static::$connectedAccountModel = $model;

        return new static;
    }

    /**
     * Get the component that should be used when displaying the "Set Password" form.
     */
    public static function getSetPasswordForm(): string
    {
        return static::$setPasswordForm;
    }

    /**
     * Get the component that should be used when displaying the "Connected Accounts" form.
     */
    public static function getConnectedAccountsForm(): string
    {
        return static::$connectedAccountsForm;
    }

    /**
     * Get the socialite specific components that should be used.
     */
    public static function getComponents(): array
    {
        $components = [];
        $user = Filament::auth()->user();
        $passwordIsNull = $user?->getAuthPassword() === null;

        if ($passwordIsNull && static::canSetPasswords()) {
            $components[] = static::getSetPasswordForm();
        }

        if (static::canManageConnectedAccounts()) {
            $components[] = static::getConnectedAccountsForm();
        }

        uasort($components, static function ($a, $b) {
            return static::$componentSortOrder[$a] <=> static::$componentSortOrder[$b];
        });

        return $components;
    }

    /**
     * Register a class / callback that should be used to resolve the user for a Socialite Provider.
     */
    public static function resolvesSocialiteUsersUsing(string $class): void
    {
        app()->singleton(ResolvesSocialiteUsers::class, $class);
    }

    /**
     * Register a class / callback that should be used to create users from social providers.
     */
    public static function createUsersFromProviderUsing(string $class): void
    {
        app()->singleton(CreatesUserFromProvider::class, $class);
    }

    /**
     * Register a class / callback that should be used to create connected accounts.
     */
    public static function createConnectedAccountsUsing(string $class): void
    {
        app()->singleton(CreatesConnectedAccounts::class, $class);
    }

    /**
     * Register a class / callback that should be used to update connected accounts.
     */
    public static function updateConnectedAccountsUsing(string $class): void
    {
        app()->singleton(UpdatesConnectedAccounts::class, $class);
    }

    /**
     * Register a class / callback that should be used to set user passwords.
     */
    public static function setUserPasswordsUsing(callable|string $callback): void
    {
        app()->singleton(SetsUserPasswords::class, $callback);
    }

    /**
     * Register a class / callback that should be used to set user passwords.
     */
    public static function handlesInvalidStateUsing(callable|string $callback): void
    {
        app()->singleton(HandlesInvalidState::class, $callback);
    }

    /**
     * Register a class / callback that should be used for generating provider redirects.
     */
    public static function generatesProvidersRedirectsUsing(callable|string $callback): void
    {
        app()->singleton(GeneratesProviderRedirect::class, $callback);
    }

    public static function getPanelId(): string
    {
        return Filament::getCurrentPanel()?->getId();
    }
}
