<?php

namespace Wallo\FilamentCompanies\Concerns\Socialite;

use Filament\Facades\Filament;
use Wallo\FilamentCompanies\Http\Livewire\ConnectedAccountsForm;
use Wallo\FilamentCompanies\Http\Livewire\SetPasswordForm;

trait HasSocialiteComponents
{
    /**
     * The component that should be used when displaying the "Set Password" form.
     */
    public static string $setPasswordForm = SetPasswordForm::class;

    /**
     * The component that should be used when displaying the "Connected Accounts" form.
     */
    public static string $connectedAccountsForm = ConnectedAccountsForm::class;

    /**
     * Get the component that should be used when displaying the "Set Password" form.
     */
    public static function getSetPasswordForm(): string
    {
        return static::$setPasswordForm;
    }

    /**
     * Get the component that should be used when displaying the "Connected Accounts" form.
     */
    public static function getConnectedAccountsForm(): string
    {
        return static::$connectedAccountsForm;
    }

    public static function getSocialiteComponents(): array
    {
        $components = [];
        $user = Filament::auth()->user();
        $passwordIsNull = $user?->getAuthPassword() === null;

        if ($passwordIsNull && static::canSetPasswords()) {
            $components[] = static::getSetPasswordForm();
        }

        if (static::canManageConnectedAccounts()) {
            $components[] = static::getConnectedAccountsForm();
        }

        return $components;
    }
}
