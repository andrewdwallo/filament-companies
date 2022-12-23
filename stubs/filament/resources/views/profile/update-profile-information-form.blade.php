<x-filament-companies::grid-section class="mt-8">
    <x-slot name="title">
        {{ __('Profile Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s profile information and email address.') }}
    </x-slot>

    <x-filament::form wire:submit.prevent="updateProfileInformation">
        <!-- Profile Photo -->
        @if (Wallo\FilamentCompanies\FilamentCompanies::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input type="file" class="hidden"
                       wire:model="photo"
                       x-ref="photo"
                       x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            "/>

                <x-filament-companies::label for="photo" value="{{ __('Photo') }}"/>

                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="rounded-full h-20 w-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview" style="display: none;">
                    <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                          x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-filament::button class="mt-2 mr-2" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Select A New Photo') }}
                </x-filament::button>

                @if ($this->user->profile_photo_path)
                    <x-filament::button color="danger" class="mt-2" wire:click="deleteProfilePhoto">
                        {{ __('Remove Photo') }}
                    </x-filament::button>
                @endif

                <x-filament-companies::input-error for="photo" class="mt-2"/>
            </div>
        @endif

        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-filament-companies::label for="name" value="{{ __('Name') }}"/>
            <x-filament-companies::input id="name" type="text" class="mt-1 block w-full" wire:model.defer="state.name" autocomplete="name"/>
            <x-filament-companies::input-error for="name" class="mt-2"/>
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-filament-companies::label for="email" value="{{ __('Email') }}"/>
            <x-filament-companies::input id="email" type="email" class="mt-1 block w-full" wire:model.defer="state.email"/>
            <x-filament-companies::input-error for="email" class="mt-2"/>

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && ! $this->user-hasVerifiedEmail())
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Before your email can be updated, you must verify your current email address.') }}

                    <x-filament::button type="button" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900" wire:click.prevent="sendEmailVerification">
                        {{ __('Resend Verification Email') }}
                    </x-filament::button>
                </p>

                @if ($this->verificationLinkSent)
                    <p v-show="verificationLinkSent" class="mt-2 font-medium text-sm text-green-600 dark:text-green-700">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            @endif
        </div>

        <x-filament::button type="submit" wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-filament::button>
    </x-filament::form>
</x-filament-companies::grid-section>
