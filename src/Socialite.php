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
     * The user model that should be used by FilamentCompanies.
     */
    public static string $connectedAccountModel = 'App\\Models\\ConnectedAccount';

    /**
     * Determine if Company is supporting socialite features.
     */
    public static function hasSocialiteFeatures(): bool
    {
        return Features::hasSocialiteFeatures();
    }

    /**
     * Determine which providers the application supports.
     */
    public static function providers(): array
    {
        return config('filament-companies.providers', []);
    }

    /**
     * Determine if the application has support for the Bitbucket provider..
     */
    public static function hasBitbucket(): bool
    {
        return Providers::hasBitbucket();
    }

    /**
     * Determine if the application has support for the Facebook provider..
     */
    public static function hasFacebook(): bool
    {
        return Providers::hasFacebook();
    }

    /**
     * Determine if the application has support for the Gitlab provider..
     */
    public static function hasGitlab(): bool
    {
        return Providers::hasGitlab();
    }

    /**
     * Determine if the application has support for the GitHub provider..
     */
    public static function hasGithub(): bool
    {
        return Providers::hasGithub();
    }

    /**
     * Determine if the application has support for the Google provider..
     */
    public static function hasGoogle(): bool
    {
        return Providers::hasGoogle();
    }

    /**
     * Determine if the application has support for the LinkedIn provider..
     */
    public static function hasLinkedIn(): bool
    {
        return Providers::hasLinkedIn();
    }

    /**
     * Determine if the application has support for the Twitter OAuth 1.0 provider..
     */
    public static function hasTwitterOAuth1(): bool
    {
        return Providers::hasTwitterOAuth1();
    }

    /**
     * Determine if the application has support for the Twitter OAuth 2.0 provider..
     */
    public static function hasTwitterOAuth2(): bool
    {
        return Providers::hasTwitterOAuth2();
    }

    /**
     * Determine if the application has the generates missing emails feature enabled.
     */
    public static function generatesMissingEmails(): bool
    {
        return Features::generatesMissingEmails();
    }

    /**
     * Determine if the application has the create account on first login feature.
     */
    public static function hasCreateAccountOnFirstLoginFeatures(): bool
    {
        return Features::hasCreateAccountOnFirstLoginFeatures();
    }

    public static function hasLoginOnRegistrationFeatures(): bool
    {
        return Features::hasLoginOnRegistrationFeatures();
    }

    /**
     * Determine if the application should use provider avatars when registering.
     */
    public static function hasProviderAvatarsFeature(): bool
    {
        return Features::hasProviderAvatarsFeature();
    }

    /**
     * Determine if the application should remember the users session on login.
     */
    public static function hasRememberSessionFeatures(): bool
    {
        return Features::hasRememberSessionFeatures();
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
}
