<?php

return [
    'fields' => [
        'code' => 'Código',
        'current_password' => 'Palavra-Passe Atual',
        'email' => 'Email',
        'name' => 'Nome',
        'password' => 'Palavra-Passe',
        'recovery_code' => 'Código de Recuperação',
    ],

    'buttons' => [
        'add' => 'Adicionar',
        'cancel' => 'Cancelar',
        'close' => 'Fechar',
        'connect' => 'Conectar',
        'confirm' => 'Confirmar',
        'create' => 'Criar',
        'create_token' => 'Criar Token',
        'delete' => 'Eliminar',
        'delete_account' => 'Eliminar Conta',
        'delete_tenant' => 'Eliminar Empresa',
        'disable' => 'Desativar',
        'done' => 'Concluído.',
        'edit' => 'Editar',
        'email_password_reset_link' => 'Enviar Link de Redefinição de Palavra-Passe',
        'enable' => 'Ativar',
        'leave' => 'Sair',
        'login' => 'Entrar',
        'logout' => 'Sair',
        'logout_browser_sessions' => 'Sair de Outras Sessões do Navegador',
        'new_photo' => 'Nova Foto',
        'permissions' => 'Permissões',
        'register' => 'Registar',
        'regenerate_recovery_codes' => 'Regenerar Códigos de Recuperação',
        'remember_me' => 'Lembrar-me',
        'remove' => 'Remover',
        'remove_connected_account' => 'Remover Conta Conectada',
        'remove_photo' => 'Remover Foto',
        'reset_password' => 'Redefinir Palavra-Passe',
        'resend_verification_email' => 'Reenviar Email de Verificação',
        'revoke' => 'Revogar',
        'save' => 'Salvar',
        'show_recovery_codes' => 'Mostrar Códigos de Recuperação',
        'use_authentication_code' => 'Usar um código de autenticação',
        'use_avatar_as_profile_photo' => 'Usar Avatar',
        'use_recovery_code' => 'Usar um código de recuperação',
    ],

    'labels' => [
        'tenant_name' => 'Nome da Empresa',
        'tenant_owner' => 'Proprietário da Empresa',
        'connected' => 'Conectado',
        'created_at' => 'Criado em',
        'last_active' => 'Última Atividade',
        'last_used' => 'Último Uso',
        'last_used_at' => 'Último Uso em',
        'new_password' => 'Nova Palavra-Passe',
        'not_connected' => 'Não conectado.',
        'password_confirmation' => 'Confirmar Palavra-Passe',
        'permissions' => 'Permissões',
        'photo' => 'Foto',
        'role' => 'Função',
        'setup_key' => 'Chave de Configuração',
        'this_device' => 'Este dispositivo',
        'token_name' => 'Nome do Token',
        'unknown' => 'Desconhecido',
        'updated_at' => 'Atualizado em',
    ],

    'links' => [
        'already_registered' => 'Já está registado?',
        'edit_profile' => 'Editar Perfil',
        'forgot_your_password' => 'Esqueceu a sua palavra-passe?',
        'privacy_policy' => 'Política de Privacidade',
        'register_an_account' => 'Registar uma conta',
        'terms_of_service' => 'Termos de Serviço',
    ],

    'errors' => [
        'cannot_leave_tenant' => 'Não pode sair de uma empresa que criou.',
        'tenant_deletion' => 'Não pode eliminar a sua empresa pessoal.',
        'email_already_associated' => 'Uma conta com este endereço de email já existe. Por favor, faça login para conectar a sua conta :Provider.',
        'email_not_found' => 'Não conseguimos encontrar um utilizador registado com este endereço de email.',
        'employee_already_belongs_to_tenant' => 'Este funcionário já pertence à empresa.',
        'employee_already_invited' => 'Este funcionário já foi convidado para a empresa.',
        'generic_error' => 'Ocorreu um erro ao processar o seu pedido.',
        'invalid_password' => 'A palavra-passe que introduziu é inválida.',
        'no_email_with_account' => 'Nenhum endereço de email está associado a esta conta :Provider. Por favor, tente uma conta diferente.',
        'password_does_not_match' => 'A palavra-passe fornecida não corresponde à sua palavra-passe atual.',
        'already_associated_account' => 'Uma conta com esse login :Provider já existe, por favor faça login.',
        'already_connected' => 'Uma conta com este endereço de email já existe. Por favor, faça login para conectar a sua conta :Provider.',
        'signin_not_found' => 'Uma conta com este login :Provider não foi encontrada. Por favor, registe-se ou tente um método de login diferente.',
        'user_belongs_to_tenant' => 'Este utilizador já pertence à empresa.',
        'valid_role' => 'O :attribute deve ser uma função válida.',
        'terms' => 'Termos de Serviço e Política de Privacidade',
    ],

    'descriptions' => [
        'token_created_state' => 'Criado há :time_ago por :user_name.',
        'token_last_used_state' => 'Último uso há :time_ago',
        'token_never_used' => 'Nunca usado',
        'token_updated_state' => 'Atualizado há :time_ago',
    ],

    'banner' => [
        'tenant_invitation_accepted' => 'Ótimo! Aceitou o convite para juntar-se à **:tenant**.',
    ],

    'notifications' => [
        'token_created' => [
            'title' => 'Token de Acesso Pessoal criado',
            'body' => 'Um novo Token de Acesso Pessoal foi criado com o nome **:name**.',
        ],

        'token_updated' => [
            'title' => 'Token de Acesso Pessoal atualizado',
            'body' => 'O Token de Acesso Pessoal foi atualizado com sucesso.',
        ],

        'browser_sessions_terminated' => [
            'title' => 'Sessões do navegador terminadas',
            'body' => 'A sua conta foi encerrada em outras sessões do navegador por motivos de segurança.',
        ],

        'tenant_created' => [
            'title' => 'Empresa criada',
            'body' => 'Uma nova empresa foi criada com o nome **:name**.',
        ],

        'tenant_deleted' => [
            'title' => 'Empresa eliminada',
            'body' => 'A empresa **:name** foi eliminada.',
        ],

        'tenant_invitation_sent' => [
            'title' => 'Convite enviado',
            'body' => 'Um convite foi enviado para **:email** para se juntar à sua empresa.',
        ],

        'tenant_name_updated' => [
            'title' => 'Empresa atualizada',
            'body' => 'O nome da sua empresa foi atualizado para **:name**.',
        ],

        'connected_account_removed' => [
            'title' => 'Conta conectada removida',
            'body' => 'A conta conectada foi removida com sucesso.',
        ],

        'password_set' => [
            'title' => 'Palavra-passe definida',
            'body' => 'A sua conta está agora protegida por palavra-passe. A página será atualizada automaticamente em breve para atualizar as suas definições.',
        ],

        'password_updated' => [
            'title' => 'Palavra-passe atualizada',
            'body' => 'A sua palavra-passe foi atualizada com sucesso.',
        ],

        'profile_information_updated' => [
            'title' => 'Informações do perfil atualizadas',
            'body' => 'As informações do seu perfil foram atualizadas com sucesso.',
        ],

        'already_associated' => [
            'title' => 'Ops!',
            'body' => 'Esta conta de login :Provider já está associada ao seu utilizador.',
        ],

        'belongs_to_other_user' => [
            'title' => 'Ops!',
            'body' => 'Esta conta de login :Provider já está associada a outro utilizador. Por favor, tente uma conta diferente.',
        ],

        'successfully_connected' => [
            'title' => 'Sucesso!',
            'body' => 'Conectou com sucesso o :Provider à sua conta.',
        ],

        'verification_link_sent' => [
            'title' => 'Link de verificação enviado',
            'body' => 'Um novo link de verificação foi enviado para o endereço de email fornecido.',
        ],
    ],

    'navigation' => [
        'headers' => [
            'manage_tenant' => 'Gerir Empresa',
            'switch_tenants' => 'Mudar Empresas',
        ],

        'links' => [
            'tokens' => 'Tokens de Acesso Pessoal',
            'tenant_settings' => 'Configurações da Empresa',
            'create_tenant' => 'Criar Empresa',
        ],
    ],

    'pages' => [
        'titles' => [
            'tokens' => 'Tokens de Acesso Pessoal',
            'create_tenant' => 'Criar Empresa',
            'tenant_settings' => 'Configurações da Empresa',
            'profile' => 'Perfil',
        ],
    ],

    'grid_section_titles' => [
        'add_tenant_employee' => 'Adicionar Funcionário da Empresa',
        'browser_sessions' => 'Sessões do Navegador',
        'tenant_name' => 'Nome da Empresa',
        'create_token' => 'Criar Token de Acesso Pessoal',
        'create_tenant' => 'Criar Empresa',
        'delete_account' => 'Eliminar Conta',
        'profile_information' => 'Informações do Perfil',
        'set_password' => 'Definir Palavra-Passe',
        'two_factor_authentication' => 'Autenticação de Dois Fatores',
        'update_password' => 'Atualizar Palavra-Passe',
    ],

    'grid_section_descriptions' => [
        'add_tenant_employee' => 'Adicione um novo funcionário da empresa à sua empresa, permitindo que ele colabore consigo.',
        'browser_sessions' => 'Gerir e desligar as suas sessões ativas em outros navegadores e dispositivos.',
        'tenant_name' => 'Nome da empresa e informações do proprietário.',
        'create_token' => 'Tokens de Acesso Pessoal permitem que serviços de terceiros autentiquem com a nossa aplicação em seu nome.',
        'create_tenant' => 'Crie uma nova empresa para colaborar com outras em projetos.',
        'delete_account' => 'Eliminar a sua conta permanentemente.',
        'profile_information' => 'Atualizar as informações do perfil e o endereço de email da sua conta.',
        'set_password' => 'Assegure-se de que a sua conta está a usar uma palavra-passe longa e aleatória para permanecer segura.',
        'two_factor_authentication' => 'Adicione segurança adicional à sua conta usando a autenticação de dois fatores.',
        'update_password' => 'Assegure-se de que a sua conta está a usar uma palavra-passe longa e aleatória para permanecer segura.',
    ],

    'action_section_titles' => [
        'tenant_employees' => 'Funcionários da Empresa',
        'connected_accounts' => 'Contas Conectadas',
        'delete_tenant' => 'Eliminar Empresa',
        'pending_tenant_invitations' => 'Convites Pendentes para a Empresa',
    ],

    'action_section_descriptions' => [
        'tenant_employees' => 'Todas as pessoas que fazem parte desta empresa.',
        'connected_accounts' => 'Gerir e remover as suas contas conectadas.',
        'delete_tenant' => 'Eliminar permanentemente esta empresa.',
        'pending_tenant_invitations' => 'Estas pessoas foram convidadas para a sua empresa e receberam um email de convite. Podem juntar-se à empresa aceitando o convite do email.',
    ],

    'modal_titles' => [
        'token' => 'Token de Acesso Pessoal',
        'token_permissions' => 'Permissões do Token de Acesso Pessoal',
        'confirm_password' => 'Confirmar Palavra-Passe',
        'delete_token' => 'Eliminar Token de Acesso Pessoal',
        'delete_account' => 'Eliminar Conta',
        'delete_tenant' => 'Eliminar Empresa',
        'leave_tenant' => 'Sair da Empresa',
        'logout_browser_sessions' => 'Sair de Outras Sessões do Navegador',
        'manage_role' => 'Gerir Função',
        'remove_tenant_employee' => 'Remover Funcionário da Empresa',
        'remove_connected_account' => 'Remover Conta Conectada',
        'revoke_tokens' => 'Revogar Tokens',
    ],

    'modal_descriptions' => [
        'copy_token' => 'Por favor, copie o seu novo Token de Acesso Pessoal. Para sua segurança, não será mostrado novamente.',
        'confirm_password' => 'Para sua segurança, por favor confirme a sua palavra-passe para continuar.',
        'delete_account' => 'Por favor, insira a sua palavra-passe para confirmar que deseja eliminar a sua conta.',
        'delete_token' => 'Tem a certeza de que deseja eliminar este Token de Acesso Pessoal?',
        'delete_tenant' => 'Tem a certeza de que deseja eliminar esta empresa?',
        'leave_tenant' => 'Tem a certeza de que deseja sair desta empresa?',
        'logout_browser_sessions' => 'Por favor, insira a sua palavra-passe para confirmar que deseja sair das suas outras sessões do navegador.',
        'remove_tenant_employee' => 'Tem a certeza de que deseja remover esta pessoa da empresa?',
        'remove_connected_account' => 'Por favor, confirme a remoção desta conta - esta ação não pode ser desfeita.',
        'revoke_tokens' => 'Por favor, insira a sua palavra-passe para confirmar.',
    ],

    'headings' => [
        'auth' => [
            'confirm_password' => 'Esta é uma área segura da aplicação. Por favor, confirme a sua palavra-passe antes de continuar.',
            'forgot_password' => 'Esqueceu a sua palavra-passe?',
            'login' => 'Entre na sua conta',
            'register' => 'Registar uma conta',
            'two_factor_challenge' => [
                'authentication_code' => 'Por favor, confirme o acesso à sua conta inserindo o código de autenticação fornecido pelo seu aplicativo autenticador.',
                'emergency_recovery_code' => 'Por favor, confirme o acesso à sua conta inserindo um dos seus códigos de recuperação de emergência.',
            ],
            'verify_email' => [
                'verification_link_not_sent' => 'Antes de continuar, pode verificar o seu endereço de email clicando no link que acabámos de enviar para si? Se não recebeu o email, teremos todo o prazer em enviar outro.',
                'verification_link_sent' => 'Um novo link de verificação foi enviado para o endereço de email que forneceu nas suas definições de perfil.',
            ],
        ],

        'profile' => [
            'connected_accounts' => [
                'has_connected_accounts' => 'As suas contas conectadas.',
                'no_connected_accounts' => 'Não tem contas conectadas.',
            ],

            'two_factor_authentication' => [
                'enabled' => 'Ativou a autenticação de dois fatores!',
                'finish_enabling' => 'Termine a ativação da autenticação de dois fatores.',
                'not_enabled' => 'Não ativou a autenticação de dois fatores.',
            ],

            'update_profile_information' => [
                'verification_link_not_sent' => 'Antes que o seu email possa ser atualizado, deve verificar o seu endereço de email atual.',
                'verification_link_sent' => 'Um novo link de verificação foi enviado para o seu endereço de email.',
            ],
        ],

        'tokens' => [
            'token_manager' => [
                'manage_tokens' => 'Gerir Tokens de Acesso Pessoal',
            ],
        ],

        'tenants' => [
            'tenant_employee_manager' => [
                'manage_employees' => 'Gerir Funcionários',
                'pending_invitations' => 'Convites Pendentes',
            ],
        ],
    ],

    'subheadings' => [
        'auth' => [
            'forgot_password' => 'Basta informar-nos o seu endereço de email e enviaremos um link para redefinir a sua palavra-passe que lhe permitirá escolher uma nova.',
            'login' => 'Ou',
            'register' => 'Concordo com os :terms_of_service e com a :privacy_policy',
        ],

        'profile' => [
            'two_factor_authentication' => [
                'enabled' => 'A autenticação de dois fatores está agora ativada. Escaneie o seguinte código QR usando o aplicativo autenticador do seu telemóvel ou insira a chave de configuração.',
                'finish_enabling' => 'Para terminar a ativação da autenticação de dois fatores, escaneie o seguinte código QR usando o aplicativo autenticador do seu telemóvel ou insira a chave de configuração e forneça o código OTP gerado.',
                'store_codes' => 'Armazene estes códigos de recuperação num gestor de palavras-passe seguro. Podem ser usados para recuperar o acesso à sua conta se o dispositivo de autenticação de dois fatores for perdido.',
                'summary' => 'Quando a autenticação de dois fatores está ativada, será solicitado a fornecer um token seguro e aleatório durante a autenticação. Pode recuperar esse token no aplicativo Google Authenticator do seu telemóvel.',
            ],

            'connected_accounts' => 'Está livre para conectar quaisquer contas sociais ao seu perfil e pode remover quaisquer contas conectadas a qualquer momento. Se pensar que alguma das suas contas conectadas foi comprometida, deve desconectá-las imediatamente e alterar a sua palavra-passe.',
            'delete_user' => 'Uma vez eliminada, a sua conta e todos os seus recursos e dados serão permanentemente apagados. Antes de eliminar a sua conta, faça o download de qualquer dado ou informação que queira manter.',
            'logout_other_browser_sessions' => 'Se necessário, pode sair de todas as suas outras sessões do navegador em todos os seus dispositivos. Algumas das suas sessões recentes estão listadas abaixo, no entanto, esta lista pode não ser exaustiva. Se pensar que a sua conta foi comprometida, deve também atualizar a sua palavra-passe.',
        ],

        'tenants' => [
            'tenant_employee_manager' => 'Por favor, forneça o endereço de email da pessoa que gostaria de adicionar a esta empresa.',
            'delete_tenant' => 'Uma vez que uma empresa é eliminada, todos os seus recursos e dados serão permanentemente apagados. Antes de eliminar esta empresa, por favor, faça o download de qualquer dado ou informação sobre esta empresa que queira manter.',
        ],
    ],
];
