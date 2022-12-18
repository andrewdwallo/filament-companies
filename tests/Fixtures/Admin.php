<?php

namespace Wallo\FilamentCompanies\Tests\Fixtures;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Wallo\FilamentCompanies\HasProfilePhoto;
use Wallo\FilamentCompanies\HasCompanies;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use HasApiTokens, HasProfilePhoto;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
}
