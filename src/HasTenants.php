<?php

namespace Wallo\FilamentTenants;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

trait HasTenants
{
    /**
     * Determine if the given tenant is the current tenant.
     */
    public function isCurrentTenant(mixed $tenant): bool
    {
        return $tenant->id === $this->currentTenant->id;
    }

    /**
     * Get the current tenant of the user's filament-tenants.
     */
    public function currentTenant(): BelongsTo
    {
        if ($this->current_tenant_id === null && $this->id) {
            $this->switchTenant($this->personalTenant());
        }

        return $this->belongsTo(FilamentTenants::tenantModel(), 'current_tenant_id');
    }

    /**
     * Switch the user's filament-tenants to the given tenant.
     */
    public function switchTenant(mixed $tenant): bool
    {
        if (! $this->belongsToTenant($tenant)) {
            return false;
        }

        $this->forceFill([
            'current_tenant_id' => $tenant->id,
        ])->save();

        $this->setRelation('currentTenant', $tenant);

        return true;
    }

    /**
     * Get all the tenants the user owns or belongs to.
     */
    public function allTenants(): Collection
    {
        return $this->ownedTenants->merge($this->tenants)->sortBy('name');
    }

    /**
     * Get all the tenants the user owns.
     */
    public function ownedTenants(): HasMany
    {
        return $this->hasMany(FilamentTenants::tenantModel());
    }

    /**
     * Get all the tenants the user belongs to.
     */
    public function tenants(): BelongsToMany
    {
        return $this->belongsToMany(FilamentTenants::tenantModel(), FilamentTenants::employeeshipModel())
            ->withPivot('role')
            ->withTimestamps()
            ->as('employeeship');
    }

    /**
     * Get the user's "personal" tenant.
     */
    public function personalTenant(): mixed
    {
        return $this->ownedTenants->where('personal_tenant', true)->first();
    }

    /**
     * Get the user's primary tenant.
     *
     * This will prioritize the personal tenant, but if none exists,
     * it will return the first available tenant the user belongs to.
     */
    public function primaryTenant(): mixed
    {
        return $this->personalTenant() ?? $this->allTenants()->first();
    }

    /**
     * Determine if the user has any tenants.
     */
    public function hasAnyTenants(): bool
    {
        return $this->allTenants()->isNotEmpty();
    }

    /**
     * Determine if the user owns the given tenant.
     */
    public function ownsTenant(mixed $tenant): bool
    {
        if ($tenant === null) {
            return false;
        }

        return $this->id === $tenant->{$this->getForeignKey()};
    }

    /**
     * Determine if the user belongs to the given tenant.
     */
    public function belongsToTenant(mixed $tenant): bool
    {
        if ($tenant === null) {
            return false;
        }

        return $this->ownsTenant($tenant) || $this->tenants->contains(static function ($t) use ($tenant) {
            return $t->id === $tenant->id;
        });
    }

    /**
     * Get the role that the user has on the tenant.
     */
    public function tenantRole(mixed $tenant): ?Role
    {
        if ($this->ownsTenant($tenant)) {
            return new OwnerRole;
        }

        if (! $this->belongsToTenant($tenant)) {
            return null;
        }

        $role = $tenant->users
            ->where('id', $this->id)
            ->first()
            ->employeeship
            ->role;

        return $role ? FilamentTenants::findRole($role) : null;
    }

    /**
     * Determine if the user has the given role on the given tenant.
     */
    public function hasTenantRole(mixed $tenant, string $role): bool
    {
        if ($this->ownsTenant($tenant)) {
            return true;
        }

        return $this->belongsToTenant($tenant) && FilamentTenants::findRole($tenant->users->where(
            'id',
            $this->id
        )->first()->employeeship->role)?->key === $role;
    }

    /**
     * Get the user's permissions for the given tenant.
     */
    public function tenantPermissions(mixed $tenant): array
    {
        if ($this->ownsTenant($tenant)) {
            return ['*'];
        }

        if (! $this->belongsToTenant($tenant)) {
            return [];
        }

        return (array) $this->tenantRole($tenant)?->permissions;
    }

    /**
     * Determine if the user has the given permission on the given tenant.
     */
    public function hasTenantPermission(mixed $tenant, string $permission): bool
    {
        if ($this->ownsTenant($tenant)) {
            return true;
        }

        if (! $this->belongsToTenant($tenant)) {
            return false;
        }

        if ($this->currentAccessToken() !== null &&
            ! $this->tokenCan($permission) &&
            in_array(HasApiTokens::class, class_uses_recursive($this), true)) {
            return false;
        }

        $permissions = $this->tenantPermissions($tenant);

        return in_array($permission, $permissions, true) ||
            in_array('*', $permissions, true) ||
            (Str::endsWith($permission, ':create') && in_array('*:create', $permissions, true)) ||
            (Str::endsWith($permission, ':update') && in_array('*:update', $permissions, true));
    }
}
