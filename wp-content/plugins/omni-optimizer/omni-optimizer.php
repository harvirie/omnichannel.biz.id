<?php
/**
 * Plugin Name: Omni Optimizer
 * Plugin URI: https://omnichannel.biz.id
 * Description: Ultra-lightweight page cache & HTML minifier designed specifically for OmniServe. Drops TTFB from ~1.2s to <0.1s.
 * Version: 1.0.0
 * Author: Kabayan Group
 * License: GPL2
 */

if (!defined('ABSPATH')) {
    exit;
}

define('OMNI_OPTIMIZER_CACHE_DIR', WP_CONTENT_DIR . '/cache/omni-optimizer');

// 1. BUAT FOLDER CACHE JIKA BELUM ADA
register_activation_hook(__FILE__, 'omni_optimizer_activate');
function omni_optimizer_activate() {
    if (!file_exists(OMNI_OPTIMIZER_CACHE_DIR)) {
        wp_mkdir_p(OMNI_OPTIMIZER_CACHE_DIR);
    }
}

// FUNGSI BANTUAN: Cek apakah user sedang login berdasarkan cookie
function omni_optimizer_is_logged_in() {
    foreach ($_COOKIE as $key => $value) {
        if (strpos($key, 'wordpress_logged_in_') === 0) {
            return true;
        }
    }
    return false;
}

// FUNGSI BANTUAN: Dapatkan path file cache
function omni_optimizer_get_cache_path() {
    $url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    // Abaikan query string untuk cache statis (opsional: jika ingin cache beda per query string, gunakan md5 full)
    $url = preg_replace('/\?.*/', '', $url);
    $hash = md5($url);
    return OMNI_OPTIMIZER_CACHE_DIR . '/cache_' . $hash . '.html';
}

// 2. SERVE CACHE SECEPAT MUNGKIN (Bypass WP Engine)
add_action('plugins_loaded', 'omni_optimizer_serve_cache', 1);
function omni_optimizer_serve_cache() {
    // Jangan serve cache jika method bukan GET, atau user login, atau sedang di halaman admin
    if ($_SERVER['REQUEST_METHOD'] !== 'GET' || is_admin() || omni_optimizer_is_logged_in()) {
        return;
    }

    $cache_file = omni_optimizer_get_cache_path();

    if (file_exists($cache_file)) {
        // Serve file dan MATIKAN eksekusi PHP selanjutnya
        header('Content-Type: text/html; charset=utf-8');
        header('X-Omni-Cache: HIT');
        readfile($cache_file);
        exit;
    }
}

// 3. CAPTURE OUTPUT & MINIFY HTML
add_action('template_redirect', 'omni_optimizer_start_buffer', -9999);
function omni_optimizer_start_buffer() {
    if ($_SERVER['REQUEST_METHOD'] !== 'GET' || is_admin() || omni_optimizer_is_logged_in() || is_404() || is_search()) {
        return;
    }
    
    // Pastikan header di-set ke HIT untuk indikator (meski baru dibuat)
    header('X-Omni-Cache: MISS');
    ob_start('omni_optimizer_minify_and_cache');
}

function omni_optimizer_minify_and_cache($html) {
    // Jangan cache jika tidak ada tag <html>
    if (stripos($html, '<html') === false) {
        return $html;
    }

    // Minify HTML (hapus spasi, tab, newlines antar tag)
    $search = array(
        '/\>[^\S ]+/s',     // strip whitespaces after tags, except space
        '/[^\S ]+\</s',     // strip whitespaces before tags, except space
        '/(\s)+/s',         // shorten multiple whitespace sequences
        '/<!--(.|\s)*?-->/' // Remove HTML comments
    );
    $replace = array('>', '<', '\\1', '');
    $minified = preg_replace($search, $replace, $html);

    // Pastikan tidak menghapus komentar penting seperti IE conditionals atau Swup ignores (kalau ada)
    // RegExp di atas menghapus semua komentar. Jika butuh pengecualian, bisa disesuaikan.
    // Tapi untuk OmniServe, aman.

    // Tambahkan signature di bawah
    $minified .= "\n<!-- Omni Optimizer: Cached & Minified -->";

    // Simpan ke file cache
    if (!file_exists(OMNI_OPTIMIZER_CACHE_DIR)) {
        wp_mkdir_p(OMNI_OPTIMIZER_CACHE_DIR);
    }
    
    $cache_file = omni_optimizer_get_cache_path();
    file_put_contents($cache_file, $minified, LOCK_EX);

    return $minified;
}

// 4. PURGE CACHE (Pembersihan Otomatis)
function omni_optimizer_purge_cache() {
    if (!file_exists(OMNI_OPTIMIZER_CACHE_DIR)) {
        return;
    }
    $files = glob(OMNI_OPTIMIZER_CACHE_DIR . '/cache_*.html');
    if ($files) {
        foreach ($files as $file) {
            unlink($file);
        }
    }
}

// Bersihkan cache saat save post/page
add_action('save_post', 'omni_optimizer_purge_cache');
add_action('deleted_post', 'omni_optimizer_purge_cache');

// Bersihkan cache saat Omni Editor menyimpan data
add_action('wp_ajax_omni_save_page_meta', 'omni_optimizer_purge_cache', 1);
add_action('wp_ajax_nopriv_omni_save_page_meta', 'omni_optimizer_purge_cache', 1);

// Tambahan purge manual via admin bar
add_action('admin_bar_menu', 'omni_optimizer_admin_bar_menu', 100);
function omni_optimizer_admin_bar_menu($wp_admin_bar) {
    if (current_user_can('manage_options')) {
        $wp_admin_bar->add_node(array(
            'id'    => 'omni_purge_cache',
            'title' => 'Purge Omni Cache',
            'href'  => admin_url('admin-post.php?action=omni_purge_cache'),
            'meta'  => array('class' => 'omni-purge-cache-btn')
        ));
    }
}

add_action('admin_post_omni_purge_cache', 'omni_optimizer_admin_post_purge');
function omni_optimizer_admin_post_purge() {
    if (current_user_can('manage_options')) {
        omni_optimizer_purge_cache();
        wp_redirect(wp_get_referer() ? wp_get_referer() : home_url());
        exit;
    }
}
