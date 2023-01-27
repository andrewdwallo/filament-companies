<x-filament::page>
    <div class="mt-10 sm:mt-0">
        @livewire(\Wallo\FilamentCompanies\Http\Livewire\UpdateCompanyNameForm::class, ['company' => $company])

        <x-filament-companies::section-border />

        @livewire(\Wallo\FilamentCompanies\Http\Livewire\CompanyEmployeeManager::class, ['company' => $company])

        <x-filament-companies::section-border />

        @if (Gate::check('delete', $company) && !$company->personal_company)
            <div class="mt-10 sm:mt-0">
                @livewire(\Wallo\FilamentCompanies\Http\Livewire\DeleteCompanyForm::class, ['company' => $company])
            </div>
        @endif

    </div>
</x-filament::page>
