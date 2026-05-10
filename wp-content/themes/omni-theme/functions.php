<?php
function omni_theme_enqueue_styles() {
    wp_enqueue_style( 'omni-style', get_stylesheet_uri(), array(), '1.0.0' );
}
add_action( 'wp_enqueue_scripts', 'omni_theme_enqueue_styles' );

// Add Favicon to Admin and Login Pages
function omni_add_favicon() {
    echo '<link rel="icon" type="image/x-icon" href="' . get_template_directory_uri() . '/assets/img/favicon.ico">' . "\n";
    echo '<link rel="shortcut icon" type="image/x-icon" href="' . get_template_directory_uri() . '/assets/img/favicon.ico">' . "\n";
}
add_action('admin_head', 'omni_add_favicon');
add_action('login_head', 'omni_add_favicon');

// Setup theme support
function omni_theme_setup() {
    add_theme_support( 'custom-logo', array(
        'height'      => 60,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ) );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );

    // Register Nav Menus
    register_nav_menus(array(
        'primary' => 'Menu Utama (Desktop)',
        'mobile'  => 'Menu Mobile',
    ));

    // Disable Gutenberg / Block Editor (Use Classic Editor)
    add_filter('use_block_editor_for_post', '__return_false', 10);
}
add_action( 'after_setup_theme', 'omni_theme_setup' );

// Auto-create default pages & menu
add_action('admin_init', 'omni_auto_create_pages');
function omni_auto_create_pages() {
    if (get_option('omni_pages_auto_created_v5')) return;

    $pages = [
        'Home' => [
            'seo_title' => 'Aplikasi Call Center Resmi & Omnichannel Call Center Terbaik',
            'seo_desc' => 'Tingkatkan layanan dengan aplikasi omnichannel call center resmi. Solusi tepat untuk layanan call center perusahaan & call center pemerintah. Coba gratis sekarang!'
        ],
        'Fitur' => [
            'seo_title' => 'Fitur Lengkap Omnichannel & Call Center Kabayan | Sewa Layanan Call Center Pemerintah',
            'seo_desc' => 'Fitur lengkap platform sewa omnichannel call center Kabayan: WhatsApp Blue Tick, PSTN, Bot FAQ, Unlimited Agent, Voice Recording & API Integrasi. Solusi call center pemerintah dan bisnis terpercaya di Indonesia.'
        ],
        'Use Case' => [
            'seo_title' => 'Studi Kasus Omnichannel & Call Center Pemerintah | Sewa Layanan Call Center Kabayan',
            'seo_desc' => 'Lihat bagaimana layanan omnichannel call center Kabayan membantu e-commerce, perbankan, klinik, instansi pemerintah & korporasi B2B. Sewa call center dan sewa omnichannel terpercaya untuk semua industri.'
        ],
        'Analitik Data' => [
            'seo_title' => 'Analitik Data & Laporan Layanan Call Center Omnichannel',
            'seo_desc' => 'Pantau performa layanan call center Anda dengan dashboard analitik canggih. Laporan komprehensif untuk aplikasi omnichannel call center resmi.'
        ],
        'Harga' => [
            'seo_title' => 'Harga Sewa Aplikasi Call Center & Omnichannel Resmi',
            'seo_desc' => 'Pilihan harga sewa aplikasi call center yang fleksibel untuk bisnis skala kecil hingga enterprise dan call center pemerintah. Mulai uji coba gratis!'
        ],
        'Artikel' => [
            'seo_title' => 'Artikel & Panduan Omnichannel Call Center Resmi',
            'seo_desc' => 'Kumpulan artikel, tips, dan panduan seputar layanan call center, aplikasi omnichannel call center, dan implementasi pada call center pemerintah.'
        ]
    ];

    $home_id = 0;
    foreach ($pages as $title => $meta) {
        $slug = sanitize_title($title);
        if ($title === 'Analitik Data') $slug = 'analitik';
        if ($title === 'Home') $slug = 'home';

        $page_check = get_page_by_path($slug);
        if (!$page_check) {
            $page_check = get_page_by_title($title);
        }
        
        $page_id = 0;
        
        if (!$page_check || !isset($page_check->ID)) {
            $new_page = array(
                'post_type' => 'page',
                'post_title' => $title,
                'post_name' => $slug,
                'post_content' => '',
                'post_status' => 'publish',
                'post_author' => 1,
            );
            $page_id = wp_insert_post($new_page);
        } else {
            $page_id = $page_check->ID;
            // Force update slug if it's wrong (e.g. analitik-data -> analitik)
            if ($page_check->post_name !== $slug) {
                wp_update_post(array(
                    'ID' => $page_id,
                    'post_name' => $slug
                ));
            }
        }

        if ($title === 'Home') $home_id = $page_id;

        // Auto-inject SEO Metadata
        if ($page_id) {
            update_post_meta($page_id, '_omni_seo_title', $meta['seo_title']);
            update_post_meta($page_id, '_omni_seo_desc', $meta['seo_desc']);
        }
    }

    if ($home_id) {
        update_option('show_on_front', 'page');
        update_option('page_on_front', $home_id);
    }

    // Auto-create menu
    $menu_name = 'Menu Utama';
    $menu_exists = wp_get_nav_menu_object($menu_name);

    if (!$menu_exists) {
        $menu_id = wp_create_nav_menu($menu_name);

        // Add items to menu
        $menu_items = ['Fitur', 'Use Case', 'Analitik Data', 'Harga', 'Artikel'];
        foreach ($menu_items as $item_title) {
            $page = get_page_by_title($item_title);
            if ($page) {
                wp_update_nav_menu_item($menu_id, 0, array(
                    'menu-item-title' => $item_title,
                    'menu-item-object-id' => $page->ID,
                    'menu-item-object' => 'page',
                    'menu-item-status' => 'publish',
                    'menu-item-type' => 'post_type',
                ));
            }
        }

        // Assign to theme locations
        $locations = get_theme_mod('nav_menu_locations');
        $locations['primary'] = $menu_id;
        $locations['mobile'] = $menu_id;
        set_theme_mod('nav_menu_locations', $locations);
    }

    update_option('omni_pages_auto_created_v5', true);
}


