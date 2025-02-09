<?php

namespace Wallo\FilamentTenants\Concerns\Base;

use App\Models\Tenant;
use App\Models\TenantInvitation;
use App\Models\Employeeship;
use App\Models\User;

trait HasBaseModels
{
    /**
     * The user model that should be used by Tenant.
     */
    public static string $userModel = User::class;

    /**
     * The tenant model that should be used by Tenant.
     */
    public static string $tenantModel = Tenant::class;

    /**
     * The employeeship model that should be used by Tenant.
     */
    public static string $employeeshipModel = Employeeship::class;

    /**
     * The tenant invitation model that should be used by Tenant.
     */
    public static string $tenantInvitationModel = TenantInvitation::class;

    /**
     * Get the name of the user model used by the application.
     */
    public static function userModel(): string
    {
        return static::$userModel;
    }

    /**
     * Get the name of the tenant model used by the application.
     */
    public static function tenantModel(): string
    {
        return static::$tenantModel;
    }

    /**
     * Get the name of the employeeship model used by the application.
     */
    public static function employeeshipModel(): string
    {
        return static::$employeeshipModel;
    }

    /**
     * Get the name of the tenant invitation model used by the application.
     */
    public static function tenantInvitationModel(): string
    {
        return static::$tenantInvitationModel;
    }

    /**
     * Get a new instance of the user model.
     */
    public static function newUserModel(): mixed
    {
        $model = static::userModel();

        return new $model;
    }

    /**
     * Get a new instance of the tenant model.
     */
    public static function newTenantModel(): mixed
    {
        $model = static::tenantModel();

        return new $model;
    }

    /**
     * Specify the user model that should be used by Tenant.
     */
    public static function useUserModel(string $model): static
    {
        static::$userModel = $model;

        return new static;
    }

    /**
     * Specify the tenant model that should be used by Tenant.
     */
    public static function useTenantModel(string $model): static
    {
        static::$tenantModel = $model;

        return new static;
    }

    /**
     * Specify the employeeship model that should be used by Tenant.
     */
    public static function useEmployeeshipModel(string $model): static
    {
        static::$employeeshipModel = $model;

        return new static;
    }

    /**
     * Specify the tenant invitation model that should be used by Tenant.
     */
    public static function useTenantInvitationModel(string $model): static
    {
        static::$tenantInvitationModel = $model;

        return new static;
    }

    /**
     * Find a user instance by the given ID.
     */
    public static function findUserByIdOrFail(int $id): mixed
    {
        return static::newUserModel()->where('id', $id)->firstOrFail();
    }

    /**
     * Find a user instance by the given email address or fail.
     */
    public static function findUserByEmailOrFail(string $email): mixed
    {
        return static::newUserModel()->where('email', $email)->firstOrFail();
    }
}
