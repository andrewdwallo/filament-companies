<x-filament::page>
        <div class="mt-10 sm:mt-0">
            @livewire('companies.update-company-name-form', ['company' => $company])

            <x-filament-companies::section-border />

            @livewire('companies.company-employee-manager', ['company' => $company])

            <x-filament-companies::section-border />

            @if (Gate::check('delete', $company) && ! $company->personal_company)

                <div class="mt-10 sm:mt-0">
                    @livewire('companies.delete-company-form', ['company' => $company])
                </div>
            @endif

        </div>
</x-filament::page>
