<?php

namespace Wallo\FilamentTenants\Actions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Wallo\FilamentTenants\Events\TenantEmployeeUpdated;
use Wallo\FilamentTenants\FilamentTenants;
use Wallo\FilamentTenants\Rules\Role;

class UpdateTenantEmployeeRole
{
    /**
     * Update the role for the given tenant employee.
     *
     * @throws AuthorizationException
     */
    public function update(mixed $user, mixed $tenant, int $tenantEmployeeId, string $role): void
    {
        Gate::forUser($user)->authorize('updateTenantEmployee', $tenant);

        Validator::make(compact('role'), [
            'role' => ['required', 'string', new Role],
        ])->validate();

        $tenant->users()->updateExistingPivot($tenantEmployeeId, compact('role'));

        TenantEmployeeUpdated::dispatch($tenant->fresh(), FilamentTenants::findUserByIdOrFail($tenantEmployeeId));
    }
}
