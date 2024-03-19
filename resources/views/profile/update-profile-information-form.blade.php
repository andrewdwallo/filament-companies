<x-filament-companies::grid-section md="2">
    <x-slot name="title">
        {{ __('filament-companies::default.grid_section_titles.profile_information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('filament-companies::default.grid_section_descriptions.profile_information') }}
    </x-slot>

    <x-filament::section>
        <x-filament-panels::form wire:submit="updateProfileInformation">
            <!-- Profile Photo -->
            @if (Wallo\FilamentCompanies\FilamentCompanies::managesProfilePhotos())
                <div x-data="{ photoName: null, photoPreview: null }" class="space-y-2">
                    <!-- Profile Photo File Input -->
                    <input type="file" class="hidden"
                           wire:model.live="photo"
                           x-ref="photo"
                           x-on:change="
                                photoName = $refs.photo.files[0].name;
                                const reader = new FileReader();
                                reader.onload = (e) => {
                                    photoPreview = e.target.result;
                                };
                                reader.readAsDataURL($refs.photo.files[0]);
                    " />

                    <x-filament-forms::field-wrapper.label for="photo">
                        {{ __('filament-companies::default.labels.photo') }}
                    </x-filament-forms::field-wrapper.label>

                    <!-- Current Profile Photo -->
                    <div x-show="! photoPreview">
                        <x-filament-panels::avatar.user style="height: 5rem; width: 5rem;" />
                    </div>

                    <!-- New Profile Photo Preview -->
                    <template x-if="photoPreview">
                        <img :src="photoPreview" style="height: 5rem; width: 5rem; border-radius: 9999px; object-fit: cover;">
                    </template>

                    <x-filament::button size="sm" x-on:click.prevent="$refs.photo.click()">
                        {{ __('filament-companies::default.buttons.new_photo') }}
                    </x-filament::button>

                    @if ($this->user->profile_photo_path)
                        <x-filament::button size="sm" color="danger" wire:click="deleteProfilePhoto">
                            {{ __('filament-companies::default.buttons.remove_photo') }}
                        </x-filament::button>
                    @endif

                    <x-filament-companies::input-error for="photo" />
                </div>
            @endif

            <!-- Name -->
            <x-filament-forms::field-wrapper id="name" statePath="name" required="required" label="{{ __('filament-companies::default.fields.name') }}">
                <x-filament::input.wrapper class="overflow-hidden">
                    <x-filament::input id="name" type="text" maxLength="255" required="required" wire:model="state.name" autocomplete="name" />
                </x-filament::input.wrapper>
            </x-filament-forms::field-wrapper>

            <!-- Email -->
            <x-filament-forms::field-wrapper id="email" statePath="email" required="required" label="{{ __('filament-companies::default.fields.email') }}">
                <x-filament::input.wrapper class="overflow-hidden">
                    <x-filament::input id="email" type="email" wire:model="state.email" maxLength="255" required="required" autocomplete="username" />
                </x-filament::input.wrapper>
            </x-filament-forms::field-wrapper>

            <div class="text-left">
                <x-filament::button type="submit" wire:target="photo">
                    {{ __('filament-companies::default.buttons.save') }}
                </x-filament::button>
            </div>
        </x-filament-panels::form>
    </x-filament::section>
</x-filament-companies::grid-section>
