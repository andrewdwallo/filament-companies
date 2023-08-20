<?php

return [
    'fields' => [
        'name' => 'Nombre',
        'email' => 'Correo electrónico',
        'password' => 'Contraseña',
        'code' => 'Codigo',
        'recovery_code' => 'Código de recuperación',
        'current_password' => 'Contraseña actual',
    ],

    'buttons' => [
        'register' => 'Registrarse',
        'login' => 'Inicio de sesión',
        'confirm' => 'Confirmar',
        'email_password_reset_link' => 'Enlace de restablecimiento de contraseña de correo electrónico',
        'reset_password' => 'Restablecer contraseña',
        'use_recovery_code' => 'Usar un código de recuperación',
        'use_authentication_code' => 'Usar un código de autenticación',
        'resend_verification_email' => 'Reenviar correo electrónico de verificación',
        'logout' => 'Cerrar sesión',
        'new_photo' => 'Seleccionar una nueva foto',
        'remove_photo' => 'Eliminar foto',
        'save' => 'Guardar',
        'enable' => 'Habilitar',
        'regenerate_recovery_codes' => 'Regenerar códigos de recuperación',
        'show_recovery_codes' => 'Mostrar códigos de recuperación',
        'cancel' => 'Cancelar',
        'disable' => 'Deshabilitar',
        'logout_browser_sessions' => 'Cerrar sesión de otras sesiones del navegador',
        'done' => 'Hecho.',
        'delete_account' => 'Eliminar cuenta',
        'create' => 'Crear',
        'delete' => 'Eliminar',
        'permissions' => 'Permisos',
        'close' => 'Cerrar',
        'add' => 'Agregar',
        'leave' => 'Salir',
        'remove' => 'Eliminar',
        'delete_company' => 'Eliminar empresa',
        'remember_me' => 'Recuérdame',
    ],

    'labels' => [
        'company_name' => 'Nombre de la empresa',
        'company_owner' => 'Propietario de la empresa',
        'setup_key' => 'Clave de configuración',
        'role' => 'Rol',
        'photo' => 'Foto',
        'password_confirmation' => 'Confirmar contraseña',
        'token_name' => 'Nombre del token',
        'permissions' => 'Permisos',
        'new_password' => 'Nueva contraseña',
        'unknown' => 'Desconocido',
        'this_device' => 'Este dispositivo',
        'last_active' => 'Último activo',
        'last_used' => 'Usado por última vez',
    ],

    'links' => [
        'terms_of_service' => 'Términos del servicio',
        'privacy_policy' => 'Política de privacidad',
        'already_registered' => '¿Ya estás registrado?',
        'register_an_account' => 'Registrar una cuenta',
        'forgot_your_password' => '¿Olvidaste su contraseña?',
        'edit_profile' => 'Editar perfil',
    ],

    'navigation' => [
        'headers' => [
            'manage_company' => 'Administrar empresa',
            'switch_companies' => 'Cambiar de empresa',
        ],

        'links' => [
            'company_settings' => 'Configuración de empresa',
            'new_company' => 'Nueva Empresa',
            'tokens' => 'Personal Access Tokens',
        ],
    ],

    'pages' => [
        'titles' => [
            'create_company' => 'Crear Empresa',
            'company_settings' => 'Configuración de la empresa',
            'tokens' => 'Personal Access Tokens',
            'profile' => 'Perfil',
        ],
    ],

    'grid_section_titles' => [
        'profile_information' => 'Información del perfil',
        'update_password' => 'Actualizar contraseña',
        'two_factor_authentication' => 'Autenticación de dos factores',
        'browser_sessions' => 'Sesiones del Navegador',
        'delete_account' => 'Eliminar cuenta',
        'create_token' => 'Crear Personal Access Token',
        'company_name' => 'Nombre de la empresa',
        'create_company' => 'Crear Empresa',
        'add_company_employee' => 'Agregar empleado de la empresa',
    ],

    'grid_section_descriptions' => [
        'profile_information' => 'Actualiza la información de perfil y la dirección del correo electrónico de su cuenta.',
        'update_password' => 'Asegúrate de que su cuenta esté usando una contraseña larga y aleatoria para mantener la seguridad.',
        'two_factor_authentication' => 'Asegúrate de que su cuenta esté usando una contraseña larga y aleatoria para mantener la seguridad.',
        'browser_sessions' => 'Administra y cierra sesión en tus sesiones activas en otros navegadores y dispositivos.',
        'delete_account' => 'Eliminar permanentemente su cuenta.',
        'create_token' => 'Los tokens del API permiten que los servicios de terceros se autentiquen con nuestra aplicación en su nombre.',
        'company_name' => 'El nombre de la empresa y la información del propietario.',
        'create_company' => 'Crea una nueva empresa para colaborar con otros en sus proyectos.',
        'add_company_employee' => 'Agregar un nuevo empleado a la empresa para que pueda colaborar con usted.',
    ],

    'action_section_titles' => [
        'pending_company_invitations' => 'Invitaciones de empresa pendientes',
        'company_employees' => 'Empleados de la empresa',
        'delete_company' => 'Eliminar empresa',
    ],

    'action_section_descriptions' => [
        'pending_company_invitations' => 'Estas personas han sido invitadas a su empresa y se les ha enviado un correo electrónico de invitación. Pueden unirse a la empresa si aceptan la invitación por correo electrónico.',
        'company_employees' => 'Todas las personas que forman parte de esta empresa.',
        'delete_company' => 'Eliminar esta empresa de forma permanente.',
    ],

    'modal_titles' => [
        'token' => 'Personal Access Token',
        'token_permissions' => 'Persimos Personal Access Token',
        'delete_token' => 'Borrar Personal Access Token',
        'manage_role' => 'Gestionar Rol',
        'leave_company' => 'Salir de la empresa',
        'remove_company_employee' => 'Eliminar empleado de la empresa',
        'logout_browser_sessions' => 'Cerrar sesión de otras sesiones del navegador',
        'delete_account' => 'Eliminar cuenta',
        'delete_company' => 'Eliminar empresa',
    ],

    'modal_descriptions' => [
        'copy_token' => 'Guarde su nuevo token API. Por su seguridad, no se volverá a mostrar',
        'delete_token' => '¿Está seguro de que desea eliminar este token de API?',
        'leave_company' => '¿Está seguro de que desea dejar esta empresa?',
        'remove_company_employee' => '¿Está seguro de que desea eliminar a esta persona de la empresa?',
        'logout_browser_sessions' => 'Ingrese su contraseña para confirmar que desea cerrar sesión en sus otras sesiones de navegador en todos sus dispositivos.',
        'delete_account' => '¿Está seguro de que desea eliminar su cuenta? Una vez que se elimine su cuenta, todos sus recursos y datos se eliminarán de forma permanente. Ingrese su contraseña para confirmar que desea eliminar su cuenta de forma permanente.',
        'delete_company' => '¿Está seguro de que desea eliminar esta empresa? Una vez que se elimine una empresa, todos sus recursos y datos se eliminarán de forma permanente.',
    ],

    'headings' => [
        'auth' => [
            'register' => 'Registrar una cuenta',
            'login' => 'Inicia sesión en tu cuenta',
            'confirm_password' => 'Esta es un área segura de la aplicación. Confirme su contraseña antes de continuar.',
            'forgot_password' => '¿Olvidaste tu contraseña?',
            'two_factor_challenge' => [
                'authentication_code' => 'Confirma el acceso a tu cuenta ingresando el código de autenticación proporcionado por tu aplicación de autenticación.',
                'emergency_recovery_code' => 'Confirma el acceso a tu cuenta ingresando uno de tus códigos de recuperación de emergencia.',
            ],
            'verify_email' => [
                'verification_link_not_sent' => 'Antes de continuar, ¿podrías verificar tu dirección de correo electrónico haciendo clic en el enlace que le acabamos de enviar? Si no recibiste el correo electrónico, con gusto te enviaremos otro.',
                'verification_link_sent' => 'Se ha enviado un nuevo enlace de verificación a la dirección de correo electrónico que proporcionaste en la configuración de tu perfil.',
            ],
        ],

        'profile' => [
            'update_profile_information' => [
                'verification_link_not_sent' => 'Antes de que se pueda actualizar tu correo electrónico, debes verificar tu dirección de correo electrónico actual.',
                'verification_link_sent' => 'Se ha enviado un nuevo enlace de verificación a su dirección de correo electrónico.',
            ],

            'two_factor_authentication' => [
                'finish_enabling' => 'Terminar de habilitar la autenticación de dos factores.',
                'enabled' => '¡Has habilitado la autenticación de dos factores!',
                'not_enabled' => 'No has activado la autenticación de dos factores.',
            ],
        ],

        'tokens' => [
            'token_manager' => [
                'manage_tokens' => 'Administrar tokens de API',
            ],
        ],

        'companies' => [
            'company_employee_manager' => [
                'pending_invitations' => 'Invitaciones pendientes',
                'manage_employees' => 'Gestionar empleados',
            ],
        ],
    ],

    'subheadings' => [
        'auth' => [
            'login' => 'O',
            'forgot_password' => 'Simplemente indícanos tu dirección de correo electrónico y te enviaremos un enlace de restablecimiento de contraseña que te permitirá elegir una nueva.',
            'register' => 'Acepto los :terms_of_service y :privacy_policy',
        ],

        'profile' => [
            'two_factor_authentication' => [
                'summary' => 'Cuando la autenticación de dos factores está habilitada, se le solicitará un token seguro y aleatorio durante la autenticación. Puede recuperar este token de la aplicación Google Authenticator de su teléfono.',
                'finish_enabling' => 'Para terminar de habilitar la autenticación de dos factores, escanee el siguiente código QR con la aplicación de autenticación de su teléfono o ingrese la clave de configuración y proporcione el código OTP generado.',
                'enabled' => 'La autenticación de dos factores ahora está habilitada. Escanea el siguiente código QR usando la aplicación de autenticación de tu teléfono o ingresa la clave de configuración.',
                'store_codes' => 'Guarda estos códigos de recuperación en un administrador de contraseñas seguro. Se pueden usar para recuperar el acceso a tu cuenta si pierdes tu dispositivo de autenticación de dos factores.',
            ],

            'logout_other_browser_sessions' => 'Si es necesario, puede cerrar sesión en todas sus otras sesiones de navegador en todos sus dispositivos. Algunas de sus sesiones recientes se enumeran a continuación; sin embargo, esta lista puede no ser exhaustiva. Si cree que su cuenta tiene ha sido comprometida, también debe actualizar su contraseña.',
            'delete_user' => 'Una vez que se elimine su cuenta, todos sus recursos y datos se eliminarán de forma permanente. Antes de eliminar su cuenta, descargue cualquier dato o información que desee conservar.',
        ],

        'companies' => [
            'company_employee_manager' => 'Proporcione la dirección de correo electrónico de la persona que desea agregar a esta empresa.',
            'delete_company' => 'Una vez que se elimine una empresa, todos sus recursos y datos se eliminarán de forma permanente. Antes de eliminar esta empresa, descargue cualquier dato o información sobre esta empresa que desee conservar.',
        ],
    ],
];
