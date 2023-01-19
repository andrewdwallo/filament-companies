<?php

namespace App\Actions\FilamentCompanies;

use Illuminate\Support\Facades\Gate;
use Wallo\FilamentCompanies\ConnectedAccount;
use Wallo\FilamentCompanies\Contracts\UpdatesConnectedAccounts;
use Laravel\Socialite\Contracts\User;

class UpdateConnectedAccount implements UpdatesConnectedAccounts
{
    /**
     * Update a given connected account.
     *
     * @param  mixed  $user
     * @param  \Wallo\FilamentCompanies\ConnectedAccount  $connectedAccount
     * @param  string  $provider
     * @param  \Laravel\Socialite\Contracts\User  $providerUser
     * @return \Wallo\FilamentCompanies\ConnectedAccount
     */
    public function update($user, ConnectedAccount $connectedAccount, string $provider, User $providerUser)
    {
        Gate::forUser($user)->authorize('update', $connectedAccount);

        $connectedAccount->forceFill([
            'provider' => strtolower($provider),
            'provider_id' => $providerUser->getId(),
            'name' => $providerUser->getName(),
            'nickname' => $providerUser->getNickname(),
            'email' => $providerUser->getEmail(),
            'avatar_path' => $providerUser->getAvatar(),
            'token' => $providerUser->token,
            'secret' => $providerUser->tokenSecret ?? null,
            'refresh_token' => $providerUser->refreshToken ?? null,
            'expires_at' => property_exists($providerUser, 'expiresIn') ? now()->addSeconds($providerUser->expiresIn) : null,
        ])->save();

        return $connectedAccount;
    }
}
