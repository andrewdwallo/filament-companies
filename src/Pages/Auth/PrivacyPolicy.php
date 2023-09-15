<?php

namespace Wallo\FilamentCompanies\Pages\Auth;

use Filament\Facades\Filament;
use Filament\Pages\Concerns\HasRoutes;
use Filament\Pages\SimplePage;
use Illuminate\Support\Str;
use Wallo\FilamentCompanies\FilamentCompanies;

class PrivacyPolicy extends SimplePage
{
    use HasRoutes;

    protected static string $view = 'filament-companies::auth.policy';

    protected function getViewData(): array
    {
        $policyFile = FilamentCompanies::localizedMarkdownPath('policy.md');

        return [
            'policy' => Str::markdown(file_get_contents($policyFile)),
        ];
    }

    public static function getSlug(): string
    {
        return 'privacy-policy';
    }

    public static function getRouteName(?string $panel = null): string
    {
        $panel ??= Filament::getCurrentPanel()?->getId();

        return (string) str(static::getSlug())
            ->replace('/', '.')
            ->prepend("filament.{$panel}.auth.");
    }
}
