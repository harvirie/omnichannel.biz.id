<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Default settings helper
 */
function omni_lc_defaults() {
    return [
        'open_hour'      => '08:00',
        'close_hour'     => '16:00',
        'open_days'      => ['1','2','3','4','5'], // Mon-Fri (PHP date('N'))
        'holiday_mode'   => '0',
        'greeting_open'  => 'Halo, ada yang bisa dibantu?',
        'greeting_close' => 'Maaf, layanan Live Chat kami sedang offline. Silakan hubungi kami kembali pada jam operasional.',
        'logo_url'       => 'https://res.cloudinary.com/dtxwwevxl/image/upload/v1778221348/logo_dark_sr1ywk.svg',
        'bot_menus'      => [
            [
                'label'    => 'Sales',
                'role'     => 'sales',
                'children' => [
                    [
                        'label'   => 'Pilihan Harga',
                        'message' => "Berikut pilihan paket kami:\n\n📦 *Paket Standar* — Cocok untuk UKM yang baru memulai.\n🚀 *Paket Pro* — Fitur lengkap untuk bisnis berkembang.\n\nMau info lebih detail paket mana?",
                        'children' => [
                            ['label' => 'Pilihan Chat', 'message' => 'Baik! Tim kami akan segera melayani Anda melalui chat ini. Silakan sampaikan pertanyaan Anda.', 'is_human' => true],
                        ],
                    ],
                ],
            ],
            [
                'label'    => 'Teknis',
                'role'     => 'teknis',
                'children' => [
                    ['label' => 'Konsultasi', 'message' => 'Baik! Tim teknis kami siap membantu konsultasi. Silakan ceritakan kendala yang Anda alami.', 'is_human' => true],
                    ['label' => 'Demo',        'message' => 'Kami akan menjadwalkan sesi demo untuk Anda. Kapan waktu yang paling nyaman bagi Anda?', 'is_human' => true],
                ],
            ],
        ],
    ];
}

function omni_lc_get( $key, $default = null ) {
    $all      = get_option( 'omni_lc_settings', [] );
    $defaults = omni_lc_defaults();
    if ( $default === null ) {
        $default = $defaults[ $key ] ?? null;
    }
    return $all[ $key ] ?? $default;
}

function omni_lc_is_open() {
    // Holiday override
    if ( omni_lc_get('holiday_mode') === '1' ) return false;

    $tz      = wp_timezone();
    $now     = new DateTime( 'now', $tz );
    $dow     = $now->format('N'); // 1=Mon … 7=Sun
    $time    = $now->format('H:i');

    $open_days = omni_lc_get('open_days', ['1','2','3','4','5']);
    if ( ! in_array( $dow, $open_days ) ) return false;

    $open_h  = omni_lc_get('open_hour', '08:00');
    $close_h = omni_lc_get('close_hour', '16:00');

    return $time >= $open_h && $time < $close_h;
}
