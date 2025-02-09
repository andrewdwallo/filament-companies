<?php

namespace Wallo\FilamentTenants\Events;

use Illuminate\Foundation\Events\Dispatchable;

class InvitingTenantEmployee
{
    use Dispatchable;

    /**
     * The tenant instance.
     */
    public mixed $tenant;

    /**
     * The email address of the invitee.
     */
    public string $email;

    /**
     * The role of the invitee.
     */
    public ?string $role = null;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(mixed $tenant, string $email, ?string $role = null)
    {
        $this->tenant = $tenant;
        $this->email = $email;
        $this->role = $role;
    }
}
