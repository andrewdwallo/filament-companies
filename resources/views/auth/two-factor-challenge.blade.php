<x-filament::layouts.card>

        <div x-data="{ recovery: false }">
            <div class="mb-4 text-sm text-gray-600 dark:text-gray-400" x-show="! recovery">
                {{ __('filament-companies::default.headings.auth.two_factor_challenge.authentication_code') }}
            </div>

            <div class="mb-4 text-sm text-gray-600 dark:text-gray-400" x-show="recovery">
                {{ __('filament-companies::default.headings.auth.two_factor_challenge.emergency_recovery_code') }}
            </div>

            <x-filament-companies::validation-errors class="mb-4" />

            <form method="POST" action="{{ route('two-factor.login') }}">
                @csrf

                <div class="mt-4" x-show="! recovery">
                    <x-filament-companies::label for="code" value="{{ __('filament-companies::default.fields.code') }}" />
                    <x-filament-companies::input id="code" class="block mt-1 w-full" type="text" inputmode="numeric" name="code" autofocus x-ref="code" autocomplete="one-time-code" />
                </div>

                <div class="mt-4" x-show="recovery">
                    <x-filament-companies::label for="recovery_code" value="{{ __('filament-companies::default.fields.recovery_code') }}" />
                    <x-filament-companies::input id="recovery_code" class="block mt-1 w-full" type="text" name="recovery_code" x-ref="recovery_code" autocomplete="one-time-code" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <button type="button" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 underline cursor-pointer"
                                    x-show="! recovery"
                                    x-on:click="
                                        recovery = true;
                                        $nextTick(() => { $refs.recovery_code.focus() })
                                    ">
                        {{ __('filament-companies::default.buttons.use_recovery_code') }}
                    </button>

                    <button type="button" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 underline cursor-pointer"
                                    x-show="recovery"
                                    x-on:click="
                                        recovery = false;
                                        $nextTick(() => { $refs.code.focus() })
                                    ">
                        {{ __('filament-companies::default.buttons.use_authentication_code') }}
                    </button>

                    <x-filament::button type="submit" class="ml-4">
                        {{ __('filament-companies::default.buttons.login') }}
                    </x-filament::button>
                </div>
            </form>
        </div>
</x-filament::layouts.card>
