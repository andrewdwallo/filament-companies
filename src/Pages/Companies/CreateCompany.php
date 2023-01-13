<?php

namespace Wallo\FilamentCompanies\Pages\Companies;

use Closure;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Route;
use Wallo\FilamentCompanies\FilamentCompanies;

class CreateCompany extends Page
{
    protected static ?string $slug = 'companies/create-company';

    protected static string $view = "filament-companies::filament.pages.companies.create_company";

    protected static bool $shouldRegisterNavigation = false;

    protected function getTitle(): string
    {
        return __('filament-companies::default.pages.titles.create_company');
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
