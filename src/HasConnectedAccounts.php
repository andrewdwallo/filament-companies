<?php

namespace Wallo\FilamentCompanies;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

trait HasConnectedAccounts
{
    /**
     * Determine if the given connected account is the current connected account.
     */
    public function isCurrentConnectedAccount(mixed $connectedAccount): bool
    {
        return $connectedAccount->id === $this->currentConnectedAccount->id;
    }

    /**
     * Get the current connected account of the user's context.
     */
    public function currentConnectedAccount(): BelongsTo
    {
        if ($this->current_connected_account_id === null && $this->id) {
            $this->switchConnectedAccount(
                $this->connectedAccounts()->orderBy('created_at')->first()
            );
        }

        return $this->belongsTo(Socialite::connectedAccountModel(), 'current_connected_account_id');
    }

    /**
     * Switch the user's context to the given connected account.
     */
    public function switchConnectedAccount(mixed $connectedAccount): bool
    {
        if (! $this->ownsConnectedAccount($connectedAccount)) {
            return false;
        }

        $this->forceFill([
            'current_connected_account_id' => $connectedAccount->id,
        ])->save();

        $this->setRelation('currentConnectedAccount', $connectedAccount);

        return true;
    }

    /**
     * Determine if the user owns the given connected account.
     */
    public function ownsConnectedAccount(mixed $connectedAccount): bool
    {
        return $this->id === $connectedAccount->user_id;
    }

    /**
     * Determine if the user has a specific account type.
     */
    public function hasTokenFor(string $provider): bool
    {
        return $this->connectedAccounts->contains('provider', Str::lower($provider));
    }

    /**
     * Attempt to retrieve the token for a given provider.
     */
    public function getTokenFor(string $provider, string|null $default = null): string|null
    {
        if ($this->hasTokenFor($provider)) {
            return $this->connectedAccounts
                ->where('provider', Str::lower($provider))
                ->first()
                ->token;
        }

        return $default;
    }

    /**
     * Attempt to find a connected account that belongs to the user,
     * for the given provider and ID.
     */
    public function getConnectedAccountFor(string $provider, string $id): mixed
    {
        return $this->connectedAccounts
            ->where('provider', $provider)
            ->where('provider_id', $id)
            ->first();
    }

    /**
     * Get all the connected accounts belonging to the user.
     */
    public function connectedAccounts(): HasMany
    {
        return $this->hasMany(Socialite::connectedAccountModel(), 'user_id', $this->getAuthIdentifierName());
    }
}
