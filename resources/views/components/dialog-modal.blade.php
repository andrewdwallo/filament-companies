@props(['id' => null, 'maxWidth' => null])

<x-filament-companies::modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="space-y-2 p-2">
        <div class="p-4 space-y-2 text-center dark:text-white">
            <div class="text-xl font-bold tracking-tight">
                {{ $title }}
            </div>

            <div class="text-gray-500">
                {{ $content }}
            </div>
        </div>
    </div>

    <div class="space-y-2">
        <div area-hidden="true" class="filament-hr border-t dark:border-gray-700 px-2">
            <div class="px-6 py-2">
                <div class="grid gap-2 grid-cols-[repeat(auto-fit,minmax(0,1fr))]">
                    {{ $footer }}
                </div>
            </div>
        </div>
    </div>
</x-filament-companies::modal>
