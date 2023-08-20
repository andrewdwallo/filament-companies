<x-filament-panels::page>
    @livewire(\Wallo\FilamentCompanies\Http\Livewire\UpdateCompanyNameForm::class, compact('company'))

    @livewire(\Wallo\FilamentCompanies\Http\Livewire\CompanyEmployeeManager::class, compact('company'))

    @if (!$company->personal_company && Gate::check('delete', $company))
        <x-filament-companies::section-border />
        @livewire(\Wallo\FilamentCompanies\Http\Livewire\DeleteCompanyForm::class, compact('company'))
    @endif
</x-filament-panels::page>
