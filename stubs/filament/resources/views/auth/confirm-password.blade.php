<x-guest-layout>

        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
        </div>

        <x-filament-companies::validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <div>
                <x-filament-companies::label for="password" value="{{ __('Password') }}" />
                <x-filament-companies::input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" autofocus />
            </div>

            <div class="flex justify-end mt-4">
                <x-filament::button type="submit" class="ml-4">
                    {{ __('Confirm') }}
                </x-filament::button>
            </div>
        </form>
</x-guest-layout>
