<x-filament-companies::grid-section>
    <x-slot name="title">
        {{ __('filament-companies::default.grid_section_titles.create_company') }}
    </x-slot>

    <x-slot name="description">
        {{ __('filament-companies::default.grid_section_descriptions.create_company') }}
    </x-slot>

    <form wire:submit.prevent="createCompany" class="col-span-2 sm:col-span-1 mt-5 md:mt-0">
        <x-filament::card>
            <x-filament-companies::label value="{{ __('filament-companies::default.labels.company_owner') }}" />

            <div class="flex items-center text-sm">
                <div class="flex-shrink-0">
                    <img class="h-12 w-12 rounded-full object-cover" src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}">
                </div>
                <div class="ml-4">
                    <div class="font-medium text-gray-900 dark:text-gray-200">{{ $this->user->name }}</div>
                    <div class="text-gray-600 dark:text-gray-400">{{ $this->user->email }}</div>
                </div>
            </div>

            <x-forms::field-wrapper id="name" statePath="name" required label="{{ __('filament-companies::default.labels.company_name') }}">
                <x-filament-companies::input id="name" type="text" maxlength="255" wire:model.defer="state.name" autofocus />
            </x-forms::field-wrapper>

            <x-slot name="footer">
                <div class="text-left">
                    <x-filament::button type="submit">
                        {{ __('filament-companies::default.buttons.create') }}
                    </x-filament::button>
                </div>
            </x-slot>
        </x-filament::card>
    </form>
</x-filament-companies::grid-section>
