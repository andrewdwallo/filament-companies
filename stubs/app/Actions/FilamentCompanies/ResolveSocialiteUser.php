<?php

namespace App\Actions\FilamentCompanies;

use Laravel\Socialite\Contracts\User;
use Wallo\FilamentCompanies\Contracts\ResolvesSocialiteUsers;
use Wallo\FilamentCompanies\Socialite as SocialiteUser;
use Laravel\Socialite\Facades\Socialite;

class ResolveSocialiteUser implements ResolvesSocialiteUsers
{
    /**
     * Resolve the user for a given provider.
     *
     * @param string $provider
     * @return User
     */
    public function resolve(string $provider): User
    {
        $user = Socialite::driver($provider)->user();

        if (SocialiteUser::generatesMissingEmails()) {
            $user->email = $user->getEmail() ?? ("{$user->id}@{$provider}".config('app.domain'));
        }

        return $user;
    }
}
