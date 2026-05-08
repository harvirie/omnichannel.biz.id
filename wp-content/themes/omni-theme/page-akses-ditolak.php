<?php
/**
 * Template Name: Akses Ditolak (403)
 * Template: page-akses-ditolak.php
 * Halaman custom 403 untuk InfinityFree hosting
 */

// Set proper 403 header
http_response_code( 403 );
get_header();
?>

<style>
@import url('https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700;800;900&display=swap');
main { padding-top: 0 !important; }

.error-page {
    min-height: 100vh;
    background: linear-gradient(135deg, #0F172A 0%, #1E293B 60%, #0F172A 100%);
    display: flex; align-items: center; justify-content: center;
    font-family: 'Outfit', sans-serif;
    position: relative; overflow: hidden;
}
.error-page::before {
    content: ''; position: absolute; inset: 0;
    background:
        radial-gradient(ellipse 70% 50% at 15% 25%, rgba(239,68,68,0.08) 0%, transparent 60%),
        radial-gradient(ellipse 50% 60% at 85% 75%, rgba(30,58,138,0.12) 0%, transparent 60%);
    animation: bgp 6s ease-in-out infinite alternate;
}
@keyframes bgp { from{opacity:.6} to{opacity:1} }

.dot { position:absolute; border-radius:50%; animation:flt linear infinite; opacity:.12; }
@keyframes flt {
    0%   { transform:translateY(100vh) rotate(0deg); opacity:0; }
    10%  { opacity:.12; }
    90%  { opacity:.12; }
    100% { transform:translateY(-10vh) rotate(720deg); opacity:0; }
}

.error-content {
    text-align:center; z-index:10; padding:2rem;
    animation: fadeUp .8s cubic-bezier(.22,1,.36,1) both;
}
@keyframes fadeUp { from{opacity:0;transform:translateY(40px)} to{opacity:1;transform:translateY(0)} }

.error-icon { font-size:3rem; margin-bottom:1rem; animation:bounce 2s ease-in-out infinite; }
@keyframes bounce { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-12px)} }

