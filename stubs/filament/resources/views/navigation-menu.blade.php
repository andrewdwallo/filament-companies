<div class="flex justify-end">
    @if (Wallo\FilamentCompanies\FilamentCompanies::hasCompanyFeatures())
        <x-filament::dropdown placement="bottom-end">
            <x-slot name="trigger" class="ml-4">
                <button @class([
                    'inline-flex items-center px-3 py-2 border border-transparent text-sm text-gray-800 hover:text-primary-500 leading-4 font-medium rounded-md bg-white hover:bg-gray-50 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition',
                    'dark:bg-gray-800 dark:hover:bg-gray-700 dark:border-white dark:hover:border-primary-400 dark:text-white dark:hover:text-primary-400' => config('filament.dark_mode'),
                ])>
                    {{ Auth::user()->currentCompany->name }}
                </button>
            </x-slot>

            <!-- Company Management -->
            <x-filament::dropdown.header :icon="'heroicon-s-user-group'">
                {{ __('Manage Company') }}
            </x-filament::dropdown.header>

            <!-- Company Settings -->
            <x-filament::dropdown.list>
                <x-filament::dropdown.list.item :icon="'heroicon-s-cog'">
                    <x-filament-companies::dropdown-link href="{{ route('filament.pages.show') }}">
                        {{ __('Company Settings') }}
                    </x-filament-companies::dropdown-link>
                </x-filament::dropdown.list.item>

                @can('create', Wallo\FilamentCompanies\FilamentCompanies::newCompanyModel())
                    <x-filament::dropdown.list.item :icon="'heroicon-s-plus-circle'">
                        <x-filament-companies::dropdown-link href="{{ route('filament.pages.create') }}">
                            {{ __('New Company') }}
                        </x-filament-companies::dropdown-link>
                    </x-filament::dropdown.list.item>
                @endcan

                <div class="border-t border-gray-100"></div>

                <!-- Company Switcher -->
                <x-filament::dropdown.header :icon="'heroicon-s-adjustments'">
                    {{ __('Switch Companies') }}
                </x-filament::dropdown.header>

                <div class="border-t border-gray-100"></div>

                @foreach (Auth::user()->allCompanies() as $company)
                    <x-filament-companies::switchable-company :company="$company" />
                @endforeach
            </x-filament::dropdown.list>
        </x-filament::dropdown>
    @endif
</div>
