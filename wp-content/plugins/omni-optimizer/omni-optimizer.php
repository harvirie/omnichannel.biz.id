<?php
/**
 * Plugin Name: Omni Optimizer
 * Plugin URI: https://omnichannel.biz.id
 * Description: Ultra-lightweight static page cache & HTML minifier for OmniServe. Drops TTFB from ~1.2s to <0.1s.
 * Version: 2.0.0
 * Author: Kabayan Group
 * License: GPL2
 */

if (!defined('ABSPATH')) {
    exit;
}

define('OMNI_OPTIMIZER_CACHE_DIR', WP_CONTENT_DIR . '/uploads/omni-optimizer');
define('OMNI_OPTIMIZER_VERSION', '2.0.0');

// ═══════════════════════════════════════════════════════════
// ACTIVATION — Buat folder cache
// ═══════════════════════════════════════════════════════════
register_activation_hook(__FILE__, 'omni_optimizer_activate');
function omni_optimizer_activate() {
    if (!file_exists(OMNI_OPTIMIZER_CACHE_DIR)) {
        wp_mkdir_p(OMNI_OPTIMIZER_CACHE_DIR);
    }
}

// ═══════════════════════════════════════════════════════════
// HELPER: Cek apakah user sedang login via cookie
// ═══════════════════════════════════════════════════════════
function omni_optimizer_is_logged_in() {
    foreach ($_COOKIE as $key => $value) {
        if (strpos($key, 'wordpress_logged_in_') === 0) {
            return true;
        }
    }
    return false;
}

// ═══════════════════════════════════════════════════════════
// HELPER: Tentukan apakah URL ini layak di-cache
// ═══════════════════════════════════════════════════════════
function omni_optimizer_is_cacheable() {
    // Hanya GET requests
    if ($_SERVER['REQUEST_METHOD'] !== 'GET') return false;
    // Jangan cache admin
    if (is_admin()) return false;
    // Jangan cache user login
    if (omni_optimizer_is_logged_in()) return false;
    // Jangan cache jika ada query string (kecuali UTM params — abaikan saja)
    $uri = $_SERVER['REQUEST_URI'];
    $query = parse_url($uri, PHP_URL_QUERY);
    if ($query) {
        // Izinkan UTM params tapi abaikan, tidak izinkan query string lain
        parse_str($query, $params);
        $allowed_params = ['utm_source', 'utm_medium', 'utm_campaign', 'utm_term', 'utm_content', 'fbclid', 'gclid'];
        $non_utm = array_diff_key($params, array_flip($allowed_params));
        if (!empty($non_utm)) return false;
    }
    return true;
}

// ═══════════════════════════════════════════════════════════
// HELPER: Dapatkan path file cache
// ═══════════════════════════════════════════════════════════
function omni_optimizer_get_cache_path() {
    $uri = $_SERVER['HTTP_HOST'] . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri = rtrim($uri, '/');
    $hash = md5($uri);
    return OMNI_OPTIMIZER_CACHE_DIR . '/cache_' . $hash . '.html';
}

// ═══════════════════════════════════════════════════════════
// SERVE CACHE — Secepat mungkin, bypass seluruh WP
// ═══════════════════════════════════════════════════════════
add_action('plugins_loaded', 'omni_optimizer_serve_cache', 1);
function omni_optimizer_serve_cache() {
    if (!omni_optimizer_is_cacheable()) return;

    $cache_file = omni_optimizer_get_cache_path();

    if (file_exists($cache_file)) {
        $cache_time = 3600;
        $mtime = filemtime($cache_file);
        $content = file_get_contents($cache_file);
        
        // 304 Not Modified support
        if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE'])) {
            $if_modified = strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']);
            if ($mtime <= $if_modified) {
                header('HTTP/1.1 304 Not Modified');
                exit;
            }
        }

        header('Content-Type: text/html; charset=utf-8');
        header('X-Omni-Cache: HIT');
        header('Cache-Control: public, max-age=' . $cache_time . ', stale-while-revalidate=60');
        header('Expires: ' . gmdate('D, d M Y H:i:s', time() + $cache_time) . ' GMT');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s', $mtime) . ' GMT');
        header('Vary: Accept-Encoding');

        // Gzip compression jika browser support
        $accept_encoding = isset($_SERVER['HTTP_ACCEPT_ENCODING']) ? $_SERVER['HTTP_ACCEPT_ENCODING'] : '';
        if (extension_loaded('zlib') && strpos($accept_encoding, 'gzip') !== false) {
            $compressed = gzencode($content, 6);
            if ($compressed !== false) {
                header('Content-Encoding: gzip');
                header('Content-Length: ' . strlen($compressed));
                echo $compressed;
                exit;
            }
        }

        header('Content-Length: ' . strlen($content));
        echo $content;
        exit;
    }
}

