<?php

namespace Wallo\FilamentCompanies\Actions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;

class ValidateCompanyDeletion
{
    /**
     * Validate that the company can be deleted by the given user.
     *
     * @throws AuthorizationException
     */
    public function validate(mixed $user, mixed $company): void
    {
        Gate::forUser($user)->authorize('delete', $company);

        if ($company->personal_company) {
            throw ValidationException::withMessages([
                'company' => __('filament-companies::default.errors.company_deletion'),
            ])->errorBag('deleteCompany');
        }
    }
}
