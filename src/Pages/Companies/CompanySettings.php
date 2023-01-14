<?php

namespace Wallo\FilamentCompanies\Pages\Companies;

use Closure;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Route;
use Wallo\FilamentCompanies\FilamentCompanies;

class CompanySettings extends Page
{
    protected static ?string $slug = 'companies/company-settings';

    protected static string $view = "filament-companies::filament.pages.companies.company_settings";

    protected static bool $shouldRegisterNavigation = false;

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

    public function mount(): void
    {
        abort_unless(FilamentCompanies::hasCompanyFeatures(), 403);
    }
}
