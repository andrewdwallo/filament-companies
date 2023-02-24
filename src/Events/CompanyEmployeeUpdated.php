<?php

namespace Wallo\FilamentCompanies\Events;

use Illuminate\Foundation\Events\Dispatchable;

class CompanyEmployeeUpdated
{
    use Dispatchable;

    /**
     * The company instance.
     */
    public mixed $company;

    /**
     * The company employee that was updated.
     */
    public mixed $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(mixed $company, mixed $user)
    {
        $this->company = $company;
        $this->user = $user;
    }
}
