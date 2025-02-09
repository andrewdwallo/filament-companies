<?php

namespace Wallo\FilamentTenants\Events;

use Illuminate\Foundation\Events\Dispatchable;

class AddingTenant
{
    use Dispatchable;

    /**
     * The tenant owner.
     */
    public mixed $owner;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(mixed $owner)
    {
        $this->owner = $owner;
    }
}
