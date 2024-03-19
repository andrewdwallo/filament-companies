<?php

namespace Wallo\FilamentCompanies\Concerns\Base;

trait HasAddedProfileComponents
{
    public static array $addedProfileComponents = [];

    public function addProfileComponents(array $componentsWithSortOrder): static
    {
        foreach ($componentsWithSortOrder as $sort => $component) {
            static::$addedProfileComponents[] = $component;
            static::$componentSortOrder[$component] = $sort;
        }

        return $this;
    }

    /**
     * Get the added profile page components.
     */
    public static function getAddedProfileComponents(): array
    {
        return static::$addedProfileComponents;
    }
}
