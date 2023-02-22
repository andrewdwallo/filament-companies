<x-filament::page>
    <div>
        <div class="mx-auto max-w-7xl py-10 sm:px-6 lg:px-8">
            @livewire(\Wallo\FilamentCompanies\Http\Livewire\UpdateCompanyNameForm::class, ['company' => $company])

            @livewire(\Wallo\FilamentCompanies\Http\Livewire\CompanyEmployeeManager::class, ['company' => $company])

            @if (!$company->personal_company && Gate::check('delete', $company))
                <x-filament-companies::section-border/>

                <div class="mt-10 sm:mt-0">
                    @livewire(\Wallo\FilamentCompanies\Http\Livewire\DeleteCompanyForm::class, ['company' => $company])
                </div>
            @endif
        </div>
    </div>
</x-filament::page>
