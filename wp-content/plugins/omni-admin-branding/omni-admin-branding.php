<?php
/**
 * Plugin Name:  OmniServe Admin Branding
 * Plugin URI:   https://omnichannel.biz.id
 * Description:  Customizes the WordPress login page and admin area to match OmniServe brand identity (Dark Blue, Light Gray, Gold).
 * Version:      1.0.0
 * Author:       Harizal
 * Author URI:   https://omnichannel.biz.id
 * License:      GPL-2.0+
 * Text Domain:  omni-admin-branding
 */

if ( ! defined( 'ABSPATH' ) ) exit; // No direct access

define( 'OMNI_BRAND_VERSION', '1.0.0' );
define( 'OMNI_BRAND_URL',     plugin_dir_url( __FILE__ ) );
define( 'OMNI_BRAND_PATH',    plugin_dir_path( __FILE__ ) );

// ─────────────────────────────────────────────
// 1. LOGIN PAGE — Custom Logo
// ─────────────────────────────────────────────
add_filter( 'login_headerurl',   fn() => home_url('/') );
add_filter( 'login_headertext',  fn() => get_bloginfo('name') );

add_action( 'login_enqueue_scripts', function() {
    wp_enqueue_style(
        'omni-login-style',
        OMNI_BRAND_URL . 'assets/login.css',
        [],
        OMNI_BRAND_VERSION
    );
} );

// ─────────────────────────────────────────────
// 2. LOGIN PAGE — Replace Logo Image
// ─────────────────────────────────────────────
add_action( 'login_enqueue_scripts', function() {
    // Login page has DARK background → use WHITE icon (logo for dark bg)
    $logo_url    = 'https://res.cloudinary.com/dtxwwevxl/image/upload/v1778221347/logo_pagpmz.svg';
    $brand_color = '#0F172A';
    $accent      = '#D4AF37';
    ?>
    <style>
        :root {
            --omni-dark:    <?php echo $brand_color; ?>;
            --omni-accent:  <?php echo $accent; ?>;
            --omni-light:   #F8FAFC;
            --omni-border:  #E2E8F0;
            --omni-muted:   #64748B;
            --omni-btn:     #1E3A8A;
            --omni-btn-h:   #1E40AF;
        }

        /* ── PAGE BACKGROUND ── */
        body.login {
            background: linear-gradient(135deg, #0F172A 0%, #1E293B 50%, #0F172A 100%);
            font-family: 'Outfit', 'Segoe UI', sans-serif;
        }
        body.login::before {
            content: '';
            position: fixed;
            inset: 0;
            background:
                radial-gradient(ellipse 60% 50% at 20% 30%, rgba(212,175,55,0.08) 0%, transparent 70%),
                radial-gradient(ellipse 50% 40% at 80% 70%, rgba(30,58,138,0.15) 0%, transparent 70%);
            pointer-events: none;
        }

        /* ── LOGO ── */
        #login h1 a,
        .login h1 a {
            background-image: url('<?php echo esc_url($logo_url); ?>') !important;
            background-size: contain !important;
            background-repeat: no-repeat !important;
            background-position: center !important;
            width: 220px !important;
            height: 80px !important;
            display: block !important;
            margin: 0 auto !important;
        }

        /* ── LOGIN CARD ── */
        #login {
            padding: 2rem 0;
        }
        #loginform,
        #lostpasswordform,
        #registerform {
            background: rgba(255,255,255,0.97) !important;
            border: none !important;
            border-radius: 1.25rem !important;
            box-shadow: 0 25px 60px rgba(0,0,0,0.35), 0 0 0 1px rgba(255,255,255,0.05) !important;
            padding: 2rem 2.5rem !important;
            margin-top: 1.25rem !important;
            animation: slideUp 0.5s cubic-bezier(0.22,1,0.36,1) both;
        }
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ── FORM LABELS ── */
        #loginform label,
        #lostpasswordform label {
            color: var(--omni-dark) !important;
            font-weight: 600 !important;
            font-size: 0.8125rem !important;
            letter-spacing: 0.03em !important;
            text-transform: uppercase !important;
        }

        /* ── FORM INPUTS ── */
        #loginform input[type="text"],
        #loginform input[type="password"],
        #loginform input[type="email"],
        #loginform input[type="number"],
        #loginform input[type="tel"],
        #loginform input[name*="tfa"],
        #loginform input[name*="twofactor"],
        #lostpasswordform input[type="text"],
        #lostpasswordform input[type="email"] {
            border: 1.5px solid var(--omni-border) !important;
            border-radius: 0.625rem !important;
            padding: 0.65rem 0.9rem !important;
            font-size: 0.9375rem !important;
            font-family: inherit !important;
            color: var(--omni-dark) !important;
            background: #F8FAFC !important;
            transition: border-color 0.2s, box-shadow 0.2s, background 0.2s !important;
            box-shadow: none !important;
            width: 100% !important;
            box-sizing: border-box !important;
        }
        #loginform input[type="text"]:focus,
        #loginform input[type="password"]:focus,
        #loginform input[type="email"]:focus,
        #loginform input[type="number"]:focus,
        #loginform input[type="tel"]:focus,
        #loginform input[name*="tfa"]:focus,
        #loginform input[name*="twofactor"]:focus,
        #lostpasswordform input:focus {
            border-color: var(--omni-accent) !important;
            background: #fff !important;
            box-shadow: 0 0 0 3px rgba(212,175,55,0.18) !important;
            outline: none !important;
        }

        /* ── LOGIN BUTTON ── */
        #loginform .button-primary,
        #lostpasswordform .button-primary {
            background: var(--omni-dark) !important;
            border: none !important;
            border-radius: 0.625rem !important;
            color: #fff !important;
            font-family: inherit !important;
            font-weight: 700 !important;
            font-size: 0.9375rem !important;
            letter-spacing: 0.02em !important;
            padding: 0.7rem 1.5rem !important;
            height: auto !important;
            line-height: normal !important;
            cursor: pointer !important;
            transition: background 0.2s, transform 0.15s, box-shadow 0.2s !important;
            box-shadow: 0 4px 12px rgba(15,23,42,0.3) !important;
            position: relative;
            overflow: hidden;
        }
        #loginform .button-primary:hover,
        #lostpasswordform .button-primary:hover {
            background: var(--omni-btn-h) !important;
            transform: translateY(-1px) !important;
            box-shadow: 0 6px 18px rgba(15,23,42,0.35) !important;
        }
        #loginform .button-primary:active,
        #lostpasswordform .button-primary:active {
            transform: scale(0.98) !important;
        }

        /* ── REMEMBER ME ── */
        #loginform .forgetmenot label {
            color: var(--omni-muted) !important;
            font-weight: 400 !important;
            text-transform: none !important;
            font-size: 0.875rem !important;
        }
        #loginform input[type="checkbox"] {
            accent-color: var(--omni-accent) !important;
        }

        /* ── LINKS BELOW FORM ── */
        #nav, #backtoblog {
            text-align: center !important;
        }
        #nav a, #backtoblog a {
            color: rgba(255,255,255,0.65) !important;
            font-size: 0.8125rem !important;
            text-decoration: none !important;
            transition: color 0.2s !important;
        }
        #nav a:hover, #backtoblog a:hover {
            color: var(--omni-accent) !important;
        }

        /* ── ERROR / SUCCESS MESSAGES ── */
        #login_error {
            border-left: 4px solid #ef4444 !important;
            background: #fff0f0 !important;
            border-radius: 0.5rem !important;
            color: #b91c1c !important;
            font-size: 0.875rem !important;
        }
        .message {
            border-left: 4px solid var(--omni-accent) !important;
            background: rgba(212,175,55,0.08) !important;
            border-radius: 0.5rem !important;
        }

        /* ── PRIVACY POLICY LINK ── */
        .privacy-policy-page-link {
            color: rgba(255,255,255,0.4) !important;
            font-size: 0.75rem !important;
        }
    </style>
    <?php
} );

