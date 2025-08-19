@props(['title','description'])
<div @class(["pt-6 grid grid-cols-1 md:grid-cols-2 gap-4 filament-companies-grid-section"]) {{ $attributes }}>

    <div>
        <h3 @class(['text-lg font-medium filament-companies-grid-title'])>{{$title}}</h3>

        <p @class(['mt-1 text-sm text-gray-500 filament-companies-grid-description'])>
            {{$description}}
        </p>
    </div>

    <div>
        {{ $slot }}
    </div>
</div>
