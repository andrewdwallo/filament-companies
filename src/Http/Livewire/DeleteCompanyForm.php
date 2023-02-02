<?php

namespace Wallo\FilamentCompanies\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Wallo\FilamentCompanies\Actions\ValidateCompanyDeletion;
use Wallo\FilamentCompanies\Contracts\DeletesCompanies;
use Wallo\FilamentCompanies\RedirectsActions;
use Livewire\Component;

class DeleteCompanyForm extends Component
{
    use RedirectsActions;

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
    public function mount($company)
    {
        $this->company = $company;
    }

    /**
     * Delete the company.
     *
     * @param  \Wallo\FilamentCompanies\Actions\ValidateCompanyDeletion  $validator
     * @param  \Wallo\FilamentCompanies\Contracts\DeletesCompanies  $deleter
     * @return void
     */
    public function deleteCompany(ValidateCompanyDeletion $validator, DeletesCompanies $deleter)
    {
        $validator->validate(Auth::user(), $this->company);

        $deleter->delete($this->company);

        return $this->redirectPath($deleter);
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('filament-companies::companies.delete-company-form');
    }
}
