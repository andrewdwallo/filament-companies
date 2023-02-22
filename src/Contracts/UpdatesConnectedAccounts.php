<?php

namespace Wallo\FilamentCompanies\Contracts;

use Laravel\Socialite\Contracts\User;
use Wallo\FilamentCompanies\ConnectedAccount;

interface UpdatesConnectedAccounts
{
    /**
     * Update a given connected account.
     */
    public function update(mixed $user, ConnectedAccount $connectedAccount, string $provider, User $providerUser): ConnectedAccount;
}
