<?php

namespace App\Actions\FilamentCompanies;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Gate;
use Wallo\FilamentCompanies\ConnectedAccount;
use Wallo\FilamentCompanies\Contracts\UpdatesConnectedAccounts;
use Laravel\Socialite\Contracts\User;

class UpdateConnectedAccount implements UpdatesConnectedAccounts
{
    /**
     * Update a given connected account.
     *
     * @param mixed $user
     * @param ConnectedAccount $connectedAccount
     * @param string $provider
     * @param User $providerUser
     * @return ConnectedAccount
     * @throws AuthorizationException
     */
    public function update(mixed $user, ConnectedAccount $connectedAccount, string $provider, User $providerUser): ConnectedAccount
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
