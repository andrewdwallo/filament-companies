<x-filament::layouts.card>

    <h2 class="text-2xl font-bold tracking-tight text-center">
        {{ __('filament-companies::default.headings.auth.login') }}
    </h2>

    @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::registration()))
        <div class="mt-2 text-center text-sm font-medium">
            {{ __('filament-companies::default.subheadings.auth.login') }}
            <a class="text-primary-600 text-sm" href="{{ route('register') }}">
                {{ __('filament-companies::default.headings.auth.register') }}
            </a>
        </div>
    @endif


    @if (session('status'))
        <div class="mb-4 text-sm font-medium text-green-600 dark:text-green-400">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" class="space-y-8" action="{{ route('login') }}">
        @csrf

        <div>
            <x-forms::field-wrapper id="email" statePath="email" required="true"
                                    label="{{ __('filament-companies::default.fields.email') }}">
                <x-filament-companies::input id="email" type="email" name="email"
                                             :value="old('email')" required autofocus autocomplete="username"/>
            </x-forms::field-wrapper>
        </div>

        <div class="mt-4">
            <x-forms::field-wrapper id="password" statePath="password" required="true"
                                    label="{{ __('filament-companies::default.fields.password') }}">
                <x-filament-companies::input id="password" type="password" name="password"
                                             required autocomplete="current-password"/>
            </x-forms::field-wrapper>
        </div>

        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <label for="remember_me" class="flex items-center">
                    <x-filament-companies::checkbox id="remember_me" name="remember"/>
                    <span class="ml-2 text-sm font-medium">{{ __('filament-companies::default.buttons.remember_me') }}</span>
                </label>
            </div>

            <div class="text-sm">
                @if (Route::has('password.request'))
                    <a class="text-primary-600 dark:text-primary-400 text-sm font-medium"
                       href="{{ route('password.request') }}">
                        {{ __('filament-companies::default.links.forgot_your_password') }}
                    </a>
                @endif
            </div>
        </div>

        <div>
            <x-filament::button type="submit" class="w-full">
                {{ __('filament-companies::default.buttons.login') }}
            </x-filament::button>
        </div>
    </form>

    <div class="mt-4">
        @if (Wallo\FilamentCompanies\Socialite::hasSocialiteFeatures())
            <x-filament-companies::socialite/>
        @endif
    </div>
</x-filament::layouts.card>
