<x-filament-companies::grid-section class="mt-8">
    <x-slot name="title">
        {{ __('filament-companies::default.grid_section_titles.browser_sessions') }}
    </x-slot>

    <x-slot name="description">
        {{ __('filament-companies::default.grid_section_descriptions.browser_sessions') }}
    </x-slot>

    <x-filament::card class="col-span-2 mt-5 sm:col-span-1 md:mt-0">
        <div class="max-w-xl text-sm text-gray-600 dark:text-gray-400">
            {{ __('filament-companies::default.subheadings.profile.logout_other_browser_sessions') }}
        </div>

        @if (count($this->sessions) > 0)
            <div class="mt-5 space-y-6">
                <!-- Other Browser Sessions -->
                @foreach ($this->sessions as $session)
                    <x-filament::hr />
                    <div class="flex items-center">
                        <div>
                            @if ($session->agent->isDesktop())
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="h-8 w-8 text-gray-500">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25" />
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="h-8 w-8 text-gray-500">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                                </svg>
                            @endif
                        </div>

                        <div class="ml-3">
                            <div class="text-sm text-gray-600 dark:text-gray-400">
                                {{ $session->agent->platform() ? $session->agent->platform() : 'filament-companies::default.labels.unknown' }}
                                -
                                {{ $session->agent->browser() ? $session->agent->browser() : 'filament-companies::default.labels.unknown' }}
                            </div>

                            <div>
                                <div class="text-xs text-gray-500 dark:text-gray-100">
                                    {{ $session->ip_address }},

                                    @if ($session->is_current_device)
                                        <span class="text-primary-500 font-semibold">
                                            {{ __('filament-companies::default.labels.this_device') }}
                                        </span>
                                    @else
                                        {{ __('filament-companies::default.labels.last_active') }}
                                        {{ $session->last_active }}
                                    @endif
                                </div>
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

                <x-filament-companies::action-message class="ml-3" on="loggedOut">
                    {{ __('filament-companies::default.buttons.done') }}

                </x-filament-companies::action-message>
            </div>
        </x-slot>

        <!-- Log Out Other Devices Confirmation Modal -->
        <x-filament-companies::dialog-modal wire:model="confirmingLogout" maxWidth="md"
            class="flex items-center justify-center space-x-2 rtl:space-x-reverse">

            <x-slot name="title">
                {{ __('filament-companies::default.modal_titles.logout_browser_sessions') }}
            </x-slot>

            <x-slot name="content">
                {{ __('filament-companies::default.modal_descriptions.logout_browser_sessions') }}

                <div class="mt-4" x-data="{}"
                    x-on:confirming-logout-other-browser-sessions.window="setTimeout(() => $refs.password.focus(), 250)">

                    <x-filament-companies::input type="password" class="mt-1 block w-3/4"
                        placeholder="{{ __('filament-companies::default.fields.password') }}" x-ref="password"
                        wire:model.defer="password" wire:keydown.enter="logoutOtherBrowserSessions" />

                    <x-filament-companies::input-error for="password" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-filament::button color="gray" class="mr-3" wire:click="$toggle('confirmingLogout')"
                    wire:loading.attr="disabled">
                    {{ __('filament-companies::default.buttons.cancel') }}

                </x-filament::button>

                <x-filament::button class="ml-3" wire:click="logoutOtherBrowserSessions" wire:loading.attr="disabled">
                    {{ __('filament-companies::default.buttons.logout_browser_sessions') }}

                </x-filament::button>
            </x-slot>
        </x-filament-companies::dialog-modal>
    </x-filament::card>
</x-filament-companies::grid-section>
