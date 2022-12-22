<x-guest-layout>

        <h2 class="text-2xl font-bold tracking-tight text-center">
            {{ __('Forgot your password?') }}
        </h2>

        <div class="mt-4 text-sm text-center">
            {{ __('Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <x-filament-companies::validation-errors class="mb-4" />

        <form method="POST" class="space-y-8" action="{{ route('password.email') }}">
            @csrf

            <div class="block">
                <x-filament-companies::label for="email" value="{{ __('Email') }}" />
                <x-filament-companies::input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-filament::button type="submit">
                    {{ __('Email Password Reset Link') }}
                </x-filament::button>
            </div>
        </form>
</x-guest-layout>
