<?php

namespace Wallo\FilamentCompanies\Http\Livewire;

use App\Models\User;
use Filament\Notifications\Notification;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use Livewire\Component;
use Livewire\Redirector;
use Livewire\WithFileUploads;
use Wallo\FilamentCompanies\Pages\User\Profile;

class UpdateProfileInformationForm extends Component
{
    use WithFileUploads;

    /**
     * The component's state.
     */
    public array $state = [];

    /**
     * The new avatar for the user.
     */
    public $photo;

    /**
     * Determine if the verification email was sent.
     */
    public bool $verificationLinkSent = false;

    /**
     * Prepare the component.
     */
    public function mount(): void
    {
        $this->state = Auth::user()?->withoutRelations()->toArray();
    }

    /**
     * Update the user's profile information.
     */
    public function updateProfileInformation(UpdatesUserProfileInformation $updater): Redirector|RedirectResponse
    {
        $this->resetErrorBag();

        $updater->update(
            Auth::user(),
            $this->photo
                ? array_merge($this->state, ['photo' => $this->photo])
                : $this->state
        );

        if (isset($this->photo)) {
            $this->profileUpdatedNotification();

            return redirect(Profile::getUrl());
        }

        $this->profileUpdatedNotification();

        $this->emit('refresh-navigation-menu');

        return redirect()->back(303);
    }

    protected function profileUpdatedNotification(): void
    {
        Notification::make()
            ->title('Saved')
            ->success()
            ->body('Profile information updated')
            ->send();
    }

    /**
     * Delete user's profile photo.
     */
    public function deleteProfilePhoto(): void
    {
        Auth::user()?->deleteProfilePhoto();

        $this->emit('refresh-navigation-menu');
    }

    /**
     * Sent the email verification.
     */
    public function sendEmailVerification(): void
    {
        Auth::user()?->sendEmailVerificationNotification();

        $this->verificationLinkSent = true;
    }

    /**
     * Get the current user of the application.
     */
    public function getUserProperty(): User|Authenticatable|null
    {
        return Auth::user();
    }

    /**
     * Render the component.
     */
    public function render(): View
    {
        return view('filament-companies::profile.update-profile-information-form');
    }
}
