<?php

namespace Wallo\FilamentCompanies;

use DateTime;
use DateTimeInterface;
use Exception;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use ReturnTypeWillChange;
use Wallo\FilamentCompanies\Contracts\Credentials as CredentialsContract;
use JsonSerializable;

class Credentials implements CredentialsContract, Arrayable, Jsonable, JsonSerializable
{
    /**
     * The credentials user ID.
     *
     * @var string
     */
    protected mixed $id;

    /**
     * The credentials token.
     *
     * @var string
     */
    protected mixed $token;

    /**
     * The credentials token secret.
     *
     * @var string|null
     */
    protected mixed $tokenSecret;

    /**
     * The credentials refresh token.
     *
     * @var string|null
     */
    protected mixed $refreshToken;

    /**
     * The credentials' expiry.
     *
     * @var DateTimeInterface|null
     */
    protected mixed $expiry;

    /**
     * Create a new credentials instance.
     *
     * @param ConnectedAccount $connectedAccount
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
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Get token for the credentials.
     *
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * Get the token secret for the credentials.
     *
     * @return string|null
     */
    public function getTokenSecret(): ?string
    {
        return $this->tokenSecret;
    }

    /**
     * Get the refresh token for the credentials.
     *
     * @return string|null
     */
    public function getRefreshToken(): ?string
    {
        return $this->refreshToken;
    }

    /**
     * Get the expiry date for the credentials.
     *
     * @return DateTime|DateTimeInterface|null
     * @throws Exception
     */
    public function getExpiry(): DateTime|DateTimeInterface|null
    {
        if (is_null($this->expiry)) {
            return null;
        }

        return new DateTime($this->expiry);
    }

    /**
     * Get the instance as an array.
     *
     * @return array
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
     * @return array|string
     * @throws Exception
     */
    public function toJson($options = 0): array|string
    {
        return $this->toArray();
    }

    /**
     * Specify data which should be serialized to JSON.
     *
     * @return array
     * @throws Exception
     */
    #[ReturnTypeWillChange] public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    /**
     * Convert the object instance to a string.
     *
     * @return string
     * @throws Exception
     */
    public function __toString(): string
    {
        return json_encode($this->toJson(), JSON_THROW_ON_ERROR);
    }
}
