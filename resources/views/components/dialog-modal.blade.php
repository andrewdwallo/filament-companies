@props(['id' => null, 'maxWidth' => config('filament-companies.layout.modals.dialog_modal_width', '2xl')])

<x-filament-companies::modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="space-y-4 p-4">
        <div class="p-4 space-y-4 text-center dark:text-white">
            <h2 class="text-xl font-bold tracking-tight">
                {{ $title }}
            </h2>

            <div class="text-gray-500">
                {{ $content }}
            </div>
        </div>
    </div>

    <div class="space-y-4">
        <div area-hidden="true" class="border-t dark:border-gray-700 px-2">
            <div class="px-6 py-4">
                <div class="grid gap-2 grid-cols-[repeat(auto-fit,minmax(0,1fr))]">
                    {{ $footer }}
                </div>
            </div>
        </div>
    </div>
</x-filament-companies::modal>
