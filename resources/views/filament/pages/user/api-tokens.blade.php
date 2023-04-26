<x-filament::page>
    <div>
        {{ $this->table }}

        <x-filament-companies::dialog-modal wire:model="displayingToken">

            <x-slot name="title">
                {{ __('filament-companies::default.modal_titles.api_token') }}
            </x-slot>

            <x-slot name="content">
                <div>
                    {{ __('filament-companies::default.modal_descriptions.api_token') }}
                </div>

                <x-filament-companies::input x-ref="plaintextToken" type="text" readonly :value="$plainTextToken"
                    class="mt-4 bg-gray-100 px-4 py-2 rounded font-mono text-sm text-gray-500 w-full break-all"
                    autofocus autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"
                    @showing-token-modal.window="setTimeout(() => $refs.plaintextToken.select(), 250)"
                />
            </x-slot>

            <x-slot name="footer">
                <x-filament::button color="secondary" wire:click="$set('displayingToken', false)" wire:loading.attr="disabled">
                    {{ __('filament-companies::default.buttons.close') }}
                </x-filament::button>
            </x-slot>
        </x-filament-companies::dialog-modal>
    </div>
</x-filament::page>
