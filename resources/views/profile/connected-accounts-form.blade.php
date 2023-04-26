<x-filament-companies::grid-section>
    <x-slot name="title">
        {{ __('filament-companies::default.action_section_titles.connected_accounts') }}
    </x-slot>

    <x-slot name="description">
        {{ __('filament-companies::default.action_section_descriptions.connected_accounts') }}
    </x-slot>

    <x-filament::card class="col-span-2 sm:col-span-1 mt-5 md:mt-0">
        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            @if (count($this->accounts) === 0)
                {{ __('filament-companies::default.headings.profile.connected_accounts.no_connected_accounts') }}
            @else
                {{ __('filament-companies::default.headings.profile.connected_accounts.has_connected_accounts') }}
            @endif
        </h3>

        <p class="text-sm text-gray-600 dark:text-gray-400">
            {{ __('filament-companies::default.subheadings.profile.connected_accounts') }}
        </p>

        <div class="space-y-6">
            @foreach ($this->providers as $provider)
                @php
                    $account = null;
                    $account = $this->accounts->where('provider', $provider)->first();
                @endphp

                <x-filament-companies::connected-account provider="{{ $provider }}" created-at="{{ $account->created_at ?? null }}">
                    <x-slot name="action">
                        @if ($account !== null)
                            <div class="flex items-center justify-between space-x-1">
                                @if ($account->avatar_path !== null && Wallo\FilamentCompanies\FilamentCompanies::managesProfilePhotos() && Wallo\FilamentCompanies\Socialite::hasProviderAvatarsFeature())
                                    <x-filament::button size="sm" wire:click="setAvatarAsProfilePhoto({{ $account->id }})">
                                        {{ __('filament-companies::default.buttons.use_avatar_as_profile_photo') }}
                                    </x-filament::button>
                                @endif

                                @if ($this->user->password !== null || $this->accounts->count() > 1)
                                    <x-filament::button color="danger" size="sm" wire:click="confirmRemove({{ $account->id }})" wire:loading.attr="disabled">
                                        {{ __('filament-companies::default.buttons.remove') }}
                                    </x-filament::button>
                                @endif
                            </div>
                        @else
                            <x-filament::button tag="a" color="secondary" size="sm" href="{{ route('oauth.redirect', compact('provider')) }}">
                                {{ __('filament-companies::default.buttons.connect') }}
                            </x-filament::button>
                        @endif
                    </x-slot>
                </x-filament-companies::connected-account>
            @endforeach
        </div>

        <!-- Remove Connected Account Confirmation Modal -->
        <x-filament-companies::dialog-modal wire:model="confirmingRemove">
            <x-slot name="title">
                {{ __('filament-companies::default.modal_titles.remove_connected_account') }}
            </x-slot>

            <x-slot name="content">
                {{ __('filament-companies::default.modal_descriptions.remove_connected_account') }}
            </x-slot>

            <x-slot name="footer">
                <x-filament::button color="secondary" wire:click="$toggle('confirmingRemove')" wire:loading.attr="disabled">
                    {{ __('filament-companies::default.buttons.cancel') }}
                </x-filament::button>

                <x-filament::button color="danger" wire:click="removeConnectedAccount({{ $this->selectedAccountId }})" wire:loading.attr="disabled">
                    {{ __('filament-companies::default.buttons.remove_connected_account') }}
                </x-filament::button>
            </x-slot>
        </x-filament-companies::dialog-modal>
    </x-filament::card>
</x-filament-companies::grid-section>
