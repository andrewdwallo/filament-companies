<?php

namespace Wallo\FilamentCompanies\Events;

use App\Models\Company;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

abstract class CompanyEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The company instance.
     */
    public Company $company;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Company $company)
    {
        $this->company = $company;
    }
}
