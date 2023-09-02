<?php

namespace Wallo\FilamentCompanies\Contracts;

/**
 * @method void invite(\Illuminate\Foundation\Auth\User $user, \Illuminate\Database\Eloquent\Model $company, string $email, string|null $role = null)
 * @method void employeeInvitationSent(\Illuminate\Foundation\Auth\User|null $user = null, \Illuminate\Database\Eloquent\Model|null $company = null, string|null $email = null, string|null $role = null)
 */
interface InvitesCompanyEmployees
{
    //
}
