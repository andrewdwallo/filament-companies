<?php

return [
    'fields' => [
        'code' => 'コード',
        'current_password' => '既存のパスワード',
        'email' => 'メールアドレス',
        'name' => '名前',
        'password' => 'パスワード',
        'recovery_code' => '復元コード',
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
        'email_password_reset_link' => 'パスーワド再設定リンクを送信する',
        'enable' => '有効にする',
        'leave' => '退社する',
        'login' => 'ログイン',
        'logout' => 'ログアウト',
        'logout_browser_sessions' => '他のブラウザーからログアウト',
        'new_photo' => '写真追加',
        'permissions' => '許可',
        'register' => '登録',
        'regenerate_recovery_codes' => '復元コードを再生する',
        'remember_me' => 'ログイン状態を維持する',
        'remove' => 'Remove',
        'remove_connected_account' => '連携中のアカウントを削除する',
        'remove_photo' => '写真削除',
        'reset_password' => 'パスワード再設定',
        'resend_verification_email' => '承認メールを再送する',
        'revoke' => '取り消す',
        'save' => '保存',
        'show_recovery_codes' => '復元コードを見せる',
        'use_authentication_code' => '認証コードを使用する',
        'use_avatar_as_profile_photo' => 'アバター画像を使用する',
        'use_recovery_code' => '復元コードを使用する',
    ],

    'labels' => [
        'company_name' => '会社名',
        'company_owner' => '会社主',
        'connected' => '接続済み',
        'created_at' => '登録日',
        'last_active' => '最新活動記録',
        'last_used' => '最新利用記録',
        'last_used_at' => '最新利用場所',
        'new_password' => '新規パスワード',
        'not_connected' => '接続してません',
        'password_confirmation' => 'パスワード確認',
        'permissions' => '許可',
        'photo' => '写真',
        'role' => '役割',
        'setup_key' => '設定キー',
        'this_device' => 'この端末',
        'token_name' => 'トークン名',
        'unknown' => '不明',
        'updated_at' => '更新記録',
    ],

    'links' => [
        'already_registered' => 'アカウントお持ちですか？',
        'edit_profile' => 'プロフィール設定',
        'forgot_your_password' => 'パスワードお忘れですか？',
        'privacy_policy' => 'プライバシー・ポリシー',
        'register_an_account' => 'アカウント登録',
        'terms_of_service' => '利用規約',
    ],

    'errors' => [
        'cannot_leave_company' => '登録した会社からは退社できません。',
        'company_deletion' => 'パーソナル会社の削除は不可能です。',
        'email_already_associated_with_another_account' => 'ご指定のメールアドレスがすでに使われています。 ログインして:Providerアカウントを接続してください。',
        'email_not_found' => 'ご指定のメールアドレスに該当するユザーが見つかりませんでした。',
        'employee_already_belongs_to_company' => '登録済み社員です。',
        'employee_already_invited' => '正体済み社員です。',
        'invalid_password' => 'パスワードが不正です。',
        'no_email_associated_with_provider_account' => ':Providerに該当するアカウントが見つかりませんでした。別のメールアドレスをお試しください。',
        'password_does_not_match' => 'パスワードが間違っています。',
        'provider_sign_in_already_associated_with_account' => ':Providerのアカウントがすでに存在しています, ログインしてください。',
        'provider_sign_in_already_connected' => 'ご指定のメールアドレスに該当するアカウントがすでに使われています。ログインして:Providerアカウントを接続してください。',
        'provider_sign_in_not_found' => 'ご指定の:Providerアカウントが見つかりませんでした。アカウント登録、もしくは別のログイン方法をお試しください。',
        'user_belongs_to_company' => 'ご指定ユザーがすでに所属社員として登録されています。',
        'valid_role' => ':attributeが正当な役割である必要があります。',
    ],

    'descriptions' => [
        'token_created_state' => 'ユザー名:user_nameが:time_agoにトークンを生成',
        'token_last_used_state' => '最新利用記録:time_ago',
        'token_never_used' => '未使用',
        'token_updated_state' => ':time_agoに更新',
    ],

    'banner' => [
        'company_invitation_accepted' => 'おめでとう! **:company**の招待状が受理されました！',
    ],

    'notifications' => [
        'api_token_created' => [
            'title' => 'APIトークン発行完了',
            'body' => 'APIトークン「**:name**」が発行されました',
        ],

        'api_token_updated' => [
            'title' => 'APIトークン更新完了',
            'body' => 'APIトークンが無事更新されました',
        ],

        'browser_sessions_terminated' => [
            'title' => 'その他ブラウザーからログアウト完了',
            'body' => 'セキュリティーのため、その他ブラウザーからログアウトしました',
        ],

        'company_created' => [
            'title' => '会社登録完了',
            'body' => '新規会社「**:name**」を登録しました',
        ],

        'company_deleted' => [
            'title' => '会社削除完了',
            'body' => '「**:name**」を削除しました',
        ],

        'company_invitation_sent' => [
            'title' => '招待リンク送信完了',
            'body' => '**:email**に招待リンクが送信されました',
        ],

        'company_name_updated' => [
            'title' => '会社名更新完了',
            'body' => '会社名を**:name**に変更しました',
        ],

        'connected_account_removed' => [
            'title' => 'アカウント削除完了',
            'body' => 'アカウント連携を無事取り消しました。',
        ],

        'password_set' => [
            'title' => 'パスワード設定完了',
            'body' => 'これでアカウントがパスワードで保護されています。ページを更新してください。',
        ],

        'password_updated' => [
            'title' => 'パスワード更新完了',
            'body' => 'パスワードが無事更新されました。',
        ],

        'profile_information_updated' => [
            'title' => 'アカウント情報更新完了',
            'body' => 'アカウント情報が無事更新されました。',
        ],

        'provider_sign_in_already_associated_with_your_user' => [
            'title' => 'おっと！',
            'body' => ':Providerが既にあなたのアカウントと連携されています。',
        ],

        'provider_sign_in_belongs_to_another_user' => [
            'title' => 'おっと！',
            'body' => ':Providerが使用済みです。別のアカウント名義をご使用ください。',
        ],

        'provider_sign_in_successfully_connected' => [
            'title' => '成功！',
            'body' => ':Providerを無事連携できました。',
        ],

        'verification_link_sent' => [
            'title' => '認証リンク送信！',
            'body' => 'ご登録のメールアドレスに認証リンクを送信いたしました。',
        ],
    ],

    'navigation' => [
        'headers' => [
            'manage_company' => '会社設定',
            'switch_companies' => '会社を切り替える',
        ],

        'links' => [
            'api_tokens' => 'APIトークン一覧',
            'company_settings' => '会社設定',
            'create_company' => '新規会社追加',
        ],
    ],

    'pages' => [
        'titles' => [
            'api_tokens' => 'APIトークン一覧',
            'create_company' => '新規会社追加',
            'company_settings' => '会社設定',
            'profile' => 'プロフィール',
        ],
    ],

    'grid_section_titles' => [
        'add_company_employee' => '職員追加',
        'browser_sessions' => 'ブラウザーセッション',
        'company_name' => '社名',
        'create_api_token' => 'APIトークン発行',
        'create_company' => '会社を追加',
        'delete_account' => 'アカウント削除',
        'profile_information' => 'プロフィール情報',
        'set_password' => 'パスワード設定',
        'two_factor_authentication' => '2ファクター認証',
        'update_password' => 'パスワード更新',
    ],

    'grid_section_descriptions' => [
        'add_company_employee' => '社員を追加して協力します。',
        'browser_sessions' => 'その他デバイスやブラウザーのセッション管理。',
        'company_name' => "会社の名前とオーナー情報",
        'create_api_token' => 'APIトークンは第三者にあなたを代弁して情報アクセス権限を付与します。',
        'create_company' => '新規会社を登録して社員を招待する。',
        'delete_account' => 'アカウントを完全消去します。',
        'profile_information' => "会社情報やメールアドレスを更新します。",
        'set_password' => 'パスワードは出来るだけ長く、ランダム性重視してください。',
        'two_factor_authentication' => '2ファクター認証追加してさらにセキュリティーをアップ！',
        'update_password' => 'パスワードは出来るだけ長く、ランダム性重視してください。',
    ],

    'action_section_titles' => [
        'company_employees' => '職員一覧',
        'connected_accounts' => '連携中アカウント一覧',
        'delete_company' => '会社削除',
        'pending_company_invitations' => '未受諾の招待状',
    ],

    'action_section_descriptions' => [
        'company_employees' => '会社に所属するメンバー一覧',
        'connected_accounts' => '連携アカウント管理画面',
        'delete_company' => '会社登録情報を完全に削除する',
        'pending_company_invitations' => '招待メールが送信されたメンバー一覧。まだメール内受諾リンクをクリックしていません。',
    ],

    'modal_titles' => [
        'api_token' => 'APIトークン',
        'api_token_permissions' => 'APIトークン許可',
        'confirm_password' => 'パスワード確認',
        'delete_api_token' => 'APIトークン削除',
        'delete_account' => 'アカウント削除',
        'delete_company' => '会社削除',
        'leave_company' => '退社する',
        'logout_browser_sessions' => 'その他ブラウザーでのログイン状態を無効にする',
        'manage_role' => '役割設定',
        'remove_company_employee' => '社員削除',
        'remove_connected_account' => '連携アカウント解除',
        'revoke_api_tokens' => 'トークンの無効化',
    ],

    'modal_descriptions' => [
        'api_token' => "APIトークンをコピーしてください。セキュリティー上の理由により、一度しか表示されません。",
        'confirm_password' => '安全のため、パスワード認証ください。',
        'delete_account' => 'アカウントを削除するにはパスワード認証が必要です。',
        'delete_api_token' => 'APIトークンを削除してよろしいでしょうか？',
        'delete_company' => '会社を削除してよろしいでしょうか？',
        'leave_company' => '退社してよろしいでしょうか？',
        'logout_browser_sessions' => 'その他セッションを無効するにはパスワード認証が必要です。',
        'remove_company_employee' => 'この方を社員会社リストから削除してよろしいでしょうか？',
        'remove_connected_account' => 'アカウントを削除してよろしいでしょうか？復元は出来ません。',
        'revoke_api_tokens' => 'パスワード認証が必要です。',
    ],

    'headings' => [
        'auth' => [
            'confirm_password' => 'アプリの保護エリアです、パスワード承認してください。',
            'forgot_password' => 'パスワードお忘れですか？',
            'login' => 'アカウントにログインする。',
            'register' => 'アカウントを登録する。',
            'two_factor_challenge' => [
                'authentication_code' => '本人確認のため、2ファクター認証アプリのコードをご入力ください。',
                'emergency_recovery_code' => '本人確認のため、緊急復元コードをご入力ください。',
            ],
            'verify_email' => [
                'verification_link_not_sent' => "続きはメールアドレス認証が必要です。メール箱を確認し、認証リンクをクリックしてください。メールが届いてない場合、再送が可能です。",
                'verification_link_sent' => 'プロフィール設定のメールアドレス宛に認証メールが送信されました。',
            ],
        ],

        'profile' => [
            'connected_accounts' => [
                'has_connected_accounts' => '連携中アカウント。',
                'no_connected_accounts' => '連携中のアカウントがありません。',
            ],

            'two_factor_authentication' => [
                'enabled' => '2ファクター認証を有効にしました!',
                'finish_enabling' => '2ファクタ認証有効にする',
                'not_enabled' => '2ファクター認証が無効になています',
            ],

            'update_profile_information' => [
                'verification_link_not_sent' => 'メールアドレスを変更する前に、ご登録中のメールアドレスの持ち主であることを証明する必要があります。',
                'verification_link_sent' => '確認用のリンクがご登録中のメールアドレスに送信されました。',
            ],
        ],

        'api' => [
            'api_token_manager' => [
                'manage_api_tokens' => 'APIトークン管理',
            ],
        ],

        'companies' => [
            'company_employee_manager' => [
                'manage_employees' => '職員管理',
                'pending_invitations' => '受諾待ちの招待状',
            ],
        ],
    ],

    'subheadings' => [
        'auth' => [
            'forgot_password' => 'パスワード再設定リンクを送信するには、ご登録中のメールアドレスを指定する必要があります。',
            'login' => 'または',
            'register' => '利用規約:terms_of_serviceと:privacy_policyに賛成する。',
        ],

        'profile' => [
            'two_factor_authentication' => [
                'enabled' => "2ファクター認証有効です。QRコードをスキャンするか設定キーをご入力ください。",
                'finish_enabling' => "2ファクター認証を有効するには、QRコードをスキャンするか、 設定キーを入力しワンタイムパスワードをご提供ください。",
                'store_codes' => '復元コードを出来るだけ安全な場所に保管し、2ファクター認証が使えなくなった時に使えます。',
                'summary' => "2ファクター認証が有効の場合、認証時にランダムトークンが必要になります。携帯のGoogle Authenticatorよりご確認いただけます。",
            ],

            'connected_accounts' => 'ソーシャルアカウントの連携がいつでも可能です。連携アカウント情報が漏洩している可能性がある場合、連携をキャンセルしパスワードを変更するようお勧めします。',
            'delete_user' => 'アカウントが削除されたら、すべての関連データが完全消去されます。削除の前に残したいデーターを保存してください。',
            'logout_other_browser_sessions' => '必要に応じて、すべてのデバイスからログアウトすることが可能です。一覧に表示されている情報が完全でない可能性があります。アカウント情報が漏洩していると思われる場合、パスワードを変更するようお勧めします。',
        ],

        'companies' => [
            'company_employee_manager' => '招待したい方のメールアドレスをご入力ください。',
            'delete_company' => '会社を削除したら、すべての関連データが完全消去されます。削除の前に残したいデーターを保存してください。',
        ],
    ],
];
