<x-filament::layouts.card>
    <div class="space-y-4">
        <div class="text-sm text-gray-600 dark:text-gray-400">
            {{ __('filament-companies::default.headings.auth.verify_email.verification_link_not_sent') }}
        </div>

        @if (session('status') === 'verification-link-sent')
            <div class="text-sm font-medium text-success-600 dark:text-success-400">
                {{ __('filament-companies::default.headings.auth.verify_email.verification_link_sent') }}
            </div>
        @endif

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <x-filament::button type="submit" color="secondary" class="w-full">
                {{ __('filament-companies::default.buttons.resend_verification_email') }}
            </x-filament::button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <x-filament::button type="submit" class="w-full">
                {{ __('filament-companies::default.buttons.logout') }}
            </x-filament::button>
        </form>
    </div>
</x-filament::layouts.card>

