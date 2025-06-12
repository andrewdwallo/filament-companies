<x-filament-panels::page.simple>
    @if (filament()->hasLogin())
        <x-slot name="subheading">
            {{ __('filament-panels::pages/auth/register.actions.login.before') }}

            {{ $this->loginAction }}
        </x-slot>
    @endif

    {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::AUTH_REGISTER_FORM_BEFORE, scopes: $this->getRenderHookScopes()) }}

    <form wire:submit="register">
        {{ $this->form }}

        <x-filament-schemas::form.actions
            :actions="$this->getCachedFormActions()"
            :full-width="$this->hasFullWidthFormActions()"
        />
    </form>

    {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::AUTH_REGISTER_FORM_AFTER, scopes: $this->getRenderHookScopes()) }}

    @if (\Wallo\FilamentCompanies\FilamentCompanies::hasSocialiteFeatures())
        <x-filament-companies::socialite :error-message="$errors->first('filament-companies')" />
    @endif
</x-filament-panels::page.simple>
