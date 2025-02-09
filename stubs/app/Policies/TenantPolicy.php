<?php

namespace App\Policies;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TenantPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Tenant $tenant): bool
    {
        return $user->belongsToTenant($tenant);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Tenant $tenant): bool
    {
        return $user->ownsTenant($tenant);
    }

    /**
     * Determine whether the user can add tenant employees.
     */
    public function addTenantEmployee(User $user, Tenant $tenant): bool
    {
        return $user->ownsTenant($tenant);
    }

    /**
     * Determine whether the user can update tenant employee permissions.
     */
    public function updateTenantEmployee(User $user, Tenant $tenant): bool
    {
        return $user->ownsTenant($tenant);
    }

    /**
     * Determine whether the user can remove tenant employees.
     */
    public function removeTenantEmployee(User $user, Tenant $tenant): bool
    {
        return $user->ownsTenant($tenant);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Tenant $tenant): bool
    {
        return $user->ownsTenant($tenant);
    }
}
