<?php

namespace Wallo\FilamentCompanies;

use BadMethodCallException;
use Illuminate\Support\Str;

class Providers
{
    /**
     * Determine if the application has support for the Bitbucket provider.
     */
    public static function hasBitbucket(): bool
    {
        return Socialite::hasBitbucket();
    }

    /**
     * Determine if the application has support for the Facebook provider.
     */
    public static function hasFacebook(): bool
    {
        return Socialite::hasFacebook();
    }

    /**
     * Determine if the application has support for the GitLab provider.
     */
    public static function hasGitlab(): bool
    {
        return Socialite::hasGitlab();
    }

    /**
     * Determine if the application has support for the GitHub provider.
     */
    public static function hasGithub(): bool
    {
        return Socialite::hasGithub();
    }

    /**
     * Determine if the application has support for the Google provider.
     */
    public static function hasGoogle(): bool
    {
        return Socialite::hasGoogle();
    }

    /**
     * Determine if the application has support for the LinkedIn provider.
     */
    public static function hasLinkedIn(): bool
    {
        return Socialite::hasLinkedIn();
    }

    /**
     * Determine if the application has support for the Twitter OAuth 1.0 provider.
     */
    public static function hasTwitterOAuth1(): bool
    {
        return Socialite::hasTwitter();
    }

    /**
     * Determine if the application has support for the Twitter OAuth 2.0 provider.
     */
    public static function hasTwitterOAuth2(): bool
    {
        return Socialite::hasTwitterOAuth2();
    }

    /**
     * Enable the Bitbucket provider.
     */
    public static function bitbucket(): string
    {
        return 'bitbucket';
    }

    /**
     * Enable the Facebook provider.
     */
    public static function facebook(): string
    {
        return 'facebook';
    }

    /**
     * Enable the GitHub provider.
     */
    public static function github(): string
    {
        return 'github';
    }

    /**
     * Enable the GitLab provider.
     */
    public static function gitlab(): string
    {
        return 'gitlab';
    }

    /**
     * Enable the Google provider.
     */
    public static function google(): string
    {
        return 'google';
    }

    /**
     * Enable the LinkedIn provider.
     */
    public static function linkedin(): string
    {
        return 'linkedin';
    }

    /**
     * Enable the Twitter OAuth 1.0 provider.
     */
    public static function twitterOAuth1(): string
    {
        return 'twitter';
    }

    /**
     * Enable the Twitter OAuth 2.0 provider.
     */
    public static function twitterOAuth2(): string
    {
        return 'twitter-oauth-2';
    }

    /**
     * Throw a bad method call exception for the given method.
     *
     * @throws BadMethodCallException
     */
    protected static function throwBadMethodCallException(string $method): void
    {
        throw new BadMethodCallException(sprintf(
            'Call to undefined method %s::%s()', static::class, $method
        ));
    }
}
