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
}
add_action( 'customize_register', 'omni_theme_customize_register' );
