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
     * The connected account instance.
     *
     * @var ConnectedAccount
     */
    public ConnectedAccount $connectedAccount;

    /**
     * Create a new event instance.
     *
     * @param ConnectedAccount $connectedAccount
     * @return void
     */
    public function __construct(ConnectedAccount $connectedAccount)
    {
        $this->connectedAccount = $connectedAccount;
    }
}
