<?php

return [
    'fields' => [
        'code' => 'Code',
        'current_password' => 'Aktuelles Passwort',
        'email' => 'E-Mail',
        'name' => 'Name',
        'password' => 'Passwort',
        'recovery_code' => 'Wiederherstellungscode',
    ],

    'buttons' => [
        'add' => 'Hinzufügen',
        'cancel' => 'Abbrechen',
        'close' => 'Schließen',
        'connect' => 'Verbinden',
        'confirm' => 'Bestätigen',
        'create' => 'Erstellen',
        'create_token' => 'Token erstellen',
        'delete' => 'Löschen',
        'delete_account' => 'Konto löschen',
        'delete_tenant' => 'Firma löschen',
        'disable' => 'Deaktivieren',
        'done' => 'Fertig.',
        'edit' => 'Bearbeiten',
        'email_password_reset_link' => 'Link zum Zurücksetzen des Passworts senden',
        'enable' => 'Aktivieren',
        'leave' => 'Verlassen',
        'login' => 'Anmelden',
        'logout' => 'Abmelden',
        'logout_browser_sessions' => 'Andere Browsersitzungen abmelden',
        'no_browser_sessions' => 'Keine Browsersitzungen',
        'new_photo' => 'Neues Foto',
        'permissions' => 'Berechtigungen',
        'register' => 'Registrieren',
        'regenerate_recovery_codes' => 'Wiederherstellungscodes neu generieren',
        'remember_me' => 'Angemeldet bleiben',
        'remove' => 'Entfernen',
        'remove_connected_account' => 'Verbundenes Konto entfernen',
        'remove_photo' => 'Foto entfernen',
        'reset_password' => 'Passwort zurücksetzen',
        'resend_verification_email' => 'Bestätigungs-E-Mail erneut senden',
        'revoke' => 'Widerrufen',
        'save' => 'Speichern',
        'show_recovery_codes' => 'Wiederherstellungscodes anzeigen',
        'use_authentication_code' => 'Authentifizierungscode verwenden',
        'use_avatar_as_profile_photo' => 'Avatar verwenden',
        'use_recovery_code' => 'Wiederherstellungscode verwenden',
    ],

    'labels' => [
        'tenant_name' => 'Firmenname',
        'tenant_owner' => 'Firmeninhaber',
        'connected' => 'Verbunden',
        'created_at' => 'Erstellt am',
        'last_active' => 'Zuletzt aktiv',
        'last_used' => 'Zuletzt verwendet',
        'last_used_at' => 'Zuletzt verwendet am',
        'new_password' => 'Neues Passwort',
        'not_connected' => 'Nicht verbunden.',
        'password_confirmation' => 'Passwort bestätigen',
        'permissions' => 'Berechtigungen',
        'photo' => 'Foto',
        'role' => 'Rolle',
        'setup_key' => 'Einrichtungsschlüssel',
        'this_device' => 'Dieses Gerät',
        'token_name' => 'Token-Name',
        'unknown' => 'Unbekannt',
        'updated_at' => 'Aktualisiert am',
    ],

    'links' => [
        'already_registered' => 'Bereits registriert?',
        'edit_profile' => 'Profil bearbeiten',
        'forgot_your_password' => 'Passwort vergessen?',
        'privacy_policy' => 'Datenschutzbestimmungen',
        'register_an_account' => 'Ein Konto registrieren',
        'terms_of_service' => 'Nutzungsbedingungen',
    ],

    'errors' => [
        'cannot_leave_tenant' => 'Sie können eine Firma, die Sie erstellt haben, nicht verlassen.',
        'tenant_deletion' => 'Ihre persönliche Firma kann nicht gelöscht werden.',
        'email_already_associated' => 'Ein Konto mit dieser E-Mail-Adresse existiert bereits. Bitte melden Sie sich an, um Ihr :Provider Konto zu verbinden.',
        'email_not_found' => 'Wir konnten keinen registrierten Benutzer mit dieser E-Mail-Adresse finden.',
        'employee_already_belongs_to_tenant' => 'Dieser Mitarbeiter gehört bereits zur Firma.',
        'employee_already_invited' => 'Dieser Mitarbeiter wurde bereits zur Firma eingeladen.',
        'invalid_password' => 'Das eingegebene Passwort ist ungültig.',
        'no_email_with_account' => 'Diesem :Provider Konto ist keine E-Mail-Adresse zugeordnet. Bitte versuchen Sie es mit einem anderen Konto.',
        'password_does_not_match' => 'Das angegebene Passwort stimmt nicht mit Ihrem aktuellen Passwort überein.',
        'already_associated_account' => 'Ein Konto mit dieser :Provider Anmeldung existiert bereits, bitte melden Sie sich an.',
        'already_connected' => 'Ein Konto mit dieser E-Mail-Adresse existiert bereits. Bitte melden Sie sich an, um Ihr :Provider Konto zu verbinden.',
        'signin_not_found' => 'Ein Konto mit dieser :Provider Anmeldung wurde nicht gefunden. Bitte registrieren Sie sich oder versuchen Sie eine andere Anmeldemethode.',
        'user_belongs_to_tenant' => 'Dieser Benutzer gehört bereits zur Firma.',
        'valid_role' => 'Die :attribute muss eine gültige Rolle sein.',
    ],

    'descriptions' => [
        'token_created_state' => 'Erstellt vor :time_ago von :user_name.',
        'token_last_used_state' => 'Zuletzt verwendet vor :time_ago',
        'token_never_used' => 'Nie verwendet',
        'token_updated_state' => 'Aktualisiert vor :time_ago',
    ],

    'banner' => [
        'tenant_invitation_accepted' => 'Super! Sie haben die Einladung angenommen, **:tenant** beizutreten.',
    ],

    'notifications' => [
        'token_created' => [
            'title' => 'Persönlicher Zugangstoken erstellt',
            'body' => 'Ein neuer persönlicher Zugangstoken wurde mit dem Namen **:name** erstellt.',
        ],

        'token_updated' => [
            'title' => 'Persönlicher Zugangstoken aktualisiert',
            'body' => 'Der persönliche Zugangstoken wurde erfolgreich aktualisiert.',
        ],

        'browser_sessions_terminated' => [
            'title' => 'Browsersitzungen beendet',
            'body' => 'Ihr Konto wurde aus Sicherheitsgründen von anderen Browsersitzungen abgemeldet.',
        ],

        'tenant_created' => [
            'title' => 'Firma erstellt',
            'body' => 'Eine neue Firma wurde mit dem Namen **:name** erstellt.',
        ],

        'tenant_deleted' => [
            'title' => 'Firma gelöscht',
            'body' => 'Die Firma **:name** wurde gelöscht.',
        ],

        'tenant_invitation_sent' => [
            'title' => 'Einladung gesendet',
            'body' => 'Eine Einladung wurde an **:email** gesendet, um Ihrer Firma beizutreten.',
        ],

        'tenant_name_updated' => [
            'title' => 'Firma aktualisiert',
            'body' => 'Der Name Ihrer Firma wurde zu **:name** aktualisiert.',
        ],

        'connected_account_removed' => [
            'title' => 'Verbundenes Konto entfernt',
            'body' => 'Das verbundene Konto wurde erfolgreich entfernt.',
        ],

        'password_set' => [
            'title' => 'Passwort festgelegt',
            'body' => 'Ihr Konto ist jetzt durch ein Passwort geschützt. Die Seite wird in einem Moment automatisch aktualisiert, um Ihre Einstellungen zu aktualisieren.',
        ],

        'password_updated' => [
            'title' => 'Passwort aktualisiert',
            'body' => 'Ihr Passwort wurde erfolgreich aktualisiert.',
        ],

        'profile_information_updated' => [
            'title' => 'Profilinformationen aktualisiert',
            'body' => 'Ihre Profilinformationen wurden erfolgreich aktualisiert.',
        ],

        'already_associated' => [
            'title' => 'Ups!',
            'body' => 'Dieses :Provider Anmeldekonto ist bereits mit Ihrem Benutzer verknüpft.',
        ],

        'belongs_to_other_user' => [
            'title' => 'Ups!',
            'body' => 'Dieses :Provider Anmeldekonto ist bereits mit einem anderen Benutzer verknüpft. Bitte versuchen Sie es mit einem anderen Konto.',
        ],

        'successfully_connected' => [
            'title' => 'Erfolg!',
            'body' => 'Sie haben :Provider erfolgreich mit Ihrem Konto verbunden.',
        ],

        'verification_link_sent' => [
            'title' => 'Bestätigungslink gesendet',
            'body' => 'Ein neuer Bestätigungslink wurde an die angegebene E-Mail-Adresse gesendet.',
        ],
    ],

    'navigation' => [
        'headers' => [
            'manage_tenant' => 'Firma verwalten',
            'switch_tenants' => 'Firmen wechseln',
        ],

        'links' => [
            'tokens' => 'Persönliche Zugangstokens',
            'tenant_settings' => 'Firmeneinstellungen',
            'create_tenant' => 'Firma erstellen',
        ],
    ],

    'pages' => [
        'titles' => [
            'tokens' => 'Persönliche Zugangstokens',
            'create_tenant' => 'Firma erstellen',
            'tenant_settings' => 'Firmeneinstellungen',
            'profile' => 'Profil',
        ],
    ],

    'grid_section_titles' => [
        'add_tenant_employee' => 'Firmenmitarbeiter hinzufügen',
        'browser_sessions' => 'Browsersitzungen',
        'tenant_name' => 'Firmenname',
        'create_token' => 'Persönlichen Zugangstoken erstellen',
        'create_tenant' => 'Firma erstellen',
        'delete_account' => 'Konto löschen',
        'profile_information' => 'Profilinformation',
        'set_password' => 'Passwort setzen',
        'two_factor_authentication' => 'Zwei-Faktor-Authentifizierung',
        'update_password' => 'Passwort aktualisieren',
    ],

    'grid_section_descriptions' => [
        'add_tenant_employee' => 'Fügen Sie einen neuen Firmenmitarbeiter zu Ihrer Firma hinzu, damit er mit Ihnen zusammenarbeiten kann.',
        'browser_sessions' => 'Verwalten und melden Sie sich von Ihren aktiven Sitzungen auf anderen Browsern und Geräten ab.',
        'tenant_name' => 'Der Name der Firma und Informationen zum Inhaber.',
        'create_token' => 'Persönliche Zugangstokens erlauben es Drittanbieterdiensten, sich in Ihrem Namen bei unserer Anwendung zu authentifizieren.',
        'create_tenant' => 'Erstellen Sie eine neue Firma, um mit anderen an Projekten zusammenzuarbeiten.',
        'delete_account' => 'Ihr Konto dauerhaft löschen.',
        'profile_information' => 'Aktualisieren Sie die Profilinformationen und E-Mail-Adresse Ihres Kontos.',
        'set_password' => 'Stellen Sie sicher, dass Ihr Konto mit einem langen, zufälligen Passwort gesichert ist.',
        'two_factor_authentication' => 'Fügen Sie Ihrem Konto zusätzliche Sicherheit hinzu, indem Sie die Zwei-Faktor-Authentifizierung verwenden.',
        'update_password' => 'Stellen Sie sicher, dass Ihr Konto mit einem langen, zufälligen Passwort gesichert ist.',
    ],

    'action_section_titles' => [
        'tenant_employees' => 'Firmenmitarbeiter',
        'connected_accounts' => 'Verbundene Konten',
        'delete_tenant' => 'Firma löschen',
        'pending_tenant_invitations' => 'Ausstehende Firmeneinladungen',
    ],

    'action_section_descriptions' => [
        'tenant_employees' => 'Alle Personen, die Teil dieser Firma sind.',
        'connected_accounts' => 'Verwalten und entfernen Sie Ihre verbundenen Konten.',
        'delete_tenant' => 'Diese Firma dauerhaft löschen.',
        'pending_tenant_invitations' => 'Diese Personen wurden zu Ihrer Firma eingeladen und haben eine Einladungs-E-Mail erhalten. Sie können der Firma beitreten, indem sie die Einladung per E-Mail annehmen.',
    ],

    'modal_titles' => [
        'token' => 'Persönlicher Zugangstoken',
        'token_permissions' => 'Berechtigungen für persönlichen Zugangstoken',
        'confirm_password' => 'Passwort bestätigen',
        'delete_token' => 'Persönlichen Zugangstoken löschen',
        'delete_account' => 'Konto löschen',
        'delete_tenant' => 'Firma löschen',
        'leave_tenant' => 'Firma verlassen',
        'logout_browser_sessions' => 'Andere Browsersitzungen abmelden',
        'manage_role' => 'Rolle verwalten',
        'remove_tenant_employee' => 'Firmenmitarbeiter entfernen',
        'remove_connected_account' => 'Verbundenes Konto entfernen',
        'revoke_tokens' => 'Tokens widerrufen',
    ],
    'modal_descriptions' => [
        'copy_token' => 'Bitte kopieren Sie Ihren neuen persönlichen Zugangstoken. Aus Sicherheitsgründen wird er nicht noch einmal angezeigt.',
        'confirm_password' => 'Bitte bestätigen Sie aus Sicherheitsgründen Ihr Passwort, um fortzufahren.',
        'delete_account' => 'Bitte geben Sie Ihr Passwort ein, um die Löschung Ihres Kontos zu bestätigen.',
        'delete_token' => 'Sind Sie sicher, dass Sie diesen persönlichen Zugangstoken löschen möchten?',
        'delete_tenant' => 'Sind Sie sicher, dass Sie diese Firma löschen möchten?',
        'leave_tenant' => 'Sind Sie sicher, dass Sie diese Firma verlassen möchten?',
        'logout_browser_sessions' => 'Bitte geben Sie Ihr Passwort ein, um zu bestätigen, dass Sie sich von Ihren anderen Browsersitzungen abmelden möchten.',
        'remove_tenant_employee' => 'Sind Sie sicher, dass Sie diese Person aus der Firma entfernen möchten?',
        'remove_connected_account' => 'Bitte bestätigen Sie die Entfernung dieses Kontos - diese Aktion kann nicht rückgängig gemacht werden.',
        'revoke_tokens' => 'Bitte geben Sie Ihr Passwort ein, um zu bestätigen.',
    ],

    'headings' => [
        'auth' => [
            'confirm_password' => 'Dies ist ein geschützter Bereich der Anwendung. Bitte bestätigen Sie Ihr Passwort, bevor Sie fortfahren.',
            'forgot_password' => 'Passwort vergessen?',
            'login' => 'Melden Sie sich bei Ihrem Konto an',
            'register' => 'Ein Konto registrieren',
            'two_factor_challenge' => [
                'authentication_code' => 'Bitte bestätigen Sie den Zugang zu Ihrem Konto, indem Sie den Authentifizierungscode eingeben, der von Ihrer Authentifizierungs-App bereitgestellt wird.',
                'emergency_recovery_code' => 'Bitte bestätigen Sie den Zugang zu Ihrem Konto, indem Sie einen Ihrer Notfall-Wiederherstellungscodes eingeben.',
            ],
            'verify_email' => [
                'verification_link_not_sent' => 'Bevor Sie fortfahren können, könnten Sie Ihre E-Mail-Adresse überprüfen, indem Sie auf den Link klicken, den wir Ihnen gerade per E-Mail geschickt haben? Wenn Sie die E-Mail nicht erhalten haben, senden wir Ihnen gerne eine neue.',
                'verification_link_sent' => 'Ein neuer Bestätigungslink wurde an die in Ihren Profil-Einstellungen angegebene E-Mail-Adresse gesendet.',
            ],
        ],

        'profile' => [
            'connected_accounts' => [
                'has_connected_accounts' => 'Ihre verbundenen Konten.',
                'no_connected_accounts' => 'Sie haben keine verbundenen Konten.',
            ],

            'two_factor_authentication' => [
                'enabled' => 'Sie haben die Zwei-Faktor-Authentifizierung aktiviert!',
                'finish_enabling' => 'Schließen Sie die Aktivierung der Zwei-Faktor-Authentifizierung ab.',
                'not_enabled' => 'Sie haben die Zwei-Faktor-Authentifizierung nicht aktiviert.',
            ],

            'update_profile_information' => [
                'verification_link_not_sent' => 'Bevor Ihre E-Mail aktualisiert werden kann, müssen Sie Ihre aktuelle E-Mail-Adresse überprüfen.',
                'verification_link_sent' => 'Ein neuer Bestätigungslink wurde an Ihre E-Mail-Adresse gesendet.',
            ],
        ],

        'tokens' => [
            'token_manager' => [
                'manage_tokens' => 'Persönliche Zugangstokens verwalten',
            ],
        ],

        'tenants' => [
            'tenant_employee_manager' => [
                'manage_employees' => 'Mitarbeiter verwalten',
                'pending_invitations' => 'Ausstehende Einladungen',
            ],
        ],
    ],

    'subheadings' => [
        'auth' => [
            'forgot_password' => 'Geben Sie uns einfach Ihre E-Mail-Adresse und wir senden Ihnen einen Link zum Zurücksetzen Ihres Passworts, der es Ihnen ermöglicht, ein neues zu wählen.',
            'login' => 'Oder',
            'register' => 'Ich stimme den :terms_of_service und den :privacy_policy zu',
        ],

        'profile' => [
            'two_factor_authentication' => [
                'enabled' => 'Die Zwei-Faktor-Authentifizierung ist jetzt aktiviert. Scannen Sie den folgenden QR-Code mit der Authentifizierungs-App Ihres Telefons oder geben Sie den Einrichtungsschlüssel ein.',
                'finish_enabling' => 'Um die Aktivierung der Zwei-Faktor-Authentifizierung abzuschließen, scannen Sie den folgenden QR-Code mit der Authentifizierungs-App Ihres Telefons oder geben Sie den Einrichtungsschlüssel ein und stellen Sie den generierten OTP-Code bereit.',
                'store_codes' => 'Speichern Sie diese Wiederherstellungscodes in einem sicheren Passwort-Manager. Sie können verwendet werden, um den Zugang zu Ihrem Konto wiederherzustellen, falls Ihr Zwei-Faktor-Authentifizierungsgerät verloren geht.',
                'summary' => 'Wenn die Zwei-Faktor-Authentifizierung aktiviert ist, werden Sie während der Authentifizierung nach einem sicheren, zufälligen Token gefragt. Sie können dieses Token aus der Google Authenticator-App Ihres Telefons abrufen.',
            ],

            'connected_accounts' => 'Sie können beliebige soziale Konten mit Ihrem Profil verbinden und jederzeit verbundene Konten entfernen. Wenn Sie glauben, dass eines Ihrer verbundenen Konten kompromittiert wurde, sollten Sie es sofort trennen und Ihr Passwort ändern.',
            'delete_user' => 'Sobald Ihr Konto gelöscht ist, werden alle seine Ressourcen und Daten dauerhaft gelöscht. Bevor Sie Ihr Konto löschen, laden Sie bitte alle Daten oder Informationen herunter, die Sie behalten möchten.',
            'logout_other_browser_sessions' => 'Wenn nötig, können Sie sich von all Ihren anderen Browsersitzungen auf allen Ihren Geräten abmelden. Einige Ihrer letzten Sitzungen sind unten aufgeführt; diese Liste ist jedoch möglicherweise nicht vollständig. Wenn Sie glauben, dass Ihr Konto kompromittiert wurde, sollten Sie auch Ihr Passwort aktualisieren.',
        ],

        'tenants' => [
            'tenant_employee_manager' => 'Bitte geben Sie die E-Mail-Adresse der Person an, die Sie zu dieser Firma hinzufügen möchten.',
            'delete_tenant' => 'Sobald eine Firma gelöscht wird, werden alle ihre Ressourcen und Daten dauerhaft gelöscht. Bevor Sie diese Firma löschen, laden Sie bitte alle Daten oder Informationen herunter, die Sie behalten möchten.',
        ],
    ],
];
