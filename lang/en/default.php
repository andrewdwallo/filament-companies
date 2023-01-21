<?php

return [
    "fields" => [
        "name" => "Name",
        "email" => "Email",
        "password" => "Password",
        "code" => "Code",
        "recovery_code" => "Recovery Code",
        "current_password" => "Current Password",
    ],

    "buttons" => [
        "register" => "Register",
        "login" => "Log in",
        "confirm" => "Confirm",
        "email_password_reset_link" => "Email Password Reset Link",
        "reset_password" => "Reset Password",
        "use_recovery_code" => "Use a recovery code",
        "use_authentication_code" => "Use an authentication code",
        "resend_verification_email" => "Resend Verification Email",
        "logout" => "Log Out",
        "new_photo" => "Select A New Photo",
        "remove_photo" => "Remove Photo",
        "save" => "Save",
        "enable" => "Enable",
        "regenerate_recovery_codes" => "Regenerate Recovery Codes",
        "show_recovery_codes" => "Show Recovery Codes",
        "cancel" => "Cancel",
        "disable" => "Disable",
        "logout_browser_sessions" => "Log Out Other Browser Sessions",
        "done" => "Done.",
        "delete_account" => "Delete Account",
        "create" => "Create",
        "delete" => "Delete",
        "permissions" => "Permissions",
        "close" => "Close",
        "add" => "Add",
        "leave" => "Leave",
        "remove" => "Remove",
        "delete_company" => "Delete Company",
        "remember_me" => "Remember me",
        "use_avatar_as_profile_photo" => "Use Avatar as Profile Photo",
        "connect" => "Connect",
        "remove_connected_account" => "Remove Connected Account",
    ],

    "labels" => [
        "company_name" => "Company Name",
        "company_owner" => "Company Owner",
        "setup_key" => "Setup Key",
        "role" => "Role",
        "photo" => "Photo",
        "password_confirmation" => "Confirm Password",
        "token_name" => "Token Name",
        "permissions" => "Permissions",
        "new_password" => "New Password",
        "unknown" => "Unknown",
        "this_device" => "This device",
        "last_active" => "Last active",
        "last_used" => "Last used",
        "not_connected" => "Not connected.",
        "connected" => "Connected",
    ],

    "links" => [
        "terms_of_service" => "Terms of Service",
        "privacy_policy" => "Privacy Policy",
        "already_registered" => "Already registered?",
        "register_an_account" => "Register an account",
        "forgot_your_password" => "Forgot your password?",
        "edit_profile" => "Edit Profile",
    ],

    "navigation" => [
        "headers" => [
            "manage_company" => "Manage Company",
            "switch_companies" => "Switch Companies",
        ],

        "links" => [
            "company_settings" => "Company Settings",
            "new_company" => "New Company",
            "api_tokens" => "API Tokens",
        ],
    ],

    "pages" => [
        "titles" => [
            "create_company" => "Create Company",
            "company_settings" => "Company Settings",
            "api_tokens" => "API Tokens",
            "profile" => "Profile",
        ],
    ],

    "grid_section_titles" => [
        "profile_information" => "Profile Information",
        "update_password" => "Update Password",
        "two_factor_authentication" => "Two Factor Authentication",
        "browser_sessions" => "Browser Sessions",
        "delete_account" => "Delete Account",
        "create_api_token" => "Create API Token",
        "company_name" => "Company Name",
        "create_company" => "Create Company",
        "add_company_employee" => "Add Company Employee",
        "set_password" => "Set Password",
    ],

    "grid_section_descriptions" => [
        "profile_information" => "Update your account's profile information and email address.",
        "update_password" => "Ensure your account is using a long, random password to stay secure.",
        "two_factor_authentication" => "Add additional security to your account using two factor authentication.",
        "browser_sessions" => "Manage and log out your active sessions on other browsers and devices.",
        "delete_account" => "Permanently delete your account.",
        "create_api_token" => "API tokens allow third-party services to authenticate with our application on your behalf.",
        "company_name" => "The company's name and owner information.",
        "create_company" => "Create a new company to collaborate with others on projects.",
        "add_company_employee" => "Add a new company employee to your company, allowing them to collaborate with you.",
        "set_password" => "Ensure your account is using a long, random password to stay secure."
    ],

    "action_section_titles" => [
        "pending_company_invitations" => "Pending Company Invitations",
        "company_employees" => "Company Employees",
        "delete_company" => "Delete Company",
        "connected_accounts" => "Connected Accounts",
    ],

    "action_section_descriptions" => [
        "pending_company_invitations" => "These people have been invited to your company and have been sent an invitation email. They may join the company by accepting the email invitation.",
        "company_employees" => "All of the people that are part of this company.",
        "delete_company" => "Permanently delete this company.",
        "connected_accounts" => "Manage and remove your connected accounts.",
    ],

    "modal_titles" => [
        "api_token" => "API Token",
        "api_token_permissions" => "API Token Permissions",
        "delete_api_token" => "Delete API Token",
        "manage_role" => "Manage Role",
        "leave_company" => "Leave Company",
        "remove_company_employee" => "Remove Company Employee",
        "logout_browser_sessions" => "Log Out Other Browser Sessions",
        "delete_account" => "Delete Account",
        "delete_company" => "Delete Company",
        "remove_connected_account" => "Remove Connected Account",
    ],

    "modal_descriptions" => [
        "api_token" => "Please copy your new API token. For your security, it won't be shown again.",
        "delete_api_token" => "Are you sure you would like to delete this API token?",
        "leave_company" => "Are you sure you would like to leave this company?",
        "remove_company_employee" => "Are you sure you would like to remove this person from the company?",
        "logout_browser_sessions" => "Please enter your password to confirm you would like to log out of your other browser sessions across all of your devices.",
        "delete_account" => "Are you sure you want to delete your account? Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.",
        "delete_company" => "Are you sure you want to delete this company? Once a company is deleted, all of its resources and data will be permanently deleted.",
        "remove_connected_account" => "Please confirm your removal of this account - this action cannot be undone.",
    ],

    "headings" => [
        "auth" => [
            "register" => "Register an account",
            "login" => "Log in to your account",
            "confirm_password" => "This is a secure area of the application. Please confirm your password before continuing.",
            "forgot_password" => "Forgot your password?",
            "two_factor_challenge" => [
                "authentication_code" => "Please confirm access to your account by entering the authentication code provided by your authenticator application.",
                "emergency_recovery_code" => "Please confirm access to your account by entering one of your emergency recovery codes.",
            ],
            "verify_email" => [
                "verification_link_not_sent" => "Before continuing, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.",
                "verification_link_sent" => "A new verification link has been sent to the email address you provided in your profile settings.",
            ],
        ],

        "profile" => [
            "update_profile_information" => [
                "verification_link_not_sent" => "Before your email can be updated, you must verify your current email address.",
                "verification_link_sent" => "A new verification link has been sent to your email address.",
            ],

            "two_factor_authentication" => [
                "finish_enabling" => "Finish enabling two factor authentication.",
                "enabled" => "You have enabled two factor authentication!",
                "not_enabled" => "You have not enabled two factor authentication.",
            ],

            "connected_accounts" => [
                "no_connected_accounts" => "You have no connected accounts.",
                "has_connected_accounts" => "Your connected accounts.",
            ]
        ],

        "api" => [
            "api_token_manager" => [
                "manage_api_tokens" => "Manage API Tokens",
            ],
        ],

        "companies" => [
            "company_employee_manager" => [
                "pending_invitations" => "Pending Invitations",
                "manage_employees" => "Manage Employees",
            ],
        ],
    ],

    "subheadings" => [
        "auth" => [
            "login" => "Or",
            "forgot_password" => "Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.",
            "register" => "I agree to the :terms_of_service and :privacy_policy",
        ],

        "profile" => [
            "two_factor_authentication" => [
                "summary" => "When two factor authentication is enabled, you will be prompted for a secure, random token during authentication. You may retrieve this token from your phone's Google Authenticator application.",
                "finish_enabling" => "To finish enabling two factor authentication, scan the following QR code using your phone's authenticator application or enter the setup key and provide the generated OTP code.",
                "enabled" => "Two factor authentication is now enabled. Scan the following QR code using your phone's authenticator application or enter the setup key.",
                "store_codes" => "Store these recovery codes in a secure password manager. They can be used to recover access to your account if your two factor authentication device is lost.",
            ],

            "logout_other_browser_sessions" => "If necessary, you may log out of all of your other browser sessions across all of your devices. Some of your recent sessions are listed below; however, this list may not be exhaustive. If you feel your account has been compromised, you should also update your password.",
            "delete_user" => "Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.",
            "connected_accounts" => "You are free to connect any OAuth providers to your profile and may remove them at any time. If you feel any of your connected accounts have been compromised, you should disconnect them immediately and change your password.",
        ],

        "companies" => [
            "company_employee_manager" => "Please provide the email address of the person you would like to add to this company.",
            "delete_company" => "Once a company is deleted, all of its resources and data will be permanently deleted. Before deleting this company, please download any data or information regarding this company that you wish to retain."
        ],
    ],
];
