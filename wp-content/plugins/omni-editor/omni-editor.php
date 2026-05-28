<?php
/**
 * Plugin Name: Omni Editor
 * Description: WYSIWYG Content Editor untuk halaman Home, Fitur, Use Case, Analitik, Harga, dan Footer. Drag-drop, image upload, rich text editor.
 * Version: 1.0.0
 * Author: Omni Theme
 * Text Domain: omni-editor
 */

if (!defined('ABSPATH')) exit;

define('OMNI_EDITOR_VERSION',  '1.0.0');
define('OMNI_EDITOR_PATH',     plugin_dir_path(__FILE__));
define('OMNI_EDITOR_URL',      plugin_dir_url(__FILE__));

// Disable admin bar for preview iframe
if (isset($_GET['omni_preview']) && $_GET['omni_preview'] == '1') {
    show_admin_bar(false);
}

// ─── Load sub-modules ──────────────────────────────────────────
require_once OMNI_EDITOR_PATH . 'includes/class-data.php';
require_once OMNI_EDITOR_PATH . 'includes/ajax.php';

// ─── Admin Menu ────────────────────────────────────────────────
add_action('admin_menu', function () {
    add_menu_page(
        'Omni Editor',
        'Omni Editor',
        'manage_options',
        'omni-editor',
        'omni_editor_admin_page',
        'data:image/svg+xml;base64,' . base64_encode('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#D4AF37" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>'),
        25
    );
});

// ─── Enqueue admin assets ──────────────────────────────────────
add_action('admin_enqueue_scripts', function ($hook) {
    if ($hook !== 'toplevel_page_omni-editor') return;

    // WordPress media library
    wp_enqueue_media();

    // Sortable.js for drag-and-drop
    wp_enqueue_script(
        'sortablejs',
        'https://cdn.jsdelivr.net/npm/sortablejs@1.15.3/Sortable.min.js',
        [],
        '1.15.3',
        true
    );

    // Lucide Icons for editor UI
    wp_enqueue_script(
        'lucide-icons',
        'https://unpkg.com/lucide@latest',
        [],
        null,
        false
    );

    // Our editor CSS
    $plugin_dir = plugin_dir_path(__FILE__);
    $plugin_url = plugin_dir_url(__FILE__);
    wp_enqueue_style('omni-editor-css', $plugin_url . 'assets/css/omni-editor.css', array(), filemtime($plugin_dir . 'assets/css/omni-editor.css'));
    wp_enqueue_script('omni-editor-js', $plugin_url . 'assets/js/omni-editor.js', array('jquery', 'sortablejs'), filemtime($plugin_dir . 'assets/js/omni-editor.js'), true);

    // Pass data to JS
    wp_localize_script('omni-editor-js', 'OmniEditorConfig', [
        'ajaxUrl'   => admin_url('admin-ajax.php'),
        'nonce'     => wp_create_nonce('omni_editor_nonce'),
        'siteUrl'   => home_url('/'),
        'pages'     => [
            'home'     => home_url('/'),
            'fitur'    => home_url('/fitur/'),
            'usecase'  => home_url('/use-case/'),
            'analitik' => home_url('/analitik/'),
            'harga'    => home_url('/harga/'),
        ],
        'defaults'  => OmniEditorData::get_all_defaults(),
        'current'   => OmniEditorData::get_all_current(),
    ]);
});

