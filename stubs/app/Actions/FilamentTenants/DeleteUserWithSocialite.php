<?php

namespace App\Actions\FilamentTenants;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Wallo\FilamentTenants\Contracts\DeletesTenants;
use Wallo\FilamentTenants\Contracts\DeletesUsers;

class DeleteUser implements DeletesUsers
{
    /**
     * The tenant deleter implementation.
     */
    protected DeletesTenants $deletesTenants;

    /**
     * Create a new action instance.
     */
    public function __construct(DeletesTenants $deletesTenants)
    {
        $this->deletesTenants = $deletesTenants;
    }

    /**
     * Delete the given user.
     */
    public function delete(User $user): void
    {
        DB::transaction(function () use ($user) {
            $this->deleteTenants($user);
            $user->deleteProfilePhoto();
            $user->connectedAccounts->each(static fn ($account) => $account->delete());
            $user->tokens->each(static fn ($token) => $token->delete());
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
