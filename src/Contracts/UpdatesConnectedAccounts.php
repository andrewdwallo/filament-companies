<?php

namespace Wallo\FilamentCompanies\Contracts;

use Illuminate\Contracts\Auth\Authenticatable;
use Laravel\Socialite\Contracts\User;
use Wallo\FilamentCompanies\ConnectedAccount;

interface UpdatesConnectedAccounts
{
    /**
     * Update a given connected account.
     */
    public function update(Authenticatable $user, ConnectedAccount $connectedAccount, string $provider, User $providerUser): ConnectedAccount;
}
