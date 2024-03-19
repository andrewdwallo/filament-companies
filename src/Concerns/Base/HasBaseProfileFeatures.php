<?php

namespace Wallo\FilamentCompanies\Concerns\Base;

use Closure;
use Wallo\FilamentCompanies\Http\Livewire\DeleteUserForm;
use Wallo\FilamentCompanies\Http\Livewire\LogoutOtherBrowserSessionsForm;
use Wallo\FilamentCompanies\Http\Livewire\UpdatePasswordForm;
use Wallo\FilamentCompanies\Http\Livewire\UpdateProfileInformationForm;

trait HasBaseProfileFeatures
{
    /**
     * Determine if the application can update a user's profile information.
     */
    public static bool $canUpdateProfileInformation = false;

    /**
     * Determine if the application can update a user's password.
     */
    public static bool $canUpdatePasswords = false;

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
     * Determine if the application is using any browser session management features.
     */
    public static bool $canManageBrowserSessions = false;

    /**
     * Determine if the application is using any account deletion features.
     */
    public static bool $hasAccountDeletionFeatures = false;

    /**
     * Determine if the application supports updating profile information.
     */
    public function updateProfileInformation(bool | Closure | null $condition = true, $component = UpdateProfileInformationForm::class, int $sort = 0): static
    {
        static::$canUpdateProfileInformation = $condition instanceof Closure ? $condition() : $condition;
        static::$updateProfileInformationForm = $component;
        static::$componentSortOrder[$component] = $sort;

        return $this;
    }

    /**
     * Determine if the application supports updating user passwords.
     */
    public function updatePasswords(bool | Closure | null $condition = true, $component = UpdatePasswordForm::class, int $sort = 1): static
    {
        static::$canUpdatePasswords = $condition instanceof Closure ? $condition() : $condition;
        static::$updatePasswordForm = $component;
        static::$componentSortOrder[$component] = $sort;

        return $this;
    }

    /**
     * Determine if the application supports managing browser sessions.
     */
    public function manageBrowserSessions(bool | Closure | null $condition = true, $component = LogoutOtherBrowserSessionsForm::class, int $sort = 4): static
    {
        static::$canManageBrowserSessions = $condition instanceof Closure ? $condition() : $condition;
        static::$logoutOtherBrowserSessionsForm = $component;
        static::$componentSortOrder[$component] = $sort;

        return $this;
    }

    /**
     * Determine if the application is using any account deletion features.
     */
    public function accountDeletion(bool | Closure | null $condition = true, $component = DeleteUserForm::class, int $sort = 5): static
    {
        static::$hasAccountDeletionFeatures = $condition instanceof Closure ? $condition() : $condition;
        static::$deleteUserForm = $component;
        static::$componentSortOrder[$component] = $sort;

        return $this;
    }

    /**
     * Determine if the company is managing profile photos.
     */
    public function profilePhotos(bool | Closure | null $condition = true, string $disk = 'public', string $storagePath = 'profile-photos'): static
    {
        static::$managesProfilePhotos = $condition instanceof Closure ? $condition() : $condition;
        static::$profilePhotoDisk = $disk;
        static::$profilePhotoStoragePath = $storagePath;

        return $this;
    }

    /**
     * Determine if the company is supporting API features.
     */
    public function api(bool | Closure | null $condition = true): static
    {
        static::$hasApiFeatures = $condition instanceof Closure ? $condition() : $condition;

        return $this;
    }

    /**
     * Determine if the application can update a user's profile information.
     */
    public static function canUpdateProfileInformation(): bool
    {
        return static::$canUpdateProfileInformation;
    }

    /**
     * Determine if the application can update a user's password.
     */
    public static function canUpdatePasswords(): bool
    {
        return static::$canUpdatePasswords;
    }

    /**
     * Determine if the application can manage browser sessions.
     */
    public static function canManageBrowserSessions(): bool
    {
        return static::$canManageBrowserSessions;
    }

    /**
     * Determine if the application is using any account deletion features.
     */
    public static function hasAccountDeletionFeatures(): bool
    {
        return static::$hasAccountDeletionFeatures;
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
}
