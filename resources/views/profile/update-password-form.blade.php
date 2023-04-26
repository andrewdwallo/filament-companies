<x-filament-companies::grid-section>
    <x-slot name="title">
        {{ __('filament-companies::default.grid_section_titles.update_password') }}
    </x-slot>

    <x-slot name="description">
        {{ __('filament-companies::default.grid_section_descriptions.update_password') }}
    </x-slot>

    <form wire:submit.prevent="updatePassword" class="col-span-2 sm:col-span-1 mt-5 md:mt-0">
        <x-filament::card>
            <x-forms::field-wrapper id="current_password" statePath="current_password" required label="{{ __('filament-companies::default.fields.current_password') }}">
                <x-filament-companies::input id="current_password" type="password" wire:model.defer="state.current_password" required autocomplete="current-password" />
            </x-forms::field-wrapper>

            <x-forms::field-wrapper id="password" statePath="password" required label="{{ __('filament-companies::default.labels.new_password') }}">
                <x-filament-companies::input id="password" type="password" wire:model.defer="state.password" required autocomplete="new-password" />
            </x-forms::field-wrapper>

            <x-forms::field-wrapper id="password_confirmation" statePath="password_confirmation" required label="{{ __('filament-companies::default.labels.password_confirmation') }}">
                <x-filament-companies::input id="password_confirmation" type="password" wire:model.defer="state.password_confirmation" required autocomplete="new-password" />
            </x-forms::field-wrapper>

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
