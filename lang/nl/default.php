<?php

// Repository: filament-companies
// Dutch language file

return [
    'fields' => [
        'code' => 'Code',
        'current_password' => 'Huidig wachtwoord',
        'email' => 'E-mail',
        'name' => 'Naam',
        'password' => 'Wachtwoord',
        'recovery_code' => 'Herstel code',
    ],

    'buttons' => [
        'add' => 'Toevoegen',
        'cancel' => 'Annuleren',
        'close' => 'Sluiten',
        'connect' => 'Verbinden',
        'confirm' => 'Bevestig',
        'create' => 'Aanmaken',
        'create_token' => 'Maak Token aan',
        'delete' => 'Verwijder',
        'delete_account' => 'Verwijder account',
        'delete_company' => 'Verwijder bedrijf',
        'disable' => 'Deactiveren',
        'done' => 'Klaar.',
        'edit' => 'Bewerk',
        'email_password_reset_link' => 'E-mail wachtwoord herstel link',
        'enable' => 'Activeer',
        'leave' => 'Verlaat',
        'login' => 'Inloggen',
        'logout' => 'Uitloggen',
        'logout_browser_sessions' => 'Uitloggen bij andere browser sessies',
        'new_photo' => 'Nieuwe foto',
        'permissions' => 'Rechten',
        'register' => 'Registreren',
        'regenerate_recovery_codes' => 'Hergenereer Herstel codes',
        'remember_me' => 'Onthoud mij',
        'remove' => 'Wissen',
        'remove_connected_account' => 'Verwijder gekoppeld account',
        'remove_photo' => 'Wis foto',
        'reset_password' => 'Reset wachtwoord',
        'resend_verification_email' => 'Verstuur verificatie e-mail opnieuw',
        'revoke' => 'Intrekken',
        'save' => 'Opslaan',
        'show_recovery_codes' => 'Toon Herstel codes',
        'use_authentication_code' => 'Gebruik een authenticatie code',
        'use_avatar_as_profile_photo' => 'Gebruik Avatar',
        'use_recovery_code' => 'Gebruik een herstel code',
    ],

    'labels' => [
        'company_name' => 'Bedrijfsnaam',
        'company_owner' => 'Bedrijf eigenaar',
        'connected' => 'Verbonden',
        'created_at' => 'Aangemaakt op',
        'last_active' => 'Laatst actief',
        'last_used' => 'Laatst gebruikt',
        'last_used_at' => 'Laatst gebruikt op',
        'new_password' => 'Nieuw wachtwoord',
        'not_connected' => 'Niet verbonden.',
        'password_confirmation' => 'Bevestig wachtwoord',
        'permissions' => 'Rechten',
        'photo' => 'Foto',
        'role' => 'Rol',
        'setup_key' => 'Instel sleutel',
        'this_device' => 'Dit apparaat',
        'token_name' => 'Token naam',
        'unknown' => 'Onbekend',
        'updated_at' => 'Gewijzigd op',
    ],

    'links' => [
        'already_registered' => 'Al geregistreerd?',
        'edit_profile' => 'Bewerk profiel',
        'forgot_your_password' => 'Wachtwoord vergeten?',
        'privacy_policy' => 'Privacy beleid',
        'register_an_account' => 'Registreer een account',
        'terms_of_service' => 'Gebruikersvoorwaarden',
    ],

    'errors' => [
        'cannot_leave_company' => 'Je kan het bedrijf niet verlaten, welke jij hebt aangemaakt.',
        'company_deletion' => 'Je kan je eigen persoonlijke bedrijf niet verwijderen.',
        'email_already_associated' => 'Er bestaat al een account met dat e-mailadres. Log in om uw :Provider account te koppelen.',
        'email_not_found' => 'We konden geen geregistreerde gebruiker met dit e-mailadres vinden.',
        'employee_already_belongs_to_company' => 'Deze werknemer behoort al tot het bedrijf.',
        'employee_already_invited' => 'Deze medewerker is al uitgenodigd voor het bedrijf.',
        'invalid_password' => 'Het door jou ingevoerde wachtwoord is ongeldig.',
        'no_email_with_account' => 'Er is geen e-mailadres gekoppeld aan dit :Provider account. Probeer een ander account.',
        'password_does_not_match' => 'Het opgegeven wachtwoord komt niet overeen met jouw huidige wachtwoord.',
        'already_associated_account' => 'Er bestaat al een account waarbij :Provider aanmelding bestaat, log alsjeblieft in.',
        'already_connected' => 'Er bestaat al een account met dat e-mailadres. Log in om jouw :Provider account te koppelen.',
        'signin_not_found' => 'Er is geen account gevonden met deze :Provider aanmelding. Registreer je of probeer een andere inlogmethode.',
        'user_belongs_to_company' => 'Deze gebruiker behoort al tot het bedrijf.',
        'valid_role' => 'Het :attribute moet een geldige rol zijn.',
    ],

    'descriptions' => [
        'token_created_state' => 'Aangemaakt :time_ago door :user_name.',
        'token_last_used_state' => 'Laatst gebruikt :time_ago',
        'token_never_used' => 'Nooit gebruikt',
        'token_updated_state' => 'Gewijzigd :time_ago',
    ],

    'banner' => [
        'company_invitation_accepted' => 'Top! Je bent uitgenodigd om je aan te sluiten bij **:company**.',
    ],

    'notifications' => [
        'token_created' => [
            'title' => 'Persoonlijke toegangstoken aangemaakt',
            'body' => 'Een nieuwe persoonlijke toegangstoken is aangemaakt met de naam **:name**.',
        ],

        'token_updated' => [
            'title' => 'Persoonlijke toegangstoken is aangepast',
            'body' => 'De persoonlijke toegangstoken is succesvol aangepast.',
        ],

        'browser_sessions_terminated' => [
            'title' => 'Browser sessie beëindigd',
            'body' => 'Jouw account is uitgelogd bij andere Browser sessies wegens beveiligingsredenen.',
        ],

        'company_created' => [
            'title' => 'Bedrijf aangemaakt',
            'body' => 'Er is een nieuw bedrijf aangemaakt met de naam **:name**.',
        ],

        'company_deleted' => [
            'title' => 'Bedrijf verwijderd',
            'body' => 'Het bedrijf **:name** is verwijderd.',
        ],

        'company_invitation_sent' => [
            'title' => 'Uitnodiging verzonden',
            'body' => 'Een uitnodiging is verzonden aan **:email** om zich aan te sluiten bij jouw bedrijf.',
        ],

        'company_name_updated' => [
            'title' => 'Bedrijf gewijzigd',
            'body' => 'Jouw bedrijfsnaam is gewijzigd naar **:name**.',
        ],

        'connected_account_removed' => [
            'title' => 'Verbonden account verwijderd',
            'body' => 'Het verbonden account is met success verwijderd.',
        ],

        'password_set' => [
            'title' => 'Wachtwoord ingesteld',
            'body' => 'Jouw account is nu met een wachtwoord beveiligd. De pagina zal automatisch ververst worden om jouw instellingen te wijzigen.',
        ],

        'password_updated' => [
            'title' => 'Wachtwoord gewijzigd',
            'body' => 'Jouw wachtwoord is gewijzigd.',
        ],

        'profile_information_updated' => [
            'title' => 'Profiel informatie gewijzigd',
            'body' => 'Jouw profiel informatie is gewijzigd.',
        ],

        'already_associated' => [
            'title' => 'Oeps!',
            'body' => 'Deze :Provider aanmeld account is al gekoppeld aan een andere gebruiker.',
        ],

        'belongs_to_other_user' => [
            'title' => 'Oeps!',
            'body' => 'Dit :Provider aanmeld account is al gekoppeld met een andere gebruiker. Probeer het met een ander account.',
        ],

        'successfully_connected' => [
            'title' => 'Gelukt!',
            'body' => 'Je hebt :Provider gekoppeld met jouw account.',
        ],

        'verification_link_sent' => [
            'title' => 'Verificatie link verzonden',
            'body' => 'Een nieuwe verificatie link is verzonden aan het opgegeven e-mail adres.',
        ],
    ],

    'navigation' => [
        'headers' => [
            'manage_company' => 'Beheer bedrijf',
            'switch_companies' => 'Wissel van bedrijf',
        ],

        'links' => [
            'tokens' => 'Persoonlijke Toegangstokens',
            'company_settings' => 'Bedrijfsinstellingen',
            'create_company' => 'Bedrijf aanmaken',
        ],
    ],

    'pages' => [
        'titles' => [
            'tokens' => 'Persoonlijke toegangstokens',
            'create_company' => 'Bedrijf aanmaken',
            'company_settings' => 'Bedrijfsinstellingen',
            'profile' => 'Profiel',
        ],
    ],

    'grid_section_titles' => [
        'add_company_employee' => 'Medewerker toevoegen',
        'browser_sessions' => 'Browser Sessies',
        'company_name' => 'Bedrijfsnaam',
        'create_token' => 'Persoonlijke toegangstoken aanmaken',
        'create_company' => 'Bedrijf aanmaken',
        'delete_account' => 'Account verwijderen',
        'profile_information' => 'Profiel informatie',
        'set_password' => 'Wachtwoord instellen',
        'two_factor_authentication' => 'Twee-weg Authenticatie',
        'update_password' => 'Wachtwoord wijzigen',
    ],

    'grid_section_descriptions' => [
        'add_company_employee' => 'Voeg een nieuwe bedrijfsmedewerker toe aan jouw bedrijf, zodat deze met je kan samenwerken.',
        'browser_sessions' => 'Beheer en log jouw actieve sessies uit op andere browsers en apparaten.',
        'company_name' => 'De naam van het bedrijf en informatie over de eigenaar.',
        'create_token' => 'Met persoonlijke toegangstokens kunnen services van derden zich namens jou bij onze applicatie aanmelden.',
        'create_company' => 'Creëer een nieuw bedrijf om met anderen aan projecten samen te werken.',
        'delete_account' => 'Verwijder jouw account definitief.',
        'profile_information' => 'Wijzig jouw account profiel informatie en e-mail adres.',
        'set_password' => 'Zorg ervoor dat jouw account een lang, willekeurig wachtwoord gebruikt om veilig te blijven.',
        'two_factor_authentication' => 'Voeg extra beveiliging toe aan jouw account met behulp van tweefactor authenticatie.',
        'update_password' => 'Zorg ervoor dat jouw account een lang, willekeurig wachtwoord gebruikt om veilig te blijven.',
    ],

    'action_section_titles' => [
        'company_employees' => 'Bedrijf werknemers',
        'connected_accounts' => 'Verbonden accounts',
        'delete_company' => 'Verwijder bedrijf',
        'pending_company_invitations' => 'Bedrijfsuitnodiging(en) in behandeling',
    ],

    'action_section_descriptions' => [
        'company_employees' => 'Al deze personen maken onderdeel uit van dit bedrijf.',
        'connected_accounts' => 'Beheer en verwijder jouw verbonden accounts.',
        'delete_company' => 'Verwijder dit bedrijf definitief.',
        'pending_company_invitations' => 'Deze mensen zijn uitgenodigd voor jouw bedrijf en hebben een uitnodigingsmail ontvangen. Ze kunnen zich bij het bedrijf aansluiten door de e-mailuitnodiging te accepteren.',
    ],

    'modal_titles' => [
        'token' => 'Persoonlijke toegangstoken',
        'token_permissions' => 'Persoonlijke toegangstoken rechten',
        'confirm_password' => 'Bevestig wachtwoord',
        'delete_token' => 'Verwijder persoonlijke toegangstoken',
        'delete_account' => 'Verwijder account',
        'delete_company' => 'Verwijder bedrijf',
        'leave_company' => 'Verlaat bedrijf',
        'logout_browser_sessions' => 'Uitloggen op andere Browser sessies',
        'manage_role' => 'Beheer rol',
        'remove_company_employee' => 'Verwijder bedrijfswerknemers',
        'remove_connected_account' => 'Verwijder verbonden account',
        'revoke_tokens' => 'Tokens intrekken',
    ],

    'modal_descriptions' => [
        'copy_token' => 'Kopieer jouw nieuwe persoonlijke toegangstoken. Voor jouw veiligheid wordt deze niet meer weergegeven.',
        'confirm_password' => 'Bevestig voor jouw veiligheid je wachtwoord om door te gaan.',
        'delete_account' => 'Voer jouw wachtwoord in om te bevestigen dat je jouw account wilt verwijderen.',
        'delete_token' => 'Weet je het zeker dat je deze persoonlijke toegangstoken wilt verwijderen?',
        'delete_company' => 'Weet je zeker dat je dit bedrijf wilt verwijderen?',
        'leave_company' => 'Weet je zeker dat je dit bedrijf wilt verlaten?',
        'logout_browser_sessions' => 'Geef je wachtwoord in om te bevestigen dat jezelf wilt afmelden bij jouw andere browsersessies.',
        'remove_company_employee' => 'Weet je het zeker dat je deze persoon wilt verwijderen uit het bedrijf?',
        'remove_connected_account' => 'Bevestig de verwijdering van dit account. Deze actie kan niet ongedaan gemaakt worden.',
        'revoke_tokens' => 'Voer jouw wachtwoord in om te bevestigen.',
    ],

    'headings' => [
        'auth' => [
            'confirm_password' => 'Dit is een beveiligd gedeelte van de applicatie. Bevestig je wachtwoord voordat je verdergaat.',
            'forgot_password' => 'Wachtwoord vergeten?',
            'login' => 'Log in bij jouw account',
            'register' => 'Registreer een account',
            'two_factor_challenge' => [
                'authentication_code' => 'Bevestig de toegang tot je account door de authenticatiecode in te voeren die je bij jouw authenticatie toepassing hebt ontvangen.',
                'emergency_recovery_code' => 'Bevestig de toegang tot je account door een van je noodherstelcodes in te voeren.',
            ],
            'verify_email' => [
                'verification_link_not_sent' => 'Kan je, voordat je verdergaat, jouw e-mailadres verifiëren door op de link te klikken die we zojuist naar je hebben gemaild? Mocht je de e-mail niet hebben ontvangen, dan sturen wij jou graag een nieuwe toe.',
                'verification_link_sent' => 'Er is een nieuwe verificatielink verzonden naar het e-mailadres dat je in jouw profiel instellingen heeft opgegeven.',
            ],
        ],

        'profile' => [
            'connected_accounts' => [
                'has_connected_accounts' => 'Je gekoppelde accounts.',
                'no_connected_accounts' => 'Je hebt geen verbonden accounts.',
            ],

            'two_factor_authentication' => [
                'enabled' => 'Je hebt tweefactor authenticatie ingeschakeld!',
                'finish_enabling' => 'Voltooi het inschakelen van tweefactor authenticatie.',
                'not_enabled' => 'Je hebt tweefactor authenticatie niet ingeschakeld.',
            ],

            'update_profile_information' => [
                'verification_link_not_sent' => 'Voordat je e-mailadres kan worden bijgewerkt, moet je je huidige e-mailadres verifiëren.',
                'verification_link_sent' => 'Een nieuwe verificatielink is naar je e-mailadres verzonden.',
            ],
        ],

        'tokens' => [
            'token_manager' => [
                'manage_tokens' => 'Beheer Persoonlijke toegangstokens',
            ],
        ],

        'companies' => [
            'company_employee_manager' => [
                'manage_employees' => 'Beheer medewerkers',
                'pending_invitations' => 'Openstaande uitnodigingen',
            ],
        ],
    ],

    'subheadings' => [
        'auth' => [
            'forgot_password' => 'Laat ons je e-mailadres weten en wij sturen je een link voor het opnieuw instellen van jouw wachtwoord, waarmee je een nieuw wachtwoord kan kiezen.',
            'login' => 'Of',
            'register' => 'Ik ga akkoord met de :terms_of_service en :privacy_policy',
        ],

        'profile' => [
            'two_factor_authentication' => [
                'enabled' => 'Tweefactor authenticatie is nu ingeschakeld. Scan de volgende QR-code met de authenticatie applicatie van je telefoon of voer de installatiesleutel in.',
                'finish_enabling' => 'Om het inschakelen van tweefactor authenticatie te voltooien, scan je de volgende QR-code met de authenticatie toepassing van je telefoon of voer de installatie sleutel in en geef je de gegenereerde OTP-code op.',
                'store_codes' => 'Bewaar deze herstelcodes in een veilige wachtwoord beheerder. Ze kunnen worden gebruikt om de toegang tot je account te herstellen als jouw apparaat voor tweefactor authenticatie verloren is gegaan.',
                'summary' => 'Wanneer tweefactor authenticatie is ingeschakeld, wordt je tijdens de authenticatie om een veilig, willekeurig token gevraagd. Je kan dit token ophalen via de Google Authenticator applicatie van jouw telefoon.',
            ],

            'connected_accounts' => 'Het staat je vrij om social accounts aan je profiel te koppelen en je kunt op elk gewenst moment alle gekoppelde accounts verwijderen. Als je denkt dat een van je verbonden accounts is gehackt, moet je deze onmiddellijk ontkoppelen en je wachtwoord wijzigen.',
            'delete_user' => 'Zodra je account is verwijderd, worden alle bronnen en gegevens permanent verwijderd. Voordat je jouw account verwijdert, download dan eerst alle gegevens of informatie die je wil behouden.',
            'logout_other_browser_sessions' => 'Indien nodig kan je jezelf afmelden bij al jouw andere browsersessies op al jouw apparaten. Enkele van jouw recente sessies vindt je hieronder; Deze lijst is echter mogelijk niet volledig. Als je denkt dat jouw account is gehackt, moet je ook jouw wachtwoord bijwerken.',
        ],

        'companies' => [
            'company_employee_manager' => 'Vul het e-mailadres in van de persoon die je aan dit bedrijf wil toevoegen.',
            'delete_company' => 'Zodra een bedrijf wordt verwijderd, worden alle bronnen en gegevens permanent verwijderd. Voordat je dit bedrijf verwijdert, downloadt dan alle gegevens of informatie over dit bedrijf die je wilt behouden.',
        ],
    ],
];
