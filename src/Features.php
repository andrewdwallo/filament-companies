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
}