// ─────────────────────────────────────────────
// 3. ADMIN AREA — Color Scheme & Branding
// ─────────────────────────────────────────────
add_action( 'admin_enqueue_scripts', function() {
    wp_enqueue_style(
        'omni-admin-style',
        OMNI_BRAND_URL . 'assets/admin.css',
        [],
        OMNI_BRAND_VERSION
    );
} );

// ─────────────────────────────────────────────
// 4. ADMIN BAR — Replace WP logo
// ─────────────────────────────────────────────
add_action( 'admin_bar_menu', function( \WP_Admin_Bar $wp_admin_bar ) {
    // Admin bar has DARK background → use WHITE icon (logo for dark bg)
    $logo_url = 'https://res.cloudinary.com/dtxwwevxl/image/upload/v1778221347/logo_pagpmz.svg';

    $wp_admin_bar->remove_node('wp-logo');
    $wp_admin_bar->add_node([
        'id'    => 'omni-brand-logo',
        'title' => '<img src="' . esc_url($logo_url) . '" alt="OmniServe" style="height:26px;width:auto;vertical-align:middle;margin-top:-2px;display:inline-block;">',
        'href'  => home_url('/'),
        'meta'  => ['title' => get_bloginfo('name')],
    ]);
}, 11 );

// ─────────────────────────────────────────────
// 5. ADMIN FOOTER — Custom text
// ─────────────────────────────────────────────
add_filter( 'admin_footer_text', fn() =>
    '<span>OmniServe Admin Panel &mdash; <a href="' . esc_url(home_url('/')) . '" target="_blank" style="color:#D4AF37;">omnichannel.biz.id</a></span>'
);
add_filter( 'update_footer', fn() => 'v' . OMNI_BRAND_VERSION, 11 );
