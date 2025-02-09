<?php

namespace Wallo\FilamentTenants\Contracts;

/**
 * @method void invite(\Illuminate\Foundation\Auth\User $user, \Illuminate\Database\Eloquent\Model $tenant, string $email, string|null $role = null)
 * @method void employeeInvitationSent(\Illuminate\Foundation\Auth\User|null $user = null, \Illuminate\Database\Eloquent\Model|null $tenant = null, string|null $email = null, string|null $role = null)
 */
interface InvitesTenantEmployees
{
    //
}
