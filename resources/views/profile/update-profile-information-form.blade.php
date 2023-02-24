<x-filament-companies::grid-section class="mt-8">
    <x-slot name="title">
        {{ __('filament-companies::default.grid_section_titles.profile_information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('filament-companies::default.grid_section_descriptions.profile_information') }}
    </x-slot>

    <form wire:submit.prevent="updateProfileInformation" class="col-span-2 mt-5 sm:col-span-1 md:mt-0">
        <x-filament::card>
            <!-- Profile Photo -->
            @if (Wallo\FilamentCompanies\FilamentCompanies::managesProfilePhotos())
                <div x-data="{ photoName: null, photoPreview: null }" class="col-span-6 sm:col-span-4">
                    <!-- Profile Photo File Input -->
                    <input type="file"
                           class="hidden"
                           wire:model="photo"
                           x-ref="photo"
                           x-on:change="photoName = $refs.photo.files[0].name;
                                        const reader = new FileReader();
                                        reader.onload = (e) => {
                                            photoPreview = e.target.result;
                                        };
                                        reader.readAsDataURL($refs.photo.files[0]);"/>

                    <x-filament-companies::label for="photo"
                                                 value="{{ __('filament-companies::default.labels.photo') }}"/>

                    <!-- Current Profile Photo -->
                    <div class="mt-2" x-show="! photoPreview">
                        <img src="{{ $this->user->profile_photo_url }}"
                             alt="{{ $this->user->name }}"
                             class="h-20 w-20 rounded-full object-cover">
                    </div>

                    <!-- New Profile Photo Preview -->
                    <div class="mt-2" x-show="photoPreview" style="display: none;">
                        <span class="block h-20 w-20 rounded-full bg-cover bg-center bg-no-repeat"
                              x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                        </span>
                    </div>

                    <div class="text-left">
                        <x-filament::button class="mt-2 mr-2" x-on:click.prevent="$refs.photo.click()">
                            {{ __('filament-companies::default.buttons.new_photo') }}
                        </x-filament::button>

                        @if ($this->user->profile_photo_path)
                            <x-filament::button color="danger" class="mt-2" wire:click="deleteProfilePhoto">
                                {{ __('filament-companies::default.buttons.remove_photo') }}
                            </x-filament::button>
                        @endif

                        <x-filament-companies::input-error for="photo" class="mt-2"/>
                    </div>
                </div>
            @endif

            <!-- Name -->
            <div class="col-span-6 sm:col-span-4">
                <x-forms::field-wrapper id="name"
                                        statePath="state.name"
                                        required="true"
                                        label="{{ __('filament-companies::default.fields.name') }}">
                    <x-filament-companies::input id="name"
                                                 type="text"
                                                 maxLength="255"
                                                 wire:model.defer="state.name"
                                                 autocomplete="name"/>
                </x-forms::field-wrapper>
            </div>

            <!-- Email -->
            <div class="col-span-6 sm:col-span-4">
                <x-forms::field-wrapper id="email"
                                        statePath="state.email"
                                        required="true"
                                        label="{{ __('filament-companies::default.fields.email') }}">
                    <x-filament-companies::input id="email"
                                                 type="email"
                                                 maxLength="255"
                                                 wire:model.defer="state.email"/>
                </x-forms::field-wrapper>

                @if (! $this->user->hasVerifiedEmail() && Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()))
                    <p class="mt-2 text-sm dark:text-white">
                        {{ __('filament-companies::default.headings.profile.update_profile_information.verification_link_not_sent') }}

                        <x-filament::button type="button"
                                            class="text-sm text-gray-600 underline hover:text-gray-900 dark:text-gray-400"
                                            wire:click.prevent="sendEmailVerification">
                            {{ __('filament-companies::default.buttons.resend_verification_email') }}
                        </x-filament::button>
                    </p>

                    @if ($this->verificationLinkSent)
                        <p v-show="verificationLinkSent"
                           class="mt-2 text-sm font-medium text-green-600 dark:text-green-400">
                            {{ __('filament-companies::default.headings.profile.update_profile_information.verification_link_sent') }}
                        </p>
                    @endif
                @endif
            </div>

            <x-slot name="footer">
                <div class="text-left">
                    <x-filament::button type="submit" wire:loading.attr="disabled" wire:target="photo">
                        {{ __('filament-companies::default.buttons.save') }}
                    </x-filament::button>
                </div>
            </x-slot>
        </x-filament::card>
    </form>
</x-filament-companies::grid-section>
