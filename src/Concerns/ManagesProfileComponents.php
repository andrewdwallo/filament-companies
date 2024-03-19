<?php

namespace Wallo\FilamentCompanies\Concerns;

trait ManagesProfileComponents
{
    public static array $componentSortOrder = [];

    /**
     * Get the profile page components.
     */
    public static function getProfileComponents(): array
    {
        $featureComponents = static::getBaseProfileComponents();
        $socialiteComponents = static::getSocialiteComponents();
        $addedComponents = static::getAddedProfileComponents();

        $components = [...$featureComponents, ...$socialiteComponents, ...$addedComponents];

        usort($components, static function ($a, $b) {
            return static::$componentSortOrder[$a] <=> static::$componentSortOrder[$b];
        });

        return $components;
    }
}
