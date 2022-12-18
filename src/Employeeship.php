<?php

namespace Wallo\FilamentCompanies;

use Illuminate\Database\Eloquent\Relations\Pivot;

abstract class Employeeship extends Pivot
{
    /**
     * The table associated with the pivot model.
     *
     * @var string
     */
    protected $table = 'company_user';
}
