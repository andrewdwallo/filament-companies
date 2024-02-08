<?php

return [
    'fields' => [
        'code' => 'Code',
        'current_password' => 'Mot de passe actuel',
        'email' => 'Email',
        'name' => 'Nom',
        'password' => 'Mot de passe',
        'recovery_code' => 'Code de récupération',
    ],

    'buttons' => [
        'add' => 'Ajouter',
        'cancel' => 'Annuler',
        'close' => 'Fermer',
        'connect' => 'Connecter',
        'confirm' => 'Confirmer',
        'create' => 'Créer',
        'create_token' => 'Créer un jeton',
        'delete' => 'Supprimer',
        'delete_account' => 'Supprimer le compte',
        'delete_company' => 'Supprimer l\'entreprise',
        'disable' => 'Désactiver',
        'done' => 'Terminé.',
        'edit' => 'Modifier',
        'email_password_reset_link' => 'Envoyer le lien de réinitialisation du mot de passe',
        'enable' => 'Activer',
        'leave' => 'Quitter',
        'login' => 'Connexion',
        'logout' => 'Déconnexion',
        'logout_browser_sessions' => 'Déconnecter les autres sessions navigateur',
        'new_photo' => 'Nouvelle photo',
        'permissions' => 'Permissions',
        'register' => 'S\'inscrire',
        'regenerate_recovery_codes' => 'Régénérer les codes de récupération',
        'remember_me' => 'Se souvenir de moi',
        'remove' => 'Retirer',
        'remove_connected_account' => 'Supprimer le compte connecté',
        'remove_photo' => 'Supprimer la photo',
        'reset_password' => 'Réinitialiser le mot de passe',
        'resend_verification_email' => 'Renvoyer l\'email de vérification',
        'revoke' => 'Révoquer',
        'save' => 'Sauvegarder',
        'show_recovery_codes' => 'Afficher les codes de récupération',
        'use_authentication_code' => 'Utiliser un code d\'authentification',
        'use_avatar_as_profile_photo' => 'Utiliser l\'avatar',
        'use_recovery_code' => 'Utiliser un code de récupération',
    ],

    'labels' => [
        'company_name' => 'Nom de l\'entreprise',
        'company_owner' => 'Propriétaire de l\'entreprise',
        'connected' => 'Connecté',
        'created_at' => 'Créé le',
        'last_active' => 'Dernière activité',
        'last_used' => 'Dernière utilisation',
        'last_used_at' => 'Dernière utilisation le',
        'new_password' => 'Nouveau mot de passe',
        'not_connected' => 'Non connecté.',
        'password_confirmation' => 'Confirmation du mot de passe',
        'permissions' => 'Permissions',
        'photo' => 'Photo',
        'role' => 'Rôle',
        'setup_key' => 'Clé de configuration',
        'this_device' => 'Cet appareil',
        'token_name' => 'Nom du jeton',
        'unknown' => 'Inconnu',
        'updated_at' => 'Mis à jour le',
    ],

    'links' => [
        'already_registered' => 'Déjà inscrit ?',
        'edit_profile' => 'Modifier le profil',
        'forgot_your_password' => 'Mot de passe oublié ?',
        'privacy_policy' => 'Politique de confidentialité',
        'register_an_account' => 'Inscrire un compte',
        'terms_of_service' => 'Conditions d\'utilisation',
    ],

    'errors' => [
        'cannot_leave_company' => 'Vous ne pouvez pas quitter une entreprise que vous avez créée.',
        'company_deletion' => 'Vous ne pouvez pas supprimer votre entreprise personnelle.',
        'email_already_associated' => 'Un compte avec cette adresse email existe déjà. Veuillez vous connecter pour associer votre compte :Provider.',
        'email_not_found' => 'Nous n\'avons pas pu trouver d\'utilisateur enregistré avec cette adresse email.',
        'employee_already_belongs_to_company' => 'Cet employé appartient déjà à l\'entreprise.',
        'employee_already_invited' => 'Cet employé a déjà été invité à l\'entreprise.',
        'invalid_password' => 'Le mot de passe que vous avez entré est invalide.',
        'no_email_with_account' => 'Aucune adresse email n\'est associée à ce compte :Provider. Veuillez essayer un autre compte.',
        'password_does_not_match' => 'Le mot de passe fourni ne correspond pas à votre mot de passe actuel.',
        'already_associated_account' => 'Un compte avec cette connexion :Provider existe déjà, veuillez vous connecter.',
        'already_connected' => 'Un compte avec cette adresse email existe déjà. Veuillez vous connecter pour associer votre compte :Provider.',
        'signin_not_found' => 'Un compte avec cette connexion :Provider n\'a pas été trouvé. Veuillez vous inscrire ou essayer une autre méthode de connexion.',
        'user_belongs_to_company' => 'Cet utilisateur appartient déjà à l\'entreprise.',
        'valid_role' => 'Le :attribute doit être un rôle valide.',
    ],

    'descriptions' => [
        'token_created_state' => 'Créé il y a :time_ago par :user_name.',
        'token_last_used_state' => 'Dernière utilisation il y a :time_ago',
        'token_never_used' => 'Jamais utilisé',
        'token_updated_state' => 'Mis à jour il y a :time_ago',
    ],

    'banner' => [
        'company_invitation_accepted' => 'Super ! Vous avez accepté l\'invitation à rejoindre **:company**.',
    ],

    'notifications' => [
        'token_created' => [
            'title' => 'Jeton d\'accès personnel créé',
            'body' => 'Un nouveau jeton d\'accès personnel a été créé avec le nom **:name**.',
        ],

        'token_updated' => [
            'title' => 'Jeton d\'accès personnel mis à jour',
            'body' => 'Le jeton d\'accès personnel a été mis à jour avec succès.',
        ],

        'browser_sessions_terminated' => [
            'title' => 'Sessions navigateur terminées',
            'body' => 'Votre compte a été déconnecté des autres sessions navigateur pour des raisons de sécurité.',
        ],

        'company_created' => [
            'title' => 'Entreprise créée',
            'body' => 'Une nouvelle entreprise a été créée avec le nom **:name**.',
        ],

        'company_deleted' => [
            'title' => 'Entreprise supprimée',
            'body' => 'L\'entreprise **:name** a été supprimée.',
        ],

        'company_invitation_sent' => [
            'title' => 'Invitation envoyée',
            'body' => 'Une invitation a été envoyée à **:email** pour rejoindre votre entreprise.',
        ],

        'company_name_updated' => [
            'title' => 'Entreprise mise à jour',
            'body' => 'Le nom de votre entreprise a été mis à jour en **:name**.',
        ],

        'connected_account_removed' => [
            'title' => 'Compte connecté supprimé',
            'body' => 'Le compte connecté a été supprimé avec succès.',
        ],

        'password_set' => [
            'title' => 'Mot de passe défini',
            'body' => 'Votre compte est désormais protégé par un mot de passe. La page sera automatiquement actualisée dans un instant pour mettre à jour vos paramètres.',
        ],

        'password_updated' => [
            'title' => 'Mot de passe mis à jour',
            'body' => 'Votre mot de passe a été mis à jour avec succès.',
        ],

        'profile_information_updated' => [
            'title' => 'Informations de profil mises à jour',
            'body' => 'Vos informations de profil ont été mises à jour avec succès.',
        ],

        'already_associated' => [
            'title' => 'Oups !',
            'body' => 'Ce compte de connexion :Provider est déjà associé à votre utilisateur.',
        ],

        'belongs_to_other_user' => [
            'title' => 'Oups !',
            'body' => 'Ce compte de connexion :Provider est déjà associé à un autre utilisateur. Veuillez essayer un autre compte.',
        ],

        'successfully_connected' => [
            'title' => 'Succès !',
            'body' => 'Vous avez connecté avec succès :Provider à votre compte.',
        ],

        'verification_link_sent' => [
            'title' => 'Lien de vérification envoyé',
            'body' => 'Un nouveau lien de vérification a été envoyé à l\'adresse email fournie.',
        ],
    ],

    'navigation' => [
        'headers' => [
            'manage_company' => 'Gérer l\'entreprise',
            'switch_companies' => 'Changer d\'entreprise',
        ],

        'links' => [
            'tokens' => 'Jeton d\'accès personnel',
            'company_settings' => 'Paramètres de l\'entreprise',
            'create_company' => 'Créer une entreprise',
        ],
    ],

    'pages' => [
        'titles' => [
            'tokens' => 'Jeton d\'accès personnel',
            'create_company' => 'Créer une entreprise',
            'company_settings' => 'Paramètres de l\'entreprise',
            'profile' => 'Profil',
        ],
    ],

    'grid_section_titles' => [
        'add_company_employee' => 'Ajouter un employé de l\'entreprise',
        'browser_sessions' => 'Sessions Navigateur',
        'company_name' => 'Nom de l\'entreprise',
        'create_token' => 'Créer un jeton d\'accès personnel',
        'create_company' => 'Créer une entreprise',
        'delete_account' => 'Supprimer le compte',
        'profile_information' => 'Informations du profil',
        'set_password' => 'Définir un mot de passe',
        'two_factor_authentication' => 'Authentification à deux facteurs',
        'update_password' => 'Mettre à jour le mot de passe',
    ],

    'grid_section_descriptions' => [
        'add_company_employee' => 'Ajoutez un nouvel employé à votre entreprise pour collaborer avec vous.',
        'browser_sessions' => 'Gérez et déconnectez vos sessions actives sur d\'autres navigateurs et appareils.',
        'company_name' => 'Le nom de l\'entreprise et les informations du propriétaire.',
        'create_token' => 'Les jetons d\'accès personnel permettent à des services tiers de s\'authentifier auprès de notre application en votre nom.',
        'create_company' => 'Créez une nouvelle entreprise pour collaborer avec d\'autres sur des projets.',
        'delete_account' => 'Supprimez définitivement votre compte.',
        'profile_information' => 'Mettez à jour les informations de profil et l\'adresse email de votre compte.',
        'set_password' => 'Assurez-vous que votre compte utilise un mot de passe long et aléatoire pour rester sécurisé.',
        'two_factor_authentication' => 'Ajoutez une sécurité supplémentaire à votre compte en utilisant l\'authentification à deux facteurs.',
        'update_password' => 'Assurez-vous que votre compte utilise un mot de passe long et aléatoire pour rester sécurisé.',
    ],

    'action_section_titles' => [
        'company_employees' => 'Employés de l\'entreprise',
        'connected_accounts' => 'Comptes connectés',
        'delete_company' => 'Supprimer l\'entreprise',
        'pending_company_invitations' => 'Invitations d\'entreprise en attente',
    ],

    'action_section_descriptions' => [
        'company_employees' => 'Toutes les personnes qui font partie de cette entreprise.',
        'connected_accounts' => 'Gérez et supprimez vos comptes connectés.',
        'delete_company' => 'Supprimez définitivement cette entreprise.',
        'pending_company_invitations' => 'Ces personnes ont été invitées dans votre entreprise et ont reçu une invitation par email. Ils peuvent rejoindre l\'entreprise en acceptant l\'invitation par email.',
    ],

    'modal_titles' => [
        'token' => 'Jeton d\'accès personnel',
        'token_permissions' => 'Permissions du jeton d\'accès personnel',
        'confirm_password' => 'Confirmer le mot de passe',
        'delete_token' => 'Supprimer le jeton d\'accès personnel',
        'delete_account' => 'Supprimer le compte',
        'delete_company' => 'Supprimer l\'entreprise',
        'leave_company' => 'Quitter l\'entreprise',
        'logout_browser_sessions' => 'Déconnecter les autres sessions navigateur',
        'manage_role' => 'Gérer le rôle',
        'remove_company_employee' => 'Supprimer un employé de l\'entreprise',
        'remove_connected_account' => 'Supprimer le compte connecté',
        'revoke_tokens' => 'Révoquer les jetons',
    ],

    'modal_descriptions' => [
        'copy_token' => "Veuillez copier votre nouveau jeton d'accès personnel. Pour des raisons de sécurité, il ne sera plus affiché.",
        'confirm_password' => 'Pour des raisons de sécurité, veuillez confirmer votre mot de passe pour continuer.',
        'delete_account' => 'Veuillez entrer votre mot de passe pour confirmer la suppression de votre compte.',
        'delete_token' => 'Êtes-vous sûr de vouloir supprimer ce jeton d\'accès personnel ?',
        'delete_company' => 'Êtes-vous sûr de vouloir supprimer cette entreprise ?',
        'leave_company' => 'Êtes-vous sûr de vouloir quitter cette entreprise ?',
        'logout_browser_sessions' => 'Veuillez entrer votre mot de passe pour confirmer que vous souhaitez vous déconnecter de vos autres sessions de navigateur.',
        'remove_company_employee' => 'Êtes-vous sûr de vouloir supprimer cette personne de l\'entreprise ?',
        'remove_connected_account' => 'Veuillez confirmer la suppression de ce compte - cette action ne peut pas être annulée.',
        'revoke_tokens' => 'Veuillez entrer votre mot de passe pour confirmer.',
    ],

    'headings' => [
        'auth' => [
            'confirm_password' => 'Ceci est une zone sécurisée de l\'application. Veuillez confirmer votre mot de passe avant de continuer.',
            'forgot_password' => 'Vous avez oublié votre mot de passe ?',
            'login' => 'Connectez-vous à votre compte',
            'register' => 'Inscrivez-vous à un compte',
            'two_factor_challenge' => [
                'authentication_code' => 'Veuillez confirmer l\'accès à votre compte en entrant le code d\'authentification fourni par votre application d\'authentification.',
                'emergency_recovery_code' => 'Veuillez confirmer l\'accès à votre compte en entrant l\'un de vos codes de récupération d\'urgence.',
            ],
            'verify_email' => [
                'verification_link_not_sent' => "Avant de continuer, pourriez-vous vérifier votre adresse e-mail en cliquant sur le lien que nous venons de vous envoyer par e-mail ? Si vous n'avez pas reçu l'e-mail, nous vous en enverrons volontiers un autre.",
                'verification_link_sent' => 'Un nouveau lien de vérification a été envoyé à l\'adresse e-mail que vous avez fournie dans vos paramètres de profil.',
            ],
        ],

        'profile' => [
            'connected_accounts' => [
                'has_connected_accounts' => 'Vos comptes connectés.',
                'no_connected_accounts' => 'Vous n\'avez pas de comptes connectés.',
            ],

            'two_factor_authentication' => [
                'enabled' => 'Vous avez activé l\'authentification à deux facteurs !',
                'finish_enabling' => 'Terminez l\'activation de l\'authentification à deux facteurs.',
                'not_enabled' => 'Vous n\'avez pas activé l\'authentification à deux facteurs.',
            ],

            'update_profile_information' => [
                'verification_link_not_sent' => 'Avant de mettre à jour votre e-mail, vous devez vérifier votre adresse e-mail actuelle.',
                'verification_link_sent' => 'Un nouveau lien de vérification a été envoyé à votre adresse e-mail.',
            ],
        ],

        'tokens' => [
            'token_manager' => [
                'manage_tokens' => 'Gérer les jetons d\'accès personnels',
            ],
        ],

        'companies' => [
            'company_employee_manager' => [
                'manage_employees' => 'Gérer les employés',
                'pending_invitations' => 'Invitations en attente',
            ],
        ],
    ],

    'subheadings' => [
        'auth' => [
            'forgot_password' => 'Indiquez-nous simplement votre adresse e-mail et nous vous enverrons un lien de réinitialisation de mot de passe qui vous permettra d\'en choisir un nouveau.',
            'login' => 'Ou',
            'register' => 'J\'accepte les :terms_of_service et la :privacy_policy',
        ],

        'profile' => [
            'two_factor_authentication' => [
                'enabled' => "L'authentification à deux facteurs est maintenant activée. Scannez le code QR suivant à l'aide de l'application d'authentification de votre téléphone ou saisissez la clé de configuration.",
                'finish_enabling' => "Pour terminer l'activation de l'authentification à deux facteurs, scannez le code QR suivant à l'aide de l'application d'authentification de votre téléphone ou saisissez la clé de configuration et fournissez le code OTP généré.",
                'store_codes' => 'Stockez ces codes de récupération dans un gestionnaire de mots de passe sécurisé. Ils peuvent être utilisés pour récupérer l\'accès à votre compte si votre appareil d\'authentification à deux facteurs est perdu.',
                'summary' => "Lorsque l'authentification à deux facteurs est activée, vous serez invité à saisir un jeton sécurisé et aléatoire lors de l'authentification. Vous pouvez récupérer ce jeton à partir de l'application Google Authenticator de votre téléphone.",
            ],

            'connected_accounts' => 'Vous êtes libre de connecter n\'importe quel compte social à votre profil et pouvez supprimer n\'importe quel compte connecté à tout moment. Si vous pensez que l\'un de vos comptes connectés a été compromis, vous devriez les déconnecter immédiatement et changer votre mot de passe.',
            'delete_user' => 'Une fois votre compte supprimé, toutes ses ressources et données seront définitivement supprimées. Avant de supprimer votre compte, veuillez télécharger toutes les données ou informations que vous souhaitez conserver.',
            'logout_other_browser_sessions' => 'Si nécessaire, vous pouvez vous déconnecter de toutes vos autres sessions de navigateur sur tous vos appareils. Certaines de vos sessions récentes sont répertoriées ci-dessous ; cependant, cette liste peut ne pas être exhaustive. Si vous pensez que votre compte a été compromis, vous devriez également mettre à jour votre mot de passe.',
        ],

        'companies' => [
            'company_employee_manager' => 'Veuillez fournir l\'adresse e-mail de la personne que vous souhaitez ajouter à cette entreprise.',
            'delete_company' => 'Une fois une entreprise supprimée, toutes ses ressources et données seront définitivement supprimées. Avant de supprimer cette entreprise, veuillez télécharger toutes les données ou informations concernant cette entreprise que vous souhaitez conserver.',
        ],
    ],
];
