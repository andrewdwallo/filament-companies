<x-filament::layouts.card>

    <div class="space-y-2">
        <h2 class="text-2xl font-bold tracking-tight text-center">
            {{ __('filament-companies::default.headings.auth.register') }}
        </h2>

        <h3 class="text-sm text-gray-600 font-medium tracking-tight text-center dark:text-gray-300">
            {{ __('filament-companies::default.subheadings.auth.login') }}
            <x-filament::link href="{{ route('login') }}">
                {{ __('filament-companies::default.headings.auth.login') }}
            </x-filament::link>
        </h3>
    </div>

    <form method="POST" class="space-y-8" action="{{ route('register') }}">
        @csrf

        <x-forms::field-wrapper id="name" statePath="name" required label="{{ __('filament-companies::default.fields.name') }}">
            <x-filament-companies::input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
        </x-forms::field-wrapper>

        <x-forms::field-wrapper id="email" statePath="email" required label="{{ __('filament-companies::default.fields.email') }}">
            <x-filament-companies::input id="email" type="email" name="email" :value="old('email')" required autocomplete="username" />
        </x-forms::field-wrapper>

        <x-forms::field-wrapper id="password" statePath="password" required label="{{ __('filament-companies::default.fields.password') }}">
            <x-filament-companies::input id="password" type="password" name="password" required autocomplete="new-password" />
        </x-forms::field-wrapper>

        <x-forms::field-wrapper id="password_confirmation" statePath="password_confirmation" required label="{{ __('filament-companies::default.labels.password_confirmation') }}">
            <x-filament-companies::input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" />
        </x-forms::field-wrapper>

        @if (Wallo\FilamentCompanies\FilamentCompanies::hasTermsAndPrivacyPolicyFeature())
            <x-filament-companies::label for="terms">
                <div class="flex items-center">
                    <x-filament-companies::checkbox name="terms" id="terms" required />

                    <p class="ml-2">
                        {!! __('filament-companies::default.subheadings.auth.register', [
                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="inline-flex items-center justify-center gap-0.5 font-medium outline-none hover:underline focus:underline text-primary-600 hover:text-primary-500 dark:text-primary-500 dark:hover:text-primary-400">'.__('filament-companies::default.links.terms_of_service').'</a>',
                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="inline-flex items-center justify-center gap-0.5 font-medium outline-none hover:underline focus:underline text-primary-600 hover:text-primary-500 dark:text-primary-500 dark:hover:text-primary-400">'.__('filament-companies::default.links.privacy_policy').'</a>',
                        ]) !!}
                    </p>
                </div>
            </x-filament-companies::label>
        @endif

        <x-filament::button type="submit" class="w-full">
            {{ __('filament-companies::default.buttons.register') }}
        </x-filament::button>
    </form>

    @if (Wallo\FilamentCompanies\Socialite::hasSocialiteFeatures())
        <x-filament-companies::socialite />
    @endif
</x-filament::layouts.card>
