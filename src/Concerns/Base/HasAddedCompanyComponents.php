<?php

namespace Wallo\FilamentCompanies\Concerns\Base;

trait HasAddedCompanyComponents
{
    public static array $addedCompanyComponents = [];

    public function addCompanyComponents(array $componentsWithSortOrder): static
    {
        foreach ($componentsWithSortOrder as $sort => $component) {
            static::$addedCompanyComponents[] = $component;
            static::$companyComponentSortOrder[$component] = $sort;
        }

        return $this;
    }

    /**
     * Get the added company page components.
     */
    public static function getAddedCompanyComponents(): array
    {
        return static::$addedCompanyComponents;
    }
}
