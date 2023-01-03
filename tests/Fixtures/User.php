<?php

namespace Wallo\FilamentCompanies\Tests\Fixtures;

use App\Models\User as BaseUser;
use Wallo\FilamentCompanies\HasProfilePhoto;
use Wallo\FilamentCompanies\HasCompanies;
use Laravel\Sanctum\HasApiTokens;

class User extends BaseUser
{
    use HasApiTokens, HasCompanies, HasProfilePhoto;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
}
