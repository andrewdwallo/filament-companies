<?php

namespace Wallo\FilamentCompanies\Http\Livewire;

use Filament\Notifications\Notification;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;
use Wallo\FilamentCompanies\Contracts\UpdatesCompanyNames;
use Wallo\FilamentCompanies\FilamentCompanies;

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

        if (FilamentCompanies::hasNotificationsFeature()) {
            if (method_exists($updater, 'companyNameUpdated')) {
                $updater->companyNameUpdated($this->user, $this->company, $this->state);
            } else {
                $this->companyNameUpdated($this->company);
            }
        }
    }

    protected function companyNameUpdated($company): void
    {
        $name = $company->name;

        Notification::make()
            ->title(__('filament-companies::default.notifications.company_name_updated.title'))
            ->success()
            ->body(Str::inlineMarkdown(__('filament-companies::default.notifications.company_name_updated.body', compact('name'))))
            ->send();
    }

    /**
     * Get the current user of the application.
     */
    public function getUserProperty(): ?Authenticatable
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
