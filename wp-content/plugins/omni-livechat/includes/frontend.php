<?php
if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'wp_footer', 'omni_lc_render_widget', 99 );
function omni_lc_render_widget() {
    if ( is_admin() ) return;
    $logo     = esc_url( omni_lc_get('logo_url') );
    $greeting = esc_html( omni_lc_get('greeting_open', 'Halo, ada yang bisa dibantu?') );
    $nonce    = wp_create_nonce( 'omni_lc_nonce' );
    $ajax     = admin_url( 'admin-ajax.php' );
    ?>
<style>
#omni-lc-widget *{box-sizing:border-box;font-family:'Outfit','Segoe UI',system-ui,sans-serif;}

/* ── Floating trigger ── */
#omni-lc-toggle{
  position:fixed;bottom:92px;right:24px;z-index:99999;
  border:none;background:transparent;padding:0;
  cursor:pointer;display:flex;align-items:center;gap:12px;
  animation:omniLcPop .5s ease;
}
#omni-lc-toggle:hover #omni-lc-bubble-text{box-shadow:0 6px 24px rgba(30,64,175,.4);}
#omni-lc-toggle:hover #omni-lc-bubble-icon{transform:scale(1.06);}

#omni-lc-bubble-text{
  background:#1E40AF;color:#fff;
  padding:12px 18px;border-radius:20px 20px 20px 4px;
  font-size:14px;font-weight:600;
  box-shadow:0 4px 18px rgba(30,64,175,.3);
  max-width:200px;line-height:1.45;text-align:left;
  transition:box-shadow .2s;
}
#omni-lc-bubble-icon{
  width:58px;height:58px;border-radius:50%;
  background:#fff;border:2px solid #E2E8F0;
  box-shadow:0 4px 14px rgba(0,0,0,.12);
  display:flex;align-items:center;justify-content:center;
  flex-shrink:0;overflow:hidden;transition:transform .2s;
}
#omni-lc-bubble-icon img{width:38px;height:38px;object-fit:contain;}

@media(max-width:767px){
  #omni-lc-bubble-text{display:none;}
  #omni-lc-toggle{bottom:92px;right:20px;}
  #omni-lc-window{width:calc(100vw - 16px);right:8px;bottom:160px;max-height:65vh;}
}

