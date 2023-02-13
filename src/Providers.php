<?php

namespace Wallo\FilamentCompanies;

use BadMethodCallException;
use Illuminate\Support\Str;

class Providers
{
    /**
     * Determine if the given provider is enabled.
     *
     * @param  string  $provider
     * @return bool
     */
    public static function enabled(string $provider): bool
    {
        return in_array($provider, config('filament-companies.providers', []), true);
    }

    /**
     * Determine if the application has support for the Bitbucket provider.
     *
     * @return bool
     */
    public static function hasBitbucketSupport(): bool
    {
        return static::enabled(static::bitbucket());
    }

    /**
     * Determine if the application has support for the Facebook provider.
     *
     * @return bool
     */
    public static function hasFacebookSupport(): bool
    {
        return static::enabled(static::facebook());
    }

    /**
     * Determine if the application has support for the GitLab provider.
     *
     * @return bool
     */
    public static function hasGitlabSupport(): bool
    {
        return static::enabled(static::gitlab());
    }

    /**
     * Determine if the application has support for the GitHub provider.
     *
     * @return bool
     */
    public static function hasGithubSupport(): bool
    {
        return static::enabled(static::github());
    }

    /**
     * Determine if the application has support for the Google provider.
     *
     * @return bool
     */
    public static function hasGoogleSupport(): bool
    {
        return static::enabled(static::google());
    }

    /**
     * Determine if the application has support for the LinkedIn provider.
     *
     * @return bool
     */
    public static function hasLinkedInSupport(): bool
    {
        return static::enabled(static::linkedin());
    }

    /**
     * Determine if the application has support for the Twitter provider.
     *
     * @return bool
     */
    public static function hasTwitterSupport(): bool
    {
        return static::enabled(static::twitterOAuth1())
            || static::enabled(static::twitterOAuth2());
    }

    /**
     * Determine if the application has support for the Twitter OAuth 1.0 provider.
     *
     * @return bool
     */
    public static function hasTwitterOAuth1Support(): bool
    {
        return static::enabled(static::twitterOAuth1());
    }

    /**
     * Determine if the application has support for the Twitter OAuth 2.0 provider.
     *
     * @return bool
     */
    public static function hasTwitterOAuth2Support(): bool
    {
        return static::enabled(static::twitterOAuth2());
    }

    /**
     * Enable the Bitbucket provider.
     *
     * @return string
     */
    public static function bitbucket(): string
    {
        return 'bitbucket';
    }

    /**
     * Enable the Facebook provider.
     *
     * @return string
     */
    public static function facebook(): string
    {
        return 'facebook';
    }

    /**
     * Enable the GitHub provider.
     *
     * @return string
     */
    public static function github(): string
    {
        return 'github';
    }

    /**
     * Enable the GitLab provider.
     *
     * @return string
     */
    public static function gitlab(): string
    {
        return 'gitlab';
    }

    /**
     * Enable the Google provider.
     *
     * @return string
     */
    public static function google(): string
    {
        return 'google';
    }

    /**
     * Enable the LinkedIn provider.
     *
     * @return string
     */
    public static function linkedin(): string
    {
        return 'linkedin';
    }

    /**
     * Enable the Twitter provider.
     *
     * @return string
     */
    public static function twitter(): string
    {
        return 'twitter';
    }

    /**
     * Enable the Twitter OAuth 1.0 provider.
     *
     * @return string
     */
    public static function twitterOAuth1(): string
    {
        return 'twitter';
    }

    /**
     * Enable the Twitter OAuth 2.0 provider.
     *
     * @return string
     */
    public static function twitterOAuth2(): string
    {
        return 'twitter-oauth-2';
    }

    /**
     * Dynamically handle static calls.
     *
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public static function __callStatic($name, $arguments)
    {
        // If the method exists on the class, call it. Otherwise, attempt to
        // determine the provider from the method name being called.
        if (method_exists(static::class, $name)) {
            return static::$name(...$arguments);
        }

        /** @example $name = "HasMyCustomProviderSupport" */
        if (preg_match('/^has.*Support$/', $name)) {
            $provider = Str::remove('Support', Str::remove('has', $name));

            return static::enabled(Str::kebab($provider)) || static::enabled(Str::lower($provider));
        }

        static::throwBadMethodCallException($name);
    }

    /**
     * Throw a bad method call exception for the given method.
     *
     * @param string $method
     * @return void
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
