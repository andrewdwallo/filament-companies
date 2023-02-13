<?php

namespace Wallo\FilamentCompanies\Http\Livewire;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use Wallo\FilamentCompanies\Contracts\CreatesCompanies;
use Livewire\Component;
use Livewire\Redirector;

class CreateCompanyForm extends Component
{

    /**
     * The component's state.
     *
     * @var array
     */
    public $state = [];

    /**
     * Create a new company.
     *
     * @param CreatesCompanies $creator
     * @return RedirectResponse|Redirector
     */
    public function createCompany(CreatesCompanies $creator): RedirectResponse|Redirector
    {
        $this->resetErrorBag();

        $creator->create(Auth::user(), $this->state);

        return redirect()->to(config('fortify.home'));
    }

    /**
     * Get the current user of the application.
     *
     * @return Authenticatable|User|null
     */
    public function getUserProperty(): User|Authenticatable|null
    {
        return Auth::user();
    }

    /**
     * Render the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('filament-companies::companies.create-company-form');
    }
}
