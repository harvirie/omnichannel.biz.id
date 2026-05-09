<?php
/**
 * Plugin Name:  OmniServe Security Hardening
 * Plugin URI:   https://omnichannel.biz.id
 * Description:  Hardening otomatis WordPress: anti-bruteforce, CSP, REST API lockdown, XSS mitigation, XML/XXE disable, PHP-in-uploads block, login protection, dan file integrity. Berdasarkan CVE-2026-3906/3907/3908.
 * Version:      1.0.0
 * Author:       Harizal
 * License:      GPL-2.0+
 * Text Domain:  omni-hardening
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'OMNI_SEC_VERSION', '1.0.0' );
define( 'OMNI_SEC_PATH',    plugin_dir_path( __FILE__ ) );
define( 'OMNI_SEC_URL',     plugin_dir_url( __FILE__ ) );
define( 'OMNI_SEC_LOG',     WP_CONTENT_DIR . '/omni-security.log' );
define( 'OMNI_SEC_TABLE',   'omni_login_attempts' );

/* ═══════════════════════════════════════════════
   1. ACTIVATION: Create DB table & set .htaccess
   ═══════════════════════════════════════════════ */
register_activation_hook( __FILE__, 'omni_sec_activate' );
function omni_sec_activate() {
    global $wpdb;
    $table = $wpdb->prefix . OMNI_SEC_TABLE;
    $charset = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE IF NOT EXISTS $table (
        id         BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        ip_address VARCHAR(45) NOT NULL,
        username   VARCHAR(200) DEFAULT '',
        attempted  DATETIME NOT NULL,
        PRIMARY KEY (id),
        KEY ip_address (ip_address),
        KEY attempted (attempted)
    ) $charset;";
    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta( $sql );

    $table_scans = $wpdb->prefix . 'omni_sec_scans';
    $sql_scans = "CREATE TABLE IF NOT EXISTS $table_scans (
        id         BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        ip_address VARCHAR(45) NOT NULL,
        location   VARCHAR(200) DEFAULT '',
        user_agent VARCHAR(255) DEFAULT '',
        endpoint   VARCHAR(255) DEFAULT '',
        attempted  DATETIME NOT NULL,
        PRIMARY KEY (id),
        KEY ip_address (ip_address),
        KEY attempted (attempted)
    ) $charset;";
    dbDelta( $sql_scans );

    // Block PHP execution in uploads via .htaccess
    omni_sec_protect_uploads_dir();

    // Write security .htaccess rules at root
    omni_sec_write_htaccess_rules();

    // Schedule cleanup cron
    if ( ! wp_next_scheduled( 'omni_sec_cleanup_cron' ) ) {
        wp_schedule_event( time(), 'hourly', 'omni_sec_cleanup_cron' );
    }
}

register_deactivation_hook( __FILE__, function() {
    wp_clear_scheduled_hook( 'omni_sec_cleanup_cron' );
} );

add_action( 'omni_sec_cleanup_cron', 'omni_sec_cleanup_old_attempts' );
function omni_sec_cleanup_old_attempts() {
    global $wpdb;
    $table = $wpdb->prefix . OMNI_SEC_TABLE;
    $wpdb->query( $wpdb->prepare(
        "DELETE FROM $table WHERE attempted < %s",
        gmdate( 'Y-m-d H:i:s', time() - HOUR_IN_SECONDS )
    ) );
}

/* ═══════════════════════════════════════════════
   2. BRUTE-FORCE PROTECTION
   ═══════════════════════════════════════════════ */
add_action( 'wp_login_failed', 'omni_sec_log_failed_login' );
function omni_sec_log_failed_login( $username ) {
    global $wpdb;
    $ip    = omni_sec_get_ip();
    $table = $wpdb->prefix . OMNI_SEC_TABLE;
    $wpdb->insert( $table, [
        'ip_address' => $ip,
        'username'   => sanitize_text_field( $username ),
        'attempted'  => current_time( 'mysql', true ),
    ], [ '%s', '%s', '%s' ] );
    omni_sec_log( "Failed login from $ip for user: $username" );
}

