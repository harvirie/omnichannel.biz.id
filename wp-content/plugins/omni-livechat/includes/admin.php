<?php
if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'admin_menu', 'omni_lc_admin_menu' );
function omni_lc_admin_menu() {
    add_menu_page( 'Live Chat', 'Live Chat', 'manage_options', 'omni-livechat', 'omni_lc_page_inbox', 'dashicons-format-chat', 29 );
    add_submenu_page( 'omni-livechat', 'Inbox', 'Inbox', 'manage_options', 'omni-livechat', 'omni_lc_page_inbox' );
    add_submenu_page( 'omni-livechat', 'Pengaturan', 'Pengaturan', 'manage_options', 'omni-lc-settings', 'omni_lc_page_settings' );
}

add_action( 'admin_init', 'omni_lc_save_settings' );
function omni_lc_save_settings() {
    if ( ! isset( $_POST['omni_lc_save'] ) ) return;
    if ( ! current_user_can( 'manage_options' ) ) return;
    check_admin_referer( 'omni_lc_settings_save' );

    $data = get_option( 'omni_lc_settings', [] );
    $data['open_hour']     = sanitize_text_field( $_POST['open_hour']  ?? '08:00' );
    $data['close_hour']    = sanitize_text_field( $_POST['close_hour'] ?? '16:00' );
    $data['open_days']     = array_map( 'sanitize_text_field', (array)( $_POST['open_days'] ?? [] ) );
    $data['holiday_mode']  = isset( $_POST['holiday_mode'] ) ? '1' : '0';
    $data['greeting_open'] = sanitize_textarea_field( $_POST['greeting_open']  ?? '' );
    $data['greeting_close']= sanitize_textarea_field( $_POST['greeting_close'] ?? '' );
    $data['logo_url']      = esc_url_raw( $_POST['logo_url'] ?? '' );

    // Bot menus
    $labels   = array_map( 'sanitize_text_field',   (array)( $_POST['menu_label']   ?? [] ) );
    $roles    = array_map( 'sanitize_text_field',   (array)( $_POST['menu_role']    ?? [] ) );
    $menus = [];
    foreach ( $labels as $i => $label ) {
        if ( ! trim($label) ) continue;
        $menus[] = [
            'label'    => $label,
            'role'     => $roles[$i] ?? '',
            'children' => [],
        ];
    }
    if ( ! empty( $menus ) ) $data['bot_menus'] = $menus;

    update_option( 'omni_lc_settings', $data );
    wp_redirect( add_query_arg( 'saved', '1', admin_url( 'admin.php?page=omni-lc-settings' ) ) );
    exit;
}

