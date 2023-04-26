<?php

namespace Wallo\FilamentCompanies;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

abstract class Company extends Model
{
    /**
     * Get the owner of the company.
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(FilamentCompanies::userModel(), 'user_id');
    }

    /**
     * Get all the company's users including its owner.
     */
    public function allUsers(): Collection
    {
        return $this->users->merge([$this->owner]);
    }

    /**
     * Get all the users that belong to the company.
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(FilamentCompanies::userModel(), FilamentCompanies::employeeshipModel())
                        ->withPivot('role')
                        ->withTimestamps()
                        ->as('employeeship');
    }

    /**
     * Determine if the given user belongs to the company.
     */
    public function hasUser(mixed $user): bool
    {
        return $this->users->contains($user) || $user->ownsCompany($this);
    }

    /**
     * Determine if the given email address belongs to a user on the company.
     */
    public function hasUserWithEmail(string $email): bool
    {
        return $this->allUsers()->contains(static function ($user) use ($email) {
            return $user->email === $email;
        });
    }

    /**
     * Determine if the given user has the given permission on the company.
     */
    public function userHasPermission(mixed $user, string $permission): bool
    {
        return $user->hasCompanyPermission($this, $permission);
    }

    /**
     * Get all the pending user invitations for the company.
     */
    public function companyInvitations(): HasMany
    {
        return $this->hasMany(FilamentCompanies::companyInvitationModel());
    }

    /**
     * Remove the given user from the company.
     */
    public function removeUser(mixed $user): void
    {
        if ($user->current_company_id === $this->id) {
            $user->forceFill([
                'current_company_id' => null,
            ])->save();
        }

        $this->users()->detach($user);
    }

    /**
     * Purge all the company's resources.
     */
    public function purge(): void
    {
        $this->owner()->where('current_company_id', $this->id)
                ->update(['current_company_id' => null]);

        $this->users()->where('current_company_id', $this->id)
                ->update(['current_company_id' => null]);

        $this->users()->detach();

        $this->delete();
    }
}
