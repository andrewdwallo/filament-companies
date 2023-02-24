<?php

namespace Wallo\FilamentCompanies\Events;

use Illuminate\Foundation\Events\Dispatchable;

class InvitingCompanyEmployee
{
    use Dispatchable;

    /**
     * The company instance.
     */
    public mixed $company;

    /**
     * The email address of the invitee.
     */
    public mixed $email;

    /**
     * The role of the invitee.
     */
    public mixed $role;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(mixed $company, mixed $email, mixed $role)
    {
        $this->company = $company;
        $this->email = $email;
        $this->role = $role;
    }
}