// Custom Walker for Desktop Menu
class Omni_Desktop_Nav_Walker extends Walker_Nav_Menu {
    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $active_class = in_array('current-menu-item', $classes) || in_array('current_page_item', $classes) ? 'text-omni-accent' : 'text-white';
        $line_class = in_array('current-menu-item', $classes) || in_array('current_page_item', $classes) ? 'w-full opacity-100' : 'w-1 opacity-0 group-hover:opacity-100 group-hover:w-full';
        
        $output .= '<li class="flex items-center">';
        $output .= '<a href="' . esc_url($item->url) . '" class="group relative text-sm font-medium transition-all duration-300 hover:text-omni-accent hover:-translate-y-0.5 ' . $active_class . '">';
        $output .= apply_filters('the_title', $item->title, $item->ID);
        $output .= '<span class="absolute -bottom-2 left-1/2 -translate-x-1/2 h-0.5 bg-omni-accent rounded-full transition-all duration-300 ' . $line_class . '"></span>';
        $output .= '</a>';
    }
    function end_el(&$output, $item, $depth = 0, $args = null) {
        $output .= '</li>';
    }
}

// Custom Walker for Mobile Menu
class Omni_Mobile_Nav_Walker extends Walker_Nav_Menu {
    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $active_class = in_array('current-menu-item', $classes) || in_array('current_page_item', $classes) ? 'text-omni-accent bg-omni-dark/5 shadow-inner' : 'text-omni-text-muted hover:text-omni-button hover:bg-omni-dark/5 hover:translate-x-1';
        
        $title = apply_filters('the_title', $item->title, $item->ID);
        
        // Auto-assign icons based on title for that "canggih" look
        $icon = 'chevron-right'; // default
        $title_lower = strtolower($title);
        if (strpos($title_lower, 'fitur') !== false) $icon = 'layers';
        if (strpos($title_lower, 'use case') !== false) $icon = 'briefcase';
        if (strpos($title_lower, 'analitik') !== false) $icon = 'bar-chart-2';
        if (strpos($title_lower, 'harga') !== false) $icon = 'credit-card';
        if (strpos($title_lower, 'artikel') !== false) $icon = 'file-text';
        if (strpos($title_lower, 'home') !== false || strpos($title_lower, 'beranda') !== false) $icon = 'home';
        
        $output .= '<a href="' . esc_url($item->url) . '" class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition-all duration-300 ' . $active_class . '">';
        $output .= '<i data-lucide="' . $icon . '" class="h-5 w-5 opacity-70"></i>';
        $output .= '<span>' . $title . '</span>';
        $output .= '</a>';
    }
    function end_el(&$output, $item, $depth = 0, $args = null) {
    }
}

