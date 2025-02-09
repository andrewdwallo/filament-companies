<?php

namespace Wallo\FilamentTenants\Contracts;

use Illuminate\Contracts\Auth\Authenticatable;
use Laravel\Socialite\Contracts\User as ProviderUser;
use Wallo\FilamentTenants\ConnectedAccount;

interface CreatesConnectedAccounts
{
    /**
     * Create a connected account for a given user.
     */
    public function create(Authenticatable $user, string $provider, ProviderUser $providerUser): ConnectedAccount;
}
