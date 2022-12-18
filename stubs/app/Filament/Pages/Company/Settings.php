<?php

namespace App\Filament\Pages\Company;

use Filament\Pages\Page;

class Settings extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.company.settings';

    protected static ?string $slug = 'company/settings';

    protected static function shouldRegisterNavigation(): bool
    {
        return config('filament-companies.show_company_settings_page_in_navbar');
    }

}
