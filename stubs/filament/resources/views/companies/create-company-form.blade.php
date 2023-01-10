<x-filament-companies::grid-section class="mt-8">
    <x-slot name="title">
        {{ __('Create Company') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Create a new company to collaborate with others on projects.') }}
    </x-slot>

    <form wire:submit.prevent="createCompany" class="col-span-2 mt-5 sm:col-span-1 md:mt-0">
        <x-filament::card>
            <div class="col-span-6 sm:col-span-4">
                <x-filament-companies::label value="{{ __('Company Owner') }}" />

                <div class="mt-4 flex items-center">
                    <img class="h-12 w-12 rounded-full object-cover" src="{{ $this->user->profile_photo_url }}"
                        alt="{{ $this->user->name }}">

                    <div class="ml-4 leading-tight">
                        <div class="dark:text-white">{{ $this->user->name }}</div>
                        <div class="text-sm text-gray-700 dark:text-gray-300">{{ $this->user->email }}</div>
                    </div>
                </div>
            </div>

            <div class="col-span-6 sm:col-span-4">
                <x-filament-companies::label for="name" value="{{ __('Company Name') }}" />
                <x-filament-companies::input id="name" type="text" class="mt-1 block w-full"
                    wire:model.defer="state.name" autofocus />
                <x-filament-companies::input-error for="name" class="mt-2" />
            </div>

            <x-slot name="footer">
                <div class="text-left">
                    <x-filament::button type="submit">
                        {{ __('Create') }}
                    </x-filament::button>
                </div>
            </x-slot>
        </x-filament::card>
    </form>
</x-filament-companies::grid-section>
