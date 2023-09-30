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
    public string $email;

    /**
     * The role of the invitee.
     */
    public string|null $role = null;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(mixed $company, string $email, string|null $role = null)
    {
        $this->company = $company;
        $this->email = $email;
        $this->role = $role;
    }
}
