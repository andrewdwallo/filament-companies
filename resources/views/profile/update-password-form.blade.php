<x-filament-companies::grid-section class="mt-8">
    <x-slot name="title">
        {{ __('filament-companies::default.grid_section_titles.update_password') }}
    </x-slot>

    <x-slot name="description">
        {{ __('filament-companies::default.grid_section_descriptions.update_password') }}
    </x-slot>

    <form wire:submit.prevent="updatePassword" class="col-span-2 mt-5 sm:col-span-1 md:mt-0">
        <x-filament::card>
            <div class="col-span-6 sm:col-span-4">
                <x-forms::field-wrapper id="current_password" statePath="current_password" required="true" label="{{ __('filament-companies::default.fields.current_password') }}">

                <x-filament-companies::input id="current_password" type="password"
                    wire:model.defer="state.current_password" autocomplete="current-password" />

                </x-forms::field-wrapper>
            </div>

            <div class="col-span-6 sm:col-span-4">

                <x-forms::field-wrapper id="password" statePath="password" required="true" label="{{ __('filament-companies::default.labels.new_password') }}">

                <x-filament-companies::input id="password" type="password" class="mt-1 block w-full"
                    wire:model.defer="state.password" autocomplete="new-password" />

                </x-forms::field-wrapper>
            </div>

            <div class="col-span-6 sm:col-span-4">

                <x-forms::field-wrapper id="password_confirmation" statePath="password_confirmation" required="true" label="{{ __('filament-companies::default.labels.password_confirmation') }}">

                <x-filament-companies::input id="password_confirmation" type="password"
                    wire:model.defer="state.password_confirmation" autocomplete="new-password" />

                </x-forms::field-wrapper>
            </div>

            <x-slot name="footer">
                <div class="text-left">
                    <x-filament::button type="submit">
                        {{ __('filament-companies::default.buttons.save') }}
                    </x-filament::button>
                </div>
            </x-slot>
        </x-filament::card>
    </form>
</x-filament-companies::grid-section>
