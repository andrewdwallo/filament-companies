<?php

namespace Wallo\FilamentCompanies\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Livewire\Redirector;
use Wallo\FilamentCompanies\FilamentCompanies;

class CurrentCompanyController extends Controller
{
    /**
     * Update the authenticated user's current company.
     */
    public function update(Request $request): Redirector|RedirectResponse
    {
        $company = FilamentCompanies::newCompanyModel()->findOrFail($request->company_id);

        if (! $request->user()->switchCompany($company)) {
            abort(403);
        }

        return back(303);
    }
}
