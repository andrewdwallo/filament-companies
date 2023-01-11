<x-guest-layout>

        <h2 class="text-2xl font-bold tracking-tight text-center">
            {{ __('filament-companies::default.headings.auth.register') }}
        </h2>
        <x-filament-companies::validation-errors class="mb-4" />

        <form method="POST" class="space-y-8" action="{{ route('register') }}">
            @csrf

            <div>
                <x-filament-companies::label for="name" value="{{ __('filament-companies::default.fields.name') }}" />
                <x-filament-companies::input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-filament-companies::label for="email" value="{{ __('filament-companies::default.fields.email') }}" />
                <x-filament-companies::input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-filament-companies::label for="password" value="{{ __('filament-companies::default.fields.password') }}" />
                <x-filament-companies::input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-filament-companies::label for="password_confirmation" value="{{ __('filament-companies::default.labels.password_confirmation') }}" />
                <x-filament-companies::input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Wallo\FilamentCompanies\FilamentCompanies::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-filament-companies::label for="terms">
                        <div class="flex items-center">
                            <x-filament-companies::checkbox name="terms" id="terms" required />

                            <div class="ml-2">
                                {!! __('filament-companies::default.subheadings.auth.register', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline font-bold text-sm text-primary-600 dark:text-primary-400">'.__('filament-companies::default.links.terms_of_service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline font-bold text-sm text-primary-600 dark:text-primary-400">'.__('filament-companies::default.links.privacy_policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-filament-companies::label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="text-sm text-primary-600 dark:text-primary-400 font-medium" href="{{ route('login') }}">
                    {{ __('filament-companies::default.links.already_registered') }}
                </a>

                <x-filament::button type="submit" class="ml-4">
                    {{ __('filament-companies::default.buttons.register') }}
                </x-filament::button>
            </div>
        </form>
</x-guest-layout>
