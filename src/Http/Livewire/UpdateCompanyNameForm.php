<?php

namespace Wallo\FilamentCompanies\Http\Livewire;

use App\Models\User;
use Filament\Notifications\Notification;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use Wallo\FilamentCompanies\Contracts\UpdatesCompanyNames;
use Livewire\Component;

/**
 * @property mixed $user
 */
class UpdateCompanyNameForm extends Component
{
    /**
     * The company instance.
     *
     * @var mixed
     */
    public $company;

    /**
     * The component's state.
     *
     * @var array
     */
    public $state = [];

    /**
     * Mount the component.
     *
     * @param  mixed  $company
     * @return void
     */
    public function mount(mixed $company): void
    {
        $this->company = $company;

        $this->state = $company->withoutRelations()->toArray();
    }

    /**
     * Update the company's name.
     *
     * @param UpdatesCompanyNames $updater
     * @return void
     */
    public function updateCompanyName(UpdatesCompanyNames $updater): void
    {
        $this->resetErrorBag();

        $updater->update($this->user, $this->company, $this->state);

        Notification::make()
        ->title('Updated')
        ->success()
        ->body('Company name updated.')
        ->send();

        $this->emit('refresh-navigation-menu');
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
     * Render the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('filament-companies::companies.update-company-name-form');
    }
}
