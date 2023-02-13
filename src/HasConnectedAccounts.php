<?php

namespace Wallo\FilamentCompanies;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

trait HasConnectedAccounts
{
    /**
     * Determine if the given connected account is the current connected account.
     *
     * @param  mixed  $connectedAccount
     * @return bool
     */
    public function isCurrentConnectedAccount(mixed $connectedAccount): bool
    {
        return $connectedAccount->id === $this->currentConnectedAccount->id;
    }

    /**
     * Get the current connected account of the user's context.
     *
     * @return BelongsTo
     */
    public function currentConnectedAccount(): BelongsTo
    {
        if (is_null($this->current_connected_account_id) && $this->id) {
            $this->switchConnectedAccount(
                $this->connectedAccounts()->orderBy('created_at')->first()
            );
        }

        return $this->belongsTo(Socialite::connectedAccountModel(), 'current_connected_account_id');
    }

    /**
     * Switch the user's context to the given connected account.
     *
     * @param  mixed  $connectedAccount
     * @return bool
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
     *
     * @param  mixed  $connectedAccount
     * @return bool
     */
    public function ownsConnectedAccount(mixed $connectedAccount): bool
    {
        return $this->id === optional($connectedAccount)->user_id;
    }

    /**
     * Determine if the user has a specific account type.
     *
     * @param string $provider
     * @return bool
     */
    public function hasTokenFor(string $provider): bool
    {
        return $this->connectedAccounts->contains('provider', Str::lower($provider));
    }

    /**
     * Attempt to retrieve the token for a given provider.
     *
     * @param string $provider
     * @param null $default
     * @return mixed
     */
    public function getTokenFor(string $provider, $default = null): mixed
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
     *
     * @param  string  $provider
     * @param  string  $id
     * @return ConnectedAccount
     */
    public function getConnectedAccountFor(string $provider, string $id): ConnectedAccount
    {
        return $this->connectedAccounts
            ->where('provider', $provider)
            ->where('provider_id', $id)
            ->first();
    }

    /**
     * Get all the connected accounts belonging to the user.
     *
     * @return HasMany
     */
    public function connectedAccounts(): HasMany
    {
        return $this->hasMany(Socialite::connectedAccountModel(), 'user_id', $this->getAuthIdentifierName());
    }
}
