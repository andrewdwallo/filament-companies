<?php

namespace Wallo\FilamentCompanies\Concerns\Socialite;

use Closure;
use Wallo\FilamentCompanies\Http\Livewire\ConnectedAccountsForm;
use Wallo\FilamentCompanies\Http\Livewire\SetPasswordForm;

trait HasSocialiteProfileFeatures
{
    /**
     * Determine if the application can set a user's password.
     */
    public static bool $canSetPasswords = false;

    /**
     * Determine if the application can manage connected accounts.
     */
    public static bool $canManageConnectedAccounts = false;

    /**
     * Determine if the application supports setting user passwords.
     */
    public function setPasswords(bool | Closure | null $condition = true, $component = SetPasswordForm::class, int $sort = 2): static
    {
        static::$canSetPasswords = $condition instanceof Closure ? $condition() : $condition;
        static::$setPasswordForm = $component;
        static::$componentSortOrder[$component] = $sort;

        return $this;
    }

    /**
     * Determine if the application supports managing connected accounts.
     */
    public function connectedAccounts(bool | Closure | null $condition = true, $component = ConnectedAccountsForm::class, int $sort = 3): static
    {
        static::$canManageConnectedAccounts = $condition instanceof Closure ? $condition() : $condition;
        static::$connectedAccountsForm = $component;
        static::$componentSortOrder[$component] = $sort;

        return $this;
    }

    /**
     * Determine if the application can set user passwords.
     */
    public static function canSetPasswords(): bool
    {
        return static::$canSetPasswords;
    }

    /**
     * Determine if the application can manage connected accounts.
     */
    public static function canManageConnectedAccounts(): bool
    {
        return static::$canManageConnectedAccounts;
    }
}
