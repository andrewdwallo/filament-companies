<?php

namespace Wallo\FilamentCompanies\Http\Livewire;

use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\Redirector;
use Wallo\FilamentCompanies\Contracts\DeletesUsers;

class DeleteUserForm extends Component
{
    /**
     * Indicates if user deletion is being confirmed.
     */
    public bool $confirmingUserDeletion = false;

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

        $this->dispatchBrowserEvent('confirming-delete-user');

        $this->confirmingUserDeletion = true;
    }

    /**
     * Delete the current user.
     */
    public function deleteUser(DeletesUsers $deleter, StatefulGuard $auth): RedirectResponse|Redirector
    {
        $this->resetErrorBag();

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

        return redirect(config('fortify.redirects.logout') ?? '/');
    }

    /**
     * Render the component.
     */
    public function render(): View
    {
        return view('filament-companies::profile.delete-user-form');
    }
}
