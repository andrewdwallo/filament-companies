<x-filament-panels::page.simple>
    <form wire:submit="register">
        {{ $this->form }}

        <x-filament-schemas::form.actions
            :actions="$this->getCachedFormActions()"
            :full-width="$this->hasFullWidthFormActions()"
        />
    </form>
</x-filament-panels::page.simple>
