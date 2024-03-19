<?php

namespace Wallo\FilamentCompanies\Concerns\Base;

trait HasModals
{
    /**
     * The configuration for the modals.
     */
    public static array $modals = [];

    /**
     * Get the modals' configuration.
     */
    public function modals(string $width = '2xl', string $alignment = 'center', string $formActionsAlignment = 'center', bool $cancelButtonAction = false): static
    {
        static::$modals = compact('width', 'alignment', 'formActionsAlignment', 'cancelButtonAction');

        return $this;
    }

    /**
     * Get the modals' configuration.
     */
    public static function getModals(): array
    {
        return static::$modals;
    }
}
