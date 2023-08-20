<x-filament-panels::page>

    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('filament-companies::default.headings.auth.confirm_password') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <x-filament::input.wrapper id="password" statePath="password" required="required" label="{{ __('filament-companies::default.fields.password') }}">
            <x-filament::input id="password" type="password" name="password" required="required" autocomplete="current-password" autofocus="autofocus" />
        </x-filament::input.wrapper>

        <div class="mt-4 flex justify-end">
            <x-filament::button type="submit" class="ml-4">
                {{ __('filament-companies::default.buttons.confirm') }}
            </x-filament::button>
        </div>
    </form>
</x-filament-panels::page>
