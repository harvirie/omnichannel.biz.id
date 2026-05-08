<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/* ── Start Session ── */
add_action( 'wp_ajax_omni_lc_start',        'omni_lc_ajax_start' );
add_action( 'wp_ajax_nopriv_omni_lc_start', 'omni_lc_ajax_start' );
function omni_lc_ajax_start() {
    check_ajax_referer( 'omni_lc_nonce', 'nonce' );

    $nama       = sanitize_text_field( $_POST['nama']       ?? '' );
    $perusahaan = sanitize_text_field( $_POST['perusahaan'] ?? '' );
    $email      = sanitize_email( $_POST['email']           ?? '' );
    $whatsapp   = preg_replace( '/[^0-9+]/', '', $_POST['whatsapp'] ?? '' );

    if ( ! $nama || ! is_email( $email ) || strlen( $whatsapp ) < 8 ) {
        wp_send_json_error( 'Data tidak valid.' );
    }

    global $wpdb;
    $key = wp_generate_password( 32, false );
    $ip  = sanitize_text_field( $_SERVER['HTTP_CF_CONNECTING_IP'] ?? $_SERVER['REMOTE_ADDR'] ?? '' );

    $wpdb->insert( "{$wpdb->prefix}lc_sessions", [
        'session_key' => $key,
        'nama'        => $nama,
        'perusahaan'  => $perusahaan,
        'email'       => $email,
        'whatsapp'    => $whatsapp,
        'ip_address'  => $ip,
        'created_at'  => current_time( 'mysql', true ),
    ], ['%s','%s','%s','%s','%s','%s','%s'] );

    $session_id = $wpdb->insert_id;

    // Send welcome / offline message
    $is_open = omni_lc_is_open();
    $greeting = $is_open
        ? omni_lc_get('greeting_open',  'Halo, ada yang bisa dibantu?')
        : omni_lc_get('greeting_close', 'Maaf, layanan kami sedang offline.');

    $meta = '';
    if ( $is_open ) {
        // Inject bot main menus
        $menus = omni_lc_get('bot_menus', []);
        $menu_labels = array_column( $menus, 'label' );
        $meta = wp_json_encode( ['type' => 'menu', 'items' => $menu_labels] );
    }

    $wpdb->insert( "{$wpdb->prefix}lc_messages", [
        'session_id' => $session_id,
        'sender'     => 'bot',
        'message'    => $greeting,
        'meta'       => $meta,
        'created_at' => current_time( 'mysql', true ),
    ], ['%d','%s','%s','%s','%s'] );

    wp_send_json_success([
        'session_key' => $key,
        'is_open'     => $is_open,
    ]);
}

/* ── Send User Message ── */
add_action( 'wp_ajax_omni_lc_send',        'omni_lc_ajax_send' );
add_action( 'wp_ajax_nopriv_omni_lc_send', 'omni_lc_ajax_send' );
function omni_lc_ajax_send() {
    check_ajax_referer( 'omni_lc_nonce', 'nonce' );

    $key     = sanitize_text_field( $_POST['session_key'] ?? '' );
    $message = sanitize_textarea_field( $_POST['message'] ?? '' );

    if ( ! $key || ! $message ) wp_send_json_error( 'Invalid.' );

    global $wpdb;
    $session = $wpdb->get_row( $wpdb->prepare(
        "SELECT * FROM {$wpdb->prefix}lc_sessions WHERE session_key = %s LIMIT 1", $key
    ) );
    if ( ! $session ) wp_send_json_error( 'Session not found.' );

    // Save user message
    $wpdb->insert( "{$wpdb->prefix}lc_messages", [
        'session_id' => $session->id,
        'sender'     => 'user',
        'message'    => $message,
        'meta'       => '',
        'created_at' => current_time( 'mysql', true ),
    ], ['%d','%s','%s','%s','%s'] );

    // Bot auto-reply for menu actions
    $bot_reply = omni_lc_bot_reply( $session->id, $message );

    wp_send_json_success( ['bot_reply' => $bot_reply] );
}