/* ── Inbox Page ── */
function omni_lc_page_inbox() {
    global $wpdb;
    $sessions = $wpdb->get_results(
        "SELECT s.*, (SELECT COUNT(*) FROM {$wpdb->prefix}lc_messages m WHERE m.session_id=s.id) AS msg_count
         FROM {$wpdb->prefix}lc_sessions s ORDER BY s.created_at DESC LIMIT 100"
    );
    $nonce = wp_create_nonce( 'omni_lc_admin_nonce' );
    $ajax  = admin_url( 'admin-ajax.php' );
    ?>
    <div class="wrap" style="font-family:'Outfit','Segoe UI',sans-serif;max-width:1200px;">
      <div style="background:#0F172A;color:#fff;padding:1.2rem 1.5rem;border-radius:1rem;margin:1rem 0 1.5rem;display:flex;align-items:center;gap:1rem;">
        <img src="<?php echo esc_url(omni_lc_get('logo_url')); ?>" style="height:32px;filter:brightness(0) invert(1);">
        <div>
          <h1 style="color:#fff;margin:0;font-size:1.2rem;">Live Chat Inbox</h1>
          <p style="color:rgba(255,255,255,.6);margin:2px 0 0;font-size:.8rem;">Monitor & balas percakapan pelanggan secara real-time</p>
        </div>
      </div>
      <div style="display:grid;grid-template-columns:320px 1fr;gap:16px;height:72vh;">
        <!-- Session list -->
        <div style="background:#fff;border:1px solid #E2E8F0;border-radius:.875rem;overflow:hidden;display:flex;flex-direction:column;">
          <div style="padding:.75rem 1rem;border-bottom:1px solid #E2E8F0;font-weight:700;font-size:.85rem;color:#0F172A;">
            Percakapan (<?php echo count($sessions); ?>)
          </div>
          <div id="lc-session-list" style="overflow-y:auto;flex:1;">
            <?php if ( $sessions ): foreach ( $sessions as $s ): ?>
            <div class="lc-session-item" data-id="<?php echo $s->id; ?>"
                 style="padding:.75rem 1rem;border-bottom:1px solid #F1F5F9;cursor:pointer;transition:background .15s;"
                 onmouseover="this.style.background='#F8FAFC'" onmouseout="this.style.background=''"
                 onclick="omniLcLoadSession(<?php echo $s->id; ?>,<?php echo esc_js(json_encode($s->nama)); ?>)">
              <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:2px;">
                <strong style="font-size:.8rem;color:#0F172A;"><?php echo esc_html($s->nama); ?></strong>
                <span style="font-size:.65rem;color:#94A3B8;"><?php echo get_date_from_gmt($s->created_at,'d/m H:i'); ?></span>
              </div>
              <div style="font-size:.72rem;color:#64748B;"><?php echo esc_html($s->email); ?></div>
              <div style="display:flex;gap:4px;margin-top:4px;">
                <span style="background:<?php echo $s->status==='open'?'#dcfce7':'#f1f5f9'; ?>;color:<?php echo $s->status==='open'?'#166534':'#64748B'; ?>;padding:1px 6px;border-radius:9999px;font-size:.65rem;font-weight:600;"><?php echo $s->status; ?></span>
                <?php if($s->assigned_to): ?>
                <span style="background:#dbeafe;color:#1e40af;padding:1px 6px;border-radius:9999px;font-size:.65rem;font-weight:600;"><?php echo esc_html($s->assigned_to); ?></span>
                <?php endif; ?>
                <span style="background:#f0f9ff;color:#0369a1;padding:1px 6px;border-radius:9999px;font-size:.65rem;"><?php echo $s->msg_count; ?> msg</span>
              </div>
            </div>
            <?php endforeach; else: ?>
            <div style="padding:2rem;text-align:center;color:#94A3B8;font-size:.85rem;">Belum ada percakapan.</div>
            <?php endif; ?>
          </div>
        </div>

        <!-- Chat panel -->
        <div id="lc-chat-panel" style="background:#fff;border:1px solid #E2E8F0;border-radius:.875rem;display:flex;flex-direction:column;">
          <div id="lc-chat-header" style="padding:.75rem 1rem;border-bottom:1px solid #E2E8F0;display:flex;justify-content:space-between;align-items:center;">
            <span id="lc-chat-title" style="font-weight:700;color:#0F172A;font-size:.9rem;">Pilih percakapan</span>
            <div style="display:flex;gap:8px;" id="lc-chat-actions"></div>
          </div>
          <div id="lc-messages-wrap" style="flex:1;overflow-y:auto;padding:1rem;background:#F8FAFC;display:flex;flex-direction:column;gap:8px;">
            <div style="text-align:center;color:#94A3B8;font-size:.8rem;margin-top:4rem;">Pilih sesi di sebelah kiri untuk mulai membalas.</div>
          </div>
          <div id="lc-reply-bar" style="display:none;padding:.75rem;border-top:1px solid #E2E8F0;display:flex;gap:8px;">
            <textarea id="lc-reply-input" rows="2" placeholder="Ketik balasan..." style="flex:1;border:1.5px solid #CBD5E1;border-radius:.5rem;padding:.5rem .75rem;font-size:.85rem;resize:none;outline:none;font-family:inherit;"></textarea>
            <button id="lc-reply-btn" style="background:#1E40AF;color:#fff;border:none;border-radius:.5rem;padding:.5rem 1.2rem;font-weight:700;cursor:pointer;font-size:.85rem;">Kirim</button>
          </div>
        </div>
      </div>
    </div>
    <script>
    let lcActiveSession = null, lcLastMsgId = 0, lcPollTimer = null;
    const lcNonce = '<?php echo $nonce; ?>';
    const lcAjax  = '<?php echo $ajax; ?>';

    function omniLcLoadSession(id, nama) {
        lcActiveSession = id; lcLastMsgId = 0;
        document.getElementById('lc-chat-title').textContent = nama;
        document.getElementById('lc-reply-bar').style.display = 'flex';
        document.getElementById('lc-messages-wrap').innerHTML = '';
        document.getElementById('lc-chat-actions').innerHTML =
            `<select id="lc-assign-role" style="font-size:.75rem;border:1px solid #CBD5E1;border-radius:.375rem;padding:2px 6px;">
               <option value="">-- Assign --</option>
               <option value="sales">Sales</option>
               <option value="teknis">Teknis</option>
             </select>
             <button onclick="omniLcAssign()" style="font-size:.75rem;background:#1E40AF;color:#fff;border:none;border-radius:.375rem;padding:3px 10px;cursor:pointer;">Assign</button>
             <button onclick="omniLcClose()" style="font-size:.75rem;background:#dc2626;color:#fff;border:none;border-radius:.375rem;padding:3px 10px;cursor:pointer;">Tutup Sesi</button>`;
        if (lcPollTimer) clearInterval(lcPollTimer);
        omniLcPoll();
        lcPollTimer = setInterval(omniLcPoll, 2000);
    }

    function omniLcPoll() {
        if (!lcActiveSession) return;
        fetch(lcAjax, { method:'POST', headers:{'Content-Type':'application/x-www-form-urlencoded'},
            body: new URLSearchParams({action:'omni_lc_admin_poll', nonce:lcNonce, session_id:lcActiveSession, last_id:lcLastMsgId})
        }).then(r=>r.json()).then(res=>{
            if (!res.success) return;
            const wrap = document.getElementById('lc-messages-wrap');
            res.data.messages.forEach(m=>{
                if (m.id > lcLastMsgId) lcLastMsgId = m.id;
                const isAgent = m.sender === 'agent';
                const isUser  = m.sender === 'user';
                const div = document.createElement('div');
                div.style.cssText = `display:flex;justify-content:${isAgent?'flex-end':'flex-start'};`;
                div.innerHTML = `<div style="max-width:70%;background:${isAgent?'#1E40AF':isUser?'#fff':'#F0FDF4'};color:${isAgent?'#fff':'#1e293b'};border:1px solid ${isAgent?'transparent':isUser?'#E2E8F0':'#bbf7d0'};border-radius:.75rem;padding:.5rem .75rem;font-size:.82rem;line-height:1.5;">
                    <div style="font-size:.65rem;color:${isAgent?'rgba(255,255,255,.7)':'#94A3B8'};margin-bottom:2px;font-weight:600;">${m.sender.toUpperCase()} · ${m.created_at}</div>
                    ${m.message.replace(/\n/g,'<br>')}
                </div>`;
                wrap.appendChild(div);
            });
            if (res.data.messages.length) wrap.scrollTop = wrap.scrollHeight;
        });
    }

    document.getElementById('lc-reply-btn').addEventListener('click', function() {
        const input = document.getElementById('lc-reply-input');
        const msg = input.value.trim();
        if (!msg || !lcActiveSession) return;
        fetch(lcAjax, { method:'POST', headers:{'Content-Type':'application/x-www-form-urlencoded'},
            body: new URLSearchParams({action:'omni_lc_agent_send', nonce:lcNonce, session_id:lcActiveSession, message:msg})
        }).then(r=>r.json()).then(()=>{ input.value=''; omniLcPoll(); });
    });
    document.getElementById('lc-reply-input').addEventListener('keydown', function(e){
        if (e.key==='Enter' && !e.shiftKey) { e.preventDefault(); document.getElementById('lc-reply-btn').click(); }
    });

    function omniLcAssign() {
        const role = document.getElementById('lc-assign-role').value;
        if (!role || !lcActiveSession) return;
        fetch(lcAjax, { method:'POST', headers:{'Content-Type':'application/x-www-form-urlencoded'},
            body: new URLSearchParams({action:'omni_lc_assign', nonce:lcNonce, session_id:lcActiveSession, role})
        }).then(r=>r.json()).then(()=>alert('Berhasil di-assign ke: '+role));
    }
    function omniLcClose() {
        if (!confirm('Tutup sesi ini?') || !lcActiveSession) return;
        fetch(lcAjax, { method:'POST', headers:{'Content-Type':'application/x-www-form-urlencoded'},
            body: new URLSearchParams({action:'omni_lc_close_session', nonce:lcNonce, session_id:lcActiveSession})
        }).then(()=>location.reload());
    }
    </script>
    <?php
}

