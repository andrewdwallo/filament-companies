<?php

namespace Wallo\FilamentCompanies\Concerns\Socialite;

use App\Models\ConnectedAccount;

trait HasConnectedAccountModel
{
    /**
     * The user model that should be used by FilamentCompanies.
     */
    public static string $connectedAccountModel = ConnectedAccount::class;

    /**
     * Get the name of the connected account model used by the application.
     */
    public static function connectedAccountModel(): string
    {
        return static::$connectedAccountModel;
    }

    /**
     * Get a new instance of the connected account model.
     */
    public static function newConnectedAccountModel(): mixed
    {
        $model = static::connectedAccountModel();

        return new $model;
    }

    /**
     * Specify the connected account model that should be used by FilamentCompanies.
     */
    public static function useConnectedAccountModel(string $model): static
    {
        static::$connectedAccountModel = $model;

        return new static;
    }

    /**
     * Find a connected account instance for a given provider and provider ID.
     */
    public static function findConnectedAccountForProviderAndId(string $provider, string $providerId): mixed
    {
        return static::newConnectedAccountModel()
            ->where('provider', $provider)
            ->where('provider_id', $providerId)
            ->first();
    }
}
