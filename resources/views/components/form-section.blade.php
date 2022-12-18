@props(['submit'])

<div {{ $attributes->merge(['class' => 'md:grid md:grid-cols-3 md:gap-6']) }}>
    <x-context-section-title>
        <x-slot name="title">{{ $title }}</x-slot>
        <x-slot name="description">{{ $description }}</x-slot>
    </x-context-section-title>

    <div class="mt-5 md:mt-0 md:col-span-2">
        <form wire:submit.prevent="{{ $submit }}">
            <div
                class="px-4 py-5 bg-white text-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-100 sm:p-6 shadow {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">
                <div class="grid grid-cols-6 gap-6">
                    {{ $form }}
                </div>
            </div>

            @if (isset($actions))
                <div
                    class="flex items-center justify-end px-4 py-3 bg-gray-100 text-gray-900 dark:bg-gray-700 dark:border-gray-700 dark:text-gray-100 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                    {{ $actions }}
                </div>
            @endif
        </form>
    </div>
</div>
