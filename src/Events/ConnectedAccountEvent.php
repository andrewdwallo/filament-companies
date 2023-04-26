<?php

namespace Wallo\FilamentCompanies\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

abstract class ConnectedAccountEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The connected account instance.
     */
    public mixed $connectedAccount;

    /**
     * Create a new event instance.
     */
    public function __construct(mixed $connectedAccount)
    {
        $this->connectedAccount = $connectedAccount;
    }
}
