<?php

namespace Wallo\FilamentCompanies\Pages\Companies;

use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Wallo\FilamentCompanies\FilamentCompanies;

class CreateCompany extends Page
{
    public mixed $company;

    protected static string $view = 'filament-companies::filament.pages.companies.create_company';

    protected static bool $shouldRegisterNavigation = false;

    protected function getTitle(): string
    {
        return __('filament-companies::default.pages.titles.create_company');
    }

    public function mount(): void
    {
        Gate::authorize('create', FilamentCompanies::newCompanyModel());
        $this->company = Auth::user()->currentCompany;
    }

    public static function getSlug(): string
    {
        return 'companies/create';
    }
}