// Customizer settings
function omni_theme_customize_register( $wp_customize ) {
    // Colors Section
    $wp_customize->add_section( 'omni_colors_section', array(
        'title'    => __( 'Warna Panel Website', 'omni-theme' ),
        'priority' => 30,
    ) );

    $wp_customize->add_setting( 'omni_primary_color_v2', array(
        'default'           => '#0F172A',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'omni_primary_color_v2', array(
        'label'    => __( 'Warna Utama (Primary)', 'omni-theme' ),
        'section'  => 'omni_colors_section',
    ) ) );

    $wp_customize->add_setting( 'omni_accent_color_v2', array(
        'default'           => '#D4AF37',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'omni_accent_color_v2', array(
        'label'    => __( 'Warna Aksen (Accent)', 'omni-theme' ),
        'section'  => 'omni_colors_section',
    ) ) );

    $wp_customize->add_setting( 'omni_light_color_v2', array(
        'default'           => '#F8FAFC',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'omni_light_color_v2', array(
        'label'    => __( 'Warna Latar Terang (Light)', 'omni-theme' ),
        'section'  => 'omni_colors_section',
    ) ) );

    // Extended Colors
    $extra_colors = [
        'omni_secondary_color_v2' => ['label' => 'Warna Sekunder / Hero', 'default' => '#CBD5E1'],
        'omni_button_color'       => ['label' => 'Warna Tombol Utama', 'default' => '#1E3A8A'],
        'omni_button_hover'       => ['label' => 'Warna Hover Tombol', 'default' => '#1E40AF'],
        'omni_accent_hover'       => ['label' => 'Warna Hover Aksen', 'default' => '#B8972D'],
        'omni_text_muted'         => ['label' => 'Warna Teks Redup', 'default' => '#64748B'],
        'omni_border_color'       => ['label' => 'Warna Garis Tepi', 'default' => '#E2E8F0'],
        'omni_dark_border'        => ['label' => 'Warna Garis Gelap', 'default' => '#1E293B'],
        'omni_dark_hover'         => ['label' => 'Warna Hover Garis Gelap', 'default' => '#1E293B'],
    ];

    foreach ($extra_colors as $id => $data) {
        $wp_customize->add_setting( $id, array(
            'default'           => $data['default'],
            'sanitize_callback' => 'sanitize_hex_color',
        ) );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $id, array(
            'label'    => $data['label'],
            'section'  => 'omni_colors_section',
        ) ) );
    }

    // Hero Section
    $wp_customize->add_section( 'omni_hero_section', array(
        'title'    => __( 'Hero Media', 'omni-theme' ),
        'priority' => 40,
    ) );

    $wp_customize->add_setting( 'omni_hero_image', array(
        'default'           => 'https://images.unsplash.com/photo-1766066014237-00645c74e9c6?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxtb2Rlcm4lMjBjYWxsJTIwY2VudGVyJTIwYWdlbnQlMjB0YWxraW5nJTIwb24lMjBoZWFkc2V0fGVufDF8fHx8MTc3ODE0Njc3NXww&ixlib=rb-4.1.0&q=80&w=1080',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'omni_hero_image', array(
        'label'    => __( 'Gambar Hero (SVG Atas)', 'omni-theme' ),
        'section'  => 'omni_hero_section',
    ) ) );

    // Customers Section
    $wp_customize->add_section( 'omni_customers_section', array(
        'title'    => __( 'Data Pelanggan (Carousel)', 'omni-theme' ),
        'priority' => 50,
    ) );

    $default_customer_names = array(
        1 => 'Kantor Imigrasi Kelas I Non TPI Tangerang',
        2 => 'Kantor Imigrasi Kelas I Non TPI Bogor',
        3 => 'ADHIMIX',
        4 => 'PSC 119 DINKES Kab. Bandung',
        5 => 'ADHIMIX RMC',
        6 => 'DPMPTSP Provinsi Jawa Barat',
        7 => 'Logistik',            8 => 'Pendidikan',
        9 => 'Asuransi',           10 => 'Retail',
    );
    $default_customer_descs = array(
        1 => 'Meningkatkan pelayanan publik melalui antrian dan responsivitas layanan keimigrasian.',
        2 => 'Optimalisasi layanan informasi paspor dan izin tinggal warga negara asing terpadu.',
        3 => 'Sinergi komunikasi korporat yang lebih efisien dan terarah di seluruh cabang operasi.',
        4 => 'Layanan cepat tanggap darurat medis (Public Safety Center) untuk masyarakat secara real-time.',
        5 => 'Call Center Omnichannel terintegrasi penuh dengan sistem untuk pelayanan pelanggan prima.',
        6 => 'Mempermudah layanan perizinan dan penanaman modal dengan responsivitas tinggi.',
        7 => 'Memantau pengiriman dan mengelola keluhan pelanggan secara real-time.',
        8 => 'Mempermudah komunikasi antara institusi, pengajar, dan orang tua siswa.',
        9 => 'Mempercepat proses klaim dan layanan nasabah asuransi di semua saluran.',
        10 => 'Mengintegrasikan layanan pelanggan online dan offline dalam satu dashboard.',
    );
    $default_customer_imgs = array(
        1 => 'https://res.cloudinary.com/dtxwwevxl/image/upload/f_auto,q_auto,e_improve/v1778230601/imigrasi_tangerang_fbbk8l.png',
        2 => 'https://res.cloudinary.com/dtxwwevxl/image/upload/f_auto,q_auto,e_improve/v1778230601/imigrasi_bogor_ju9wpd.png',
        3 => 'https://res.cloudinary.com/dtxwwevxl/image/upload/f_auto,q_auto,e_improve/v1778230601/adhimix_jwbryb.png',
        4 => 'https://res.cloudinary.com/dtxwwevxl/image/upload/f_auto,q_auto,e_improve/v1778230600/PSC119_t6v8kk.png',
        5 => 'https://res.cloudinary.com/dtxwwevxl/image/upload/f_auto,q_auto,e_improve/v1778230601/adhimix_rmc_lrpswy.png',
        6 => 'https://res.cloudinary.com/dtxwwevxl/image/upload/f_auto,q_auto,e_improve/v1778230601/dpmptsp_jabar_r5wtai.png',
        7 => 'https://res.cloudinary.com/dtxwwevxl/image/upload/f_auto,q_auto,e_improve/v1778230601/dpmptsp_jabar_r5wtai.png',
        8 => 'https://res.cloudinary.com/dtxwwevxl/image/upload/f_auto,q_auto,e_improve/v1778230601/dpmptsp_jabar_r5wtai.png',
        9 => 'https://res.cloudinary.com/dtxwwevxl/image/upload/f_auto,q_auto,e_improve/v1778230601/dpmptsp_jabar_r5wtai.png',
       10 => 'https://res.cloudinary.com/dtxwwevxl/image/upload/f_auto,q_auto,e_improve/v1778230601/dpmptsp_jabar_r5wtai.png',
    );

    for ($i = 1; $i <= 10; $i++) {
        // Toggle Visibility
        $wp_customize->add_setting( 'omni_customer_'.$i.'_show', array(
            'default'           => $i <= 6 ? true : false,
            'sanitize_callback' => 'rest_sanitize_boolean',
        ) );
        $wp_customize->add_control( 'omni_customer_'.$i.'_show', array(
            'label'    => __( 'Tampilkan Pelanggan '.$i, 'omni-theme' ),
            'section'  => 'omni_customers_section',
            'type'     => 'checkbox',
        ) );
        // Name
        $wp_customize->add_setting( 'omni_customer_'.$i.'_name', array(
            'default'           => $default_customer_names[$i] ?? 'Pelanggan '.$i,
            'sanitize_callback' => 'sanitize_text_field',
        ) );
        $wp_customize->add_control( 'omni_customer_'.$i.'_name', array(
            'label'    => __( 'Nama Pelanggan '.$i, 'omni-theme' ),
            'section'  => 'omni_customers_section',
            'type'     => 'text',
        ) );
        // Description
        $wp_customize->add_setting( 'omni_customer_'.$i.'_desc', array(
            'default'           => $default_customer_descs[$i] ?? 'Deskripsi singkat layanan.',
            'sanitize_callback' => 'sanitize_textarea_field',
        ) );
        $wp_customize->add_control( 'omni_customer_'.$i.'_desc', array(
            'label'    => __( 'Deskripsi Pelanggan '.$i, 'omni-theme' ),
            'section'  => 'omni_customers_section',
            'type'     => 'textarea',
        ) );
        // Image URL
        $wp_customize->add_setting( 'omni_customer_'.$i.'_img', array(
            'default'           => $default_customer_imgs[$i] ?? '',
            'sanitize_callback' => 'esc_url_raw',
        ) );
        $wp_customize->add_control( 'omni_customer_'.$i.'_img', array(
            'label'       => __( 'URL Foto Pelanggan '.$i.' (Cloudinary)', 'omni-theme' ),
            'description' => 'Masukkan URL Cloudinary (opsional tambahkan parameter f_auto,q_auto)',
            'section'     => 'omni_customers_section',
            'type'        => 'url',
        ) );
    }

    // Pricing Section
    $wp_customize->add_section( 'omni_pricing_section', array(
        'title'    => __( 'Daftar Harga (Pricing)', 'omni-theme' ),
        'priority' => 55,
    ) );

    $default_plans = array(
        1 => array('name' => 'Starter', 'price' => 'Rp 299.000', 'period' => '/agen/bulan', 'desc' => 'Sempurna untuk tim kecil yang baru memulai.', 'btn' => 'Mulai Uji Coba Gratis', 'features' => "Hingga 5 saluran komunikasi\nKotak masuk terpusat\nLaporan standar\nDukungan email 24/7"),
        2 => array('name' => 'Pro', 'price' => 'Rp 799.000', 'period' => '/agen/bulan', 'desc' => 'Fitur lanjutan untuk tim yang berkembang.', 'btn' => 'Mulai Uji Coba Gratis', 'features' => "Semua saluran tidak terbatas\nOtomatisasi & Routing (ACD)\nAnalitik Real-time & Custom\nPrioritas dukungan live chat\nIntegrasi CRM"),
        3 => array('name' => 'Enterprise', 'price' => 'Custom', 'period' => '', 'desc' => 'Skalabilitas dan keamanan maksimal.', 'btn' => 'Hubungi Sales', 'features' => "SLA 99.9% Uptime\nDedicated Account Manager\nKeamanan berbasis peran (RBAC)\nOn-premise deployment option\nPelatihan agen eksklusif")
    );

    for ($i = 1; $i <= 3; $i++) {
        // Name
        $wp_customize->add_setting( 'omni_pricing_'.$i.'_name', array(
            'default'           => $default_plans[$i]['name'],
            'sanitize_callback' => 'sanitize_text_field',
        ) );
        $wp_customize->add_control( 'omni_pricing_'.$i.'_name', array(
            'label'    => __( 'Nama Paket '.$i, 'omni-theme' ),
            'section'  => 'omni_pricing_section',
            'type'     => 'text',
        ) );
        
        // Price
        $wp_customize->add_setting( 'omni_pricing_'.$i.'_price', array(
            'default'           => $default_plans[$i]['price'],
            'sanitize_callback' => 'sanitize_text_field',
        ) );
        $wp_customize->add_control( 'omni_pricing_'.$i.'_price', array(
            'label'    => __( 'Harga Paket '.$i, 'omni-theme' ),
            'section'  => 'omni_pricing_section',
            'type'     => 'text',
        ) );

        // Period
        $wp_customize->add_setting( 'omni_pricing_'.$i.'_period', array(
            'default'           => $default_plans[$i]['period'],
            'sanitize_callback' => 'sanitize_text_field',
        ) );
        $wp_customize->add_control( 'omni_pricing_'.$i.'_period', array(
            'label'    => __( 'Periode Paket '.$i.' (cth: /bulan)', 'omni-theme' ),
            'section'  => 'omni_pricing_section',
            'type'     => 'text',
        ) );

        // Description
        $wp_customize->add_setting( 'omni_pricing_'.$i.'_desc', array(
            'default'           => $default_plans[$i]['desc'],
            'sanitize_callback' => 'sanitize_textarea_field',
        ) );
        $wp_customize->add_control( 'omni_pricing_'.$i.'_desc', array(
            'label'    => __( 'Deskripsi Paket '.$i, 'omni-theme' ),
            'section'  => 'omni_pricing_section',
            'type'     => 'textarea',
        ) );

        // Features
        $wp_customize->add_setting( 'omni_pricing_'.$i.'_features', array(
            'default'           => $default_plans[$i]['features'],
            'sanitize_callback' => 'sanitize_textarea_field',
        ) );
        $wp_customize->add_control( 'omni_pricing_'.$i.'_features', array(
            'label'    => __( 'Fitur Paket '.$i.' (Pisahkan dengan Enter/Baris Baru)', 'omni-theme' ),
            'section'  => 'omni_pricing_section',
            'type'     => 'textarea',
        ) );

        // Button Text
        $wp_customize->add_setting( 'omni_pricing_'.$i.'_btn', array(
            'default'           => $default_plans[$i]['btn'],
            'sanitize_callback' => 'sanitize_text_field',
        ) );
        $wp_customize->add_control( 'omni_pricing_'.$i.'_btn', array(
            'label'    => __( 'Teks Tombol Paket '.$i, 'omni-theme' ),
            'section'  => 'omni_pricing_section',
            'type'     => 'text',
        ) );
    }
}
add_action( 'customize_register', 'omni_theme_customize_register' );