/* ── Chat window ── */
#omni-lc-window{
  position:fixed;bottom:160px;right:24px;z-index:99998;
  width:360px;max-height:460px;
  background:#fff;border-radius:16px;
  box-shadow:0 20px 60px rgba(0,0,0,.18);
  display:none;flex-direction:column;overflow:hidden;
  animation:omniLcSlide .25s ease;
}
@media(max-width:767px){
  #omni-lc-window{width:calc(100vw - 16px);right:8px;bottom:80px;max-height:calc(100vh - 180px);}
}
#omni-lc-header{background:#1E40AF;color:#fff;padding:12px 16px;display:flex;align-items:center;gap:10px;}
#omni-lc-header img{width:40px;height:40px;border-radius:50%;background:#fff;padding:4px;object-fit:contain;flex-shrink:0;}
#omni-lc-header-info{flex:1;}
#omni-lc-header-info strong{font-size:15px;display:block;}
#omni-lc-header-info span{font-size:12px;opacity:.85;}
#omni-lc-close-btn{background:transparent;border:none;color:#fff;cursor:pointer;font-size:18px;opacity:.8;padding:0 4px;line-height:1;}
#omni-lc-form-wrap{padding:20px;overflow-y:auto;}
#omni-lc-form-wrap label{display:block;font-size:13px;font-weight:600;color:#374151;margin-bottom:4px;}
#omni-lc-form-wrap input{width:100%;padding:10px 12px;font-size:14px;border:1.5px solid #D1D5DB;border-radius:10px;outline:none;transition:border-color .2s;margin-bottom:12px;}
#omni-lc-form-wrap input:focus{border-color:#1E40AF;}
.lc-required{color:#EF4444;margin-left:2px;}
#omni-lc-submit{background:#1E40AF;color:#fff;font-weight:700;font-size:15px;padding:11px 28px;border-radius:10px;border:none;cursor:pointer;transition:background .2s;}
#omni-lc-submit:hover{background:#1d4ed8;}
#omni-lc-chat-wrap{display:none;flex-direction:column;height:100%;}
#omni-lc-messages{flex:1;overflow-y:auto;padding:12px;background:#F1F5F9;display:flex;flex-direction:column;gap:8px;min-height:180px;max-height:260px;}
.lc-msg-bot{display:flex;gap:8px;align-items:flex-end;}
.lc-msg-avatar{width:30px;height:30px;border-radius:50%;background:#fff;border:1.5px solid #E2E8F0;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.lc-msg-avatar img{width:20px;height:20px;object-fit:contain;}
.lc-msg-bubble{background:#fff;border:1px solid #E2E8F0;border-radius:16px 16px 16px 4px;padding:9px 13px;font-size:13.5px;line-height:1.55;max-width:78%;color:#1e293b;}
.lc-msg-bubble.agent{background:#1E40AF;color:#fff;border:none;border-radius:16px 16px 4px 16px;}
.lc-msg-user{display:flex;justify-content:flex-end;}
.lc-msg-user .lc-msg-bubble{background:#1E40AF;color:#fff;border:none;border-radius:16px 16px 4px 16px;}
.lc-msg-time{font-size:10.5px;opacity:.55;margin-top:3px;}
.lc-menu-btns{display:flex;flex-wrap:wrap;gap:6px;margin-top:6px;}
.lc-menu-btn{background:#EFF6FF;color:#1E40AF;border:1.5px solid #BFDBFE;border-radius:20px;padding:5px 14px;font-size:12.5px;font-weight:600;cursor:pointer;transition:all .15s;}
.lc-menu-btn:hover{background:#1E40AF;color:#fff;border-color:#1E40AF;}

/* ── Input bar & End session ── */
#omni-lc-input-bar{display:flex;gap:8px;padding:10px;border-top:1px solid #E2E8F0;background:#fff;flex-wrap:wrap;}
#omni-lc-input-row{display:flex;gap:8px;flex:1;min-width:0;}
#omni-lc-input{flex:1;border:1.5px solid #CBD5E1;border-radius:20px;padding:8px 14px;font-size:13.5px;outline:none;transition:border-color .2s;}
#omni-lc-input:focus{border-color:#1E40AF;}
#omni-lc-send-btn{background:#1E40AF;color:#fff;border:none;border-radius:50%;width:38px;height:38px;cursor:pointer;display:flex;align-items:center;justify-content:center;flex-shrink:0;transition:background .2s;}
#omni-lc-send-btn:hover{background:#1d4ed8;}
#omni-lc-end-btn{width:100%;background:#FEF2F2;color:#DC2626;border:1px solid #FECACA;border-radius:8px;padding:6px;font-size:12px;font-weight:600;cursor:pointer;transition:background .2s;}
#omni-lc-end-btn:hover{background:#FEE2E2;}
#omni-lc-msg-error{display:none;font-size:12px;color:#dc2626;padding:4px 0 8px;}

/* ── Session ended UI ── */
#omni-lc-ended{display:none;flex-direction:column;align-items:center;justify-content:center;padding:32px 20px;text-align:center;gap:12px;}
#omni-lc-ended svg{opacity:.35;}
#omni-lc-ended p{font-size:13px;color:#64748B;margin:0;line-height:1.55;}
#omni-lc-ended button{background:#1E40AF;color:#fff;border:none;border-radius:10px;padding:10px 24px;font-size:13px;font-weight:700;cursor:pointer;}

/* ── Inactivity progress bar ── */
#omni-lc-timeout-bar{height:3px;background:#EFF6FF;overflow:hidden;}
#omni-lc-timeout-fill{height:100%;width:100%;background:#1E40AF;transform-origin:left;transition:transform linear;}

@keyframes omniLcPop{from{opacity:0;transform:scale(.8);}to{opacity:1;transform:scale(1);}}
@keyframes omniLcSlide{from{opacity:0;transform:translateY(12px);}to{opacity:1;transform:translateY(0);}}

@media(max-width:767px){
  #omni-lc-toggle{padding:8px;border-radius:50%;width:52px;height:52px;justify-content:center;}
  #omni-lc-window{width:calc(100vw - 16px);right:8px;bottom:80px;}
  #omni-lc-bubble{right:8px;bottom:112px;}
}
</style>

<!-- Floating trigger -->
<button id="omni-lc-toggle" title="Buka Live Chat" aria-label="Buka Live Chat">
  <div id="omni-lc-bubble-text"><?php echo $greeting; ?></div>
  <div id="omni-lc-bubble-icon">
    <img src="<?php echo $logo; ?>" alt="Live Chat">
  </div>
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

  <!-- Registration form -->
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

  <!-- Chat area -->
  <div id="omni-lc-chat-wrap">
    <div id="omni-lc-timeout-bar"><div id="omni-lc-timeout-fill"></div></div>
    <div id="omni-lc-messages"></div>
    <div id="omni-lc-ended">
      <svg width="48" height="48" fill="none" stroke="#64748B" stroke-width="1.5" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path stroke-linecap="round" d="M9 12l2 2 4-4"/></svg>
      <p>Sesi percakapan telah berakhir.<br>Terima kasih telah menghubungi kami!</p>
      <button id="omni-lc-new-session-btn">Mulai Chat Baru</button>
    </div>
    <div id="omni-lc-input-bar">
      <div id="omni-lc-input-row">
        <input type="text" id="omni-lc-input" placeholder="Silakan ketik...">
        <button id="omni-lc-send-btn" aria-label="Kirim">
          <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
        </button>
      </div>
      <button id="omni-lc-end-btn">⬛ Akhiri Sesi</button>
    </div>
  </div>
</div>

<script>
function initOmniLC() {
    if (window.omniLCInitialized) return;
    window.omniLCInitialized = true;

'use strict';
const NONCE      = '<?php echo $nonce; ?>';
const AJAX       = '<?php echo esc_js($ajax); ?>';
const LOGO       = '<?php echo $logo; ?>';
const TIMEOUT_MS = 2 * 60 * 1000; // 2 menit
let sessionKey = null, lastMsgId = 0, pollTimer = null, inactivityTimer = null;

const toggle     = document.getElementById('omni-lc-toggle');
const win        = document.getElementById('omni-lc-window');
const closeBtn   = document.getElementById('omni-lc-close-btn');
const formWrap   = document.getElementById('omni-lc-form-wrap');
const chatWrap   = document.getElementById('omni-lc-chat-wrap');
const messages   = document.getElementById('omni-lc-messages');
const input      = document.getElementById('omni-lc-input');
const sendBtn    = document.getElementById('omni-lc-send-btn');
const submitBtn  = document.getElementById('omni-lc-submit');
const errEl      = document.getElementById('omni-lc-msg-error');
const statusTxt  = document.getElementById('omni-lc-status-text');
const endBtn     = document.getElementById('omni-lc-end-btn');
const endedEl    = document.getElementById('omni-lc-ended');
const newSessBtn = document.getElementById('omni-lc-new-session-btn');
const inputBar   = document.getElementById('omni-lc-input-bar');
const tFill      = document.getElementById('omni-lc-timeout-fill');

const stored = sessionStorage.getItem('omni_lc_key');
if (stored) sessionKey = stored;

function post(data) {
    return fetch(AJAX, {method:'POST', headers:{'Content-Type':'application/x-www-form-urlencoded'}, body:new URLSearchParams(data)}).then(r=>r.json());
}

function openWin()  { 
    win.style.display='flex'; 
    if(sessionKey) { startPoll(); resetInactivity(); } 
    
    // Auto-close WA Chat if open
    const waCloseBtn = document.getElementById('wa-close-btn');
    const waForm = document.getElementById('wa-form-container');
    if (waCloseBtn && waForm && (waForm.style.display === 'flex' || waForm.style.display === 'block')) {
        waCloseBtn.click();
    }
}
function closeWin() { win.style.display='none'; stopPoll(); }

toggle.addEventListener('click', ()=> win.style.display==='flex' ? closeWin() : openWin());
closeBtn.addEventListener('click', closeWin);
document.getElementById('lc-wa').addEventListener('input', function(){ this.value=this.value.replace(/[^0-9+]/g,''); });

function isEmail(v){ return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v); }

/* ── Inactivity timeout ── */
function resetInactivity() {
    if (!sessionKey) return;
    clearTimeout(inactivityTimer);
    tFill.style.transition = 'none';
    tFill.style.transform  = 'scaleX(1)';
    void tFill.offsetWidth;
    tFill.style.transition = 'transform ' + (TIMEOUT_MS/1000) + 's linear';
    tFill.style.transform  = 'scaleX(0)';
    inactivityTimer = setTimeout(() => endSession(true), TIMEOUT_MS);
}
function stopInactivity() {
    clearTimeout(inactivityTimer); inactivityTimer = null;
    tFill.style.transition = 'none'; tFill.style.transform = 'scaleX(0)';
}

/* ── End session ── */
function endSession(isAuto) {
    stopPoll(); stopInactivity();
    if (sessionKey) post({action:'omni_lc_end_session', nonce:NONCE, session_key:sessionKey});
    sessionKey = null; lastMsgId = 0;
    sessionStorage.removeItem('omni_lc_key');
    inputBar.style.display = 'none';
    endedEl.style.display  = 'flex';
    statusTxt.textContent  = '🔴 Sesi Berakhir';
    const msg = isAuto
        ? 'Sesi otomatis berakhir karena tidak ada aktivitas selama 2 menit.'
        : 'Sesi telah diakhiri. Terima kasih!';
    appendMsg('bot', msg, 'sekarang', null, 'end_' + Date.now());
}

endBtn.addEventListener('click', () => {
    if (!confirm('Akhiri sesi percakapan ini?')) return;
    endSession(false);
});

newSessBtn.addEventListener('click', () => {
    endedEl.style.display  = 'none';
    inputBar.style.display = 'flex';
    chatWrap.style.display = 'none';
    formWrap.style.display = 'block';
    messages.innerHTML     = '';
    statusTxt.textContent  = 'Isi form untuk memulai';
    submitBtn.disabled     = false;
    submitBtn.textContent  = 'Kirim';
    ['lc-nama','lc-perusahaan','lc-email','lc-wa'].forEach(id => {
        const el = document.getElementById(id); if (el) el.value = '';
    });
});

/* ── Start session ── */
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
        startPoll(); resetInactivity();
    }).catch(()=>{ showErr('Koneksi gagal.'); submitBtn.disabled=false; submitBtn.textContent='Kirim'; });
});

function showErr(msg){ errEl.textContent=msg; errEl.style.display='block'; }

/* ── Send message ── */
function sendMessage() {
    const text = input.value.trim();
    if(!text||!sessionKey) return;
    resetInactivity();
    const tempId = 'temp_' + Date.now();
    appendMsg('user', text, 'sekarang', null, tempId);
    input.value='';
    post({action:'omni_lc_send', nonce:NONCE, session_key:sessionKey, message:text})
    .then(res=>{
        if(res.success) {
            const el = document.querySelector('[data-msg-id="'+tempId+'"]');
            if(el && res.data.user_msg_id) el.dataset.msgId = res.data.user_msg_id;
            if(res.data.user_msg_id > lastMsgId) lastMsgId = res.data.user_msg_id;
            if(res.data.bot_reply) renderMessage(res.data.bot_reply.id,'bot',res.data.bot_reply.message,res.data.bot_reply.meta,'sekarang');
        }
    });
}
sendBtn.addEventListener('click', sendMessage);
input.addEventListener('keydown', e=>{ if(e.key==='Enter'&&!e.shiftKey){e.preventDefault();sendMessage();} });

/* ── Polling ── */
function startPoll(){ if(pollTimer) clearInterval(pollTimer); poll(); pollTimer=setInterval(poll,2500); }
function stopPoll() { if(pollTimer){ clearInterval(pollTimer); pollTimer=null; } }

function poll(){
    if(!sessionKey) return;
    post({action:'omni_lc_poll', nonce:NONCE, session_key:sessionKey, last_id:lastMsgId})
    .then(res=>{
        if(!res.success) return;
        if(res.data.messages && res.data.messages.length) resetInactivity();
        res.data.messages.forEach(m=>{ if(m.id>lastMsgId) lastMsgId=m.id; renderMessage(m.id,m.sender,m.message,m.meta,m.created_at); });
    });
}

function renderMessage(id, sender, text, meta, time) {
    if(document.querySelector('[data-msg-id="'+id+'"]')) return;
    appendMsg(sender, text, time, meta, id);
}

function appendMsg(sender, text, time, meta, id) {
    const wrap = document.createElement('div');
    wrap.dataset.msgId = id||'';
    const isUser = sender==='user', isAgent = sender==='agent';
    if(isUser) {
        wrap.className='lc-msg-user';
        wrap.innerHTML=`<div style="display:flex;flex-direction:column;align-items:flex-end;"><div class="lc-msg-bubble">${escHtml(text).replace(/\n/g,'<br>')}</div><div class="lc-msg-time" style="text-align:right;">${time}</div></div>`;
    } else {
        wrap.style.cssText='display:flex;flex-direction:column;gap:4px;';
        wrap.innerHTML=`<div class="lc-msg-bot"><div class="lc-msg-avatar"><img src="${LOGO}" alt="bot"></div><div style="display:flex;flex-direction:column;"><div class="lc-msg-bubble${isAgent?' agent':''}">`+escHtml(text).replace(/\*([^*]+)\*/g,'<strong>$1</strong>').replace(/\n/g,'<br>')+`</div><div class="lc-msg-time">${time}</div></div></div>`;
        if(meta&&meta.type==='menu'&&meta.items) {
            const btns=document.createElement('div'); btns.className='lc-menu-btns'; btns.style.paddingLeft='38px';
            meta.items.forEach(item=>{
                const btn=document.createElement('button'); btn.className='lc-menu-btn'; btn.textContent=item;
                btn.addEventListener('click',()=>{ input.value=item; document.querySelectorAll('.lc-menu-btns button').forEach(b=>b.disabled=true); sendMessage(); });
                btns.appendChild(btn);
            });
            wrap.appendChild(btns);
        }
    }
    messages.appendChild(wrap);
    messages.scrollTop=messages.scrollHeight;
}

function escHtml(s){ const d=document.createElement('div'); d.textContent=s; return d.innerHTML; }

// Resume existing session
if(sessionKey){ formWrap.style.display='none'; chatWrap.style.display='flex'; statusTxt.textContent='🟢 Online'; startPoll(); resetInactivity(); }

}
['mousemove', 'click', 'keydown', 'touchstart', 'wheel'].forEach(e => document.addEventListener(e, initOmniLC, {once: true, passive: true}));
</script>
    <?php
}
