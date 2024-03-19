<?php

namespace Wallo\FilamentCompanies\Pages\Auth;

use Filament\Pages\Concerns\HasRoutes;
use Filament\Pages\SimplePage;
use Filament\Support\Enums\MaxWidth;
use Illuminate\Contracts\Support\Htmlable;
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

    public function getHeading(): string | Htmlable
    {
        return '';
    }

    public function getMaxWidth(): MaxWidth | string | null
    {
        return MaxWidth::TwoExtraLarge;
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
