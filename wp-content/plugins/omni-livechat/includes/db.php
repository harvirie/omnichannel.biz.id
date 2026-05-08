<?php
if ( ! defined( 'ABSPATH' ) ) exit;

register_activation_hook( OMNI_LC_DIR . '../omni-livechat.php', 'omni_lc_create_tables' );

function omni_lc_create_tables() {
    global $wpdb;
    $charset = $wpdb->get_charset_collate();

    // Sessions table
    $sql_sessions = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}lc_sessions (
        id          BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        session_key VARCHAR(64)  NOT NULL,
        nama        VARCHAR(200) NOT NULL,
        perusahaan  VARCHAR(200) NOT NULL DEFAULT '',
        email       VARCHAR(200) NOT NULL,
        whatsapp    VARCHAR(50)  NOT NULL DEFAULT '',
        assigned_to VARCHAR(50)  NOT NULL DEFAULT '',
        status      ENUM('open','closed') NOT NULL DEFAULT 'open',
        ip_address  VARCHAR(45)  NOT NULL DEFAULT '',
        created_at  DATETIME     NOT NULL,
        PRIMARY KEY (id),
        UNIQUE KEY session_key (session_key),
        KEY status (status),
        KEY created_at (created_at)
    ) $charset;";

    // Messages table
    $sql_messages = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}lc_messages (
        id          BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        session_id  BIGINT UNSIGNED NOT NULL,
        sender      ENUM('user','bot','agent') NOT NULL DEFAULT 'user',
        message     TEXT NOT NULL,
        meta        TEXT NOT NULL DEFAULT '',
        created_at  DATETIME NOT NULL,
        PRIMARY KEY (id),
        KEY session_id (session_id),
        KEY created_at (created_at)
    ) $charset;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta( $sql_sessions );
    dbDelta( $sql_messages );
}

// Auto-run on plugin load in case activation hook missed (network activate, etc.)
add_action( 'plugins_loaded', function() {
    if ( get_option( 'omni_lc_db_version' ) !== OMNI_LC_VERSION ) {
        omni_lc_create_tables();
        update_option( 'omni_lc_db_version', OMNI_LC_VERSION );
    }
});
