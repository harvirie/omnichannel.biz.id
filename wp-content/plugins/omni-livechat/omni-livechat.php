<?php
/**
 * Plugin Name: OmniServe Live Chat
 * Plugin URI:  https://omnichannel.biz.id
 * Description: Live Chat widget dengan bot menu, panel admin, jam operasional, dan inbox percakapan.
 * Version:     1.1.1
 * Tested up to: 6.9.4
 * Update Info: (2026-05-09) Penyesuaian pengecekan state form WA untuk mencegah tumpang tindih UI.
 * Author:      Harizal
 * License:     GPL2
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'OMNI_LC_VERSION', '1.1.0' );
define( 'OMNI_LC_DIR',     plugin_dir_path( __FILE__ ) );
define( 'OMNI_LC_URL',     plugin_dir_url( __FILE__ ) );

/* ── Load sub-modules ── */
require_once OMNI_LC_DIR . 'includes/db.php';
require_once OMNI_LC_DIR . 'includes/settings.php';
require_once OMNI_LC_DIR . 'includes/ajax.php';
require_once OMNI_LC_DIR . 'includes/admin.php';
require_once OMNI_LC_DIR . 'includes/frontend.php';

/* ── One-time migration: upgrade bot_menus to 2-level default ── */
add_action( 'init', function() {
    if ( get_option( 'omni_lc_db_version' ) === OMNI_LC_VERSION ) return;

    $current = get_option( 'omni_lc_settings', [] );
    $defaults = omni_lc_defaults();

    // If no bot_menus, or still old single-level structure (no children with messages)
    $needs_update = empty( $current['bot_menus'] );
    if ( ! $needs_update && ! empty( $current['bot_menus'] ) ) {
        // Check if any child has a message field — old defaults don't
        $first_child = $current['bot_menus'][0]['children'][0] ?? null;
        if ( $first_child && empty( $first_child['message'] ) ) {
            $needs_update = true;
        }
    }

    if ( $needs_update ) {
        $current['bot_menus'] = $defaults['bot_menus'];
        update_option( 'omni_lc_settings', $current );
    }

    update_option( 'omni_lc_db_version', OMNI_LC_VERSION );
} );