.error-code {
    font-size: clamp(6rem, 20vw, 14rem);
    font-weight: 900; line-height: 1; letter-spacing: -.05em;
    background: linear-gradient(135deg, #ef4444 0%, #fca5a5 40%, #ef4444 100%);
    -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
    animation: shimmer 3s ease-in-out infinite; background-size: 200% 100%;
    filter: drop-shadow(0 0 40px rgba(239,68,68,0.4));
    position: relative; display: inline-block;
}
@keyframes shimmer { 0%,100%{background-position:0% 50%} 50%{background-position:100% 50%} }
.error-code::before, .error-code::after {
    content: attr(data-text); position:absolute; top:0; left:0; right:0;
    background: linear-gradient(135deg,#ef4444 0%,#fca5a5 40%,#ef4444 100%);
    -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;
}
.error-code::before { animation:g1 4s infinite; clip-path:polygon(0 0,100% 0,100% 40%,0 40%); opacity:.5; }
.error-code::after  { animation:g2 4s infinite; clip-path:polygon(0 60%,100% 60%,100% 100%,0 100%); opacity:.5; }
@keyframes g1 { 0%,90%,100%{transform:none} 91%{transform:translate(-2px,-1px)} 93%{transform:translate(2px,1px)} 95%{transform:translate(-1px,2px)} }
@keyframes g2 { 0%,90%,100%{transform:none} 92%{transform:translate(2px,1px)} 94%{transform:translate(-2px,-1px)} 96%{transform:translate(1px,-2px)} }

.error-title { font-size:clamp(1.25rem,4vw,2rem); font-weight:800; color:#fff; margin:.5rem 0; }
.error-desc  { font-size:1rem; color:rgba(255,255,255,.55); max-width:440px; margin:.75rem auto 2rem; line-height:1.7; }

.countdown-wrap { margin-bottom:2rem; }
.countdown-text { font-size:.875rem; color:rgba(255,255,255,.5); margin-bottom:8px; }
.countdown-text span { color:#ef4444; font-weight:700; font-size:1.1rem; }
.bar-track { width:220px; height:4px; background:rgba(255,255,255,.1); border-radius:99px; margin:0 auto; overflow:hidden; }
.bar-fill  { height:100%; background:linear-gradient(90deg,#ef4444,#fca5a5); border-radius:99px; transform-origin:left; animation:shrink 10s linear forwards; }
@keyframes shrink { from{transform:scaleX(1)} to{transform:scaleX(0)} }

.error-actions { display:flex; gap:1rem; justify-content:center; flex-wrap:wrap; }
.btn-red {
    background: linear-gradient(135deg, #ef4444, #b91c1c);
    color:#fff; font-weight:800; font-size:.9375rem; padding:.75rem 2rem;
    border-radius:999px; text-decoration:none; transition:all .25s;
    box-shadow:0 4px 20px rgba(239,68,68,.4);
    display:inline-flex; align-items:center; gap:.5rem;
}
.btn-red:hover { transform:translateY(-2px); box-shadow:0 8px 28px rgba(239,68,68,.5); color:#fff; }
.btn-ghost {
    color:rgba(255,255,255,.7); font-weight:600; font-size:.9rem; padding:.75rem 1.5rem;
    border-radius:999px; text-decoration:none; border:1px solid rgba(255,255,255,.2);
    transition:all .25s; display:inline-flex; align-items:center; gap:.5rem;
}
.btn-ghost:hover { border-color:rgba(255,255,255,.5); color:#fff; background:rgba(255,255,255,.05); }

.error-links { margin-top:2.5rem; display:flex; gap:.5rem 1.5rem; justify-content:center; flex-wrap:wrap; }
.error-links a { color:rgba(255,255,255,.35); font-size:.8rem; text-decoration:none; transition:color .2s; }
.error-links a:hover { color:#ef4444; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Floating dots
    var page = document.querySelector('.error-page');
    for (var i = 0; i < 15; i++) {
        var d = document.createElement('div');
        d.className = 'dot';
        var s = Math.random() * 60 + 10;
        d.style.cssText = 'width:'+s+'px;height:'+s+'px;left:'+Math.random()*100+'%;'
            + 'background:'+(Math.random()>.5?'#ef4444':'#1E3A8A')+';'
            + 'animation-duration:'+(Math.random()*15+8)+'s;'
            + 'animation-delay:'+(Math.random()*8)+'s;';
        page.appendChild(d);
    }
    // Countdown
    var c = 10, el = document.getElementById('cd-num');
    if (!el) return;
    var t = setInterval(function() {
        c--; el.textContent = c;
        if (c <= 0) { clearInterval(t); window.location.href = '<?php echo esc_js(home_url("/")); ?>'; }
    }, 1000);
});
</script>

<div class="error-page">
    <div class="error-content">
        <div class="error-icon">🚫</div>
        <div class="error-code" data-text="403">403</div>
        <h1 class="error-title">Akses Ditolak</h1>
        <p class="error-desc">
            Anda tidak memiliki izin untuk mengakses halaman atau direktori ini.
            Aktivitas Anda telah dicatat oleh sistem keamanan OmniServe.
        </p>

        <div class="countdown-wrap">
            <p class="countdown-text">Kembali ke beranda dalam <span id="cd-num">10</span> detik</p>
            <div class="bar-track"><div class="bar-fill"></div></div>
        </div>

        <div class="error-actions">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="btn-red">
                🏠 Kembali ke Beranda
            </a>
            <a href="javascript:history.back()" class="btn-ghost">
                ← Halaman Sebelumnya
            </a>
        </div>

        <div class="error-links">
            <a href="<?php echo esc_url(home_url('/fitur')); ?>">Fitur</a>
            <a href="<?php echo esc_url(home_url('/harga')); ?>">Harga</a>
            <a href="<?php echo esc_url(home_url('/use-case')); ?>">Use Case</a>
            <a href="<?php echo esc_url(home_url('/artikel')); ?>">Artikel</a>
        </div>
    </div>
</div>

<?php get_footer(); ?>
