<?php

namespace Wallo\FilamentCompanies\Pages\User;

use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

class Profile extends Page
{
    protected static string $view = 'filament-companies::filament.pages.user.profile';

    protected static bool $shouldRegisterNavigation = false;

    public function getTitle(): string
    {
        return __('filament-companies::default.pages.titles.profile');
    }

    protected function getViewData(): array
    {
        return [
            'user' => Auth::user(),
        ];
    }
}