/* ── Poll for new messages ── */
add_action( 'wp_ajax_omni_lc_poll',        'omni_lc_ajax_poll' );
add_action( 'wp_ajax_nopriv_omni_lc_poll', 'omni_lc_ajax_poll' );
function omni_lc_ajax_poll() {
    check_ajax_referer( 'omni_lc_nonce', 'nonce' );

    $key      = sanitize_text_field( $_POST['session_key'] ?? '' );
    $last_id  = (int) ( $_POST['last_id'] ?? 0 );

    if ( ! $key ) wp_send_json_error( 'Invalid.' );

    global $wpdb;
    $session = $wpdb->get_row( $wpdb->prepare(
        "SELECT id FROM {$wpdb->prefix}lc_sessions WHERE session_key = %s LIMIT 1", $key
    ) );
    if ( ! $session ) wp_send_json_error( 'Session not found.' );

    $messages = $wpdb->get_results( $wpdb->prepare(
        "SELECT id, sender, message, meta, created_at FROM {$wpdb->prefix}lc_messages
         WHERE session_id = %d AND id > %d ORDER BY id ASC LIMIT 20",
        $session->id, $last_id
    ) );

    $out = [];
    foreach ( $messages as $m ) {
        $out[] = [
            'id'         => (int) $m->id,
            'sender'     => $m->sender,
            'message'    => $m->message,
            'meta'       => $m->meta ? json_decode( $m->meta, true ) : null,
            'created_at' => get_date_from_gmt( $m->created_at, 'H:i' ),
        ];
    }

    wp_send_json_success( ['messages' => $out] );
}

/* ── Agent send message (admin) ── */
add_action( 'wp_ajax_omni_lc_agent_send', 'omni_lc_ajax_agent_send' );
function omni_lc_ajax_agent_send() {
    check_ajax_referer( 'omni_lc_admin_nonce', 'nonce' );
    if ( ! current_user_can( 'manage_options' ) && ! current_user_can( 'omni_lc_agent' ) ) {
        wp_send_json_error( 'Forbidden.' );
    }

    $session_id = (int) ( $_POST['session_id'] ?? 0 );
    $message    = sanitize_textarea_field( $_POST['message'] ?? '' );

    if ( ! $session_id || ! $message ) wp_send_json_error( 'Invalid.' );

    global $wpdb;
    $wpdb->insert( "{$wpdb->prefix}lc_messages", [
        'session_id' => $session_id,
        'sender'     => 'agent',
        'message'    => $message,
        'meta'       => '',
        'created_at' => current_time( 'mysql', true ),
    ], ['%d','%s','%s','%s','%s'] );

    wp_send_json_success( ['id' => $wpdb->insert_id] );
}

/* ── Admin poll (inbox) ── */
add_action( 'wp_ajax_omni_lc_admin_poll', 'omni_lc_ajax_admin_poll' );
function omni_lc_ajax_admin_poll() {
    check_ajax_referer( 'omni_lc_admin_nonce', 'nonce' );
    if ( ! current_user_can( 'manage_options' ) && ! current_user_can( 'omni_lc_agent' ) ) {
        wp_send_json_error( 'Forbidden.' );
    }

    $session_id = (int) ( $_POST['session_id'] ?? 0 );
    $last_id    = (int) ( $_POST['last_id']    ?? 0 );
    if ( ! $session_id ) wp_send_json_error( 'Invalid.' );

    global $wpdb;
    $messages = $wpdb->get_results( $wpdb->prepare(
        "SELECT id, sender, message, meta, created_at FROM {$wpdb->prefix}lc_messages
         WHERE session_id = %d AND id > %d ORDER BY id ASC LIMIT 20",
        $session_id, $last_id
    ) );

    $out = [];
    foreach ( $messages as $m ) {
        $out[] = [
            'id'         => (int) $m->id,
            'sender'     => $m->sender,
            'message'    => $m->message,
            'created_at' => get_date_from_gmt( $m->created_at, 'H:i' ),
        ];
    }
    wp_send_json_success( ['messages' => $out] );
}

