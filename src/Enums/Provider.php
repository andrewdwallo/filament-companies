<?php

namespace Wallo\FilamentTenants\Enums;

use Filament\Support\Contracts\HasLabel;
use Illuminate\Contracts\View\View;
use Wallo\FilamentTenants\FilamentTenants;

enum Provider: string implements HasLabel
{
    case Bitbucket = 'bitbucket';
    case Facebook = 'facebook';
    case Gitlab = 'gitlab';
    case Github = 'github';
    case Google = 'google';
    case LinkedIn = 'linkedin';
    case LinkedInOpenId = 'linkedin-openid';
    case Slack = 'slack';
    case Twitter = 'twitter';
    case TwitterOAuth2 = 'twitter-oauth-2';

    public function getLabel(): string
    {
        return match ($this) {
            self::Bitbucket => 'Bitbucket',
            self::Facebook => 'Facebook',
            self::Gitlab => 'GitLab',
            self::Github => 'GitHub',
            self::Google => 'Google',
            self::LinkedIn, self::LinkedInOpenId => 'LinkedIn',
            self::Slack => 'Slack',
            self::Twitter, self::TwitterOAuth2 => 'X',
        };
    }

    public function isEnabled(): bool
    {
        return FilamentTenants::isProviderEnabled($this);
    }

    public function getIconView(): View
    {
        $viewName = match ($this) {
            self::Bitbucket => 'filament-tenants::components.socialite-icons.bitbucket',
            self::Facebook => 'filament-tenants::components.socialite-icons.facebook',
            self::Gitlab => 'filament-tenants::components.socialite-icons.gitlab',
            self::Github => 'filament-tenants::components.socialite-icons.github',
            self::Google => 'filament-tenants::components.socialite-icons.google',
            self::LinkedIn, self::LinkedInOpenId => 'filament-tenants::components.socialite-icons.linkedin',
            self::Slack => 'filament-tenants::components.socialite-icons.slack',
            self::Twitter, self::TwitterOAuth2 => 'filament-tenants::components.socialite-icons.twitter',
        };

        return view($viewName);
    }
}
