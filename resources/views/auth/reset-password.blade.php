<x-filament-panels::page>

    <form method="POST" class="space-y-8" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <x-filament::input.wrapper id="email" statePath="email" required="required" label="{{ __('filament-companies::default.fields.email') }}">
            <x-filament::input id="email" type="email" name="email" :value="old('email', $request->email)" required="required" autofocus="autofocus" autocomplete="username" />
        </x-filament::input.wrapper>

        <x-filament::input.wrapper id="password" statePath="password" required="required" label="{{ __('filament-companies::default.fields.password') }}">
            <x-filament::input id="password" type="password" name="password" required="required" autocomplete="new-password" />
        </x-filament::input.wrapper>

        <x-filament::input.wrapper id="password_confirmation" statePath="password_confirmation" required="required" label="{{ __('filament-companies::default.labels.password_confirmation') }}">
            <x-filament::input id="password_confirmation" type="password" name="password_confirmation" required="required" autocomplete="new-password" />
        </x-filament::input.wrapper>

        <x-filament::button type="submit" class="w-full">
            {{ __('filament-companies::default.buttons.reset_password') }}
        </x-filament::button>
    </form>
</x-filament-panels::page>
