<?php

namespace Wallo\FilamentCompanies\Tests\Fixtures;

use App\Models\User as BaseUser;
use Laravel\Sanctum\HasApiTokens;
use Wallo\FilamentCompanies\HasCompanies;
use Wallo\FilamentCompanies\HasProfilePhoto;

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
