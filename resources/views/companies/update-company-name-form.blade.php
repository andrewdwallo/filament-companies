<x-filament-companies::grid-section md="2">
    <x-slot name="title">
        {{ __('filament-companies::default.grid_section_titles.company_name') }}
    </x-slot>

    <x-slot name="description">
        {{ __('filament-companies::default.grid_section_descriptions.company_name') }}
    </x-slot>

    <x-filament::section>
        <x-filament-panels::form wire:submit="updateCompanyName">
                <!-- Company Owner Information -->
                <x-filament-forms::field-wrapper.label>
                    {{ __('filament-companies::default.labels.company_owner') }}
                </x-filament-forms::field-wrapper.label>

                <div class="flex items-center text-sm">
                    <div class="flex-shrink-0">
                        <x-filament-panels::avatar.user :user="$company->owner" style="height: 3rem; width: 3rem;" />
                    </div>
                    <div class="ml-4">
                        <div class="font-medium text-gray-900 dark:text-gray-200">{{ $company->owner->name }}</div>
                        <div class="text-gray-600 dark:text-gray-400">{{ $company->owner->email }}</div>
                    </div>
                </div>

                <!-- Company Name -->
                <x-filament-forms::field-wrapper id="name" statePath="name" required="required" label="{{ __('filament-companies::default.labels.company_name') }}">
                    <x-filament::input.wrapper class="overflow-hidden">
                        <x-filament::input id="name" type="text" maxlength="255" wire:model="state.name" :disabled="!Gate::check('update', $company)" />
                    </x-filament::input.wrapper>
                </x-filament-forms::field-wrapper>

                @if (Gate::check('update', $company))
                    <div class="text-left">
                        <x-filament::button type="submit">
                            {{ __('filament-companies::default.buttons.save') }}
                        </x-filament::button>
                    </div>
                @endif
        </x-filament-panels::form>
    </x-filament::section>
</x-filament-companies::grid-section>
