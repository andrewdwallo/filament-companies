@props(['company', 'component' => 'filament::dropdown.list.item'])

<form method="POST" action="{{ route('current-company.update') }}" x-data>
    @method('PUT')
    @csrf

    <!-- Hidden Company ID -->
    <input type="hidden" name="company_id" value="{{ $company->id }}">

    <x-dynamic-component :component="$component" href="#" x-on:click.prevent="$root.submit();">
        <div class="flex items-center">
            @if (Auth::user()->isCurrentCompany($company))
                <x-heroicon-s-check-circle wire:target class="mr-2 h-5 w-5 rtl:ml-2 rtl:mr-0 group-hover:text-white group-focus:text-white text-primary-500" />
            @endif

            <div class="truncate">{{ $company->name }}</div>
        </div>
    </x-dynamic-component>
</form>
