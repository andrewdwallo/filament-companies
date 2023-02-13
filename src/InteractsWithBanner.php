<?php

namespace Wallo\FilamentCompanies;

trait InteractsWithBanner
{
    /**
     * Update the banner message.
     *
     * @param string $message
     * @return void
     */
    protected function banner(string $message): void
    {
        $this->dispatchBrowserEvent('banner-message', [
            'style' => 'success',
            'message' => $message,
        ]);
    }

    /**
     * Update the banner message with a danger / error message.
     *
     * @param string $message
     * @return void
     */
    protected function dangerBanner(string $message): void
    {
        $this->dispatchBrowserEvent('banner-message', [
            'style' => 'danger',
            'message' => $message,
        ]);
    }
}
