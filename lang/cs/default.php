<?php

return [
    'fields' => [
        'code' => 'Kód',
        'current_password' => 'Aktuální heslo',
        'email' => 'E-mail',
        'name' => 'Jméno',
        'password' => 'Heslo',
        'recovery_code' => 'Obnovovací kód',
    ],

    'buttons' => [
        'add' => 'Přidat',
        'cancel' => 'Zrušit',
        'close' => 'Zavřít',
        'connect' => 'Připojit',
        'confirm' => 'Potvrdit',
        'create' => 'Vytvořit',
        'create_token' => 'Vytvořit token',
        'delete' => 'Smazat',
        'delete_account' => 'Smazat účet',
        'delete_company' => 'Smazat společnost',
        'disable' => 'Deaktivovat',
        'done' => 'Hotovo.',
        'edit' => 'Upravit',
        'email_password_reset_link' => 'Odeslat odkaz na resetování hesla e-mailem',
        'enable' => 'Aktivovat',
        'leave' => 'Propustit',
        'login' => 'Přihlásit se',
        'logout' => 'Odhlásit se',
        'logout_browser_sessions' => 'Odhlásit se z ostatních relací v prohlížeči',
        'new_photo' => 'Nová fotografie',
        'permissions' => 'Oprávnění',
        'register' => 'Registrovat se',
        'regenerate_recovery_codes' => 'Znovu generovat obnovovací kódy',
        'remember_me' => 'Zapamatuj si mě',
        'remove' => 'Odstranit',
        'remove_connected_account' => 'Odstranit připojený účet',
        'remove_photo' => 'Odstranit fotografii',
        'reset_password' => 'Resetovat heslo',
        'resend_verification_email' => 'Znovu odeslat ověřovací e-mail',
        'revoke' => 'Zrušit',
        'save' => 'Uložit',
        'show_recovery_codes' => 'Zobrazit obnovovací kódy',
        'use_authentication_code' => 'Použít ověřovací kód',
        'use_avatar_as_profile_photo' => 'Použít profilový obrázek',
        'use_recovery_code' => 'Použít obnovovací kód',
    ],

    'labels' => [
        'company_name' => 'Název společnosti',
        'company_email' => 'E-mail společnosti',
        'company_owner' => 'Vlastník společnosti',
        'entity_type' => 'Typ entity',
        'country' => 'Země',
        'language' => 'Jazyk',
        'currency' => 'Měna',
        'connected' => 'Připojeno',
        'created_at' => 'Vytvořeno',
        'last_active' => 'Naposledy aktivní',
        'last_used' => 'Naposledy použito',
        'last_used_at' => 'Naposledy použito v',
        'new_password' => 'Nové heslo',
        'not_connected' => 'Nepřipojeno.',
        'password_confirmation' => 'Potvrzení hesla',
        'permissions' => 'Oprávnění',
        'photo' => 'Fotografie',
        'role' => 'Role',
        'setup_key' => 'Klíč nastavení',
        'this_device' => 'Toto zařízení',
        'token_name' => 'Název tokenu',
        'unknown' => 'Neznámé',
        'updated_at' => 'Aktualizováno',
    ],

    'links' => [
        'already_registered' => 'Již registrován?',
        'edit_profile' => 'Upravit profil',
        'forgot_your_password' => 'Zapomněli jste heslo?',
        'privacy_policy' => 'Zásady ochrany osobních údajů',
        'register_an_account' => 'Registrovat účet',
        'terms_of_service' => 'Podmínky služby',
    ],

    'errors' => [
        'cannot_leave_company' => 'Nemůžete opustit společnost, kterou jste vytvořili.',
        'company_deletion' => 'Nemůžete smazat svou osobní společnost.',
        'email_already_associated' => 'Účet s touto e-mailovou adresou již existuje. Přihlaste se prosím pro připojení vašeho :Provider účtu.',
        'email_not_found' => 'Nepodařilo se nám najít registrovaného uživatele s touto e-mailovou adresou.',
        'employee_already_belongs_to_company' => 'Tento zaměstnanec již patří do společnosti.',
        'employee_already_invited' => 'Tento zaměstnanec již byl pozván do společnosti.',
        'invalid_password' => 'Zadané heslo je neplatné.',
        'no_email_with_account' => 'S tímto :Provider účtem není spojena žádná e-mailová adresa. Zkuste prosím jiný účet.',
        'password_does_not_match' => 'Zadané heslo neodpovídá vašemu aktuálnímu heslu.',
        'already_associated_account' => 'Účet s tímto :Provider přihlášením již existuje, přihlaste se prosím.',
        'already_connected' => 'Účet s touto e-mailovou adresou již existuje. Přihlaste se prosím pro připojení vašeho :Provider účtu.',
        'signin_not_found' => 'Účet s tímto :Provider přihlášením nebyl nalezen. Registrovat nebo zkuste jiné přihlášení.',
        'user_belongs_to_company' => 'Tento uživatel již patří do společnosti.',
        'valid_role' => ':attribute musí být platná role.',
        'terms' => 'Podmínky služby a Zásady ochrany osobních údajů',
    ],

    'descriptions' => [
        'token_created_state' => 'Vytvořeno před :time_ago uživatelem :user_name.',
        'token_last_used_state' => 'Naposledy použito před :time_ago',
        'token_never_used' => 'Nikdy nepoužito',
        'token_updated_state' => 'Aktualizováno před :time_ago',
    ],

    'banner' => [
        'company_invitation_accepted' => 'Skvělé! Přijali jste pozvání k připojení do **:company**.',
    ],

    'notifications' => [
        'token_created' => [
            'title' => 'Osobní přístupový token vytvořen',
            'body' => 'Nový osobní přístupový token byl vytvořen s názvem **:name**.',
        ],

        'token_updated' => [
            'title' => 'Osobní přístupový token aktualizován',
            'body' => 'Osobní přístupový token byl úspěšně aktualizován.',
        ],

        'browser_sessions_terminated' => [
            'title' => 'Relace prohlížeče ukončeny',
            'body' => 'Váš účet byl z bezpečnostních důvodů odhlášen z jiných relací prohlížeče.',
        ],

        'company_created' => [
            'title' => 'Společnost vytvořena',
            'body' => 'Nová společnost byla vytvořena s názvem **:name**.',
        ],

        'company_deleted' => [
            'title' => 'Společnost smazána',
            'body' => 'Společnost **:name** byla smazána.',
        ],

        'company_invitation_sent' => [
            'title' => 'Pozvánka odeslána',
            'body' => 'Pozvánka byla odeslána na **:email** pro připojení k vaší společnosti.',
        ],

        'company_name_updated' => [
            'title' => 'Společnost aktualizována',
            'body' => 'Název vaší společnosti byl aktualizován na **:name**.',
        ],

        'connected_account_removed' => [
            'title' => 'Připojený účet odstraněn',
            'body' => 'Připojený účet byl úspěšně odstraněn.',
        ],

        'password_set' => [
            'title' => 'Heslo nastaveno',
            'body' => 'Váš účet je nyní chráněn heslem. Stránka se za chvíli automaticky obnoví, aby se aktualizovaly vaše nastavení.',
        ],

        'password_updated' => [
            'title' => 'Heslo aktualizováno',
            'body' => 'Vaše heslo bylo úspěšně aktualizováno.',
        ],

        'profile_information_updated' => [
            'title' => 'Profilové informace aktualizovány',
            'body' => 'Vaše profilové informace byly úspěšně aktualizovány.',
        ],

        'already_associated' => [
            'title' => 'Ups!',
            'body' => 'Tento :Provider přihlašovací účet je již přidružen k vašemu uživateli.',
        ],

        'belongs_to_other_user' => [
            'title' => 'Ups!',
            'body' => 'Tento :Provider přihlašovací účet je již přidružen k jinému uživateli. Zkuste prosím jiný účet.',
        ],

        'successfully_connected' => [
            'title' => 'Úspěch!',
            'body' => 'Úspěšně jste připojili :Provider k vašemu účtu.',
        ],

        'verification_link_sent' => [
            'title' => 'Ověřovací odkaz odeslán',
            'body' => 'Nový ověřovací odkaz byl odeslán na zadanou e-mailovou adresu.',
        ],
    ],

    'navigation' => [
        'headers' => [
            'manage_company' => 'Správa společnost',
            'switch_companies' => 'Přepnout společnost',
        ],

        'links' => [
            'tokens' => 'Osobní přístupové tokeny',
            'company_settings' => 'Nastavení společnosti',
            'create_company' => 'Vytvořit společnost',
        ],
    ],

    'pages' => [
        'titles' => [
            'tokens' => 'Osobní přístupové tokeny',
            'create_company' => 'Vytvořit společnost',
            'company_settings' => 'Nastavení společnosti',
            'profile' => 'Profil',
        ],
    ],

    'grid_section_titles' => [
        'add_company_employee' => 'Přidat zaměstnance společnosti',
        'browser_sessions' => 'Relace prohlížeče',
        'company_name' => 'Název společnosti',
        'create_token' => 'Vytvořit osobní přístupový token',
        'create_company' => 'Vytvořit společnost',
        'delete_account' => 'Smazat účet',
        'profile_information' => 'Profilové informace',
        'set_password' => 'Nastavit heslo',
        'two_factor_authentication' => 'Dvoufaktorové ověřování',
        'update_password' => 'Aktualizovat heslo',
    ],

    'grid_section_descriptions' => [
        'add_company_employee' => 'Přidejte nového zaměstnance společnosti, který bude s vámi spolupracovat.',
        'browser_sessions' => 'Spravujte a odhlašujte své aktivní relace na jiných prohlížečích a zařízeních.',
        'company_name' => 'Název společnosti a informace o vlastníkovi.',
        'create_token' => 'Osobní přístupové tokeny umožňují ověření třetích stran s naší aplikací vaším jménem.',
        'create_company' => 'Vytvořte novou společnost pro spolupráci s ostatními na projektech.',
        'delete_account' => 'Trvale smazat váš účet.',
        'profile_information' => 'Aktualizujte profilové informace a e-mailovou adresu vašeho účtu.',
        'set_password' => 'Zajistěte, aby váš účet používal dlouhé, náhodné heslo pro zajištění bezpečnosti.',
        'two_factor_authentication' => 'Přidejte další zabezpečení vašeho účtu pomocí dvoufaktorového ověřování.',
        'update_password' => 'Zajistěte, aby váš účet používal dlouhé, náhodné heslo pro zajištění bezpečnosti.',
    ],

    'action_section_titles' => [
        'company_employees' => 'Zaměstnanci společnosti',
        'connected_accounts' => 'Připojené účty',
        'delete_company' => 'Smazat společnost',
        'pending_company_invitations' => 'Čekající pozvánky do společnosti',
    ],

    'action_section_descriptions' => [
        'company_employees' => 'Všichni lidé, kteří jsou součástí této společnosti.',
        'connected_accounts' => 'Spravujte a odstraňujte své připojené účty.',
        'delete_company' => 'Trvale smazat tuto společnost.',
        'pending_company_invitations' => 'Tito lidé byli pozváni do vaší společnosti a byli jim zaslány pozvánkové e-maily. Mohou se připojit k společnosti přijetím pozvánky z e-mailu.',
    ],

    'modal_titles' => [
        'token' => 'Osobní přístupový token',
        'token_permissions' => 'Oprávnění osobního přístupového tokenu',
        'confirm_password' => 'Potvrzení hesla',
        'delete_token' => 'Smazat osobní přístupový token',
        'delete_account' => 'Smazat účet',
        'delete_company' => 'Smazat společnost',
        'leave_company' => 'Opustit společnost',
        'logout_browser_sessions' => 'Odhlásit se z ostatních relací prohlížeče',
        'manage_role' => 'Spravovat roli',
        'remove_company_employee' => 'Odstranit zaměstnance společnosti',
        'remove_connected_account' => 'Odstranit připojený účet',
        'revoke_tokens' => 'Zrušit tokeny',
    ],

    'modal_descriptions' => [
        'copy_token' => 'Prosím, zkopírujte svůj nový osobní přístupový token. Pro vaši bezpečnost nebude znovu zobrazen.',
        'confirm_password' => 'Pro vaši bezpečnost prosím potvrďte své heslo pro pokračování.',
        'delete_account' => 'Prosím, zadejte své heslo pro potvrzení, že chcete smazat svůj účet.',
        'delete_token' => 'Opravdu chcete smazat tento osobní přístupový token?',
        'delete_company' => 'Opravdu chcete smazat tuto společnost?',
        'leave_company' => 'Opravdu chcete opustit tuto společnost?',
        'logout_browser_sessions' => 'Prosím, zadejte své heslo pro potvrzení, že chcete odhlásit své ostatní relace v prohlížeči.',
        'remove_company_employee' => 'Opravdu chcete odstranit tuto osobu ze společnosti?',
        'remove_connected_account' => 'Prosím, potvrďte odstranění tohoto účtu - tato akce nemůže být vrácena.',
        'revoke_tokens' => 'Prosím, zadejte své heslo pro potvrzení.',
    ],

    'headings' => [
        'auth' => [
            'confirm_password' => 'Toto je zabezpečená oblast aplikace. Prosím potvrďte své heslo před pokračováním.',
            'forgot_password' => 'Zapomněli jste heslo?',
            'login' => 'Přihlaste se k vašemu účtu',
            'register' => 'Registrovat účet',
            'two_factor_challenge' => [
                'authentication_code' => 'Prosím potvrďte přístup k vašemu účtu zadáním ověřovacího kódu poskytnutého vaší autentizační aplikací.',
                'emergency_recovery_code' => 'Prosím potvrďte přístup k vašemu účtu zadáním jednoho z vašich nouzových obnovovacích kódů.',
            ],
            'verify_email' => [
                'verification_link_not_sent' => 'Před pokračováním, můžete ověřit svou e-mailovou adresu kliknutím na odkaz, který jsme vám právě zaslali? Pokud jste e-mail neobdrželi, rádi vám zašleme nový.',
                'verification_link_sent' => 'Nový ověřovací odkaz byl odeslán na e-mailovou adresu, kterou jste uvedli v nastavení profilu.',
            ],
        ],

        'profile' => [
            'connected_accounts' => [
                'has_connected_accounts' => 'Vaše připojené účty.',
                'no_connected_accounts' => 'Nemáte žádné připojené účty.',
            ],

            'two_factor_authentication' => [
                'enabled' => 'Máte povoleno dvoufaktorové ověřování!',
                'finish_enabling' => 'Dokončete povolení dvoufaktorového ověřování.',
                'not_enabled' => 'Nemáte povoleno dvoufaktorové ověřování.',
            ],

            'update_profile_information' => [
                'verification_link_not_sent' => 'Před aktualizací vašeho e-mailu musíte ověřit aktuální e-mailovou adresu.',
                'verification_link_sent' => 'Nový ověřovací odkaz byl odeslán na váš e-mail.',
            ],
        ],

        'tokens' => [
            'token_manager' => [
                'manage_tokens' => 'Spravovat osobní přístupové tokeny',
            ],
        ],

        'companies' => [
            'company_employee_manager' => [
                'manage_employees' => 'Spravovat zaměstnance',
                'pending_invitations' => 'Čekající pozvánky',
            ],
        ],
    ],

    'subheadings' => [
        'auth' => [
            'forgot_password' => 'Stačí nám sdělit vaši e-mailovou adresu a my vám zašleme odkaz na resetování hesla, který vám umožní zvolit si nové.',
            'login' => 'Nebo',
            'register' => 'Souhlasím s :terms_of_service a :privacy_policy',
        ],

        'profile' => [
            'two_factor_authentication' => [
                'enabled' => 'Dvoufaktorové ověřování je nyní povoleno. Naskenujte následující QR kód pomocí autentizační aplikace vašeho telefonu nebo zadejte klíč nastavení.',
                'finish_enabling' => 'Pro dokončení povolení dvoufaktorového ověřování naskenujte následující QR kód pomocí autentizační aplikace vašeho telefonu nebo zadejte klíč nastavení a poskytněte vygenerovaný OTP kód.',
                'store_codes' => 'Uložte tyto obnovovací kódy do bezpečného správce hesel. Mohou být použity k obnovení přístupu k vašemu účtu, pokud ztratíte vaše dvoufaktorové ověřovací zařízení.',
                'summary' => 'Když je povoleno dvoufaktorové ověřování, budete při přihlašování vyzváni k zadání zabezpečeného, náhodného tokenu. Tento token můžete získat z autentizační aplikace vašeho telefonu.',
            ],

            'connected_accounts' => 'Můžete připojit jakékoliv sociální účty k vašemu profilu a kdykoliv odstranit připojené účty. Pokud máte pocit, že byl některý z vašich připojených účtů kompromitován, měli byste je okamžitě odpojit a změnit heslo.',
            'delete_user' => 'Jakmile je váš účet smazán, všechny jeho zdroje a data budou trvale smazány. Před smazáním účtu si prosím stáhněte všechna data nebo informace, které chcete zachovat.',
            'logout_other_browser_sessions' => 'Pokud je to nutné, můžete se odhlásit ze všech ostatních relací prohlížeče na všech vašich zařízeních. Některé z vašich posledních relací jsou uvedeny níže; tento seznam však nemusí být úplný. Pokud máte pocit, že byl váš účet kompromitován, měli byste také aktualizovat své heslo.',
        ],

        'companies' => [
            'company_employee_manager' => 'Prosím, uveďte e-mailovou adresu osoby, kterou byste chtěli přidat do této společnosti.',
            'delete_company' => 'Jakmile je společnost smazána, všechny její zdroje a data budou trvale smazány. Před smazáním této společnosti si prosím stáhněte všechna data nebo informace o této společnosti, které chcete zachovat.',
        ],
    ],
];
