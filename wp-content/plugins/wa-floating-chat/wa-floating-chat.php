<?php
/**
 * Plugin Name: WhatsApp Floating Chat with Lead Form
 * Plugin URI: https://omnichannel.biz.id
 * Description: Floating WhatsApp dengan form lead. Data tersimpan di database dan bisa diexport CSV.
 * Version: 2.0.0
 * Author: Harizal
 * License: GPL2
 */

if (!defined('ABSPATH')) exit;

define('WA_LEADS_TABLE', 'wa_leads');

/* ── ACTIVATION: Buat tabel DB ── */
register_activation_hook(__FILE__, 'wa_leads_create_table');
function wa_leads_create_table() {
    global $wpdb;
    $table   = $wpdb->prefix . WA_LEADS_TABLE;
    $charset = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE IF NOT EXISTS $table (
        id          BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        nama        VARCHAR(200) NOT NULL,
        perusahaan  VARCHAR(200) NOT NULL,
        email       VARCHAR(200) NOT NULL,
        pertanyaan  TEXT NOT NULL,
        ip_address  VARCHAR(45) DEFAULT '',
        created_at  DATETIME NOT NULL,
        PRIMARY KEY (id),
        KEY created_at (created_at)
    ) $charset;";
    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($sql);
}

/* ── AJAX: Simpan lead ── */
add_action('wp_ajax_wa_save_lead',        'wa_save_lead_handler');
add_action('wp_ajax_nopriv_wa_save_lead', 'wa_save_lead_handler');
function wa_save_lead_handler() {
    check_ajax_referer('wa_lead_nonce', 'nonce');

    global $wpdb;
    $table = $wpdb->prefix . WA_LEADS_TABLE;

    $nama       = sanitize_text_field($_POST['nama'] ?? '');
    $perusahaan = sanitize_text_field($_POST['perusahaan'] ?? '');
    $email      = sanitize_email($_POST['email'] ?? '');
    $pertanyaan = sanitize_textarea_field($_POST['pertanyaan'] ?? '');

    if (!$nama || !$email || !is_email($email)) {
        wp_send_json_error('Data tidak valid.');
    }

    $ip = $_SERVER['HTTP_CF_CONNECTING_IP'] ?? $_SERVER['REMOTE_ADDR'] ?? '';

    $wpdb->insert($table, [
        'nama'       => $nama,
        'perusahaan' => $perusahaan,
        'email'      => $email,
        'pertanyaan' => $pertanyaan,
        'ip_address' => sanitize_text_field($ip),
        'created_at' => current_time('mysql', true),
    ], ['%s','%s','%s','%s','%s','%s']);

    wp_send_json_success(['id' => $wpdb->insert_id]);
}

/* ── ADMIN MENU ── */
add_action('admin_menu', function() {
    add_menu_page(
        'WA Leads', 'WA Leads', 'manage_options',
        'wa-leads', 'wa_leads_admin_page',
        'dashicons-whatsapp', 30
    );
});

/* ── EXPORT CSV ── */
add_action('admin_init', function() {
    if (!isset($_GET['page'], $_GET['action']) || $_GET['page'] !== 'wa-leads' || $_GET['action'] !== 'export_csv') return;
    if (!current_user_can('manage_options')) wp_die('Forbidden');
    check_admin_referer('wa_export_csv');

    global $wpdb;
    $table = $wpdb->prefix . WA_LEADS_TABLE;
    $rows  = $wpdb->get_results("SELECT * FROM $table ORDER BY created_at DESC", ARRAY_A);

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="wa-leads-' . date('Y-m-d') . '.csv"');
    $out = fopen('php://output', 'w');
    fputcsv($out, ['ID','Nama','Perusahaan','Email','Pertanyaan','IP','Waktu']);
    foreach ($rows as $r) {
        fputcsv($out, [$r['id'],$r['nama'],$r['perusahaan'],$r['email'],$r['pertanyaan'],$r['ip_address'],get_date_from_gmt($r['created_at'],'d/m/Y H:i')]);
    }
    fclose($out);
    exit;
});

