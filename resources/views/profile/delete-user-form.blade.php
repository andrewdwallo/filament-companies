<x-filament-companies::grid-section>
    <x-slot name="title">
        {{ __('filament-companies::default.grid_section_titles.delete_account') }}
    </x-slot>

    <x-slot name="description">
        {{ __('filament-companies::default.grid_section_descriptions.delete_account') }}
    </x-slot>

    <x-filament::card class="col-span-2 sm:col-span-1 mt-5 md:mt-0">
        <p class="text-sm text-gray-600 dark:text-gray-400">
            {{ __('filament-companies::default.subheadings.profile.delete_user') }}
        </p>

        <x-slot name="footer">
            <div class="text-left">
                <x-filament::button color="danger" wire:click="confirmUserDeletion" wire:loading.attr="disabled">
                    {{ __('filament-companies::default.buttons.delete_account') }}
                </x-filament::button>
            </div>
        </x-slot>

        <!-- Delete User Confirmation Modal -->
        <x-filament-companies::dialog-modal wire:model="confirmingUserDeletion">

            <x-slot name="title">
                {{ __('filament-companies::default.modal_titles.delete_account') }}
            </x-slot>

            <x-slot name="content">
                {{ __('filament-companies::default.modal_descriptions.delete_account') }}

                <div class="mt-4">
                    <x-forms::field-wrapper id="password" statePath="password" x-data="{}" x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
                        <x-filament-companies::input type="password" placeholder="{{ __('filament-companies::default.fields.password') }}" x-ref="password" wire:model.defer="password" wire:keydown.enter="deleteUser" />
                    </x-forms::field-wrapper>
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-filament::button color="secondary" wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled">
                    {{ __('filament-companies::default.buttons.cancel') }}
                </x-filament::button>

                <x-filament::button color="danger" wire:click="deleteUser" wire:loading.attr="disabled">
                    {{ __('filament-companies::default.buttons.delete_account') }}
                </x-filament::button>
            </x-slot>
        </x-filament-companies::dialog-modal>
    </x-filament::card>
</x-filament-companies::grid-section>
