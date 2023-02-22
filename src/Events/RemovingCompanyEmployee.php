<?php

namespace Wallo\FilamentCompanies\Events;

use Illuminate\Foundation\Events\Dispatchable;

class RemovingCompanyEmployee
{
    use Dispatchable;

    /**
     * The company instance.
     */
    public mixed $company;

    /**
     * The company employee being removed.
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
