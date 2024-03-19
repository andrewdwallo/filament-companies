<?php

namespace Wallo\FilamentCompanies\Http\Livewire;

use Filament\Notifications\Notification;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;
use Wallo\FilamentCompanies\Actions\ValidateCompanyDeletion;
use Wallo\FilamentCompanies\Contracts\DeletesCompanies;
use Wallo\FilamentCompanies\FilamentCompanies;
use Wallo\FilamentCompanies\RedirectsActions;

class DeleteCompanyForm extends Component
{
    use RedirectsActions;

    /**
     * The company instance.
     */
    public mixed $company;

    /**
     * Mount the component.
     */
    public function mount(mixed $company): void
    {
        $this->company = $company;
    }

    /**
     * Delete the company.
     *
     * @throws AuthorizationException
     */
    public function deleteCompany(ValidateCompanyDeletion $validator, DeletesCompanies $deleter): Response | Redirector | RedirectResponse
    {
        $validator->validate(Auth::user(), $this->company);

        $deleter->delete($this->company);

        if (FilamentCompanies::hasNotificationsFeature()) {
            if (method_exists($deleter, 'companyDeleted')) {
                $deleter->companyDeleted($this->company);
            } else {
                $this->companyDeleted($this->company);
            }
        }

        $this->company = null;

        return $this->redirectPath($deleter);
    }

    /**
     * Cancel the company deletion.
     */
    public function cancelCompanyDeletion(): void
    {
        $this->dispatch('close-modal', id: 'confirmingCompanyDeletion');
    }

    /**
     * Render the component.
     */
    public function render(): View
    {
        return view('filament-companies::companies.delete-company-form');
    }

    public function companyDeleted($company): void
    {
        $name = $company->name;

        Notification::make()
            ->title(__('filament-companies::default.notifications.company_deleted.title'))
            ->success()
            ->body(Str::inlineMarkdown(__('filament-companies::default.notifications.company_deleted.body', compact('name'))))
            ->send();
    }
}
