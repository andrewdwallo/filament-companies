<?php

namespace Wallo\FilamentCompanies\Contracts;

use Laravel\Socialite\Contracts\User as ProviderUserContract;

/**
 * @method \Illuminate\Database\Eloquent\Model create(string $provider, ProviderUserContract $providerUser)
 */
interface CreatesUserFromProvider
{
    //
}
