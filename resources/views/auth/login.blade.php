<x-filament::layouts.card>

    <h2 class="text-center text-2xl font-bold tracking-tight">
        {{ __('filament-companies::default.headings.auth.login') }}
    </h2>

    <div class="mt-4 text-center text-sm font-medium">
        {{ __('filament-companies::default.subheadings.auth.login') }}
        <a class="text-primary-600 text-sm" href="{{ route('register') }}">
            {{ __('filament-companies::default.headings.auth.register') }}
        </a>
    </div>


    <x-filament-companies::validation-errors class="mb-4" />

    @if (session('status'))
        <div class="mb-4 text-sm font-medium text-green-600 dark:text-green-400">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" class="space-y-8" action="{{ route('login') }}">
        @csrf

        <div>
            <x-filament-companies::label for="email" value="{{ __('filament-companies::default.fields.email') }}" />
            <x-filament-companies::input id="email" class="mt-1 block w-full" type="email" name="email"
                :value="old('email')" required autofocus />
        </div>

        <div class="mt-4">
            <x-filament-companies::label for="password"
                value="{{ __('filament-companies::default.fields.password') }}" />
            <x-filament-companies::input id="password" class="mt-1 block w-full" type="password" name="password"
                required autocomplete="current-password" />
        </div>

        <div class="mt-4 block">
            <label for="remember_me" class="flex items-center">
                <x-filament-companies::checkbox id="remember_me" name="remember" />
                <span
                    class="ml-2 text-sm font-medium text-gray-600 dark:text-gray-400">{{ __('filament-companies::default.buttons.remember_me') }}</span>
            </label>
        </div>

        <div class="mt-4 flex items-center justify-end">
            @if (Route::has('password.request'))
                <a class="text-primary-600 dark:text-primary-400 text-sm font-medium"
                    href="{{ route('password.request') }}">
                    {{ __('filament-companies::default.links.forgot_your_password') }}
                </a>
            @endif

            <x-filament::button type="submit" class="ml-4">
                {{ __('filament-companies::default.buttons.login') }}
            </x-filament::button>
        </div>
    </form>

    @if (Wallo\FilamentCompanies\Socialite::show())
        <x-filament-companies::socialite />
    @endif
</x-filament::layouts.card>
