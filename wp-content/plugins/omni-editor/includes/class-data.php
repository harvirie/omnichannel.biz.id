<?php
/**
 * OmniEditorData — Content schema, defaults, and option helpers.
 */

if (!defined('ABSPATH')) exit;

class OmniEditorData {

    const OPTION_PREFIX = 'omni_editor_';

    // ─────────────────────────────────────────────────────────────
    // PUBLIC API
    // ─────────────────────────────────────────────────────────────

    /** Get all current values for all pages */
    public static function get_all_current(): array {
        $pages = ['home', 'fitur', 'usecase', 'analitik', 'harga', 'footer'];
        $result = [];
        foreach ($pages as $page) {
            $saved    = get_option(self::OPTION_PREFIX . $page, []);
            $defaults = self::defaults($page);
            $result[$page] = self::merge_deep($defaults, is_array($saved) ? $saved : []);
        }
        return $result;
    }

    /** Get all defaults for all pages */
    public static function get_all_defaults(): array {
        $pages = ['home', 'fitur', 'usecase', 'analitik', 'harga', 'footer'];
        $result = [];
        foreach ($pages as $page) {
            $result[$page] = self::defaults($page);
        }
        return $result;
    }

    /** Get merged data for one page */
    public static function get(string $page): array {
        $saved    = get_option(self::OPTION_PREFIX . $page, []);
        $defaults = self::defaults($page);
        return self::merge_deep($defaults, is_array($saved) ? $saved : []);
    }

    /** Save data for one page */
    public static function save(string $page, array $data): bool {
        $allowed = ['home','fitur','usecase','analitik','harga','footer'];
        if (!in_array($page, $allowed)) return false;
        return update_option(self::OPTION_PREFIX . $page, $data, false);
    }

    /** Reset one page to defaults */
    public static function reset(string $page): bool {
        return delete_option(self::OPTION_PREFIX . $page);
    }

    // ─────────────────────────────────────────────────────────────
    // DEFAULTS
    // ─────────────────────────────────────────────────────────────

    public static function defaults(string $page): array {
        $method = 'defaults_' . $page;
        if (method_exists(__CLASS__, $method)) {
            return self::$method();
        }
        return [];
    }

    private static function defaults_home(): array {
        return [
            'hero' => [
                'title'           => 'Aplikasi Omnichannel<br/>Call Center Terbaik.',
                'subtitle'        => 'Tingkatkan kepuasan pelanggan dengan software aplikasi omnichannel call center yang mengintegrasikan WhatsApp API, telepon, email, dan media sosial dalam satu dashboard terpadu.',
                'badge1'          => 'Tanpa Kartu Kredit',
                'badge2'          => 'Setup 5 Menit',
                'cta_primary'     => 'Coba Demo Gratis',
                'cta_primary_url' => '/?demo=1',
                'cta_secondary'   => 'Lihat Fitur Lengkap',
                'cta_secondary_url' => '/fitur/',
                'image_url'       => '',
                'image_id'        => 0,
            ],
            'integration' => [
                'title'    => 'Integrasi<br/><em class="text-omni-accent italic">Tanpa Batas</em>',
                'subtitle' => 'Terhubung dengan platform yang sudah Anda gunakan.',
            ],
            'trusted' => [
                'title'    => 'Dipercaya Oleh Berbagai Instansi',
                'subtitle' => 'Bergabunglah dengan perusahaan terkemuka yang telah bertransformasi bersama kami.',
            ],
            'cta' => [
                'title'    => 'Siap Mengubah Cara Anda Melayani?',
                'subtitle' => 'Bergabunglah dengan ratusan perusahaan lain yang telah mendigitalisasi pusat layanan pelanggan mereka dengan OmniServe.',
                'btn_text' => 'Jadwalkan Demo',
                'btn_url'  => '/?demo=1',
            ],
        ];
    }

