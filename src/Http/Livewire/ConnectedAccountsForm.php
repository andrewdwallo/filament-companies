<?php

namespace Wallo\FilamentCompanies\Http\Livewire;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Redirector;
use Wallo\FilamentCompanies\ConnectedAccount;
use Wallo\FilamentCompanies\InteractsWithBanner;
use Wallo\FilamentCompanies\Pages\User\Profile;
use Wallo\FilamentCompanies\Socialite;

class ConnectedAccountsForm extends Component
{
    use InteractsWithBanner;

    /**
     * The component's listeners.
     *
     * @var array<string, string>
     */
    protected $listeners = [
        'refresh-navigation-menu' => '$refresh',
    ];

    /**
     * Indicates whether removal of a provider is being confirmed.
     */
    public bool $confirmingRemove = false;

    /**
     * The ID of the currently connected account.
     */
    public string|int $selectedAccountId = '';

    /**
     * Return all socialite providers and whether the application supports them
     */
    public function getProvidersProperty(): array
    {
        return Socialite::providers();
    }

    /**
     * Get the current user of the application.
     */
    public function getUserProperty(): User|Authenticatable|null
    {
        return Auth::user();
    }

    /**
     * Confirm that the user actually wants to remove the selected connected account.
     */
    public function confirmRemove(string|int $accountId): void
    {
        $this->selectedAccountId = $accountId;

        $this->confirmingRemove = true;
    }

    /**
     * Set the providers avatar url as the users profile photo url.
     */
    public function setAvatarAsProfilePhoto(string|int $accountId): RedirectResponse|Redirector
    {
        $account = Auth::user()->connectedAccounts
            ->where('user_id', ($user = Auth::user())->getAuthIdentifier())
            ->where('id', $accountId)
            ->first();

        if (is_callable([$user, 'setProfilePhotoFromUrl']) && ! is_null($account->avatar_path) && Socialite::hasProviderAvatarsFeature()) {
            $user->setProfilePhotoFromUrl($account->avatar_path);
        }

        return redirect(Profile::getUrl());
    }

    /**
     * Remove an OAuth Provider.
     */
    public function removeConnectedAccount(string|int $accountId): void
    {
        DB::table('connected_accounts')
            ->where('user_id', Auth::user()?->getAuthIdentifier())
            ->where('id', $accountId)
            ->delete();

        $this->confirmingRemove = false;

        $this->banner(__('filament-companies::default.banner.connected_account_removed', ['provider' => $accountId]));
    }

    /**
     * Get the users connected accounts.
     */
    public function getAccountsProperty(): Collection
    {
        return Auth::user()->connectedAccounts
            ->map(function (ConnectedAccount $account) {
                return (object) $account->getSharedData();
            });
    }

    /**
     * Render the component.
     */
    public function render(): View
    {
        return view('filament-companies::profile.connected-accounts-form');
    }
}
