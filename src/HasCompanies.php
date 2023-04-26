<?php

namespace Wallo\FilamentCompanies;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

trait HasCompanies
{
    /**
     * Determine if the given company is the current company.
     */
    public function isCurrentCompany(mixed $company): bool
    {
        return $company->id === $this->currentCompany->id;
    }

    /**
     * Get the current company of the user's filament-companies.
     */
    public function currentCompany(): BelongsTo
    {
        if ($this->current_company_id === null && $this->id) {
            $this->switchCompany($this->personalCompany());
        }

        return $this->belongsTo(FilamentCompanies::companyModel(), 'current_company_id');
    }

    /**
     * Switch the user's filament-companies to the given company.
     */
    public function switchCompany(mixed $company): bool
    {
        if (! $this->belongsToCompany($company)) {
            return false;
        }

        $this->forceFill([
            'current_company_id' => $company->id,
        ])->save();

        $this->setRelation('currentCompany', $company);

        return true;
    }

    /**
     * Get all the companies the user owns or belongs to.
     */
    public function allCompanies(): Collection
    {
        return $this->ownedCompanies->merge($this->companies)->sortBy('name');
    }

    /**
     * Get all the companies the user owns.
     */
    public function ownedCompanies(): HasMany
    {
        return $this->hasMany(FilamentCompanies::companyModel());
    }

    /**
     * Get all the companies the user belongs to.
     */
    public function companies(): BelongsToMany
    {
        return $this->belongsToMany(FilamentCompanies::companyModel(), FilamentCompanies::employeeshipModel())
                        ->withPivot('role')
                        ->withTimestamps()
                        ->as('employeeship');
    }

    /**
     * Get the user's "personal" company.
     */
    public function personalCompany(): mixed
    {
        return $this->ownedCompanies->where('personal_company', true)->first();
    }

    /**
     * Determine if the user owns the given company.
     */
    public function ownsCompany(mixed $company): bool
    {
        if ($company === null) {
            return false;
        }

        return $this->id === $company->{$this->getForeignKey()};
    }

    /**
     * Determine if the user belongs to the given company.
     */
    public function belongsToCompany(mixed $company): bool
    {
        if ($company === null) {
            return false;
        }

        return $this->ownsCompany($company) || $this->companies->contains(static function ($t) use ($company) {
            return $t->id === $company->id;
        });
    }

    /**
     * Get the role that the user has on the company.
     */
    public function companyRole(mixed $company): Role|null
    {
        if ($this->ownsCompany($company)) {
            return new OwnerRole;
        }

        if (! $this->belongsToCompany($company)) {
            return null;
        }

        $role = $company->users
            ->where('id', $this->id)
            ->first()
            ->employeeship
            ->role;

        return $role ? FilamentCompanies::findRole($role) : null;
    }

    /**
     * Determine if the user has the given role on the given company.
     */
    public function hasCompanyRole(mixed $company, string $role): bool
    {
        if ($this->ownsCompany($company)) {
            return true;
        }

        return $this->belongsToCompany($company) && FilamentCompanies::findRole($company->users->where(
            'id', $this->id
        )->first()->employeeship->role)?->key === $role;
    }

    /**
     * Get the user's permissions for the given company.
     */
    public function companyPermissions(mixed $company): array
    {
        if ($this->ownsCompany($company)) {
            return ['*'];
        }

        if (! $this->belongsToCompany($company)) {
            return [];
        }

        return (array) $this->companyRole($company)?->permissions;
    }

    /**
     * Determine if the user has the given permission on the given company.
     */
    public function hasCompanyPermission(mixed $company, string $permission): bool
    {
        if ($this->ownsCompany($company)) {
            return true;
        }

        if (! $this->belongsToCompany($company)) {
            return false;
        }

        if (in_array(HasApiTokens::class, class_uses_recursive($this), true) &&
            ! $this->tokenCan($permission) &&
            $this->currentAccessToken() !== null) {
            return false;
        }

        $permissions = $this->companyPermissions($company);

        return in_array($permission, $permissions, true) ||
            in_array('*', $permissions, true) ||
            (Str::endsWith($permission, ':create') && in_array('*:create', $permissions, true)) ||
            (Str::endsWith($permission, ':update') && in_array('*:update', $permissions, true));
    }
}
