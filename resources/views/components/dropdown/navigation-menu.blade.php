<div class="flex justify-end">
    @if (Wallo\FilamentCompanies\FilamentCompanies::hasCompanyFeatures())
        <x-filament::dropdown placement="bottom-start">
            <x-slot name="trigger">
                <span class ="inline-flex rounded-md">
                    <button @class([
                        'inline-flex items-center px-3 py-2 border border-transparent text-sm text-gray-800 leading-4 font-medium rounded-md bg-white hover:bg-gray-50 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition',
                        'dark:bg-gray-800 dark:hover:bg-gray-700 dark:border-white dark:hover:border-primary-400 dark:text-white dark:hover:text-primary-400' => config('filament.dark_mode'),
                    ])>
                        {{ Auth::user()->currentCompany->name }}
                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                        </svg>
                    </button>
                </span>
            </x-slot>

            <!-- Company Management -->
            <x-filament::dropdown.header>
                <div class="flex items-center">
                    <svg class="mr-2 h-5 w-5 rtl:ml2 rtl:mr-0 dark:text-primary-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/>
                    </svg>
                    {{ __('filament-companies::default.navigation.headers.manage_company') }}
                </div>
            </x-filament::dropdown.header>

            <!-- Company Settings -->
            <x-filament::dropdown.list>
                <x-filament::dropdown.list.item href="{{ url(\Wallo\FilamentCompanies\Pages\Companies\CompanySettings::getUrl()) }}" tag="a">
                    <div class="flex items-center">
                        <svg class="mr-2 h-5 w-5 rtl:ml2 rtl:mr-0 group-hover:text-white group-focus:text-white dark:text-primary-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12a7.5 7.5 0 0015 0m-15 0a7.5 7.5 0 1115 0m-15 0H3m16.5 0H21m-1.5 0H12m-8.457 3.077l1.41-.513m14.095-5.13l1.41-.513M5.106 17.785l1.15-.964m11.49-9.642l1.149-.964M7.501 19.795l.75-1.3m7.5-12.99l.75-1.3m-6.063 16.658l.26-1.477m2.605-14.772l.26-1.477m0 17.726l-.26-1.477M10.698 4.614l-.26-1.477M16.5 19.794l-.75-1.299M7.5 4.205L12 12m6.894 5.785l-1.149-.964M6.256 7.178l-1.15-.964m15.352 8.864l-1.41-.513M4.954 9.435l-1.41-.514M12.002 12l-3.75 6.495"/>
                        </svg>
                        {{ __('filament-companies::default.navigation.links.company_settings') }}
                    </div>
                </x-filament::dropdown.list.item>

                @can('create', Wallo\FilamentCompanies\FilamentCompanies::newCompanyModel())
                    <x-filament::dropdown.list.item href="{{ url(\Wallo\FilamentCompanies\Pages\Companies\CreateCompany::getUrl()) }}" tag="a">
                        <div class="flex items-center">
                            <svg class="mr-2 h-5 w-5 rtl:ml2 rtl:mr-0 group-hover:text-white group-focus:text-white dark:text-primary-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ __('filament-companies::default.navigation.links.new_company') }}
                        </div>
                    </x-filament::dropdown.list.item>
                @endcan

                <x-filament::hr />

                <!-- Company Switcher -->
                <x-filament::dropdown.header>
                    <div class="flex items-center">
                        <svg class="mr-2 h-5 w-5 rtl:ml2 rtl:mr-0 dark:text-primary-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 13.5V3.75m0 9.75a1.5 1.5 0 010 3m0-3a1.5 1.5 0 000 3m0 3.75V16.5m12-3V3.75m0 9.75a1.5 1.5 0 010 3m0-3a1.5 1.5 0 000 3m0 3.75V16.5m-6-9V3.75m0 3.75a1.5 1.5 0 010 3m0-3a1.5 1.5 0 000 3m0 9.75V10.5"/>
                        </svg>
                        {{ __('filament-companies::default.navigation.headers.switch_companies') }}
                    </div>
                </x-filament::dropdown.header>

                <x-filament::hr />

                @foreach (Auth::user()->allCompanies() as $company)
                    <x-filament-companies::switchable-company :company="$company" />
                @endforeach
            </x-filament::dropdown.list>
        </x-filament::dropdown>
    @endif
</div>
