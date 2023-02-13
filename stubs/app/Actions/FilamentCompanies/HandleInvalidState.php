<?php

namespace App\Actions\FilamentCompanies;

use Wallo\FilamentCompanies\Contracts\HandlesInvalidState;
use Laravel\Socialite\Two\InvalidStateException;

class HandleInvalidState implements HandlesInvalidState
{
    /**
     * Handle an invalid state exception from a Socialite provider.
     *
     * @param InvalidStateException $exception
     * @param callable|null $callback
     * @return mixed
     */
    public function handle(InvalidStateException $exception, callable $callback = null): mixed
    {
        if ($callback) {
            return $callback($exception);
        }

        throw $exception;
    }
}