// Custom routing for our multi-page React-like architecture
add_action('template_redirect', function() {
    global $wp_query;
    if (is_admin()) return;
    
    $path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
    $pages = ['fitur', 'use-case', 'analitik', 'harga', 'artikel'];
    
    if (in_array($path, $pages)) {
        // Prevent WP from thinking it's a 404
        $wp_query->is_404 = false;
        $wp_query->is_page = true;
        status_header(200);
        
        // Set dynamic document title
        add_filter('pre_get_document_title', function() use ($path) {
            return ucwords(str_replace('-', ' ', $path)) . ' - ' . get_bloginfo('name');
        });

        $template = locate_template("page-{$path}.php");
        if ($template) {
            include $template;
            exit;
        }
    }
}, 1);

// Register Custom Post Type for Demo Requests
add_action('init', function() {
    register_post_type('demo_request', array(
        'labels'      => array(
            'name'          => 'Inbox Demo',
            'singular_name' => 'Permohonan Demo',
            'menu_name'     => 'Inbox Demo',
            'all_items'     => 'Semua Permohonan',
        ),
        'public'      => false,
        'show_ui'     => false, // We will use a custom admin page instead
        'supports'    => array('title', 'custom-fields'),
        'capability_type' => 'post',
    ));
});

// Custom Admin Page for Inbox Demo
add_action('admin_menu', function() {
    add_menu_page(
        'Inbox Demo',
        'Inbox Demo',
        'manage_options',
        'inbox-demo',
        'omni_render_inbox_demo_page',
        'dashicons-email-alt',
        26
    );
});

