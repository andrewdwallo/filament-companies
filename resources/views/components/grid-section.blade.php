@props(['title','description'])

<x-filament::section
    aside
    {{ $attributes->merge(['class' => 'filament-companies-grid-section']) }}
>
    <x-slot name="heading">
        {{ $title }}
    </x-slot>

    @if (filled($description))
        <x-slot name="description">
            {{ $description }}
        </x-slot>
    @endif

    {{ $slot }}
</x-filament::section>