    private static function defaults_fitur(): array {
        return [
            'hero' => [
                'badge'    => 'Platform Omnichannel Terpadu',
                'title'    => 'Semua Fitur yang Anda Butuhkan,<br><span class="text-omni-button-hover">dalam Satu Platform</span>',
                'subtitle' => 'Dari WhatsApp Verified Blue Tick hingga integrasi telepon PSTN — OmniServe hadir dengan fitur lengkap yang siap meningkatkan performa tim customer service Anda.',
                'image_url' => '',
                'image_id'  => 0,
            ],
            'sections' => [
                [
                    'id'       => 'kanal',
                    'badge'    => 'Kanal Komunikasi',
                    'title'    => 'Semua Saluran dalam <span class="text-omni-accent">Satu Dashboard</span>',
                    'subtitle' => 'Tangani WhatsApp, Instagram, Email, dan Telepon dari satu antarmuka terpadu.',
                    'items'    => [
                        ['icon' => 'message-circle', 'title' => 'WhatsApp Verified Blue Tick', 'desc' => 'Kirim pesan dari akun WhatsApp Business terverifikasi dengan centang biru resmi.'],
                        ['icon' => 'instagram',      'title' => 'Instagram DM',                'desc' => 'Kelola Direct Message Instagram dan komentar dalam satu inbox.'],
                        ['icon' => 'phone-call',     'title' => 'Telepon PSTN',                'desc' => 'Integrasi telepon tradisional dengan nomor 021 Jakarta.'],
                        ['icon' => 'mail',           'title' => 'Email Terpadu',               'desc' => 'Tangani email support dalam sistem tiket yang terstruktur.'],
                    ],
                ],
                [
                    'id'       => 'agen',
                    'badge'    => 'Manajemen Agen',
                    'title'    => 'Kelola Tim Customer Service <span class="text-omni-accent">Lebih Efisien</span>',
                    'subtitle' => 'Unlimited agent, monitoring real-time, dan distribusi beban kerja yang cerdas.',
                    'items'    => [
                        ['icon' => 'users',      'title' => 'Unlimited Agent',         'desc' => 'Tambah agen tanpa biaya per-kursi tambahan.'],
                        ['icon' => 'user-check', 'title' => 'Custom Agent Setup',      'desc' => 'Konfigurasi 5 dedicated agent lines untuk Professional Plus.'],
                        ['icon' => 'bar-chart-2','title' => 'Monitoring Real-time',    'desc' => 'Pantau aktivitas agen secara langsung dari dashboard.'],
                        ['icon' => 'shield',     'title' => 'Role & Permission',       'desc' => 'Atur hak akses agen dengan granular permission.'],
                    ],
                ],
                [
                    'id'       => 'otomasi',
                    'badge'    => 'Otomasi & AI',
                    'title'    => 'Otomatiskan Respons, <span class="text-omni-accent">Hemat Waktu</span>',
                    'subtitle' => 'Bot FAQ, menu multilevel, dan API integrasi custom untuk bisnis yang lebih cerdas.',
                    'items'    => [
                        ['icon' => 'bot',      'title' => 'FAQ Database Bot',    'desc' => 'Jawaban otomatis untuk pertanyaan umum 24/7.'],
                        ['icon' => 'list',     'title' => 'Multilevel Menu',     'desc' => 'Menu interaktif bertingkat untuk navigasi pelanggan.'],
                        ['icon' => 'code-2',   'title' => 'API Integrasi Custom','desc' => 'Hubungkan ke CRM, ERP, atau sistem internal Anda.'],
                        ['icon' => 'mic',      'title' => 'Voice Call Recording','desc' => 'Rekam semua panggilan untuk audit dan pelatihan.'],
                    ],
                ],
            ],
        ];
    }

    private static function defaults_usecase(): array {
        return [
            'hero' => [
                'badge'     => 'Solusi Nyata untuk Bisnis Nyata',
                'title'     => 'Bagaimana OmniServe <span class="text-omni-button-hover">Mengubah Operasional</span><br>di Berbagai Industri',
                'subtitle'  => 'Dari WhatsApp Unlimited hingga Telepon PSTN dengan Recording — pelajari bagaimana fitur-fitur nyata kami menyelesaikan tantangan nyata di lapangan.',
                'image_url' => '',
                'image_id'  => 0,
            ],
            'cases' => [
                ['industry' => 'E-Commerce & Ritel',           'icon' => 'shopping-bag',  'package' => 'standard',  'desc' => 'Lonjakan pesan saat flash sale atau Harbolnas bisa ditangani tanpa menambah agen. WhatsApp Unlimited Interaction memastikan tidak ada pesan terlewat.'],
                ['industry' => 'Layanan Keuangan & Perbankan', 'icon' => 'building-2',    'package' => 'pro',       'desc' => 'Voice Call Recording memastikan setiap percakapan terdokumentasi. Dashboard Analytics membantu monitor performa real-time.'],
                ['industry' => 'Layanan Kesehatan & Klinik',   'icon' => 'stethoscope',   'package' => 'standard',  'desc' => 'Bot FAQ menjawab pertanyaan umum seputar jadwal dokter. Notifikasi pengingat janji temu via WhatsApp Blue Tick.'],
                ['industry' => 'Instansi Pemerintah',          'icon' => 'landmark',      'package' => 'pro',       'desc' => 'Custom Agent Setup dengan 5 dedicated lines. Laporan bulanan tercetak untuk dokumentasi dan transparansi anggaran.'],
                ['industry' => 'Layanan B2B & Agensi Digital', 'icon' => 'briefcase',     'package' => 'all',       'desc' => 'Kelola komunikasi multi-klien dari satu platform. API Integrasi Custom untuk koneksi ke berbagai CRM.'],
            ],
            'banner' => [
                'text' => 'Setiap use case menunjukkan fitur paket yang relevan untuk solusi tersebut.',
            ],
        ];
    }

