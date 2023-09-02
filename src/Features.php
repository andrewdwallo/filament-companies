<?php

namespace Wallo\FilamentCompanies;

use Closure;
use Filament\Facades\Filament;
use Wallo\FilamentCompanies\Http\Livewire\DeleteUserForm;
use Wallo\FilamentCompanies\Http\Livewire\LogoutOtherBrowserSessionsForm;
use Wallo\FilamentCompanies\Http\Livewire\UpdatePasswordForm;
use Wallo\FilamentCompanies\Http\Livewire\UpdateProfileInformationForm;

class Features
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
     * Determine if the application is using notifications.
     */
    public static bool $hasNotificationsFeature = true;

    /**
     * Determine if the application is using any browser session management features.
     */
    public static bool $canManageBrowserSessions = false;

    /**
     * Determine if the application is using any account deletion features.
     */
    public static bool $hasAccountDeletionFeatures = false;

    /**
     * The component that should be used when displaying the "Update Profile Information" form.
     */
    public static string $updateProfileInformationForm = UpdateProfileInformationForm::class;

    /**
     * The component that should be used when displaying the "Update Password" form.
     */
    public static string $updatePasswordForm = UpdatePasswordForm::class;

    /**
     * The component that should be used when displaying the "Delete User" form.
     */
    public static string $deleteUserForm = DeleteUserForm::class;

    /**
     * The component that should be used when displaying the "Logout Other Browser Sessions" form.
     */
    public static string $logoutOtherBrowserSessionsForm = LogoutOtherBrowserSessionsForm::class;

    /**
     * The sort order of the components.
     */
    public static array $componentSortOrder = [];

    /**
     * Determine if the application supports updating profile information.
     */
    public function updateProfileInformation(bool|Closure|null $condition = true, $component = UpdateProfileInformationForm::class, int $sort = 0): static
    {
        static::$canUpdateProfileInformation = $condition instanceof Closure ? $condition() : $condition;
        static::$updateProfileInformationForm = $component;
        static::$componentSortOrder[$component] = $sort;

        return $this;
    }

    /**
     * Determine if the application supports updating user passwords.
     */
    public function updatePasswords(bool|Closure|null $condition = true, $component = UpdatePasswordForm::class, int $sort = 1): static
    {
        static::$canUpdatePasswords = $condition instanceof Closure ? $condition() : $condition;
        static::$updatePasswordForm = $component;
        static::$componentSortOrder[$component] = $sort;

        return $this;
    }

    /**
     * Determine if the application supports managing browser sessions.
     */
    public function manageBrowserSessions(bool|Closure|null $condition = true, $component = LogoutOtherBrowserSessionsForm::class, int $sort = 4): static
    {
        static::$canManageBrowserSessions = $condition instanceof Closure ? $condition() : $condition;
        static::$logoutOtherBrowserSessionsForm = $component;
        static::$componentSortOrder[$component] = $sort;

        return $this;
    }

    /**
     * Determine if the application is using any account deletion features.
     */
    public function accountDeletion(bool|Closure|null $condition = true, $component = DeleteUserForm::class, int $sort = 5): static
    {
        static::$hasAccountDeletionFeatures = $condition instanceof Closure ? $condition() : $condition;
        static::$deleteUserForm = $component;
        static::$componentSortOrder[$component] = $sort;

        return $this;
    }

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
     * Determine if the application is using notifications.
     */
    public function notifications(bool|Closure|null $condition = true): static
    {
        static::$hasNotificationsFeature = $condition instanceof Closure ? $condition() : $condition;

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
     * Determine if the application is using notifications.
     */
    public static function hasNotificationsFeature(): bool
    {
        return static::$hasNotificationsFeature;
    }

    /**
     * Get the component that should be used when displaying the "Update Profile Information" form.
     */
    public static function getUpdateProfileInformationForm(): string
    {
        return static::$updateProfileInformationForm;
    }

    /**
     * Get the component that should be used when displaying the "Update Password" form.
     */
    public static function getUpdatePasswordForm(): string
    {
        return static::$updatePasswordForm;
    }

    /**
     * Get the component that should be used when displaying the "Delete User" form.
     */
    public static function getDeleteUserForm(): string
    {
        return static::$deleteUserForm;
    }

    /**
     * Get the component that should be used when displaying the "Logout Other Browser Sessions" form.
     */
    public static function getLogoutOtherBrowserSessionsForm(): string
    {
        return static::$logoutOtherBrowserSessionsForm;
    }

    /**
     * Get the feature specific components.
     */
    public static function getComponents(): array
    {
        $components = [];
        $user = Filament::auth()->user();
        $passwordIsSet = $user?->getAuthPassword() !== null;

        if (static::canUpdateProfileInformation()) {
            $components[] = static::getUpdateProfileInformationForm();
        }

        if ($passwordIsSet && static::canUpdatePasswords()) {
            $components[] = static::getUpdatePasswordForm();
        }

        if ($passwordIsSet && static::canManageBrowserSessions()) {
            $components[] = static::getLogoutOtherBrowserSessionsForm();
        }

        if ($passwordIsSet && static::hasAccountDeletionFeatures()) {
            $components[] = static::getDeleteUserForm();
        }

        uasort($components, static function ($a, $b) {
            return static::$componentSortOrder[$a] <=> static::$componentSortOrder[$b];
        });

        return $components;
    }
}
