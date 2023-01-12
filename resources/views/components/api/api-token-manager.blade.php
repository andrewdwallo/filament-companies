<div>
    <!-- Generate API Token -->
    <x-filament-companies::grid-section class="mt-8">
        <x-slot name="title">
            {{ __('filament-companies::default.grid_section_titles.create_api_token') }}
        </x-slot>

        <x-slot name="description">
            {{ __('filament-companies::default.grid_section_descriptions.create_api_token') }}
        </x-slot>

        <div class="space-y-3">

            <form wire:submit.prevent="createApiToken" class="col-span-2 mt-5 sm:col-span-1 md:mt-0">
                <x-filament::card>
                    <div class="col-span-6 sm:col-span-4">
                        <x-filament-companies::label for="name" :value="__('filament-companies::default.labels.token_name')" />
                        <x-filament-companies::input id="name" type="text" class="mt-1 block w-full"
                            wire:model.defer="createApiTokenForm.name" autofocus />
                        <x-filament-companies::input-error for="name" class="mt-2" />
                    </div>

                    <!-- Token Permissions -->
                    @if (Wallo\FilamentCompanies\FilamentCompanies::hasPermissions())
                        <div class="col-span-6">
                            <x-filament-companies::label for="permissions" value="{{ __('filament-companies::default.labels.permissions') }}" />

                            <div class="mt-2 grid grid-cols-1 gap-4 md:grid-cols-2">
                                @foreach (Wallo\FilamentCompanies\FilamentCompanies::$permissions as $permission)
                                    <label class="flex items-center">
                                        <x-filament-companies::checkbox
                                            wire:model.defer="createApiTokenForm.permissions" :value="$permission" />
                                        <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">
                                            {{ $permission }}
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <x-slot name="footer">
                        <div class="text-left">
                            <x-filament::button type="submit">
                                {{ __('filament-companies::default.buttons.create') }}
                            </x-filament::button>
                        </div>
                    </x-slot>
                </x-filament::card>
            </form>

            @if ($this->user->tokens->isNotEmpty())

                <x-filament-companies::section-border />

                <!-- Manage API Tokens -->
                <div class="mt-10 sm:mt-0">
                    <x-filament::card class="col-span-2 mt-5 sm:col-span-1 md:mt-0">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                            {{ __('filament-companies::default.headings.api.api_token_manager.manage_api_tokens') }}
                        </h3>

                        <!-- API Token List -->
                        @foreach ($this->user->tokens->sortBy('name') as $token)
                            <x-filament::hr />
                            <div class="flex items-center justify-between">
                                <div class="break-all dark:text-white">
                                    {{ $token->name }}
                                </div>

                                <div class="flex items-center">
                                    @if ($token->last_used_at)
                                        <div class="text-sm text-gray-400">
                                            {{ __('filament-companies::default.labels.last_used') }} {{ $token->last_used_at->diffForHumans() }}
                                        </div>
                                    @endif

                                    @if (Wallo\FilamentCompanies\FilamentCompanies::hasPermissions())
                                        <x-filament::icon-button icon="heroicon-o-key" class="mr-3"
                                            tooltip="{{ __('filament-companies::default.buttons.permissions') }}"
                                            wire:click="manageApiTokenPermissions({{ $token->id }})" />
                                    @endif

                                    <x-filament::icon-button color="danger" icon="heroicon-o-trash" class="ml-3"
                                        tooltip="{{ __('filament-companies::default.buttons.delete') }}" wire:click="confirmApiTokenDeletion({{ $token->id }})" />
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
                    {{ __('filament-companies::default.modal_titles.api_token') }}
                </x-slot>

                <x-slot name="content">
                    <div>
                        {{ __('filament-companies::default.modal_descriptions.api_token') }}
                    </div>

                    <x-filament-companies::input x-ref="plaintextToken" type="text" readonly :value="$plainTextToken"
                        class="mt-4 w-full rounded bg-gray-100 px-4 py-2 font-mono text-sm text-gray-500" autofocus
                        autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"
                        @showing-token-modal.window="setTimeout(() => $refs.plaintextToken.select(), 250)" />
                </x-slot>

                <x-slot name="footer">
                    <x-filament::button color="gray" wire:click="$set('displayingToken', false)"
                        wire:loading.attr="disabled">
                        {{ __('filament-companies::default.buttons.close') }}
                    </x-filament::button>
                </x-slot>
            </x-filament-companies::dialog-modal>

            <!-- API Token Permissions Modal -->
            <x-filament-companies::dialog-modal wire:model="managingApiTokenPermissions" maxWidth="md"
                class="flex items-center justify-center space-x-2 rtl:space-x-reverse">
                <x-slot name="title">
                    {{ __('filament-companies::default.modal_titles.api_token_permissions') }}
                </x-slot>

                <x-slot name="content">
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
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
                        {{ __('filament-companies::default.buttons.cancel') }}
                    </x-filament::button>

                    <x-filament::button type="submit" class="ml-3" wire:click="updateApiToken"
                        wire:loading.attr="disabled">
                        {{ __('filament-companies::default.buttons.save') }}
                    </x-filament::button>
                </x-slot>
            </x-filament-companies::dialog-modal>

            <!-- Delete Token Confirmation Modal -->
            <x-filament-companies::dialog-modal wire:model="confirmingApiTokenDeletion" maxWidth="md"
                class="flex items-center justify-center space-x-2 rtl:space-x-reverse">
                <x-slot name="title">
                    {{ __('filament-companies::default.modal_titles.delete_api_token') }}
                </x-slot>

                <x-slot name="content">
                    {{ __('filament-companies::default.modal_descriptions.delete_api_token') }}
                </x-slot>

                <x-slot name="footer">
                    <x-filament::button color="gray" class="mr-3" wire:click="$toggle('confirmingApiTokenDeletion')"
                        wire:loading.attr="disabled">
                        {{ __('filament-companies::default.buttons.cancel') }}
                    </x-filament::button>

                    <x-filament::button color="danger" class="ml-3" wire:click="deleteApiToken"
                        wire:loading.attr="disabled">
                        {{ __('filament-companies::default.buttons.delete') }}
                    </x-filament::button>
                </x-slot>
            </x-filament-companies::dialog-modal>
        </div>
    </x-filament-companies::grid-section>
</div>
