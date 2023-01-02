<?php

namespace App\Filament\Pages\Companies;

use Filament\Pages\Page;

class Show extends Page
{
    protected static ?string $title = 'Company Settings';

    protected static ?string $slug = 'show';

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.companies.show';

    protected static bool $shouldRegisterNavigation = false;

    protected function getViewData(): array
    {
        return [
            'company' => auth()->user()->currentCompany
        ];
    }
}
