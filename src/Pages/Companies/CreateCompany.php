<?php

namespace Wallo\FilamentCompanies\Pages\Companies;

use Filament\Pages\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Wallo\FilamentCompanies\FilamentCompanies;

class CreateCompany extends Page
{
    protected static string $view = "filament-companies::filament.pages.companies.create_company";

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static bool $shouldRegisterNavigation = false;

    /**
     * Show the company creation screen.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        Gate::authorize('create', FilamentCompanies::newCompanyModel());

        return view($this->view, [
            'user' => $request->user(),
        ]);
    }

    protected function getTitle(): string
    {
        return __('filament-companies::default.pages.titles.create_company');
    }
}
