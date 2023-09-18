<?php

namespace Wallo\FilamentCompanies\Contracts;

use DateTimeInterface;

interface Credentials
{
    /**
     * Get the ID for the credentials.
     */
    public function getId(): string;

    /**
     * Get token for the credentials.
     */
    public function getToken(): string;

    /**
     * Get the token secret for the credentials.
     */
    public function getTokenSecret(): ?string;

    /**
     * Get the refresh token for the credentials.
     */
    public function getRefreshToken(): ?string;

    /**
     * Get the expiry date for the credentials.
     */
    public function getExpiry(): ?DateTimeInterface;
}
