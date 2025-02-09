<?php

namespace App\Actions\FilamentTenants;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;
use Wallo\FilamentTenants\Contracts\RemovesTenantEmployees;
use Wallo\FilamentTenants\Events\TenantEmployeeRemoved;

class RemoveTenantEmployee implements RemovesTenantEmployees
{
    /**
     * Remove the tenant employee from the given tenant.
     *
     * @throws AuthorizationException
     */
    public function remove(User $user, Tenant $tenant, User $tenantEmployee): void
    {
        $this->authorize($user, $tenant, $tenantEmployee);

        $this->ensureUserDoesNotOwnTenant($tenantEmployee, $tenant);

        $tenant->removeUser($tenantEmployee);

        TenantEmployeeRemoved::dispatch($tenant, $tenantEmployee);
    }

    /**
     * Authorize that the user can remove the tenant employee.
     *
     * @throws AuthorizationException
     */
    protected function authorize(User $user, Tenant $tenant, User $tenantEmployee): void
    {
        if (! Gate::forUser($user)->check('removeTenantEmployee', $tenant) &&
            $user->id !== $tenantEmployee->id) {
            throw new AuthorizationException;
        }
    }

    /**
     * Ensure that the currently authenticated user does not own the tenant.
     */
    protected function ensureUserDoesNotOwnTenant(User $tenantEmployee, Tenant $tenant): void
    {
        if ($tenantEmployee->id === $tenant->owner->id) {
            throw ValidationException::withMessages([
                'tenant' => [__('filament-tenants::default.errors.cannot_leave_tenant')],
            ])->errorBag('removeTenantEmployee');
        }
    }
}
