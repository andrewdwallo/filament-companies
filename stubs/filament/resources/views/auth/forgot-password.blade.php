<x-guest-layout>
    <x-filament-companies::authentication-card>
        <x-slot name="logo">
            <x-filament-companies::authentication-card-logo />
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <x-filament-companies::validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="block">
                <x-filament-companies::label for="email" value="{{ __('Email') }}" />
                <x-filament-companies::input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-filament-companies::button>
                    {{ __('Email Password Reset Link') }}
                </x-filament-companies::button>
            </div>
        </form>
    </x-filament-companies::authentication-card>
</x-guest-layout>
