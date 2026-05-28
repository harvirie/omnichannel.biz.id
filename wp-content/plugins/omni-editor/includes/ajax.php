<?php
/**
 * Omni Editor — AJAX Handlers
 */

if (!defined('ABSPATH')) exit;

// ─── Save content ─────────────────────────────────────────────
add_action('wp_ajax_omni_editor_save', function () {
    check_ajax_referer('omni_editor_nonce', 'nonce');
    if (!current_user_can('manage_options')) {
        wp_send_json_error('Insufficient permissions', 403);
    }

    $page = sanitize_key($_POST['page'] ?? '');
    $data = isset($_POST['data']) ? json_decode(stripslashes($_POST['data']), true) : null;

    if (!$page || !is_array($data)) {
        wp_send_json_error('Invalid data');
    }

    // Sanitize recursively
    $data = omni_editor_sanitize_array($data);

    $ok = OmniEditorData::save($page, $data);
    if ($ok) {
        wp_send_json_success([
            'message'  => 'Perubahan berhasil disimpan!',
            'page'     => $page,
            'savedAt'  => current_time('H:i:s'),
        ]);
    } else {
        wp_send_json_error('Gagal menyimpan. Coba lagi.');
    }
});

// ─── Get current content ───────────────────────────────────────
add_action('wp_ajax_omni_editor_get', function () {
    check_ajax_referer('omni_editor_nonce', 'nonce');
    if (!current_user_can('manage_options')) {
        wp_send_json_error('Insufficient permissions', 403);
    }

    $page = sanitize_key($_POST['page'] ?? '');
    if (!$page) {
        wp_send_json_success(OmniEditorData::get_all_current());
    } else {
        wp_send_json_success(OmniEditorData::get($page));
    }
});

// ─── Reset page to defaults ────────────────────────────────────
add_action('wp_ajax_omni_editor_reset', function () {
    check_ajax_referer('omni_editor_nonce', 'nonce');
    if (!current_user_can('manage_options')) {
        wp_send_json_error('Insufficient permissions', 403);
    }

    $page = sanitize_key($_POST['page'] ?? '');
    if (!$page) {
        wp_send_json_error('Invalid page');
    }

    OmniEditorData::reset($page);
    wp_send_json_success([
        'message'  => 'Halaman berhasil direset ke default!',
        'defaults' => OmniEditorData::defaults($page),
    ]);
});

// ─── Sanitize helper ──────────────────────────────────────────
function omni_editor_sanitize_array(array $data): array {
    $clean = [];
    foreach ($data as $key => $value) {
        $clean_key = sanitize_key($key);
        if (is_array($value)) {
            $clean[$clean_key] = omni_editor_sanitize_array($value);
        } elseif (is_int($value)) {
            $clean[$clean_key] = absint($value);
        } elseif (is_bool($value)) {
            $clean[$clean_key] = (bool) $value;
        } else {
            // Allow HTML tags for rich text fields (title, subtitle, etc.)
            // Strip dangerous tags but keep safe formatting
            $clean[$clean_key] = wp_kses($value, [
                'br'     => [],
                'strong' => [],
                'b'      => [],
                'em'     => [],
                'i'      => [],
                'u'      => [],
                'span'   => ['class' => [], 'style' => []],
                'a'      => ['href' => [], 'target' => [], 'rel' => []],
            ]);
        }
    }
    return $clean;
}
