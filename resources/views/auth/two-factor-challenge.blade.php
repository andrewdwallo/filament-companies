<x-filament::layouts.card>

    <div x-data="{ recovery: false }">
        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400" x-show="! recovery">
            {{ __('filament-companies::default.headings.auth.two_factor_challenge.authentication_code') }}
        </div>

        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400" x-cloak x-show="recovery">
            {{ __('filament-companies::default.headings.auth.two_factor_challenge.emergency_recovery_code') }}
        </div>

        <form method="POST" action="{{ route('two-factor.login') }}">
            @csrf

            <div class="mt-4" x-show="! recovery">
                <x-forms::field-wrapper id="code" statePath="code" label="{{ __('filament-companies::default.fields.code') }}">
                    <x-filament-companies::input id="code" type="text" inputmode="numeric" name="code" autofocus x-ref="code" autocomplete="one-time-code" />
                </x-forms::field-wrapper>
            </div>

            <div class="mt-4" x-cloak x-show="recovery">
                <x-forms::field-wrapper id="recovery_code" statePath="recovery_code" label="{{ __('filament-companies::default.fields.recovery_code') }}">
                    <x-filament-companies::input id="recovery_code" type="text" name="recovery_code" x-ref="recovery_code" autocomplete="one-time-code" />
                </x-forms::field-wrapper>
            </div>

            <div class="mt-4 flex items-center justify-end">
                <x-filament::link color="secondary" type="button" tag="button" size="sm"
                                x-show="! recovery"
                                x-on:click="
                                    recovery = true;
                                    $nextTick(() => { $refs.recovery_code.focus() })
                                ">
                    {{ __('filament-companies::default.buttons.use_recovery_code') }}
                </x-filament::link>

                <x-filament::link color="secondary" type="button" tag="button" size="sm"
                                x-cloak
                                x-show="recovery"
                                x-on:click="
                                    recovery = false;
                                    $nextTick(() => { $refs.code.focus() })
                                ">
                    {{ __('filament-companies::default.buttons.use_authentication_code') }}
                </x-filament::link>

                <x-filament::button type="submit" class="ml-4">
                    {{ __('filament-companies::default.buttons.login') }}
                </x-filament::button>
            </div>
        </form>
    </div>
</x-filament::layouts.card>
