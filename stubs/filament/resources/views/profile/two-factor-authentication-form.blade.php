<x-filament-companies::grid-section class="mt-8">
    <x-slot name="title">
        {{ __('Two Factor Authentication') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Add additional security to your account using two factor authentication.') }}
    </x-slot>

    <x-filament::card class="col-span-2 mt-5 sm:col-span-1 md:mt-0">
        <h3 class="text-lg font-medium text-gray-900 dark:text-white">
            @if ($this->enabled)
                @if ($showingConfirmation)
                    {{ __('Finish enabling two factor authentication.') }}
                @else
                    {{ __('You have enabled two factor authentication!') }}
                @endif
            @else
                {{ __('You have not enabled two factor authentication.') }}
            @endif
        </h3>

        <div class="mt-3 max-w-xl text-sm text-gray-600 dark:text-gray-400">
            {{ __('When two factor authentication is enabled, you will be prompted for a secure, random token during
                        authentication. You may retrieve this token from your phone\'s Google Authenticator application.') }}
        </div>

        @if ($this->enabled)
            @if ($showingQrCode)
                <div class="mt-4 max-w-xl text-sm text-gray-600 dark:text-gray-400">
                    <p class="font-semibold">
                        @if ($showingConfirmation)
                            {{ __('To finish enabling two factor authentication, scan the following QR code using your phone\'s
                                                    authenticator application or enter the setup key and provide the generated OTP code.') }}
                        @else
                            {{ __('Two factor authentication is now enabled. Scan the following QR code using your phone\'s authenticator
                                                    application or enter the setup key.') }}
                        @endif
                    </p>
                </div>

                <div class="mt-4">
                    {!! $this->user->twoFactorQrCodeSvg() !!}
                </div>

                <div class="mt-4 max-w-xl text-sm text-gray-600 dark:text-gray-400">
                    <p class="font-semibold">
                        {{ __('Setup Key') }}: {{ decrypt($this->user->two_factor_secret) }}
                    </p>
                </div>

                @if ($showingConfirmation)
                    <div class="mt-4">
                        <x-filament-companies::label for="code" value="{{ __('Code') }}" />

                        <x-filament-companies::input id="code" type="text" name="code"
                            class="mt-1 block w-1/2" inputmode="numeric" autofocus autocomplete="one-time-code"
                            wire:model.defer="code" wire:keydown.enter="confirmTwoFactorAuthentication" />

                        <x-filament-companies::input-error for="code" class="mt-2" />
                    </div>
                @endif
            @endif

            @if ($showingRecoveryCodes)
                <div class="mt-4 max-w-xl text-sm text-gray-600 dark:text-gray-400">
                    <p class="font-semibold">
                        {{ __('Store these recovery codes in a secure password manager. They can be used to recover access to your account if your two factor authentication device is lost.') }}
                    </p>
                </div>

                <div
                    class="mt-4 grid max-w-xl gap-1 rounded-lg bg-gray-100 px-4 py-4 font-mono text-sm dark:bg-gray-800">
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
                            {{ __('Enable') }}
                        </x-filament::button>
                    </x-filament-companies::confirms-password>
                @else
                    @if ($showingRecoveryCodes)
                        <x-filament-companies::confirms-password wire:then="regenerateRecoveryCodes">
                            <x-filament::button type="submit" class="mr-3">
                                {{ __('Regenerate Recovery Codes') }}
                            </x-filament::button>
                        </x-filament-companies::confirms-password>
                    @elseif ($showingConfirmation)
                        <x-filament-companies::confirms-password wire:then="confirmTwoFactorAuthentication">
                            <x-filament::button type="button" class="mr-3" wire:loading.attr="disabled">
                                {{ __('Confirm') }}
                            </x-filament::button>
                        </x-filament-companies::confirms-password>
                    @else
                        <x-filament-companies::confirms-password wire:then="showRecoveryCodes">
                            <x-filament::button type="submit" class="mr-3">
                                {{ __('Show Recovery Codes') }}
                            </x-filament::button>
                        </x-filament-companies::confirms-password>
                    @endif

                    @if ($showingConfirmation)
                        <x-filament-companies::confirms-password wire:then="disableTwoFactorAuthentication">
                            <x-filament::button color="gray" wire:loading.attr="disabled">
                                {{ __('Cancel') }}
                            </x-filament::button>
                        </x-filament-companies::confirms-password>
                    @else
                        <x-filament-companies::confirms-password wire:then="disableTwoFactorAuthentication">
                            <x-filament::button color="gray" wire:loading.attr="disabled">
                                {{ __('Disable') }}
                            </x-filament::button>
                        </x-filament-companies::confirms-password>
                    @endif
                @endif
            </div>
        </x-slot>
    </x-filament::card>
</x-filament-companies::grid-section>
