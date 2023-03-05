<?php

namespace Wallo\FilamentCompanies\Http\Livewire;

use App\Models\User;
use Filament\Notifications\Notification;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Wallo\FilamentCompanies\Contracts\UpdatesCompanyNames;

class UpdateCompanyNameForm extends Component
{
    /**
     * The company instance.
     */
    public mixed $company;

    /**
     * The component's state.
     */
    public array $state = [];

    /**
     * Mount the component.
     */
    public function mount(mixed $company): void
    {
        $this->company = $company;

        $this->state = $company->withoutRelations()->toArray();
    }

    /**
     * Update the company's name.
     */
    public function updateCompanyName(UpdatesCompanyNames $updater): void
    {
        $this->resetErrorBag();

        $updater->update($this->user, $this->company, $this->state);

        Notification::make()
        ->title(__('filament-companies::default.notifications.company_name_updated.title'))
        ->success()
        ->body(__('filament-companies::default.notifications.company_name_updated.body', ['name' => $this->state['name']]))
        ->send();

        $this->emit('refresh-navigation-menu');
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
        return view('filament-companies::companies.update-company-name-form');
    }
}
