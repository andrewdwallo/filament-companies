<x-filament-companies::grid-section class="mt-8">
    <x-slot name="title">
        {{ __('filament-companies::default.grid_section_titles.two_factor_authentication') }}
    </x-slot>

    <x-slot name="description">
        {{ __('filament-companies::default.grid_section_descriptions.two_factor_authentication') }}
    </x-slot>

    <x-filament::card class="col-span-2 mt-5 sm:col-span-1 md:mt-0">
        <h3 class="text-lg font-medium text-gray-900 dark:text-white">
            @if ($this->enabled)
                @if ($showingConfirmation)
                    {{ __('filament-companies::default.headings.profile.two_factor_authentication.finish_enabling') }}
                @else
                    {{ __('filament-companies::default.headings.profile.two_factor_authentication.enabled') }}
                @endif
            @else
                {{ __('filament-companies::default.headings.profile.two_factor_authentication.not_enabled') }}
            @endif
        </h3>

        <div class="mt-3 max-w-xl text-sm text-gray-600 dark:text-gray-400">
            {{ __('filament-companies::default.subheadings.profile.two_factor_authentication.summary') }}
        </div>

        @if ($this->enabled)
            @if ($showingQrCode)
                <div class="mt-4 max-w-xl text-sm text-gray-600 dark:text-gray-400">
                    <p class="font-semibold">
                        @if ($showingConfirmation)
                            {{ __('filament-companies::default.subheadings.profile.two_factor_authentication.finish_enabling') }}
                        @else
                            {{ __('filament-companies::default.subheadings.profile.two_factor_authentication.enabled') }}
                        @endif
                    </p>
                </div>

                <div class="mt-4">
                    {!! $this->user->twoFactorQrCodeSvg() !!}
                </div>

                <div class="mt-4 max-w-xl text-sm text-gray-600 dark:text-gray-400">
                    <p class="font-semibold">
                        {{ __('filament-companies::default.labels.setup_key') }}: {{ decrypt($this->user->two_factor_secret) }}
                    </p>
                </div>

                @if ($showingConfirmation)
                    <div class="mt-4">
                        <x-filament-companies::label
                            for="code"
                            value="{{ __('filament-companies::default.fields.code') }}" />

                        <x-filament-companies::input
                            id="code"
                            type="text"
                            name="code"
                            class="mt-1 block w-1/2"
                            inputmode="numeric"
                            autofocus autocomplete="one-time-code"
                            wire:model.defer="code"
                            wire:keydown.enter="confirmTwoFactorAuthentication" />

                        <x-filament-companies::input-error
                            for="code"
                            class="mt-2" />
                    </div>
                @endif
            @endif

            @if ($showingRecoveryCodes)
                <div class="mt-4 max-w-xl text-sm text-gray-600 dark:text-gray-400">
                    <p class="font-semibold">
                        {{ __('filament-companies::default.subheadings.profile.two_factor_authentication.store_codes') }}
                    </p>
                </div>

                <div class="mt-4 grid max-w-xl gap-1 rounded-lg bg-gray-100 px-4 py-4 font-mono text-sm dark:bg-gray-800">
                    @foreach (json_decode(decrypt($this->user->two_factor_recovery_codes), true) as $code)
                        <div>{{ $code }}</div>
                    @endforeach
                </div>
            @endif
        @endif

        <x-slot name="footer">
            <div class="text-left">
                @if (!$this->enabled)
                    <x-filament-companies::confirms-password wire:then="enableTwoFactorAuthentication">
                        <x-filament::button wire:loading.attr="disabled">
                            {{ __('filament-companies::default.buttons.enable') }}
                        </x-filament::button>
                    </x-filament-companies::confirms-password>
                @else
                    @if ($showingRecoveryCodes)
                        <x-filament-companies::confirms-password wire:then="regenerateRecoveryCodes">
                            <x-filament::button
                                type="submit"
                                class="mr-3">
                                {{ __('filament-companies::default.buttons.regenerate_recovery_codes') }}

                            </x-filament::button>
                        </x-filament-companies::confirms-password>
                    @elseif ($showingConfirmation)
                        <x-filament-companies::confirms-password wire:then="confirmTwoFactorAuthentication">
                            <x-filament::button
                                type="button"
                                class="mr-3"
                                wire:loading.attr="disabled">
                                {{ __('filament-companies::default.buttons.confirm') }}

                            </x-filament::button>
                        </x-filament-companies::confirms-password>
                    @else
                        <x-filament-companies::confirms-password wire:then="showRecoveryCodes">
                            <x-filament::button
                                type="submit"
                                class="mr-3">
                                {{ __('filament-companies::default.buttons.show_recovery_codes') }}

                            </x-filament::button>
                        </x-filament-companies::confirms-password>
                    @endif

                    @if ($showingConfirmation)
                        <x-filament-companies::confirms-password wire:then="disableTwoFactorAuthentication">
                            <x-filament::button
                                color="gray"
                                wire:loading.attr="disabled">
                                {{ __('filament-companies::default.buttons.cancel') }}

                            </x-filament::button>
                        </x-filament-companies::confirms-password>
                    @else
                        <x-filament-companies::confirms-password wire:then="disableTwoFactorAuthentication">
                            <x-filament::button
                                color="gray"
                                wire:loading.attr="disabled">
                                {{ __('filament-companies::default.buttons.disable') }}

                            </x-filament::button>
                        </x-filament-companies::confirms-password>
                    @endif
                @endif
            </div>
        </x-slot>
    </x-filament::card>
</x-filament-companies::grid-section>
