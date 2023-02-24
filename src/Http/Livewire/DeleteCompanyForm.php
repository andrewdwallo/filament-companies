<?php

namespace Wallo\FilamentCompanies\Http\Livewire;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Wallo\FilamentCompanies\Actions\ValidateCompanyDeletion;
use Wallo\FilamentCompanies\Contracts\DeletesCompanies;
use Wallo\FilamentCompanies\RedirectsActions;

class DeleteCompanyForm extends Component
{
    use RedirectsActions;

    /**
     * The company instance.
     */
    public mixed $company;

    /**
     * Indicates if company deletion is being confirmed.
     */
    public bool $confirmingCompanyDeletion = false;

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
    public function deleteCompany(ValidateCompanyDeletion $validator, DeletesCompanies $deleter): Response|Redirector|RedirectResponse
    {
        $validator->validate(Auth::user(), $this->company);

        $deleter->delete($this->company);

        return $this->redirectPath($deleter);
    }

    /**
     * Render the component.
     */
    public function render(): View
    {
        return view('filament-companies::companies.delete-company-form');
    }
}
