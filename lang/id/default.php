<?php

return [
    'fields' => [
        'code' => 'Kode',
        'current_password' => 'Kata Sandi Saat Ini',
        'email' => 'Email',
        'name' => 'Nama',
        'password' => 'Kata Sandi',
        'recovery_code' => 'Kode Pemulihan',
    ],

    'buttons' => [
        'add' => 'Tambah',
        'cancel' => 'Batal',
        'close' => 'Tutup',
        'connect' => 'Hubungkan',
        'confirm' => 'Konfirmasi',
        'create' => 'Buat',
        'create_token' => 'Buat Token',
        'delete' => 'Hapus',
        'delete_account' => 'Hapus Akun',
        'delete_company' => 'Hapus Perusahaan',
        'disable' => 'Nonaktifkan',
        'done' => 'Selesai.',
        'edit' => 'Edit',
        'email_password_reset_link' => 'Email Tautan Atur Ulang Kata Sandi',
        'enable' => 'Aktifkan',
        'leave' => 'Tinggalkan',
        'login' => 'Masuk',
        'logout' => 'Keluar',
        'logout_browser_sessions' => 'Keluar dari Sesi Browser Lain',
        'new_photo' => 'Foto Baru',
        'permissions' => 'Izin',
        'register' => 'Daftar',
        'regenerate_recovery_codes' => 'Buat Ulang Kode Pemulihan',
        'remember_me' => 'Ingat Saya',
        'remove' => 'Hapus',
        'remove_connected_account' => 'Hapus Akun Terhubung',
        'remove_photo' => 'Hapus Foto',
        'reset_password' => 'Atur Ulang Kata Sandi',
        'resend_verification_email' => 'Kirim Ulang Email Verifikasi',
        'revoke' => 'Cabut',
        'save' => 'Simpan',
        'show_recovery_codes' => 'Tampilkan Kode Pemulihan',
        'use_authentication_code' => 'Gunakan kode autentikasi',
        'use_avatar_as_profile_photo' => 'Gunakan Avatar',
        'use_recovery_code' => 'Gunakan kode pemulihan',
    ],
    'labels' => [
        'company_name' => 'Nama Perusahaan',
        'company_owner' => 'Pemilik Perusahaan',
        'connected' => 'Terkoneksi',
        'created_at' => 'Dibuat pada',
        'last_active' => 'Terakhir aktif',
        'last_used' => 'Terakhir digunakan',
        'last_used_at' => 'Terakhir digunakan pada',
        'new_password' => 'Kata Sandi Baru',
        'not_connected' => 'Tidak terkoneksi.',
        'password_confirmation' => 'Konfirmasi Kata Sandi',
        'permissions' => 'Izin',
        'photo' => 'Foto',
        'role' => 'Peran',
        'setup_key' => 'Kunci Pengaturan',
        'this_device' => 'Perangkat ini',
        'token_name' => 'Nama Token',
        'unknown' => 'Tidak diketahui',
        'updated_at' => 'Diperbarui pada',
    ],
    'links' => [
        'already_registered' => 'Sudah terdaftar?',
        'edit_profile' => 'Edit Profil',
        'forgot_your_password' => 'Lupa kata sandi Anda?',
        'privacy_policy' => 'Kebijakan Privasi',
        'register_an_account' => 'Daftar akun',
        'terms_of_service' => 'Syarat Layanan',
    ],
    'errors' => [
        'cannot_leave_company' => 'Anda tidak dapat meninggalkan perusahaan yang Anda buat.',
        'company_deletion' => 'Anda tidak dapat menghapus perusahaan pribadi Anda.',
        'email_already_associated' => 'Akun dengan alamat email tersebut sudah ada. Silakan masuk untuk menghubungkan akun :Provider Anda.',
        'email_not_found' => 'Kami tidak dapat menemukan pengguna terdaftar dengan alamat email ini.',
        'employee_already_belongs_to_company' => 'Pegawai ini sudah termasuk dalam perusahaan.',
        'employee_already_invited' => 'Pegawai ini sudah diundang ke perusahaan.',
        'invalid_password' => 'Kata sandi yang Anda masukkan tidak valid.',
        'no_email_with_account' => 'Tidak ada alamat email yang terkait dengan akun :Provider ini. Silakan coba akun lain.',
        'password_does_not_match' => 'Kata sandi yang diberikan tidak cocok dengan kata sandi saat ini Anda.',
        'already_associated_account' => 'Akun dengan masuk :Provider tersebut sudah ada, silakan masuk.',
        'already_connected' => 'Akun dengan alamat email tersebut sudah ada. Silakan masuk untuk menghubungkan akun :Provider Anda.',
        'signin_not_found' => 'Akun dengan masuk :Provider ini tidak ditemukan. Silakan daftar atau coba metode masuk lain.',
        'user_belongs_to_company' => 'Pengguna ini sudah termasuk dalam perusahaan.',
        'valid_role' => ':attribute harus merupakan peran yang valid.',
    ],
    'descriptions' => [
        'token_created_state' => 'Dibuat :time_ago oleh :user_name.',
        'token_last_used_state' => 'Terakhir digunakan :time_ago',
        'token_never_used' => 'Tidak pernah digunakan',
        'token_updated_state' => 'Diperbarui :time_ago',
    ],

    'banner' => [
        'company_invitation_accepted' => 'Bagus! Anda telah menerima undangan untuk bergabung dengan **:company**.',
    ],
    'notifications' => [
        'token_created' => [
            'title' => 'Personal Access Token dibuat',
            'body' => 'Personal Access Token baru telah dibuat dengan nama **:name**.',
        ],

        'token_updated' => [
            'title' => 'Personal Access Token diperbarui',
            'body' => 'Personal Access Token telah berhasil diperbarui.',
        ],

        'browser_sessions_terminated' => [
            'title' => 'Sesi browser dihentikan',
            'body' => 'Akun Anda telah keluar dari sesi browser lain untuk tujuan keamanan.',
        ],

        'company_created' => [
            'title' => 'Perusahaan dibuat',
            'body' => 'Perusahaan baru telah dibuat dengan nama **:name**.',
        ],

        'company_deleted' => [
            'title' => 'Perusahaan dihapus',
            'body' => 'Perusahaan **:name** telah dihapus.',
        ],

        'company_invitation_sent' => [
            'title' => 'Undangan dikirim',
            'body' => 'Sebuah undangan telah dikirim ke **:email** untuk bergabung dengan perusahaan Anda.',
        ],

        'company_name_updated' => [
            'title' => 'Perusahaan diperbarui',
            'body' => 'Nama perusahaan Anda telah diperbarui menjadi **:name**.',
        ],

        'connected_account_removed' => [
            'title' => 'Akun terhubung dihapus',
            'body' => 'Akun terhubung telah berhasil dihapus.',
        ],

        'password_set' => [
            'title' => 'Kata sandi ditetapkan',
            'body' => 'Akun Anda sekarang dilindungi dengan kata sandi. Halaman akan secara otomatis menyegarkan dalam sebentar untuk memperbarui pengaturan Anda.',
        ],

        'password_updated' => [
            'title' => 'Kata sandi diperbarui',
            'body' => 'Kata sandi Anda telah berhasil diperbarui.',
        ],

        'profile_information_updated' => [
            'title' => 'Informasi profil diperbarui',
            'body' => 'Informasi profil Anda telah berhasil diperbarui.',
        ],

        'already_associated' => [
            'title' => 'Oops!',
            'body' => 'Akun masuk :Provider ini sudah terkait dengan pengguna Anda.',
        ],

        'belongs_to_other_user' => [
            'title' => 'Oops!',
            'body' => 'Akun masuk :Provider ini sudah terkait dengan pengguna lain. Silakan coba akun yang berbeda.',
        ],

        'successfully_connected' => [
            'title' => 'Sukses!',
            'body' => 'Anda telah berhasil menghubungkan :Provider ke akun Anda.',
        ],

        'verification_link_sent' => [
            'title' => 'Tautan verifikasi dikirim',
            'body' => 'Tautan verifikasi baru telah dikirim ke alamat email yang diberikan.',
        ],
    ],

    'navigation' => [
        'headers' => [
            'manage_company' => 'Kelola Perusahaan',
            'switch_companies' => 'Ganti Perusahaan',
        ],

        'links' => [
            'tokens' => 'Token Akses Pribadi',
            'company_settings' => 'Pengaturan Perusahaan',
            'create_company' => 'Buat Perusahaan',
        ],
    ],

    'pages' => [
        'titles' => [
            'tokens' => 'Token Akses Pribadi',
            'create_company' => 'Buat Perusahaan',
            'company_settings' => 'Pengaturan Perusahaan',
            'profile' => 'Profil',
        ],
    ],

    'grid_section_titles' => [
        'add_company_employee' => 'Tambahkan Pegawai Perusahaan',
        'browser_sessions' => 'Sesi Browser',
        'company_name' => 'Nama Perusahaan',
        'create_token' => 'Buat Token Akses Pribadi',
        'create_company' => 'Buat Perusahaan',
        'delete_account' => 'Hapus Akun',
        'profile_information' => 'Informasi Profil',
        'set_password' => 'Tetapkan Kata Sandi',
        'two_factor_authentication' => 'Otentikasi Dua Faktor',
        'update_password' => 'Perbarui Kata Sandi',
    ],

    'grid_section_descriptions' => [
        'add_company_employee' => 'Tambahkan pegawai baru ke perusahaan Anda, memungkinkan mereka untuk berkolaborasi dengan Anda.',
        'browser_sessions' => 'Kelola dan keluar dari sesi aktif Anda di browser dan perangkat lain.',
        'company_name' => 'Nama perusahaan dan informasi pemilik.',
        'create_token' => 'Token Akses Pribadi memungkinkan layanan pihak ketiga untuk mengautentikasi dengan aplikasi kami atas nama Anda.',
        'create_company' => 'Buat perusahaan baru untuk berkolaborasi dengan orang lain dalam proyek.',
        'delete_account' => 'Hapus akun Anda secara permanen.',
        'profile_information' => 'Perbarui informasi profil dan alamat email akun Anda.',
        'set_password' => 'Pastikan akun Anda menggunakan kata sandi yang panjang dan acak untuk tetap aman.',
        'two_factor_authentication' => 'Tambahkan keamanan tambahan pada akun Anda menggunakan otentikasi dua faktor.',
        'update_password' => 'Pastikan akun Anda menggunakan kata sandi yang panjang dan acak untuk tetap aman.',
    ],

    'action_section_titles' => [
        'company_employees' => 'Pegawai Perusahaan',
        'connected_accounts' => 'Akun Terhubung',
        'delete_company' => 'Hapus Perusahaan',
        'pending_company_invitations' => 'Undangan Perusahaan yang Tertunda',
    ],

    'action_section_descriptions' => [
        'company_employees' => 'Semua orang yang merupakan bagian dari perusahaan ini.',
        'connected_accounts' => 'Kelola dan hapus akun terhubung Anda.',
        'delete_company' => 'Hapus perusahaan ini secara permanen.',
        'pending_company_invitations' => 'Orang-orang ini telah diundang ke perusahaan Anda dan telah dikirimkan email undangan. Mereka dapat bergabung dengan perusahaan dengan menerima undangan email tersebut.',
    ],

    'modal_titles' => [
        'token' => 'Token Akses Pribadi',
        'token_permissions' => 'Izin Token Akses Pribadi',
        'confirm_password' => 'Konfirmasi Kata Sandi',
        'delete_token' => 'Hapus Token Akses Pribadi',
        'delete_account' => 'Hapus Akun',
        'delete_company' => 'Hapus Perusahaan',
        'leave_company' => 'Tinggalkan Perusahaan',
        'logout_browser_sessions' => 'Keluar dari Sesi Browser Lain',
        'manage_role' => 'Kelola Peran',
        'remove_company_employee' => 'Hapus Pegawai Perusahaan',
        'remove_connected_account' => 'Hapus Akun Terhubung',
        'revoke_tokens' => 'Cabut Token',
    ],

    'modal_descriptions' => [
        'copy_token' => 'Harap salin Token Akses Pribadi baru Anda. Untuk keamanan Anda, token ini tidak akan ditampilkan lagi.',
        'confirm_password' => 'Untuk keamanan Anda, silakan konfirmasi kata sandi Anda untuk melanjutkan.',
        'delete_account' => 'Silakan masukkan kata sandi Anda untuk mengonfirmasi bahwa Anda ingin menghapus akun Anda.',
        'delete_token' => 'Apakah Anda yakin ingin menghapus Token Akses Pribadi ini?',
        'delete_company' => 'Apakah Anda yakin ingin menghapus perusahaan ini?',
        'leave_company' => 'Apakah Anda yakin ingin meninggalkan perusahaan ini?',
        'logout_browser_sessions' => 'Silakan masukkan kata sandi Anda untuk mengonfirmasi bahwa Anda ingin keluar dari sesi browser lain Anda.',
        'remove_company_employee' => 'Apakah Anda yakin ingin menghapus orang ini dari perusahaan?',
        'remove_connected_account' => 'Silakan konfirmasi penghapusan akun ini - tindakan ini tidak dapat dibatalkan.',
        'revoke_tokens' => 'Silakan masukkan kata sandi Anda untuk konfirmasi.',
    ],

    'headings' => [
        'auth' => [
            'confirm_password' => 'Ini adalah area aman dari aplikasi. Silakan konfirmasi kata sandi Anda sebelum melanjutkan.',
            'forgot_password' => 'Lupa kata sandi Anda?',
            'login' => 'Masuk ke akun Anda',
            'register' => 'Daftar akun',
            'two_factor_challenge' => [
                'authentication_code' => 'Silakan konfirmasi akses ke akun Anda dengan memasukkan kode otentikasi yang disediakan oleh aplikasi otentikator Anda.',
                'emergency_recovery_code' => 'Silakan konfirmasi akses ke akun Anda dengan memasukkan salah satu kode pemulihan darurat Anda.',
            ],
            'verify_email' => [
                'verification_link_not_sent' => 'Sebelum melanjutkan, bisakah Anda memverifikasi alamat email Anda dengan mengklik tautan yang baru saja kami email ke Anda? Jika Anda tidak menerima email, kami akan dengan senang hati mengirimkan Anda yang lain.',
                'verification_link_sent' => 'Tautan verifikasi baru telah dikirim ke alamat email yang Anda berikan dalam pengaturan profil Anda.',
            ],
        ],

        'profile' => [
            'connected_accounts' => [
                'has_connected_accounts' => 'Akun yang terhubung Anda.',
                'no_connected_accounts' => 'Anda tidak memiliki akun yang terhubung.',
            ],

            'two_factor_authentication' => [
                'enabled' => 'Anda telah mengaktifkan otentikasi dua faktor!',
                'finish_enabling' => 'Selesaikan pengaktifan otentikasi dua faktor.',
                'not_enabled' => 'Anda belum mengaktifkan otentikasi dua faktor.',
            ],

            'update_profile_information' => [
                'verification_link_not_sent' => 'Sebelum email Anda dapat diperbarui, Anda harus memverifikasi alamat email saat ini Anda.',
                'verification_link_sent' => 'Tautan verifikasi baru telah dikirim ke alamat email Anda.',
            ],
        ],

        'tokens' => [
            'token_manager' => [
                'manage_tokens' => 'Kelola Token Akses Pribadi',
            ],
        ],

        'companies' => [
            'company_employee_manager' => [
                'manage_employees' => 'Kelola Pegawai',
                'pending_invitations' => 'Undangan yang Tertunda',
            ],
        ],
    ],

    'subheadings' => [
        'auth' => [
            'forgot_password' => 'Beritahu kami alamat email Anda dan kami akan mengirimkan tautan untuk mereset kata sandi yang memungkinkan Anda memilih yang baru.',
            'login' => 'Atau',
            'register' => 'Saya setuju dengan :terms_of_service dan :privacy_policy',
        ],

        'profile' => [
            'two_factor_authentication' => [
                'enabled' => 'Otentikasi dua faktor sekarang diaktifkan. Pindai kode QR berikut menggunakan aplikasi otentikator di ponsel Anda atau masukkan kunci pengaturan.',
                'finish_enabling' => 'Untuk menyelesaikan pengaktifan otentikasi dua faktor, pindai kode QR berikut menggunakan aplikasi otentikator di ponsel Anda atau masukkan kunci pengaturan dan berikan kode OTP yang dihasilkan.',
                'store_codes' => 'Simpan kode pemulihan ini di manajer kata sandi yang aman. Kode ini dapat digunakan untuk memulihkan akses ke akun Anda jika perangkat otentikasi dua faktor Anda hilang.',
                'summary' => 'Ketika otentikasi dua faktor diaktifkan, Anda akan diminta token acak yang aman selama otentikasi. Anda dapat mengambil token ini dari aplikasi Google Authenticator di ponsel Anda.',
            ],

            'connected_accounts' => 'Anda bebas untuk menghubungkan akun sosial apa pun ke profil Anda dan dapat menghapus akun yang terhubung kapan saja. Jika Anda merasa salah satu akun Anda telah dikompromikan, Anda harus segera memutuskannya dan mengubah kata sandi Anda.',
            'delete_user' => 'Setelah akun Anda dihapus, semua sumber daya dan data akan dihapus secara permanen. Sebelum menghapus akun Anda, silakan unduh data atau informasi yang ingin Anda simpan.',
            'logout_other_browser_sessions' => 'Jika perlu, Anda dapat keluar dari semua sesi browser lain di semua perangkat Anda. Beberapa sesi terbaru Anda tercantum di bawah ini; namun, daftar ini mungkin tidak lengkap. Jika Anda merasa akun Anda telah dikompromikan, Anda juga harus memperbarui kata sandi Anda.',
        ],

        'companies' => [
            'company_employee_manager' => 'Silakan berikan alamat email orang yang ingin Anda tambahkan ke perusahaan ini.',
            'delete_company' => 'Setelah perusahaan dihapus, semua sumber daya dan data akan dihapus secara permanen. Sebelum menghapus perusahaan ini, silakan unduh data atau informasi mengenai perusahaan ini yang ingin Anda simpan.',
        ],
    ],
];
