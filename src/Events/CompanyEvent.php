<?php

namespace Wallo\FilamentCompanies\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

abstract class CompanyEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The company instance.
     */
    public mixed $company;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(mixed $company)
    {
        $this->company = $company;
    }
}
