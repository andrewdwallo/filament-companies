<x-filament::page>
    <div>
        <div class="mx-auto max-w-7xl py-10 sm:px-6 lg:px-8">
            {{ $this->table }}

            <x-filament-companies::dialog-modal wire:model="displayingToken" maxWidth="md"
                class="flex items-center justify-center space-x-2 rtl:space-x-reverse">

                <x-slot name="title">
                    {{ __('filament-companies::default.modal_titles.api_token') }}
                </x-slot>

                <x-slot name="content">
                    <div>
                        {{ __('filament-companies::default.modal_descriptions.api_token') }}
                    </div>

                    <x-filament-companies::input x-ref="plaintextToken" type="text" readonly="required" :value="$plainTextToken"
                        class="mt-4 w-full rounded bg-gray-100 px-4 py-2 font-mono text-sm text-gray-500" autofocus="on"
                        autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"
                        @showing-token-modal.window="setTimeout(() => $refs.plaintextToken.select(), 250)" />
                </x-slot>

                <x-slot name="footer">
                    <x-filament::button color="gray" wire:click="$set('displayingToken', false)"
                        wire:loading.attr="disabled">
                        {{ __('filament-companies::default.buttons.close') }}
                    </x-filament::button>
                </x-slot>
            </x-filament-companies::dialog-modal>
        </div>
    </div>
</x-filament::page>
