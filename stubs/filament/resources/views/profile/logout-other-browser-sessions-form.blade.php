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
                                <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    viewBox="0 0 24 24" stroke="currentColor" class="h-8 w-8 text-gray-500">
                                    <path
                                        d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                    </path>
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                    class="h-8 w-8 text-gray-500">
                                    <path d="M0 0h24v24H0z" stroke="none"></path>
                                    <rect x="7" y="4" width="10" height="16" rx="1">
                                    </rect>
                                    <path d="M11 5h2M12 17v.01"></path>
                                </svg>
                            @endif
                        </div>

                        <div class="ml-3">
                            <div class="text-sm text-gray-600 dark:text-gray-400">
                                {{ $session->agent->platform() ? $session->agent->platform() : 'filament-companies::default.labels.unknown' }} -
                                {{ $session->agent->browser() ? $session->agent->browser() : 'filament-companies::default.labels.unknown' }}
                            </div>

                            <div>
                                <div class="text-xs text-gray-500 dark:text-gray-100">
                                    {{ $session->ip_address }},

                                    @if ($session->is_current_device)
                                        <span class="font-semibold text-primary-500">{{ __('filament-companies::default.labels.this_device') }}</span>
                                    @else
                                        {{ __('filament-companies::default.labels.last_active') }} {{ $session->last_active }}
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
                        placeholder="{{ __('filament-companies::default.fields.password') }}" x-ref="password" wire:model.defer="password"
                        wire:keydown.enter="logoutOtherBrowserSessions" />

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
