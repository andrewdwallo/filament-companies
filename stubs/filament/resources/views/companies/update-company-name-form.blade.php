<x-filament-companies::form-section submit="updateCompanyName">
    <x-slot name="title">
        {{ __('Company Name') }}
    </x-slot>

    <x-slot name="description">
        {{ __('The company\'s name and owner information.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Company Owner Information -->
        <div class="col-span-6">
            <x-filament-companies::label value="{{ __('Company Owner') }}" />

            <div class="flex items-center mt-2">
                <img class="w-12 h-12 rounded-full object-cover" src="{{ $company->owner->profile_photo_url }}" alt="{{ $company->owner->name }}">

                <div class="ml-4 leading-tight">
                    <div>{{ $company->owner->name }}</div>
                    <div class="text-gray-700 text-sm">{{ $company->owner->email }}</div>
                </div>
            </div>
        </div>

        <!-- Company Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-filament-companies::label for="name" value="{{ __('Company Name') }}" />

            <x-filament-companies::input id="name"
                        type="text"
                        class="mt-1 block w-full"
                        wire:model.defer="state.name"
                        :disabled="! Gate::check('update', $company)" />

            <x-filament-companies::input-error for="name" class="mt-2" />
        </div>
    </x-slot>

    @if (Gate::check('update', $company))
        <x-slot name="actions">
            <x-filament-companies::action-message class="mr-3" on="saved">
                {{ __('Saved.') }}
            </x-filament-companies::action-message>

            <x-filament-companies::button>
                {{ __('Save') }}
            </x-filament-companies::button>
        </x-slot>
    @endif
</x-filament-companies::form-section>
