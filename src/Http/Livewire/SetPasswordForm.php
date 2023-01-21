<?php

namespace Wallo\FilamentCompanies\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Wallo\FilamentCompanies\Contracts\SetsUserPasswords;
use Livewire\Component;

class SetPasswordForm extends Component
{
    /**
     * The component's state.
     *
     * @var array
     */
    public $state = [
        'password' => '',
        'password_confirmation' => '',
    ];

    /**
     * Update the user's password.
     *
     * @param  \Wallo\FilamentCompanies\Contracts\SetsUserPasswords  $setter
     * @return void
     */
    public function setPassword(SetsUserPasswords $setter)
    {
        $this->resetErrorBag();

        $setter->set(Auth::user(), $this->state);

        $this->state = [
            'password' => '',
            'password_confirmation' => '',
        ];

        $this->emit('saved');
    }

    /**
     * Get the current user of the application.
     *
     * @return mixed
     */
    public function getUserProperty()
    {
        return Auth::user();
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('filament-companies::profile.set-password-form');
    }
}
