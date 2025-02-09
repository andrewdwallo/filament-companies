<?php

namespace Wallo\FilamentTenants\Concerns\Base;

use Closure;
use Wallo\FilamentTenants\HasTenants;

trait HasTenantFeatures
{
    /**
     * The event listener to register.
     */
    protected static bool $switchesCurrentTenant = false;

    /**
     * Determine if the tenant is supporting tenant features.
     */
    public static bool $hasTenantFeatures = false;

    /**
     * Determine if invitations are sent to tenant employees.
     */
    public static bool $sendsTenantInvitations = false;

    /**
     * Determine if the application supports switching current tenant.
     */
    public function switchCurrentTenant(bool $condition = true): static
    {
        static::$switchesCurrentTenant = $condition;

        return $this;
    }

    /**
     * Determine if the tenant is supporting tenant features.
     */
    public function tenants(bool | Closure | null $condition = true, bool $invitations = false): static
    {
        static::$hasTenantFeatures = $condition instanceof Closure ? $condition() : $condition;
        static::$sendsTenantInvitations = $invitations;

        return $this;
    }

    /**
     * Determine if the application switches the current tenant.
     */
    public static function switchesCurrentTenant(): bool
    {
        return static::$switchesCurrentTenant;
    }

    /**
     * Determine if Tenant is supporting tenant features.
     */
    public static function hasTenantFeatures(): bool
    {
        return static::$hasTenantFeatures;
    }

    /**
     * Determine if invitations are sent to tenant employees.
     */
    public static function sendsTenantInvitations(): bool
    {
        return static::hasTenantFeatures() && static::$sendsTenantInvitations;
    }

    /**
     * Determine if a given user model utilizes the "HasTenants" trait.
     */
    public static function userHasTenantFeatures(mixed $user): bool
    {
        return (array_key_exists(HasTenants::class, class_uses_recursive($user)) ||
                method_exists($user, 'currentTenant')) &&
            static::hasTenantFeatures();
    }
}
