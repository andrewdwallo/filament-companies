<x-filament-companies::grid-section class="mt-8">
    <x-slot name="title">
        {{ __('Company Name') }}
    </x-slot>

    <x-slot name="description">
        {{ __('The company\'s name and owner information.') }}
    </x-slot>

    <x-filament::form wire:submit.prevent="updateCompanyName">
        <!-- Company Owner Information -->
        <div class="col-span-6">
            <x-filament-companies::label value="{{ __('Company Owner') }}" />

            <div class="flex items-center mt-2">
                <img class="w-12 h-12 rounded-full object-cover" src="{{ $company->owner->profile_photo_url }}"
                    alt="{{ $company->owner->name }}">

                <div class="ml-4 leading-tight">
                    <div class="dark:text-white">{{ $company->owner->name }}</div>
                    <div class="text-gray-700 dark:text-gray-300 text-sm">{{ $company->owner->email }}</div>
                </div>
            </div>
        </div>

        <!-- Company Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-filament-companies::label for="name" value="{{ __('Company Name') }}" />

            <x-filament-companies::input id="name" type="text" class="mt-1 block w-full" wire:model.defer="state.name"
                :disabled="!Gate::check('update', $company)" />

            <x-filament-companies::input-error for="name" class="mt-2" />
        </div>

        @if (Gate::check('update', $company))
            <x-filament::button type="submit">
                {{ __('Save') }}
            </x-filament::button>
        @endif
    </x-filament::form>
</x-filament-companies::grid-section>
