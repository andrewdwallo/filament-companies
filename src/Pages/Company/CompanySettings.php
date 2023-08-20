<?php

namespace Wallo\FilamentCompanies\Pages\Company;

use Filament\Facades\Filament;
use Filament\Pages\Tenancy\EditTenantProfile as BaseEditTenantProfile;

class CompanySettings extends BaseEditTenantProfile
{
    protected static string $view = 'filament-companies::filament.pages.companies.company_settings';

    public static function getLabel(): string
    {
        return __('filament-companies::default.pages.titles.company_settings');
    }

    protected function getViewData(): array
    {
        return [
            'company' => Filament::getTenant(),
        ];
    }
}
