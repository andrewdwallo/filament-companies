<x-filament::layouts.card>

        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            {{ __('filament-companies::default.headings.auth.verify_email.verification_link_not_sent') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                {{ __('filament-companies::default.headings.auth.verify_email.verification_link_sent') }}
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <x-filament::button type="submit">
                        {{ __('filament-companies::default.buttons.resend_verification_email') }}
                    </x-filament::button>
                </div>
            </form>

            <div>
                <a
                    href="{{ route('filament.pages.profile') }}"
                    class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900"
                >
                    {{ __('filament-companies::default.links.edit_profile') }}</a>

                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf

                    <button type="submit" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 ml-2">
                        {{ __('filament-companies::default.buttons.logout') }}
                    </button>
                </form>
            </div>
        </div>
</x-filament::layouts.card>
