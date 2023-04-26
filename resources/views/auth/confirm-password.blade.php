<x-filament::layouts.card>

    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('filament-companies::default.headings.auth.confirm_password') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <x-forms::field-wrapper id="password" statePath="password" required label="{{ __('filament-companies::default.fields.password') }}">
            <x-filament-companies::input id="password" type="password" name="password" required autocomplete="current-password" autofocus />
        </x-forms::field-wrapper>

        <div class="mt-4 flex justify-end">
            <x-filament::button type="submit" class="ml-4">
                {{ __('filament-companies::default.buttons.confirm') }}
            </x-filament::button>
        </div>
    </form>
</x-filament::layouts.card>
