<x-filament-companies::action-section>
    <x-slot name="title">
        {{ __('Delete Company') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Permanently delete this company.') }}
        {{ __('Once a company is deleted, all of its resources and data will be permanently deleted. Before deleting this company, please download any data or information regarding this company that you wish to retain.') }}
    </x-slot>

    <x-slot name="content">
        <div class="max-w-xl text-sm text-gray-600 dark:text-gray-400">
            <x-filament::button wire:click="$toggle('confirmingCompanyDeletion')" wire:loading.attr="disabled">
                {{ __('Delete Company') }}
            </x-filament::button>
        </div>

        <!-- Delete Company Confirmation Modal -->
        <x-filament-companies::confirmation-modal wire:model="confirmingCompanyDeletion">
            <x-slot name="title">
                {{ __('Delete Company') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Are you sure you want to delete this company? Once a company is deleted, all of its resources and data will be permanently deleted.') }}
            </x-slot>

            <x-slot name="footer">
                <x-filament::button color="gray" class="mr-3" wire:click="$toggle('confirmingCompanyDeletion')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-filament::button>

                <x-filament::button color="danger" class="ml-3" wire:click="deleteCompany" wire:loading.attr="disabled">
                    {{ __('Delete Company') }}
                </x-filament::button>
            </x-slot>
        </x-filament-companies::confirmation-modal>
    </x-slot>
</x-filament-companies::action-section>
