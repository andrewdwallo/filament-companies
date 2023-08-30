<x-filament-companies::grid-section md="2">
    <x-slot name="title">
        {{ __('filament-companies::default.grid_section_titles.set_password') }}
    </x-slot>

    <x-slot name="description">
        {{ __('filament-companies::default.grid_section_descriptions.set_password') }}
    </x-slot>

    <x-filament::section>
        <x-filament-panels::form wire:submit="setPassword">
            <x-filament-forms::field-wrapper id="password" statePath="password" required="required" label="{{ __('filament-companies::default.labels.new_password') }}">
                <x-filament::input.wrapper class="overflow-hidden">
                    <x-filament::input id="password" type="password" wire:model="state.password" autocomplete="new-password" />
                </x-filament::input.wrapper>
            </x-filament-forms::field-wrapper>

            <x-filament-forms::field-wrapper id="password_confirmation" statePath="password_confirmation" required="required" label="{{ __('filament-companies::default.labels.password_confirmation') }}">
                <x-filament::input.wrapper class="overflow-hidden">
                    <x-filament::input id="password_confirmation" type="password" wire:model="state.password_confirmation" autocomplete="new-password" />
                </x-filament::input.wrapper>
            </x-filament-forms::field-wrapper>

            <div class="text-left">
                <x-filament::button type="submit" x-on:click="setTimeout(() => location.reload(), 3000)">
                    {{ __('filament-companies::default.buttons.save') }}
                </x-filament::button>
            </div>
        </x-filament-panels::form>
    </x-filament::section>
</x-filament-companies::grid-section>
