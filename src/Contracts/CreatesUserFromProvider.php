<?php

namespace Wallo\FilamentCompanies\Contracts;

use App\Models\User;
use Laravel\Socialite\Contracts\User as ProviderUserContract;

interface CreatesUserFromProvider
{
    /**
     * Create a new user from a social provider user.
     */
    public function create(string $provider, ProviderUserContract $providerUser): User;
}
