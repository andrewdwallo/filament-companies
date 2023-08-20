<x-filament-companies::grid-section md="2">
    <x-slot name="title">
        {{ __('filament-companies::default.grid_section_titles.delete_account') }}
    </x-slot>

    <x-slot name="description">
        {{ __('filament-companies::default.grid_section_descriptions.delete_account') }}
    </x-slot>

    <x-filament::section>
        <div class="space-y-6">
            <p class="text-sm text-gray-600 dark:text-gray-400">
                {{ __('filament-companies::default.subheadings.profile.delete_user') }}
            </p>

            <!-- Delete User Confirmation Modal -->
            <x-filament::modal id="confirmingUserDeletion" icon="heroicon-o-exclamation-triangle" icon-color="danger" alignment="center" footer-actions-alignment="center" width="3xl">
                <x-slot name="trigger">
                    <div class="text-left">
                        <x-filament::button color="danger" wire:click="confirmUserDeletion" wire:loading.attr="disabled">
                            {{ __('filament-companies::default.buttons.delete_account') }}
                        </x-filament::button>
                    </div>
                </x-slot>

                <x-slot name="heading">
                    {{ __('filament-companies::default.modal_titles.delete_account') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('filament-companies::default.modal_descriptions.delete_account') }}
                </x-slot>

                <x-filament-forms::field-wrapper id="password" statePath="password" x-data="{}" x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
                    <x-filament::input.wrapper>
                        <x-filament::input type="password" placeholder="{{ __('filament-companies::default.fields.password') }}" x-ref="password" wire:model="password" wire:keydown.enter="deleteUser" />
                    </x-filament::input.wrapper>
                </x-filament-forms::field-wrapper>

                <x-slot name="footerActions">
                    <x-filament::button color="gray" x-on:click="$dispatch('close-modal', { id: 'confirmingUserDeletion' })" wire:loading.attr="disabled">
                        {{ __('filament-companies::default.buttons.cancel') }}
                    </x-filament::button>

                    <x-filament::button color="danger" wire:click="deleteUser" wire:loading.attr="disabled">
                        {{ __('filament-companies::default.buttons.delete_account') }}
                    </x-filament::button>
                </x-slot>
            </x-filament::modal>
        </div>
    </x-filament::section>
</x-filament-companies::grid-section>
