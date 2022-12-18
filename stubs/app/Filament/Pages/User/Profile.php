<?php

namespace App\Filament\Pages\User;

use Filament\Pages\Page;

class Profile extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.user.profile';

    protected static ?string $slug = 'user/profile';

    protected static function shouldRegisterNavigation(): bool
    {
        return config('filament-companies.show_profile_page_in_navbar');
    }
}
