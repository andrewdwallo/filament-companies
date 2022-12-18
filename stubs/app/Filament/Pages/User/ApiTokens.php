<?php

namespace App\Filament\Pages\User;

use Filament\Pages\Page;

class ApiTokens extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.user.api-tokens';

    protected static bool $shouldRegisterNavigation = false;
}
