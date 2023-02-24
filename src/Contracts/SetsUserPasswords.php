<?php

namespace Wallo\FilamentCompanies\Contracts;

interface SetsUserPasswords
{
    /**
     * Validate and sets the user's password.
     */
    public function set(mixed $user, array $input): void;
}
