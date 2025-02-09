<?php

namespace Wallo\FilamentTenants\Pages\User;

use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

class Profile extends Page
{
    protected static string $view = 'filament-tenants::filament.pages.user.profile';

    protected static bool $shouldRegisterNavigation = false;

    public function getTitle(): string
    {
        return __('filament-tenants::default.pages.titles.profile');
    }

    protected function getViewData(): array
    {
        return [
            'user' => Auth::user(),
        ];
    }
}
