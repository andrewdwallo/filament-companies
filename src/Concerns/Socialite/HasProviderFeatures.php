<?php

namespace Wallo\FilamentCompanies\Concerns\Socialite;

use InvalidArgumentException;
use ValueError;
use Wallo\FilamentCompanies\Enums\Feature;

trait HasProviderFeatures
{
    public static array $enabledFeatures = [];

    public function setFeatures(?array $features = null): static
    {
        if ($features !== null) {
            foreach ($features as $feature) {
                try {
                    $featureEnum = $feature instanceof Feature ? $feature : Feature::from($feature);
                    static::$enabledFeatures[] = $featureEnum;
                } catch (ValueError) {
                    throw new InvalidArgumentException("Invalid feature specified: {$feature}");
                }
            }
        }

        return $this;
    }

    /**
     * Check if the given feature is enabled.
     */
    public static function isFeatureEnabled(Feature | string $feature): bool
    {
        try {
            $featureEnum = $feature instanceof Feature ? $feature : Feature::from($feature);

            return in_array($featureEnum, static::$enabledFeatures, true);
        } catch (ValueError) {
            return false;
        }
    }

    /**
     * Get all the socialite features and whether the application supports them.
     *
     * @return string[]
     */
    public static function enabledFeatures(): array
    {
        return array_map(static fn (Feature $feature) => $feature->value, static::$enabledFeatures);
    }
}
