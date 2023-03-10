<x-filament::layouts.card>

    <x-filament-companies::validation-errors class="mb-4"/>

    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="block">
            <x-filament-companies::label for="email" value="{{ __('filament-companies::default.fields.email') }}"/>
            <x-filament-companies::input id="email" class="mt-1 block w-full" type="email" name="email"
                                         :value="old('email', $request->email)" required autofocus autocomplete="username"/>
        </div>

        <div class="mt-4">
            <x-filament-companies::label for="password"
                                         value="{{ __('filament-companies::default.fields.password') }}"/>
            <x-filament-companies::input id="password" class="mt-1 block w-full" type="password" name="password"
                                         required autocomplete="new-password"/>
        </div>

        <div class="mt-4">
            <x-filament-companies::label for="password_confirmation"
                                         value="{{ __('filament-companies::default.labels.password_confirmation') }}"/>
            <x-filament-companies::input id="password_confirmation" class="mt-1 block w-full" type="password"
                                         name="password_confirmation" required autocomplete="new-password"/>
        </div>

        <div class="mt-4 flex items-center justify-end">
            <x-filament::button type="submit">
                {{ __('filament-companies::default.buttons.reset_password') }}
            </x-filament::button>
        </div>
    </form>
</x-filament::layouts.card>