// ─── Admin page HTML ───────────────────────────────────────────
function omni_editor_admin_page() {
    ?>
    <div id="omni-editor-root" class="omni-editor-wrap">

        <!-- Top Bar -->
        <div class="oe-topbar">
            <div class="oe-topbar-left">
                <svg class="oe-logo-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
                <span class="oe-logo-text">Omni Editor</span>
                <span class="oe-version-badge">v1.0</span>
            </div>
            <div class="oe-topbar-center">
                <span class="oe-editing-label">Editing: <strong id="oe-current-page-label">Home</strong></span>
            </div>
            <div class="oe-topbar-right">
                <label class="oe-autosave-toggle">
                    <input type="checkbox" id="oe-autosave-cb" checked>
                    <span>Auto-save</span>
                </label>
                <button class="oe-btn oe-btn-ghost" id="oe-reset-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 1 0 .49-3.36"/></svg>
                    Reset
                </button>
                <button class="oe-btn oe-btn-primary" id="oe-save-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13"/><polyline points="7 3 7 8 15 8"/></svg>
                    Simpan
                </button>
            </div>
        </div>

        <!-- Main Layout -->
        <div class="oe-layout">

            <!-- Sidebar: page navigation -->
            <nav class="oe-sidebar">
                <div class="oe-sidebar-title">Halaman</div>
                <ul class="oe-page-nav" id="oe-page-nav">
                    <li class="oe-nav-item active" data-page="home">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                        Home
                    </li>
                    <li class="oe-nav-item" data-page="fitur">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
                        Fitur
                    </li>
                    <li class="oe-nav-item" data-page="usecase">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                        Use Case
                    </li>
                    <li class="oe-nav-item" data-page="analitik">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>
                        Analitik
                    </li>
                    <li class="oe-nav-item" data-page="harga">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                        Harga
                    </li>
                    <li class="oe-nav-item" data-page="footer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><line x1="3" y1="15" x2="21" y2="15"/></svg>
                        Footer
                    </li>
                </ul>

                <div class="oe-sidebar-divider"></div>
                <div class="oe-sidebar-title">Preview</div>
                <div class="oe-preview-controls">
                    <button class="oe-preview-device active" data-device="desktop" title="Desktop">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                    </button>
                    <button class="oe-preview-device" data-device="tablet" title="Tablet">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="2" width="16" height="20" rx="2" ry="2"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg>
                    </button>
                    <button class="oe-preview-device" data-device="mobile" title="Mobile">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="5" y="2" width="14" height="20" rx="2" ry="2"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg>
                    </button>
                    <button class="oe-btn oe-btn-sm oe-btn-ghost" id="oe-refresh-preview">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 1 0 .49-3.36"/></svg>
                        Refresh
                    </button>
                </div>
                <div class="oe-sidebar-divider"></div>
                <div id="oe-save-status" class="oe-save-status">Belum ada perubahan</div>
            </nav>

            <!-- Editor Panel -->
            <div class="oe-editor-panel" id="oe-editor-panel">
                <!-- Loading state -->
                <div class="oe-loading" id="oe-loading">
                    <div class="oe-spinner"></div>
                    <span>Memuat editor...</span>
                </div>
                <!-- Sections rendered by JS -->
            </div>

            <!-- Preview Panel -->
            <div class="oe-preview-panel">
                <div class="oe-preview-header">
                    <span class="oe-preview-url" id="oe-preview-url"><?php echo home_url('/'); ?></span>
                    <a class="oe-preview-open-link" id="oe-preview-open" href="<?php echo home_url('/'); ?>" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                        Buka
                    </a>
                </div>
                <div class="oe-preview-frame-wrap" id="oe-preview-wrap" data-device="desktop">
                    <iframe id="oe-preview-iframe" src="<?php echo home_url('/?omni_preview=1'); ?>" title="Live Preview"></iframe>
                </div>
            </div>

        </div><!-- end .oe-layout -->

        <!-- Toast notifications -->
        <div id="oe-toast-container"></div>

        <!-- Text formatting toolbar (floating) -->
        <div id="oe-text-toolbar" class="oe-text-toolbar" style="display:none">
            <button class="oe-toolbar-btn" data-cmd="bold" title="Bold"><b>B</b></button>
            <button class="oe-toolbar-btn" data-cmd="italic" title="Italic"><i>I</i></button>
            <button class="oe-toolbar-btn" data-cmd="underline" title="Underline"><u>U</u></button>
            <div class="oe-toolbar-sep"></div>
            <button class="oe-toolbar-btn" data-cmd="insertHTML" data-val="<br>" title="Line break">↵</button>
            <div class="oe-toolbar-sep"></div>
            <button class="oe-toolbar-btn oe-toolbar-color-btn" data-cmd="foreColor" title="Text color">
                <span class="oe-color-preview" style="background:#D4AF37"></span>
                <input type="color" class="oe-color-input" value="#D4AF37">
            </button>
            <button class="oe-toolbar-btn" data-cmd="removeFormat" title="Clear formatting">✕</button>
        </div>

    </div><!-- end #omni-editor-root -->
    <?php
}
