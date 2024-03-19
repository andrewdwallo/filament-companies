<?php

namespace Wallo\FilamentCompanies\Concerns\Socialite;

use Closure;

trait CanEnableSocialite
{
    /**
     * Determine if the application is using any socialite features.
     */
    public static bool $hasSocialiteFeatures = false;

    /**
     * Determine if the application supports socialite.
     */
    public function socialite(bool | Closure | null $condition = true, ?array $providers = null, ?array $features = null): static
    {
        $this->enableSocialite($condition);
        $this->setProviders($providers);
        $this->setFeatures($features);

        return $this;
    }

    public function enableSocialite(bool | Closure | null $condition = true): static
    {
        $isEnabled = $condition instanceof Closure ? $condition() : $condition;
        static::$hasSocialiteFeatures = $isEnabled;

        if (! $isEnabled) {
            static::disableAllSocialiteFeatures();
        }

        return $this;
    }

    private static function disableAllSocialiteFeatures(): void
    {
        static::$hasSocialiteFeatures = false;
        static::$canSetPasswords = false;
        static::$canManageConnectedAccounts = false;
    }

    /**
     * Determine if the application has support for socialite.
     */
    public static function hasSocialiteFeatures(): bool
    {
        return static::$hasSocialiteFeatures;
    }
}
