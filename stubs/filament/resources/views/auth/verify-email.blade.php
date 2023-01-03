<x-guest-layout>

        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Before continuing, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                {{ __('A new verification link has been sent to the email address you provided in your profile settings.') }}
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <x-filament::button type="submit">
                        {{ __('Resend Verification Email') }}
                    </x-filament::button>
                </div>
            </form>

            <div>
                <a
                    href="{{ route('filament.pages.profile') }}"
                    class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900"
                >
                    {{ __('Edit Profile') }}</a>

                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf

                    <button type="submit" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 ml-2">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>
</x-guest-layout>
