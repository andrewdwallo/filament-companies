<x-filament-tenants::grid-section md="2">
    <x-slot name="title">
        {{ __('filament-tenants::default.grid_section_titles.tenant_name') }}
    </x-slot>

    <x-slot name="description">
        {{ __('filament-tenants::default.grid_section_descriptions.tenant_name') }}
    </x-slot>

    <x-filament::section>
        <x-filament-panels::form wire:submit="updateTenantName">
                <!-- Tenant Owner Information -->
                <x-filament-forms::field-wrapper.label>
                    {{ __('filament-tenants::default.labels.tenant_owner') }}
                </x-filament-forms::field-wrapper.label>

                <div class="flex items-center text-sm">
                    <div class="flex-shrink-0">
                        <x-filament-panels::avatar.user :user="$tenant->owner" style="height: 3rem; width: 3rem;" />
                    </div>
                    <div class="ml-4">
                        <div class="font-medium text-gray-900 dark:text-gray-200">{{ $tenant->owner->name }}</div>
                        <div class="text-gray-600 dark:text-gray-400">{{ $tenant->owner->email }}</div>
                    </div>
                </div>

                <!-- Tenant Name -->
                <x-filament-forms::field-wrapper id="name" statePath="name" required="required" label="{{ __('filament-tenants::default.labels.tenant_name') }}">
                    <x-filament::input.wrapper class="overflow-hidden">
                        <x-filament::input id="name" type="text" maxlength="255" wire:model="state.name" :disabled="!Gate::check('update', $tenant)" />
                    </x-filament::input.wrapper>
                </x-filament-forms::field-wrapper>

                @if (Gate::check('update', $tenant))
                    <div class="text-left">
                        <x-filament::button type="submit">
                            {{ __('filament-tenants::default.buttons.save') }}
                        </x-filament::button>
                    </div>
                @endif
        </x-filament-panels::form>
    </x-filament::section>
</x-filament-tenants::grid-section>
