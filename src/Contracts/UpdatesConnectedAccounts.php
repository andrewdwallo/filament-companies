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
     * @param  \Wallo\FilamentCompanies\ConnectedAccount  $connectedAccount
     * @param  string  $provider
     * @param  \Laravel\Socialite\Contracts\User  $providerUser
     * @return \Wallo\FilamentCompanies\ConnectedAccount
     */
    public function update($user, ConnectedAccount $connectedAccount, string $provider, User $providerUser);
}