/* ── Close session ── */
add_action( 'wp_ajax_omni_lc_close_session', 'omni_lc_ajax_close_session' );
function omni_lc_ajax_close_session() {
    check_ajax_referer( 'omni_lc_admin_nonce', 'nonce' );
    if ( ! current_user_can( 'manage_options' ) ) wp_send_json_error( 'Forbidden.' );

    $session_id = (int) ( $_POST['session_id'] ?? 0 );
    global $wpdb;
    $wpdb->update( "{$wpdb->prefix}lc_sessions", ['status' => 'closed'], ['id' => $session_id], ['%s'], ['%d'] );
    wp_send_json_success();
}

/* ── Assign role ── */
add_action( 'wp_ajax_omni_lc_assign', 'omni_lc_ajax_assign' );
function omni_lc_ajax_assign() {
    check_ajax_referer( 'omni_lc_admin_nonce', 'nonce' );
    if ( ! current_user_can( 'manage_options' ) ) wp_send_json_error( 'Forbidden.' );

    $session_id = (int) ( $_POST['session_id'] ?? 0 );
    $role       = sanitize_text_field( $_POST['role'] ?? '' );
    global $wpdb;
    $wpdb->update( "{$wpdb->prefix}lc_sessions", ['assigned_to' => $role], ['id' => $session_id], ['%s'], ['%d'] );
    wp_send_json_success();
}

/* ── Bot logic ── */
function omni_lc_bot_reply( $session_id, $user_message ) {
    $menus = omni_lc_get('bot_menus', []);

    // Traverse menu tree to find matching label
    $reply_msg  = null;
    $reply_meta = null;

    foreach ( $menus as $menu ) {
        if ( strtolower( trim( $user_message ) ) === strtolower( $menu['label'] ) ) {
            // Top-level menu selected
            $sub_labels = array_column( $menu['children'] ?? [], 'label' );
            $reply_msg  = "Pilih layanan *{$menu['label']}* kami:";
            $reply_meta = wp_json_encode( ['type' => 'menu', 'items' => $sub_labels] );
            break;
        }
        foreach ( $menu['children'] ?? [] as $child ) {
            if ( strtolower( trim( $user_message ) ) === strtolower( $child['label'] ) ) {
                $reply_msg = $child['message'];
                // Sub-children
                if ( ! empty( $child['children'] ) ) {
                    $sub_labels = array_column( $child['children'], 'label' );
                    $reply_meta = wp_json_encode( ['type' => 'menu', 'items' => $sub_labels] );
                } elseif ( ! empty( $child['is_human'] ) ) {
                    $reply_meta = wp_json_encode( ['type' => 'human' ] );
                }
                break 2;
            }
            // 3rd level
            foreach ( $child['children'] ?? [] as $grandchild ) {
                if ( strtolower( trim( $user_message ) ) === strtolower( $grandchild['label'] ) ) {
                    $reply_msg  = $grandchild['message'];
                    if ( ! empty( $grandchild['is_human'] ) ) {
                        $reply_meta = wp_json_encode( ['type' => 'human'] );
                    }
                    break 3;
                }
            }
        }
    }

    if ( ! $reply_msg ) return null;

    global $wpdb;
    $wpdb->insert( "{$wpdb->prefix}lc_messages", [
        'session_id' => $session_id,
        'sender'     => 'bot',
        'message'    => $reply_msg,
        'meta'       => $reply_meta ?? '',
        'created_at' => current_time( 'mysql', true ),
    ], ['%d','%s','%s','%s','%s'] );

    return [
        'id'      => $wpdb->insert_id,
        'message' => $reply_msg,
        'meta'    => $reply_meta ? json_decode( $reply_meta, true ) : null,
    ];
}
