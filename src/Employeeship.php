<?php

namespace Wallo\FilamentTenants;

use Illuminate\Database\Eloquent\Relations\Pivot;

abstract class Employeeship extends Pivot
{
    /**
     * The table associated with the pivot model.
     *
     * @var string
     */
    protected $table = 'tenant_user';
}
