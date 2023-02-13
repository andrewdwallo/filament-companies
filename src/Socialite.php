<?php

namespace Wallo\FilamentCompanies;

use Wallo\FilamentCompanies\Contracts\CreatesConnectedAccounts;
use Wallo\FilamentCompanies\Contracts\CreatesUserFromProvider;
use Wallo\FilamentCompanies\Contracts\GeneratesProviderRedirect;
use Wallo\FilamentCompanies\Contracts\HandlesInvalidState;
use Wallo\FilamentCompanies\Contracts\ResolvesSocialiteUsers;
use Wallo\FilamentCompanies\Contracts\SetsUserPasswords;
use Wallo\FilamentCompanies\Contracts\UpdatesConnectedAccounts;

class Socialite
{
    /**
     * Determines if the application is using Socialite.
     *
     * @var bool
     */
    public static bool $enabled = true;

    /**
     * Indicates if Socialite routes will be registered.
     *
     * @var bool
     */
    public static bool $registersRoutes = true;

    /**
     * The user model that should be used by FilamentCompanies.
     *
     * @var string
     */
    public static string $connectedAccountModel = 'App\\Models\\ConnectedAccount';

    /**
     * Determine whether Socialite is enabled in the application.
     *
     * @param callable|bool|null $callback
     * @return bool
     */
    public static function enabled(callable|bool $callback = null): bool
    {
        if (is_callable($callback)) {
            static::$enabled = $callback();
        }

        if (is_bool($callback)) {
            static::$enabled = $callback;
        }

        return static::$enabled;
    }

    /**
     * Determine whether to show Socialite components on login or registration.
     *
     * @return bool
     */
    public static function show(): bool
    {
        return static::$enabled;
    }

    /**
     * Determine which providers the application supports.
     *
     * @return array
     */
    public static function providers(): array
    {
        return config('filament-companies.providers');
    }

    /**
     * Determine if FilamentCompanies supports a specific Socialite provider.
     *
     * @param string $provider
     * @return bool
     */
    public static function hasSupportFor(string $provider): bool
    {
        return Providers::enabled($provider);
    }

    /**
     * Determine if the application has support for the Bitbucket provider..
     *
     * @return bool
     */
    public static function hasBitbucketSupport(): bool
    {
        return Providers::hasBitbucketSupport();
    }

    /**
     * Determine if the application has support for the Facebook provider..
     *
     * @return bool
     */
    public static function hasFacebookSupport(): bool
    {
        return Providers::hasFacebookSupport();
    }

    /**
     * Determine if the application has support for the Gitlab provider..
     *
     * @return bool
     */
    public static function hasGitlabSupport(): bool
    {
        return Providers::hasGitlabSupport();
    }

    /**
     * Determine if the application has support for the GitHub provider..
     *
     * @return bool
     */
    public static function hasGithubSupport(): bool
    {
        return Providers::hasGithubSupport();
    }

    /**
     * Determine if the application has support for the Google provider..
     *
     * @return bool
     */
    public static function hasGoogleSupport(): bool
    {
        return Providers::hasGoogleSupport();
    }

    /**
     * Determine if the application has support for the LinkedIn provider..
     *
     * @return bool
     */
    public static function hasLinkedInSupport(): bool
    {
        return Providers::hasLinkedInSupport();
    }

    /**
     * Determine if the application has support for the Twitter provider.
     *
     * @return bool
     */
    public static function hasTwitterSupport(): bool
    {
        return Providers::hasTwitterSupport();
    }

    /**
     * Determine if the application has support for the Twitter OAuth 1.0 provider..
     *
     * @return bool
     */
    public static function hasTwitterOAuth1Support(): bool
    {
        return Providers::hasTwitterOAuth1Support();
    }

    /**
     * Determine if the application has support for the Twitter OAuth 2.0 provider..
     *
     * @return bool
     */
    public static function hasTwitterOAuth2Support(): bool
    {
        return Providers::hasTwitterOAuth2Support();
    }

    /**
     * Determine if the application has the generates missing emails feature enabled.
     *
     * @return bool
     */
    public static function generatesMissingEmails(): bool
    {
        return Features::generatesMissingEmails();
    }

    /**
     * Determine if the application has the create account on first login feature.
     *
     * @return bool
     */
    public static function hasCreateAccountOnFirstLoginFeatures(): bool
    {
        return Features::hasCreateAccountOnFirstLoginFeatures();
    }

    /**
     * Determine if the application should use provider avatars when registering.
     *
     * @return bool
     */
    public static function hasProviderAvatarsFeature(): bool
    {
        return Features::hasProviderAvatarsFeature();
    }

    /**
     * Determine if the application should remember the users session on login.
     *
     * @return bool
     */
    public static function hasRememberSessionFeatures(): bool
    {
        return Features::hasRememberSessionFeatures();
    }

    /**
     * Find a connected account instance for a given provider and provider ID.
     *
     * @param  string  $provider
     * @param  string  $providerId
     * @return mixed
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
     *
     * @return string
     */
    public static function connectedAccountModel(): string
    {
        return static::$connectedAccountModel;
    }

    /**
     * Get a new instance of the connected account model.
     *
     * @return mixed
     */
    public static function newConnectedAccountModel(): mixed
    {
        $model = static::connectedAccountModel();

        return new $model;
    }

    /**
     * Specify the connected account model that should be used by FilamentCompanies.
     *
     * @param  string  $model
     * @return static
     */
    public static function useConnectedAccountModel(string $model): static
    {
        static::$connectedAccountModel = $model;

        return new static;
    }

    /**
     * Register a class / callback that should be used to resolve the user for a Socialite Provider.
     *
     * @param string $class
     * @return void
     */
    public static function resolvesSocialiteUsersUsing(string $class): void
    {
        app()->singleton(ResolvesSocialiteUsers::class, $class);
    }

    /**
     * Register a class / callback that should be used to create users from social providers.
     *
     * @param  string  $class
     * @return void
     */
    public static function createUsersFromProviderUsing(string $class): void
    {
        app()->singleton(CreatesUserFromProvider::class, $class);
    }

    /**
     * Register a class / callback that should be used to create connected accounts.
     *
     * @param  string  $class
     * @return void
     */
    public static function createConnectedAccountsUsing(string $class): void
    {
        app()->singleton(CreatesConnectedAccounts::class, $class);
    }

    /**
     * Register a class / callback that should be used to update connected accounts.
     *
     * @param  string  $class
     * @return void
     */
    public static function updateConnectedAccountsUsing(string $class): void
    {
        app()->singleton(UpdatesConnectedAccounts::class, $class);
    }

    /**
     * Register a class / callback that should be used to set user passwords.
     *
     * @param  string  $callback
     * @return void
     */
    public static function setUserPasswordsUsing(string $callback): void
    {
        app()->singleton(SetsUserPasswords::class, $callback);
    }

    /**
     * Register a class / callback that should be used to set user passwords.
     *
     * @param  string  $callback
     * @return void
     */
    public static function handlesInvalidStateUsing(string $callback): void
    {
        app()->singleton(HandlesInvalidState::class, $callback);
    }

    /**
     * Register a class / callback that should be used for generating provider redirects.
     *
     * @param  string  $callback
     * @return void
     */
    public static function generatesProvidersRedirectsUsing(string $callback): void
    {
        app()->singleton(GeneratesProviderRedirect::class, $callback);
    }
}
