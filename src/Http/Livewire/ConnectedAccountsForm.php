<?php

namespace Wallo\FilamentCompanies\Http\Livewire;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Wallo\FilamentCompanies\ConnectedAccount;
use Wallo\FilamentCompanies\Socialite;
use Wallo\FilamentCompanies\InteractsWithBanner;
use Livewire\Component;
use Livewire\Redirector;
use Wallo\FilamentCompanies\Pages\User\Profile;

class ConnectedAccountsForm extends Component
{
    use InteractsWithBanner;

    /**
     * The component's listeners.
     *
     * @var array
     */
    protected $listeners = [
        'refresh-navigation-menu' => '$refresh',
    ];

    /**
     * Indicates whether removal of a provider is being confirmed.
     *
     * @var bool
     */
    public $confirmingRemove = false;

    /**
     * @var mixed
     */
    public $selectedAccountId;

    /**
     * Return all socialite providers and whether
     * the application supports them.
     *
     * @return array
     */
    public function getProvidersProperty(): array
    {
        return Socialite::providers();
    }

    /**
     * Get the current user of the application.
     *
     * @return User|Authenticatable|null
     */
    public function getUserProperty(): User|Authenticatable|null
    {
        return Auth::user();
    }

    /**
     * Confirm that the user actually wants to remove the selected connected account.
     *
     * @param  mixed  $accountId
     * @return void
     */
    public function confirmRemove(mixed $accountId): void
    {
        $this->selectedAccountId = $accountId;

        $this->confirmingRemove = true;
    }

    /**
     * Set the providers avatar url as the users profile photo url.
     *
     * @param mixed $accountId
     * @return RedirectResponse|Redirector
     */
    public function setAvatarAsProfilePhoto(mixed $accountId): RedirectResponse|Redirector
    {
        $account = Auth::user()->connectedAccounts
            ->where('user_id', ($user = Auth::user())->getAuthIdentifier())
            ->where('id', $accountId)
            ->first();

        if (is_callable([$user, 'setProfilePhotoFromUrl']) && ! is_null($account->avatar_path)) {
            $user->setProfilePhotoFromUrl($account->avatar_path);
        }

        return redirect()->to(Profile::getUrl());
    }

    /**
     * Remove an OAuth Provider.
     *
     * @param  mixed  $accountId
     * @return void
     */
    public function removeConnectedAccount(mixed $accountId): void
    {
        DB::table('connected_accounts')
            ->where('user_id', Auth::user()->getAuthIdentifier())
            ->where('id', $accountId)
            ->delete();

        $this->confirmingRemove = false;

        $this->banner(__('Connected account removed.'));
    }

    /**
     * Get the users connected accounts.
     *
     * @return Collection
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
     *
     * @return Application|Factory|View
     */
    public function render(): View|Factory|Application
    {
        return view('filament-companies::profile.connected-accounts-form');
    }
}
