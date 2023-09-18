<?php

return [
    'fields' => [
        'code' => 'コード',
        'current_password' => '既存のパスワード',
        'email' => 'メールアドレス',
        'name' => '名前',
        'password' => 'パスワード',
        'recovery_code' => '回復用コード',
    ],

    'buttons' => [
        'add' => '追加',
        'cancel' => 'キャンセル',
        'close' => '閉じる',
        'connect' => '連携',
        'confirm' => '確認',
        'create' => '作成',
        'create_token' => 'トークン発行',
        'delete' => '削除',
        'delete_account' => 'アカウント削除',
        'delete_company' => '会社を削除',
        'disable' => '無効にする',
        'done' => '完了',
        'edit' => '編集',
        'email_password_reset_link' => 'パスワード再設定用リンクを送信する',
        'enable' => '有効にする',
        'leave' => '退社する',
        'login' => 'ログイン',
        'logout' => 'ログアウト',
        'logout_browser_sessions' => '他のブラウザからログアウト',
        'new_photo' => '写真追加',
        'permissions' => '許可',
        'register' => '登録',
        'regenerate_recovery_codes' => '回復用コードを再生成する',
        'remember_me' => 'ログイン状態を維持する',
        'remove' => '連携解除',
        'remove_connected_account' => 'アカウントの連携を解除する',
        'remove_photo' => '写真削除',
        'reset_password' => 'パスワード再設定',
        'resend_verification_email' => '本人確認用メールを再送する',
        'revoke' => '取り消す',
        'save' => '保存',
        'show_recovery_codes' => '回復用コードを見せる',
        'use_authentication_code' => '認証用コードを使用する',
        'use_avatar_as_profile_photo' => 'アバター画像を使用する',
        'use_recovery_code' => '回復用コードを使用する',
    ],

    'labels' => [
        'company_name' => '会社名',
        'company_owner' => '会社オーナー',
        'connected' => '接続済み',
        'created_at' => '登録日',
        'last_active' => '最新活動日',
        'last_used' => '最新利用日',
        'last_used_at' => '最新利用場所',
        'new_password' => '新規パスワード',
        'not_connected' => '接続されていません',
        'password_confirmation' => 'パスワード確認',
        'permissions' => '許可',
        'photo' => '写真',
        'role' => '役割',
        'setup_key' => '設定キー',
        'this_device' => 'この端末',
        'token_name' => 'トークン名',
        'unknown' => '不明',
        'updated_at' => '最終更新日',
    ],

    'links' => [
        'already_registered' => 'すでにアカウントをお持ちですか？',
        'edit_profile' => 'プロフィール編集',
        'forgot_your_password' => 'パスワードをお忘れですか？',
        'privacy_policy' => 'プライバシー・ポリシー',
        'register_an_account' => 'アカウント登録',
        'terms_of_service' => '利用規約',
    ],

    'errors' => [
        'cannot_leave_company' => 'あなた自身が登録した会社からの退社はできません。',
        'company_deletion' => 'デフォルトの会社は削除できません。',
        'email_already_associated' => 'ご指定のメールアドレスはすでに登録されています。 :Providerアカウントにログインしてください。',
        'email_not_found' => 'ご指定のメールアドレスで登録されているユーザーは見つかりませんでした。',
        'employee_already_belongs_to_company' => 'このユーザーは社員として登録済みです。',
        'employee_already_invited' => 'このユーザーは社員として招待済みです。',
        'invalid_password' => 'パスワードが無効です。',
        'no_email_with_account' => ':Providerに該当するメールアドレスは見つかりませんでした。別のアカウントをお試しください。',
        'password_does_not_match' => 'パスワードが間違っています。',
        'already_associated_account' => 'アカウント:Providerはすでに存在しています。ログインしてください。',
        'already_connected' => 'ご指定のメールアドレスに該当するアカウントはすでに存在しています。:Providerにログインしてください。',
        'signin_not_found' => 'アカウント:Providerは見つかりませんでした。アカウント登録、もしくは別のログイン方法をお試しください。',
        'user_belongs_to_company' => 'ご指定のユーザーはすでに社員として登録されています。',
        'valid_role' => ':attributeが有効な役割である必要があります。',
    ],

    'descriptions' => [
        'token_created_state' => 'ユーザー名:user_nameが:time_agoにトークンを発行',
        'token_last_used_state' => '最新利用記録:time_ago',
        'token_never_used' => '未使用',
        'token_updated_state' => ':time_agoに更新',
    ],

    'banner' => [
        'company_invitation_accepted' => 'おめでとうございます！ **:company**の招待を受理しました！',
    ],

    'notifications' => [
        'token_created' => [
            'title' => 'APIトークン発行完了',
            'body' => 'APIトークン「**:name**」が発行されました。',
        ],

        'token_updated' => [
            'title' => 'APIトークン更新完了',
            'body' => 'APIトークンが無事更新されました。',
        ],

        'browser_sessions_terminated' => [
            'title' => 'その他ブラウザからログアウト完了',
            'body' => 'セキュリティーのため、その他ブラウザからログアウトしました。',
        ],

        'company_created' => [
            'title' => '会社登録完了',
            'body' => '新規会社「**:name**」を登録しました。',
        ],

        'company_deleted' => [
            'title' => '会社削除完了',
            'body' => '「**:name**」を削除しました。',
        ],

        'company_invitation_sent' => [
            'title' => '招待リンク送信完了',
            'body' => '**:email**に招待リンクが送信されました。',
        ],

        'company_name_updated' => [
            'title' => '会社名更新完了',
            'body' => '会社名を**:name**に変更しました。',
        ],

        'connected_account_removed' => [
            'title' => 'アカウント連携解除',
            'body' => 'ご指定のアカウントの連携を無事解除しました。',
        ],

        'password_set' => [
            'title' => 'パスワード設定完了',
            'body' => '現在ご利用のアカウントはパスワードによって保護されています。ページを更新してください。',
        ],

        'password_updated' => [
            'title' => 'パスワード更新完了',
            'body' => 'パスワードが無事更新されました。',
        ],

        'profile_information_updated' => [
            'title' => 'アカウント情報更新完了',
            'body' => 'アカウント情報が無事更新されました。',
        ],

        'already_associated' => [
            'title' => 'おっと！',
            'body' => ':Providerは既にあなたのアカウントと連携されています。',
        ],

        'belongs_to_other_user' => [
            'title' => 'おっと！',
            'body' => ':Providerは他のユーザーによって使用されています。別のアカウントをご使用ください。',
        ],

        'successfully_connected' => [
            'title' => '成功！',
            'body' => 'ご利用のアカウントは:Providerと無事連携できました。',
        ],

        'verification_link_sent' => [
            'title' => '認証用リンク送信！',
            'body' => 'ご登録のメールアドレスに認証用リンクを送信しました。',
        ],
    ],

    'navigation' => [
        'headers' => [
            'manage_company' => '会社設定',
            'switch_companies' => '会社を切り替える',
        ],

        'links' => [
            'tokens' => 'APIトークン一覧',
            'company_settings' => '会社設定',
            'create_company' => '新規会社登録',
        ],
    ],

    'pages' => [
        'titles' => [
            'tokens' => 'APIトークン一覧',
            'create_company' => '新規会社登録',
            'company_settings' => '会社設定',
            'profile' => 'プロフィール',
        ],
    ],

    'grid_section_titles' => [
        'add_company_employee' => '社員追加',
        'browser_sessions' => 'ブラウザセッション',
        'company_name' => '社名',
        'create_token' => 'APIトークン発行',
        'create_company' => '会社を登録',
        'delete_account' => 'アカウント削除',
        'profile_information' => 'プロフィール情報',
        'set_password' => 'パスワード設定',
        'two_factor_authentication' => '２段階認証',
        'update_password' => 'パスワード更新',
    ],

    'grid_section_descriptions' => [
        'add_company_employee' => '会社に社員を追加し、共同でプロジェクトを行えるようにします。',
        'browser_sessions' => 'その他デバイスやブラウザにおけるアカウントのセッションを管理します。',
        'company_name' => '会社の名前とオーナー情報',
        'create_token' => 'APIトークンは第三者にあなたを代表して情報アクセス権限を付与します。',
        'create_company' => '新規会社を登録し、共同でプロジェクトを進めるために社員を招待します。',
        'delete_account' => 'アカウントを完全消去します。',
        'profile_information' => '会社情報やメールアドレスを更新します。',
        'set_password' => 'パスワードはセキュリティのため出来るだけ長くし、ランダム性を重視してください。',
        'two_factor_authentication' => '２段階認証を追加してさらにセキュリティーを強化しましょう！',
        'update_password' => 'パスワードは出来るだけ長く、ランダム性を重視してください。',
    ],

    'action_section_titles' => [
        'company_employees' => '社員一覧',
        'connected_accounts' => '連携中アカウント一覧',
        'delete_company' => '会社削除',
        'pending_company_invitations' => '未受諾の招待',
    ],

    'action_section_descriptions' => [
        'company_employees' => '社員一覧',
        'connected_accounts' => '連携アカウントを管理する',
        'delete_company' => '会社登録情報を完全に削除する',
        'pending_company_invitations' => 'あなたの会社への招待をまだ受諾していないアカウント一覧です。該当のユーザーは受信したメールからあなたの会社へ参加することができます。',
    ],

    'modal_titles' => [
        'token' => 'APIトークン',
        'token_permissions' => 'APIトークン許可',
        'confirm_password' => 'パスワード認証',
        'delete_token' => 'APIトークン削除',
        'delete_account' => 'アカウント削除',
        'delete_company' => '会社削除',
        'leave_company' => '退社する',
        'logout_browser_sessions' => 'その他のブラウザからログアウトする',
        'manage_role' => '役割設定',
        'remove_company_employee' => '社員削除',
        'remove_connected_account' => 'アカウント連携解除',
        'revoke_tokens' => 'トークンの無効化',
    ],

    'modal_descriptions' => [
        'copy_token' => '新規APIトークンをコピーしてください。セキュリティ上の理由により、一度しか表示されません。',
        'confirm_password' => '安全のため、パスワード認証を行ってください。',
        'delete_account' => 'アカウントを削除するにはパスワード認証が必要です。',
        'delete_token' => '本当にAPIトークンを削除してもよろしいですか？',
        'delete_company' => '本当に会社を削除してもよろしいですか？',
        'leave_company' => '本当にこの会社から退社してもよろしいですか？',
        'logout_browser_sessions' => 'その他のブラウザにおけるセッションを無効にするためにパスワード認証を行ってください。',
        'remove_company_employee' => 'このユーザーを社員リストから削除してもよろしいですか？',
        'remove_connected_account' => '本当にアカウントを削除しますか？復元は出来ません。',
        'revoke_tokens' => 'パスワード認証が必要です。',
    ],

    'headings' => [
        'auth' => [
            'confirm_password' => 'ここから先はセキュアエリアです。パスワード認証を行ってください。',
            'forgot_password' => 'パスワードをお忘れですか？',
            'login' => 'アカウントにログイン',
            'register' => 'アカウントを登録',
            'two_factor_challenge' => [
                'authentication_code' => '本人確認のため、２段階認証コードを入力してください。',
                'emergency_recovery_code' => '本人確認のため、回復用コードを入力してください。',
            ],
            'verify_email' => [
                'verification_link_not_sent' => 'これ以降のご利用にはメールアドレス認証が必要となります。メールを送信いたしましたので、認証リンクをクリックしてください。メールが届かない場合、再送することができます。',
                'verification_link_sent' => 'ご指定のメールアドレスに認証用メールが送信されました。',
            ],
        ],

        'profile' => [
            'connected_accounts' => [
                'has_connected_accounts' => '連携中アカウント',
                'no_connected_accounts' => '連携中のアカウントはありません',
            ],

            'two_factor_authentication' => [
                'enabled' => '２段階認証が完了しました！',
                'finish_enabling' => '２段階認証を完了する',
                'not_enabled' => '２段階認証は完了していません',
            ],

            'update_profile_information' => [
                'verification_link_not_sent' => 'メールアドレスを変更する前に、現在ご登録中のメールアドレスの持ち主であることを認証してください。',
                'verification_link_sent' => '認証用のリンクがご登録中のメールアドレスに送信されました。',
            ],
        ],

        'tokens' => [
            'token_manager' => [
                'manage_tokens' => 'APIトークン管理',
            ],
        ],

        'companies' => [
            'company_employee_manager' => [
                'manage_employees' => '社員を管理',
                'pending_invitations' => '受諾待ちの招待',
            ],
        ],
    ],

    'subheadings' => [
        'auth' => [
            'forgot_password' => 'パスワード再設定用リンクを受信するには、ご登録中のメールアドレスを入力してください。',
            'login' => 'または',
            'register' => '利用規約:terms_of_serviceと:privacy_policyに同意します。',
        ],

        'profile' => [
            'two_factor_authentication' => [
                'enabled' => '２段階認証が使用可能です。QRコードをスキャンするかセットアップキーをご入力ください。',
                'finish_enabling' => '２段階認証を完了するには、QRコードをスキャンするか、 セットアップキーを入力し生成されるワンタイムパスワードを使用してください。',
                'store_codes' => '回復用コードは出来るだけ安全な場所に保管してください。２段階認証に必要なデバイスが万一使用できなくなった場合、回復用コードでアカウントへのアクセスを復旧できます。',
                'summary' => '２段階認証を使用する場合、認証時にランダムトークンが必要になります。ランダムトークンはご利用端末のGoogle Authenticatorよりご確認いただけます。',
            ],

            'connected_accounts' => 'ソーシャルアカウントはいつでも連携・連携解除可能です。連携アカウントの安全性が担保されていない場合は連携を直ちに解除しパスワードを変更するようお勧めします。',
            'delete_user' => 'アカウントを削除すると、すべての関連データが抹消されます。実行する前に必要なバックアップを行ってください。',
            'logout_other_browser_sessions' => '必要に応じて、すべてのデバイスから一時的にログアウトすることができます。最近のセッションは一覧に表示されますが情報が完全でない可能性があります。アカウント情報が漏洩していると思われる場合、パスワードを変更するようお勧めします。',
        ],

        'companies' => [
            'company_employee_manager' => '招待したいユーザーのメールアドレスを入力してください。',
            'delete_company' => '会社を削除したら、すべての関連データは抹消されます。実行する前に必要なバックアップを行ってください。',
        ],
    ],
];
