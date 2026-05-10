<?php
/**
 * Plugin Name:  OmniServe View Switch
 * Description:  Kontrol visibilitas halaman di menu navigasi frontend. Halaman tersembunyi tetap diindex Google & bisa diakses via URL/search engine — namun tanpa menu navigasi.
 * Version:      1.0.0
 * Author:       Harizal
 * Text Domain:  omni-view-switch
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'OMNI_VSW_KEY',     'omni_view_switch_v1' );
define( 'OMNI_VSW_VERSION', '1.0.0' );

/* ═══════════════════════════════════════════════
   HELPERS
   ═══════════════════════════════════════════════ */
function omni_vsw_get_settings() {
    return (array) get_option( OMNI_VSW_KEY, [] );
}

function omni_vsw_is_hidden( $page_id ) {
    $s = omni_vsw_get_settings();
    return isset( $s[ (int) $page_id ] ) && $s[ (int) $page_id ] === 'hidden';
}

/* ═══════════════════════════════════════════════
   1. ADMIN MENU PAGE
   ═══════════════════════════════════════════════ */
add_action( 'admin_menu', function () {
    add_menu_page(
        'View Switch', 'View Switch', 'manage_options',
        'omni-view-switch', 'omni_vsw_admin_page',
        'dashicons-visibility', 25
    );
} );

/* Save via AJAX */
add_action( 'wp_ajax_omni_vsw_save', function () {
    if ( ! current_user_can( 'manage_options' ) ) wp_die( 'Unauthorized', 403 );
    check_ajax_referer( 'omni_vsw_nonce', 'nonce' );

    $raw  = isset( $_POST['settings'] ) ? (array) $_POST['settings'] : [];
    $clean = [];
    foreach ( $raw as $id => $val ) {
        $clean[ (int) $id ] = ( $val === 'hidden' ) ? 'hidden' : 'visible';
    }
    update_option( OMNI_VSW_KEY, $clean );
    wp_send_json_success( 'Pengaturan disimpan.' );
} );

