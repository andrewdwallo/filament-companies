<?php

namespace Wallo\FilamentCompanies;

use Closure;

class Features
{
    /**
     * Determine if the company is managing profile photos.
     */
    public static bool $managesProfilePhotos = false;

    /**
     * Determine if the company has a profile photo disk.
     */
    public static string $profilePhotoDisk = 'public';

    /**
     * Determine if the company has a profile photo storage path.
     */
    public static string $profilePhotoStoragePath = 'profile-photos';

    /**
     * Determine if the company is supporting API features.
     */
    public static bool $hasApiFeatures = false;

    /**
     * Determine if the company is supporting company features.
     */
    public static bool $hasCompanyFeatures = false;

    /**
     * Determine if invitations are sent to company employees.
     */
    public static bool $sendsCompanyInvitations = false;

    /**
     * Determine if the application is using the terms confirmation feature.
     */
    public static bool $hasTermsAndPrivacyPolicyFeature = false;

    /**
     * Determine if the application is using any account deletion features.
     */
    public static bool $hasAccountDeletionFeatures = false;

    /**
     * Determine if the company is managing profile photos.
     */
    public function profilePhotos(bool|Closure|null $condition = true, string $disk = 'public', string $storagePath = 'profile-photos'): static
    {
        static::$managesProfilePhotos = $condition instanceof Closure ? $condition() : $condition;
        static::$profilePhotoDisk = $disk;
        static::$profilePhotoStoragePath = $storagePath;

        return $this;
    }

    /**
     * Determine if the company is supporting API features.
     */
    public function api(bool|Closure|null $condition = true): static
    {
        static::$hasApiFeatures = $condition instanceof Closure ? $condition() : $condition;

        return $this;
    }

    /**
     * Determine if the company is supporting company features.
     */
    public function companies(bool|Closure|null $condition = true, bool|Closure|null $invitations = null): static
    {
        static::$hasCompanyFeatures = $condition instanceof Closure ? $condition() : $condition;
        static::$sendsCompanyInvitations = $invitations instanceof Closure ? $invitations() : $invitations ?? false;

        return $this;
    }

    /**
     * Determine if the application is using the terms confirmation feature.
     */
    public function termsAndPrivacyPolicy(bool|Closure|null $condition = true): static
    {
        static::$hasTermsAndPrivacyPolicyFeature = $condition instanceof Closure ? $condition() : $condition;

        return $this;
    }

    /**
     * Determine if the application is using any account deletion features.
     */
    public function accountDeletion(bool|Closure|null $condition = true): static
    {
        static::$hasAccountDeletionFeatures = $condition instanceof Closure ? $condition() : $condition;

        return $this;
    }

    /**
     * Determine if Company is managing profile photos.
     */
    public static function managesProfilePhotos(): bool
    {
        return static::$managesProfilePhotos;
    }

    /**
     * Get the disk that profile photos should be stored on.
     */
    public static function profilePhotoDisk(): string
    {
        return static::$profilePhotoDisk;
    }

    /**
     * Get the storage path that profile photos should be stored in.
     */
    public static function profilePhotoStoragePath(): string
    {
        return static::$profilePhotoStoragePath;
    }

    /**
     * Determine if Company is supporting API features.
     */
    public static function hasApiFeatures(): bool
    {
        return static::$hasApiFeatures;
    }

    /**
     * Determine if Company is supporting company features.
     */
    public static function hasCompanyFeatures(): bool
    {
        return static::$hasCompanyFeatures;
    }

    /**
     * Determine if invitations are sent to company employees.
     */
    public static function sendsCompanyInvitations(): bool
    {
        return static::$sendsCompanyInvitations;
    }

    /**
     * Determine if a given user model utilizes the "HasCompanies" trait.
     */
    public static function userHasCompanyFeatures(mixed $user): bool
    {
        return (array_key_exists(HasCompanies::class, class_uses_recursive($user)) ||
                method_exists($user, 'currentCompany')) &&
            static::hasCompanyFeatures();
    }

    /**
     * Determine if the application is using the terms confirmation feature.
     */
    public static function hasTermsAndPrivacyPolicyFeature(): bool
    {
        return static::$hasTermsAndPrivacyPolicyFeature;
    }

    /**
     * Determine if the application is using any account deletion features.
     */
    public static function hasAccountDeletionFeatures(): bool
    {
        return static::$hasAccountDeletionFeatures;
    }
}
