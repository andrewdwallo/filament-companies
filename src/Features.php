<?php

namespace Wallo\FilamentCompanies;

class Features
{
    /**
     * Determine if the given feature is enabled.
     *
     * @param  string  $feature
     * @return bool
     */
    public static function enabled(string $feature): bool
    {
        return in_array($feature, config('filament-companies.features', []), true);
    }

    /**
     * Determine if the feature is enabled and has a given option enabled.
     *
     * @param  string  $feature
     * @param  string  $option
     * @return bool
     */
    public static function optionEnabled(string $feature, string $option): bool
    {
        return static::enabled($feature) &&
               config("filament-companies-options.{$feature}.{$option}") === true;
    }

    /**
     * Determine if the application is allowing profile photo uploads.
     *
     * @return bool
     */
    public static function managesProfilePhotos(): bool
    {
        return static::enabled(static::profilePhotos());
    }

    /**
     * Determine if the application is using any API features.
     *
     * @return bool
     */
    public static function hasApiFeatures(): bool
    {
        return static::enabled(static::api());
    }

    /**
     * Determine if the application is using any company features.
     *
     * @return bool
     */
    public static function hasCompanyFeatures(): bool
    {
        return static::enabled(static::companies());
    }

    /**
     * Determine if invitations are sent to company employees.
     *
     * @return bool
     */
    public static function sendsCompanyInvitations(): bool
    {
        return static::optionEnabled(static::companies(), 'invitations');
    }

    /**
     * Determine if the application has terms of service / privacy policy confirmation enabled.
     *
     * @return bool
     */
    public static function hasTermsAndPrivacyPolicyFeature(): bool
    {
        return static::enabled(static::termsAndPrivacyPolicy());
    }

    /**
     * Determine if the application is using any account deletion features.
     *
     * @return bool
     */
    public static function hasAccountDeletionFeatures(): bool
    {
        return static::enabled(static::accountDeletion());
    }

    /**
     * Determine if the application has the generates missing emails feature enabled.
     *
     * @return bool
     */
    public static function generatesMissingEmails(): bool
    {
        return static::enabled(static::generateMissingEmails());
    }

    /**
     * Determine if the application supports creating accounts
     * when logging in for the first time via a provider.
     *
     * @return bool
     */
    public static function hasCreateAccountOnFirstLoginFeatures(): bool
    {
        return static::enabled(static::createAccountOnFirstLogin());
    }

    /**
     * Determine if the application supports logging into existing
     * accounts when registering with a provider whose email address
     * is already registered.
     *
     * @return bool
     */
    public static function hasLoginOnRegistrationFeatures(): bool
    {
        return static::enabled(static::loginOnRegistration());
    }

    /**
     * Determine if the application should use provider avatars when registering.
     *
     * @return bool
     */
    public static function hasProviderAvatarsFeature(): bool
    {
        return static::enabled(static::providerAvatars());
    }

    /**
     * Determine if the application should remember the users session on login.
     *
     * @return bool
     */
    public static function hasRememberSessionFeatures(): bool
    {
        return static::enabled(static::rememberSession());
    }

    /**
     * Enable the profile photo upload feature.
     *
     * @return string
     */
    public static function profilePhotos(): string
    {
        return 'profile-photos';
    }

    /**
     * Enable the API feature.
     *
     * @return string
     */
    public static function api(): string
    {
        return 'api';
    }

    /**
     * Enable the companies feature.
     *
     * @param  array  $options
     * @return string
     */
    public static function companies(array $options = []): string
    {
        if (! empty($options)) {
            config(['filament-companies-options.companies' => $options]);
        }

        return 'companies';
    }

    /**
     * Enable the terms of service and privacy policy feature.
     *
     * @return string
     */
    public static function termsAndPrivacyPolicy(): string
    {
        return 'terms';
    }

    /**
     * Enable the account deletion feature.
     *
     * @return string
     */
    public static function accountDeletion(): string
    {
        return 'account-deletion';
    }

    /**
     * Enabled to generate missing emails feature.
     *
     * @return string
     */
    public static function generateMissingEmails(): string
    {
        return 'generate-missing-emails';
    }

    /**
     * Enable the create account on first login feature.
     *
     * @return string
     */
    public static function createAccountOnFirstLogin(): string
    {
        return 'create-account-on-first-login';
    }

    /**
     * Enable the login on registration feature.
     *
     * @return string
     */
    public static function loginOnRegistration(): string
    {
        return 'login-on-registration';
    }

    /**
     * Enable the provider avatars feature.
     *
     * @return string
     */
    public static function providerAvatars(): string
    {
        return 'provider-avatars';
    }

    /**
     * Enable the remember session feature for logging in.
     *
     * @return string
     */
    public static function rememberSession(): string
    {
        return 'remember-session';
    }
}
