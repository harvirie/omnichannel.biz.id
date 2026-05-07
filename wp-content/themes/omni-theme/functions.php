<?php
function omni_theme_enqueue_styles() {
    wp_enqueue_style( 'omni-style', get_stylesheet_uri(), array(), '1.0.0' );
}
add_action( 'wp_enqueue_scripts', 'omni_theme_enqueue_styles' );