/* ── DELETE LEAD ── */
add_action('admin_init', function() {
    if (!isset($_GET['page'], $_GET['action'], $_GET['id']) || $_GET['page'] !== 'wa-leads' || $_GET['action'] !== 'delete') return;
    if (!current_user_can('manage_options')) wp_die('Forbidden');
    check_admin_referer('wa_delete_' . $_GET['id']);

    global $wpdb;
    $wpdb->delete($wpdb->prefix . WA_LEADS_TABLE, ['id' => (int)$_GET['id']]);
    wp_redirect(admin_url('admin.php?page=wa-leads&deleted=1'));
    exit;
});

/* ── ADMIN PAGE ── */
function wa_leads_admin_page() {
    global $wpdb;
    $table  = $wpdb->prefix . WA_LEADS_TABLE;
    $total  = (int) $wpdb->get_var("SELECT COUNT(*) FROM $table");
    $today  = (int) $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $table WHERE DATE(created_at) = %s", gmdate('Y-m-d')));
    $rows   = $wpdb->get_results("SELECT * FROM $table ORDER BY created_at DESC LIMIT 50");
    $export = wp_nonce_url(admin_url('admin.php?page=wa-leads&action=export_csv'), 'wa_export_csv');
    ?>
    <div class="wrap" style="font-family:'Outfit','Segoe UI',sans-serif;">

      <!-- Header -->
      <div style="background:#0F172A;color:#fff;padding:1.25rem 1.5rem;border-radius:1rem;margin:1rem 0 1.5rem;display:flex;align-items:center;justify-content:space-between;">
        <div style="display:flex;align-items:center;gap:1rem;">
          <img src="https://res.cloudinary.com/dtxwwevxl/image/upload/v1778221348/logo_dark_sr1ywk.svg" style="height:32px;filter:brightness(0) invert(1);">
          <div>
            <h1 style="color:#fff;margin:0;font-size:1.2rem;">📋 WA Lead Management</h1>
            <p style="color:rgba(255,255,255,0.6);margin:2px 0 0;font-size:0.8rem;">Data prospek dari WhatsApp Floating Chat</p>
          </div>
        </div>
        <a href="<?php echo esc_url($export); ?>" style="background:#D4AF37;color:#0F172A;padding:.6rem 1.2rem;border-radius:.5rem;font-weight:700;font-size:.85rem;text-decoration:none;">⬇ Export CSV</a>
      </div>

      <?php if (isset($_GET['deleted'])): ?>
        <div class="notice notice-success is-dismissible"><p>Lead berhasil dihapus.</p></div>
      <?php endif; ?>

      <!-- Stats -->
      <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:1rem;margin-bottom:1.5rem;">
        <?php
        $stats = [
          ['Total Lead', $total, '#0F172A'],
          ['Hari Ini', $today, '#D4AF37'],
          ['Minggu Ini', (int)$wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $table WHERE created_at >= %s", gmdate('Y-m-d', strtotime('-7 days')))), '#1E3A8A'],
        ];
        foreach ($stats as [$label, $val, $color]):
        ?>
        <div style="background:#fff;border:1px solid #E2E8F0;border-radius:.875rem;padding:1.25rem;box-shadow:0 2px 8px rgba(0,0,0,0.04);border-top:4px solid <?php echo $color; ?>;">
          <div style="font-size:2rem;font-weight:800;color:<?php echo $color; ?>;"><?php echo $val; ?></div>
          <div style="font-size:.8rem;color:#64748B;font-weight:600;margin-top:4px;"><?php echo $label; ?></div>
        </div>
        <?php endforeach; ?>
      </div>

      <!-- Table -->
      <div style="background:#fff;border:1px solid #E2E8F0;border-radius:.875rem;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,0.04);">
        <div style="padding:1rem 1.5rem;border-bottom:1px solid #E2E8F0;font-weight:700;color:#0F172A;">
          Daftar Lead (<?php echo $total; ?> total)
        </div>
        <?php if ($rows): ?>
        <table style="width:100%;border-collapse:collapse;font-size:.8125rem;">
          <thead>
            <tr style="background:#F8FAFC;">
              <?php foreach (['#','Nama','Perusahaan','Email','Pertanyaan','IP','Waktu','Aksi'] as $h): ?>
              <th style="padding:.6rem 1rem;text-align:left;font-weight:600;color:#64748B;font-size:.7rem;text-transform:uppercase;letter-spacing:.05em;border-bottom:1px solid #E2E8F0;"><?php echo $h; ?></th>
              <?php endforeach; ?>
            </tr>
          </thead>
          <tbody>
          <?php foreach ($rows as $i => $r):
            $del_url = wp_nonce_url(admin_url("admin.php?page=wa-leads&action=delete&id={$r->id}"), 'wa_delete_' . $r->id);
          ?>
            <tr style="<?php echo $i % 2 ? 'background:#F8FAFC;' : ''; ?>border-bottom:1px solid #F1F5F9;">
              <td style="padding:.55rem 1rem;color:#94A3B8;"><?php echo $r->id; ?></td>
              <td style="padding:.55rem 1rem;font-weight:600;color:#0F172A;"><?php echo esc_html($r->nama); ?></td>
              <td style="padding:.55rem 1rem;color:#475569;"><?php echo esc_html($r->perusahaan); ?></td>
              <td style="padding:.55rem 1rem;"><a href="mailto:<?php echo esc_attr($r->email); ?>" style="color:#1E3A8A;"><?php echo esc_html($r->email); ?></a></td>
              <td style="padding:.55rem 1rem;color:#64748B;max-width:200px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;" title="<?php echo esc_attr($r->pertanyaan); ?>"><?php echo esc_html(wp_trim_words($r->pertanyaan, 8)); ?></td>
              <td style="padding:.55rem 1rem;color:#94A3B8;font-size:.75rem;"><?php echo esc_html($r->ip_address); ?></td>
              <td style="padding:.55rem 1rem;color:#64748B;white-space:nowrap;"><?php echo esc_html(get_date_from_gmt($r->created_at, 'd/m/Y H:i')); ?></td>
              <td style="padding:.55rem 1rem;">
                <a href="<?php echo esc_url($del_url); ?>" style="color:#ef4444;font-size:.75rem;text-decoration:none;" onclick="return confirm('Hapus lead ini?')">🗑 Hapus</a>
              </td>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
        <?php else: ?>
          <div style="padding:3rem;text-align:center;color:#94A3B8;">
            <div style="font-size:2.5rem;margin-bottom:.5rem;">📭</div>
            <div>Belum ada lead masuk.</div>
          </div>
        <?php endif; ?>
      </div>
    </div>
    <?php
}

/* ── FRONTEND WIDGET ── */
add_action('wp_footer', 'wa_floating_chat_render_widget', 100);
function wa_floating_chat_render_widget() {
    ?>
    <div id="wa-widget" style="position:fixed;bottom:24px;right:24px;z-index:99997;display:flex;flex-direction:column;align-items:flex-end;font-family:ui-sans-serif,system-ui,sans-serif;">
      <div id="wa-form-container" style="display:none;background:white;border-radius:16px;box-shadow:0 20px 25px -5px rgba(0,0,0,.15);border:1px solid #e5e7eb;width:320px;margin-bottom:16px;overflow:hidden;opacity:0;transition:opacity .3s ease;">
        <div style="background:#25D366;color:white;padding:16px;display:flex;justify-content:space-between;align-items:center;">
          <div style="display:flex;align-items:center;gap:8px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.888-.788-1.489-1.761-1.663-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
            <strong style="font-size:14px;">Hubungi via WhatsApp</strong>
          </div>
          <button id="wa-close-btn" style="color:white;background:transparent;border:none;cursor:pointer;opacity:.8;">✕</button>
        </div>
        <div style="padding:20px;">
          <p style="font-size:13px;color:#4b5563;margin:0 0 16px;line-height:1.5;">Isi formulir singkat sebelum memulai percakapan.</p>
          <div id="wa-msg" style="display:none;padding:10px;border-radius:8px;font-size:13px;margin-bottom:12px;"></div>
          <form id="wa-chat-form" style="display:flex;flex-direction:column;gap:12px;margin:0;">
            <?php wp_nonce_field('wa_lead_nonce', 'wa_nonce_field', false); ?>
            <?php
            $fields = [
                ['wa-nama','text','Nama'],
                ['wa-perusahaan','text','Perusahaan'],
                ['wa-email','email','Email'],
            ];
            foreach ($fields as [$id,$type,$label]):
            ?>
            <div>
              <label style="display:block;font-size:13px;font-weight:600;color:#374151;margin-bottom:4px;"><?php echo $label; ?> <span style="color:#ef4444;">*</span></label>
              <input type="<?php echo $type; ?>" id="<?php echo $id; ?>" required style="width:100%;padding:10px 12px;font-size:14px;border:1.5px solid #d1d5db;border-radius:8px;outline:none;box-sizing:border-box;transition:border-color .2s;">
            </div>
            <?php endforeach; ?>
            <div>
              <label style="display:block;font-size:13px;font-weight:600;color:#374151;margin-bottom:4px;">Pertanyaan <span style="color:#ef4444;">*</span></label>
              <textarea id="wa-pertanyaan" required rows="3" style="width:100%;padding:10px 12px;font-size:14px;border:1.5px solid #d1d5db;border-radius:8px;outline:none;box-sizing:border-box;resize:vertical;transition:border-color .2s;"></textarea>
            </div>
            <button type="submit" id="wa-submit-btn" style="background:#25D366;color:white;font-weight:700;font-size:15px;padding:12px;border-radius:8px;border:none;cursor:pointer;transition:background .2s;">Kirim &amp; Lanjut Chat ➤</button>
          </form>
        </div>
      </div>
      <button id="wa-toggle-btn" style="background:#25D366;color:white;border-radius:9999px;padding:16px;border:none;box-shadow:0 10px 20px rgba(0,0,0,.2);cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all .2s;">
        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.888-.788-1.489-1.761-1.663-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
      </button>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggle = document.getElementById('wa-toggle-btn');
        const form   = document.getElementById('wa-form-container');
        const close  = document.getElementById('wa-close-btn');
        const waForm = document.getElementById('wa-chat-form');
        const msg    = document.getElementById('wa-msg');

        function openForm() { form.style.display='block'; void form.offsetWidth; form.style.opacity='1'; }
        function closeForm() { form.style.opacity='0'; setTimeout(()=>form.style.display='none',300); }

        toggle.addEventListener('click', () => form.style.display==='none'||form.style.display==='' ? openForm() : closeForm());
        toggle.addEventListener('mouseover', () => { toggle.style.transform='translateY(-2px) scale(1.05)'; });
        toggle.addEventListener('mouseout',  () => { toggle.style.transform='translateY(0) scale(1)'; });
        close.addEventListener('click', closeForm);

        document.querySelectorAll('#wa-form-container input, #wa-form-container textarea').forEach(el => {
            el.addEventListener('focus', () => el.style.borderColor='#25D366');
            el.addEventListener('blur',  () => el.style.borderColor='#d1d5db');
        });

        waForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const btn = document.getElementById('wa-submit-btn');
            btn.textContent = 'Mengirim...';
            btn.disabled = true;

            const nama       = document.getElementById('wa-nama').value;
            const perusahaan = document.getElementById('wa-perusahaan').value;
            const email      = document.getElementById('wa-email').value;
            const pertanyaan = document.getElementById('wa-pertanyaan').value;
            const nonce      = document.getElementById('wa_nonce_field').value;

            fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
                method: 'POST',
                headers: {'Content-Type':'application/x-www-form-urlencoded'},
                body: new URLSearchParams({action:'wa_save_lead',nonce,nama,perusahaan,email,pertanyaan})
            })
            .then(r => r.json())
            .then(res => {
                const waUrl = `https://wa.me/6281283835553?text=${encodeURIComponent('Halo tim OmniServe,\n\n*Nama:* '+nama+'\n*Perusahaan:* '+perusahaan+'\n*Email:* '+email+'\n*Pertanyaan:*\n'+pertanyaan)}`;
                window.open(waUrl, '_blank');
                closeForm();
                waForm.reset();
            })
            .catch(() => {
                msg.style.display='block';
                msg.style.background='#fef2f2';
                msg.style.color='#b91c1c';
                msg.textContent='Gagal menyimpan. Silakan coba lagi.';
            })
            .finally(() => { btn.textContent='Kirim & Lanjut Chat ➤'; btn.disabled=false; });
        });
    });
    </script>
    <?php
}
