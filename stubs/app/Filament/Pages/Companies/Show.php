<?php

namespace App\Filament\Pages\Companies;

use Filament\Pages\Page;

class Show extends Page
{
    protected static ?string $slug = 'show';

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.companies.show';

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
}
