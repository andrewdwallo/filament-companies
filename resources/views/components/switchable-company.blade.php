@props(['company', 'component' => 'filament::dropdown.list.item'])

<form method="POST" action="{{ route('current-company.update') }}" x-data>
    @method('PUT')
    @csrf

    <!-- Hidden Company ID -->
    <input type="hidden" name="company_id" value="{{ $company->id }}">

    <x-dynamic-component :component="$component" href="#" x-on:click.prevent="$root.submit();">
        <div class="flex items-center">
            @if (Auth::user()->isCurrentCompany($company))
                <svg class="mr-2 h-5 w-5 rtl:ml-2 rtl:mr-0 group-hover:text-white group-focus:text-white dark:text-primary-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            @endif

            <div class="truncate">{{ $company->name }}</div>
        </div>
    </x-dynamic-component>
</form>
