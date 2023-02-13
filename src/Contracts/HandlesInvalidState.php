<?php

namespace Wallo\FilamentCompanies\Contracts;

use Laravel\Socialite\Two\InvalidStateException;

interface HandlesInvalidState
{
    /**
     * Handle an invalid state exception from a Socialite provider.
     *
     * @param InvalidStateException $exception
     * @param callable|null $callback
     */
    public function handle(InvalidStateException $exception, callable $callback = null);
}
