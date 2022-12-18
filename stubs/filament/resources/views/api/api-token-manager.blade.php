<div>
    <!-- Generate API Token -->
    <x-filament-companies::grid-section class="mt-8">
        <x-slot name="title">
            {{ __('Create API Token') }}
        </x-slot>

        <x-slot name="description">
            {{ __('API tokens allow third-party services to authenticate with our application on your behalf.') }}
        </x-slot>

        <div class="space-y-3">

            <x-filament::form wire:submit.prevent="createApiToken">
                <div class="col-span-6 sm:col-span-4">
                    <x-filament-companies::label for="name" :value="__('Token Name')" />
                    <x-filament-companies::input id="name" type="text" class="mt-1 block w-full"
                        wire:model.defer="createApiTokenForm.name" autofocus />
                    <x-filament-companies::input-error for="name" class="mt-2" />
                </div>

                <!-- Token Permissions -->
                @if (Wallo\FilamentCompanies\FilamentCompanies::hasPermissions())
                    <div class="col-span-6">
                        <x-filament-companies::label for="permissions" value="{{ __('Permissions') }}" />

                        <div class="mt-2 grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach (Wallo\FilamentCompanies\FilamentCompanies::$permissions as $permission)
                                <label class="flex items-center">
                                    <x-filament-companies::checkbox wire:model.defer="createApiTokenForm.permissions"
                                        :value="$permission" />
                                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ $permission }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endif

                <x-filament-companies::action-message>
                    {{ __('Created.') }}
                </x-filament-companies::action-message>

                <x-filament::button type="submit">
                    {{ __('Create') }}
                </x-filament::button>

            </x-filament::form>

            @if ($this->user->tokens->isNotEmpty())

                <x-filament-companies::section-border />

                <!-- Manage API Tokens -->
                <div class="mt-10 sm:mt-0">
                    <x-filament::card class="col-span-2 sm:col-span-1 mt-5 md:mt-0">
                        <p class="font-medium text-lg">
                            {{ __('Manage API Tokens') }}
                        </p>

                        <!-- API Token List -->
                        @foreach ($this->user->tokens->sortBy('name') as $token)
                            <x-filament::hr />
                            <div class="flex items-center justify-between text-sm">
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
                                        <x-filament::button color="gray" class="mr-3"
                                            wire:click="manageApiTokenPermissions({{ $token->id }})">
                                            {{ __('Permissions') }}
                                        </x-filament::button>
                                    @endif

                                    <x-filament::button color="danger" class="ml-3"
                                        wire:click="confirmApiTokenDeletion({{ $token->id }})">
                                        {{ __('Delete') }}
                                    </x-filament::button>
                                </div>
                            </div>
                        @endforeach
                    </x-filament::card>
                </div>
            @endif

            <!-- Token Value Modal -->
            <x-filament-companies::dialog-modal wire:model="displayingToken" maxWidth="md"
                class="flex items-center justify-center space-x-2 rtl:space-x-reverse">
                <x-slot name="title">
                    {{ __('API Token') }}
                </x-slot>

                <x-slot name="content">
                    <div>
                        {{ __('Please copy your new API token. For your security, it won\'t be shown again.') }}
                    </div>

                    <x-filament-companies::input x-ref="plaintextToken" type="text" readonly :value="$plainTextToken"
                        class="mt-4 bg-gray-100 px-4 py-2 rounded font-mono text-sm text-gray-500 w-full" autofocus
                        autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"
                        @showing-token-modal.window="setTimeout(() => $refs.plaintextToken.select(), 250)" />
                </x-slot>

                <x-slot name="footer">
                    <x-filament::button color="gray" wire:click="$set('displayingToken', false)"
                        wire:loading.attr="disabled">
                        {{ __('Close') }}
                    </x-filament::button>
                </x-slot>
            </x-filament-companies::dialog-modal>

            <!-- API Token Permissions Modal -->
            <x-filament-companies::dialog-modal wire:model="managingApiTokenPermissions" maxWidth="md"
                class="flex items-center justify-center space-x-2 rtl:space-x-reverse">
                <x-slot name="title">
                    {{ __('API Token Permissions') }}
                </x-slot>

                <x-slot name="content">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach (Wallo\FilamentCompanies\FilamentCompanies::$permissions as $permission)
                            <label class="flex items-center">
                                <x-filament-companies::checkbox wire:model.defer="updateApiTokenForm.permissions"
                                    :value="$permission" />
                                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ $permission }}</span>
                            </label>
                        @endforeach
                    </div>
                </x-slot>

                <x-slot name="footer">
                    <x-filament::button color="gray" class="mr-3"
                        wire:click="$set('managingApiTokenPermissions', false)" wire:loading.attr="disabled">
                        {{ __('Cancel') }}
                    </x-filament::button>

                    <x-filament::button type="submit" class="ml-3" wire:click="updateApiToken"
                        wire:loading.attr="disabled">
                        {{ __('Save') }}
                    </x-filament::button>
                </x-slot>
            </x-filament-companies::dialog-modal>

            <!-- Delete Token Confirmation Modal -->
            <x-filament-companies::confirmation-modal wire:model="confirmingApiTokenDeletion" maxWidth="md"
                class="flex items-center justify-center space-x-2 rtl:space-x-reverse">
                <x-slot name="title">
                    {{ __('Delete API Token') }}
                </x-slot>

                <x-slot name="content">
                    {{ __('Are you sure you would like to delete this API token?') }}
                </x-slot>

                <x-slot name="footer">
                    <x-filament::button color="gray" class="mr-3" wire:click="$toggle('confirmingApiTokenDeletion')"
                        wire:loading.attr="disabled">
                        {{ __('Cancel') }}
                    </x-filament::button>

                    <x-filament::button color="danger" class="ml-3" wire:click="deleteApiToken"
                        wire:loading.attr="disabled">
                        {{ __('Delete') }}
                    </x-filament::button>
                </x-slot>
            </x-filament-companies::confirmation-modal>
    </x-filament-companies::grid-section>
</div>
