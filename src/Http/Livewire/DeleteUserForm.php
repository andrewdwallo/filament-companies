<?php

namespace Wallo\FilamentTenants\Http\Livewire;

use Filament\Facades\Filament;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\Features\SupportRedirects\Redirector;
use Wallo\FilamentTenants\Contracts\DeletesUsers;
use Wallo\FilamentTenants\FilamentTenants;

class DeleteUserForm extends Component
{
    public ?Authenticatable $user = null;
    
    /**
     * The user's current password.
     */
    public string $password = '';

    /**
     * Confirm that the user would like to delete a account.
     */
    public function confirmUserDeletion(): void
    {
        $this->resetErrorBag();

        $this->password = '';

        $this->dispatch('confirming-delete-user');

        $this->dispatch('open-modal', id: 'confirmingUserDeletion');
    }

    /**
     * Delete a user.
     */
    public function deleteUser(DeletesUsers $deleter): RedirectResponse | Redirector
    {
        $this->resetErrorBag();

        $auth = Filament::auth();

        if (! Hash::check($this->password, $this->user->password)) {
            throw ValidationException::withMessages([
                'password' => [__('filament-tenants::default.errors.invalid_password')],
            ]);
        }

        $deleter->delete($this->user?->fresh());

        if ($deleter === $this->user) {
            $auth->logout();

            if (session() !== null) {
                session()->invalidate();
                session()->regenerateToken();
            }

            return redirect()->to(Filament::hasLogin() ? Filament::getLoginUrl() : Filament::getUrl());
        }

        if (FilamentTenants::hasNotificationsFeature()) {
            if (method_exists($deleter, 'passwordUpdated')) {
                $deleter->userDeleted($this->user, $this->state);
            } else {
                $this->userDeleted();
            }
        }
    }

    /**
     * Cancel the user deletion.
     */
    public function cancelUserDeletion(): void
    {
        $this->dispatch('close-modal', id: 'confirmingUserDeletion');
    }

    /**
     * Get the user
     */
    public function getUserProperty(): ?Authenticatable
    {
        return $this->user ?? Auth::user();
    }

    /**
     * Render the component.
     */
    public function render(): View
    {
        return view('filament-tenants::profile.delete-user-form');
    }

    public function userDeleted(): void
    {
        Notification::make()
            ->title(__('filament-tenants::default.notifications.user_deleted.title'))
            ->success()
            ->body(__('filament-tenants::default.notifications.user_deleted.body'))
            ->send();
    }
}
