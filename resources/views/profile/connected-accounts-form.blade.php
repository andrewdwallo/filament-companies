<x-filament-companies::action-section>
    <x-slot name="title">
        {{ __('filament-companies::default.action_section_titles.connected_accounts') }}
    </x-slot>

    <x-slot name="description">
        {{ __('filament-companies::default.action_section_descriptions.connected_accounts') }}
    </x-slot>

    <x-slot name="content">
        <x-filament::card class="col-span-2 mt-5 sm:col-span-1 md:mt-0">
            <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                @if (count($this->accounts) === 0)
                    {{ __('filament-companies::default.headings.profile.connected_accounts.no_connected_accounts') }}
                @else
                    {{ __('filament-companies::default.headings.profile.connected_accounts.has_connected_accounts') }}
                @endif
            </h3>

            <div class="mt-3 max-w-xl text-sm text-gray-600 dark:text-gray-400">
                {{ __('filament-companies::default.subheadings.profile.connected_accounts') }}
            </div>

            <div class="mt-5 space-y-6">
                @foreach ($this->providers as $provider)
                    <x-filament::hr />
                    @php
                        $account = $this->accounts->where('provider', $provider)->first();
                    @endphp

                    <x-filament-companies::connected-account provider="{{ $provider }}"
                        created-at="{{ $account->created_at ?? null }}">

                        <x-slot name="action">
                            @if (!is_null($account))
                                <div class="flex items-center justify-between">
                                    @if (!is_null($account->avatar_path) && Wallo\FilamentCompanies\FilamentCompanies::managesProfilePhotos())
                                        <x-filament::button class="mr-3"
                                            wire:click="setAvatarAsProfilePhoto({{ $account->id }})">
                                            {{ __('filament-companies::default.buttons.use_avatar_as_profile_photo') }}

                                        </x-filament::button>
                                    @endif

                                    @if (!is_null($this->user->password) || $this->accounts->count() > 1)
                                        <x-filament::button color="danger"
                                            wire:click="confirmRemove({{ $account->id }})"
                                            wire:loading.attr="disabled">
                                            {{ __('filament-companies::default.buttons.remove') }}

                                        </x-filament::button>
                                    @endif
                                </div>
                            @else
                                <x-filament-companies::action-link
                                    href="{{ route('oauth.redirect', ['provider' => $provider]) }}">
                                    {{ __('filament-companies::default.buttons.connect') }}

                                </x-filament-companies::action-link>
                            @endif
                        </x-slot>

                    </x-filament-companies::connected-account>
                @endforeach
            </div>

            <!-- Logout Other Devices Confirmation Modal -->
            <x-filament-companies::dialog-modal wire:model="confirmingRemove">
                <x-slot name="title">
                    {{ __('filament-companies::default.modal_titles.remove_connected_account') }}
                </x-slot>

                <x-slot name="content">
                    {{ __('filament-companies::default.modal_descriptions.remove_connected_account') }}
                </x-slot>

                <x-slot name="footer">
                    <x-filament::button color="gray" class="mr-3" wire:click="$toggle('confirmingRemove')"
                        wire:loading.attr="disabled">
                        {{ __('filament-companies::default.buttons.cancel') }}

                    </x-filament::button>

                    <x-filament::button color="danger" class="ml-3"
                        wire:click="removeConnectedAccount({{ $this->selectedAccountId }})"
                        wire:loading.attr="disabled">
                        {{ __('filament-companies::default.buttons.remove_connected_account') }}

                    </x-filament::button>
                </x-slot>
            </x-filament-companies::dialog-modal>
        </x-filament::card>
    </x-slot>
</x-filament-companies::action-section>
