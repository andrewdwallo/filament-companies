<?php

namespace Wallo\FilamentCompanies\Concerns;

trait ManagesCompanyComponents
{
    public static array $companyComponentSortOrder = [];

    /**
     * Get the company page components.
     */
    public static function getCompanyComponents(): array
    {
        $featureComponents = static::getBaseCompanyComponents();
        $addedComponents = static::getAddedCompanyComponents();

        $components = [...$featureComponents, ...$addedComponents];

        usort($components, static function ($a, $b) {
            return static::$companyComponentSortOrder[$a] <=> static::$companyComponentSortOrder[$b];
        });

        return $components;
    }
}
