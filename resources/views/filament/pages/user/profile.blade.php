<x-filament-panels::page>
    @php
        $components = \Wallo\FilamentCompanies\FilamentCompanies::getProfileComponents();
    @endphp

    @foreach($components as $index => $component)
        @livewire($component)
    @endforeach
</x-filament-panels::page>
