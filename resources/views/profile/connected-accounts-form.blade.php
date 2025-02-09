@php
    $modals = \Wallo\FilamentTenants\FilamentTenants::getModals();
@endphp

<x-filament-tenants::grid-section md="2">
    <x-slot name="title">
        {{ __('filament-tenants::default.action_section_titles.connected_accounts') }}
    </x-slot>

    <x-slot name="description">
        {{ __('filament-tenants::default.action_section_descriptions.connected_accounts') }}
    </x-slot>

    <x-filament::section>
        <div class="grid gap-y-6">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                @if (count($this->accounts) === 0)
                    {{ __('filament-tenants::default.headings.profile.connected_accounts.no_connected_accounts') }}
                @else
                    {{ __('filament-tenants::default.headings.profile.connected_accounts.has_connected_accounts') }}
                @endif
            </h3>

            <p class="text-sm text-gray-600 dark:text-gray-400">
                {{ __('filament-tenants::default.subheadings.profile.connected_accounts') }}
            </p>

            @foreach ($this->providers as $provider)
                @php
                    $account = $this->accounts->where('provider', $provider)->first();
                @endphp

                <x-filament-tenants::connected-account provider="{{ $provider }}"
                                                         created-at="{{ $account->created_at ?? null }}">
                    <x-slot name="action">
                        @if ($account !== null)
                            <div class="flex items-center justify-end gap-x-2">
                                @if ($account->avatar_path !== null && Wallo\FilamentTenants\FilamentTenants::managesProfilePhotos() && \Wallo\FilamentTenants\Enums\Feature::ProviderAvatars->isEnabled())
                                    <x-filament::button size="sm"
                                                        wire:click="setAvatarAsProfilePhoto('{{ $account->id }}')">
                                        {{ __('filament-tenants::default.buttons.use_avatar_as_profile_photo') }}
                                    </x-filament::button>
                                @endif

                                @if ($this->user?->password !== null || $this->accounts->count() > 1)
                                    <x-filament::button color="danger" size="sm"
                                                        wire:click="confirmRemove('{{ $account->id }}')">
                                        {{ __('filament-tenants::default.buttons.remove') }}
                                    </x-filament::button>
                                @endif
                            </div>
                        @else
                            <x-filament::button tag="a" color="gray" size="sm" href="{{ \Wallo\FilamentTenants\FilamentTenants::generateOAuthRedirectUrl($provider) }}">
                                {{ __('filament-tenants::default.buttons.connect') }}
                            </x-filament::button>
                        @endif
                    </x-slot>
                </x-filament-tenants::connected-account>
            @endforeach

            <!-- Remove Connected Account Confirmation Modal -->
            <x-filament::modal id="confirmingRemove" icon="heroicon-o-exclamation-triangle" icon-color="danger"
                               alignment="{{ $modals['alignment'] }}"
                               footer-actions-alignment="{{ $modals['formActionsAlignment'] }}"
                               width="{{ $modals['width'] }}">
                <x-slot name="heading">
                    {{ __('filament-tenants::default.modal_titles.remove_connected_account') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('filament-tenants::default.modal_descriptions.remove_connected_account') }}
                </x-slot>

                <x-slot name="footerActions">
                    @if($modals['cancelButtonAction'])
                        <x-filament::button color="gray" wire:click="cancelConnectedAccountRemoval">
                            {{ __('filament-tenants::default.buttons.cancel') }}
                        </x-filament::button>
                    @endif

                    <x-filament::button color="danger"
                                        wire:click="removeConnectedAccount('{{ $this->selectedAccountId }}')">
                        {{ __('filament-tenants::default.buttons.remove_connected_account') }}
                    </x-filament::button>
                </x-slot>
            </x-filament::modal>
        </div>
    </x-filament::section>
</x-filament-tenants::grid-section>
