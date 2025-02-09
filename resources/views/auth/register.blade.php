<x-filament-panels::page.simple>
    @if (filament()->hasLogin())
        <x-slot name="subheading">
            {{ __('filament-panels::pages/auth/register.actions.login.before') }}

            {{ $this->loginAction }}
        </x-slot>
    @endif

    <x-filament-panels::form wire:submit="register">
        {{ $this->form }}

        <x-filament-panels::form.actions
            :actions="$this->getCachedFormActions()"
            :full-width="$this->hasFullWidthFormActions()"
        />
    </x-filament-panels::form>

    @if (\Wallo\FilamentTenants\FilamentTenants::hasSocialiteFeatures())
        <x-filament-tenants::socialite :error-message="$errors->first('filament-tenants')" />
    @endif
</x-filament-panels::page.simple>
