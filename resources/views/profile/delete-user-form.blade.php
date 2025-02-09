@php
    $modals = \Wallo\FilamentTenants\FilamentTenants::getModals();
@endphp

<x-filament-tenants::grid-section md="2">
    <x-slot name="title">
        {{ __('filament-tenants::default.grid_section_titles.delete_account') }}
    </x-slot>

    <x-slot name="description">
        {{ __('filament-tenants::default.grid_section_descriptions.delete_account') }}
    </x-slot>

    <x-filament::section>
        <div class="grid gap-y-6">
            <p class="text-sm text-gray-600 dark:text-gray-400">
                {{ __('filament-tenants::default.subheadings.profile.delete_user') }}
            </p>

            <!-- Delete User Confirmation Modal -->
            <x-filament::modal id="confirmingUserDeletion" icon="heroicon-o-exclamation-triangle" icon-color="danger" alignment="{{ $modals['alignment'] }}" footer-actions-alignment="{{ $modals['formActionsAlignment'] }}" width="{{ $modals['width'] }}">
                <x-slot name="trigger">
                    <div class="text-left">
                        <x-filament::button color="danger" wire:click="confirmUserDeletion">
                            {{ __('filament-tenants::default.buttons.delete_account') }}
                        </x-filament::button>
                    </div>
                </x-slot>

                <x-slot name="heading">
                    {{ __('filament-tenants::default.modal_titles.delete_account') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('filament-tenants::default.modal_descriptions.delete_account') }}
                </x-slot>

                <x-filament-forms::field-wrapper id="password" statePath="password" x-data="{}" x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
                    <x-filament::input.wrapper>
                        <x-filament::input type="password" placeholder="{{ __('filament-tenants::default.fields.password') }}" x-ref="password" wire:model="password" wire:keydown.enter="deleteUser" />
                    </x-filament::input.wrapper>
                </x-filament-forms::field-wrapper>

                <x-slot name="footerActions">
                    @if($modals['cancelButtonAction'])
                        <x-filament::button color="gray" wire:click="cancelUserDeletion">
                            {{ __('filament-tenants::default.buttons.cancel') }}
                        </x-filament::button>
                    @endif

                    <x-filament::button color="danger" wire:click="deleteUser">
                        {{ __('filament-tenants::default.buttons.delete_account') }}
                    </x-filament::button>
                </x-slot>
            </x-filament::modal>
        </div>
    </x-filament::section>
</x-filament-tenants::grid-section>
