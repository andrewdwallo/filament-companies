<?php

namespace Wallo\FilamentCompanies\Actions;

use Filament\Notifications\Notification;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Wallo\FilamentCompanies\Events\CompanyEmployeeUpdated;
use Wallo\FilamentCompanies\FilamentCompanies;
use Wallo\FilamentCompanies\Rules\Role;

class UpdateCompanyEmployeeRole
{
    /**
     * Update the role for the given company employee.
     *
     * @throws AuthorizationException
     */
    public function update(mixed $user, mixed $company, int $companyEmployeeId, string $role): void
    {
        Gate::forUser($user)->authorize('updateCompanyEmployee', $company);

        Validator::make(compact('role'), [
            'role' => ['required', 'string', new Role],
        ])->validate();

        $company->users()->updateExistingPivot($companyEmployeeId, compact('role'));

        CompanyEmployeeUpdated::dispatch($company->fresh(), FilamentCompanies::findUserByIdOrFail($companyEmployeeId));
    }
}
