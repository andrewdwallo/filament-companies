<?php

namespace Wallo\FilamentCompanies\Http\Livewire;

use Filament\Notifications\Notification;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Wallo\FilamentCompanies\Contracts\UpdatesCompanyNames;
use Wallo\FilamentCompanies\RefreshesNavigationMenu;

class UpdateCompanyNameForm extends Component
{
    use RefreshesNavigationMenu;

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

        $name = $this->state['name'];

        $this->refreshNavigationMenu();

        $this->companyNameUpdated($name);
    }

    protected function companyNameUpdated($name): void
    {
        Notification::make()
            ->title(__('filament-companies::default.notifications.company_name_updated.title'))
            ->success()
            ->body(__('filament-companies::default.notifications.company_name_updated.body', compact('name')))
            ->send();
    }

    /**
     * Get the current user of the application.
     */
    public function getUserProperty(): Authenticatable|null
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
