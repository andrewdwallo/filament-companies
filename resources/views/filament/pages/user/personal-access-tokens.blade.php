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
            <div>
                {{ __('filament-companies::default.modal_descriptions.copy_token') }}
            </div>
        </x-slot>

        <x-filament-companies::input x-ref="plaintextToken" type="text" readonly="readonly" :value="$plainTextToken"
                    class="mt-4 bg-gray-100 dark:bg-gray-800 px-4 py-2 rounded font-mono text-sm text-gray-500 w-full break-all"
                    autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"
                    @showing-token-modal.window="setTimeout(() => $refs.plaintextToken.select(), 250)"
        />

        @if($modals['cancelButtonAction'])
            <x-slot name="footerActions">
                <x-filament::button color="gray" wire:click="cancelDisplayingToken">
                    {{ __('filament-companies::default.buttons.close') }}
                </x-filament::button>
            </x-slot>
        @endif
    </x-filament::modal>
</x-filament-panels::page>
