<?php

namespace Wallo\FilamentTenants;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

abstract class Tenant extends Model
{
    /**
     * Get the owner of the tenant.
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(FilamentTenants::userModel(), 'user_id');
    }

    /**
     * Get all the tenant's users including its owner.
     */
    public function allUsers(): Collection
    {
        return $this->users->merge([$this->owner]);
    }

    /**
     * Get all the users that belong to the tenant.
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(FilamentTenants::userModel(), FilamentTenants::employeeshipModel())
            ->withPivot('role')
            ->withTimestamps()
            ->as('employeeship');
    }

    /**
     * Determine if the given user belongs to the tenant.
     */
    public function hasUser(mixed $user): bool
    {
        return $this->users->contains($user) || $user->ownsTenant($this);
    }

    /**
     * Determine if the given email address belongs to a user on the tenant.
     */
    public function hasUserWithEmail(string $email): bool
    {
        return $this->allUsers()->contains(static function ($user) use ($email) {
            return $user->email === $email;
        });
    }

    /**
     * Determine if the given user has the given permission on the tenant.
     */
    public function userHasPermission(mixed $user, string $permission): bool
    {
        return $user->hasTenantPermission($this, $permission);
    }

    /**
     * Get all the pending user invitations for the tenant.
     */
    public function tenantInvitations(): HasMany
    {
        return $this->hasMany(FilamentTenants::tenantInvitationModel());
    }

    /**
     * Remove the given user from the tenant.
     */
    public function removeUser(mixed $user): void
    {
        if ($user->current_tenant_id === $this->id) {
            $user->forceFill([
                'current_tenant_id' => null,
            ])->save();
        }

        $this->users()->detach($user);
    }

    /**
     * Purge all the tenant's resources.
     */
    public function purge(): void
    {
        $this->owner()->where('current_tenant_id', $this->id)
            ->update(['current_tenant_id' => null]);

        $this->users()->where('current_tenant_id', $this->id)
            ->update(['current_tenant_id' => null]);

        $this->users()->detach();

        $this->delete();
    }
}
