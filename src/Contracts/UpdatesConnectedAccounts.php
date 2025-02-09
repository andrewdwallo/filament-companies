<?php

namespace Wallo\FilamentTenants\Contracts;

use Illuminate\Contracts\Auth\Authenticatable;
use Laravel\Socialite\Contracts\User;
use Wallo\FilamentTenants\ConnectedAccount;

interface UpdatesConnectedAccounts
{
    /**
     * Update a given connected account.
     */
    public function update(Authenticatable $user, ConnectedAccount $connectedAccount, string $provider, User $providerUser): ConnectedAccount;
}
