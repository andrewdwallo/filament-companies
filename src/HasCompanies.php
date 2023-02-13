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
     *
     * @param  mixed  $company
     * @return bool
     */
    public function isCurrentCompany($company): bool
    {
        return $company->id === $this->currentCompany->id;
    }

    /**
     * Get the current company of the user's filament-companies.
     *
     * @return BelongsTo
     */
    public function currentCompany(): BelongsTo
    {
        if (is_null($this->current_company_id) && $this->id) {
            $this->switchCompany($this->personalCompany());
        }

        return $this->belongsTo(FilamentCompanies::companyModel(), 'current_company_id');
    }

    /**
     * Switch the user's filament-companies to the given company.
     *
     * @param  mixed  $company
     * @return bool
     */
    public function switchCompany($company): bool
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
     *
     * @return Collection
     */
    public function allCompanies(): Collection
    {
        return $this->ownedCompanies->merge($this->companies)->sortBy('name');
    }

    /**
     * Get all the companies the user owns.
     *
     * @return HasMany
     */
    public function ownedCompanies(): HasMany
    {
        return $this->hasMany(FilamentCompanies::companyModel());
    }

    /**
     * Get all the companies the user belongs to.
     *
     * @return BelongsToMany
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
     *
     * @return \App\Models\Company
     */
    public function personalCompany(): \App\Models\Company
    {
        return $this->ownedCompanies->where('personal_company', true)->first();
    }

    /**
     * Determine if the user owns the given company.
     *
     * @param  mixed  $company
     * @return bool
     */
    public function ownsCompany($company): bool
    {
        if (is_null($company)) {
            return false;
        }

        return $this->id === $company->{$this->getForeignKey()};
    }

    /**
     * Determine if the user belongs to the given company.
     *
     * @param  mixed  $company
     * @return bool
     */
    public function belongsToCompany($company): bool
    {
        if (is_null($company)) {
            return false;
        }

        return $this->ownsCompany($company) || $this->companies->contains(function ($t) use ($company) {
            return $t->id === $company->id;
        });
    }

    /**
     * Get the role that the user has on the company.
     *
     * @param  mixed  $company
     * @return Role|null
     */
    public function companyRole($company): Role|null
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
     *
     * @param  mixed  $company
     * @param  string  $role
     * @return bool
     */
    public function hasCompanyRole($company, string $role): bool
    {
        if ($this->ownsCompany($company)) {
            return true;
        }

        return $this->belongsToCompany($company) && optional(FilamentCompanies::findRole($company->users->where(
            'id', $this->id
        )->first()->employeeship->role))->key === $role;
    }

    /**
     * Get the user's permissions for the given company.
     *
     * @param  mixed  $company
     * @return array
     */
    public function companyPermissions($company): array
    {
        if ($this->ownsCompany($company)) {
            return ['*'];
        }

        if (! $this->belongsToCompany($company)) {
            return [];
        }

        return (array) optional($this->companyRole($company))->permissions;
    }

    /**
     * Determine if the user has the given permission on the given company.
     *
     * @param  mixed  $company
     * @param  string  $permission
     * @return bool
     */
    public function hasCompanyPermission($company, string $permission): bool
    {
        if ($this->ownsCompany($company)) {
            return true;
        }

        if (! $this->belongsToCompany($company)) {
            return false;
        }

        $hasPermission = $this->tokenCan($permission);
        $hasApiTokens = in_array(HasApiTokens::class, class_uses_recursive($this), true);
        $hasAccessToken = $this->currentAccessToken() !== null;

        if (!$hasPermission && $hasApiTokens && $hasAccessToken) {
            return false;
        }

        $permissions = $this->companyPermissions($company);

        $hasDirectPermission = in_array($permission, $permissions, true);
        $hasWildcardPermission = in_array('*', $permissions, true);
        $hasCreatePermission = Str::endsWith($permission, ':create') && in_array('*:create', $permissions, true);
        $hasUpdatePermission = Str::endsWith($permission, ':update') && in_array('*:update', $permissions, true);

        return $hasDirectPermission || $hasWildcardPermission || $hasCreatePermission || $hasUpdatePermission;
    }
}
