<x-filament-companies::grid-section class="mt-8">
    <x-slot name="title">
        {{ __('Company Name') }}
    </x-slot>

    <x-slot name="description">
        {{ __('The company\'s name and owner information.') }}
    </x-slot>

    <form wire:submit.prevent="updateCompanyName" class="col-span-2 mt-5 sm:col-span-1 md:mt-0">
        <x-filament::card>
            <!-- Company Owner Information -->
            <div class="col-span-6">
                <x-filament-companies::label value="{{ __('Company Owner') }}" />

                <div class="mt-4 flex items-center">
                    <img class="h-12 w-12 rounded-full object-cover" src="{{ $company->owner->profile_photo_url }}"
                        alt="{{ $company->owner->name }}">

                    <div class="ml-4 leading-tight">
                        <div class="dark:text-white">{{ $company->owner->name }}</div>
                        <div class="text-sm text-gray-700 dark:text-gray-300">{{ $company->owner->email }}</div>
                    </div>
                </div>
            </div>

            <!-- Company Name -->
            <div class="col-span-6 sm:col-span-4">
                <x-filament-companies::label for="name" value="{{ __('Company Name') }}" />

                <x-filament-companies::input id="name" type="text" class="mt-1 block w-full"
                    wire:model.defer="state.name" :disabled="!Gate::check('update', $company)" />

                <x-filament-companies::input-error for="name" class="mt-2" />
            </div>

            @if (Gate::check('update', $company))
                <x-slot name="footer">
                    <div class="text-left">
                        <x-filament::button type="submit">
                            {{ __('Save') }}
                        </x-filament::button>
                    </div>
                </x-slot>
            @endif
        </x-filament::card>
    </form>
</x-filament-companies::grid-section>
