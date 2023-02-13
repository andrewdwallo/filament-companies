<?php

namespace Wallo\FilamentCompanies\Contracts;

use Wallo\FilamentCompanies\ConnectedAccount;
use Laravel\Socialite\Contracts\User;

interface UpdatesConnectedAccounts
{
    /**
     * Update a given connected account.
     *
     * @param  mixed  $user
     * @param ConnectedAccount $connectedAccount
     * @param  string  $provider
     * @param User $providerUser
     * @return ConnectedAccount
     */
    public function update(mixed $user, ConnectedAccount $connectedAccount, string $provider, User $providerUser): ConnectedAccount;
}
