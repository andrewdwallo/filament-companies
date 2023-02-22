<?php

namespace Wallo\FilamentCompanies;

class Features
{
    /**
     * Determine if the given feature is enabled.
     */
    public static function enabled(string $feature): bool
    {
        return in_array($feature, config('filament-companies.features', []), true);
    }

    /**
     * Determine if the feature is enabled and has a given option enabled.
     */
    public static function optionEnabled(string $feature, string $option): bool
    {
        return static::enabled($feature) &&
               config("filament-companies-options.{$feature}.{$option}") === true;
    }

    /**
     * Determine if the application is allowing profile photo uploads.
     */
    public static function managesProfilePhotos(): bool
    {
        return static::enabled(static::profilePhotos());
    }

    /**
     * Determine if the application is using any API features.
     */
    public static function hasApiFeatures(): bool
    {
        return static::enabled(static::api());
    }

    /**
     * Determine if the application is using any company features.
     */
    public static function hasCompanyFeatures(): bool
    {
        return static::enabled(static::companies());
    }

    /**
     * Determine if invitations are sent to company employees.
     */
    public static function sendsCompanyInvitations(): bool
    {
        return static::optionEnabled(static::companies(), 'invitations');
    }

    /**
     * Determine if the application has terms of service / privacy policy confirmation enabled.
     */
    public static function hasTermsAndPrivacyPolicyFeature(): bool
    {
        return static::enabled(static::termsAndPrivacyPolicy());
    }

    /**
     * Determine if the application is using any account deletion features.
     */
    public static function hasAccountDeletionFeatures(): bool
    {
        return static::enabled(static::accountDeletion());
    }

    /**
     * Determine if the application is using any socialite features.
     */
    public static function hasSocialiteFeatures(): bool
    {
        return static::enabled(static::socialite());
    }

    /**
     * Determine if the application has the generates missing emails feature enabled.
     */
    public static function generatesMissingEmails(): bool
    {
        return static::optionEnabled(static::socialite(), 'generateMissingEmails');
    }

    /**
     * Determine if the application supports creating accounts when logging in for the first time via a provider.
     */
    public static function hasCreateAccountOnFirstLoginFeatures(): bool
    {
        return static::optionEnabled(static::socialite(), 'createAccountOnFirstLogin');
    }

    /**
     * Determine if the application supports logging into existing
     * accounts when registering with a provider whose email address
     * is already registered.
     */
    public static function hasLoginOnRegistrationFeatures(): bool
    {
        return static::optionEnabled(static::socialite(), 'loginOnRegistration');
    }

    /**
     * Determine if the application should use provider avatars when registering.
     */
    public static function hasProviderAvatarsFeature(): bool
    {
        return static::optionEnabled(static::socialite(), 'providerAvatars');
    }

    /**
     * Determine if the application should remember the users session on login.
     */
    public static function hasRememberSessionFeatures(): bool
    {
        return static::optionEnabled(static::socialite(), 'rememberSession');
    }

    /**
     * Enable the profile photo upload feature.
     */
    public static function profilePhotos(): string
    {
        return 'profile-photos';
    }

    /**
     * Enable the API feature.
     */
    public static function api(): string
    {
        return 'api';
    }

    /**
     * Enable the companies feature.
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
     */
    public static function termsAndPrivacyPolicy(): string
    {
        return 'terms';
    }

    /**
     * Enable the account deletion feature.
     */
    public static function accountDeletion(): string
    {
        return 'account-deletion';
    }

    /**
     * Enable the socialite feature.
     */
    public static function socialite(array $options = []): string
    {
        if (! empty($options)) {
            config(['filament-companies-options.socialite' => $options]);
        }

        return 'socialite';
    }
}
