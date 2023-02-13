<?php

namespace Wallo\FilamentCompanies\Http\Livewire;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;
use Wallo\FilamentCompanies\Actions\ValidateCompanyDeletion;
use Wallo\FilamentCompanies\Contracts\DeletesCompanies;
use Livewire\Component;
use Livewire\Redirector;

class DeleteCompanyForm extends Component
{
    /**
     * The company instance.
     *
     * @var mixed
     */
    public $company;

    /**
     * Indicates if company deletion is being confirmed.
     *
     * @var bool
     */
    public $confirmingCompanyDeletion = false;

    /**
     * Mount the component.
     *
     * @param  mixed  $company
     * @return void
     */
    public function mount(mixed $company): void
    {
        $this->company = $company;
    }

    /**
     * Delete the company.
     *
     * @param ValidateCompanyDeletion $validator
     * @param DeletesCompanies $deleter
     * @return RedirectResponse|Redirector
     * @throws AuthorizationException
     */
    public function deleteCompany(ValidateCompanyDeletion $validator, DeletesCompanies $deleter): RedirectResponse|Redirector
    {
        $validator->validate(Auth::user(), $this->company);

        $deleter->delete($this->company);

        return redirect()->to(config('fortify.home'));
    }

    /**
     * Render the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('filament-companies::companies.delete-company-form');
    }
}
