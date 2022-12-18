<?php

namespace Wallo\FilamentCompanies\Http\Controllers\Livewire;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Wallo\FilamentCompanies\FilamentCompanies;

class CompanyController extends Controller
{
    /**
     * Show the company management screen.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $companyId
     * @return \Illuminate\View\View
     */
    public function show(Request $request, $companyId)
    {
        $company = FilamentCompanies::newCompanyModel()->findOrFail($companyId);

        if (Gate::denies('view', $company)) {
            abort(403);
        }

        return view('filament.pages.company.settings', [
            'user' => $request->user(),
            'company' => $company,
        ]);
    }

    /**
     * Show the company creation screen.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        Gate::authorize('create', FilamentCompanies::newCompanyModel());

        return view('filament.pages.company.settings', [
            'user' => $request->user(),
        ]);
    }
}