function omni_render_inbox_demo_page() {
    // Handle Delete Action
    if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
        $id = (int)$_GET['id'];
        if (check_admin_referer('demo_delete_' . $id)) {
            wp_delete_post($id, true);
            echo '<div class="notice notice-success is-dismissible"><p>Permohonan demo berhasil dihapus.</p></div>';
        }
    }

    // Fetch Demo Requests
    $args = array(
        'post_type'      => 'demo_request',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'orderby'        => 'date',
        'order'          => 'DESC'
    );
    $requests = get_posts($args);
    $total = count($requests);

    // Filter today
    $today_count = 0;
    foreach ($requests as $r) {
        if (strpos($r->post_date, current_time('Y-m-d')) === 0) {
            $today_count++;
        }
    }

    ?>
    <div class="wrap" style="font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Oxygen-Sans,Ubuntu,Cantarell,'Helvetica Neue',sans-serif;margin-top:20px;max-width:1200px;">
      
      <!-- Header -->
      <div style="background:#0F172A;border-radius:1rem;padding:2rem;color:white;display:flex;justify-content:space-between;align-items:center;margin-bottom:1.5rem;box-shadow:0 10px 15px -3px rgba(0,0,0,0.1);">
        <div style="display:flex;align-items:center;gap:1rem;">
          <div style="background:rgba(255,255,255,0.1);padding:1rem;border-radius:.75rem;">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#D4AF37" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
          </div>
          <div>
            <h1 style="color:white;margin:0 0 .25rem;font-size:1.5rem;font-weight:800;letter-spacing:-.025em;">Inbox Demo</h1>
            <p style="color:#94A3B8;margin:0;font-size:.875rem;">Data permohonan demo dari form website</p>
          </div>
        </div>
      </div>

      <!-- Stats -->
      <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(250px,1fr));gap:1.5rem;margin-bottom:1.5rem;">
        <div style="background:white;padding:1.5rem;border-radius:1rem;border:1px solid #E2E8F0;border-top:4px solid #0F172A;box-shadow:0 4px 6px -1px rgba(0,0,0,0.05);">
          <div style="font-size:2rem;font-weight:800;color:#0F172A;line-height:1;"><?php echo $total; ?></div>
          <div style="color:#64748B;font-size:.875rem;margin-top:.5rem;font-weight:600;">Total Permohonan</div>
        </div>
        <div style="background:white;padding:1.5rem;border-radius:1rem;border:1px solid #E2E8F0;border-top:4px solid #D4AF37;box-shadow:0 4px 6px -1px rgba(0,0,0,0.05);">
          <div style="font-size:2rem;font-weight:800;color:#D4AF37;line-height:1;"><?php echo $today_count; ?></div>
          <div style="color:#64748B;font-size:.875rem;margin-top:.5rem;font-weight:600;">Masuk Hari Ini</div>
        </div>
      </div>

      <!-- Table -->
      <div style="background:#fff;border:1px solid #E2E8F0;border-radius:.875rem;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,0.04);">
        <div style="padding:1rem 1.5rem;border-bottom:1px solid #E2E8F0;font-weight:700;color:#0F172A;">
          Daftar Permohonan (<?php echo $total; ?> total)
        </div>
        <?php if ($requests): ?>
        <table style="width:100%;border-collapse:collapse;font-size:.8125rem;">
          <thead>
            <tr style="background:#F8FAFC;">
              <?php foreach (['#','Klien','Kontak','Jadwal & Tipe','Waktu Input','Aksi'] as $h): ?>
              <th style="padding:.6rem 1rem;text-align:left;font-weight:600;color:#64748B;font-size:.7rem;text-transform:uppercase;letter-spacing:.05em;border-bottom:1px solid #E2E8F0;"><?php echo $h; ?></th>
              <?php endforeach; ?>
            </tr>
          </thead>
          <tbody>
          <?php foreach ($requests as $i => $r):
            $meta_name    = get_post_meta($r->ID, 'Nama Lengkap', true);
            $meta_company = get_post_meta($r->ID, 'Perusahaan', true);
            $meta_email   = get_post_meta($r->ID, 'Email', true);
            $meta_phone   = get_post_meta($r->ID, 'No WhatsApp', true);
            $meta_date    = get_post_meta($r->ID, 'Tanggal', true);
            $meta_time    = get_post_meta($r->ID, 'Jam', true);
            $meta_type    = get_post_meta($r->ID, 'Tipe', true);
            $meta_address = get_post_meta($r->ID, 'Alamat Kantor', true);
            $del_url = wp_nonce_url(admin_url("admin.php?page=inbox-demo&action=delete&id={$r->ID}"), 'demo_delete_' . $r->ID);
          ?>
            <tr style="<?php echo $i % 2 ? 'background:#F8FAFC;' : ''; ?>border-bottom:1px solid #F1F5F9;">
              <td style="padding:.55rem 1rem;color:#94A3B8;"><?php echo $r->ID; ?></td>
              <td style="padding:.55rem 1rem;">
                <div style="font-weight:700;color:#0F172A;font-size:13px;"><?php echo esc_html($meta_name); ?></div>
                <div style="color:#64748B;font-size:12px;"><?php echo esc_html($meta_company); ?></div>
              </td>
              <td style="padding:.55rem 1rem;">
                <div><a href="mailto:<?php echo esc_attr($meta_email); ?>" style="color:#1E3A8A;text-decoration:none;font-weight:500;"><?php echo esc_html($meta_email); ?></a></div>
                <div><a href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', $meta_phone); ?>" target="_blank" style="color:#25D366;text-decoration:none;font-weight:600;font-size:12px;">📞 <?php echo esc_html($meta_phone); ?></a></div>
              </td>
              <td style="padding:.55rem 1rem;">
                <div style="font-weight:600;color:#0F172A;"><?php echo esc_html($meta_date . ' - ' . $meta_time); ?></div>
                <div style="color:<?php echo $meta_type === 'Online' ? '#3B82F6' : '#EAB308'; ?>;font-size:11px;font-weight:700;text-transform:uppercase;">
                  <?php echo esc_html($meta_type); ?>
                </div>
                <?php if ($meta_type === 'Offline' && !empty($meta_address)): ?>
                  <div style="color:#64748B;font-size:11px;margin-top:2px;max-width:150px;white-space:normal;line-height:1.2;"><?php echo esc_html($meta_address); ?></div>
                <?php endif; ?>
              </td>
              <td style="padding:.55rem 1rem;color:#64748B;white-space:nowrap;font-size:12px;"><?php echo esc_html(get_date_from_gmt($r->post_date, 'd/m/Y H:i')); ?></td>
              <td style="padding:.55rem 1rem;">
                <a href="<?php echo esc_url($del_url); ?>" style="color:#ef4444;font-size:.75rem;text-decoration:none;font-weight:600;" onclick="return confirm('Hapus permohonan ini?')">🗑 Hapus</a>
              </td>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
        <?php else: ?>
          <div style="padding:3rem;text-align:center;color:#94A3B8;">
            <div style="font-size:2.5rem;margin-bottom:.5rem;">📭</div>
            <div>Belum ada permohonan masuk.</div>
          </div>
        <?php endif; ?>
      </div>
    </div>
    <?php
}

