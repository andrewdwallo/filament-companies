@props(['style' => session('flash.bannerStyle', 'success'), 'message' => session('flash.banner')])

<div x-data="{{ json_encode(['show' => true, 'style' => $style, 'message' => $message], JSON_THROW_ON_ERROR) }}"
            :class="{ 'bg-primary-500': style === 'success', 'bg-red-700': style === 'danger', 'bg-gray-500': style !== 'success' && style !== 'danger' }"
            x-cloak
            x-show="show && message"
            x-init="
                document.addEventListener('banner-message', event => {
                    this.style = event.detail.style;
                    this.message = event.detail.message;
                    this.show = true;
                });
            ">
    <div class="filament-companies-banner max-w-screen-xl mx-auto py-3 px-4 sm:px-6 lg:px-8">
        <div class="filament-companies-banner-container flex items-center justify-between flex-wrap">
            <div class="filament-companies-banner-header w-0 flex-1 flex items-center min-w-0">
                <span class="flex items-center p-2 rounded-lg" :class="{ 'bg-primary-600': style === 'success', 'bg-red-600': style === 'danger' }">
                    <svg x-show="style === 'success'" class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <svg x-show="style === 'danger'" class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                    </svg>
                    <svg x-show="style !== 'success' && style !== 'danger'" class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                    </svg>
                </span>

                <p class="ml-4 font-medium text-sm text-white truncate" x-text="message"></p>
            </div>

            <div class="filament-companies-banner-footer shrink-0 sm:ml-3">
                <button
                    type="button"
                    class="filament-companies-banner-button -mr-1 flex p-2 rounded-md focus:outline-none sm:-mr-2 transition"
                    :class="{ 'hover:bg-primary-600 focus:bg-primary-600': style === 'success', 'hover:bg-red-600 focus:bg-red-600': style === 'danger' }"
                    aria-label="Dismiss" x-on:click="show = false">
                    <svg class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>
