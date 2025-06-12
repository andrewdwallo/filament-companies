@php
    $modals = \Wallo\FilamentCompanies\FilamentCompanies::getModals();
@endphp

<x-filament-panels::page>
    {{ $this->table }}

    <x-filament::modal id="displayingToken" icon="heroicon-o-key" icon-color="primary" alignment="{{ $modals['alignment'] }}" footer-actions-alignment="{{ $modals['formActionsAlignment'] }}" width="{{ $modals['width'] }}">
        <x-slot name="heading">
            {{ __('filament-companies::default.modal_titles.token') }}
        </x-slot>

        <x-slot name="description">
            {{ __('filament-companies::default.modal_descriptions.copy_token') }}
        </x-slot>

        <x-filament::input.wrapper class="mt-4">
            <x-filament::input x-ref="plaintextToken" type="text" readonly :value="$plainTextToken"
                        class="font-mono text-sm w-full"
                        autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"
                        @showing-token-modal.window="setTimeout(() => $refs.plaintextToken.select(), 250)"
            />
        </x-filament::input.wrapper>

        @if($modals['cancelButtonAction'])
            <x-slot name="footerActions">
                <x-filament::button color="gray" wire:click="cancelDisplayingToken">
                    {{ __('filament-companies::default.buttons.close') }}
                </x-filament::button>
            </x-slot>
        @endif
    </x-filament::modal>
</x-filament-panels::page>
