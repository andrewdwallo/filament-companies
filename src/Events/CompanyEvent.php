<?php

namespace Wallo\FilamentCompanies\Events;

use Filament\Events\ServingFilament;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

abstract class CompanyEvent extends ServingFilament
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The company instance.
     *
     * @var \App\Models\Company
     */
    public $company;

    /**
     * Create a new event instance.
     *
     * @param  \App\Models\Company  $company
     * @return void
     */
    public function __construct($company)
    {
        $this->company = $company;
    }
}
