<?php

namespace Wallo\FilamentCompanies\Pages\Auth;

use Filament\Pages\Concerns\HasRoutes;
use Filament\Pages\SimplePage;
use Illuminate\Support\Str;
use Wallo\FilamentCompanies\FilamentCompanies;

class Terms extends SimplePage
{
    use HasRoutes;

    protected static string $view = 'filament-companies::auth.terms';

    protected function getViewData(): array
    {
        $termsFile = FilamentCompanies::localizedMarkdownPath('terms.md');

        return [
           'terms' => Str::markdown(file_get_contents($termsFile)),
        ];
    }

    public static function getSlug(): string
    {
        return static::$slug ?? 'terms-of-service';
    }

    public static function getRouteName(): string
    {
        return 'auth.terms';
    }
}
