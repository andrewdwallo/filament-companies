<x-filament::layouts.card>

    <form method="POST" class="space-y-8" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <x-forms::field-wrapper id="email" statePath="email" required label="{{ __('filament-companies::default.fields.email') }}">
            <x-filament-companies::input id="email" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
        </x-forms::field-wrapper>

        <x-forms::field-wrapper id="password" statePath="password" required label="{{ __('filament-companies::default.fields.password') }}">
            <x-filament-companies::input id="password" type="password" name="password" required autocomplete="new-password" />
        </x-forms::field-wrapper>

        <x-forms::field-wrapper id="password_confirmation" statePath="password_confirmation" required label="{{ __('filament-companies::default.labels.password_confirmation') }}">
            <x-filament-companies::input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" />
        </x-forms::field-wrapper>

        <x-filament::button type="submit" class="w-full">
            {{ __('filament-companies::default.buttons.reset_password') }}
        </x-filament::button>
    </form>
</x-filament::layouts.card>
