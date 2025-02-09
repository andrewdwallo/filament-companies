@php
    $modals = \Wallo\FilamentTenants\FilamentTenants::getModals();
@endphp

<div>
        <x-filament-tenants::section-border />

        <!-- Manage Tenant Employees -->
        <x-filament-tenants::grid-section md="2">
            <x-slot name="title">
                {{ __('filament-tenants::default.action_section_titles.tenant_employees') }}
            </x-slot>

            <x-slot name="description">
                {{ __('filament-tenants::default.action_section_descriptions.tenant_employees') }}
            </x-slot>

            <!-- Tenant Employee List -->
            <div class="col-span-2 mt-5 space-y-2 overflow-x-auto bg-white shadow rounded-xl dark:border-gray-600 dark:bg-gray-800 sm:col-span-1 md:col-start-2 md:mt-0">
                <table class="w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-white dark:bg-gray-800">
                    <tr>
                        <th scope="col" colspan="3" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-600 uppercase dark:text-gray-400">
                            {{ __('filament-tenants::default.fields.name') }}
                        </th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        <tr>
                            <td colspan="2" class="px-6 py-4 text-left whitespace-nowrap">
                                <div class="flex items-center gap-2 text-sm">
                                    <div class="flex-shrink-0">
                                        <x-filament-panels::avatar.user :user="$tenant->owner" size="lg" />
                                    </div>
                                    <div class="ml-4">
                                        <div class="font-medium text-gray-900 dark:text-gray-200">{{ $tenant->owner->name }}</div>
                                        <div class="hidden text-gray-600 dark:text-gray-400 sm:block">{{ $tenant->owner->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td colspan="1" class="px-6 py-4 whitespace-nowrap">
                                <div class="space-x-2 text-right">
                                        <x-filament::button size="sm" outlined="true" disabled="true" outlined="true" color="gray">
                                            {{ __('filament-tenants::default.labels.tenant_owner') }}
                                        </x-filament::button>
                                </div>
                            </td>
                        </tr>
                    @if ($tenant->users->isNotEmpty())
                    @foreach ($tenant->users->sortBy('name') as $user)
                        <tr>
                            <td colspan="2" class="px-6 py-4 text-left whitespace-nowrap">
                                <div class="flex items-center gap-2 text-sm">
                                    <div class="flex-shrink-0">
                                        <x-filament-panels::avatar.user :user="$user" size="lg" />
                                    </div>
                                    <div class="ml-4">
                                        <div class="font-medium text-gray-900 dark:text-gray-200">{{ $user->name }}</div>
                                        <div class="hidden text-gray-600 dark:text-gray-400 sm:block">{{ $user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td colspan="1" class="px-6 py-4 whitespace-nowrap">
                                <div class="space-x-2 text-right">
                                    <!-- Manage Tenant Employee Role -->
                                    @if (Gate::check('updateTenantEmployee', $tenant) && Wallo\FilamentTenants\FilamentTenants::hasRoles())
                                        <x-filament::button size="sm" outlined="true" color="primary" wire:click="manageRole('{{ $user->id }}')">
                                            {{ Wallo\FilamentTenants\FilamentTenants::findRole($user->employeeship->role)->name }}
                                        </x-filament::button>
                                    @elseif (Wallo\FilamentTenants\FilamentTenants::hasRoles())
                                        <x-filament::button size="sm" disabled="true" outlined="true" color="gray">
                                            {{ Wallo\FilamentTenants\FilamentTenants::findRole($user->employeeship->role)->name }}
                                        </x-filament::button>
                                    @endif

                                    <!-- Leave Tenant -->
                                    @if ($this->user->id === $user->id)
                                        <x-filament::button size="sm" color="danger" wire:click="confirmLeavingTenant">
                                            {{ __('filament-tenants::default.buttons.leave') }}
                                        </x-filament::button>

                                        <!-- Remove Tenant Employee -->
                                    @elseif (Gate::check('removeTenantEmployee', $tenant))
                                        <x-filament::button size="sm" color="danger" wire:click="confirmTenantEmployeeRemoval('{{ $user->id }}')">
                                            {{ __('filament-tenants::default.buttons.remove') }}
                                        </x-filament::button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </x-filament-tenants::grid-section>


    @if (Gate::check('addTenantEmployee', $tenant))
        <x-filament-tenants::section-border />

        <!-- Add Tenant Employee -->
        <x-filament-tenants::grid-section md="2">
            <x-slot name="title">
                {{ __('filament-tenants::default.grid_section_titles.add_tenant_employee') }}
            </x-slot>

            <x-slot name="description">
                {{ __('filament-tenants::default.grid_section_descriptions.add_tenant_employee') }}
            </x-slot>

            <x-filament::section>
                <x-filament-panels::form wire:submit="addTenantEmployee">
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        {{ __('filament-tenants::default.subheadings.tenants.tenant_employee_manager') }}
                    </p>

                    <!-- Employee Email -->
                    <x-filament-forms::field-wrapper id="email" statePath="email" required="required" label="{{ __('filament-tenants::default.fields.email') }}">
                        <x-filament::input.wrapper class="overflow-hidden">
                            <x-filament::input id="email" type="email" wire:model="addTenantEmployeeForm.email" />
                        </x-filament::input.wrapper>
                    </x-filament-forms::field-wrapper>

                    <!-- Role -->
                    @if (count($this->roles) > 0)
                        <x-filament-forms::field-wrapper id="role" statePath="role" required="required" label="{{ __('filament-tenants::default.labels.role') }}">
                            <div x-data="{ role: @entangle('addTenantEmployeeForm.role').live }" class="relative z-0 mt-1 cursor-pointer rounded-lg border border-gray-200 dark:border-gray-700">
                                @foreach ($this->roles as $index => $role)
                                    <button type="button"
                                            @click="role = '{{ $role->key }}'"
                                            @class([
                                                'relative inline-flex w-full rounded-lg px-4 py-3 transition focus:z-10 focus:outline-none focus:ring-2 focus:border-primary-500 focus:ring-primary-500 dark:focus:border-primary-600 dark:focus:ring-primary-600',
                                                'border-t border-gray-200 dark:border-gray-700 rounded-t-none' => ($index > 0),
                                                'rounded-b-none' => (! $loop->last),
                                            ])
                                    >
                                        <div :class="role === '{{ $role->key }}' || 'opacity-50'">
                                            <!-- Role Name -->
                                            <div class="flex items-center">
                                                <div class="text-sm text-gray-600 dark:text-gray-400" :class="{'font-semibold': role === '{{ $role->key }}'}">
                                                    {{ $role->name }}
                                                </div>

                                                <div x-cloak :class="{ 'hidden': role !== '{{ $role->key }}' }">
                                                    <x-heroicon-o-check-badge class="text-primary-500 ml-2 h-5 w-5" />
                                                </div>
                                            </div>

                                            <!-- Role Description -->
                                            <div class="mt-2 text-left text-sm text-gray-600 dark:text-gray-400">
                                                {{ $role->description }}
                                            </div>
                                        </div>
                                    </button>
                                @endforeach
                            </div>
                        </x-filament-forms::field-wrapper>
                    @endif

                    <div class="text-left">
                        <x-filament::button type="submit">
                            {{ __('filament-tenants::default.buttons.add') }}
                        </x-filament::button>
                    </div>
                </x-filament-panels::form>
            </x-filament::section>
        </x-filament-tenants::grid-section>
    @endif

    @if ($tenant->tenantInvitations->isNotEmpty() && Gate::check('addTenantEmployee', $tenant))
        <x-filament-tenants::section-border />

        <!-- Pending Employee Invitations -->
        <x-filament-tenants::grid-section md="2">
            <x-slot name="title">
                {{ __('filament-tenants::default.action_section_titles.pending_tenant_invitations') }}
            </x-slot>

            <x-slot name="description">
                {{ __('filament-tenants::default.action_section_descriptions.pending_tenant_invitations') }}
            </x-slot>

            <div class="overflow-x-auto space-y-2 bg-white rounded-xl shadow dark:border-gray-600 dark:bg-gray-800 col-span-2 mt-5 sm:col-span-1 md:col-start-2 md:mt-0">
                <table class="w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-100 dark:bg-gray-800">
                    <tr>
                        <th colspan="3" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            {{ __('filament-tenants::default.fields.email') }}
                        </th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach ($tenant->tenantInvitations as $invitation)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="text-gray-500 dark:text-gray-400">
                                        {{ $invitation->email }}
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-right">
                                    <!-- Manage Tenant Employee Role -->
                                    @if (Gate::check('removeTenantEmployee', $tenant))
                                        <x-filament::button size="sm" color="danger" outlined="true" wire:click="cancelTenantInvitation({{ $invitation->id }})">
                                            {{ __('filament-tenants::default.buttons.cancel') }}
                                        </x-filament::button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </x-filament-tenants::grid-section>
    @endif

    <!-- Role Management Modal -->
    <x-filament::modal id="currentlyManagingRole" icon="heroicon-o-shield-check" icon-color="primary" alignment="{{ $modals['alignment'] }}" footer-actions-alignment="{{ $modals['formActionsAlignment'] }}" width="{{ $modals['width'] }}">
        <x-slot name="heading">
            {{ __('filament-tenants::default.modal_titles.manage_role') }}
        </x-slot>

        <div x-data="{ role: @entangle('currentRole').live }"
             class="relative z-0 mt-1 cursor-pointer rounded-lg border border-gray-200 dark:border-gray-700">
            @foreach ($this->roles as $index => $role)
                <button type="button"
                        @click="role = '{{ $role->key }}'"
                        @class([
                            'relative inline-flex w-full rounded-lg px-4 py-3 transition focus:z-10 focus:outline-none focus:ring-2 focus:border-primary-500 focus:ring-primary-500 dark:focus:border-primary-600 dark:focus:ring-primary-600',
                            'border-t border-gray-200 dark:border-gray-700 rounded-t-none' => ($index > 0),
                            'rounded-b-none' => (! $loop->last),
                        ])
                >
                    <div :class="role === '{{ $role->key }}' || 'opacity-50'">
                        <!-- Role Name -->
                        <div class="flex items-center">
                            <div class="text-sm text-gray-600 dark:text-gray-100" :class="role === '{{ $role->key }}' ? 'font-semibold' : ''">
                                {{ $role->name }}
                            </div>

                            <div x-cloak :class="{ 'hidden': role !== '{{ $role->key }}' }">
                                <x-heroicon-o-check-badge class="text-primary-500 ml-2 h-5 w-5" />
                            </div>
                        </div>

                        <!-- Role Description -->
                        <div class="mt-2 text-xs text-gray-600 dark:text-gray-400">
                            {{ $role->description }}
                        </div>
                    </div>
                </button>
            @endforeach
        </div>

        <x-slot name="footerActions">
            @if($modals['cancelButtonAction'])
                <x-filament::button color="gray" wire:click="stopManagingRole">
                    {{ __('filament-tenants::default.buttons.cancel') }}
                </x-filament::button>
            @endif

            <x-filament::button wire:click="updateRole">
                {{ __('filament-tenants::default.buttons.save') }}
            </x-filament::button>
        </x-slot>
    </x-filament::modal>

    <!-- Leave Tenant Confirmation Modal -->
    <x-filament::modal id="confirmingLeavingTenant" icon="heroicon-o-exclamation-triangle" icon-color="danger" alignment="{{ $modals['alignment'] }}" footer-actions-alignment="{{ $modals['formActionsAlignment'] }}" width="{{ $modals['width'] }}">
        <x-slot name="heading">
            {{ __('filament-tenants::default.modal_titles.leave_tenant') }}
        </x-slot>

        <x-slot name="description">
            {{ __('filament-tenants::default.modal_descriptions.leave_tenant') }}
        </x-slot>

        <x-slot name="footerActions">
            @if($modals['cancelButtonAction'])
                <x-filament::button color="gray" wire:click="cancelLeavingTenant">
                    {{ __('filament-tenants::default.buttons.cancel') }}
                </x-filament::button>
            @endif

            <x-filament::button color="danger" wire:click="leaveTenant">
                {{ __('filament-tenants::default.buttons.leave') }}
            </x-filament::button>
        </x-slot>
    </x-filament::modal>

    <!-- Remove Tenant Employee Confirmation Modal -->
    <x-filament::modal id="confirmingTenantEmployeeRemoval" icon="heroicon-o-exclamation-triangle" icon-color="danger" alignment="{{ $modals['alignment'] }}" footer-actions-alignment="{{ $modals['formActionsAlignment'] }}" width="{{ $modals['width'] }}">
        <x-slot name="heading">
            {{ __('filament-tenants::default.modal_titles.remove_tenant_employee') }}
        </x-slot>

        <x-slot name="description">
            {{ __('filament-tenants::default.modal_descriptions.remove_tenant_employee') }}
        </x-slot>

        <x-slot name="footerActions">
            @if($modals['cancelButtonAction'])
                <x-filament::button color="gray" wire:click="cancelTenantEmployeeRemoval">
                    {{ __('filament-tenants::default.buttons.cancel') }}
                </x-filament::button>
            @endif

            <x-filament::button color="danger" wire:click="removeTenantEmployee">
                {{ __('filament-tenants::default.buttons.remove') }}
            </x-filament::button>
        </x-slot>
    </x-filament::modal>
</div>
