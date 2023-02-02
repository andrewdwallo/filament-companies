<?php

namespace App\Actions\FilamentCompanies;

use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Wallo\FilamentCompanies\Contracts\CreatesConnectedAccounts;
use Wallo\FilamentCompanies\Contracts\CreatesUserFromProvider;
use Wallo\FilamentCompanies\Socialite;
use Wallo\FilamentCompanies\Features;
use Wallo\FilamentCompanies\FilamentCompanies;
use Laravel\Socialite\Contracts\User as ProviderUserContract;

class CreateUserFromProvider implements CreatesUserFromProvider
{
    /**
     * The creates connected accounts instance.
     *
     * @var \Wallo\FilamentCompanies\Contracts\CreatesConnectedAccounts
     */
    public $createsConnectedAccounts;

    /**
     * Create a new action instance.
     *
     * @param  \Wallo\FilamentCompanies\Contracts\CreatesConnectedAccounts  $createsConnectedAccounts
     */
    public function __construct(CreatesConnectedAccounts $createsConnectedAccounts)
    {
        $this->createsConnectedAccounts = $createsConnectedAccounts;
    }

    /**
     * Create a new user from a social provider user.
     *
     * @param  string  $provider
     * @param  \Laravel\Socialite\Contracts\User  $providerUser
     * @return \App\Models\User
     */
    public function create(string $provider, ProviderUserContract $providerUser)
    {
        return DB::transaction(function () use ($provider, $providerUser) {
            return tap(User::create([
                'name' => $providerUser->getName(),
                'email' => $providerUser->getEmail(),
            ]), function (User $user) use ($provider, $providerUser) {
                $user->markEmailAsVerified();

                if (Features::profilePhotos()) {
                    if (Socialite::hasProviderAvatarsFeature() && FilamentCompanies::managesProfilePhotos() && $providerUser->getAvatar()) {
                        $user->setProfilePhotoFromUrl($providerUser->getAvatar());
                    }
                }

                $user->switchConnectedAccount(
                    $this->createsConnectedAccounts->create($user, $provider, $providerUser)
                );

                $this->createCompany($user);
            });
        });
    }

    /**
     * Create a personal company for the user.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    protected function createCompany(User $user)
    {
        $user->ownedCompanies()->save(Company::forceCreate([
            'user_id' => $user->id,
            'name' => explode(' ', $user->name, 2)[0]."'s Company",
            'personal_company' => true,
        ]));
    }
}
