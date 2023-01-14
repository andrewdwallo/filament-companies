<x-filament::layouts.card>

        <h2 class="text-2xl font-bold tracking-tight text-center">
            {{ __('filament-companies::default.headings.auth.forgot_password') }}
        </h2>

        <div class="mt-4 text-sm text-center text-gray-600 dark:text-gray-400">
            {{ __('filament-companies::default.subheadings.auth.forgot_password') }}
        </div>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                {{ session('status') }}
            </div>
        @endif

        <x-filament-companies::validation-errors class="mb-4" />

        <form method="POST" class="space-y-8" action="{{ route('password.email') }}">
            @csrf

            <div class="block">
                <x-filament-companies::label for="email" value="{{ __('filament-companies::default.fields.email') }}" />
                <x-filament-companies::input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-filament::button type="submit">
                    {{ __('filament-companies::default.buttons.email_password_reset_link') }}
                </x-filament::button>
            </div>
        </form>
</x-filament::layouts.card>
