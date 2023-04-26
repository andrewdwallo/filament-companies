<?php

namespace Wallo\FilamentCompanies\Pages\Companies;

use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Wallo\FilamentCompanies\FilamentCompanies;

class CompanySettings extends Page
{
    public mixed $company;

    protected static string $view = 'filament-companies::filament.pages.companies.company_settings';

    protected static bool $shouldRegisterNavigation = false;

    protected function getTitle(): string
    {
        return __('filament-companies::default.pages.titles.company_settings');
    }

    public function mount(): void
    {
        $company = FilamentCompanies::newCompanyModel()->findOrFail($this->company);
        abort_if(Gate::denies('view', $company), 403);
        $this->company = Auth::user()->currentCompany;
    }

    public static function getSlug(): string
    {
        return 'companies/{company}';
    }
}
