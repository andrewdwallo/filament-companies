<x-filament-companies::action-section>
    <x-slot name="title">
        {{ __('Connected Accounts') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Manage and remove your connected accounts.') }}
    </x-slot>

    <x-slot name="content">
        <x-filament::card class="col-span-2 mt-5 sm:col-span-1 md:mt-0">
            <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                @if (count($this->accounts) == 0)
                    {{ __('You have no connected accounts.') }}
                @else
                    {{ __('Your connected accounts.') }}
                @endif
            </h3>

            <div class="mt-3 max-w-xl text-sm text-gray-600 dark:text-gray-400">
                {{ __('You are free to connect any social accounts to your profile and may remove any connected accounts at any time. If you feel any of your connected accounts have been compromised, you should disconnect them immediately and change your password.') }}
            </div>

            <div class="mt-5 space-y-6">
                @foreach ($this->providers as $provider)
                    @php
                        $account = null;
                        $account = $this->accounts->where('provider', $provider)->first();
                    @endphp

                    <x-filament-companies::connected-account provider="{{ $provider }}" created-at="{{ $account->created_at ?? null }}">
                        <x-slot name="action">
                            @if (! is_null($account))
                                <div class="flex items-center justify-between">
                                    @if (Wallo\FilamentCompanies\FilamentCompanies::managesProfilePhotos() && ! is_null($account->avatar_path))
                                        <x-filament::icon-button class="mr-6" icon="heroicon-o-user"
                                            tooltip="{{ __('Use Avatar as Profile Photo') }}"
                                            wire:click="setAvatarAsProfilePhoto({{ $account->id }})" />
                                    @endif

                                    @if (($this->accounts->count() > 1 || ! is_null($this->user->password)))
                                        <x-filament::icon-button color="danger" icon="heroicon-o-trash"
                                            tooltip="{{ __('Remove') }}" wire:click="confirmRemove({{ $account->id }})"
                                            wire:loading.attr="disabled" />
                                    @endif
                                </div>
                            @else
                                <x-filament-companies::action-link href="{{ route('oauth.redirect', ['provider' => $provider]) }}">
                                    {{ __('Connect') }}
                                </x-filament-companies::action-link>
                            @endif
                        </x-slot>

                    </x-filament-companies::connected-account>
                @endforeach
            </div>

            <!-- Logout Other Devices Confirmation Modal -->
            <x-filament-companies::dialog-modal wire:model="confirmingRemove">
                <x-slot name="title">
                    {{ __('Remove Connected Account') }}
                </x-slot>

                <x-slot name="content">
                    {{ __('Please confirm your removal of this account - this action cannot be undone.') }}
                </x-slot>

                <x-slot name="footer">
                    <x-filament::button color="gray" class="mr-3" wire:click="$toggle('confirmingRemove')" wire:loading.attr="disabled">
                        {{ __('Nevermind') }}
                    </x-filament::button>

                    <x-filament::button color="danger" class="ml-3" wire:click="removeConnectedAccount({{ $this->selectedAccountId }})" wire:loading.attr="disabled">
                        {{ __('Remove Connected Account') }}
                    </x-filament::button>
                </x-slot>
            </x-filament-companies::dialog-modal>
        </x-filament::card>
    </x-slot>
</x-filament-companies::action-section>
