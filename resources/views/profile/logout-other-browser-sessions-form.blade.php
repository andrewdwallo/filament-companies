<x-filament-companies::grid-section>
    <x-slot name="title">
        {{ __('filament-companies::default.grid_section_titles.browser_sessions') }}
    </x-slot>

    <x-slot name="description">
        {{ __('filament-companies::default.grid_section_descriptions.browser_sessions') }}
    </x-slot>

    <x-filament::card class="col-span-2 sm:col-span-1 mt-5 md:mt-0">
        <p class="text-sm text-gray-600 dark:text-gray-400">
            {{ __('filament-companies::default.subheadings.profile.logout_other_browser_sessions') }}
        </p>

        <!-- Browser Sessions -->
        @if (count($this->sessions) > 0)
            <div class="space-y-6">
                @foreach ($this->sessions as $session)
                    <div class="flex items-center space-x-2">
                        <div>
                            @if ($session->device === 'desktop')
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-8 w-8 text-gray-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25" />
                                </svg>
                            @elseif ($session->device === 'tablet')
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-8 w-8 text-gray-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5h3m-6.75 2.25h10.5a2.25 2.25 0 002.25-2.25v-15a2.25 2.25 0 00-2.25-2.25H6.75A2.25 2.25 0 004.5 4.5v15a2.25 2.25 0 002.25 2.25z" />
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-8 w-8 text-gray-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                                </svg>
                            @endif
                        </div>

                        <div class="font-semibold">
                            <div class="text-sm text-gray-800 dark:text-gray-200">
                                {{ $session->os_name ? $session->os_name . ($session->os_version ? ' ' . $session->os_version : '') : 'filament-companies::default.labels.unknown' }}
                                -
                                {{ $session->client_name ?: 'filament-companies::default.labels.unknown' }}
                            </div>

                            <div class="text-xs text-gray-600 dark:text-gray-300">
                                {{ $session->ip_address }},

                                @if ($session->is_current_device)
                                    <span class="text-primary-700 dark:text-primary-500">{{ __('filament-companies::default.labels.this_device') }}</span>
                                @else
                                    <span class="text-gray-400">{{ __('filament-companies::default.labels.last_active') }}: {{ $session->last_active }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <x-slot name="footer">
            <div class="text-left">
                <x-filament::button wire:click="confirmLogout" wire:loading.attr="disabled">
                    {{ __('filament-companies::default.buttons.logout_browser_sessions') }}
                </x-filament::button>
            </div>
        </x-slot>

        <!-- Log Out Other Devices Confirmation Modal -->
        <x-filament-companies::dialog-modal wire:model="confirmingLogout">

            <x-slot name="title">
                {{ __('filament-companies::default.modal_titles.logout_browser_sessions') }}
            </x-slot>

            <x-slot name="content">
                {{ __('filament-companies::default.modal_descriptions.logout_browser_sessions') }}

                <div class="mt-4">
                    <x-forms::field-wrapper id="password" statePath="password" x-on:confirming-logout-other-browser-sessions.window="setTimeout(() => $refs.password.focus(), 250)">
                        <x-filament-companies::input type="password" placeholder="{{ __('filament-companies::default.fields.password') }}" x-ref="password" wire:model.defer="password" wire:keydown.enter="logoutOtherBrowserSessions" />
                    </x-forms::field-wrapper>
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-filament::button color="secondary" wire:click="$toggle('confirmingLogout')" wire:loading.attr="disabled">
                    {{ __('filament-companies::default.buttons.cancel') }}
                </x-filament::button>

                <x-filament::button wire:click="logoutOtherBrowserSessions" wire:loading.attr="disabled">
                    {{ __('filament-companies::default.buttons.logout_browser_sessions') }}
                </x-filament::button>
            </x-slot>
        </x-filament-companies::dialog-modal>
    </x-filament::card>
</x-filament-companies::grid-section>
