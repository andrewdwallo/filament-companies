<?php

namespace Wallo\FilamentCompanies\Concerns\Base;

use Filament\Facades\Filament;
use Wallo\FilamentCompanies\Http\Livewire\DeleteUserForm;
use Wallo\FilamentCompanies\Http\Livewire\LogoutOtherBrowserSessionsForm;
use Wallo\FilamentCompanies\Http\Livewire\UpdatePasswordForm;
use Wallo\FilamentCompanies\Http\Livewire\UpdateProfileInformationForm;

trait HasBaseProfileComponents
{
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
    public static function getBaseProfileComponents(): array
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

        return $components;
    }
}
