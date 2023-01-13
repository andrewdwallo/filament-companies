<div>
    @if (Gate::check('addCompanyEmployee', $company))

        <!-- Add Company Employee -->
        <div class="mt-10 sm:mt-0">
            <x-filament-companies::grid-section class="mt-8">
                <x-slot name="title">
                    {{ __('filament-companies::default.grid_section_titles.add_company_employee') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('filament-companies::default.grid_section_descriptions.add_company_employee') }}
                </x-slot>

                <form wire:submit.prevent="addCompanyEmployee" class="col-span-2 mt-5 sm:col-span-1 md:mt-0">
                    <x-filament::card class="col-span-2 mt-5 sm:col-span-1 md:mt-0">
                        <div class="col-span-6">
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-100">
                                {{ __('filament-companies::default.subheadings.companies.company_employee_manager') }}
                            </p>
                        </div>

                        <!-- Employee Email -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-filament-companies::label for="email" value="{{ __('filament-companies::default.fields.email') }}" />
                            <x-filament-companies::input id="email" type="email" class="mt-1 block w-full"
                                wire:model.defer="addCompanyEmployeeForm.email" />
                            <x-filament-companies::input-error for="email" class="mt-2" />
                        </div>

                        <!-- Role -->
                        @if (count($this->roles) > 0)
                            <div class="col-span-6 lg:col-span-4">
                                <x-filament-companies::label for="role" value="{{ __('filament-companies::default.labels.role') }}" />
                                <x-filament-companies::input-error for="role" class="mt-2" />

                                <div
                                    class="relative z-0 mt-1 cursor-pointer rounded-lg border border-gray-200 dark:border-gray-700">
                                    @foreach ($this->roles as $index => $role)
                                        <button type="button"
                                            class="{{ $index > 0 ? 'border-t border-gray-200 dark:border-gray-700 focus:border-none rounded-t-none' : '' }} {{ !$loop->last ? 'rounded-b-none' : '' }} relative inline-flex w-full rounded-lg px-4 py-3 focus:z-10 focus:border-primary-500 focus:outline-none focus:ring-2 focus:ring-primary-500 dark:focus:border-primary-600 dark:focus:ring-primary-600"
                                            wire:click="$set('addCompanyEmployeeForm.role', '{{ $role->key }}')">
                                            <div
                                                class="{{ isset($addCompanyEmployeeForm['role']) && $addCompanyEmployeeForm['role'] !== $role->key ? 'opacity-50' : '' }}">
                                                <!-- Role Name -->
                                                <div class="flex items-center">
                                                    <div
                                                        class="{{ $addCompanyEmployeeForm['role'] == $role->key ? 'font-semibold' : '' }} text-sm text-gray-600 dark:text-gray-400">
                                                        {{ $role->name }}
                                                    </div>

                                                    @if ($addCompanyEmployeeForm['role'] == $role->key)
                                                        <svg class="ml-2 h-5 w-5 text-primary-500" fill="none"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                                                            </path>
                                                        </svg>
                                                    @endif
                                                </div>

                                                <!-- Role Description -->
                                                <div class="mt-2 text-left text-xs text-gray-600 dark:text-gray-400">
                                                    {{ $role->description }}
                                                </div>
                                            </div>
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <x-slot name="footer">
                            <div class="text-left">
                                <x-filament::button type="submit">
                                    {{ __('filament-companies::default.buttons.add') }}
                                </x-filament::button>
                            </div>
                        </x-slot>
                    </x-filament::card>
                </form>
            </x-filament-companies::grid-section>
        </div>
    @endif

    @if ($company->companyInvitations->isNotEmpty() && Gate::check('addCompanyEmployee', $company))
        <x-filament-companies::section-border />

        <!-- Company Employee Invitations -->
        <div class="mt-10 sm:mt-0">
            <x-filament-companies::action-section class="mt-8">
                <x-slot name="title">
                    {{ __('filament-companies::default.action_section_titles.pending_company_invitations') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('filament-companies::default.action_section_descriptions.pending_company_invitations') }}
                </x-slot>

                <x-slot name="content">
                    <x-filament::card class="col-span-2 mt-5 sm:col-span-1 md:mt-0">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                            {{ __('filament-companies::default.headings.companies.company_employee_manager.pending_invitations') }}
                        </h3>

                        @foreach ($company->companyInvitations as $invitation)
                            <x-filament::hr />
                            <div class="flex items-center justify-between">
                                <div class="text-gray-600 dark:text-gray-400">{{ $invitation->email }}</div>

                                <div class="flex items-center">
                                    @if (Gate::check('removeCompanyEmployee', $company))
                                        <!-- Cancel Company Invitation -->
                                        <x-filament::icon-button color="gray" icon="heroicon-o-x-circle"
                                            tooltip="{{ __('filament-companies::default.buttons.cancel') }}"
                                            wire:click="cancelCompanyInvitation({{ $invitation->id }})" />
                                    @endif
                                </div>
                            </div>
                        @endforeach

                    </x-filament::card>
                </x-slot>
            </x-filament-companies::action-section>
        </div>
    @endif

    @if ($company->users->isNotEmpty())
        <x-filament-companies::section-border />

        <!-- Manage Company Employees -->
        <div class="mt-10 sm:mt-0">
            <x-filament-companies::action-section class="mt-8">
                <x-slot name="title">
                    {{ __('filament-companies::default.action_section_titles.company_employees') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('filament-companies::default.action_section_descriptions.company_employees') }}
                </x-slot>

                <!-- Company Employee List -->
                <x-slot name="content">
                    <x-filament::card class="col-span-2 mt-5 sm:col-span-1 md:mt-0">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                            {{ __('filament-companies::default.headings.companies.company_employee_manager.manage_employees') }}
                        </h3>

                        @foreach ($company->users->sortBy('name') as $user)
                            <x-filament::hr />
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <img class="h-8 w-8 rounded-full" src="{{ $user->profile_photo_url }}"
                                        alt="{{ $user->name }}">
                                    <div class="ml-4 dark:text-white">{{ $user->name }}</div>
                                </div>

                                <div class="flex items-center">
                                    <!-- Manage Company Employee Role -->
                                    @if (Gate::check('addCompanyEmployee', $company) && Wallo\FilamentCompanies\FilamentCompanies::hasRoles())
                                        <button class="ml-2 mr-2 text-sm text-gray-400 underline dark:text-gray-200"
                                            wire:click="manageRole('{{ $user->id }}')">
                                            {{ Wallo\FilamentCompanies\FilamentCompanies::findRole($user->employeeship->role)->name }}
                                        </button>
                                    @elseif (Wallo\FilamentCompanies\FilamentCompanies::hasRoles())
                                        <div class="ml-2 mr-2 text-sm text-gray-400 dark:text-gray-200">
                                            {{ Wallo\FilamentCompanies\FilamentCompanies::findRole($user->employeeship->role)->name }}
                                        </div>
                                    @endif

                                    <!-- Leave Company -->
                                    @if ($this->user->id === $user->id)
                                        <x-filament::button color="danger" class="ml-6 cursor-pointer text-sm"
                                            wire:click="$toggle('confirmingLeavingCompany')">
                                            {{ __('filament-companies::default.buttons.leave') }}
                                        </x-filament::button>

                                        <!-- Remove Company Employee -->
                                    @elseif (Gate::check('removeCompanyEmployee', $company))
                                        <x-filament::button color="danger" class="ml-6 cursor-pointer text-sm"
                                            wire:click="confirmCompanyEmployeeRemoval('{{ $user->id }}')">
                                            {{ __('filament-companies::default.buttons.remove') }}
                                        </x-filament::button>
                                    @endif
                                </div>
                            </div>
                        @endforeach

                    </x-filament::card>
                </x-slot>
            </x-filament-companies::action-section>
        </div>
    @endif

    <!-- Role Management Modal -->
    <x-filament-companies::dialog-modal wire:model="currentlyManagingRole">
        <x-slot name="title">
            {{ __('filament-companies::default.modal_titles.manage_role') }}
        </x-slot>

        <x-slot name="content">
            <div class="relative z-0 mt-1 cursor-pointer rounded-lg border border-gray-200 dark:border-gray-700">
                @foreach ($this->roles as $index => $role)
                    <button type="button"
                        class="{{ $index > 0 ? 'border-t border-gray-200 dark:border-gray-700 focus:border-none rounded-t-none' : '' }} {{ !$loop->last ? 'rounded-b-none' : '' }} relative inline-flex w-full rounded-lg px-4 py-3 focus:z-10 focus:border-primary-500 focus:outline-none focus:ring-2 focus:ring-primary-500 dark:focus:border-primary-600 dark:focus:ring-primary-600"
                        wire:click="$set('currentRole', '{{ $role->key }}')">
                        <div class="{{ $currentRole !== $role->key ? 'opacity-50' : '' }}">
                            <!-- Role Name -->
                            <div class="flex items-center">
                                <div
                                    class="{{ $currentRole == $role->key ? 'font-semibold' : '' }} text-sm text-gray-600 dark:text-gray-400">
                                    {{ $role->name }}
                                </div>

                                @if ($currentRole == $role->key)
                                    <svg class="ml-2 h-5 w-5 text-green-400" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                @endif
                            </div>

                            <!-- Role Description -->
                            <div class="mt-2 text-xs text-gray-600 dark:text-gray-400">
                                {{ $role->description }}
                            </div>
                        </div>
                    </button>
                @endforeach
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-filament::button color="gray" class="mr-3" wire:click="stopManagingRole"
                wire:loading.attr="disabled">
                {{ __('filament-companies::default.buttons.cancel') }}
            </x-filament::button>

            <x-filament::button class="ml-3" wire:click="updateRole" wire:loading.attr="disabled">
                {{ __('filament-companies::default.buttons.save') }}
            </x-filament::button>
        </x-slot>
    </x-filament-companies::dialog-modal>

    <!-- Leave Company Confirmation Modal -->
    <x-filament-companies::dialog-modal wire:model="confirmingLeavingCompany">
        <x-slot name="title">
            {{ __('filament-companies::default.modal_titles.leave_company') }}
        </x-slot>

        <x-slot name="content">
            {{ __('filament-companies::default.modal_descriptions.leave_company') }}
        </x-slot>

        <x-slot name="footer">
            <x-filament::button wire:click="$toggle('confirmingLeavingCompany')" wire:loading.attr="disabled">
                {{ __('filament-companies::default.buttons.cancel') }}
            </x-filament::button>

            <x-filament::button class="ml-3" wire:click="leaveCompany" wire:loading.attr="disabled">
                {{ __('filament-companies::default.buttons.leave') }}
            </x-filament::button>
        </x-slot>
    </x-filament-companies::dialog-modal>

    <!-- Remove Company Employee Confirmation Modal -->
    <x-filament-companies::dialog-modal wire:model="confirmingCompanyEmployeeRemoval">
        <x-slot name="title">
            {{ __('filament-companies::default.modal_titles.remove_company_employee') }}
        </x-slot>

        <x-slot name="content">
            {{ __('filament-companies::default.modal_descriptions.remove_company_employee') }}
        </x-slot>

        <x-slot name="footer">
            <x-filament::button wire:click="$toggle('confirmingCompanyEmployeeRemoval')" wire:loading.attr="disabled">
                {{ __('filament-companies::default.buttons.cancel') }}
            </x-filament::button>

            <x-filament::button class="ml-3" wire:click="removeCompanyEmployee" wire:loading.attr="disabled">
                {{ __('filament-companies::default.buttons.remove') }}
            </x-filament::button>
        </x-slot>
    </x-filament-companies::dialog-modal>
</div>
