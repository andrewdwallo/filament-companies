<x-filament::page>
    <div>
        <div class="mx-auto max-w-7xl py-10 sm:px-6 lg:px-8">
            @livewire(\Wallo\FilamentCompanies\Http\Livewire\CreateCompanyForm::class, ['company' => $company])
        </div>
    </div>
</x-filament::page>
