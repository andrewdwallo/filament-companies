<?php

namespace Wallo\FilamentCompanies\Http\Livewire;

use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Wallo\FilamentCompanies\Contracts\UpdatesCompanyNames;
use Livewire\Component;

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
    public function mount($company)
    {
        $this->company = $company;

        $this->state = $company->withoutRelations()->toArray();
    }

    /**
     * Update the company's name.
     *
     * @param  \Wallo\FilamentCompanies\Contracts\UpdatesCompanyNames  $updater
     * @return void
     */
    public function updateCompanyName(UpdatesCompanyNames $updater)
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
        return view('filament-companies::components.companies.update-company-name-form');
    }
}
