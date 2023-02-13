<?php

namespace Wallo\FilamentCompanies\Events;

use Illuminate\Foundation\Events\Dispatchable;

class CompanyEmployeeRemoved
{
    use Dispatchable;

    /**
     * The company instance.
     *
     * @var mixed
     */
    public mixed $company;

    /**
     * The company employee that was removed.
     *
     * @var mixed
     */
    public mixed $user;

    /**
     * Create a new event instance.
     *
     * @param  mixed  $company
     * @param  mixed  $user
     * @return void
     */
    public function __construct(mixed $company, mixed $user)
    {
        $this->company = $company;
        $this->user = $user;
    }
}