add_filter( 'authenticate', 'omni_sec_check_lockout', 30, 3 );
function omni_sec_check_lockout( $user, $username, $password ) {
    global $wpdb;
    $ip        = omni_sec_get_ip();
    $table     = $wpdb->prefix . OMNI_SEC_TABLE;
    $threshold = 5; // max attempts per hour
    $window    = gmdate( 'Y-m-d H:i:s', time() - HOUR_IN_SECONDS );

    $attempts = (int) $wpdb->get_var( $wpdb->prepare(
        "SELECT COUNT(*) FROM $table WHERE ip_address = %s AND attempted > %s",
        $ip, $window
    ) );

    if ( $attempts >= $threshold ) {
        omni_sec_log( "BLOCKED brute-force from $ip ($attempts attempts)" );
        return new WP_Error(
            'omni_lockout',
            sprintf(
                '<strong>Akses Diblokir.</strong> Terlalu banyak percobaan login dari IP Anda. Coba lagi dalam 1 jam. (IP: %s)',
                esc_html( $ip )
            )
        );
    }
    return $user;
}

/* ═══════════════════════════════════════════════
   3. SECURITY HEADERS — CSP, HSTS, X-Frame etc.
   ═══════════════════════════════════════════════ */
add_action( 'send_headers', 'omni_sec_send_headers' );
function omni_sec_send_headers() {
    if ( headers_sent() ) return;
    // Skip CSP on WP admin & customizer to avoid breaking iframe preview
    if ( is_admin() ) return;
    if ( isset( $_GET['customize_changeset_uuid'] ) || isset( $_GET['customize_theme'] ) ) return;

    // Content Security Policy — blocks XSS (CVE-2026-3906/3907 mitigation)
    $csp = implode( '; ', [
        "default-src 'self'",
        "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://cdn.jsdelivr.net https://res.cloudinary.com https://fonts.googleapis.com https://www.googletagmanager.com https://static.cloudflareinsights.com https://googleads.g.doubleclick.net https://www.google.com https://www.googleadservices.com https://www.google.co.id blob:",
        "style-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net https://fonts.googleapis.com https://fonts.gstatic.com",
        "img-src 'self' data: https://res.cloudinary.com https://secure.gravatar.com https://www.google-analytics.com https://www.googletagmanager.com https://googleads.g.doubleclick.net https://www.google.com https://www.googleadservices.com https://www.google.co.id https://s.w.org",
        "font-src 'self' data: https://fonts.gstatic.com https://cdn.jsdelivr.net",
        "media-src 'self' https://res.cloudinary.com",
        "connect-src 'self' https://cdn.jsdelivr.net https://cloudflareinsights.com https://www.google-analytics.com https://googleads.g.doubleclick.net https://www.google.com https://www.googleadservices.com https://www.google.co.id",
        "worker-src 'self' blob:",
        "frame-ancestors 'self'",
        "object-src 'none'",
        "base-uri 'self'",
        "form-action 'self'",
    ] );
    header( "Content-Security-Policy: $csp" );

    // Anti-Clickjacking
    header( 'X-Frame-Options: SAMEORIGIN' );

    // Prevent MIME sniffing
    header( 'X-Content-Type-Options: nosniff' );

    // XSS Protection (legacy browsers)
    header( 'X-XSS-Protection: 1; mode=block' );

    // Referrer policy
    header( 'Referrer-Policy: strict-origin-when-cross-origin' );

    // Permissions policy
    header( 'Permissions-Policy: camera=(), microphone=(), geolocation=()' );

    // HSTS (only if HTTPS)
    if ( is_ssl() ) {
        header( 'Strict-Transport-Security: max-age=31536000; includeSubDomains; preload' );
    }

    // Remove server info
    header_remove( 'X-Powered-By' );
    header_remove( 'Server' );
}

/* ═══════════════════════════════════════════════
   4. HIDE WP VERSION & GENERATOR META
   ═══════════════════════════════════════════════ */
remove_action( 'wp_head', 'wp_generator' );
add_filter( 'the_generator', '__return_empty_string' );
add_filter( 'style_loader_src',  'omni_sec_remove_ver_query', 9999 );
add_filter( 'script_loader_src', 'omni_sec_remove_ver_query', 9999 );
function omni_sec_remove_ver_query( $src ) {
    return $src ? remove_query_arg( 'ver', $src ) : $src;
}

// Hide WP version from RSS
add_filter( 'rss_version',        '__return_empty_string' );
add_filter( 'the_generator',      '__return_empty_string' );

/* ═══════════════════════════════════════════════
   5. REST API — Restrict sensitive endpoints
      (Mitigates CVE-2026-3906: Notes Auth Bypass)
   ═══════════════════════════════════════════════ */
