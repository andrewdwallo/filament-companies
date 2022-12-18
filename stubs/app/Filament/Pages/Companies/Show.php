<?php

namespace App\Filament\Pages\Companies;

use Filament\Pages\Page;

class Show extends Page
{

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.companies.show';

    protected static bool $shouldRegisterNavigation = false;
}
