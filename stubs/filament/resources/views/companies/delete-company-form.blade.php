<x-filament-companies::action-section>
    <x-slot name="title">
        {{ __('Delete Company') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Permanently delete this company.') }}
    </x-slot>

    <x-slot name="content">
        <x-filament::card>
            <div class="max-w-xl text-sm text-gray-600 dark:text-gray-400">
                {{ __('Once a company is deleted, all of its resources and data will be permanently deleted. Before
                                                deleting this company, please download any data or information regarding this company that you wish to
                                                retain.') }}
            </div>

            <x-slot name="footer">
                <div class="text-left">
                    <x-filament::button wire:click="$toggle('confirmingCompanyDeletion')" wire:loading.attr="disabled">
                        {{ __('Delete Company') }}
                    </x-filament::button>
                </div>
            </x-slot>

            <!-- Delete Company Confirmation Modal -->
            <x-filament-companies::dialog-modal wire:model="confirmingCompanyDeletion">
                <x-slot name="title">
                    {{ __('Delete Company') }}
                </x-slot>

                <x-slot name="content">
                    {{ __('Are you sure you want to delete this company? Once a company is deleted, all of its resources
                                                            and data will be permanently deleted.') }}
                </x-slot>

                <x-slot name="footer">
                    <x-filament::button color="gray" class="mr-3" wire:click="$toggle('confirmingCompanyDeletion')"
                        wire:loading.attr="disabled">
                        {{ __('Cancel') }}
                    </x-filament::button>

                    <x-filament::button color="danger" class="ml-3" wire:click="deleteCompany"
                        wire:loading.attr="disabled">
                        {{ __('Delete Company') }}
                    </x-filament::button>
                </x-slot>
            </x-filament-companies::dialog-modal>
        </x-filament::card>
    </x-slot>
</x-filament-companies::action-section>
