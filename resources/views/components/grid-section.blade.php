@props([
    'title',
    'description',
    'hasContentEl' => true,
])

<x-filament::section
    aside
    :has-content-el="$hasContentEl"
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
