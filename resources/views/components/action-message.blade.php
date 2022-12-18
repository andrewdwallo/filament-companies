<div class="\Illuminate\Support\Arr::toCssClasses([
        'flex gap-3 w-full transition duration-300',
        'shadow-lg max-w-sm bg-white rounded-xl p-4 border border-gray-200' => ! $isInline(),
        'dark:border-gray-700 dark:bg-gray-800' => (! $isInline()) && config('notifications.dark_mode'),
    ])"
    x-transition:enter-start="\Illuminate\Support\Arr::toCssClasses([
        'opacity-0',
        match (config('notifications.layout.alignment.horizontal')) {
            'left' => '-translate-x-12',
            'right' => 'translate-x-12',
            'center' => match (config('notifications.layout.alignment.vertical')) {
                'top' => '-translate-y-12',
                'bottom' => 'translate-y-12',
            },
        },
    ])"
    x-transition:leave-end="scale-95 opacity-0"
>
    {{ $slot}}
</div>
