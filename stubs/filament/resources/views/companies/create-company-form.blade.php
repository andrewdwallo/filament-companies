<x-filament-companies::grid-section class="mt-8">
    <x-slot name="title">
        {{ __('Create Company') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Create a new company to collaborate with others on projects.') }}
    </x-slot>

    <x-filament::form wire:submit.prevent="createCompany">
        <div class="col-span-6 sm:col-span-4">
            <x-filament-companies::label value="{{ __('Company Owner') }}" />

            <div class="flex items-center mt-2">
                <img class="w-12 h-12 rounded-full object-cover" src="{{ $this->user->profile_photo_url }}"
                    alt="{{ $this->user->name }}">

                <div class="ml-4 leading-tight">
                    <div>{{ $this->user->name }}</div>
                    <div class="text-gray-700 text-sm">{{ $this->user->email }}</div>
                </div>
            </div>
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-filament-companies::label for="name" value="{{ __('Company Name') }}" />
            <x-filament-companies::input id="name" type="text" class="mt-1 block w-full" wire:model.defer="state.name"
                autofocus />
            <x-filament-companies::input-error for="name" class="mt-2" />
        </div>

        <x-filament::button type="submit">
            {{ __('Create') }}
        </x-filament::button>
    </x-filament::form>
</x-filament-companies::grid-section>

