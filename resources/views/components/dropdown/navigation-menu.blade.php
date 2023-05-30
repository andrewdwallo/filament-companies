<div id="navigation-menu" class="filament-companies-navigation-menu flex justify-end">
    @if (Wallo\FilamentCompanies\FilamentCompanies::hasCompanyFeatures())
        <x-filament::dropdown placement="bottom-end">
            <x-slot name="trigger">
                <div class="filament-companies-navigation-menu-button-container inline-flex rounded-md" x-data="{ open: false }" @click.outside="open = false">
                    <button type="button" @click="open = !open" :class="{'focus:outline-none focus:bg-gray-500/5 dark:focus:bg-gray-700': open }" class="filament-companies-navigation-menu-button inline-flex items-center text-sm font-medium dark:text-gray-300 leading-4 pl-4 pr-2 py-2 bg-white dark:bg-gray-800 border border-transparent rounded-md hover:bg-gray-500/5 dark:hover:bg-gray-700 active:bg-gray-500/5 dark:active:bg-gray-700 transition ease-in-out duration-150">
                        <span class="mr-1">{{ Auth::user()->currentCompany->name }}</span>
                        <svg x-show="!open" class="w-4 h-4 ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                        <svg x-show="open" x-cloak class="w-4 h-4 ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                        </svg>
                    </button>
                </div>
            </x-slot>

            <!-- Company Management -->
            <x-filament::dropdown.header>
                <div class="filament-companies-navigation-menu-header flex items-center">
                    <svg class="filament-companies-navigation-menu-header-icon mr-2 h-5 w-5 rtl:ml-2 rtl:mr-0 group-hover:text-white group-focus:text-white text-gray-500 dark:text-primary-500" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M14.763.075A.5.5 0 0 1 15 .5v15a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V14h-1v1.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V10a.5.5 0 0 1 .342-.474L6 7.64V4.5a.5.5 0 0 1 .276-.447l8-4a.5.5 0 0 1 .487.022ZM6 8.694 1 10.36V15h5V8.694ZM7 15h2v-1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5V15h2V1.309l-7 3.5V15Z" />
                        <path d="M2 11h1v1H2v-1Zm2 0h1v1H4v-1Zm-2 2h1v1H2v-1Zm2 0h1v1H4v-1Zm4-4h1v1H8V9Zm2 0h1v1h-1V9Zm-2 2h1v1H8v-1Zm2 0h1v1h-1v-1Zm2-2h1v1h-1V9Zm0 2h1v1h-1v-1ZM8 7h1v1H8V7Zm2 0h1v1h-1V7Zm2 0h1v1h-1V7ZM8 5h1v1H8V5Zm2 0h1v1h-1V5Zm2 0h1v1h-1V5Zm0-2h1v1h-1V3Z" />
                    </svg>
                    {{ __('filament-companies::default.navigation.headers.manage_company') }}
                </div>
            </x-filament::dropdown.header>

            <!-- Company Settings -->
            <x-filament::dropdown.list>
                <x-filament::dropdown.list.item href="{{ url(\Wallo\FilamentCompanies\Pages\Companies\CompanySettings::getUrl(['company' => Auth::user()->currentCompany->id])) }}" tag="a">
                    <div class="filament-companies-navigation-menu-item flex items-center">
                        <svg class="filament-companies-navigation-menu-item-icon mr-2 h-5 w-5 rtl:ml-2 rtl:mr-0 group-hover:text-white group-focus:text-white text-gray-500 dark:text-primary-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M11.828 2.25c-.916 0-1.699.663-1.85 1.567l-.091.549a.798.798 0 01-.517.608 7.45 7.45 0 00-.478.198.798.798 0 01-.796-.064l-.453-.324a1.875 1.875 0 00-2.416.2l-.243.243a1.875 1.875 0 00-.2 2.416l.324.453a.798.798 0 01.064.796 7.448 7.448 0 00-.198.478.798.798 0 01-.608.517l-.55.092a1.875 1.875 0 00-1.566 1.849v.344c0 .916.663 1.699 1.567 1.85l.549.091c.281.047.508.25.608.517.06.162.127.321.198.478a.798.798 0 01-.064.796l-.324.453a1.875 1.875 0 00.2 2.416l.243.243c.648.648 1.67.733 2.416.2l.453-.324a.798.798 0 01.796-.064c.157.071.316.137.478.198.267.1.47.327.517.608l.092.55c.15.903.932 1.566 1.849 1.566h.344c.916 0 1.699-.663 1.85-1.567l.091-.549a.798.798 0 01.517-.608 7.52 7.52 0 00.478-.198.798.798 0 01.796.064l.453.324a1.875 1.875 0 002.416-.2l.243-.243c.648-.648.733-1.67.2-2.416l-.324-.453a.798.798 0 01-.064-.796c.071-.157.137-.316.198-.478.1-.267.327-.47.608-.517l.55-.091a1.875 1.875 0 001.566-1.85v-.344c0-.916-.663-1.699-1.567-1.85l-.549-.091a.798.798 0 01-.608-.517 7.507 7.507 0 00-.198-.478.798.798 0 01.064-.796l.324-.453a1.875 1.875 0 00-.2-2.416l-.243-.243a1.875 1.875 0 00-2.416-.2l-.453.324a.798.798 0 01-.796.064 7.462 7.462 0 00-.478-.198.798.798 0 01-.517-.608l-.091-.55a1.875 1.875 0 00-1.85-1.566h-.344zM12 15.75a3.75 3.75 0 100-7.5 3.75 3.75 0 000 7.5z" clip-rule="evenodd" />
                        </svg>
                        {{ __('filament-companies::default.navigation.links.company_settings') }}
                    </div>
                </x-filament::dropdown.list.item>

                @can('create', Wallo\FilamentCompanies\FilamentCompanies::newCompanyModel())
                    <x-filament::dropdown.list.item href="{{ url(\Wallo\FilamentCompanies\Pages\Companies\CreateCompany::getUrl()) }}" tag="a">
                        <div class="filament-companies-navigation-menu-item flex items-center">
                            <svg class="filament-companies-navigation-menu-item-icon mr-2 h-5 w-5 rtl:ml-2 rtl:mr-0 group-hover:text-white group-focus:text-white text-gray-500 dark:text-primary-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            {{ __('filament-companies::default.navigation.links.create_company') }}
                        </div>
                    </x-filament::dropdown.list.item>
                @endcan

            </x-filament::dropdown.list>

            <!-- Company Switcher -->
            @if(Auth::user()->allCompanies()->count() > 1)
                <x-filament::dropdown.header>
                    <div class="filament-companies-navigation-menu-header flex items-center">
                        <svg class="filament-companies-navigation-menu-header-icon mr-2 h-5 w-5 rtl:ml-2 rtl:mr-0 text-gray-500 dark:text-primary-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 8l4 -4l4 4" />
                            <path d="M7 4l0 9" />
                            <path d="M13 16l4 4l4 -4" />
                            <path d="M17 10l0 10" />
                        </svg>
                        {{ __('filament-companies::default.navigation.headers.switch_companies') }}
                    </div>
                </x-filament::dropdown.header>

                <x-filament::dropdown.list>
                    @foreach (Auth::user()->allCompanies() as $company)
                        <x-filament-companies::switchable-company :company="$company" />
                    @endforeach
                </x-filament::dropdown.list>
            @endif
        </x-filament::dropdown>
    @endif
</div>

<script>
  window.addEventListener('refresh-navigation-menu', event => {
    const newContent = event.detail.content;
    const navigationMenu = document.getElementById('navigation-menu');
    navigationMenu.innerHTML = newContent;
  });
</script>
