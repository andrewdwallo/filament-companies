<x-filament-panels::page>
    @php
        $components = \Wallo\FilamentCompanies\FilamentCompanies::getCompanyComponents();
        $deleteCompanyForm = \Wallo\FilamentCompanies\FilamentCompanies::getDeleteCompanyForm();
    @endphp

    <div class="space-y-6">
        @foreach($components as $component)
            @if($component === $deleteCompanyForm)
                @if (! $company->personal_company && Gate::check('delete', $company))
                    @livewire($component, compact('company'))
                @endif
            @else
                @livewire($component, compact('company'))
            @endif
        @endforeach
    </div>
</x-filament-panels::page>

