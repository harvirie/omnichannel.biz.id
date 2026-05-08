<?php
if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'wp_footer', 'omni_lc_render_widget', 99 );
function omni_lc_render_widget() {
    if ( is_admin() ) return;
    $logo    = esc_url( omni_lc_get('logo_url') );
    $greeting = esc_js( omni_lc_get('greeting_open', 'Halo, ada yang bisa dibantu?') );
    $nonce   = wp_create_nonce( 'omni_lc_nonce' );
    $ajax    = admin_url( 'admin-ajax.php' );
    ?>
<style>
#omni-lc-widget *{box-sizing:border-box;font-family:'Outfit','Segoe UI',system-ui,sans-serif;}
#omni-lc-bubble{position:fixed;bottom:92px;right:24px;z-index:99998;display:flex;align-items:center;gap:10px;animation:omniLcPop .4s ease;}
#omni-lc-bubble-text{background:#1E40AF;color:#fff;padding:10px 16px;border-radius:20px 20px 4px 20px;font-size:14px;font-weight:600;box-shadow:0 4px 16px rgba(30,64,175,.3);max-width:200px;line-height:1.4;}
#omni-lc-bubble-icon{width:52px;height:52px;border-radius:50%;background:#fff;border:2px solid #E2E8F0;box-shadow:0 4px 12px rgba(0,0,0,.12);display:flex;align-items:center;justify-content:center;overflow:hidden;flex-shrink:0;}
#omni-lc-bubble-icon img{width:36px;height:36px;object-fit:contain;}
#omni-lc-toggle{position:fixed;bottom:24px;right:88px;z-index:99999;background:#1E40AF;color:#fff;width:52px;height:52px;border-radius:50%;border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;box-shadow:0 6px 20px rgba(30,64,175,.4);transition:all .2s;}
#omni-lc-toggle:hover{transform:scale(1.08);}
#omni-lc-window{position:fixed;bottom:90px;right:88px;z-index:99998;width:360px;max-height:580px;background:#fff;border-radius:16px;box-shadow:0 20px 60px rgba(0,0,0,.18);display:none;flex-direction:column;overflow:hidden;animation:omniLcSlide .25s ease;}
#omni-lc-header{background:#1E40AF;color:#fff;padding:12px 16px;display:flex;align-items:center;gap:10px;}
#omni-lc-header img{width:40px;height:40px;border-radius:50%;background:#fff;padding:4px;object-fit:contain;}
#omni-lc-header-info{flex:1;}
#omni-lc-header-info strong{font-size:15px;display:block;}
#omni-lc-header-info span{font-size:12px;opacity:.85;}
#omni-lc-close-btn{background:transparent;border:none;color:#fff;cursor:pointer;font-size:18px;opacity:.8;padding:0 4px;line-height:1;}
#omni-lc-form-wrap{padding:20px;overflow-y:auto;}
#omni-lc-form-wrap label{display:block;font-size:13px;font-weight:600;color:#374151;margin-bottom:4px;}
#omni-lc-form-wrap input{width:100%;padding:10px 12px;font-size:14px;border:1.5px solid #D1D5DB;border-radius:10px;outline:none;transition:border-color .2s;margin-bottom:12px;}
#omni-lc-form-wrap input:focus{border-color:#1E40AF;}
#omni-lc-form-wrap .lc-required{color:#EF4444;margin-left:2px;}
#omni-lc-submit{width:auto;background:#1E40AF;color:#fff;font-weight:700;font-size:15px;padding:11px 28px;border-radius:10px;border:none;cursor:pointer;transition:background .2s;margin-top:4px;}
#omni-lc-submit:hover{background:#1d4ed8;}
#omni-lc-chat-wrap{display:none;flex-direction:column;height:100%;}
#omni-lc-messages{flex:1;overflow-y:auto;padding:12px;background:#F1F5F9;display:flex;flex-direction:column;gap:8px;min-height:280px;max-height:380px;}
.lc-msg-bot,.lc-msg-agent{display:flex;gap:8px;align-items:flex-end;}
.lc-msg-avatar{width:30px;height:30px;border-radius:50%;background:#fff;border:1.5px solid #E2E8F0;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.lc-msg-avatar img{width:20px;height:20px;object-fit:contain;}
.lc-msg-bubble{background:#fff;border:1px solid #E2E8F0;border-radius:16px 16px 16px 4px;padding:9px 13px;font-size:13.5px;line-height:1.55;max-width:78%;color:#1e293b;}
.lc-msg-bubble.agent{background:#1E40AF;color:#fff;border:none;border-radius:16px 16px 4px 16px;}
.lc-msg-user{display:flex;justify-content:flex-end;}
.lc-msg-user .lc-msg-bubble{background:#1E40AF;color:#fff;border:none;border-radius:16px 16px 4px 16px;}
.lc-msg-time{font-size:10.5px;opacity:.55;margin-top:3px;text-align:right;}
.lc-menu-btns{display:flex;flex-wrap:wrap;gap:6px;margin-top:6px;}
.lc-menu-btn{background:#EFF6FF;color:#1E40AF;border:1.5px solid #BFDBFE;border-radius:20px;padding:5px 14px;font-size:12.5px;font-weight:600;cursor:pointer;transition:all .15s;}
.lc-menu-btn:hover{background:#1E40AF;color:#fff;border-color:#1E40AF;}
#omni-lc-input-bar{display:flex;gap:8px;padding:10px;border-top:1px solid #E2E8F0;background:#fff;}
#omni-lc-input{flex:1;border:1.5px solid #CBD5E1;border-radius:20px;padding:8px 14px;font-size:13.5px;outline:none;transition:border-color .2s;}
#omni-lc-input:focus{border-color:#1E40AF;}
#omni-lc-send-btn{background:#1E40AF;color:#fff;border:none;border-radius:50%;width:38px;height:38px;cursor:pointer;display:flex;align-items:center;justify-content:center;flex-shrink:0;transition:background .2s;}
#omni-lc-send-btn:hover{background:#1d4ed8;}
#omni-lc-msg-error{display:none;font-size:12px;color:#dc2626;padding:4px 0;}
@keyframes omniLcPop{from{opacity:0;transform:scale(.8);}to{opacity:1;transform:scale(1);}}
@keyframes omniLcSlide{from{opacity:0;transform:translateY(12px);}to{opacity:1;transform:translateY(0);}}
@media(max-width:480px){
  #omni-lc-window{width:calc(100vw - 16px);right:8px;bottom:76px;}
  #omni-lc-toggle{right:72px;bottom:14px;}
  #omni-lc-bubble{right:8px;bottom:80px;}
}
</style>

<!-- Bubble -->
<div id="omni-lc-bubble">
  <div id="omni-lc-bubble-text"><?php echo esc_html( omni_lc_get('greeting_open','Halo, ada yang bisa dibantu?') ); ?></div>
  <div id="omni-lc-bubble-icon"><img src="<?php echo $logo; ?>" alt="Live Chat"></div>
</div>

<!-- Toggle button -->
<button id="omni-lc-toggle" title="Live Chat" aria-label="Buka Live Chat">
  <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
</button>

<!-- Chat window -->
<div id="omni-lc-window">
  <div id="omni-lc-header">
    <img src="<?php echo $logo; ?>" alt="Logo">
    <div id="omni-lc-header-info">
      <strong>Live Chat</strong>
      <span id="omni-lc-status-text">Isi form untuk memulai</span>
    </div>
    <button id="omni-lc-close-btn" aria-label="Tutup">✕</button>
  </div>

  <!-- Form -->
  <div id="omni-lc-form-wrap">
    <div id="omni-lc-msg-error"></div>
    <label>Nama <span class="lc-required">*</span></label>
    <input type="text" id="lc-nama" placeholder="Nama lengkap Anda" autocomplete="name">
    <label>Perusahaan <span class="lc-required">*</span></label>
    <input type="text" id="lc-perusahaan" placeholder="Nama perusahaan">
    <label>Email <span class="lc-required">*</span></label>
    <input type="email" id="lc-email" placeholder="email@perusahaan.com" autocomplete="email">
    <label>WhatsApp <span class="lc-required">*</span></label>
    <input type="tel" id="lc-wa" placeholder="08xxxxxxxxxx" inputmode="numeric">
    <button id="omni-lc-submit">Kirim</button>
  </div>

  <!-- Chat area (hidden initially) -->
  <div id="omni-lc-chat-wrap">
    <div id="omni-lc-messages"></div>
    <div id="omni-lc-input-bar">
      <input type="text" id="omni-lc-input" placeholder="Silakan ketik...">
      <button id="omni-lc-send-btn" aria-label="Kirim">
        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
      </button>
    </div>
  </div>
</div>

<script>
(function(){
'use strict';
const NONCE  = '<?php echo $nonce; ?>';
const AJAX   = '<?php echo esc_js($ajax); ?>';
const LOGO   = '<?php echo $logo; ?>';
let sessionKey = null, lastMsgId = 0, pollTimer = null, bubbleHidden = false;

// Elements
const bubble    = document.getElementById('omni-lc-bubble');
const toggle    = document.getElementById('omni-lc-toggle');
const win       = document.getElementById('omni-lc-window');
const closeBtn  = document.getElementById('omni-lc-close-btn');
const formWrap  = document.getElementById('omni-lc-form-wrap');
const chatWrap  = document.getElementById('omni-lc-chat-wrap');
const messages  = document.getElementById('omni-lc-messages');
const input     = document.getElementById('omni-lc-input');
const sendBtn   = document.getElementById('omni-lc-send-btn');
const submitBtn = document.getElementById('omni-lc-submit');
const errEl     = document.getElementById('omni-lc-msg-error');
const statusTxt = document.getElementById('omni-lc-status-text');

// Restore session from storage
const stored = sessionStorage.getItem('omni_lc_key');
if (stored) sessionKey = stored;

function post(data) {
    return fetch(AJAX, {method:'POST', headers:{'Content-Type':'application/x-www-form-urlencoded'}, body:new URLSearchParams(data)}).then(r=>r.json());
}

// Toggle window
function openWin() { win.style.display='flex'; if(!bubbleHidden){bubble.style.display='none';bubbleHidden=true;} if(sessionKey) startPoll(); }
function closeWin() { win.style.display='none'; stopPoll(); }
toggle.addEventListener('click', ()=> win.style.display==='flex' ? closeWin() : openWin());
closeBtn.addEventListener('click', closeWin);

// Auto-hide bubble after 5s
setTimeout(()=>{ if(!bubbleHidden && bubble){ bubble.style.opacity='0'; bubble.style.transition='opacity .5s'; setTimeout(()=>bubble.style.display='none',500); }}, 6000);

// WhatsApp: only digits
document.getElementById('lc-wa').addEventListener('input', function(){ this.value=this.value.replace(/[^0-9+]/g,''); });

// Email validation
function isEmail(v){ return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v); }

// Submit form
submitBtn.addEventListener('click', function(){
    const nama       = document.getElementById('lc-nama').value.trim();
    const perusahaan = document.getElementById('lc-perusahaan').value.trim();
    const email      = document.getElementById('lc-email').value.trim();
    const wa         = document.getElementById('lc-wa').value.trim();

    errEl.style.display='none';
    if(!nama||!perusahaan||!email||!wa){ showErr('Semua field wajib diisi.'); return; }
    if(!isEmail(email)){ showErr('Format email tidak valid.'); return; }
    if(!/^[0-9+]{8,15}$/.test(wa)){ showErr('Format WhatsApp hanya angka (8-15 digit).'); return; }

    submitBtn.disabled=true; submitBtn.textContent='Memulai...';

    post({action:'omni_lc_start', nonce:NONCE, nama, perusahaan, email, whatsapp:wa})
    .then(res=>{
        if(!res.success){ showErr(res.data||'Gagal memulai sesi.'); submitBtn.disabled=false; submitBtn.textContent='Kirim'; return; }
        sessionKey = res.data.session_key;
        sessionStorage.setItem('omni_lc_key', sessionKey);
        formWrap.style.display='none';
        chatWrap.style.display='flex';
        statusTxt.textContent = res.data.is_open ? '🟢 Online' : '🔴 Offline';
        startPoll();
    }).catch(()=>{ showErr('Koneksi gagal.'); submitBtn.disabled=false; submitBtn.textContent='Kirim'; });
});

function showErr(msg){ errEl.textContent=msg; errEl.style.display='block'; }

// Send message
function sendMessage() {
    const text = input.value.trim();
    if(!text||!sessionKey) return;
    appendMsg('user', text, 'sekarang');
    input.value='';
    post({action:'omni_lc_send', nonce:NONCE, session_key:sessionKey, message:text})
    .then(res=>{ if(res.success&&res.data.bot_reply) renderMessage(res.data.bot_reply.id, 'bot', res.data.bot_reply.message, res.data.bot_reply.meta, 'sekarang'); });
}
sendBtn.addEventListener('click', sendMessage);
input.addEventListener('keydown', e=>{ if(e.key==='Enter'&&!e.shiftKey){e.preventDefault();sendMessage();} });

// Poll
function startPoll(){ if(pollTimer) clearInterval(pollTimer); poll(); pollTimer=setInterval(poll, 2500); }
function stopPoll(){ if(pollTimer){ clearInterval(pollTimer); pollTimer=null; } }

function poll(){
    if(!sessionKey) return;
    post({action:'omni_lc_poll', nonce:NONCE, session_key:sessionKey, last_id:lastMsgId})
    .then(res=>{
        if(!res.success) return;
        res.data.messages.forEach(m=>{ if(m.id>lastMsgId) lastMsgId=m.id; renderMessage(m.id,m.sender,m.message,m.meta,m.created_at); });
    });
}

// Render helpers
function renderMessage(id, sender, text, meta, time) {
    if(document.querySelector('[data-msg-id="'+id+'"]')) return;
    appendMsg(sender, text, time, meta, id);
}

function appendMsg(sender, text, time, meta, id) {
    const wrap = document.createElement('div');
    wrap.dataset.msgId = id||'';

    const isUser  = sender==='user';
    const isAgent = sender==='agent';

    if(isUser) {
        wrap.className='lc-msg-user';
        wrap.innerHTML=`<div style="display:flex;flex-direction:column;align-items:flex-end;">
            <div class="lc-msg-bubble">${escHtml(text).replace(/\n/g,'<br>')}</div>
            <div class="lc-msg-time">${time}</div></div>`;
    } else {
        wrap.style.cssText='display:flex;flex-direction:column;gap:4px;';
        wrap.innerHTML=`<div class="lc-msg-bot">
            <div class="lc-msg-avatar"><img src="${LOGO}" alt="bot"></div>
            <div style="display:flex;flex-direction:column;">
                <div class="lc-msg-bubble${isAgent?' agent':''}">${escHtml(text).replace(/\*([^*]+)\*/g,'<strong>$1</strong>').replace(/\n/g,'<br>')}</div>
                <div class="lc-msg-time">${time}</div>
            </div></div>`;

        if(meta && meta.type==='menu' && meta.items) {
            const btns = document.createElement('div');
            btns.className='lc-menu-btns';
            btns.style.paddingLeft='38px';
            meta.items.forEach(item=>{
                const btn = document.createElement('button');
                btn.className='lc-menu-btn'; btn.textContent=item;
                btn.addEventListener('click',()=>{
                    input.value=item;
                    document.querySelectorAll('.lc-menu-btns button').forEach(b=>b.disabled=true);
                    sendMessage();
                });
                btns.appendChild(btn);
            });
            wrap.appendChild(btns);
        }
    }
    messages.appendChild(wrap);
    messages.scrollTop=messages.scrollHeight;
}

function escHtml(s){ const d=document.createElement('div'); d.textContent=s; return d.innerHTML; }

// If returning user, show chat directly
if(sessionKey) {
    formWrap.style.display='none';
    chatWrap.style.display='flex';
    statusTxt.textContent='🟢 Online';
    startPoll();
}

})();
</script>
    <?php
}
