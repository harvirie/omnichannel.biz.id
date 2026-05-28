<?php
/**
 * Template: 404 Not Found
 * OmniServe Theme - Animated Error Page
 */
get_header(); ?>

<style>
@import url('https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700;800;900&display=swap');

/* Override body padding untuk halaman error */
main { padding-top: 0 !important; }

.error-page {
    min-height: 100vh;
    background: linear-gradient(135deg, #0F172A 0%, #1E293B 60%, #0F172A 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: 'Outfit', sans-serif;
    position: relative;
    overflow: hidden;
}

/* Animated background particles */
.error-page::before {
    content: '';
    position: absolute;
    inset: 0;
    background:
        radial-gradient(ellipse 70% 50% at 10% 20%, rgba(212,175,55,0.06) 0%, transparent 60%),
        radial-gradient(ellipse 50% 60% at 90% 80%, rgba(30,58,138,0.12) 0%, transparent 60%);
    animation: bgPulse 6s ease-in-out infinite alternate;
}
@keyframes bgPulse {
    from { opacity: 0.6; }
    to   { opacity: 1; }
}

/* Floating dots */
.dot {
    position: absolute;
    border-radius: 50%;
    animation: float linear infinite;
    opacity: 0.15;
}
@keyframes float {
    0%   { transform: translateY(100vh) rotate(0deg); opacity: 0; }
    10%  { opacity: 0.15; }
    90%  { opacity: 0.15; }
    100% { transform: translateY(-10vh) rotate(720deg); opacity: 0; }
}

.error-content {
    text-align: center;
    z-index: 10;
    padding: 2rem;
    animation: fadeInUp 0.8s cubic-bezier(0.22,1,0.36,1) both;
}
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(40px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* Big number */
.error-code {
    font-size: clamp(6rem, 20vw, 14rem);
    font-weight: 900;
    line-height: 1;
    letter-spacing: -0.05em;
    background: linear-gradient(135deg, #D4AF37 0%, #F5D76E 40%, #D4AF37 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    animation: shimmer 3s ease-in-out infinite;
    background-size: 200% 100%;
    filter: drop-shadow(0 0 40px rgba(212,175,55,0.3));
}
@keyframes shimmer {
    0%, 100% { background-position: 0% 50%; }
    50%       { background-position: 100% 50%; }
}

/* Glitch effect on the number */
.error-code {
    position: relative;
    display: inline-block;
}
.error-code::before,
.error-code::after {
    content: attr(data-text);
    position: absolute;
    top: 0; left: 0; right: 0;
    background: linear-gradient(135deg, #D4AF37 0%, #F5D76E 40%, #D4AF37 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
.error-code::before {
    animation: glitch1 4s infinite;
    clip-path: polygon(0 0, 100% 0, 100% 40%, 0 40%);
    opacity: 0.5;
}
.error-code::after {
    animation: glitch2 4s infinite;
    clip-path: polygon(0 60%, 100% 60%, 100% 100%, 0 100%);
    opacity: 0.5;
}
@keyframes glitch1 {
    0%,90%,100% { transform: none; }
    91%  { transform: translate(-2px, -1px); }
    93%  { transform: translate(2px, 1px); }
    95%  { transform: translate(-1px, 2px); }
}
@keyframes glitch2 {
    0%,90%,100% { transform: none; }
    92%  { transform: translate(2px, 1px); }
    94%  { transform: translate(-2px, -1px); }
    96%  { transform: translate(1px, -2px); }
}

.error-icon {
    font-size: 3rem;
    margin-bottom: 1rem;
    animation: bounce 2s ease-in-out infinite;
}
@keyframes bounce {
    0%, 100% { transform: translateY(0); }
    50%       { transform: translateY(-12px); }
}

.error-title {
    font-size: clamp(1.25rem, 4vw, 2rem);
    font-weight: 800;
    color: #ffffff;
    margin: 0.5rem 0;
}

.error-desc {
    font-size: 1rem;
    color: rgba(255,255,255,0.55);
    max-width: 420px;
    margin: 0.75rem auto 2rem;
    line-height: 1.7;
}

/* Countdown bar */
.countdown-wrap {
    margin-bottom: 2rem;
}
.countdown-text {
    font-size: 0.875rem;
    color: rgba(255,255,255,0.5);
    margin-bottom: 8px;
}
.countdown-text span {
    color: #D4AF37;
    font-weight: 700;
    font-size: 1.1rem;
}
.countdown-bar-track {
    width: 220px;
    height: 4px;
    background: rgba(255,255,255,0.1);
    border-radius: 99px;
    margin: 0 auto;
    overflow: hidden;
}
.countdown-bar-fill {
    height: 100%;
    background: linear-gradient(90deg, #D4AF37, #F5D76E);
    border-radius: 99px;
    width: 100%;
    transform-origin: left;
    animation: shrink 10s linear forwards;
}
@keyframes shrink {
    from { transform: scaleX(1); }
    to   { transform: scaleX(0); }
}

/* Buttons */
.error-actions {
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
}
.btn-primary-err {
    background: linear-gradient(135deg, #D4AF37, #B8962E);
    color: #0F172A;
    font-weight: 800;
    font-size: 0.9375rem;
    padding: 0.75rem 2rem;
    border-radius: 999px;
    text-decoration: none;
    border: none;
    cursor: pointer;
    transition: all 0.25s;
    box-shadow: 0 4px 20px rgba(212,175,55,0.4);
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}
.btn-primary-err:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 28px rgba(212,175,55,0.5);
}
.btn-ghost-err {
    color: rgba(255,255,255,0.7);
    font-weight: 600;
    font-size: 0.9rem;
    padding: 0.75rem 1.5rem;
    border-radius: 999px;
    text-decoration: none;
    border: 1px solid rgba(255,255,255,0.2);
    transition: all 0.25s;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}
.btn-ghost-err:hover {
    border-color: rgba(255,255,255,0.5);
    color: #fff;
    background: rgba(255,255,255,0.05);
}

/* Quick links */
.error-links {
    margin-top: 2.5rem;
    display: flex;
    gap: 0.5rem 1.5rem;
    justify-content: center;
    flex-wrap: wrap;
}
.error-links a {
    color: rgba(255,255,255,0.4);
    font-size: 0.8rem;
    text-decoration: none;
    transition: color 0.2s;
}
.error-links a:hover {
    color: #D4AF37;
}
</style>

<!-- Floating dots JS -->
<script>
(function() {
    window.addEventListener('DOMContentLoaded', function() {
        var page = document.querySelector('.error-page');
        for (var i = 0; i < 15; i++) {
            var d = document.createElement('div');
            d.className = 'dot';
            var size = Math.random() * 60 + 10;
            d.style.cssText = [
                'width:' + size + 'px',
                'height:' + size + 'px',
                'left:' + Math.random() * 100 + '%',
                'background:' + (Math.random() > 0.5 ? '#D4AF37' : '#1E3A8A'),
                'animation-duration:' + (Math.random() * 15 + 8) + 's',
                'animation-delay:' + (Math.random() * 8) + 's',
            ].join(';');
            page.appendChild(d);
        }

        // Countdown redirect
        var count = 10;
        var el = document.getElementById('countdown-num');
        if (!el) return;
        var timer = setInterval(function() {
            count--;
            el.textContent = count;
            if (count <= 0) {
                clearInterval(timer);
                window.location.href = '<?php echo esc_js(home_url("/")); ?>';
            }
        }, 1000);
    });
})();
</script>

<div class="error-page">
    <div class="error-content">
        <div class="error-icon">🔍</div>

        <div class="error-code" data-text="404">404</div>

        <h1 class="error-title">Halaman Tidak Ditemukan</h1>
        <p class="error-desc">
            Halaman yang Anda cari tidak ada, sudah dipindahkan, atau mungkin Anda salah mengetik URL. Jangan khawatir, kami bantu Anda kembali!
        </p>

        <div class="countdown-wrap">
            <p class="countdown-text">Kembali ke beranda dalam <span id="countdown-num">10</span> detik</p>
            <div class="countdown-bar-track"><div class="countdown-bar-fill"></div></div>
        </div>

        <div class="error-actions">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="btn-primary-err">
                🏠 Kembali ke Beranda
            </a>
            <a href="javascript:history.back()" class="btn-ghost-err">
                ← Halaman Sebelumnya
            </a>
        </div>

        <div class="error-links">
            <a href="<?php echo esc_url(home_url('/fitur')); ?>">Fitur</a>
            <a href="<?php echo esc_url(home_url('/harga')); ?>">Harga</a>
            <a href="<?php echo esc_url(home_url('/use-case')); ?>">Use Case</a>
            <a href="<?php echo esc_url(home_url('/artikel')); ?>">Artikel</a>
            <a href="<?php echo esc_url(home_url('/analitik')); ?>">Analitik</a>
        </div>
    </div>
</div>

</main>

<?php get_footer(); ?>
