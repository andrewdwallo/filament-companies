<x-filament::layouts.card>

    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('filament-companies::default.headings.auth.confirm_password') }}
    </div>

    <x-filament-companies::validation-errors class="mb-4" />

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div>
            <x-filament-companies::label for="password" value="{{ __('filament-companies::default.fields.password') }}" />
            <x-filament-companies::input id="password" class="mt-1 block w-full" type="password" name="password" required
                autocomplete="current-password" autofocus />
        </div>

        <div class="mt-4 flex justify-end">
            <x-filament::button type="submit" class="ml-4">
                {{ __('filament-companies::default.buttons.confirm') }}
            </x-filament::button>
        </div>
    </form>
</x-filament::layouts.card>
