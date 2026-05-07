<?php
function omni_theme_enqueue_styles() {
    wp_enqueue_style( 'omni-style', get_stylesheet_uri(), array(), '1.0.0' );
}
add_action( 'wp_enqueue_scripts', 'omni_theme_enqueue_styles' );

// Setup theme support
function omni_theme_setup() {
    add_theme_support( 'custom-logo', array(
        'height'      => 60,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ) );
    add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'omni_theme_setup' );

// Customizer settings
function omni_theme_customize_register( $wp_customize ) {
    // Colors Section
    $wp_customize->add_section( 'omni_colors_section', array(
        'title'    => __( 'Warna Panel Website', 'omni-theme' ),
        'priority' => 30,
    ) );

    $wp_customize->add_setting( 'omni_primary_color', array(
        'default'           => '#1C2C1F',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'omni_primary_color', array(
        'label'    => __( 'Warna Utama (Primary)', 'omni-theme' ),
        'section'  => 'omni_colors_section',
    ) ) );

    $wp_customize->add_setting( 'omni_accent_color', array(
        'default'           => '#FDB854',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'omni_accent_color', array(
        'label'    => __( 'Warna Aksen (Accent)', 'omni-theme' ),
        'section'  => 'omni_colors_section',
    ) ) );

    $wp_customize->add_setting( 'omni_light_color', array(
        'default'           => '#EBF4E3',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'omni_light_color', array(
        'label'    => __( 'Warna Latar Terang (Light)', 'omni-theme' ),
        'section'  => 'omni_colors_section',
    ) ) );

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

    for ($i = 1; $i <= 4; $i++) {
        // Name
        $wp_customize->add_setting( 'omni_customer_'.$i.'_name', array(
            'default'           => 'Pelanggan '.$i,
            'sanitize_callback' => 'sanitize_text_field',
        ) );
        $wp_customize->add_control( 'omni_customer_'.$i.'_name', array(
            'label'    => __( 'Nama Pelanggan '.$i, 'omni-theme' ),
            'section'  => 'omni_customers_section',
            'type'     => 'text',
        ) );
        // Description
        $wp_customize->add_setting( 'omni_customer_'.$i.'_desc', array(
            'default'           => 'Deskripsi singkat layanan.',
            'sanitize_callback' => 'sanitize_textarea_field',
        ) );
        $wp_customize->add_control( 'omni_customer_'.$i.'_desc', array(
            'label'    => __( 'Deskripsi Pelanggan '.$i, 'omni-theme' ),
            'section'  => 'omni_customers_section',
            'type'     => 'textarea',
        ) );
        // Image
        $wp_customize->add_setting( 'omni_customer_'.$i.'_img', array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ) );
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'omni_customer_'.$i.'_img', array(
            'label'    => __( 'Foto Pelanggan '.$i, 'omni-theme' ),
            'section'  => 'omni_customers_section',
        ) ) );
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
    $pages = ['fitur', 'use-case', 'analitik', 'harga'];
    
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
        'show_ui'     => true,
        'menu_icon'   => 'dashicons-email-alt',
        'supports'    => array('title', 'custom-fields'),
        'capability_type' => 'post',
        'capabilities' => array(
            'create_posts' => 'do_not_allow', // Only via form
        ),
        'map_meta_cap' => true,
    ));
});

// Handle Demo Form Submission via AJAX
add_action('wp_ajax_submit_demo', 'omni_handle_demo_submission');
add_action('wp_ajax_nopriv_submit_demo', 'omni_handle_demo_submission');

function omni_handle_demo_submission() {
    $name = isset($_POST['demo_name']) ? sanitize_text_field($_POST['demo_name']) : '';
    $email = isset($_POST['demo_email']) ? sanitize_email($_POST['demo_email']) : '';
    $phone = isset($_POST['demo_phone']) ? sanitize_text_field($_POST['demo_phone']) : '';

    if (empty($name) || empty($email) || empty($phone)) {
        wp_send_json_error('Mohon lengkapi semua data.');
    }

    $post_id = wp_insert_post(array(
        'post_type'   => 'demo_request',
        'post_title'  => $name . ' - ' . current_time('Y-m-d H:i'),
        'post_status' => 'publish',
        'meta_input'  => array(
            'Nama Lengkap' => $name,
            'Email'        => $email,
            'No WhatsApp'  => $phone,
        )
    ));

    if ($post_id && !is_wp_error($post_id)) {
        wp_send_json_success('Permohonan berhasil dikirim. Tim kami akan segera menghubungi Anda!');
    } else {
        wp_send_json_error('Gagal mengirim permohonan. Silakan coba lagi nanti.');
    }
}
