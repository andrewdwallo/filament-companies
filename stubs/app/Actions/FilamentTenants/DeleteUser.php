<?php

namespace App\Actions\FilamentTenants;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\PersonalAccessToken;
use Wallo\FilamentTenants\Contracts\DeletesTenants;
use Wallo\FilamentTenants\Contracts\DeletesUsers;

class DeleteUser implements DeletesUsers
{
    /**
     * Create a new action instance.
     */
    public function __construct(protected DeletesTenants $deletesTenants)
    {
        //
    }

    /**
     * Delete the given user.
     */
    public function delete(User $user): void
    {
        DB::transaction(function () use ($user) {
            $this->deleteTenants($user);
            $user->deleteProfilePhoto();
            $user->tokens->each(static fn (PersonalAccessToken $token) => $token->delete());
            $user->delete();
        });
    }

    /**
     * Delete the tenants and tenant associations attached to the user.
     */
    protected function deleteTenants(User $user): void
    {
        $user->tenants()->detach();

        $user->ownedTenants->each(function (Tenant $tenant) {
            $this->deletesTenants->delete($tenant);
        });
    }
}
