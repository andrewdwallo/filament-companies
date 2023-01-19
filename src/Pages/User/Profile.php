<?php

namespace Wallo\FilamentCompanies\Pages\User;

use Filament\Pages\Page;

class Profile extends Page
{
    protected static ?string $slug = 'user/profile';

    protected static string $view = "filament-companies::filament.pages.user.profile";

    protected static bool $shouldRegisterNavigation = false;

    protected function getTitle(): string
    {
        return __('filament-companies::default.pages.titles.profile');
    }

    protected function getViewData(): array
    {
        return [
            'user' => auth()->user()
        ];
    }
}
