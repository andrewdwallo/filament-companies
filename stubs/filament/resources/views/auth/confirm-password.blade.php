<x-guest-layout>

        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            {{ __('filament-companies::default.headings.auth.confirm_password') }}
        </div>

        <x-filament-companies::validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <div>
                <x-filament-companies::label for="password" value="{{ __('filament-companies::default.fields.password') }}" />
                <x-filament-companies::input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" autofocus />
            </div>

            <div class="flex justify-end mt-4">
                <x-filament::button type="submit" class="ml-4">
                    {{ __('filament-companies::default.buttons.confirm') }}
                </x-filament::button>
            </div>
        </form>
</x-guest-layout>
