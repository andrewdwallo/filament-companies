<?php

return [
    'fields' => [
        'name' => 'الاسم',
        'email' => 'البريد الإلكتروني',
        'password' => 'كلمة المرور',
        'code' => 'كود',
        'recovery_code' => 'كود الاسترداد',
        'current_password' => 'كلمة السر الحالية',
    ],

    'buttons' => [
        'register' => 'تسجيل',
        'login' => 'تسجيل الدخول',
        'confirm' => 'تأكيد',
        'email_password_reset_link' => 'إرسال رابط إعادة تعيين كلمة المرور عبر البريد الإلكتروني',
        'reset_password' => 'إعادة تعيين كلمة المرور',
        'use_recovery_code' => 'استخدام رمز الاسترداد',
        'use_authentication_code' => 'استخدام رمز المصادقة',
        'resend_verification_email' => 'إعادة إرسال رسالة التحقق',
        'logout' => 'تسجيل الخروج',
        'new_photo' => 'تحديد صورة جديدة',
        'remove_photo' => 'حذف الصورة',
        'save' => 'حفظ',
        'enable' => 'تمكين',
        'regenerate_recovery_codes' => 'إعادة إنشاء رموز الاسترداد',
        'show_recovery_codes' => 'عرض رموز الاسترداد',
        'cancel' => 'إلغاء',
        'disable' => 'تعطيل',
        'logout_browser_sessions' => 'تسجيل الخروج من جلسات المستعرض الأخرى',
        'done' => 'تم.',
        'delete_account' => 'حذف الحساب',
        'create' => 'إنشاء',
        'delete' => 'حذف',
        'permissions' => 'الأذونات',
        'close' => 'إغلاق',
        'add' => 'إضافة',
        'leave' => 'المغادرة',
        'remove' => 'إزالة',
        'delete_company' => 'حذف الشركة',
        'remember_me' => 'تذكرني',
        'use_avatar_as_profile_photo' => 'استخدام الصورة الرمزية كصورة الملف الشخصي',
        'connect' => 'الاتصال',
        'remove_connected_account' => 'إزالة الحساب المتصل',
        'revoke' => 'إلغاء',
        'edit' => 'تعديل',
        'create_token' => 'إنشاء رمز مميز',
    ],

    'labels' => [
        'company_name' => 'اسم الشركة',
        'company_owner' => 'مالك الشركة',
        'setup_key' => 'مفتاح الإعداد',
        'role' => 'الدور',
        'photo' => 'الصورة',
        'password_confirmation' => 'تأكيد كلمة المرور',
        'token_name' => 'اسم الرمز المميز',
        'permissions' => 'الأذونات',
        'new_password' => 'كلمة المرور الجديدة',
        'unknown' => 'غير معروف',
        'this_device' => 'هذا الجهاز',
        'last_active' => 'آخر نشاط',
        'last_used' => 'آخر استخدام',
        'not_connected' => 'غير متصل.',
        'connected' => 'متصل',
        'last_used_at' => 'آخر استخدام في',
        'created_at' => 'تم الإنشاء في',
        'updated_at' => 'تم التحديث في',
    ],
    'links' => [
        'terms_of_service' => 'شروط الخدمة',
        'privacy_policy' => 'سياسة الخصوصية',
        'already_registered' => 'هل سجلت بالفعل؟',
        'register_an_account' => 'تسجيل حساب جديد',
        'forgot_your_password' => 'هل نسيت كلمة المرور؟',
        'edit_profile' => 'تحرير الملف الشخصي',
    ],

    'errors' => [
        'company_deletion' => 'لا يمكنك حذف شركتك الشخصية.',
        'valid_role' => 'يجب أن يكون :attribute دور صالح.',
        'signin_not_found' => 'لم يتم العثور على حساب بهذا التسجيل في :Provider. يرجى التسجيل أو محاولة طريقة تسجيل دخول مختلفة.',
        'already_connected' => 'حساب بعنوان البريد الإلكتروني هذا موجود بالفعل. يرجى تسجيل الدخول للاتصال حسابك على :Provider.',
        'belongs_to_other_user' => 'حساب تسجيل الدخول هذا في :Provider مرتبط بالفعل بمستخدم آخر. يرجى تجربة حساب مختلف.',
        'successfully_connected' => 'تم الاتصال بنجاح :Provider بحسابك.',
        'already_associated' => 'حساب تسجيل الدخول هذا في :Provider مرتبط بالفعل بمستخدمك.',
        'no_email_with_account' => 'لا يوجد عنوان بريد إلكتروني مرتبط بهذا الحساب في :Provider. يرجى تجربة حساب مختلف.',
        'email_already_associated' => 'حساب بعنوان البريد الإلكتروني هذا موجود بالفعل. يرجى تسجيل الدخول للاتصال حسابك على :Provider.',
        'invalid_password' => 'كلمة المرور التي أدخلتها غير صالحة.',
        'email_not_found' => 'لم نتمكن من العثور على مستخدم مسجل بهذا البريد الإلكتروني.',
        'user_belongs_to_company' => 'هذا المستخدم ينتمي بالفعل إلى الشركة.',
        'employee_already_invited' => 'تم دعوة هذا الموظف بالفعل إلى الشركة.',
        'employee_already_belongs_to_company' => 'ينتمي هذا الموظف بالفعل إلى الشركة.',
        'cannot_leave_company' => 'لا يمكنك مغادرة الشركة التي أنشأتها.',
        'password_does_not_match' => 'كلمة المرور التي تم تقديمها لا تتطابق مع كلمة المرور الحالية الخاصة بك.',
    ],

    'descriptions' => [
        'token_created_state' => 'تم إنشاء الرمز :time_ago بواسطة :user_name.',
        'token_last_used_state' => 'آخر استخدام :time_ago',
        'token_updated_state' => 'تم التحديث :time_ago',
        'token_never_used' => 'لم يتم استخدامه أبدًا',
    ],
    'banner' => [
        'company_invitation_accepted' => 'عظيم! لقد قبلت الدعوة للانضمام إلى :company',
        'connected_account_removed' => 'تمت إزالة :Provider من حسابك.',
    ],

    'notifications' => [
        'company_name_updated' => [
            'title' => 'تم تحديث اسم الشركة',
            'body' => 'تم تحديث اسم شركتك إلى :name.',
        ],
        'company_invitation_sent' => [
            'title' => 'تم إرسال الدعوة',
            'body' => 'تم إرسال دعوة لـ **:email** للانضمام إلى شركتك.',
        ],

        'company_created' => [
            'title' => 'تم إنشاء الشركة',
            'body' => 'تم إنشاء شركة جديدة بالاسم **:name.**',
        ],

        'company_deleted' => [
            'title' => 'تم حذف الشركة',
            'body' => 'تم حذف الشركة **:name**.',
        ],
        'profile_information_updated' => [
            'title' => 'تم تحديث معلومات الملف الشخصي',
            'body' => 'تم تحديث معلومات ملفك الشخصي بنجاح.',
        ],

        'password_set' => [
            'title' => 'تم تعيين كلمة المرور',
            'body' => 'تم تعيين كلمة المرور الخاصة بحسابك الآن. يرجى تحديث الصفحة للمتابعة.',
        ],

        'password_updated' => [
            'title' => 'تم تحديث كلمة المرور',
            'body' => 'تم تحديث كلمة المرور بنجاح.',
        ],

        'browser_sessions_terminated' => [
            'title' => 'تم إنهاء جلسات المستعرض',
            'body' => 'تم تسجيل خروج حسابك من جلسات المستعرض الأخرى لأغراض الأمان.',
        ],

        'token_created' => [
            'title' => 'تم إنشاء رمز API',
            'body' => 'تم إنشاء رمز API جديد بالاسم **:name.**',
        ],

        'token_updated' => [
            'title' => 'تم تحديث رمز API',
            'body' => 'تم تحديث رمز API بنجاح.',
        ],
    ],

    'navigation' => [
        'headers' => [
            'manage_company' => 'إدارة الشركة',
            'switch_companies' => 'تغيير الشركات',
        ],

        'links' => [
            'company_settings' => 'إعدادات الشركة',
            'new_company' => 'شركة جديدة',
            'tokens' => 'رموز API',
        ],
    ],

    'pages' => [
        'titles' => [
            'create_company' => 'إنشاء شركة',
            'company_settings' => 'إعدادات الشركة',
            'tokens' => 'رموز API',
            'profile' => 'الملف الشخصي',
        ],
    ],

    'grid_section_titles' => [
        'profile_information' => 'معلومات الملف الشخصي',
        'update_password' => 'تحديث كلمة المرور',
        'two_factor_authentication' => 'المصادقة الثنائية العاملة',
        'browser_sessions' => 'جلسات المتصفح',
        'delete_account' => 'حذف الحساب',
        'create_token' => 'إنشاء رمز API',
        'company_name' => 'اسم الشركة',
        'create_company' => 'إنشاء شركة جديدة',
        'add_company_employee' => 'إضافة موظف للشركة',
        'set_password' => 'تعيين كلمة مرور',
    ],

    'grid_section_descriptions' => [
        'profile_information' => 'تحديث معلومات ملف حسابك الشخصي وعنوان بريدك الإلكتروني.',
        'update_password' => 'تأكد من استخدام حسابك لكلمة مرور عشوائية وطويلة للبقاء آمنًا.',
        'two_factor_authentication' => 'إضافة أمان إضافي لحسابك باستخدام المصادقة الثنائية العاملة.',
        'browser_sessions' => 'إدارة وتسجيل الخروج من جلساتك النشطة في متصفحات وأجهزة أخرى.',
        'delete_account' => 'حذف حسابك بشكل دائم.',
        'create_token' => 'تسمح رموز API للخدمات الأخرى بالمصادقة مع تطبيقنا نيابة عنك.',
        'company_name' => 'اسم الشركة ومعلومات المالك.',
        'create_company' => 'إنشاء شركة جديدة للتعاون مع الآخرين في المشاريع.',
        'add_company_employee' => 'إضافة موظف جديد إلى شركتك للسماح لهم بالتعاون معك.',
        'set_password' => 'تأكد من استخدام حسابك لكلمة مرور عشوائية وطويلة للبقاء آمنًا.',
    ],
    'action_section_titles' => [
        'pending_company_invitations' => 'دعوات الشركة المعلقة',
        'company_employees' => 'موظفي الشركة',
        'delete_company' => 'حذف الشركة',
        'connected_accounts' => 'الحسابات المتصلة',
    ],
    'action_section_descriptions' => [
        'pending_company_invitations' => 'تمت دعوة هؤلاء الأشخاص لشركتك وتم إرسال رسالة دعوة لهم. يمكنهم الانضمام للشركة عن طريق قبول دعوة البريد الإلكتروني.',
        'company_employees' => 'جميع الأشخاص الذين يعملون في هذه الشركة.',
        'delete_company' => 'حذف هذه الشركة بشكل دائم.',
        'connected_accounts' => 'إدارة وإزالة الحسابات المتصلة.',
    ],

    'modal_titles' => [
        'token' => 'رمز API',
        'token_permissions' => 'أذونات رمز API',
        'delete_token' => 'حذف رمز API',
        'manage_role' => 'إدارة الدور',
        'leave_company' => 'مغادرة الشركة',
        'remove_company_employee' => 'إزالة موظف الشركة',
        'logout_browser_sessions' => 'تسجيل الخروج من جلسات المتصفح الأخرى',
        'delete_account' => 'حذف الحساب',
        'delete_company' => 'حذف الشركة',
        'remove_connected_account' => 'إزالة الحساب المتصل',
        'revoke_tokens' => 'إلغاء الرموز الممنوحة',
    ],

    'modal_descriptions' => [
        'copy_token' => 'يرجى نسخ رمز API الجديد الخاص بك. لأمانك ، لن يتم عرضه مرة أخرى.',
        'delete_token' => 'هل أنت متأكد أنك تريد حذف رمز API هذا؟',
        'leave_company' => 'هل أنت متأكد أنك تريد مغادرة هذه الشركة؟',
        'remove_company_employee' => 'هل أنت متأكد أنك تريد إزالة هذا الشخص من الشركة؟',
        'logout_browser_sessions' => 'يرجى إدخال كلمة المرور الخاصة بك لتأكيد أنك تريد تسجيل الخروج من جلسات المتصفح الأخرى عبر جميع أجهزتك.',
        'delete_account' => 'هل أنت متأكد أنك تريد حذف حسابك؟ بمجرد حذف حسابك ، سيتم حذف جميع الموارد والبيانات الخاصة به بشكل دائم. يرجى إدخال كلمة المرور الخاصة بك لتأكيد رغبتك في حذف حسابك بشكل دائم.',
        'delete_company' => 'هل أنت متأكد أنك تريد حذف هذه الشركة؟ بمجرد حذف الشركة ، سيتم حذف جميع الموارد والبيانات الخاصة بها بشكل دائم.',
        'remove_connected_account' => 'يرجى تأكيد إزالة حسابك - لا يمكن التراجع عن هذا الإجراء.',
        'revoke_tokens' => 'يرجى إدخال كلمة المرور الخاصة بك لتأكيد الإجراء.',
    ],

    'headings' => [
        'auth' => [
            'register' => 'تسجيل حساب',
            'login' => 'تسجيل دخول لحسابك',
            'confirm_password' => 'هذه منطقة آمنة في التطبيق. يرجى تأكيد كلمة المرور الخاصة بك قبل الاستمرار.',
            'forgot_password' => 'هل نسيت كلمة المرور الخاصة بك؟',
            'two_factor_challenge' => [
                'authentication_code' => 'يرجى تأكيد الوصول إلى حسابك عن طريق إدخال رمز المصادقة المقدم من تطبيق المصادقة الخاص بك.',
                'emergency_recovery_code' => 'يرجى تأكيد الوصول إلى حسابك عن طريق إدخال إحدى رموز الاسترداد الطارئ الخاصة بك.',
            ],
            'verify_email' => [
                'verification_link_not_sent' => 'قبل الاستمرار ، هل يمكنك التحقق من عنوان بريدك الإلكتروني عن طريق النقر فوق الرابط الذي أرسلناه لك في البريد الإلكتروني الذي تلقيته؟ إذا لم تتلق البريد الإلكتروني ، فسنقوم بإرسال آخر.',
                'verification_link_sent' => 'تم إرسال رابط التحقق الجديد إلى عنوان البريد الإلكتروني الذي قدمته في إعدادات ملف التعريف الخاص بك.',
            ],
        ],

        'profile' => [
            'update_profile_information' => [
                'verification_link_not_sent' => 'يجب عليك التحقق من عنوان بريدك الإلكتروني الحالي قبل تحديث بريدك الإلكتروني.',
                'verification_link_sent' => 'تم إرسال رابط التحقق الجديد إلى عنوان بريدك الإلكتروني.',
            ],

            'two_factor_authentication' => [
                'finish_enabling' => 'إكمال تمكين المصادقة ذات العاملين المزدوجين.',
                'enabled' => 'لقد قمت بتمكين المصادقة ذات العاملين المزدوجين!',
                'not_enabled' => 'لم تقم بتمكين المصادقة ذات العاملين المزدوجين.',
            ],

            'connected_accounts' => [
                'no_connected_accounts' => 'ليس لديك حسابات متصلة.',
                'has_connected_accounts' => 'حساباتك المتصلة.',
            ],
        ],

        'tokens' => [
            'token_manager' => [
                'manage_tokens' => 'إدارة رموز API',
            ],
        ],

        'companies' => [
            'company_employee_manager' => [
                'pending_invitations' => 'الدعوات المعلقة',
                'manage_employees' => 'إدارة الموظفين',
            ],
        ],
    ],

    'subheadings' => [
        'auth' => [
            'login' => 'أو',
            'forgot_password' => 'فقط أخبرنا بعنوان بريدك الإلكتروني وسنرسل لك رابط إعادة تعيين كلمة المرور الذي سيتيح لك اختيار كلمة مرور جديدة.',
            'register' => 'أوافق على :terms_of_service و :privacy_policy',
        ],

        'profile' => [
            'two_factor_authentication' => [
                'summary' => 'عند تمكين المصادقة ذات العاملين الاثنين ، سيتم طلب توكن آمن وعشوائي أثناء المصادقة. يمكنك استرداد هذا التوكن من تطبيق Google Authenticator على هاتفك.',
                'finish_enabling' => 'لإتمام تمكين المصادقة ذات العاملين الاثنين ، امسح رمز الاستجابة السريعة (QR) التالي باستخدام تطبيق مصادقتك على الهاتف أو أدخل مفتاح الإعداد وقدم رمز OTP الذي تم إنشاؤه.',
                'enabled' => 'تم تمكين المصادقة ذات العاملين الاثنين الآن. امسح رمز الاستجابة السريعة (QR) التالي باستخدام تطبيق مصادقتك على الهاتف أو أدخل مفتاح الإعداد.',
                'store_codes' => 'قم بتخزين رموز الاسترداد هذه في مدير كلمات المرور الآمن. يمكن استخدامها لاستعادة الوصول إلى حسابك إذا فقد جهاز المصادقة الخاص بك الاثنين.',
            ],

            'logout_other_browser_sessions' => 'إذا لزم الأمر ، يمكنك تسجيل الخروج من جلسات المتصفح الأخرى عبر جميع أجهزتك. يتم إدراج بعض جلساتك الحالية أدناه ، ومع ذلك ، قد لا يكون هذI القائمة شاملًا. إذا كنت تشعر أن حسابك قد تم اختراقه ، يجب عليك أيضًا تحديث كلمة المرور الخاصة بك.',
            'delete_user' => 'بمجرد حذف حسابك ، سيتم حذف جميع الموارد والبيانات الخاصة به نهائيًا. قبل حذف حسابك ، يرجى تنزيل أي بيانات أو معلومات ترغب في الاحتفاظ بها.',
            'connected_accounts' => 'أنت حر في ربط أي حسابات اجتماعية بملفك الشخصي ويمكنك إزالة أي حسابات مرتبطة في أي وقت. إذا كنت تشعر بأن أي من حساباتك المتصلة قد تم اختراقها ، فيجب عليك فصلها على الفور وتغيير كلمة المرور الخاصة بك.'],

        'companies' => [
            'company_employee_manager' => 'يرجى تقديم عنوان البريد الإلكتروني للشخص الذي ترغب في إضافته إلى هذه الشركة.',
            'delete_company' => 'بمجرد حذف الشركة، سيتم حذف جميع الموارد والبيانات الخاصة بها بشكل دائم. قبل حذف هذه الشركة، يرجى تنزيل أي بيانات أو معلومات ترغب في الاحتفاظ بها.',
        ],
    ],
];
