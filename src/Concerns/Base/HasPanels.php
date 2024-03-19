<?php

namespace Wallo\FilamentCompanies\Concerns\Base;

use Filament\Facades\Filament;

trait HasPanels
{
    /**
     * The user panel.
     */
    public static ?string $userPanel = null;

    /**
     * Set the user panel.
     */
    public function userPanel(string $panel): static
    {
        static::$userPanel = $panel;

        return $this;
    }

    /**
     * Get the user panel configuration.
     */
    public static function getUserPanel(): string
    {
        return static::$userPanel;
    }

    /**
     * Determine if the user panel is set.
     */
    public static function hasUserPanel(): bool
    {
        return static::$userPanel !== null;
    }

    /**
     * Get the panel where the plugin is registered (The company panel).
     */
    public static function getCompanyPanel(): ?string
    {
        foreach (Filament::getPanels() as $panel) {
            if ($panel->hasPlugin('companies')) {
                return $panel->getId();
            }
        }

        return null;
    }
}
