<?php

namespace Wallo\FilamentCompanies\Tests\Fixtures;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Wallo\FilamentCompanies\HasProfilePhoto;
use Wallo\FilamentCompanies\HasCompanies;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasCompanies, HasProfilePhoto;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
}
