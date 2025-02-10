<x-filament-panels::page>
    <x-filament-panels::form id="form" wire:submit="save" class="gap-y-1">
        {{ $this->form }}

        @if (Gate::check('update'))
            <div class="text-right">
                <x-filament::button type="submit">
                    {{ __('filament-tenants::default.buttons.save') }}
                </x-filament::button>
            </div>
        @endif
    </x-filament-panels::form>

    @php
        $components = \Wallo\FilamentTenants\FilamentTenants::getProfileComponents();
        $user = $this->record ?? auth()->user();
    @endphp

    @foreach($components as $index => $component)
        @livewire($component, ['user' => $user])

        @if($loop->remaining)
            <x-filament-tenants::section-border />
        @endif
    @endforeach
</x-filament-panels::page>
