<div class="flex justify-end">
    @if (Wallo\FilamentCompanies\FilamentCompanies::hasCompanyFeatures())
        <x-filament::dropdown placement="bottom-end">
            <x-slot name="trigger" class="ml-4">
                <button @class([
                    'inline-flex items-center px-3 py-2 border border-transparent text-sm text-gray-800 hover:text-primary-500 leading-4 font-medium rounded-md bg-white hover:bg-gray-50 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition',
                    'dark:bg-gray-800 dark:hover:bg-gray-700 dark:border-white dark:hover:border-primary-400 dark:text-white dark:hover:text-primary-400' => config('filament.dark_mode'),
                ])>
                    {{ Auth::user()->currentCompany->name }}
                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                    </svg>
                </button>
            </x-slot>

            <!-- Company Management -->
            <x-filament::dropdown.header :icon="'heroicon-s-user-group'">
                {{ __('filament-companies::default.navigation.headers.manage_company') }}
            </x-filament::dropdown.header>

            <!-- Company Settings -->
            <x-filament::dropdown.list>
                <x-filament::dropdown.list.item :icon="'heroicon-s-cog'">
                    <x-filament-companies::dropdown-link href="{{ route('filament.pages.show') }}">
                        {{ __('filament-companies::default.navigation.links.company_settings') }}
                    </x-filament-companies::dropdown-link>
                </x-filament::dropdown.list.item>

                @can('create', Wallo\FilamentCompanies\FilamentCompanies::newCompanyModel())
                    <x-filament::dropdown.list.item :icon="'heroicon-s-plus-circle'">
                        <x-filament-companies::dropdown-link href="{{ route('filament.pages.create') }}">
                            {{ __('filament-companies::default.navigation.links.new_company') }}
                        </x-filament-companies::dropdown-link>
                    </x-filament::dropdown.list.item>
                @endcan

                <div class="border-t border-gray-100"></div>

                <!-- Company Switcher -->
                <x-filament::dropdown.header :icon="'heroicon-s-adjustments'">
                    {{ __('filament-companies::default.navigation.headers.switch_companies') }}
                </x-filament::dropdown.header>

                <div class="border-t border-gray-100"></div>

                @foreach (Auth::user()->allCompanies() as $company)
                    <x-filament-companies::switchable-company :company="$company" />
                @endforeach
            </x-filament::dropdown.list>
        </x-filament::dropdown>
    @endif
</div>
