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
    public static function enabled(string $feature)
    {
        return in_array($feature, config('filament-companies.features', []));
    }

    /**
     * Determine if the feature is enabled and has a given option enabled.
     *
     * @param  string  $feature
     * @param  string  $option
     * @return bool
     */
    public static function optionEnabled(string $feature, string $option)
    {
        return static::enabled($feature) &&
               config("filament-companies-options.{$feature}.{$option}") === true;
    }

    /**
     * Determine if the application is allowing profile photo uploads.
     *
     * @return bool
     */
    public static function managesProfilePhotos()
    {
        return static::enabled(static::profilePhotos());
    }

    /**
     * Determine if the application is using any API features.
     *
     * @return bool
     */
    public static function hasApiFeatures()
    {
        return static::enabled(static::api());
    }

    /**
     * Determine if the application is using any company features.
     *
     * @return bool
     */
    public static function hasCompanyFeatures()
    {
        return static::enabled(static::companies());
    }

    /**
     * Determine if invitations are sent to company employees.
     *
     * @return bool
     */
    public static function sendsCompanyInvitations()
    {
        return static::optionEnabled(static::companies(), 'invitations');
    }

    /**
     * Determine if the application has terms of service / privacy policy confirmation enabled.
     *
     * @return bool
     */
    public static function hasTermsAndPrivacyPolicyFeature()
    {
        return static::enabled(static::termsAndPrivacyPolicy());
    }

    /**
     * Determine if the application is using any account deletion features.
     *
     * @return bool
     */
    public static function hasAccountDeletionFeatures()
    {
        return static::enabled(static::accountDeletion());
    }

    /**
     * Determine if the application has the generates missing emails feature enabled.
     *
     * @return bool
     */
    public static function generatesMissingEmails()
    {
        return static::enabled(static::generateMissingEmails());
    }

    /**
     * Determine if the application supports creating accounts
     * when logging in for the first time via a provider.
     *
     * @return bool
     */
    public static function hasCreateAccountOnFirstLoginFeatures()
    {
        return static::enabled(static::createAccountOnFirstLogin());
    }

    /**
     * Determine if the application supports logging into existing
     * accounts when registering with a provider who's email address
     * is already registered.
     *
     * @return bool
     */
    public static function hasLoginOnRegistrationFeatures()
    {
        return static::enabled(static::loginOnRegistration());
    }

    /**
     * Determine if the application should use provider avatars when registering.
     *
     * @return bool
     */
    public static function hasProviderAvatarsFeature()
    {
        return static::enabled(static::providerAvatars());
    }

    /**
     * Determine if the application should remember the users session om login.
     *
     * @return bool
     */
    public static function hasRememberSessionFeatures()
    {
        return static::enabled(static::rememberSession());
    }

    /**
     * Enable the profile photo upload feature.
     *
     * @return string
     */
    public static function profilePhotos()
    {
        return 'profile-photos';
    }

    /**
     * Enable the API feature.
     *
     * @return string
     */
    public static function api()
    {
        return 'api';
    }

    /**
     * Enable the companies feature.
     *
     * @param  array  $options
     * @return string
     */
    public static function companies(array $options = [])
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
    public static function termsAndPrivacyPolicy()
    {
        return 'terms';
    }

    /**
     * Enable the account deletion feature.
     *
     * @return string
     */
    public static function accountDeletion()
    {
        return 'account-deletion';
    }

    /**
     * Enabled the generate missing emails feature.
     *
     * @return string
     */
    public static function generateMissingEmails()
    {
        return 'generate-missing-emails';
    }

    /**
     * Enable the create account on first login feature.
     *
     * @return string
     */
    public static function createAccountOnFirstLogin()
    {
        return 'create-account-on-first-login';
    }

    /**
     * Enable the login on registration feature.
     *
     * @return string
     */
    public static function loginOnRegistration()
    {
        return 'login-on-registration';
    }

    /**
     * Enable the provider avatars feature.
     *
     * @return string
     */
    public static function providerAvatars()
    {
        return 'provider-avatars';
    }

    /**
     * Enable the remember session feature for logging in.
     *
     * @return string
     */
    public static function rememberSession()
    {
        return 'remember-session';
    }
}