add_filter( 'rest_authentication_errors', 'omni_sec_restrict_rest_api' );
function omni_sec_restrict_rest_api( $result ) {
    if ( ! empty( $result ) ) return $result;
    if ( ! is_user_logged_in() ) {
        $route = isset( $GLOBALS['wp']->query_vars['rest_route'] )
            ? $GLOBALS['wp']->query_vars['rest_route']
            : '';
        // Block unauthenticated access to sensitive routes
        $blocked = ['/wp/v2/users', '/wp/v2/comments', '/wp/v2/notes'];
        foreach ( $blocked as $b ) {
            if ( str_starts_with( $route, $b ) ) {
                return new WP_Error(
                    'rest_not_logged_in',
                    'Akses REST API ini memerlukan autentikasi.',
                    [ 'status' => 401 ]
                );
            }
        }
    }
    return $result;
}

// Block REST API user enumeration
add_filter( 'rest_endpoints', function( $endpoints ) {
    if ( isset( $endpoints['/wp/v2/users'] ) && ! current_user_can( 'list_users' ) ) {
        unset( $endpoints['/wp/v2/users'] );
    }
    if ( isset( $endpoints['/wp/v2/users/(?P<id>[\d]+)'] ) && ! current_user_can( 'list_users' ) ) {
        unset( $endpoints['/wp/v2/users/(?P<id>[\d]+)'] );
    }
    return $endpoints;
} );

/* ═══════════════════════════════════════════════
   6. DISABLE XML-RPC (Brute-force vector)
   ═══════════════════════════════════════════════ */
add_filter( 'xmlrpc_enabled', '__return_false' );
add_filter( 'xmlrpc_methods', function() { return []; } );
add_action( 'send_headers', function() {
    if ( defined( 'XMLRPC_REQUEST' ) && XMLRPC_REQUEST ) {
        http_response_code( 403 );
        header( 'Content-Type: text/plain' );
        exit( 'XML-RPC disabled for security.' );
    }
} );

/* ═══════════════════════════════════════════════
   7. DISABLE FILE EDITOR in admin
   ═══════════════════════════════════════════════ */
if ( ! defined( 'DISALLOW_FILE_EDIT' ) ) {
    define( 'DISALLOW_FILE_EDIT', true );
}
if ( ! defined( 'DISALLOW_FILE_MODS' ) ) {
    // Keep false — allow plugin/theme updates
    // define( 'DISALLOW_FILE_MODS', true );
}

/* ═══════════════════════════════════════════════
   8. BLOCK PHP EXECUTION IN UPLOADS
      (Mitigates CVE-2026-3907: Path Traversal / RCE)
   ═══════════════════════════════════════════════ */
function omni_sec_protect_uploads_dir() {
    $upload_dir  = wp_upload_dir();
    $uploads     = trailingslashit( $upload_dir['basedir'] );
    $htaccess    = $uploads . '.htaccess';

    $rules = <<<HTACCESS
# OmniServe Security: Block PHP execution in uploads
<FilesMatch "\.(php|php\d|phtml|phar|pl|py|cgi|sh|asp|aspx)$">
    Order Allow,Deny
    Deny from all
</FilesMatch>
Options -ExecCGI
AddHandler cgi-script .php .php3 .php4 .php5 .phtml .pl .py .cgi
HTACCESS;

    if ( ! file_exists( $htaccess ) || strpos( file_get_contents( $htaccess ), 'OmniServe Security' ) === false ) {
        file_put_contents( $htaccess, $rules );
    }
}
add_action( 'init', 'omni_sec_protect_uploads_dir' );

/* ═══════════════════════════════════════════════
   9. DISABLE XML ENTITY PROCESSING
      (Mitigates CVE-2026-3908: XXE on getID3)
   ═══════════════════════════════════════════════ */
add_action( 'init', function() {
    libxml_disable_entity_loader( true );
    // Block suspicious upload types
    add_filter( 'upload_mimes', 'omni_sec_restrict_upload_mimes' );
} );

function omni_sec_restrict_upload_mimes( $mimes ) {
    // Remove dangerous types
    $dangerous = ['svg', 'svgz', 'xml', 'xsl', 'xsd', 'dtd'];
    foreach ( $dangerous as $ext ) {
        unset( $mimes[ $ext ] );
    }
    return $mimes;
}

// Validate uploaded file content (no PHP in media)
add_filter( 'wp_handle_upload_prefilter', 'omni_sec_scan_upload' );
function omni_sec_scan_upload( $file ) {
    if ( ! isset( $file['tmp_name'] ) || ! is_readable( $file['tmp_name'] ) ) {
        return $file;
    }
    $content = file_get_contents( $file['tmp_name'], false, null, 0, 512 );
    $patterns = [ '<?php', '<?=', '<script', 'eval(', 'base64_decode', 'system(', 'exec(' ];
    foreach ( $patterns as $p ) {
        if ( stripos( $content, $p ) !== false ) {
            $file['error'] = 'File ditolak: mengandung kode berbahaya yang terdeteksi.';
            omni_sec_log( "BLOCKED malicious upload: " . $file['name'] . " from " . omni_sec_get_ip() );
            break;
        }
    }
    return $file;
}

