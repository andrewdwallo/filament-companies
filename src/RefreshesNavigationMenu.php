<?php

namespace Wallo\FilamentCompanies;

use Illuminate\Support\Facades\Blade;

trait RefreshesNavigationMenu
{
    /**
     * Refresh the navigation menu.
     */
    protected function refreshNavigationMenu(): void
    {
        $navigationMenu = Blade::render('<x-filament-companies::dropdown.navigation-menu />');
        $this->dispatchBrowserEvent('refresh-navigation-menu', ['content' => $navigationMenu]);
    }
}