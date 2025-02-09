<?php

namespace Wallo\FilamentTenants\Events;

use Illuminate\Foundation\Events\Dispatchable;

class TenantEmployeeUpdated
{
    use Dispatchable;

    /**
     * The tenant instance.
     */
    public mixed $tenant;

    /**
     * The tenant employee that was updated.
     */
    public mixed $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(mixed $tenant, mixed $user)
    {
        $this->tenant = $tenant;
        $this->user = $user;
    }
}