function omni_vsw_admin_page() {
    $pages    = get_pages( [ 'post_status' => 'publish', 'sort_column' => 'menu_order,post_title' ] );
    $settings = omni_vsw_get_settings();
    $nonce    = wp_create_nonce( 'omni_vsw_nonce' );
    ?>
    <div class="wrap" id="vsw-wrap">
    <style>
    #vsw-wrap{max-width:880px;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif}
    .vsw-head{background:linear-gradient(135deg,#0F172A,#1E293B);border-radius:1rem;padding:1.75rem 2rem;color:#fff;display:flex;align-items:center;gap:1.25rem;margin-bottom:1.5rem;box-shadow:0 8px 32px rgba(0,0,0,.2)}
    .vsw-head h1{font-size:1.5rem;font-weight:800;margin:0 0 .2rem;color:#fff}
    .vsw-head p{color:#94A3B8;margin:0;font-size:.85rem}
    .vsw-tip{background:rgba(212,175,55,.09);border:1px solid rgba(212,175,55,.3);border-radius:.75rem;padding:.9rem 1.2rem;margin-bottom:1.5rem;color:#92720F;font-size:.85rem;line-height:1.65}
    .vsw-tip strong{color:#7A5F0A}
    .vsw-card{background:#fff;border-radius:1rem;border:1px solid #E2E8F0;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,.04);margin-bottom:1.5rem}
    .vsw-card-head{padding:.9rem 1.4rem;border-bottom:1px solid #F1F5F9;display:flex;justify-content:space-between;align-items:center}
    .vsw-card-head h2{font-size:.9375rem;font-weight:700;color:#0F172A;margin:0}
    .vsw-row{display:flex;align-items:center;padding:.8rem 1.4rem;border-bottom:1px solid #F8FAFC;gap:1rem;transition:background .15s}
    .vsw-row:last-child{border-bottom:none}
    .vsw-row:hover{background:#FAFAFA}
    .vsw-info{flex:1;min-width:0}
    .vsw-title{font-weight:600;color:#0F172A;font-size:.9rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
    .vsw-url{font-size:.72rem;color:#94A3B8;margin-top:2px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
    .vsw-badge{display:inline-flex;align-items:center;gap:.3rem;font-size:.68rem;font-weight:700;padding:.22rem .6rem;border-radius:999px;text-transform:uppercase;letter-spacing:.05em;flex-shrink:0;min-width:96px;justify-content:center}
    .vsw-badge.v{background:#DCFCE7;color:#15803D}
    .vsw-badge.h{background:#FEF3C7;color:#B45309}
    /* Toggle */
    .vsw-tog{position:relative;display:inline-block;width:48px;height:26px;flex-shrink:0}
    .vsw-tog input{opacity:0;width:0;height:0}
    .vsw-slider{position:absolute;cursor:pointer;inset:0;background:#CBD5E1;border-radius:999px;transition:.3s}
    .vsw-slider::before{position:absolute;content:"";height:18px;width:18px;left:4px;bottom:4px;background:#fff;border-radius:50%;transition:.3s;box-shadow:0 2px 4px rgba(0,0,0,.18)}
    input:checked+.vsw-slider{background:#22C55E}
    input:checked+.vsw-slider::before{transform:translateX(22px)}
    .vsw-bar{background:#fff;border-radius:1rem;border:1px solid #E2E8F0;padding:.9rem 1.4rem;display:flex;justify-content:space-between;align-items:center;box-shadow:0 2px 8px rgba(0,0,0,.04)}
    #vsw-btn{background:linear-gradient(135deg,#D4AF37,#B8962E);border:none;color:#fff;padding:.6rem 1.4rem;border-radius:.625rem;font-weight:700;font-size:.9rem;cursor:pointer;box-shadow:0 4px 12px rgba(212,175,55,.35);transition:all .2s}
    #vsw-btn:hover{transform:translateY(-1px);box-shadow:0 6px 18px rgba(212,175,55,.5)}
    #vsw-msg{font-size:.85rem;font-weight:600;color:#15803D;display:none}
    .vsw-legend{display:flex;gap:1rem;align-items:center;font-size:.78rem;color:#64748B}
    .vsw-legend span{display:flex;align-items:center;gap:.4rem}
    </style>

    <!-- Header -->
    <div class="vsw-head">
        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#D4AF37" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
            <circle cx="12" cy="12" r="3"/>
            <line x1="1" y1="1" x2="23" y2="23"/>
        </svg>
        <div>
            <h1>View Switch</h1>
            <p>Kontrol visibilitas halaman pada menu navigasi — tanpa mengganggu indeks Google.</p>
        </div>
    </div>

    <!-- Info -->
    <div class="vsw-tip">
        💡 <strong>Cara Kerja:</strong>
        <strong>Terlihat</strong> = halaman tampil normal di menu navigasi. &nbsp;|&nbsp;
        <strong>Tersembunyi</strong> = halaman hilang dari menu, namun tetap bisa diakses via URL langsung atau mesin pencari Google. Saat diakses langsung, halaman tampil <em>tanpa menu navigasi</em> sehingga pengunjung fokus pada konten.
        Google tetap bisa meng-crawl dan meng-index halaman ini karena tidak ada <code>noindex</code> yang ditambahkan.
    </div>

    <!-- Table -->
    <div class="vsw-card">
        <div class="vsw-card-head">
            <h2>📄 Daftar Halaman (<?php echo count( $pages ); ?>)</h2>
            <div class="vsw-legend">
                <span><span style="background:#DCFCE7;width:10px;height:10px;border-radius:50%;display:inline-block"></span>Terlihat di menu</span>
                <span><span style="background:#FEF3C7;width:10px;height:10px;border-radius:50%;display:inline-block"></span>Tersembunyi dari menu</span>
            </div>
        </div>
        <?php foreach ( $pages as $page ) :
            $pid       = $page->ID;
            $is_vis    = ! isset( $settings[ $pid ] ) || $settings[ $pid ] !== 'hidden';
            $st        = $is_vis ? 'v' : 'h';
            $st_label  = $is_vis ? '👁 Terlihat' : '🙈 Tersembunyi';
        ?>
        <div class="vsw-row">
            <div class="vsw-info">
                <div class="vsw-title"><?php echo esc_html( $page->post_title ); ?></div>
                <div class="vsw-url"><?php echo esc_url( get_permalink( $pid ) ); ?></div>
            </div>
            <span class="vsw-badge <?php echo $st; ?>" id="b<?php echo $pid; ?>"><?php echo $st_label; ?></span>
            <label class="vsw-tog" title="<?php echo $is_vis ? 'Klik untuk sembunyikan' : 'Klik untuk tampilkan'; ?>">
                <input type="checkbox" data-pid="<?php echo $pid; ?>" <?php checked( $is_vis ); ?> onchange="vswToggle(this)">
                <span class="vsw-slider"></span>
            </label>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Save Bar -->
    <div class="vsw-bar">
        <div id="vsw-msg">✅ Pengaturan berhasil disimpan!</div>
        <div style="color:#64748B;font-size:.8rem;">Perubahan langsung aktif setelah disimpan.</div>
        <button id="vsw-btn" onclick="vswSave()">💾 Simpan Perubahan</button>
    </div>
    </div>

    <script>
    var vswState = {};
    document.querySelectorAll('.vsw-tog input').forEach(function(cb) {
        vswState[cb.dataset.pid] = cb.checked ? 'visible' : 'hidden';
    });
    function vswToggle(cb) {
        var pid = cb.dataset.pid;
        var vis = cb.checked;
        vswState[pid] = vis ? 'visible' : 'hidden';
        var badge = document.getElementById('b' + pid);
        badge.className = 'vsw-badge ' + (vis ? 'v' : 'h');
        badge.innerHTML = vis ? '👁 Terlihat' : '🙈 Tersembunyi';
        cb.parentElement.title = vis ? 'Klik untuk sembunyikan' : 'Klik untuk tampilkan';
    }
    function vswSave() {
        var btn = document.getElementById('vsw-btn');
        var msg = document.getElementById('vsw-msg');
        btn.textContent = '⏳ Menyimpan...'; btn.disabled = true;
        var fd = new FormData();
        fd.append('action', 'omni_vsw_save');
        fd.append('nonce', '<?php echo esc_js( $nonce ); ?>');
        for (var pid in vswState) { fd.append('settings[' + pid + ']', vswState[pid]); }
        fetch(ajaxurl, { method: 'POST', body: fd })
            .then(r => r.json())
            .then(function(d) {
                btn.textContent = '💾 Simpan Perubahan'; btn.disabled = false;
                if (d.success) {
                    msg.style.display = 'block';
                    setTimeout(function() { msg.style.display = 'none'; }, 3000);
                }
            });
    }
    </script>
    <?php
}

/* ═══════════════════════════════════════════════
   2. FILTER WP NAV MENU ITEMS — Remove hidden pages
   ═══════════════════════════════════════════════ */
add_filter( 'wp_get_nav_menu_items', function ( $items, $menu, $args ) {
    if ( is_admin() ) return $items;
    $settings = omni_vsw_get_settings();
    if ( empty( $settings ) ) return $items;

    foreach ( $items as $key => $item ) {
        if ( $item->object === 'page' ) {
            $pid = (int) $item->object_id;
            if ( isset( $settings[ $pid ] ) && $settings[ $pid ] === 'hidden' ) {
                unset( $items[ $key ] );
            }
        }
    }
    return $items;
}, 20, 3 );

/* ═══════════════════════════════════════════════
   3. FILTER FALLBACK HARDCODED MENU LINKS in theme
   Expose a helper function so header.php can call it
   ═══════════════════════════════════════════════ */
/**
 * Returns true if a page (by slug/path) should be HIDDEN from menu.
 * Called by the theme's header.php fallback link loop.
 */
function omni_vsw_path_is_hidden( $path ) {
    $settings = omni_vsw_get_settings();
    if ( empty( $settings ) ) return false;
    $page = get_page_by_path( trim( $path, '/' ) );
    if ( ! $page ) return false;
    return isset( $settings[ $page->ID ] ) && $settings[ $page->ID ] === 'hidden';
}

/* ═══════════════════════════════════════════════
   4. SUPPRESS NAV when viewing a hidden page directly
   Adds body class + injects CSS hiding both mobile & desktop navs
   SEO is unaffected — no noindex, no robots changes
   ═══════════════════════════════════════════════ */
add_filter( 'body_class', function ( $classes ) {
    if ( is_admin() ) return $classes;
    if ( is_page() && omni_vsw_is_hidden( get_the_ID() ) ) {
        $classes[] = 'omni-vsw-hiddenpage';
    }
    // Also check virtual pages routed by theme (slug-based)
    $path = trim( parse_url( $_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH ), '/' );
    if ( $path && omni_vsw_path_is_hidden( $path ) ) {
        if ( ! in_array( 'omni-vsw-hiddenpage', $classes ) ) {
            $classes[] = 'omni-vsw-hiddenpage';
        }
    }
    return $classes;
} );

add_action( 'wp_head', function () {
    if ( is_admin() ) return;

    // Detect hidden page — both WP pages and theme virtual routes
    $is_hidden = false;

    if ( is_page() && omni_vsw_is_hidden( get_the_ID() ) ) {
        $is_hidden = true;
    }
    if ( ! $is_hidden ) {
        $path = trim( parse_url( $_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH ), '/' );
        if ( $path && omni_vsw_path_is_hidden( $path ) ) {
            $is_hidden = true;
        }
    }

    if ( ! $is_hidden ) return;

    // Inject CSS to hide mobile navbar + desktop floating header + mobile drawer
    // Targets specific IDs and nav class from omni-theme header.php
    echo '<style id="omni-vsw-css">
/* OmniServe View Switch — hide nav on hidden pages */
/* Mobile navbar (md:hidden nav) */
body.omni-vsw-hiddenpage nav.md\:hidden { display: none !important; }
/* Desktop floating header wrapper (hidden md:flex div) */
body.omni-vsw-hiddenpage .hidden.md\:flex { display: none !important; }
/* Mobile drawer + overlay (already hidden, extra safety) */
body.omni-vsw-hiddenpage #mobile-menu-drawer,
body.omni-vsw-hiddenpage #mobile-menu-overlay { display: none !important; }
/* Compensate: remove top padding that was reserved for fixed navbar */
body.omni-vsw-hiddenpage .flex-1.bg-white,
body.omni-vsw-hiddenpage .flex-1 { padding-top: 0 !important; }
/* Show a minimal back-to-home ribbon */
body.omni-vsw-hiddenpage::before {
    content: "← Kembali ke Beranda";
    display: block; position: fixed; top: 0; left: 0; right: 0; z-index: 9999;
    background: #0F172A; color: #D4AF37; text-align: center;
    padding: .5rem 1rem; font-size: .8rem; font-weight: 600;
    cursor: pointer; font-family: "Outfit", sans-serif;
    letter-spacing: .03em;
}
</style>
<script>
/* Make the ribbon clickable — navigate to home */
document.addEventListener("DOMContentLoaded", function() {
    document.body.addEventListener("click", function(e) {
        var rect = document.body.getBoundingClientRect();
        /* Click in top 38px area = ribbon */
        if (e.clientY <= 38) { window.location.href = <?php echo json_encode( home_url('/') ); ?>; }
    });
});
window.omniVswHiddenPage = true;
</script>' . "\n";
}, 1 );

/* ═══════════════════════════════════════════════
   5. SEO: KEEP PAGES FULLY INDEXABLE
   ═══════════════════════════════════════════════
   We intentionally do NOT add noindex or robots=noindex.
   Hidden pages remain fully crawlable by Google.
   Pages are only hidden from the frontend navigation menu.
   ═══════════════════════════════════════════════ */
