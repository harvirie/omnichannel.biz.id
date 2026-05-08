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
                        'label'    => 'Harga Pro',
                        'message'  => "💎 *Paket Professional Plus*\n\n📞 Kanal: WhatsApp (Blue Tick), Instagram & Telepon (PSTN)\n📨 Kapasitas: 6.000 Pesan/Bulan (Rollover)\n🤖 Fitur: FAQ Database & Multilevel Menu Bot\n👤 Agen: Custom Setup (5 dedicated agent lines)\n🎙️ Khusus: Voice Call Recording & Nomor Lokal (021)\n📊 Laporan: Dashboard Monitoring & Analytics\n☁️ Support: Helpdesk via WA Group & Cloud Server\n\n💰 *Harga: Rp 13.875.000/Bulan*\n📌 Total: Rp 166.500.000 (min. 12 bulan)\n\nIngin konsultasi lebih lanjut?",
                        'is_human' => true,
                        'children' => [],
                    ],
                    [
                        'label'    => 'Harga Standar',
                        'message'  => "📦 *Paket Standard*\n\n📱 Kanal: WhatsApp (Blue Tick) & Instagram\n♾️ Kapasitas: Unlimited Interaction\n🤖 Fitur: FAQ Database & Multilevel Menu Bot\n👥 Agen: Unlimited Agent\n🔗 Khusus: API Integrasi Custom\n📄 Laporan: Dokumen Laporan Bulanan (Cetak/Buku)\n☁️ Support: Helpdesk via WA Group & Cloud Server\n\n💰 *Harga: Rp 6.882.000/Bulan*\n📌 Total: Rp 48.174.500 (min. 6 bulan)\n\nIngin konsultasi lebih lanjut?",
                        'is_human' => true,
                        'children' => [],
                    ],
                ],
            ],
            [
                'label'    => 'Teknis',
                'role'     => 'teknis',
                'children' => [
                    [
                        'label'    => 'Konsultasi',
                        'message'  => "Baik! Tim teknis kami siap membantu konsultasi. 🛠️\n\nSilakan ceritakan kendala atau pertanyaan teknis yang Anda alami, dan agen kami akan segera merespons.",
                        'is_human' => true,
                        'children' => [],
                    ],
                    [
                        'label'    => 'Demo',
                        'message'  => "Kami akan menjadwalkan sesi demo untuk Anda! 🎯\n\nLihat dulu fitur-fitur unggulan kami di:\n👉 https://omnichannel.biz.id/fitur\n\nTim kami akan segera menghubungi Anda untuk menjadwalkan sesi demo.",
                        'is_human' => true,
                        'children' => [],
                    ],
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
