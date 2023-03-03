<x-filament::layouts.card>

    <h2 class="text-center text-2xl font-bold tracking-tight">
        {{ __('filament-companies::default.headings.auth.register') }}
    </h2>

    <div class="mt-2 text-center text-sm font-medium">
        {{ __('filament-companies::default.subheadings.auth.login') }}
        <a class="text-primary-600 text-sm" href="{{ route('login') }}">
            {{ __('filament-companies::default.headings.auth.login') }}
        </a>
    </div>

    <form method="POST" class="space-y-8" action="{{ route('register') }}">
        @csrf

        <div>
            <x-forms::field-wrapper id="name" statePath="name" required="true"
                                    label="{{ __('filament-companies::default.fields.name') }}">
                <x-filament-companies::input id="name" type="text" name="name"
                                             :value="old('name')" required autofocus autocomplete="name"/>
            </x-forms::field-wrapper>
        </div>

        <div>
            <x-forms::field-wrapper id="email" statePath="email" required="true"
                                    label="{{ __('filament-companies::default.fields.email') }}">
                <x-filament-companies::input id="email" type="email" name="email"
                                             :value="old('email')" required autocomplete="username"/>
            </x-forms::field-wrapper>
        </div>

        <div>
            <x-forms::field-wrapper id="password" statePath="password" required="true"
                                    label="{{ __('filament-companies::default.fields.password') }}">
                <x-filament-companies::input id="password" type="password" name="password"
                                             required autocomplete="new-password"/>
            </x-forms::field-wrapper>
        </div>

        <div>
            <x-forms::field-wrapper id="password_confirmation" statePath="password_confirmation" required="true"
                                    label="{{ __('filament-companies::default.labels.password_confirmation') }}">
                <x-filament-companies::input id="password_confirmation" type="password"
                                             name="password_confirmation" required autocomplete="new-password"/>
            </x-forms::field-wrapper>
        </div>

        @if (Wallo\FilamentCompanies\FilamentCompanies::hasTermsAndPrivacyPolicyFeature())
            <div class="mt-4">
                <x-filament-companies::label for="terms">
                    <div class="flex items-center">
                        <x-filament-companies::checkbox name="terms" id="terms" required/>

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

        <div>
            <x-filament::button type="submit" class="w-full">
                {{ __('filament-companies::default.buttons.register') }}
            </x-filament::button>
        </div>
    </form>

    <div class="mt-4">
        @if (Wallo\FilamentCompanies\Socialite::hasSocialiteFeatures())
            <x-filament-companies::socialite/>
        @endif
    </div>
</x-filament::layouts.card>