// Handle Demo Form Submission via AJAX
add_action('wp_ajax_submit_demo', 'omni_handle_demo_submission');
add_action('wp_ajax_nopriv_submit_demo', 'omni_handle_demo_submission');

function omni_handle_demo_submission() {
    $name    = isset($_POST['demo_name']) ? sanitize_text_field($_POST['demo_name']) : '';
    $company = isset($_POST['demo_company']) ? sanitize_text_field($_POST['demo_company']) : '';
    $email   = isset($_POST['demo_email']) ? sanitize_email($_POST['demo_email']) : '';
    $phone   = isset($_POST['demo_phone']) ? sanitize_text_field($_POST['demo_phone']) : '';
    $date    = isset($_POST['demo_date']) ? sanitize_text_field($_POST['demo_date']) : '';
    $time    = isset($_POST['demo_time']) ? sanitize_text_field($_POST['demo_time']) : '';
    $type    = isset($_POST['demo_type']) ? sanitize_text_field($_POST['demo_type']) : 'Online';
    $address = isset($_POST['demo_address']) ? sanitize_textarea_field($_POST['demo_address']) : '';

    if (empty($name) || empty($email) || empty($phone) || empty($date) || empty($time)) {
        wp_send_json_error('Mohon lengkapi semua data wajib.');
    }

    $post_id = wp_insert_post(array(
        'post_type'   => 'demo_request',
        'post_title'  => $name . ' (' . $company . ') - ' . current_time('Y-m-d H:i'),
        'post_status' => 'publish',
        'meta_input'  => array(
            'Nama Lengkap'  => $name,
            'Perusahaan'    => $company,
            'Email'         => $email,
            'No WhatsApp'   => $phone,
            'Tanggal'       => $date,
            'Jam'           => $time,
            'Tipe'          => $type,
            'Alamat Kantor' => $address,
        )
    ));

    if ($post_id && !is_wp_error($post_id)) {
        wp_send_json_success('Permohonan berhasil dikirim. Tim kami akan segera menghubungi Anda!');
    } else {
        wp_send_json_error('Gagal mengirim permohonan. Silakan coba lagi nanti.');
    }
}

