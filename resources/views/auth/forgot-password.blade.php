<x-filament-panels::page>

    <h2 class="text-2xl font-bold tracking-tight text-center">
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

    <form method="POST" class="space-y-8" action="{{ route('password.email') }}">
        @csrf

        <x-filament::input.wrapper id="email" statePath="email" required="required" label="{{ __('filament-companies::default.fields.email') }}">
            <x-filament::input id="email" type="email" name="email" :value="old('email')" required="required" autofocus="autofocus" autocomplete="username" />
        </x-filament::input.wrapper>

        <x-filament::button type="submit" class="w-full">
            {{ __('filament-companies::default.buttons.email_password_reset_link') }}
        </x-filament::button>
    </form>
</x-filament-panels::page>
