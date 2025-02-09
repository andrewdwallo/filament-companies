<?php

namespace App\Actions\FilamentTenants;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Wallo\FilamentTenants\Contracts\CreatesTenants;
use Wallo\FilamentTenants\Events\AddingTenant;
use Wallo\FilamentTenants\FilamentTenants;

class CreateTenant implements CreatesTenants
{
    /**
     * Validate and create a new tenant for the given user.
     *
     * @param  array<string, string>  $input
     *
     * @throws AuthorizationException
     */
    public function create(User $user, array $input): Tenant
    {
        Gate::forUser($user)->authorize('create', FilamentTenants::newTenantModel());

        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
        ])->validateWithBag('createTenant');

        AddingTenant::dispatch($user);

        $user->switchTenant($tenant = $user->ownedTenants()->create([
            'name' => $input['name'],
            'personal_tenant' => false,
        ]));

        return $tenant;
    }
}