// ---------------------------------------------------------
// 1. Customizer untuk Recommended Testimonial di Hero
// ---------------------------------------------------------
add_action('customize_register', function($wp_customize) {
    $wp_customize->add_section('omni_hero_recommended', array(
        'title'    => 'Hero Recommended',
        'priority' => 31,
    ));

    $wp_customize->add_setting('omni_rec_speed', array('default' => 10, 'sanitize_callback' => 'absint'));
    $wp_customize->add_control('omni_rec_speed', array(
        'label'       => 'Durasi Slide (Detik)',
        'section'     => 'omni_hero_recommended',
        'type'        => 'number',
        'input_attrs' => array('min' => 1, 'max' => 60),
    ));

    $default_items = [
        1 => ['title' => 'Panggilan Masuk', 'rating' => '(2.3k+)', 'desc' => 'Budi Santoso - Keluhan Produk', 'sub' => 'Menunggu antrean (0:45)'],
        2 => ['title' => 'Pesan Masuk', 'rating' => '(1.5k+)', 'desc' => 'Siti Aminah - Info Layanan', 'sub' => 'Dialihkan ke Tim B (0:12)'],
        3 => ['title' => 'Email Baru', 'rating' => '(900+)', 'desc' => 'Agus Pratama - Kerjasama', 'sub' => 'Belum dibaca (5m yang lalu)'],
    ];

    for ($i = 1; $i <= 3; $i++) {
        $fields = array(
            "omni_rec_{$i}_title"  => array('label' => "Judul Item {$i}", 'default' => $default_items[$i]['title']),
            "omni_rec_{$i}_rating" => array('label' => "Rating/Angka Item {$i}", 'default' => $default_items[$i]['rating']),
            "omni_rec_{$i}_desc"   => array('label' => "Deskripsi Item {$i}", 'default' => $default_items[$i]['desc']),
            "omni_rec_{$i}_sub"    => array('label' => "Sub Status Item {$i}", 'default' => $default_items[$i]['sub']),
        );

        foreach ($fields as $id => $data) {
            $wp_customize->add_setting($id, array('default' => $data['default'], 'sanitize_callback' => 'sanitize_text_field'));
            $wp_customize->add_control($id, array(
                'label'   => $data['label'],
                'section' => 'omni_hero_recommended',
                'type'    => 'text',
            ));
        }
    }
});

// ---------------------------------------------------------
// 2. Fitur SEO (Meta Box, Sitemap, Robots.txt)
// ---------------------------------------------------------

// Add Meta Box for SEO Title & Description
add_action('add_meta_boxes', function() {
    add_meta_box('omni_seo_meta', 'Pengaturan SEO Google', 'omni_seo_meta_html', array('post', 'page'), 'normal', 'high');
    
    // Add Copywriting meta box specifically for pages (so they can edit Home text)
    add_meta_box('omni_home_copy_meta', 'Pengaturan Teks Copywriting (Khusus Halaman Beranda)', 'omni_home_copy_html', 'page', 'normal', 'high');
});

function omni_home_copy_html($post) {
    wp_nonce_field('omni_home_save', 'omni_home_nonce');

    $fields = [
        'omni_hero_title' => ['label' => 'Judul Hero Utama (Gunakan <br/> untuk baris baru)', 'type' => 'text', 'default' => 'Satu Layar untuk<br/>Semua Saluran.'],
        'omni_hero_sub' => ['label' => 'Subjudul Hero', 'type' => 'editor', 'default' => 'Tingkatkan kepuasan pelanggan dan produktivitas tim yang menghubungkan suara, chat, email, dan sosmed dalam satu tempat.'],
        'omni_hero_badge1' => ['label' => 'Teks Badge 1 (Bawah Kolom Pencarian)', 'type' => 'text', 'default' => 'Tanpa Kartu Kredit'],
        'omni_hero_badge2' => ['label' => 'Teks Badge 2 (Bawah Kolom Pencarian)', 'type' => 'text', 'default' => 'Setup 5 Menit'],
        'omni_integration_title' => ['label' => 'Judul Integrasi (Section Bawah Hero)', 'type' => 'text', 'default' => 'Integrasi<br/><em class="text-omni-accent italic">Tanpa Batas</em>'],
        'omni_cta_title' => ['label' => 'Judul CTA (Call to Action)', 'type' => 'text', 'default' => 'Siap Mengubah Cara Anda Melayani?'],
        'omni_cta_sub' => ['label' => 'Subjudul CTA', 'type' => 'editor', 'default' => 'Bergabunglah dengan ratusan perusahaan lain yang telah mendigitalisasi pusat layanan pelanggan mereka dengan OmniServe.'],
        'omni_trusted_title' => ['label' => 'Judul Logo Klien', 'type' => 'text', 'default' => 'Dipercaya Oleh Berbagai Instansi'],
        'omni_trusted_sub' => ['label' => 'Subjudul Klien', 'type' => 'editor', 'default' => 'Bergabunglah dengan perusahaan terkemuka yang telah bertransformasi bersama kami.'],
    ];

    echo '<p style="color:#666;">Silakan isi teks di bawah ini jika halaman ini Anda jadikan sebagai Halaman Depan (Beranda/Home). Pengaturan ini menggunakan editor WYSIWYG untuk bagian subjudul.</p>';

    foreach ($fields as $id => $data) {
        $val = get_post_meta($post->ID, $id, true);
        if ($val === '') $val = $data['default'];

        echo '<div style="margin-bottom: 20px; padding-bottom: 15px; border-bottom: 1px solid #eee;">';
        echo '<label style="font-weight:bold; display:block; margin-bottom:10px; font-size:14px;">' . $data['label'] . '</label>';
        
        if ($data['type'] == 'editor') {
            wp_editor($val, $id, array(
                'textarea_name' => $id, 
                'media_buttons' => false, 
                'textarea_rows' => 4, 
                'teeny' => true
            ));
        } else {
            echo '<input type="text" name="'.$id.'" class="widefat" style="padding:10px; font-size:14px;" value="'.esc_attr($val).'">';
        }
        echo '</div>';
    }
}