/* ── Settings Page ── */
function omni_lc_page_settings() {
    $d    = omni_lc_defaults();
    $days = ['1'=>'Senin','2'=>'Selasa','3'=>'Rabu','4'=>'Kamis','5'=>'Jumat','6'=>'Sabtu','7'=>'Minggu'];
    $open_days = omni_lc_get('open_days', $d['open_days']);
    $menus     = omni_lc_get('bot_menus', $d['bot_menus']);
    ?>
    <div class="wrap" style="font-family:'Outfit','Segoe UI',sans-serif;max-width:860px;">
      <div style="background:#0F172A;color:#fff;padding:1.2rem 1.5rem;border-radius:1rem;margin:1rem 0 1.5rem;">
        <h1 style="color:#fff;margin:0;font-size:1.2rem;">⚙️ Pengaturan Live Chat</h1>
      </div>
      <?php if(isset($_GET['saved'])): ?>
        <div class="notice notice-success is-dismissible"><p>Pengaturan berhasil disimpan.</p></div>
      <?php endif; ?>
      <form method="post">
        <?php wp_nonce_field('omni_lc_settings_save'); ?>
        <input type="hidden" name="omni_lc_save" value="1">

        <div style="background:#fff;border:1px solid #E2E8F0;border-radius:.875rem;padding:1.5rem;margin-bottom:1.25rem;">
          <h2 style="margin:0 0 1rem;font-size:1rem;color:#0F172A;">🕐 Jam & Hari Operasional</h2>
          <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-bottom:1rem;">
            <div>
              <label style="display:block;font-size:.8rem;font-weight:600;color:#374151;margin-bottom:4px;">Jam Buka</label>
              <input type="time" name="open_hour" value="<?php echo esc_attr(omni_lc_get('open_hour',$d['open_hour'])); ?>" style="border:1.5px solid #CBD5E1;border-radius:.5rem;padding:.4rem .6rem;font-size:.9rem;">
            </div>
            <div>
              <label style="display:block;font-size:.8rem;font-weight:600;color:#374151;margin-bottom:4px;">Jam Tutup</label>
              <input type="time" name="close_hour" value="<?php echo esc_attr(omni_lc_get('close_hour',$d['close_hour'])); ?>" style="border:1.5px solid #CBD5E1;border-radius:.5rem;padding:.4rem .6rem;font-size:.9rem;">
            </div>
          </div>
          <label style="display:block;font-size:.8rem;font-weight:600;color:#374151;margin-bottom:6px;">Hari Buka</label>
          <div style="display:flex;flex-wrap:wrap;gap:8px;margin-bottom:1rem;">
            <?php foreach($days as $num=>$name): ?>
            <label style="display:flex;align-items:center;gap:4px;font-size:.8rem;background:#F8FAFC;border:1px solid #E2E8F0;padding:4px 10px;border-radius:9999px;cursor:pointer;">
              <input type="checkbox" name="open_days[]" value="<?php echo $num; ?>" <?php checked(in_array($num,$open_days)); ?>> <?php echo $name; ?>
            </label>
            <?php endforeach; ?>
          </div>
          <label style="display:flex;align-items:center;gap:8px;cursor:pointer;">
            <input type="checkbox" name="holiday_mode" value="1" <?php checked(omni_lc_get('holiday_mode'),'1'); ?>>
            <span style="font-size:.85rem;font-weight:600;color:#dc2626;">🏖️ Mode Libur (paksa offline semua)</span>
          </label>
        </div>

        <div style="background:#fff;border:1px solid #E2E8F0;border-radius:.875rem;padding:1.5rem;margin-bottom:1.25rem;">
          <h2 style="margin:0 0 1rem;font-size:1rem;color:#0F172A;">💬 Teks Sapaan</h2>
          <div style="margin-bottom:1rem;">
            <label style="display:block;font-size:.8rem;font-weight:600;margin-bottom:4px;color:#166534;">✅ Saat Buka</label>
            <textarea name="greeting_open" rows="2" style="width:100%;border:1.5px solid #CBD5E1;border-radius:.5rem;padding:.5rem .75rem;font-size:.85rem;box-sizing:border-box;"><?php echo esc_textarea(omni_lc_get('greeting_open',$d['greeting_open'])); ?></textarea>
          </div>
          <div>
            <label style="display:block;font-size:.8rem;font-weight:600;margin-bottom:4px;color:#dc2626;">❌ Saat Tutup</label>
            <textarea name="greeting_close" rows="3" style="width:100%;border:1.5px solid #CBD5E1;border-radius:.5rem;padding:.5rem .75rem;font-size:.85rem;box-sizing:border-box;"><?php echo esc_textarea(omni_lc_get('greeting_close',$d['greeting_close'])); ?></textarea>
          </div>
        </div>

        <div style="background:#fff;border:1px solid #E2E8F0;border-radius:.875rem;padding:1.5rem;margin-bottom:1.25rem;">
          <h2 style="margin:0 0 1rem;font-size:1rem;color:#0F172A;">🤖 Menu Bot (Level 1)</h2>
          <p style="font-size:.8rem;color:#64748B;margin:0 0 1rem;">Tambah/hapus menu utama. Sub-menu & respons dapat dikonfigurasi via kode.</p>
          <div id="lc-menu-rows">
            <?php foreach($menus as $i=>$menu): ?>
            <div class="lc-menu-row" style="display:flex;gap:8px;margin-bottom:8px;align-items:center;">
              <input type="text" name="menu_label[]" value="<?php echo esc_attr($menu['label']); ?>" placeholder="Label menu" style="flex:2;border:1.5px solid #CBD5E1;border-radius:.5rem;padding:.4rem .6rem;font-size:.85rem;">
              <input type="text" name="menu_role[]"  value="<?php echo esc_attr($menu['role']); ?>"  placeholder="Role (sales/teknis)" style="flex:1;border:1.5px solid #CBD5E1;border-radius:.5rem;padding:.4rem .6rem;font-size:.85rem;">
              <button type="button" onclick="this.closest('.lc-menu-row').remove()" style="background:#fef2f2;color:#dc2626;border:1px solid #fecaca;border-radius:.375rem;padding:.3rem .6rem;cursor:pointer;">✕</button>
            </div>
            <?php endforeach; ?>
          </div>
          <button type="button" onclick="document.getElementById('lc-menu-rows').insertAdjacentHTML('beforeend','<div class=\'lc-menu-row\' style=\'display:flex;gap:8px;margin-bottom:8px;align-items:center;\'><input type=\'text\' name=\'menu_label[]\' placeholder=\'Label menu\' style=\'flex:2;border:1.5px solid #CBD5E1;border-radius:.5rem;padding:.4rem .6rem;font-size:.85rem;\'><input type=\'text\' name=\'menu_role[]\' placeholder=\'Role\' style=\'flex:1;border:1.5px solid #CBD5E1;border-radius:.5rem;padding:.4rem .6rem;font-size:.85rem;\'><button type=\'button\' onclick=\'this.closest(&quot;.lc-menu-row&quot;).remove()\' style=\'background:#fef2f2;color:#dc2626;border:1px solid #fecaca;border-radius:.375rem;padding:.3rem .6rem;cursor:pointer;\'>✕</button></div>')" style="background:#F0FDF4;color:#166534;border:1px solid #BBF7D0;border-radius:.5rem;padding:.4rem 1rem;cursor:pointer;font-size:.8rem;">+ Tambah Menu</button>
        </div>

        <div style="background:#fff;border:1px solid #E2E8F0;border-radius:.875rem;padding:1.5rem;margin-bottom:1.25rem;">
          <h2 style="margin:0 0 1rem;font-size:1rem;color:#0F172A;">🖼️ Logo URL</h2>
          <input type="url" name="logo_url" value="<?php echo esc_attr(omni_lc_get('logo_url',$d['logo_url'])); ?>" style="width:100%;border:1.5px solid #CBD5E1;border-radius:.5rem;padding:.5rem .75rem;font-size:.85rem;box-sizing:border-box;">
          <p style="font-size:.75rem;color:#64748B;margin:4px 0 0;">URL gambar logo icon (versi latar terang, bukan full logo).</p>
        </div>

        <button type="submit" style="background:#1E40AF;color:#fff;border:none;border-radius:.625rem;padding:.7rem 2rem;font-weight:700;font-size:.95rem;cursor:pointer;">💾 Simpan Pengaturan</button>
      </form>
    </div>
    <?php
}
