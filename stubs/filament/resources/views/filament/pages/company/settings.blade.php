<x-filament::page>
    <div class="flex justify-end">
        <!-- Primary Navigation Menu -->
        <div class="xl mr-4 mt-0">
            <div class="flex justify-between h-32">
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <!-- Companies Dropdown -->
                    @if (Wallo\FilamentCompanies\FilamentCompanies::hasCompanyFeatures())
                        <div class="ml-3 relative">
                            <x-filament-companies::dropdown align="right" width="60">
                                <x-slot name="trigger">
                                    <span class="inline-flex rounded-md">
                                        <button type="button"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition">
                                            {{ Auth::user()->currentCompany->name }}

                                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </span>
                                </x-slot>

                                <x-slot name="content">
                                    <div class="w-60">
                                        <!-- Company Switcher -->
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            {{ __('Switch Companies') }}
                                        </div>

                                        <div class="border-t border-gray-100"></div>

                                        @foreach (Auth::user()->allCompanies() as $company)
                                            <x-filament-companies::switchable-company :company="$company" />
                                        @endforeach
                                    </div>
                                </x-slot>
                            </x-filament-companies::dropdown>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="mt-10 sm:mt-0">
        @livewire('companies.create-company-form')
    </div>

    <x-filament-companies::section-border />

    <div class="mt-10 sm:mt-0">
        @livewire('companies.update-company-name-form', ['company' => $company])

        <x-filament-companies::section-border />

        @livewire('companies.company-employee-manager', ['company' => $company])

        <x-filament-companies::section-border />

        @if (Gate::check('delete', $company) && ! $company->personal_company)

            <div class="mt-10 sm:mt-0">
                @livewire('companies.delete-company-form', ['company' => $company])
            </div>
        @endif

        <x-filament-companies::section-border />

    </div>
</x-filament::page>
