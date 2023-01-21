<?php

namespace Wallo\FilamentCompanies\Contracts;

interface SetsUserPasswords
{
    /**
     * Validate and sets the user's password.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function set($user, array $input);
}
