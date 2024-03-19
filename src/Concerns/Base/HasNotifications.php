<?php

namespace Wallo\FilamentCompanies\Concerns\Base;

use Closure;

trait HasNotifications
{
    /**
     * Determine if the application is using notifications.
     */
    public static bool $hasNotificationsFeature = true;

    /**
     * Determine if the application is using notifications.
     */
    public function notifications(bool | Closure | null $condition = true): static
    {
        static::$hasNotificationsFeature = $condition instanceof Closure ? $condition() : $condition;

        return $this;
    }

    /**
     * Determine if the application is using notifications.
     */
    public static function hasNotificationsFeature(): bool
    {
        return static::$hasNotificationsFeature;
    }
}
