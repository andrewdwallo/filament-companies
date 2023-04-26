<x-filament::layouts.card>
    <div class="space-y-2">
        <h2 class="text-2xl font-bold tracking-tight text-center">
            {{ __('filament-companies::default.headings.auth.login') }}
        </h2>

        @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::registration()))
            <h3 class="text-sm text-gray-600 font-medium tracking-tight text-center dark:text-gray-300">
                {{ __('filament-companies::default.subheadings.auth.login') }}
                <x-filament::link href="{{ route('register') }}">
                    {{ __('filament-companies::default.headings.auth.register') }}
                </x-filament::link>
            </h3>
        @endif
    </div>

    @if (session('status'))
        <div class="mb-4 text-sm font-medium text-green-600 dark:text-green-400">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" class="space-y-8" action="{{ route('login') }}">
        @csrf

        <x-forms::field-wrapper id="email" statePath="email" required label="{{ __('filament-companies::default.fields.email') }}">
            <x-filament-companies::input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
        </x-forms::field-wrapper>

        <x-forms::field-wrapper id="password" statePath="password" required label="{{ __('filament-companies::default.fields.password') }}">
            <x-filament-companies::input id="password" type="password" name="password" required autocomplete="current-password" />
        </x-forms::field-wrapper>

        <div class="flex items-center justify-between text-sm text-gray-600 font-medium tracking-tight dark:text-gray-300">
            <label for="remember_me">
                <x-filament-companies::checkbox id="remember_me" name="remember" />
                <span class="ml-2">{{ __('filament-companies::default.buttons.remember_me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <x-filament::link href="{{ route('password.request') }}" target="_blank">
                    {{ __('filament-companies::default.links.forgot_your_password') }}
                </x-filament::link>
            @endif
        </div>

        <x-filament::button type="submit" class="w-full">
            {{ __('filament-companies::default.buttons.login') }}
        </x-filament::button>
    </form>

    @if (Wallo\FilamentCompanies\Socialite::hasSocialiteFeatures())
        <x-filament-companies::socialite />
    @endif
</x-filament::layouts.card>
