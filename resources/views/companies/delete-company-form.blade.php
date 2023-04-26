<x-filament-companies::grid-section>
    <x-slot name="title">
        {{ __('filament-companies::default.action_section_titles.delete_company') }}
    </x-slot>

    <x-slot name="description">
        {{ __('filament-companies::default.action_section_descriptions.delete_company') }}
    </x-slot>

    <x-filament::card class="col-span-2 sm:col-span-1 mt-5 md:mt-0">
        <div class="max-w-xl text-sm text-gray-600 dark:text-gray-400">
            {{ __('filament-companies::default.subheadings.companies.delete_company') }}
        </div>

        <x-slot name="footer">
            <div class="text-left">
                <x-filament::button color="danger" wire:click="$toggle('confirmingCompanyDeletion')" wire:loading.attr="disabled">
                    {{ __('filament-companies::default.buttons.delete_company') }}
                </x-filament::button>
            </div>
        </x-slot>

        <!-- Delete Company Confirmation Modal -->
        <x-filament-companies::dialog-modal wire:model="confirmingCompanyDeletion">
            <x-slot name="title">
                {{ __('filament-companies::default.modal_titles.delete_company') }}
            </x-slot>

            <x-slot name="content">
                {{ __('filament-companies::default.modal_descriptions.delete_company') }}
            </x-slot>

            <x-slot name="footer">
                <x-filament::button color="secondary" class="mr-3" wire:click="$toggle('confirmingCompanyDeletion')" wire:loading.attr="disabled">
                    {{ __('filament-companies::default.buttons.cancel') }}
                </x-filament::button>

                <x-filament::button color="danger" class="ml-3" wire:click="deleteCompany" wire:loading.attr="disabled">
                    {{ __('filament-companies::default.buttons.delete_company') }}
                </x-filament::button>
            </x-slot>
        </x-filament-companies::dialog-modal>
    </x-filament::card>
</x-filament-companies::grid-section>
