<x-filament-panels::page>
    @livewire(\Wallo\FilamentTenants\Http\Livewire\UpdateTenantNameForm::class, compact('tenant'))

    @livewire(\Wallo\FilamentTenants\Http\Livewire\TenantEmployeeManager::class, compact('tenant'))

    @if (!$tenant->personal_tenant && Gate::check('delete', $tenant))
        <x-filament-tenants::section-border />
        @livewire(\Wallo\FilamentTenants\Http\Livewire\DeleteTenantForm::class, compact('tenant'))
    @endif
</x-filament-panels::page>
