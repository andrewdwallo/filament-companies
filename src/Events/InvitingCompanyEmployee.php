<?php

namespace Wallo\FilamentCompanies\Events;

use Illuminate\Foundation\Events\Dispatchable;

class InvitingCompanyEmployee
{
    use Dispatchable;

    /**
     * The company instance.
     *
     * @var mixed
     */
    public mixed $company;

    /**
     * The email address of the invitee.
     *
     * @var mixed
     */
    public mixed $email;

    /**
     * The role of the invitee.
     *
     * @var mixed
     */
    public mixed $role;

    /**
     * Create a new event instance.
     *
     * @param  mixed  $company
     * @param  mixed  $email
     * @param  mixed  $role
     * @return void
     */
    public function __construct(mixed $company, mixed $email, mixed $role)
    {
        $this->company = $company;
        $this->email = $email;
        $this->role = $role;
    }
}
