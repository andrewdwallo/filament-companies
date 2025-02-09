<?php

namespace Wallo\FilamentTenants\Concerns\Base;

use Wallo\FilamentTenants\Contracts\AddsTenantEmployees;
use Wallo\FilamentTenants\Contracts\CreatesTenants;
use Wallo\FilamentTenants\Contracts\CreatesNewUsers;
use Wallo\FilamentTenants\Contracts\DeletesTenants;
use Wallo\FilamentTenants\Contracts\DeletesUsers;
use Wallo\FilamentTenants\Contracts\InvitesTenantEmployees;
use Wallo\FilamentTenants\Contracts\RemovesTenantEmployees;
use Wallo\FilamentTenants\Contracts\UpdatesTenantNames;
use Wallo\FilamentTenants\Contracts\UpdatesUserPasswords;
use Wallo\FilamentTenants\Contracts\UpdatesUserProfileInformation;

trait HasBaseActionBindings
{
    /**
     * Register a class / callback that should be used to create new users.
     */
    public static function createUsersUsing(string $class): void
    {
        app()->singleton(CreatesNewUsers::class, $class);
    }

    /**
     * Register a class / callback that should be used to update user profile information.
     */
    public static function updateUserProfileInformationUsing(string $class): void
    {
        app()->singleton(UpdatesUserProfileInformation::class, $class);
    }

    /**
     * Register a class / callback that should be used to update user passwords.
     */
    public static function updateUserPasswordsUsing(string $class): void
    {
        app()->singleton(UpdatesUserPasswords::class, $class);
    }

    /**
     * Register a class / callback that should be used to create tenants.
     */
    public static function createTenantsUsing(string $class): void
    {
        app()->singleton(CreatesTenants::class, $class);
    }

    /**
     * Register a class / callback that should be used to update tenant names.
     */
    public static function updateTenantNamesUsing(string $class): void
    {
        app()->singleton(UpdatesTenantNames::class, $class);
    }

    /**
     * Register a class / callback that should be used to add tenant employees.
     */
    public static function addTenantEmployeesUsing(string $class): void
    {
        app()->singleton(AddsTenantEmployees::class, $class);
    }

    /**
     * Register a class / callback that should be used to add tenant employees.
     */
    public static function inviteTenantEmployeesUsing(string $class): void
    {
        app()->singleton(InvitesTenantEmployees::class, $class);
    }

    /**
     * Register a class / callback that should be used to remove tenant employees.
     */
    public static function removeTenantEmployeesUsing(string $class): void
    {
        app()->singleton(RemovesTenantEmployees::class, $class);
    }

    /**
     * Register a class / callback that should be used to delete tenants.
     */
    public static function deleteTenantsUsing(string $class): void
    {
        app()->singleton(DeletesTenants::class, $class);
    }

    /**
     * Register a class / callback that should be used to delete users.
     */
    public static function deleteUsersUsing(string $class): void
    {
        app()->singleton(DeletesUsers::class, $class);
    }
}
