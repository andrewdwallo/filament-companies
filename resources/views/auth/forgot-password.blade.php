<x-filament::layouts.card>

    <h2 class="text-center text-2xl font-bold tracking-tight">
        {{ __('filament-companies::default.headings.auth.forgot_password') }}
    </h2>

    <div class="mt-4 text-center text-sm text-gray-600 dark:text-gray-400">
        {{ __('filament-companies::default.subheadings.auth.forgot_password') }}
    </div>

    @if (session('status'))
        <div class="mb-4 text-sm font-medium text-green-600 dark:text-green-400">
            {{ session('status') }}
        </div>
    @endif

    <x-filament-companies::validation-errors class="mb-4" />

    <form method="POST" class="space-y-8" action="{{ route('password.email') }}">
        @csrf

        <div class="block">
            <x-forms::field-wrapper id="email" statePath="email" required="true" label="{{ __('filament-companies::default.fields.email') }}">
                <x-filament-companies::input id="email" type="email" name="email"
                                             :value="old('email')" autofocus="on" />
            </x-forms::field-wrapper>
        </div>

        <div class="mt-4 flex items-center justify-end">
            <x-filament::button type="submit">
                {{ __('filament-companies::default.buttons.email_password_reset_link') }}
            </x-filament::button>
        </div>
    </form>
</x-filament::layouts.card>
