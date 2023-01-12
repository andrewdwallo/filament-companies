<?php

namespace Wallo\FilamentCompanies\Pages\Companies;

use Filament\Pages\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Wallo\FilamentCompanies\FilamentCompanies;

class CompanySettings extends Page
{
    protected static string $view = "filament-companies::filament.pages.companies.company_settings";

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static bool $shouldRegisterNavigation = false;

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

        return view($this->view, [
            'user' => $request->user(),
            'company' => $company,
        ]);
    }

    protected function getTitle(): string
    {
        return __('filament-companies::default.pages.titles.company_settings');
    }

    protected function getViewData(): array
    {
        return [
            'company' => auth()->user()->currentCompany
        ];
    }
}
