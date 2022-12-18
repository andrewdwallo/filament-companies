<x-guest-layout>
    <x-filament-companies::authentication-card>
        <x-slot name="logo">
            <x-filament-companies::authentication-card-logo />
        </x-slot>

        <x-filament-companies::validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-filament-companies::label for="name" value="{{ __('Name') }}" />
                <x-filament-companies::input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-filament-companies::label for="email" value="{{ __('Email') }}" />
                <x-filament-companies::input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-filament-companies::label for="password" value="{{ __('Password') }}" />
                <x-filament-companies::input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-filament-companies::label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-filament-companies::input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Wallo\FilamentCompanies\FilamentCompanies::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-filament-companies::label for="terms">
                        <div class="flex items-center">
                            <x-filament-companies::checkbox name="terms" id="terms" required />

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-filament-companies::label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-filament-companies::button class="ml-4">
                    {{ __('Register') }}
                </x-filament-companies::button>
            </div>
        </form>
    </x-filament-companies::authentication-card>
</x-guest-layout>
