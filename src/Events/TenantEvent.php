<?php

namespace Wallo\FilamentTenants\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

abstract class TenantEvent
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    /**
     * The tenant instance.
     */
    public mixed $tenant;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(mixed $tenant)
    {
        $this->tenant = $tenant;
    }
}
