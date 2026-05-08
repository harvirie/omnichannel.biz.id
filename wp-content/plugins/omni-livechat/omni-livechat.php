<?php
/**
 * Plugin Name: OmniServe Live Chat
 * Plugin URI:  https://omnichannel.biz.id
 * Description: Live Chat widget dengan bot menu, panel admin, jam operasional, dan inbox percakapan.
 * Version:     1.0.0
 * Author:      Harizal
 * License:     GPL2
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'OMNI_LC_VERSION', '1.0.0' );
define( 'OMNI_LC_DIR',     plugin_dir_path( __FILE__ ) );
define( 'OMNI_LC_URL',     plugin_dir_url( __FILE__ ) );

/* ── Load sub-modules ── */
require_once OMNI_LC_DIR . 'includes/db.php';
require_once OMNI_LC_DIR . 'includes/settings.php';
require_once OMNI_LC_DIR . 'includes/ajax.php';
require_once OMNI_LC_DIR . 'includes/admin.php';
require_once OMNI_LC_DIR . 'includes/frontend.php';
