@php
    $modals = \Wallo\FilamentTenants\FilamentTenants::getModals();
@endphp

<x-filament-tenants::grid-section md="2">
    <x-slot name="title">
        {{ __('filament-tenants::default.action_section_titles.delete_tenant') }}
    </x-slot>

    <x-slot name="description">
        {{ __('filament-tenants::default.action_section_descriptions.delete_tenant') }}
    </x-slot>

    <x-filament::section>
        <div class="grid gap-y-6">
            <div class="max-w-xl text-sm text-gray-600 dark:text-gray-400">
                {{ __('filament-tenants::default.subheadings.tenants.delete_tenant') }}
            </div>

            <!-- Delete Tenant Confirmation Modal -->
            <x-filament::modal id="confirmingTenantDeletion" icon="heroicon-o-exclamation-triangle" icon-color="danger" alignment="{{ $modals['alignment'] }}" footer-actions-alignment="{{ $modals['formActionsAlignment'] }}" width="{{ $modals['width'] }}">
                <x-slot name="trigger">
                    <div class="text-left">
                        <x-filament::button color="danger">
                            {{ __('filament-tenants::default.buttons.delete_tenant') }}
                        </x-filament::button>
                    </div>
                </x-slot>

                <x-slot name="heading">
                    {{ __('filament-tenants::default.modal_titles.delete_tenant') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('filament-tenants::default.modal_descriptions.delete_tenant') }}
                </x-slot>

                <x-slot name="footerActions">
                    @if($modals['cancelButtonAction'])
                        <x-filament::button color="gray" wire:click="cancelTenantDeletion">
                            {{ __('filament-tenants::default.buttons.cancel') }}
                        </x-filament::button>
                    @endif

                    <x-filament::button color="danger" wire:click="deleteTenant">
                        {{ __('filament-tenants::default.buttons.delete_tenant') }}
                    </x-filament::button>
                </x-slot>
            </x-filament::modal>
        </div>
    </x-filament::section>
</x-filament-tenants::grid-section>
