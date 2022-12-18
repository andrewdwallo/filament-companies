<?php

namespace App\Actions\FilamentCompanies;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Wallo\FilamentCompanies\Contracts\CreatesCompanies;
use Wallo\FilamentCompanies\Events\AddingCompany;
use Wallo\FilamentCompanies\FilamentCompanies;

class CreateCompany implements CreatesCompanies
{
    /**
     * Validate and create a new company for the given user.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return mixed
     */
    public function create($user, array $input)
    {
        Gate::forUser($user)->authorize('create', FilamentCompanies::newCompanyModel());

        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
        ])->validateWithBag('createCompany');

        AddingCompany::dispatch($user);

        $user->switchCompany($company = $user->ownedCompanies()->create([
            'name' => $input['name'],
            'personal_company' => false,
        ]));

        return $company;
    }
}
