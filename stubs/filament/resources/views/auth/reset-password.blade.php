<x-guest-layout>

        <x-filament-companies::validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="block">
                <x-filament-companies::label for="email" value="{{ __('Email') }}" />
                <x-filament-companies::input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus />
            </div>

            <div class="mt-4">
                <x-filament-companies::label for="password" value="{{ __('Password') }}" />
                <x-filament-companies::input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-filament-companies::label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-filament-companies::input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-filament::button type="submit">
                    {{ __('Reset Password') }}
                </x-filament::button>
            </div>
        </form>
</x-guest-layout>
