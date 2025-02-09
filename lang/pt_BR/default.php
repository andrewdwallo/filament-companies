<?php

return [
    'fields' => [
        'code' => 'Código',
        'current_password' => 'Senha Atual',
        'email' => 'Email',
        'name' => 'Nome',
        'password' => 'Senha',
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
        'delete' => 'Excluir',
        'delete_account' => 'Excluir Conta',
        'delete_tenant' => 'Excluir Empresa',
        'disable' => 'Desativar',
        'done' => 'Concluído.',
        'edit' => 'Editar',
        'email_password_reset_link' => 'Enviar Link de Redefinição de Senha',
        'enable' => 'Ativar',
        'leave' => 'Sair',
        'login' => 'Entrar',
        'logout' => 'Sair',
        'logout_browser_sessions' => 'Sair de Outras Sessões do Navegador',
        'new_photo' => 'Nova Foto',
        'permissions' => 'Permissões',
        'register' => 'Registrar',
        'regenerate_recovery_codes' => 'Regenerar Códigos de Recuperação',
        'remember_me' => 'Lembrar-me',
        'remove' => 'Remover',
        'remove_connected_account' => 'Remover Conta Conectada',
        'remove_photo' => 'Remover Foto',
        'reset_password' => 'Redefinir Senha',
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
        'new_password' => 'Nova Senha',
        'not_connected' => 'Não conectado.',
        'password_confirmation' => 'Confirmar Senha',
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
        'already_registered' => 'Já está registrado?',
        'edit_profile' => 'Editar Perfil',
        'forgot_your_password' => 'Esqueceu sua senha?',
        'privacy_policy' => 'Política de Privacidade',
        'register_an_account' => 'Registrar uma conta',
        'terms_of_service' => 'Termos de Serviço',
    ],

    'errors' => [
        'cannot_leave_tenant' => 'Você não pode sair de uma empresa que criou.',
        'tenant_deletion' => 'Você não pode excluir sua empresa pessoal.',
        'email_already_associated' => 'Uma conta com este endereço de email já existe. Por favor, faça login para conectar sua conta :Provider.',
        'email_not_found' => 'Não conseguimos encontrar um usuário registrado com este endereço de email.',
        'employee_already_belongs_to_tenant' => 'Este funcionário já pertence à empresa.',
        'employee_already_invited' => 'Este funcionário já foi convidado para a empresa.',
        'generic_error' => 'Ocorreu um erro ao processar sua solicitação.',
        'invalid_password' => 'A senha que você digitou é inválida.',
        'no_email_with_account' => 'Nenhum endereço de email está associado a esta conta :Provider. Por favor, tente uma conta diferente.',
        'password_does_not_match' => 'A senha fornecida não corresponde à sua senha atual.',
        'already_associated_account' => 'Uma conta com esse login :Provider já existe, por favor faça login.',
        'already_connected' => 'Uma conta com este endereço de email já existe. Por favor, faça login para conectar sua conta :Provider.',
        'signin_not_found' => 'Uma conta com este login :Provider não foi encontrada. Por favor, registre-se ou tente um método de login diferente.',
        'user_belongs_to_tenant' => 'Este usuário já pertence à empresa.',
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
        'tenant_invitation_accepted' => 'Ótimo! Você aceitou o convite para ingressar na **:tenant**.',
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
            'body' => 'Sua conta foi desconectada de outras sessões do navegador por motivos de segurança.',
        ],

        'tenant_created' => [
            'title' => 'Empresa criada',
            'body' => 'Uma nova empresa foi criada com o nome **:name**.',
        ],

        'tenant_deleted' => [
            'title' => 'Empresa excluída',
            'body' => 'A empresa **:name** foi excluída.',
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
            'title' => 'Senha definida',
            'body' => 'Sua conta agora está protegida por senha. A página será atualizada automaticamente em um momento para atualizar suas configurações.',
        ],

        'password_updated' => [
            'title' => 'Senha atualizada',
            'body' => 'Sua senha foi atualizada com sucesso.',
        ],

        'profile_information_updated' => [
            'title' => 'Informações do perfil atualizadas',
            'body' => 'As informações do seu perfil foram atualizadas com sucesso.',
        ],

        'already_associated' => [
            'title' => 'Ops!',
            'body' => 'Esta conta de login :Provider já está associada ao seu usuário.',
        ],

        'belongs_to_other_user' => [
            'title' => 'Ops!',
            'body' => 'Esta conta de login :Provider já está associada a outro usuário. Por favor, tente uma conta diferente.',
        ],

        'successfully_connected' => [
            'title' => 'Sucesso!',
            'body' => 'Você conectou com sucesso o :Provider à sua conta.',
        ],

        'verification_link_sent' => [
            'title' => 'Link de verificação enviado',
            'body' => 'Um novo link de verificação foi enviado para o endereço de email fornecido.',
        ],
    ],

    'navigation' => [
        'headers' => [
            'manage_tenant' => 'Gerenciar Empresa',
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
        'delete_account' => 'Excluir Conta',
        'profile_information' => 'Informações do Perfil',
        'set_password' => 'Definir Senha',
        'two_factor_authentication' => 'Autenticação de Dois Fatores',
        'update_password' => 'Atualizar Senha',
    ],

    'grid_section_descriptions' => [
        'add_tenant_employee' => 'Adicione um novo funcionário da empresa à sua empresa, permitindo que ele colabore com você.',
        'browser_sessions' => 'Gerencie e desconecte suas sessões ativas em outros navegadores e dispositivos.',
        'tenant_name' => 'Nome da empresa e informações do proprietário.',
        'create_token' => 'Tokens de Acesso Pessoal permitem que serviços de terceiros autentiquem com nosso aplicativo em seu nome.',
        'create_tenant' => 'Crie uma nova empresa para colaborar com outras pessoas em projetos.',
        'delete_account' => 'Excluir sua conta permanentemente.',
        'profile_information' => 'Atualizar as informações do perfil e o endereço de email da sua conta.',
        'set_password' => 'Garanta que sua conta esteja usando uma senha longa e aleatória para permanecer segura.',
        'two_factor_authentication' => 'Adicione segurança adicional à sua conta usando autenticação de dois fatores.',
        'update_password' => 'Garanta que sua conta esteja usando uma senha longa e aleatória para permanecer segura.',
    ],

    'action_section_titles' => [
        'tenant_employees' => 'Funcionários da Empresa',
        'connected_accounts' => 'Contas Conectadas',
        'delete_tenant' => 'Excluir Empresa',
        'pending_tenant_invitations' => 'Convites Pendentes para a Empresa',
    ],

    'action_section_descriptions' => [
        'tenant_employees' => 'Todas as pessoas que fazem parte desta empresa.',
        'connected_accounts' => 'Gerencie e remova suas contas conectadas.',
        'delete_tenant' => 'Excluir permanentemente esta empresa.',
        'pending_tenant_invitations' => 'Essas pessoas foram convidadas para sua empresa e receberam um email de convite. Elas podem se juntar à empresa aceitando o convite do email.',
    ],

    'modal_titles' => [
        'token' => 'Token de Acesso Pessoal',
        'token_permissions' => 'Permissões do Token de Acesso Pessoal',
        'confirm_password' => 'Confirmar Senha',
        'delete_token' => 'Excluir Token de Acesso Pessoal',
        'delete_account' => 'Excluir Conta',
        'delete_tenant' => 'Excluir Empresa',
        'leave_tenant' => 'Sair da Empresa',
        'logout_browser_sessions' => 'Sair de Outras Sessões do Navegador',
        'manage_role' => 'Gerenciar Função',
        'remove_tenant_employee' => 'Remover Funcionário da Empresa',
        'remove_connected_account' => 'Remover Conta Conectada',
        'revoke_tokens' => 'Revogar Tokens',
    ],

    'modal_descriptions' => [
        'copy_token' => 'Por favor, copie seu novo Token de Acesso Pessoal. Para sua segurança, ele não será mostrado novamente.',
        'confirm_password' => 'Para sua segurança, por favor confirme sua senha para continuar.',
        'delete_account' => 'Por favor, insira sua senha para confirmar que deseja excluir sua conta.',
        'delete_token' => 'Você tem certeza de que deseja excluir este Token de Acesso Pessoal?',
        'delete_tenant' => 'Você tem certeza de que deseja excluir esta empresa?',
        'leave_tenant' => 'Você tem certeza de que deseja sair desta empresa?',
        'logout_browser_sessions' => 'Por favor, insira sua senha para confirmar que deseja sair de suas outras sessões do navegador.',
        'remove_tenant_employee' => 'Você tem certeza de que deseja remover esta pessoa da empresa?',
        'remove_connected_account' => 'Por favor, confirme sua remoção desta conta - essa ação não pode ser desfeita.',
        'revoke_tokens' => 'Por favor, insira sua senha para confirmar.',
    ],

    'headings' => [
        'auth' => [
            'confirm_password' => 'Esta é uma área segura do aplicativo. Por favor, confirme sua senha antes de continuar.',
            'forgot_password' => 'Esqueceu sua senha?',
            'login' => 'Entre na sua conta',
            'register' => 'Registrar uma conta',
            'two_factor_challenge' => [
                'authentication_code' => 'Por favor, confirme o acesso à sua conta inserindo o código de autenticação fornecido pelo seu aplicativo autenticador.',
                'emergency_recovery_code' => 'Por favor, confirme o acesso à sua conta inserindo um de seus códigos de recuperação de emergência.',
            ],
            'verify_email' => [
                'verification_link_not_sent' => 'Antes de continuar, você pode verificar seu endereço de email clicando no link que acabamos de enviar para você? Se você não recebeu o email, estaremos felizes em enviar outro.',
                'verification_link_sent' => 'Um novo link de verificação foi enviado para o endereço de email que você forneceu em suas configurações de perfil.',
            ],
        ],

        'profile' => [
            'connected_accounts' => [
                'has_connected_accounts' => 'Suas contas conectadas.',
                'no_connected_accounts' => 'Você não tem contas conectadas.',
            ],

            'two_factor_authentication' => [
                'enabled' => 'Você ativou a autenticação de dois fatores!',
                'finish_enabling' => 'Finalize a ativação da autenticação de dois fatores.',
                'not_enabled' => 'Você não ativou a autenticação de dois fatores.',
            ],

            'update_profile_information' => [
                'verification_link_not_sent' => 'Antes que seu email possa ser atualizado, você deve verificar seu endereço de email atual.',
                'verification_link_sent' => 'Um novo link de verificação foi enviado para o seu endereço de email.',
            ],
        ],

        'tokens' => [
            'token_manager' => [
                'manage_tokens' => 'Gerenciar Tokens de Acesso Pessoal',
            ],
        ],

        'tenants' => [
            'tenant_employee_manager' => [
                'manage_employees' => 'Gerenciar Funcionários',
                'pending_invitations' => 'Convites Pendentes',
            ],
        ],
    ],

    'subheadings' => [
        'auth' => [
            'forgot_password' => 'Basta nos informar seu endereço de email e nós lhe enviaremos um link para redefinir a senha que permitirá que você escolha uma nova.',
            'login' => 'Ou',
            'register' => 'Eu concordo com os :terms_of_service e com a :privacy_policy',
        ],

        'profile' => [
            'two_factor_authentication' => [
                'enabled' => 'A autenticação de dois fatores está agora ativada. Escaneie o seguinte código QR usando o aplicativo autenticador do seu telefone ou insira a chave de configuração.',
                'finish_enabling' => 'Para finalizar a ativação da autenticação de dois fatores, escaneie o seguinte código QR usando o aplicativo autenticador do seu telefone ou insira a chave de configuração e forneça o código OTP gerado.',
                'store_codes' => 'Armazene estes códigos de recuperação em um gerenciador de senhas seguro. Eles podem ser usados para recuperar o acesso à sua conta se seu dispositivo de autenticação de dois fatores for perdido.',
                'summary' => 'Quando a autenticação de dois fatores está ativada, você será solicitado a fornecer um token seguro e aleatório durante a autenticação. Você pode recuperar esse token no aplicativo Google Authenticator do seu telefone.',
            ],

            'connected_accounts' => 'Você pode conectar quaisquer contas sociais ao seu perfil e remover qualquer conta conectada a qualquer momento. Se você sentir que alguma de suas contas conectadas foi comprometida, deve desconectá-la imediatamente e alterar sua senha.',
            'delete_user' => 'Uma vez que sua conta é excluída, todos os seus recursos e dados serão permanentemente excluídos. Antes de excluir sua conta, faça o download de qualquer dado ou informação que você deseje manter.',
            'logout_other_browser_sessions' => 'Se necessário, você pode sair de todas as suas outras sessões do navegador em todos os seus dispositivos. Algumas de suas sessões recentes estão listadas abaixo; no entanto, esta lista pode não ser exaustiva. Se você sentir que sua conta foi comprometida, você também deve atualizar sua senha.',
        ],

        'tenants' => [
            'tenant_employee_manager' => 'Por favor, forneça o endereço de email da pessoa que você gostaria de adicionar a esta empresa.',
            'delete_tenant' => 'Uma vez que uma empresa é excluída, todos os seus recursos e dados serão permanentemente excluídos. Antes de excluir esta empresa, por favor, faça o download de qualquer dado ou informação sobre esta empresa que você deseje manter.',
        ],
    ],
];
