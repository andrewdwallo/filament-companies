<?php

namespace Wallo\FilamentCompanies\Http\Livewire;

use DeviceDetector\DeviceDetector;
use Filament\Notifications\Notification;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class LogoutOtherBrowserSessionsForm extends Component
{
    /**
     * Indicates if logout is being confirmed.
     */
    public bool $confirmingLogout = false;

    /**
     * The user's current password.
     */
    public string $password = '';

    /**
     * Confirm that the user would like to log out from other browser sessions.
     */
    public function confirmLogout(): void
    {
        $this->password = '';

        $this->dispatchBrowserEvent('confirming-logout-other-browser-sessions');

        $this->confirmingLogout = true;
    }

    /**
     * Log out from other browser sessions.
     *
     * @throws AuthenticationException
     */
    public function logoutOtherBrowserSessions(StatefulGuard $guard): void
    {
        if (config('session.driver') !== 'database') {
            return;
        }

        $this->resetErrorBag();

        if (! Hash::check($this->password, Auth::user()->password)) {
            throw ValidationException::withMessages([
                'password' => [__('filament-companies::default.errors.invalid_password')],
            ]);
        }

        $guard->logoutOtherDevices($this->password);

        $this->deleteOtherSessionRecords();

        session()->put([
            'password_hash_'.Auth::getDefaultDriver() => Auth::user()?->getAuthPassword(),
        ]);

        $this->confirmingLogout = false;

        $this->browserSessionsTerminated();
    }

    /**
     * Delete the other browser session records from storage.
     */
    protected function deleteOtherSessionRecords(): void
    {
        if (config('session.driver') !== 'database') {
            return;
        }

        DB::connection(config('session.connection'))->table(config('session.table', 'sessions'))
            ->where('user_id', Auth::user()?->getAuthIdentifier())
            ->where('id', '!=', session()->getId())
            ->delete();
    }

    /**
     * Get the current sessions.
     */
    public function getSessionsProperty(): Collection
    {
        if (config('session.driver') !== 'database') {
            return collect();
        }

        return collect(
            DB::connection(config('session.connection'))->table(config('session.table', 'sessions'))
                ->where('user_id', Auth::user()?->getAuthIdentifier())
                ->orderBy('last_activity', 'desc')
                ->get()
        )->map(function ($session) {
            $deviceDetector = $this->createAgent($session);

            return (object) [
                'device' => $deviceDetector->getDeviceName(),
                'client_name' => $deviceDetector->getClient('name'),
                'os_name' => $deviceDetector->getOs('name'),
                'os_version' => $deviceDetector->getOs('version'),
                'ip_address' => $session->ip_address,
                'is_current_device' => $session->id === session()->getId(),
                'last_active' => Carbon::createFromTimestamp($session->last_activity)->diffForHumans(),
            ];
        });
    }

    /**
     * Create a new agent instance from the given session.
     */
    protected function createAgent(mixed $session): DeviceDetector
    {
        $deviceDetector = new DeviceDetector($session->user_agent);
        $deviceDetector->parse();

        return $deviceDetector;
    }

    /**
     * Render the component.
     */
    public function render(): View
    {
        return view('filament-companies::profile.logout-other-browser-sessions-form');
    }

    public function browserSessionsTerminated(): void
    {
        Notification::make()
            ->title(__('filament-companies::default.notifications.browser_sessions_terminated.title'))
            ->success()
            ->body(__('filament-companies::default.notifications.browser_sessions_terminated.body'))
            ->send();
    }
}
