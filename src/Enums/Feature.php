<?php

namespace Wallo\FilamentCompanies\Enums;

use Filament\Support\Contracts\HasLabel;
use Wallo\FilamentCompanies\FilamentCompanies;

enum Feature: string implements HasLabel
{
    case RememberSession = 'remember-session';
    case RefreshOAuthTokens = 'refresh-oauth-tokens';
    case ProviderAvatars = 'provider-avatars';
    case GenerateMissingEmails = 'generate-missing-emails';
    case LoginOnRegistration = 'login-on-registration';
    case CreateAccountOnFirstLogin = 'create-account-on-first-login';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::RememberSession => 'Remember Session',
            self::RefreshOAuthTokens => 'Refresh OAuth Tokens',
            self::ProviderAvatars => 'Provider Avatars',
            self::GenerateMissingEmails => 'Generate Missing Emails',
            self::LoginOnRegistration => 'Login on Registration',
            self::CreateAccountOnFirstLogin => 'Create Account on First Login',
        };
    }

    public function isEnabled(): bool
    {
        return FilamentCompanies::isFeatureEnabled($this);
    }

    public function isDisabled(): bool
    {
        return $this->isEnabled() === false;
    }
}
