<?php

namespace Wallo\FilamentCompanies\Http\Livewire;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Wallo\FilamentCompanies\Contracts\CreatesCompanies;
use Wallo\FilamentCompanies\RedirectsActions;

class CreateCompanyForm extends Component
{
    use RedirectsActions;

    /**
     * The component's state.
     */
    public array $state = [];

    /**
     * Create a new company.
     */
    public function createCompany(CreatesCompanies $creator): Response|Redirector|RedirectResponse
    {
        $this->resetErrorBag();

        $creator->create(Auth::user(), $this->state);

        return $this->redirectPath($creator);
    }

    /**
     * Get the current user of the application.
     */
    public function getUserProperty(): User|Authenticatable|null
    {
        return Auth::user();
    }

    /**
     * Render the component.
     */
    public function render(): View
    {
        return view('filament-companies::companies.create-company-form');
    }
}
