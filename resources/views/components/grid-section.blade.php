@props([
    'title',
    'description'
])

<div {{ $attributes->class(['filament-companies-grid-section grid grid-cols-2 gap-6 filament-companies::grid-section']) }}>

    <div class="col-span-2 sm:col-span-1 flex justify-between">
        <div class="px-4 sm:px-0">
            <h2 @class([
                'text-lg font-medium text-gray-900 filament-companies-grid-title',
                'dark:text-white' => config('filament.dark_mode'),
            ])>{{ $title }}</h2>

            <p @class([
                'mt-1 text-sm text-gray-600 dark:text-gray-400 filament-companies-grid-description',
                'dark:text-gray-100' => config('filament.dark_mode'),
            ])>{{ $description }}</p>
        </div>
    </div>

    {{ $slot }}

</div>