// ═══════════════════════════════════════════════════════════
// CAPTURE OUTPUT & MINIFY HTML
// ═══════════════════════════════════════════════════════════
add_action('template_redirect', 'omni_optimizer_start_buffer', -9999);
function omni_optimizer_start_buffer() {
    // Jangan cache 404, search, feed
    if (!omni_optimizer_is_cacheable() || is_404() || is_search() || is_feed()) return;
    
    header('X-Omni-Cache: MISS');
    ob_start('omni_optimizer_minify_and_cache');
}

function omni_optimizer_minify_and_cache($html) {
    // Validasi: harus ada tag HTML
    if (stripos($html, '<html') === false || strlen($html) < 500) {
        return $html;
    }

    // ── HTML Minification ──
    $minified = $html;
    
    // 1. Hapus komentar HTML (kecuali conditional comments IE)
    $minified = preg_replace('/<!--(?!\s*(?:\[if\s|<!\[endif|Omni Optimizer)).*?-->/s', '', $minified);
    
    // 2. Hapus whitespace berlebih ANTAR tag
    $minified = preg_replace('/>\s{2,}</u', '> <', $minified);
    
    // 3. Hapus baris kosong ganda
    $minified = preg_replace('/^\s*[\r\n]/m', '', $minified);

    // 4. Kompres whitespace di dalam atribut class (opsional, aman)
    $minified = preg_replace('/class="\s+/', 'class="', $minified);
    $minified = preg_replace('/\s+"/', '"', $minified);

    // Tambahkan signature
    $minified .= "\n<!-- Omni Optimizer v" . OMNI_OPTIMIZER_VERSION . ": Cached -->";

    // Simpan ke file cache
    if (!file_exists(OMNI_OPTIMIZER_CACHE_DIR)) {
        wp_mkdir_p(OMNI_OPTIMIZER_CACHE_DIR);
    }
    
    $cache_file = omni_optimizer_get_cache_path();
    file_put_contents($cache_file, $minified, LOCK_EX);

    return $minified;
}

// ═══════════════════════════════════════════════════════════
// PURGE CACHE
// ═══════════════════════════════════════════════════════════
function omni_optimizer_purge_cache() {
    if (!file_exists(OMNI_OPTIMIZER_CACHE_DIR)) return;
    $files = glob(OMNI_OPTIMIZER_CACHE_DIR . '/cache_*.html');
    if ($files) {
        foreach ($files as $file) {
            @unlink($file);
        }
    }
}

// Purge otomatis saat save/delete post
add_action('save_post', 'omni_optimizer_purge_cache');
add_action('deleted_post', 'omni_optimizer_purge_cache');

// Purge saat Omni Editor menyimpan data
add_action('wp_ajax_omni_save_page_meta', 'omni_optimizer_purge_cache', 1);

// Purge saat update tema/plugin
add_action('upgrader_process_complete', 'omni_optimizer_purge_cache');
add_action('switch_theme', 'omni_optimizer_purge_cache');

// ═══════════════════════════════════════════════════════════
// ADMIN BAR — Tombol Purge Manual
// ═══════════════════════════════════════════════════════════
add_action('admin_bar_menu', 'omni_optimizer_admin_bar_menu', 100);
function omni_optimizer_admin_bar_menu($wp_admin_bar) {
    if (!current_user_can('manage_options')) return;
    
    // Hitung jumlah file cache
    $files = glob(OMNI_OPTIMIZER_CACHE_DIR . '/cache_*.html');
    $count = $files ? count($files) : 0;
    
    $wp_admin_bar->add_node([
        'id'    => 'omni_purge_cache',
        'title' => '⚡ Purge Cache (' . $count . ')',
        'href'  => admin_url('admin-post.php?action=omni_purge_cache&_wpnonce=' . wp_create_nonce('omni_purge_cache')),
        'meta'  => ['class' => 'omni-purge-cache-btn']
    ]);
}

add_action('admin_post_omni_purge_cache', 'omni_optimizer_admin_post_purge');
function omni_optimizer_admin_post_purge() {
    if (!current_user_can('manage_options')) wp_die('Unauthorized');
    check_admin_referer('omni_purge_cache');
    omni_optimizer_purge_cache();
    $redirect = wp_get_referer() ?: home_url();
    wp_redirect(add_query_arg('omni_cache_purged', '1', $redirect));
    exit;
}

// Admin notice setelah purge
add_action('admin_notices', function() {
    if (isset($_GET['omni_cache_purged'])) {
        echo '<div class="notice notice-success is-dismissible"><p>✅ Omni Cache berhasil dibersihkan.</p></div>';
    }
});
