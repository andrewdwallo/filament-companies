<?php

namespace Wallo\FilamentCompanies\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Wallo\FilamentCompanies\FilamentCompanies;

class CurrentCompanyController extends Controller
{
    /**
     * Update the authenticated user's current company.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $company = FilamentCompanies::newCompanyModel()->findOrFail($request->company_id);

        if (! $request->user()->switchCompany($company)) {
            abort(403);
        }

        return back();
    }
}
