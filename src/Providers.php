<?php

namespace Wallo\FilamentCompanies;

class Providers
{
    /**
     * Determine if the application has support for the Bitbucket provider.
     */
    public static function hasBitbucket(): bool
    {
        return Socialite::$supportedSocialiteProviders['bitbucket'];
    }

    /**
     * Determine if the application has support for the Facebook provider.
     */
    public static function hasFacebook(): bool
    {
        return Socialite::$supportedSocialiteProviders['facebook'];
    }

    /**
     * Determine if the application has support for the GitLab provider.
     */
    public static function hasGitlab(): bool
    {
        return Socialite::$supportedSocialiteProviders['gitlab'];
    }

    /**
     * Determine if the application has support for the GitHub provider.
     */
    public static function hasGithub(): bool
    {
        return Socialite::$supportedSocialiteProviders['github'];
    }

    /**
     * Determine if the application has support for the Google provider.
     */
    public static function hasGoogle(): bool
    {
        return Socialite::$supportedSocialiteProviders['google'];
    }

    /**
     * Determine if the application has support for the LinkedIn provider.
     */
    public static function hasLinkedIn(): bool
    {
        return Socialite::$supportedSocialiteProviders['linkedin'];
    }

    /**
     * Determine if the application has support for the Twitter OAuth 1.0 provider.
     */
    public static function hasTwitter(): bool
    {
        return Socialite::$supportedSocialiteProviders['twitter'];
    }

    /**
     * Determine if the application has support for the Twitter OAuth 2.0 provider.
     */
    public static function hasTwitterOAuth2(): bool
    {
        return Socialite::$supportedSocialiteProviders['twitter-oauth-2'];
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
    public static function twitter(): string
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
}
