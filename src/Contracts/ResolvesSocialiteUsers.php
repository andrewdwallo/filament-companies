<?php

namespace Wallo\FilamentCompanies\Contracts;

use Laravel\Socialite\Contracts\User;

interface ResolvesSocialiteUsers
{
    /**
     * Resolve the user for a given provider.
     *
     * @param string $provider
     * @return User
     */
    public function resolve(string $provider): User;
}
