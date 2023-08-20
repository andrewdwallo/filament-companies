<x-filament-companies::grid-section md="2">
    <x-slot name="title">
        {{ __('filament-companies::default.grid_section_titles.two_factor_authentication') }}
    </x-slot>

    <x-slot name="description">
        {{ __('filament-companies::default.grid_section_descriptions.two_factor_authentication') }}
    </x-slot>

    <x-filament::section>
        <div class="grid gap-y-6">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
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

            <p class="text-sm text-gray-600 dark:text-gray-400">
                {{ __('filament-companies::default.subheadings.profile.two_factor_authentication.summary') }}
            </p>

            @if ($this->enabled)
                @if ($showingQrCode)
                    <p class="text-sm font-semibold text-gray-600 dark:text-gray-400">
                        @if ($showingConfirmation)
                            {{ __('filament-companies::default.subheadings.profile.two_factor_authentication.finish_enabling') }}
                        @else
                            {{ __('filament-companies::default.subheadings.profile.two_factor_authentication.enabled') }}
                        @endif
                    </p>

                    <div class="p-2 inline-block bg-white">
                        {!! $this->user->twoFactorQrCodeSvg() !!}
                    </div>

                    <p class="text-sm font-semibold text-gray-600 dark:text-gray-400">
                        {{ __('filament-companies::default.labels.setup_key') }}: {{ decrypt($this->user->two_factor_secret) }}
                    </p>

                    @if ($showingConfirmation)
                        <x-filament-forms::field-wrapper id="code" statePath="code" label="{{ __('filament-companies::default.fields.code') }}">
                            <x-filament::input.wrapper class="overflow-hidden">
                                <x-filament::input id="code" name="code" type="text" inputmode="numeric" autofocus="autofocus" autocomplete="one-time-code" wire:model="code" wire:keydown.enter="confirmTwoFactorAuthentication" />
                            </x-filament::input.wrapper>
                        </x-filament-forms::field-wrapper>
                    @endif
                @endif

                @if ($showingRecoveryCodes)
                    <p class="text-sm font-semibold text-gray-600 dark:text-gray-400">
                        {{ __('filament-companies::default.subheadings.profile.two_factor_authentication.store_codes') }}
                    </p>

                    <div class="grid gap-1 rounded-lg bg-gray-100 dark:bg-gray-700 p-4 text-sm font-medium font-mono">
                        @foreach (json_decode(decrypt($this->user->two_factor_recovery_codes), true, 512, JSON_THROW_ON_ERROR) as $code)
                            <div>{{ $code }}</div>
                        @endforeach
                    </div>
                @endif
            @endif


            <div class="text-left">
                @if (! $this->enabled)
                    <x-filament-companies::confirms-password wire:then="enableTwoFactorAuthentication">
                        <x-filament::button wire:loading.attr="disabled">
                            {{ __('filament-companies::default.buttons.enable') }}
                        </x-filament::button>
                    </x-filament-companies::confirms-password>
                @else
                    @if ($showingRecoveryCodes)
                        <x-filament-companies::confirms-password wire:then="regenerateRecoveryCodes">
                            <x-filament::button color="gray" size="sm">
                                {{ __('filament-companies::default.buttons.regenerate_recovery_codes') }}
                            </x-filament::button>
                        </x-filament-companies::confirms-password>
                    @elseif ($showingConfirmation)
                        <x-filament-companies::confirms-password wire:then="confirmTwoFactorAuthentication">
                            <x-filament::button size="sm" wire:loading.attr="disabled">
                                {{ __('filament-companies::default.buttons.confirm') }}
                            </x-filament::button>
                        </x-filament-companies::confirms-password>
                    @else
                        <x-filament-companies::confirms-password wire:then="showRecoveryCodes">
                            <x-filament::button color="gray" size="sm">
                                {{ __('filament-companies::default.buttons.show_recovery_codes') }}
                            </x-filament::button>
                        </x-filament-companies::confirms-password>
                    @endif

                    @if ($showingConfirmation)
                        <x-filament-companies::confirms-password wire:then="disableTwoFactorAuthentication">
                            <x-filament::button color="gray" size="sm" wire:loading.attr="disabled">
                                {{ __('filament-companies::default.buttons.cancel') }}
                            </x-filament::button>
                        </x-filament-companies::confirms-password>
                    @else
                        <x-filament-companies::confirms-password wire:then="disableTwoFactorAuthentication">
                            <x-filament::button color="danger" size="sm" wire:loading.attr="disabled">
                                {{ __('filament-companies::default.buttons.disable') }}
                            </x-filament::button>
                        </x-filament-companies::confirms-password>
                    @endif
                @endif
            </div>
        </div>
    </x-filament::section>
</x-filament-companies::grid-section>
