<?php

namespace Wallo\FilamentCompanies\Concerns\Socialite;

use InvalidArgumentException;
use ValueError;
use Wallo\FilamentCompanies\Enums\Provider;

trait HasProviders
{
    public static array $enabledProviders = [];

    public function setProviders(?array $providers = null): static
    {
        if ($providers !== null) {
            foreach ($providers as $provider) {
                try {
                    $providerEnum = $provider instanceof Provider ? $provider : Provider::from($provider);
                    static::$enabledProviders[] = $providerEnum;
                } catch (ValueError) {
                    throw new InvalidArgumentException("Invalid provider specified: {$provider}");
                }
            }
        }

        return $this;
    }

    /**
     * Check if the given provider is enabled.
     */
    public static function isProviderEnabled(Provider | string $provider): bool
    {
        try {
            $providerEnum = $provider instanceof Provider ? $provider : Provider::from($provider);

            return in_array($providerEnum, static::$enabledProviders, true);
        } catch (ValueError) {
            return false;
        }
    }

    /**
     * Get all the socialite providers and whether the application supports them.
     *
     * @return string[]
     */
    public static function enabledProviders(): array
    {
        return array_map(static fn (Provider $provider) => $provider->value, static::$enabledProviders);
    }
}