    private static function defaults_analitik(): array {
        return [
            'hero' => [
                'badge'     => 'Analitik Komprehensif',
                'title'     => 'Berhenti Sekadar Merespon.<br /><span class="text-omni-button-hover">Ubah Interaksi Menjadi Data.</span>',
                'subtitle'  => 'Pelayanan pelanggan bukan lagi sekadar cost center. Melalui OmniServe, setiap keluhan, pertanyaan, dan saran direkam, dianalisis, dan divisualisasikan.',
                'image_url' => '',
                'image_id'  => 0,
            ],
            'content' => [
                'title'    => 'Wawasan Real-Time untuk Keputusan Bisnis Cerdas',
                'subtitle' => 'Platform analitik kami dirancang khusus untuk memantau sentimen pelanggan dan mengukur produktivitas agen secara komprehensif.',
                'items'    => [
                    'Identifikasi tren keluhan sebelum menjadi krisis',
                    'Ukur kinerja agen secara objektif dengan metrik akurat',
                    'Pahami preferensi saluran komunikasi pelanggan Anda',
                    'Prediksi lonjakan panggilan berdasarkan riwayat data',
                ],
            ],
            'metrics' => [
                ['icon' => 'users',          'title' => 'Customer Satisfaction (CSAT)', 'value' => '98%',  'desc' => 'Tingkat kepuasan rata-rata dari interaksi'],
                ['icon' => 'check-circle-2', 'title' => 'First Contact Resolution',     'value' => '85%',  'desc' => 'Persentase masalah yang diselesaikan di kontak pertama'],
                ['icon' => 'trending-up',    'title' => 'Average Handling Time',        'value' => '3.2m', 'desc' => 'Waktu rata-rata penyelesaian masalah pelanggan'],
            ],
            'cta' => [
                'title'   => 'Mulai Gunakan Analisis Data Hari Ini',
                'btn_text' => 'Lihat Paket Harga',
                'btn_url'  => '/harga/',
            ],
        ];
    }