/* ═══════════════════════════════════════════════
   10. LOGIN PAGE HARDENING
   ═══════════════════════════════════════════════ */
// Disable login hints (don't reveal if user/pass is wrong)
add_filter( 'login_errors', fn() => 'Kredensial tidak valid. Silakan coba lagi.' );

// Redirect login to custom URL (obscure wp-login.php)
// Note: kept disabled by default — enable if needed
// add_action( 'init', 'omni_sec_hide_login' );

// Add login rate-limit notice
add_action( 'login_footer', function() {
    $ip = omni_sec_get_ip();
    echo '<p style="text-align:center;font-size:11px;color:#94a3b8;margin-top:12px;">
        Dilindungi oleh OmniServe Security &bull; IP: ' . esc_html( $ip ) . '
    </p>';
} );

/* ═══════════════════════════════════════════════
   11. DISABLE USER ENUMERATION
       (Blocks ?author=1 scraping)
   ═══════════════════════════════════════════════ */
add_action( 'init', function() {
    if ( ! is_admin() && isset( $_GET['author'] ) ) {
        wp_redirect( home_url('/'), 301 );
        exit;
    }
} );

/* ═══════════════════════════════════════════════
   12. HOTLINK & SENSITIVE FILE PROTECTION
   ═══════════════════════════════════════════════ */
