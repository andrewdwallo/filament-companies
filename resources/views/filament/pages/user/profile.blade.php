<x-filament-panels::page>
    @php
        $components = \Wallo\FilamentTenants\FilamentTenants::getProfileComponents();
    @endphp

    @foreach($components as $index => $component)
        @livewire($component)

        @if($loop->remaining)
            <x-filament-tenants::section-border />
        @endif
    @endforeach
</x-filament-panels::page>