    private static function defaults_harga(): array {
        return [
            'hero' => [
                'badge'    => 'Harga OmniServe',
                'title'    => 'Investasi Tepat untuk <span class="text-omni-button-hover">Layanan Hebat</span>',
                'subtitle' => 'Solusi call center omnichannel profesional dengan harga transparan.<br>Tanpa biaya tersembunyi. Dukungan penuh dari tim kami.',
                'image_url' => '',
                'image_id'  => 0,
            ],
            'paket_standard' => [
                'name'       => 'Paket Standard',
                'price'      => 'Rp 6.882.000',
                'price_unit' => '/Bulan*',
                'total'      => 'Rp 48.174.500',
                'duration'   => 'minimal 6 bulan berlangganan',
                'features'   => [
                    ['icon' => 'message-square', 'label' => 'Kanal Komunikasi',  'value' => 'WhatsApp (Verified Blue Tick) & Instagram'],
                    ['icon' => 'infinity',        'label' => 'Kapasitas Pesan',   'value' => 'Unlimited Interaction'],
                    ['icon' => 'bot',             'label' => 'Fitur Cerdas',      'value' => 'FAQ Database & Multilevel Menu (Bot)'],
                    ['icon' => 'users',           'label' => 'Manajemen Agen',    'value' => 'Unlimited Agent'],
                    ['icon' => 'code-2',          'label' => 'Fitur Khusus',      'value' => 'API Integrasi Custom'],
                    ['icon' => 'headphones',      'label' => 'Layanan & Support', 'value' => 'Helpdesk via WA Group & Cloud Server'],
                    ['icon' => 'file-text',       'label' => 'Laporan',           'value' => 'Dokumen Laporan Bulanan (Cetak/Buku)'],
                ],
            ],
            'paket_pro' => [
                'name'       => 'Professional Plus',
                'price'      => 'Rp 13.875.000',
                'price_unit' => '/Bulan*',
                'total'      => 'Rp 166.500.000',
                'duration'   => 'minimal 12 bulan berlangganan',
                'badge'      => 'Paling Direkomendasikan',
                'features'   => [
                    ['icon' => 'phone-call',  'label' => 'Kanal Komunikasi',  'value' => 'WhatsApp (Verified Blue Tick), Instagram & Telepon (PSTN)', 'highlight' => true],
                    ['icon' => 'mail-check',  'label' => 'Kapasitas Pesan',   'value' => '6.000 Pesan Masuk/Bulan (Sistem Akumulasi/Rollover)',         'highlight' => true],
                    ['icon' => 'bot',         'label' => 'Fitur Cerdas',      'value' => 'FAQ Database & Multilevel Menu (Bot)',                          'highlight' => false],
                    ['icon' => 'user-check',  'label' => 'Manajemen Agen',    'value' => 'Custom Agent Setup (5 dedicated agent lines)',                  'highlight' => true],
                    ['icon' => 'mic',         'label' => 'Fitur Khusus',      'value' => 'Voice Call Recording & Sistem Nomor Lokal (021)',               'highlight' => true],
                    ['icon' => 'headphones',  'label' => 'Layanan & Support', 'value' => 'Helpdesk via WA Group & Cloud Server',                          'highlight' => false],
                    ['icon' => 'bar-chart-2', 'label' => 'Laporan',           'value' => 'Dashboard Monitoring & Analytics',                              'highlight' => true],
                ],
            ],
            'disclaimer' => '* Harga belum termasuk PPN. Syarat & ketentuan berlaku. Hubungi tim kami untuk penawaran custom sesuai kebutuhan instansi Anda.',
            'enterprise' => [
                'title'   => 'Butuh Paket Khusus untuk Instansi?',
                'subtitle' => 'Kami melayani pengadaan resmi, integrasi sistem pemerintah, dan kebutuhan enterprise skala besar.',
                'btn_text' => 'Hubungi Tim Sales Kami',
                'btn_url'  => 'https://wa.me/6281283835553',
            ],
        ];
    }

    private static function defaults_footer(): array {
        return [
            'tagline' => 'Satu layar untuk semua saluran. Tingkatkan kepuasan pelanggan dengan sistem omnichannel terbaik.',
            'logo_url' => 'https://res.cloudinary.com/dtxwwevxl/image/upload/v1778221347/logo_long_wh_ysccoa.svg',
            'nav_produk' => [
                ['label' => 'Fitur Utama',   'url' => '/fitur/'],
                ['label' => 'Analitik Data', 'url' => '/analitik/'],
                ['label' => 'Use Case',      'url' => '/use-case/'],
                ['label' => 'Harga',         'url' => '/harga/'],
            ],
            'nav_perusahaan' => [
                ['label' => 'Tentang Kami', 'url' => '#'],
                ['label' => 'Karir',        'url' => '#'],
                ['label' => 'Hubungi Kami', 'url' => 'https://wa.me/6281283835553'],
            ],
            'social' => [
                'facebook'  => 'https://facebook.com/omniserve',
                'twitter'   => 'https://twitter.com/omniserve',
                'instagram' => 'https://instagram.com/omniserve',
                'linkedin'  => 'https://linkedin.com/company/omniserve',
                'youtube'   => 'https://youtube.com/@omniserve',
            ],
            'whatsapp'  => '6281283835553',
            'copyright' => '© ' . date('Y') . ' OmniServe. Hak Cipta Dilindungi. Theme Design by Harizal.',
        ];
    }

    // ─────────────────────────────────────────────────────────────
    // HELPER
    // ─────────────────────────────────────────────────────────────

    private static function merge_deep(array $defaults, array $saved): array {
        $result = $defaults;
        foreach ($saved as $key => $value) {
            if (is_array($value) && isset($result[$key]) && is_array($result[$key])) {
                // For indexed arrays (lists), prefer saved version entirely
                if (array_keys($value) === range(0, count($value) - 1)) {
                    $result[$key] = $value;
                } else {
                    $result[$key] = self::merge_deep($result[$key], $value);
                }
            } else {
                $result[$key] = $value;
            }
        }
        return $result;
    }
}
