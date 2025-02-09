<?php

namespace App\Actions\FilamentTenants;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Wallo\FilamentTenants\Contracts\UpdatesTenantNames;

class UpdateTenantName implements UpdatesTenantNames
{
    /**
     * Validate and update the given tenant's name.
     *
     * @param  array<string, string>  $input
     *
     * @throws AuthorizationException
     */
    public function update(User $user, Tenant $tenant, array $input): void
    {
        Gate::forUser($user)->authorize('update', $tenant);

        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
        ])->validateWithBag('updateTenantName');

        $tenant->forceFill([
            'name' => $input['name'],
        ])->save();
    }
}