function omni_seo_meta_html($post) {
    $seo_title = get_post_meta($post->ID, '_omni_seo_title', true);
    $seo_desc = get_post_meta($post->ID, '_omni_seo_desc', true);
    wp_nonce_field('omni_seo_save', 'omni_seo_nonce');
    ?>
    <p>
        <label for="omni_seo_title" style="display:block;font-weight:bold;margin-bottom:5px;">SEO Title</label>
        <input type="text" name="omni_seo_title" id="omni_seo_title" class="widefat" value="<?php echo esc_attr($seo_title); ?>" placeholder="Kosongkan untuk menggunakan judul bawaan">
    </p>
    <p>
        <label for="omni_seo_desc" style="display:block;font-weight:bold;margin-bottom:5px;">Meta Description</label>
        <textarea name="omni_seo_desc" id="omni_seo_desc" class="widefat" rows="3"><?php echo esc_textarea($seo_desc); ?></textarea>
    </p>
    <?php
}

add_action('save_post', function($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    // Save SEO Meta
    if (isset($_POST['omni_seo_nonce']) && wp_verify_nonce($_POST['omni_seo_nonce'], 'omni_seo_save')) {
        if (isset($_POST['omni_seo_title'])) update_post_meta($post_id, '_omni_seo_title', sanitize_text_field($_POST['omni_seo_title']));
        if (isset($_POST['omni_seo_desc'])) update_post_meta($post_id, '_omni_seo_desc', sanitize_textarea_field($_POST['omni_seo_desc']));
    }

    // Save Homepage Copywriting Meta
    if (isset($_POST['omni_home_nonce']) && wp_verify_nonce($_POST['omni_home_nonce'], 'omni_home_save')) {
        $fields = ['omni_hero_title', 'omni_hero_sub', 'omni_hero_badge1', 'omni_hero_badge2', 'omni_integration_title', 'omni_cta_title', 'omni_cta_sub', 'omni_trusted_title', 'omni_trusted_sub'];
        foreach ($fields as $field) {
            if (isset($_POST[$field])) {
                // If it's a textarea/editor, use wp_kses_post to allow HTML
                $val = (strpos($field, '_sub') !== false) ? wp_kses_post($_POST[$field]) : wp_kses_post($_POST[$field]);
                update_post_meta($post_id, $field, $val);
            }
        }
    }
});

// Generate dynamic robots.txt
add_filter('robots_txt', function($output, $public) {
    $sitemap_url = home_url('/sitemap.xml');
    $output .= "\nUser-agent: *\nDisallow: /wp-admin/\nAllow: /wp-admin/admin-ajax.php\n";
    $output .= "\nSitemap: " . $sitemap_url . "\n";
    return $output;
}, 10, 2);

// Generate dynamic sitemap.xml
add_action('init', function() {
    add_rewrite_rule('^sitemap\.xml$', 'index.php?omni_sitemap=1', 'top');
});

add_filter('query_vars', function($vars) {
    $vars[] = 'omni_sitemap';
    return $vars;
});

add_action('template_redirect', function() {
    if (get_query_var('omni_sitemap')) {
        header('Content-Type: text/xml; charset=utf-8');
        echo '<?xml version="1.0" encoding="UTF-8"?>';
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        
        $posts = get_posts(array('post_type' => array('post', 'page'), 'posts_per_page' => -1, 'post_status' => 'publish'));
        
        // Add virtual pages
        $virtual_pages = ['/fitur', '/use-case', '/analitik', '/harga'];
        foreach ($virtual_pages as $vp) {
            echo '<url><loc>' . esc_url(home_url($vp)) . '</loc><changefreq>weekly</changefreq><priority>0.8</priority></url>';
        }

        foreach ($posts as $p) {
            echo '<url>';
            echo '<loc>' . esc_url(get_permalink($p->ID)) . '</loc>';
            echo '<lastmod>' . get_the_modified_date('Y-m-d\TH:i:s+00:00', $p->ID) . '</lastmod>';
            echo '<changefreq>monthly</changefreq>';
            echo '<priority>' . ($p->post_type == 'page' ? '0.8' : '0.6') . '</priority>';
            echo '</url>';
        }
        
        echo '</urlset>';
        exit;
    }
}, 0);

// Ambil gambar pertama dari konten artikel jika tidak ada post thumbnail
function omni_get_first_image_url($post_content) {
    preg_match('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post_content, $matches);
    if(isset($matches[1])) {
        return $matches[1];
    }
    return false;
}

