<?php

namespace Wallo\FilamentCompanies\Concerns\Base;

use Closure;
use Wallo\FilamentCompanies\HasCompanies;

trait HasCompanyFeatures
{
    /**
     * The event listener to register.
     */
    protected static bool $switchesCurrentCompany = false;

    /**
     * Determine if the company is supporting company features.
     */
    public static bool $hasCompanyFeatures = false;

    /**
     * Determine if invitations are sent to company employees.
     */
    public static bool $sendsCompanyInvitations = false;

    /**
     * Determine if the application supports switching current company.
     */
    public function switchCurrentCompany(bool $condition = true): static
    {
        static::$switchesCurrentCompany = $condition;

        return $this;
    }

    /**
     * Determine if the company is supporting company features.
     */
    public function companies(bool | Closure | null $condition = true, bool $invitations = false): static
    {
        static::$hasCompanyFeatures = $condition instanceof Closure ? $condition() : $condition;
        static::$sendsCompanyInvitations = $invitations;

        return $this;
    }

    /**
     * Determine if the application switches the current company.
     */
    public static function switchesCurrentCompany(): bool
    {
        return static::$switchesCurrentCompany;
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
        return static::hasCompanyFeatures() && static::$sendsCompanyInvitations;
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
}