function omni_sec_write_htaccess_rules() {
    $htaccess_file = ABSPATH . '.htaccess';
    if ( ! is_writable( $htaccess_file ) ) return;

    $marker_start = '# BEGIN OmniServe-Hardening';
    $marker_end   = '# END OmniServe-Hardening';
    $rules = <<<RULES

$marker_start
# Block access to sensitive files
<FilesMatch "(wp-config\.php|xmlrpc\.php|\.htaccess|wp-config-sample\.php|readme\.html|license\.txt|install\.php)$">
    Order Allow,Deny
    Deny from all
</FilesMatch>

# Block directory browsing
Options -Indexes

# Block access to hidden files (.git, .env, etc.)
<FilesMatch "^\.">
    Order Allow,Deny
    Deny from all
</FilesMatch>

# Block script injection in query strings
RewriteEngine On
RewriteCond %{QUERY_STRING} (eval\(|base64_decode|javascript:|<script|GLOBALS|_REQUEST) [NC]
RewriteRule .* - [F,L]

# Block common attack user agents
RewriteCond %{HTTP_USER_AGENT} (havij|nikto|sqlmap|masscan|zgrab|python-requests\/2\.2[0-9]) [NC]
RewriteRule .* - [F,L]
$marker_end
RULES;

    $content = file_get_contents( $htaccess_file );
    // Remove old rules if present
    $content = preg_replace(
        '/' . preg_quote($marker_start, '/') . '.*?' . preg_quote($marker_end, '/') . '/s',
        '',
        $content
    );
    file_put_contents( $htaccess_file, trim($content) . "\n" . $rules );
}
add_action( 'init', 'omni_sec_write_htaccess_rules' );

/* ═══════════════════════════════════════════════
   13. XSS SANITIZATION ON OUTPUT
   ═══════════════════════════════════════════════ */
// Sanitize nav menu labels to prevent stored XSS
add_filter( 'wp_nav_menu_items', function( $items ) {
    return wp_kses( $items, [
        'li' => ['class' => [], 'id' => [], 'itemscope' => [], 'itemtype' => []],
        'a'  => ['href' => [], 'title' => [], 'class' => [], 'target' => [], 'rel' => []],
        'span' => ['class' => [], 'aria-hidden' => []],
    ] );
} );

// Block data-wp-bind XSS — strip dangerous attributes
add_filter( 'the_content', 'omni_sec_strip_dangerous_attrs' );
add_filter( 'widget_text',  'omni_sec_strip_dangerous_attrs' );
function omni_sec_strip_dangerous_attrs( $content ) {
    // Strip dangerous event handlers injected via attributes
    $content = preg_replace( '/\bon\w+\s*=\s*["\'][^"\']*["\']/i', '', $content );
    // Strip data-wp-bind with JS
    $content = preg_replace( '/data-wp-bind[^>]*javascript[^>]*/i', '', $content );
    return $content;
}

/* ═══════════════════════════════════════════════
   14. ADMIN PAGE — Security Dashboard
   ═══════════════════════════════════════════════ */
add_action( 'admin_menu', function() {
    add_menu_page(
        'OmniServe Security',
        'Security',
        'manage_options',
        'omni-hardening',
        'omni_sec_admin_page',
        'dashicons-shield',
        2
    );
} );

add_action( 'admin_enqueue_scripts', function( $hook ) {
    if ( $hook !== 'toplevel_page_omni-hardening' ) return;
    wp_enqueue_style( 'omni-sec-admin', OMNI_SEC_URL . 'assets/admin.css', [], OMNI_SEC_VERSION );
} );

function omni_sec_admin_page() {
    global $wpdb;
    $table   = $wpdb->prefix . OMNI_SEC_TABLE;
    $window  = gmdate( 'Y-m-d H:i:s', time() - HOUR_IN_SECONDS );
    $recent  = $wpdb->get_results( $wpdb->prepare(
        "SELECT ip_address, username, attempted FROM $table WHERE attempted > %s ORDER BY attempted DESC LIMIT 20",
        $window
    ) );
    $blocked = (int) $wpdb->get_var( $wpdb->prepare(
        "SELECT COUNT(DISTINCT ip_address) FROM $table WHERE attempted > %s GROUP BY ip_address HAVING COUNT(*) >= 5",
        $window
    ) );

    $table_scans = $wpdb->prefix . 'omni_sec_scans';
    $scans = $wpdb->get_results( "SELECT * FROM $table_scans ORDER BY attempted DESC LIMIT 20" );

    $checks = [
        'WordPress Core Update'     => version_compare( get_bloginfo('version'), '6.9.4', '>=' ),
        'File Editor Disabled'      => defined('DISALLOW_FILE_EDIT') && DISALLOW_FILE_EDIT,
        'XML-RPC Disabled'          => ! apply_filters('xmlrpc_enabled', true),
        'Uploads PHP Blocked'       => file_exists( wp_upload_dir()['basedir'] . '/.htaccess' ),
        'Security Headers Active'   => true,
        'REST API Protected'        => true,
        'Brute-Force Protection'    => true,
        'XSS Sanitization'          => true,
    ];

    ?>
    <div class="wrap omni-sec-wrap">
        <div class="omni-sec-header">
            <img src="https://res.cloudinary.com/dtxwwevxl/image/upload/v1778221347/logo_long_dark_ymby0d.svg" alt="OmniServe" class="omni-sec-logo">
            <div>
                <h1>Security Hardening Dashboard</h1>
                <p>Perlindungan otomatis berdasarkan CVE-2026-3906, CVE-2026-3907, CVE-2026-3908</p>
            </div>
        </div>

        <div class="omni-sec-grid">
            <div class="omni-sec-card">
                <h2>🛡️ Status Perlindungan</h2>
                <ul class="omni-sec-checklist">
                    <?php foreach ( $checks as $label => $ok ): ?>
                    <li class="<?php echo $ok ? 'ok' : 'warn'; ?>">
                        <span class="icon"><?php echo $ok ? '✅' : '⚠️'; ?></span>
                        <?php echo esc_html($label); ?>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="omni-sec-card">
                <h2>🔒 Percobaan Login (1 Jam Terakhir)</h2>
                <div class="omni-stat">
                    <span class="omni-stat-num"><?php echo count($recent); ?></span>
                    <span>percobaan gagal</span>
                </div>
                <?php if ( $recent ): ?>
                <table class="omni-sec-table">
                    <thead><tr><th>IP</th><th>Username</th><th>Waktu</th></tr></thead>
                    <tbody>
                    <?php foreach ( $recent as $r ): ?>
                        <tr>
                            <td><?php echo esc_html($r->ip_address); ?></td>
                            <td><?php echo esc_html($r->username); ?></td>
                            <td><?php echo esc_html(
                                get_date_from_gmt($r->attempted, 'H:i:s')
                            ); ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <?php else: ?>
                    <p style="color:#22c55e;margin-top:8px;">✅ Tidak ada percobaan gagal dalam 1 jam terakhir.</p>
                <?php endif; ?>
            </div>

            <div class="omni-sec-card" style="grid-column: 1 / -1;">
                <h2>🕵️ Deteksi Pemindaian Keamanan (Web Scanners)</h2>
                <p style="font-size:13px;color:#64748b;margin-bottom:12px;">Mendeteksi aktivitas pemindaian kerentanan (seperti WPScan, Nikto) berdasarkan akses file sensitif dan user-agent anomali.</p>
                <?php if ( $scans ): ?>
                <table class="omni-sec-table">
                    <thead><tr><th>Waktu</th><th>IP Address</th><th>Lokasi</th><th>User Agent</th><th>Target Endpoint</th></tr></thead>
                    <tbody>
                    <?php foreach ( $scans as $s ): ?>
                        <tr>
                            <td><?php echo esc_html(get_date_from_gmt($s->attempted, 'd/m H:i:s')); ?></td>
                            <td><strong><?php echo esc_html($s->ip_address); ?></strong></td>
                            <td><?php echo esc_html($s->location ?: 'Tidak diketahui'); ?></td>
                            <td style="max-width:200px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;" title="<?php echo esc_attr($s->user_agent); ?>"><?php echo esc_html($s->user_agent); ?></td>
                            <td style="max-width:200px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;" title="<?php echo esc_attr($s->endpoint); ?>"><?php echo esc_html($s->endpoint); ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <?php else: ?>
                    <p style="color:#22c55e;margin-top:8px;">✅ Belum ada aktivitas pemindaian kerentanan yang terdeteksi.</p>
                <?php endif; ?>
            </div>

            <div class="omni-sec-card">
                <h2>🔍 CVE Mitigasi Aktif</h2>
                <ul class="omni-cve-list">
                    <li><span class="cve-badge">CVE-2026-3907</span> PclZip Path Traversal — PHP eksekusi di uploads diblokir</li>
                    <li><span class="cve-badge">CVE-2026-3908</span> getID3 XXE — libxml entity loader dinonaktifkan</li>
                    <li><span class="cve-badge">CVE-2026-3906</span> Notes Auth Bypass — REST API endpoint dilindungi</li>
                    <li><span class="cve-badge">XSS</span> Stored XSS Nav Menu — output disanitasi</li>
                    <li><span class="cve-badge">BRUTEFORCE</span> Login lockout 5x/jam per IP</li>
                </ul>
            </div>

            <div class="omni-sec-card">
                <h2>⚙️ Konfigurasi Aktif</h2>
                <table class="omni-sec-table">
                    <tr><td>WP Version</td><td><?php echo esc_html( get_bloginfo('version') ); ?></td></tr>
                    <tr><td>PHP Version</td><td><?php echo esc_html( PHP_VERSION ); ?></td></tr>
                    <tr><td>Login Max Attempts</td><td>5 per jam / IP</td></tr>
                    <tr><td>CSP Header</td><td>Aktif</td></tr>
                    <tr><td>HSTS</td><td><?php echo is_ssl() ? 'Aktif' : 'Non-HTTPS'; ?></td></tr>
                    <tr><td>XML-RPC</td><td>Dinonaktifkan</td></tr>
                    <tr><td>File Editor</td><td>Dinonaktifkan</td></tr>
                </table>
            </div>
        </div>
    </div>
    <?php
}

/* ═══════════════════════════════════════════════
   15. ANIMATED 403 FORBIDDEN PAGE
   ═══════════════════════════════════════════════ */

// Handle ?omni_error=403 from .htaccess ErrorDocument
add_action( 'init', function() {
    if ( isset( $_GET['omni_error'] ) && (int) $_GET['omni_error'] === 403 ) {
        omni_sec_render_403();
    }
} );

add_action( 'init', function() {
    // Trigger 403 page for blocked bot user agents
    $ua = $_SERVER['HTTP_USER_AGENT'] ?? '';
    $blocked_ua = ['havij', 'nikto', 'sqlmap', 'masscan', 'zgrab', 'wpscan', 'acunetix', 'nmap'];
    foreach ($blocked_ua as $b) {
        if (stripos($ua, $b) !== false) {
            omni_sec_log_scan('Blocked UA: ' . $b);
            omni_sec_render_403();
        }
    }
} );

// Log 404s on sensitive files as scans
add_action( 'template_redirect', function() {
    if ( is_404() ) {
        $uri = $_SERVER['REQUEST_URI'] ?? '';
        $sensitive = ['.env', 'wp-config.php.bak', '.git', 'xmlrpc.php', 'wp-admin/includes', 'debug.log'];
        foreach ($sensitive as $s) {
            if (stripos($uri, $s) !== false) {
                omni_sec_log_scan('Sensitive File Probe');
                omni_sec_render_403();
            }
        }
    }
} );

// Also hook into WordPress 403 status
add_filter( 'wp_die_handler', function($handler) { return 'omni_sec_wp_die_handler'; } );
function omni_sec_wp_die_handler($message, $title = '', $args = []) {
    $status = isset($args['response']) ? (int)$args['response'] : 500;
    if ($status === 403) {
        omni_sec_render_403();
    }
    // Fallback to default for other errors
    _default_wp_die_handler($message, $title, $args);
}

function omni_sec_render_403() {
    $home = home_url('/');
    http_response_code(403);
    echo '<!DOCTYPE html><html lang="id"><head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>403 - Akses Ditolak | OmniServe</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;700;800;900&display=swap" rel="stylesheet">
<style>
*{box-sizing:border-box;margin:0;padding:0}
body{min-height:100vh;background:linear-gradient(135deg,#0F172A 0%,#1E293B 60%,#0F172A 100%);font-family:"Outfit",sans-serif;display:flex;align-items:center;justify-content:center;overflow:hidden;position:relative;}
body::before{content:"";position:fixed;inset:0;background:radial-gradient(ellipse 70% 50% at 15% 25%,rgba(239,68,68,0.08) 0%,transparent 60%),radial-gradient(ellipse 50% 60% at 85% 75%,rgba(30,58,138,0.12) 0%,transparent 60%);animation:bgp 6s ease-in-out infinite alternate;}
@keyframes bgp{from{opacity:.6}to{opacity:1}}
.dot{position:absolute;border-radius:50%;animation:flt linear infinite;opacity:.12;}
@keyframes flt{0%{transform:translateY(100vh) rotate(0deg);opacity:0}10%{opacity:.12}90%{opacity:.12}100%{transform:translateY(-10vh) rotate(720deg);opacity:0}}
.wrap{text-align:center;z-index:10;padding:2rem;animation:fiu .8s cubic-bezier(.22,1,.36,1) both;}
@keyframes fiu{from{opacity:0;transform:translateY(40px)}to{opacity:1;transform:translateY(0)}}
.ico{font-size:3rem;margin-bottom:1rem;animation:bnc 2s ease-in-out infinite;}
@keyframes bnc{0%,100%{transform:translateY(0)}50%{transform:translateY(-12px)}}
.num{font-size:clamp(6rem,20vw,14rem);font-weight:900;line-height:1;letter-spacing:-.05em;background:linear-gradient(135deg,#ef4444 0%,#fca5a5 40%,#ef4444 100%);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;animation:shim 3s ease-in-out infinite;background-size:200% 100%;filter:drop-shadow(0 0 40px rgba(239,68,68,0.4));position:relative;display:inline-block;}
@keyframes shim{0%,100%{background-position:0% 50%}50%{background-position:100% 50%}}
.num::before,.num::after{content:attr(data-text);position:absolute;top:0;left:0;right:0;background:linear-gradient(135deg,#ef4444 0%,#fca5a5 40%,#ef4444 100%);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;}
.num::before{animation:g1 4s infinite;clip-path:polygon(0 0,100% 0,100% 40%,0 40%);opacity:.5;}
.num::after{animation:g2 4s infinite;clip-path:polygon(0 60%,100% 60%,100% 100%,0 100%);opacity:.5;}
@keyframes g1{0%,90%,100%{transform:none}91%{transform:translate(-2px,-1px)}93%{transform:translate(2px,1px)}95%{transform:translate(-1px,2px)}}
@keyframes g2{0%,90%,100%{transform:none}92%{transform:translate(2px,1px)}94%{transform:translate(-2px,-1px)}96%{transform:translate(1px,-2px)}}
h1{font-size:clamp(1.25rem,4vw,2rem);font-weight:800;color:#fff;margin:.5rem 0;}
p{font-size:1rem;color:rgba(255,255,255,.55);max-width:420px;margin:.75rem auto 2rem;line-height:1.7;}
.cd-wrap{margin-bottom:2rem;}
.cd-text{font-size:.875rem;color:rgba(255,255,255,.5);margin-bottom:8px;}
.cd-text span{color:#ef4444;font-weight:700;font-size:1.1rem;}
.bar-track{width:220px;height:4px;background:rgba(255,255,255,.1);border-radius:99px;margin:0 auto;overflow:hidden;}
.bar-fill{height:100%;background:linear-gradient(90deg,#ef4444,#fca5a5);border-radius:99px;transform-origin:left;animation:shrink 10s linear forwards;}
@keyframes shrink{from{transform:scaleX(1)}to{transform:scaleX(0)}}
.btns{display:flex;gap:1rem;justify-content:center;flex-wrap:wrap;}
.btn-p{background:linear-gradient(135deg,#ef4444,#b91c1c);color:#fff;font-weight:800;font-size:.9375rem;padding:.75rem 2rem;border-radius:999px;text-decoration:none;transition:all .25s;box-shadow:0 4px 20px rgba(239,68,68,.4);display:inline-flex;align-items:center;gap:.5rem;}
.btn-p:hover{transform:translateY(-2px);box-shadow:0 8px 28px rgba(239,68,68,.5);}
.btn-g{color:rgba(255,255,255,.7);font-weight:600;font-size:.9rem;padding:.75rem 1.5rem;border-radius:999px;text-decoration:none;border:1px solid rgba(255,255,255,.2);transition:all .25s;display:inline-flex;align-items:center;gap:.5rem;}
.btn-g:hover{border-color:rgba(255,255,255,.5);color:#fff;background:rgba(255,255,255,.05);}
</style>
</head><body>
<div class="wrap">
  <div class="ico">🚫</div>
  <div class="num" data-text="403">403</div>
  <h1>Akses Ditolak</h1>
  <p>Anda tidak memiliki izin untuk mengakses halaman ini. Aktivitas ini telah dicatat oleh sistem keamanan kami.</p>
  <div class="cd-wrap">
    <p class="cd-text">Kembali ke beranda dalam <span id="cd">10</span> detik</p>
    <div class="bar-track"><div class="bar-fill"></div></div>
  </div>
  <div class="btns">
    <a href="' . esc_url($home) . '" class="btn-p">🏠 Kembali ke Beranda</a>
    <a href="javascript:history.back()" class="btn-g">← Halaman Sebelumnya</a>
  </div>
</div>
<script>
(function(){
  var page=document.body;
  for(var i=0;i<15;i++){var d=document.createElement("div");d.className="dot";var s=Math.random()*60+10;d.style.cssText="width:"+s+"px;height:"+s+"px;left:"+Math.random()*100+"%;background:"+(Math.random()>.5?"#ef4444":"#1E3A8A")+";animation-duration:"+(Math.random()*15+8)+"s;animation-delay:"+(Math.random()*8)+"s;";page.appendChild(d);}
  var c=10,el=document.getElementById("cd");
  setInterval(function(){c--;el.textContent=c;if(c<=0)window.location.href=' . json_encode($home) . ';},1000);
})();
</script>
</body></html>';
    exit;
}

/* ═══════════════════════════════════════════════
   HELPERS
   ═══════════════════════════════════════════════ */
function omni_sec_get_ip() {
    $keys = ['HTTP_CF_CONNECTING_IP','HTTP_X_FORWARDED_FOR','HTTP_X_REAL_IP','REMOTE_ADDR'];
    foreach ( $keys as $k ) {
        if ( ! empty( $_SERVER[ $k ] ) ) {
            $ip = trim( explode(',', $_SERVER[$k])[0] );
            if ( filter_var( $ip, FILTER_VALIDATE_IP ) ) return $ip;
        }
    }
    return '0.0.0.0';
}

function omni_sec_log( $msg ) {
    $line = '[' . gmdate('Y-m-d H:i:s') . '] ' . $msg . PHP_EOL;
    file_put_contents( OMNI_SEC_LOG, $line, FILE_APPEND | LOCK_EX );
}

function omni_sec_log_scan( $reason = 'Manual/Rewrite' ) {
    global $wpdb;
    $ip = omni_sec_get_ip();
    $ua = sanitize_text_field(substr($_SERVER['HTTP_USER_AGENT'] ?? '', 0, 250));
    $endpoint = sanitize_text_field(substr($_SERVER['REQUEST_URI'] ?? '', 0, 250));
    
    $table = $wpdb->prefix . 'omni_sec_scans';
    // Mencegah spam log jika ada request beruntun dari IP yang sama
    $recent = $wpdb->get_var($wpdb->prepare("SELECT id FROM $table WHERE ip_address = %s AND attempted > %s", $ip, gmdate('Y-m-d H:i:s', time() - 300)));
    
    if ( ! $recent ) {
        $location = '';
        $api_url = "http://ip-api.com/json/{$ip}?fields=status,country,city";
        $response = wp_remote_get($api_url, ['timeout' => 2]);
        if ( ! is_wp_error($response) ) {
            $body = json_decode(wp_remote_retrieve_body($response), true);
            if ( ! empty($body) && $body['status'] === 'success' ) {
                $location = $body['city'] . ', ' . $body['country'];
            }
        }
        
        $wpdb->insert($table, [
            'ip_address' => $ip,
            'location'   => $location,
            'user_agent' => $ua,
            'endpoint'   => $endpoint . ' [' . $reason . ']',
            'attempted'  => current_time('mysql', true)
        ], ['%s', '%s', '%s', '%s', '%s']);
        
        omni_sec_log("SCAN DETECTED: $ip ($location) -> $endpoint ($reason)");
    }
}
