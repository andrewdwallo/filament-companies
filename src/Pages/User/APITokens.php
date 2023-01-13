<?php

namespace Wallo\FilamentCompanies\Pages\User;

use Closure;
use Filament\Pages\Page;
use Wallo\FilamentCompanies\FilamentCompanies;

class APITokens extends Page
{
    protected static ?string $slug = 'user/api-tokens';

    protected static string $view = "filament-companies::filament.pages.user.api-tokens";

    protected static bool $shouldRegisterNavigation = false;

    protected function getTitle(): string
    {
        return __('filament-companies::default.pages.titles.api_tokens');
    }

    public function mount(): void
    {
        abort_unless(FilamentCompanies::hasApiFeatures(), 403);
    }
}
