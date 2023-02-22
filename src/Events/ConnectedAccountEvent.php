<?php

namespace Wallo\FilamentCompanies\Events;

use App\Models\ConnectedAccount;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

abstract class ConnectedAccountEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public ConnectedAccount $connectedAccount)
    {
        //
    }
}
