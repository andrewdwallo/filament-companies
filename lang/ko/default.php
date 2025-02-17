<?php

return [
    'fields' => [
        'code' => '코드',
        'current_password' => '현재 비밀번호',
        'email' => '이메일',
        'name' => '이름',
        'password' => '비밀번호',
        'recovery_code' => '복구 코드',
    ],

    'buttons' => [
        'add' => '추가',
        'cancel' => '취소',
        'close' => '닫기',
        'connect' => '연결',
        'confirm' => '확인',
        'create' => '생성',
        'create_token' => '토큰 생성',
        'delete' => '삭제',
        'delete_account' => '계정 삭제',
        'delete_company' => '회사 삭제',
        'disable' => '비활성화',
        'done' => '완료',
        'edit' => '편집',
        'email_password_reset_link' => '이메일 비밀번호 재설정 링크',
        'enable' => '활성화',
        'leave' => '나가기',
        'login' => '로그인',
        'logout' => '로그아웃',
        'logout_browser_sessions' => '다른 브라우저 세션 로그아웃',
        'new_photo' => '새로운 사진',
        'permissions' => '권한',
        'register' => '등록',
        'regenerate_recovery_codes' => '복구 코드 재생성',
        'remember_me' => '기억하기',
        'remove' => '제거',
        'remove_connected_account' => '연결된 계정 제거',
        'remove_photo' => '사진 제거',
        'reset_password' => '비밀번호 재설정',
        'resend_verification_email' => '인증 이메일 재전송',
        'revoke' => '폐지',
        'save' => '저장',
        'show_recovery_codes' => '복구 코드 표시',
        'use_authentication_code' => '인증 코드 사용',
        'use_avatar_as_profile_photo' => '아바타 사용',
        'use_recovery_code' => '복구 코드 사용',
    ],

    'labels' => [
        'company_name' => '회사명',
        'company_owner' => '회사 소유자',
        'connected' => '연결됨',
        'created_at' => '생성일',
        'last_active' => '최근 활동',
        'last_used' => '최근 사용',
        'last_used_at' => '최근 사용 날짜',
        'new_password' => '새 비밀번호',
        'not_connected' => '연결 안됨.',
        'password_confirmation' => '비밀번호 확인',
        'permissions' => '권한',
        'photo' => '사진',
        'role' => '역할',
        'setup_key' => '설정 키',
        'this_device' => '이 장치',
        'token_name' => '토큰명',
        'unknown' => '알 수 없음',
        'updated_at' => '업데이트 날짜',
    ],

    'links' => [
        'already_registered' => '이미 등록되었나요?',
        'edit_profile' => '프로필 편집',
        'forgot_your_password' => '비밀번호를 잊으셨나요?',
        'privacy_policy' => '개인정보 처리방침',
        'register_an_account' => '계정 등록',
        'terms_of_service' => '이용약관',
    ],

    'errors' => [
        'cannot_leave_company' => '생성한 회사를 떠날 수 없습니다.',
        'company_deletion' => '개인 회사를 삭제할 수 없습니다.',
        'email_already_associated' => '해당 이메일 주소로 이미 계정이 존재합니다. :Provider 계정을 연결하려면 로그인하십시오.',
        'email_not_found' => '등록된 사용자 이메일 주소를 찾을 수 없습니다.',
        'employee_already_belongs_to_company' => '이 직원은 이미 회사에 속해 있습니다.',
        'employee_already_invited' => '이 직원은 이미 회사로 초대되었습니다.',
        'invalid_password' => '제공된 비밀번호가 잘못되었습니다.',
        'no_email_with_account' => '해당 :Provider 계정에 연결된 이메일 주소가 없습니다. 다른 계정을 시도하십시오.',
        'password_does_not_match' => '제공된 비밀번호가 현재 비밀번호와 일치하지 않습니다.',
        'already_associated_account' => '해당 :Provider 로그인으로 이미 계정이 연결되어 있습니다. 로그인하십시오.',
        'already_connected' => '해당 이메일 주소로 이미 계정이 존재합니다. :Provider 계정을 연결하려면 로그인하십시오.',
        'signin_not_found' => '해당 :Provider 로그인과 관련된 계정을 찾을 수 없습니다. 등록하거나 다른 로그인 방법을 시도하십시오.',
        'user_belongs_to_company' => '이 사용자는 이미 회사에 속해 있습니다.',
        'valid_role' => ':attribute 는 유효한 역할이어야 합니다.',
    ],

    'descriptions' => [
        'token_created_state' => ':user_name 님이 :time_ago 에 생성.',
        'token_last_used_state' => ':time_ago 에 마지막 사용',
        'token_never_used' => '사용 기록 없음',
        'token_updated_state' => ':time_ago 에 업데이트됨',
    ],

    'banner' => [
        'company_invitation_accepted' => '**:company** 에 대한 초대를 수락했습니다.',
    ],

    'notifications' => [
        'token_created' => [
            'title' => '개인 액세스 토큰이 생성됨',
            'body' => '**:name** 이라는 새로운 개인 액세스 토큰이 생성되었습니다.',
        ],

        'token_updated' => [
            'title' => '개인 액세스 토큰이 업데이트됨',
            'body' => '개인 액세스 토큰이 성공적으로 업데이트되었습니다.',
        ],

        'browser_sessions_terminated' => [
            'title' => '브라우저 세션이 종료됨',
            'body' => '보안을 위해 다른 브라우저 세션에서 계정이 로그아웃되었습니다.',
        ],

        'company_created' => [
            'title' => '회사가 생성됨',
            'body' => '**:name** 이라는 새로운 회사가 생성되었습니다.',
        ],

        'company_deleted' => [
            'title' => '회사가 삭제됨',
            'body' => '**:name** 이라는 회사가 삭제되었습니다.',
        ],

        'company_invitation_sent' => [
            'title' => '초대가 전송됨',
            'body' => '**:email** 님에게 회사에 가입할 수 있는 초대가 전송되었습니다.',
        ],

        'company_name_updated' => [
            'title' => '회사가 업데이트됨',
            'body' => '회사 이름이 **:name** 으로 업데이트되었습니다.',
        ],

        'connected_account_removed' => [
            'title' => '연결된 계정이 제거됨',
            'body' => '연결된 계정이 성공적으로 제거되었습니다.',
        ],

        'password_set' => [
            'title' => '비밀번호가 설정됨',
            'body' => '계정이 이제 비밀번호로 보호됩니다. 설정을 업데이트하려면 잠시 후에 페이지가 자동으로 새로 고쳐집니다.',
        ],

        'password_updated' => [
            'title' => '비밀번호가 업데이트됨',
            'body' => '비밀번호가 성공적으로 업데이트되었습니다.',
        ],

        'profile_information_updated' => [
            'title' => '프로필 정보가 업데이트됨',
            'body' => '프로필 정보가 성공적으로 업데이트되었습니다.',
        ],

        'already_associated' => [
            'title' => '이미 연결됨!',
            'body' => '해당 :Provider 로그인 계정은 이미 사용자에 연결되어 있습니다.',
        ],

        'belongs_to_other_user' => [
            'title' => '이미 연결됨!',
            'body' => '해당 :Provider 로그인 계정은 이미 다른 사용자에 연결되어 있습니다. 다른 계정을 시도하십시오.',
        ],

        'successfully_connected' => [
            'title' => '성공!',
            'body' => '계정에 :Provider 이(가) 성공적으로 연결되었습니다.',
        ],

        'verification_link_sent' => [
            'title' => '인증 링크가 전송됨',
            'body' => '새로운 인증 링크가 제공된 이메일 주소로 전송되었습니다.',
        ],
    ],

    'navigation' => [
        'headers' => [
            'manage_company' => '회사 관리',
            'switch_companies' => '회사 전환',
        ],

        'links' => [
            'tokens' => '개인 액세스 토큰',
            'company_settings' => '회사 설정',
            'create_company' => '회사 생성',
        ],
    ],

    'pages' => [
        'titles' => [
            'tokens' => '개인 액세스 토큰',
            'create_company' => '회사 생성',
            'company_settings' => '회사 설정',
            'profile' => '프로필',
        ],
    ],

    'grid_section_titles' => [
        'add_company_employee' => '회사 직원 추가',
        'browser_sessions' => '브라우저 세션',
        'company_name' => '회사 이름',
        'create_token' => '개인 액세스 토큰 생성',
        'create_company' => '회사 생성',
        'delete_account' => '계정 삭제',
        'profile_information' => '프로필 정보',
        'set_password' => '비밀번호 설정',
        'two_factor_authentication' => '이중 인증',
        'update_password' => '비밀번호 업데이트',
    ],

    'grid_section_descriptions' => [
        'add_company_employee' => '회사에 새 직원을 추가하여 협업을 할 수 있습니다.',
        'browser_sessions' => '다른 브라우저 및 장치에서 활성 세션을 관리하고 로그아웃합니다.',
        'company_name' => '회사 이름 및 소유자 정보입니다.',
        'create_token' => '개인 액세스 토큰을 사용하여 타사 서비스가 응용 프로그램에 대해 사용자를 인증할 수 있습니다.',
        'create_company' => '다른 사용자와 프로젝트를 협업하기 위해 새로운 회사를 생성합니다.',
        'delete_account' => '계정을 영구적으로 삭제합니다.',
        'profile_information' => '계정 프로필 정보 및 이메일 주소를 업데이트합니다.',
        'set_password' => '보안을 유지하기 위해 계정에 긴 무작위 비밀번호를 사용합니다.',
        'two_factor_authentication' => '이중 인증을 사용하여 계정에 추가 보안을 추가합니다.',
        'update_password' => '보안을 유지하기 위해 계정에 긴 무작위 비밀번호를 사용합니다.',
    ],

    'action_section_titles' => [
        'company_employees' => '회사 직원',
        'connected_accounts' => '연결된 계정',
        'delete_company' => '회사 삭제',
        'pending_company_invitations' => '대기 중인 회사 초대',
    ],

    'action_section_descriptions' => [
        'company_employees' => '이 회사에 속한 모든 사람들입니다.',
        'connected_accounts' => '연결된 계정을 관리하고 제거합니다.',
        'delete_company' => '이 회사를 영구적으로 삭제합니다.',
        'pending_company_invitations' => '이 사람들은 회사로 초대되었으며 초대 이메일이 전송되었습니다. 이메일 초대를 수락하여 회사에 가입할 수 있습니다.',
    ],

    'modal_titles' => [
        'token' => '개인 액세스 토큰',
        'token_permissions' => '개인 액세스 토큰 권한',
        'confirm_password' => '비밀번호 확인',
        'delete_token' => '개인 액세스 토큰 삭제',
        'delete_account' => '계정 삭제',
        'delete_company' => '회사 삭제',
        'leave_company' => '회사 나가기',
        'logout_browser_sessions' => '다른 브라우저 세션 로그아웃',
        'manage_role' => '역할 관리',
        'remove_company_employee' => '회사 직원 제거',
        'remove_connected_account' => '연결된 계정 제거',
        'revoke_tokens' => '토큰 폐지',
    ],

    'modal_descriptions' => [
        'copy_token' => '새 개인 액세스 토큰을 복사하십시오. 보안을 위해 다시 표시되지 않습니다.',
        'confirm_password' => '보안을 위해 계속하기 전에 비밀번호를 확인하십시오.',
        'delete_account' => '계정을 삭제하려면 비밀번호를 입력하십시오.',
        'delete_token' => '이 개인 액세스 토큰을 삭제하시겠습니까?',
        'delete_company' => '이 회사를 삭제하시겠습니까?',
        'leave_company' => '이 회사를 나가시겠습니까?',
        'logout_browser_sessions' => '다른 브라우저 세션에서 로그아웃하려면 비밀번호를 입력하십시오.',
        'remove_company_employee' => '이 사람을 회사에서 제거하시겠습니까?',
        'remove_connected_account' => '이 계정을 제거하시겠습니까? 이 작업은 되돌릴 수 없습니다.',
        'revoke_tokens' => '확인하려면 비밀번호를 입력하십시오.',
    ],

    'headings' => [
        'auth' => [
            'confirm_password' => '앱의 안전한 영역입니다. 계속하기 전에 비밀번호를 확인하세요.',
            'forgot_password' => '비밀번호를 잊으셨나요?',
            'login' => '계정에 로그인합니다',
            'register' => '계정을 등록합니다',
            'two_factor_challenge' => [
                'authentication_code' => '인증기 애플리케이션에서 제공하는 인증 코드를 입력하여 계정 액세스를 확인하세요.',
                'emergency_recovery_code' => '비상 복구 코드 중 하나를 입력하여 계정 액세스를 확인하세요.',
            ],
            'verify_email' => [
                'verification_link_not_sent' => '계속하기 전에 이메일 주소를 확인하려면 우리가 방금 보낸 링크를 클릭해주시겠습니까? 이메일을 받지 못한 경우 다른 이메일을 보내드리겠습니다.',
                'verification_link_sent' => '프로필 설정에서 제공한 이메일 주소로 새로운 확인 링크가 전송되었습니다.',
            ],
        ],

        'profile' => [
            'connected_accounts' => [
                'has_connected_accounts' => '연결된 계정이 있습니다.',
                'no_connected_accounts' => '연결된 계정이 없습니다.',
            ],

            'two_factor_authentication' => [
                'enabled' => '이중 인증이 활성화되었습니다!',
                'finish_enabling' => '이중 인증을 마무리하십시오.',
                'not_enabled' => '이중 인증이 활성화되지 않았습니다.',
            ],

            'update_profile_information' => [
                'verification_link_not_sent' => '이메일을 업데이트하려면 현재 이메일 주소를 확인해야 합니다.',
                'verification_link_sent' => '이메일 주소로 새로운 확인 링크가 전송되었습니다.',
            ],
        ],

        'tokens' => [
            'token_manager' => [
                'manage_tokens' => '개인 액세스 토큰 관리',
            ],
        ],

        'companies' => [
            'company_employee_manager' => [
                'manage_employees' => '직원 관리',
                'pending_invitations' => '대기 중인 초대',
            ],
        ],
    ],

    'subheadings' => [
        'auth' => [
            'forgot_password' => '이메일 주소를 알려주시면 새로운 비밀번호를 선택할 수 있는 비밀번호 재설정 링크를 이메일로 보내드립니다.',
            'login' => '또는',
            'register' => ':terms_of_service 및 :privacy_policy에 동의합니다.',
        ],

        'profile' => [
            'two_factor_authentication' => [
                'enabled' => '이중 인증이 활성화되었습니다. 휴대전화의 인증기 애플리케이션을 사용하여 다음 QR 코드를 스캔하거나 설정 키를 입력하십시오.',
                'finish_enabling' => '이중 인증을 마무리하려면 휴대전화의 인증기 애플리케이션을 사용하여 다음 QR 코드를 스캔하거나 설정 키를 입력하고 생성된 OTP 코드를 제공하십시오.',
                'store_codes' => '이 복구 코드를 안전한 비밀번호 관리자에 저장하십시오. 이 코드는 이중 인증 장치를 잃어버린 경우 계정 액세스를 복구하는 데 사용할 수 있습니다.',
                'summary' => '이중 인증이 활성화되면 인증 중에 안전한 무작위 토큰을 입력하라는 메시지가 표시됩니다. 이 토큰은 휴대전화의 Google Authenticator 애플리케이션에서 검색할 수 있습니다.',
            ],

            'connected_accounts' => '프로필에 연결할 수 있는 모든 소셜 계정이 있습니다. 연결된 계정을 언제든지 제거할 수 있습니다. 연결된 계정 중에 침해당한 것으로 생각되는 경우 즉시 연결을 해제하고 비밀번호를 변경해야 합니다.',
            'delete_user' => '계정을 삭제하면 모든 리소스와 데이터가 영구적으로 삭제됩니다. 계정을 삭제하기 전에 보존할 데이터나 정보를 다운로드하세요.',
            'logout_other_browser_sessions' => '필요한 경우 모든 기기의 모든 브라우저 세션에서 로그아웃할 수 있습니다. 최근 세션 목록이 아래에 나와 있지만 이 목록이 완전하지 않을 수 있습니다. 계정이 침해당했다고 생각되면 비밀번호를 변경해야 합니다.',
        ],

        'companies' => [
            'company_employee_manager' => '이 회사에 추가하려는 사람의 이메일 주소를 제공하십시오.',
            'delete_company' => '회사를 삭제하면 모든 리소스와 데이터가 영구적으로 삭제됩니다. 이 회사를 삭제하기 전에 보존할 데이터나 정보를 다운로드하세요.',
        ],
    ],
];
