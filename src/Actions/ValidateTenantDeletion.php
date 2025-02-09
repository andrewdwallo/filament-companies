<?php

namespace Wallo\FilamentTenants\Actions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;

class ValidateTenantDeletion
{
    /**
     * Validate that the tenant can be deleted by the given user.
     *
     * @throws AuthorizationException
     */
    public function validate(mixed $user, mixed $tenant): void
    {
        Gate::forUser($user)->authorize('delete', $tenant);

        if ($tenant->personal_tenant) {
            throw ValidationException::withMessages([
                'tenant' => __('filament-tenants::default.errors.tenant_deletion'),
            ])->errorBag('deleteTenant');
        }
    }
}
