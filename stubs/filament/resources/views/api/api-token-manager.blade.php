<div>
    <!-- Generate API Token -->
    <x-filament-companies::form-section submit="createApiToken">
        <x-slot name="title">
            {{ __('Create API Token') }}
        </x-slot>

        <x-slot name="description">
            {{ __('API tokens allow third-party services to authenticate with our application on your behalf.') }}
        </x-slot>

        <x-slot name="form">
            <!-- Token Name -->
            <div class="col-span-6 sm:col-span-4">
                <x-filament-companies::label for="name" value="{{ __('Token Name') }}" />
                <x-filament-companies::input id="name" type="text" class="mt-1 block w-full" wire:model.defer="createApiTokenForm.name" autofocus />
                <x-filament-companies::input-error for="name" class="mt-2" />
            </div>

            <!-- Token Permissions -->
            @if (Wallo\FilamentCompanies\FilamentCompanies::hasPermissions())
                <div class="col-span-6">
                    <x-filament-companies::label for="permissions" value="{{ __('Permissions') }}" />

                    <div class="mt-2 grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach (Wallo\FilamentCompanies\FilamentCompanies::$permissions as $permission)
                            <label class="flex items-center">
                                <x-filament-companies::checkbox wire:model.defer="createApiTokenForm.permissions" :value="$permission"/>
                                <span class="ml-2 text-sm text-gray-600">{{ $permission }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            @endif
        </x-slot>

        <x-slot name="actions">
            <x-filament-companies::action-message class="mr-3" on="created">
                {{ __('Created.') }}
            </x-filament-companies::action-message>

            <x-filament-companies::button>
                {{ __('Create') }}
            </x-filament-companies::button>
        </x-slot>
    </x-filament-companies::form-section>

    @if ($this->user->tokens->isNotEmpty())
        <x-filament-companies::section-border />

        <!-- Manage API Tokens -->
        <div class="mt-10 sm:mt-0">
            <x-filament-companies::action-section>
                <x-slot name="title">
                    {{ __('Manage API Tokens') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('You may delete any of your existing tokens if they are no longer needed.') }}
                </x-slot>

                <!-- API Token List -->
                <x-slot name="content">
                    <div class="space-y-6">
                        @foreach ($this->user->tokens->sortBy('name') as $token)
                            <div class="flex items-center justify-between">
                                <div>
                                    {{ $token->name }}
                                </div>

                                <div class="flex items-center">
                                    @if ($token->last_used_at)
                                        <div class="text-sm text-gray-400">
                                            {{ __('Last used') }} {{ $token->last_used_at->diffForHumans() }}
                                        </div>
                                    @endif

                                    @if (Wallo\FilamentCompanies\FilamentCompanies::hasPermissions())
                                        <button class="cursor-pointer ml-6 text-sm text-gray-400 underline" wire:click="manageApiTokenPermissions({{ $token->id }})">
                                            {{ __('Permissions') }}
                                        </button>
                                    @endif

                                    <button class="cursor-pointer ml-6 text-sm text-red-500" wire:click="confirmApiTokenDeletion({{ $token->id }})">
                                        {{ __('Delete') }}
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </x-slot>
            </x-filament-companies::action-section>
        </div>
    @endif

    <!-- Token Value Modal -->
    <x-filament-companies::dialog-modal wire:model="displayingToken">
        <x-slot name="title">
            {{ __('API Token') }}
        </x-slot>

        <x-slot name="content">
            <div>
                {{ __('Please copy your new API token. For your security, it won\'t be shown again.') }}
            </div>

            <x-filament-companies::input x-ref="plaintextToken" type="text" readonly :value="$plainTextToken"
                class="mt-4 bg-gray-100 px-4 py-2 rounded font-mono text-sm text-gray-500 w-full"
                autofocus autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"
                @showing-token-modal.window="setTimeout(() => $refs.plaintextToken.select(), 250)"
            />
        </x-slot>

        <x-slot name="footer">
            <x-filament-companies::secondary-button wire:click="$set('displayingToken', false)" wire:loading.attr="disabled">
                {{ __('Close') }}
            </x-filament-companies::secondary-button>
        </x-slot>
    </x-filament-companies::dialog-modal>

    <!-- API Token Permissions Modal -->
    <x-filament-companies::dialog-modal wire:model="managingApiTokenPermissions">
        <x-slot name="title">
            {{ __('API Token Permissions') }}
        </x-slot>

        <x-slot name="content">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach (Wallo\FilamentCompanies\FilamentCompanies::$permissions as $permission)
                    <label class="flex items-center">
                        <x-filament-companies::checkbox wire:model.defer="updateApiTokenForm.permissions" :value="$permission"/>
                        <span class="ml-2 text-sm text-gray-600">{{ $permission }}</span>
                    </label>
                @endforeach
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-filament-companies::secondary-button wire:click="$set('managingApiTokenPermissions', false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-filament-companies::secondary-button>

            <x-filament-companies::button class="ml-3" wire:click="updateApiToken" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-filament-companies::button>
        </x-slot>
    </x-filament-companies::dialog-modal>

    <!-- Delete Token Confirmation Modal -->
    <x-filament-companies::confirmation-modal wire:model="confirmingApiTokenDeletion">
        <x-slot name="title">
            {{ __('Delete API Token') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you would like to delete this API token?') }}
        </x-slot>

        <x-slot name="footer">
            <x-filament-companies::secondary-button wire:click="$toggle('confirmingApiTokenDeletion')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-filament-companies::secondary-button>

            <x-filament-companies::danger-button class="ml-3" wire:click="deleteApiToken" wire:loading.attr="disabled">
                {{ __('Delete') }}
            </x-filament-companies::danger-button>
        </x-slot>
    </x-filament-companies::confirmation-modal>
</div>
