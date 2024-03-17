<?php

namespace Wallo\FilamentCompanies\Http\Livewire;

use Filament\Facades\Filament;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\Features\SupportRedirects\Redirector;
use Wallo\FilamentCompanies\Contracts\DeletesUsers;

class DeleteUserForm extends Component
{
    /**
     * The user's current password.
     */
    public string $password = '';

    /**
     * Confirm that the user would like to delete their account.
     */
    public function confirmUserDeletion(): void
    {
        $this->resetErrorBag();

        $this->password = '';

        $this->dispatch('confirming-delete-user');

        $this->dispatch('open-modal', id: 'confirmingUserDeletion');
    }

    /**
     * Delete the current user.
     */
    public function deleteUser(DeletesUsers $deleter): RedirectResponse | Redirector
    {
        $this->resetErrorBag();

        $auth = Filament::auth();

        if (! Hash::check($this->password, Auth::user()->password)) {
            throw ValidationException::withMessages([
                'password' => [__('filament-companies::default.errors.invalid_password')],
            ]);
        }

        $deleter->delete(Auth::user()?->fresh());

        $auth->logout();

        if (session() !== null) {
            session()->invalidate();
            session()->regenerateToken();
        }

        return redirect()->to(Filament::hasLogin() ? Filament::getLoginUrl() : Filament::getUrl());
    }

    /**
     * Cancel the user deletion.
     */
    public function cancelUserDeletion(): void
    {
        $this->dispatch('close-modal', id: 'confirmingUserDeletion');
    }

    /**
     * Render the component.
     */
    public function render(): View
    {
        return view('filament-companies::profile.delete-user-form');
    }
}
