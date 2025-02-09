<?php

namespace App\Models;

use Wallo\FilamentTenants\Employeeship as FilamentTenantsEmployeeship;

class Employeeship extends FilamentTenantsEmployeeship
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;
}
