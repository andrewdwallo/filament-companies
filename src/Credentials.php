<?php

namespace Wallo\FilamentCompanies;

use DateTime;
use DateTimeInterface;
use Exception;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use JsonException;
use JsonSerializable;
use Wallo\FilamentCompanies\Contracts\Credentials as CredentialsContract;

class Credentials implements CredentialsContract, Arrayable, Jsonable, JsonSerializable
{
    /**
     * The credentials user ID.
     */
    protected string $id;

    /**
     * The credentials token.
     */
    protected string $token;

    /**
     * The credentials token secret.
     */
    protected string|null $tokenSecret = null;

    /**
     * The credentials refresh token.
     */
    protected string|null $refreshToken = null;

    /**
     * The credentials' expiry.
     */
    protected DateTimeInterface|null $expiry = null;

    /**
     * Create a new credentials instance.
     */
    public function __construct(ConnectedAccount $connectedAccount)
    {
        $this->id = $connectedAccount->provider_id;
        $this->token = $connectedAccount->token;
        $this->tokenSecret = $connectedAccount->secret;
        $this->refreshToken = $connectedAccount->refresh_token;
        $this->expiry = $connectedAccount->expires_at;
    }

    /**
     * Get the ID for the credentials.
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Get token for the credentials.
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * Get the token secret for the credentials.
     */
    public function getTokenSecret(): string|null
    {
        return $this->tokenSecret;
    }

    /**
     * Get the refresh token for the credentials.
     */
    public function getRefreshToken(): string|null
    {
        return $this->refreshToken;
    }

    /**
     * Get the expiry date for the credentials.
     *
     * @throws Exception
     */
    public function getExpiry(): DateTimeInterface|null
    {
        if ($this->expiry === null) {
            return null;
        }

        return new DateTime($this->expiry);
    }

    /**
     * Get the instance as an array.
     *
     * @return array<string,mixed>
     *
     * @throws Exception
     */
    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'token' => $this->getToken(),
            'token_secret' => $this->getTokenSecret(),
            'refresh_token' => $this->getRefreshToken(),
            'expiry' => $this->getExpiry(),
        ];
    }

    /**
     * Convert the object to its JSON representation.
     *
     * @param int $options
     *
     * @throws Exception
     */
    public function toJson($options = 0): string
    {
        return json_encode($this->toArray(), JSON_THROW_ON_ERROR | $options);
    }

    /**
     * Specify data which should be serialized to JSON.
     *
     * @return array<string, mixed>
     *
     * @throws Exception
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    /**
     * Convert the object instance to a string.
     *
     * @throws JsonException
     *
     * @throws Exception
     */
    public function __toString(): string
    {
        return json_encode($this->toJson(), JSON_THROW_ON_ERROR);
    }
}
