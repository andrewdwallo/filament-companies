@props(['title','description'])
<x-filament::grid @class(["pt-6 gap-4 filament-tenants-grid-section"]) {{ $attributes }}>

    <x-filament::grid.column>
        <h3 @class(['text-lg font-medium filament-tenants-grid-title'])>{{$title}}</h3>

        <p @class(['mt-1 text-sm text-gray-500 filament-tenants-grid-description'])>
            {{$description}}
        </p>
    </x-filament::grid.column>

    <x-filament::grid.column>
        {{ $slot }}
    </x-filament::grid.column>

</x-filament::grid>
