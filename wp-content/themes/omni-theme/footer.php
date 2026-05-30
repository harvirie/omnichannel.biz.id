<?php 
// Fetch data
$omni_footer = get_option('omni_editor_footer', []);

// Fallbacks
$logo_url = !empty($omni_footer['logo_url']) ? $omni_footer['logo_url'] : 'https://res.cloudinary.com/dtxwwevxl/image/upload/v1778221347/logo_long_wh_ysccoa.svg';
$description = $omni_footer['description'] ?? 'Satu layar untuk semua saluran. Tingkatkan kepuasan pelanggan dengan sistem omnichannel terbaik.';
$columns = !empty($omni_footer['columns']) ? $omni_footer['columns'] : [
    [
        'title' => 'Produk',
        'links' => [
            ['label' => 'Fitur Utama', 'url' => '/fitur'],
            ['label' => 'Analitik Data', 'url' => '/analitik'],
            ['label' => 'Use Case', 'url' => '/use-case'],
            ['label' => 'Harga', 'url' => '/harga'],
        ]
    ],
    [
        'title' => 'Perusahaan',
        'links' => [
            ['label' => 'Tentang Kami', 'url' => '#'],
            ['label' => 'Karir', 'url' => '#'],
            ['label' => 'Hubungi Kami', 'url' => 'https://wa.me/6281283835553'],
        ]
    ]
];
$socials = !empty($omni_footer['socials']) ? $omni_footer['socials'] : [
    ['icon' => 'facebook', 'url' => 'https://facebook.com/omniserve', 'label' => 'Facebook OmniServe'],
    ['icon' => 'x-twitter', 'url' => 'https://twitter.com/omniserve', 'label' => 'Twitter OmniServe'],
    ['icon' => 'instagram', 'url' => 'https://instagram.com/omniserve', 'label' => 'Instagram OmniServe'],
    ['icon' => 'linkedin', 'url' => 'https://linkedin.com/company/omniserve', 'label' => 'LinkedIn OmniServe'],
    ['icon' => 'youtube', 'url' => 'https://youtube.com/@omniserve', 'label' => 'YouTube OmniServe']
];
$copyright = $omni_footer['copyright'] ?? 'Theme Design by Harizal.';
?>
<!-- Shared Footer -->
<footer class="bg-omni-dark text-white/70 py-12 border-t border-white/10 mt-auto">
  <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-8">
    <div class="col-span-1 md:col-span-2">
      <div class="flex items-center mb-4">
        <!-- Logo full untuk latar gelap (footer) -->
        <a href="<?php echo home_url('/'); ?>" aria-label="Beranda OmniServe">
          <img src="<?php echo esc_url($logo_url); ?>"
               alt="<?php echo esc_attr(get_bloginfo('name') ?: 'OmniServe Logo'); ?>"
               class="h-16 w-auto object-contain"
               loading="lazy">
        </a>
      </div>
      <div class="max-w-xs text-sm leading-relaxed mb-6 omni-rich-text">
        <?php echo wpautop($description); ?>
      </div>
    </div>
    
    <?php foreach ($columns as $idx => $col): ?>
    <div>
      <h4 class="text-white font-semibold mb-4"><?php echo $col['title']; ?></h4>
      <ul class="space-y-2 text-sm">
        <?php foreach (($col['links'] ?? []) as $link): ?>
        <li><a href="<?php echo esc_url(str_starts_with($link['url'], '/') ? home_url($link['url']) : $link['url']); ?>" class="hover:text-omni-accent transition-colors" <?php echo str_starts_with($link['url'], 'http') ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>><?php echo $link['label']; ?></a></li>
        <?php endforeach; ?>
      </ul>
      
      <?php if ($idx === count($columns) - 1 && !empty($socials)): ?>
      <h4 class="text-white font-semibold mt-6 mb-4">Ikuti Kami</h4>
      <div class="flex gap-4">
        <?php foreach ($socials as $soc): ?>
        <a href="<?php echo esc_url($soc['url']); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr($soc['label']); ?>" class="text-white/70 hover:text-omni-accent transition-colors"><i class="fa-brands fa-<?php echo esc_attr($soc['icon']); ?> text-xl"></i></a>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>
    </div>
    <?php endforeach; ?>
  </div>
  <div class="max-w-7xl mx-auto px-6 mt-12 pt-8 border-t border-white/10 text-sm flex flex-col md:flex-row justify-between items-center text-center gap-3">
    <p>&copy; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?>. Hak Cipta Dilindungi. <?php echo $copyright; ?></p>
    <button onclick="omniConsentShowBanner()" style="
        background:rgba(212,175,55,0.1); border:1px solid rgba(212,175,55,0.3);
        color:#D4AF37; padding:6px 14px; border-radius:8px;
        font-family:'Outfit',sans-serif; font-size:11px; font-weight:600;
        cursor:pointer; transition:all .2s; white-space:nowrap;
        display:inline-flex; align-items:center; gap:6px;
    " onmouseover="this.style.background='rgba(212,175,55,0.2)'" onmouseout="this.style.background='rgba(212,175,55,0.1)'">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#D4AF37" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        Pengaturan Privasi
    </button>
  </div>
</footer>

<!-- Demo Modal -->
<div id="demo-modal" class="fixed inset-0 z-[100] hidden">
  <div class="absolute inset-0 bg-black/50 backdrop-blur-sm transition-opacity" onclick="document.getElementById('demo-modal').classList.add('hidden')"></div>
  <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-md bg-white rounded-3xl p-8 shadow-2xl z-10 transition-transform max-h-[90vh] overflow-y-auto">
    <div class="flex justify-between items-center mb-6">
      <h3 class="text-2xl font-bold text-omni-dark">Jadwalkan Demo</h3>
      <button onclick="document.getElementById('demo-modal').classList.add('hidden')" class="text-slate-400 hover:text-slate-600">
        <i data-lucide="x" class="h-6 w-6"></i>
      </button>
    </div>
    <form id="demo-form" class="space-y-4" onsubmit="submitDemoForm(event)">
      <div>
        <label class="block text-sm font-medium text-omni-text-muted mb-1">Nama Lengkap</label>
        <input type="text" name="demo_name" required class="w-full px-4 py-2 border border-omni-border rounded-xl focus:outline-none focus:border-omni-accent focus:ring-1 focus:ring-omni-accent">
      </div>
      <div>
        <label class="block text-sm font-medium text-omni-text-muted mb-1">Perusahaan</label>
        <input type="text" name="demo_company" required class="w-full px-4 py-2 border border-omni-border rounded-xl focus:outline-none focus:border-omni-accent focus:ring-1 focus:ring-omni-accent">
      </div>
      <div class="grid grid-cols-2 gap-4">
        <div>
          <label class="block text-sm font-medium text-omni-text-muted mb-1">Email</label>
          <input type="email" name="demo_email" required class="w-full px-4 py-2 border border-omni-border rounded-xl focus:outline-none focus:border-omni-accent focus:ring-1 focus:ring-omni-accent">
        </div>
        <div>
          <label class="block text-sm font-medium text-omni-text-muted mb-1">WhatsApp</label>
          <input type="tel" name="demo_phone" required class="w-full px-4 py-2 border border-omni-border rounded-xl focus:outline-none focus:border-omni-accent focus:ring-1 focus:ring-omni-accent">
        </div>
      </div>
      <div class="grid grid-cols-2 gap-4">
        <div>
          <label class="block text-sm font-medium text-omni-text-muted mb-1">Tanggal</label>
          <input type="date" name="demo_date" required class="w-full px-4 py-2 border border-omni-border rounded-xl focus:outline-none focus:border-omni-accent focus:ring-1 focus:ring-omni-accent">
        </div>
        <div>
          <label class="block text-sm font-medium text-omni-text-muted mb-1">Jam</label>
          <input type="time" name="demo_time" required class="w-full px-4 py-2 border border-omni-border rounded-xl focus:outline-none focus:border-omni-accent focus:ring-1 focus:ring-omni-accent">
        </div>
      </div>
      <div>
        <label class="block text-sm font-medium text-omni-text-muted mb-2">Pilihan Pertemuan</label>
        <div class="flex gap-4">
          <label class="flex items-center gap-2 cursor-pointer">
            <input type="radio" name="demo_type" value="Online" required class="accent-omni-accent" onchange="toggleDemoAddress(this.value)" checked>
            <span class="text-sm">Online (Zoom/Meet)</span>
          </label>
          <label class="flex items-center gap-2 cursor-pointer">
            <input type="radio" name="demo_type" value="Offline" required class="accent-omni-accent" onchange="toggleDemoAddress(this.value)">
            <span class="text-sm">Offline (Kunjungan)</span>
          </label>
        </div>
      </div>
      <div id="demo-address-wrapper" class="hidden">
        <label class="block text-sm font-medium text-omni-text-muted mb-1">Alamat Kantor</label>
        <textarea name="demo_address" rows="2" class="w-full px-4 py-2 border border-omni-border rounded-xl focus:outline-none focus:border-omni-accent focus:ring-1 focus:ring-omni-accent"></textarea>
      </div>
      <button type="submit" id="demo-submit-btn" class="w-full bg-omni-accent hover:bg-omni-accent-hover text-white font-bold py-3 rounded-xl transition-colors mt-2">Ajukan</button>
      <div id="demo-msg" class="hidden text-center text-sm font-medium mt-2"></div>
    </form>
  </div>
</div>

<script>
function toggleDemoAddress(val) {
  const wrap = document.getElementById('demo-address-wrapper');
  if (val === 'Offline') {
    wrap.classList.remove('hidden');
    wrap.querySelector('textarea').required = true;
  } else {
    wrap.classList.add('hidden');
    wrap.querySelector('textarea').required = false;
  }
}

async function submitDemoForm(e) {
  e.preventDefault();
  const form = e.target;
  const msg = document.getElementById('demo-msg');
  const btn = document.getElementById('demo-submit-btn');
  const formData = new FormData(form);
  formData.append('action', 'submit_demo');
  
  btn.disabled = true;
  btn.innerText = 'Mengirim...';
  msg.classList.add('hidden');
  
  try {
    const res = await fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
      method: 'POST',
      body: formData
    });
    const data = await res.json();
    
    msg.classList.remove('hidden');
    if (data.success) {
      msg.className = 'text-center text-sm font-medium mt-4 text-green-600 bg-green-50 p-3 rounded-lg';
      msg.innerText = data.data;
      form.reset();
      setTimeout(() => {
        document.getElementById('demo-modal').classList.add('hidden');
        msg.classList.add('hidden');
      }, 3000);
    } else {
      msg.className = 'text-center text-sm font-medium mt-4 text-red-600 bg-red-50 p-3 rounded-lg';
      msg.innerText = data.data || 'Terjadi kesalahan. Silakan coba lagi.';
    }
  } catch (err) {
    msg.classList.remove('hidden');
    msg.className = 'text-center text-sm font-medium mt-4 text-red-600 bg-red-50 p-3 rounded-lg';
    msg.innerText = 'Gagal terhubung ke server.';
  } finally {
    btn.disabled = false;
    btn.innerText = 'Ajukan';
  }
}
</script>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js" defer></script>
<script>
  // Supress Swiper Loop Warning
  const originalWarn = console.warn;
  console.warn = function(msg) {
    if (typeof msg === 'string' && msg.includes('Swiper Loop Warning')) return;
    originalWarn.apply(console, arguments);
  };

  // Initialize Lucide icons - dengan delay karena script defer
  function initLucide() {
    if (typeof lucide !== 'undefined') {
      lucide.createIcons();
      // Fallback ke-2: setelah 500ms untuk icon yang di-render lewat PHP loop
      setTimeout(function() { lucide.createIcons(); }, 500);
    } else {
      setTimeout(initLucide, 100);
    }
  }
  document.addEventListener('DOMContentLoaded', initLucide);

  // Mobile menu toggle
  document.addEventListener('DOMContentLoaded', function() {
    const mobileBtn = document.getElementById('mobile-menu-btn');
    const mobileCloseBtn = document.getElementById('mobile-menu-close');
    const mobileDrawer = document.getElementById('mobile-menu-drawer');
    const mobileOverlay = document.getElementById('mobile-menu-overlay');

    function openMobileMenu() {
      mobileDrawer.classList.remove('-translate-x-full');
      mobileOverlay.classList.remove('opacity-0', 'pointer-events-none');
      document.body.style.overflow = 'hidden'; // Prevent background scrolling
      // Re-render Lucide icons di dalam drawer setiap kali dibuka
      if (typeof lucide !== 'undefined') { lucide.createIcons(); }
    }

    function closeMobileMenu() {
      mobileDrawer.classList.add('-translate-x-full');
      mobileOverlay.classList.add('opacity-0', 'pointer-events-none');
      document.body.style.overflow = '';
    }

    if (mobileBtn && mobileDrawer) {
      mobileBtn.addEventListener('click', openMobileMenu);
      if (mobileCloseBtn) mobileCloseBtn.addEventListener('click', closeMobileMenu);
      if (mobileOverlay) mobileOverlay.addEventListener('click', closeMobileMenu);
    }

    // === OPTIMASI TBT: Inisialisasi Swiper via Intersection Observer ===
    // Swiper hanya di-init saat carousel masuk ke viewport, bukan saat halaman load.
    function lazyInitSwiper(selector, config) {
      const el = document.querySelector(selector);
      if (!el) return;

      // Automatically disable loop if not enough slides to prevent Swiper warning
      if (config.loop) {
        const slides = el.querySelectorAll('.swiper-slide');
        let maxSlidesPerView = config.slidesPerView || 1;
        if (config.breakpoints) {
          for (const bp in config.breakpoints) {
            if (config.breakpoints[bp].slidesPerView > maxSlidesPerView) {
              maxSlidesPerView = config.breakpoints[bp].slidesPerView;
            }
          }
        }
        // Swiper generally needs at least slidesPerView * 2 slides for loop mode
        if (slides.length < maxSlidesPerView * 2) {
          config.loop = false;
        }
      }

      const observer = new IntersectionObserver((entries, obs) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            const initSwiper = () => {
              if (typeof Swiper !== 'undefined') {
                new Swiper(selector, config);
              } else {
                setTimeout(initSwiper, 500);
              }
            };
            // Defer initialization aggressively to save TBT
            setTimeout(initSwiper, 3000);
            obs.unobserve(el);
          }
        });
      }, { threshold: 0.1 });

      observer.observe(el);
    }

    <?php $recSpeed = (int)get_theme_mod('omni_rec_speed', 10) * 1000; ?>

    // Customers Carousel — lazy init
    lazyInitSwiper('.customers-swiper', {
      slidesPerView: 1,
      spaceBetween: 20,
      loop: true,
      autoplay: { delay: 3000, disableOnInteraction: false },
      pagination: { el: '.swiper-pagination', clickable: true },
      navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
      breakpoints: {
        640:  { slidesPerView: 2, spaceBetween: 20 },
        1024: { slidesPerView: 3, spaceBetween: 30 },
        1280: { slidesPerView: 4, spaceBetween: 30 },
      }
    });

    // Integration Carousel (Mobile) — lazy init
    lazyInitSwiper('.integration-swiper', {
      slidesPerView: 2,
      spaceBetween: 12,
      loop: true,
      autoplay: { delay: 5000, disableOnInteraction: false },
    });

    // Recommended Carousel — lazy init
    lazyInitSwiper('.swiper-recommended', {
      slidesPerView: 1,
      loop: true,
      speed: 1000,
      grabCursor: true,
      autoplay: { delay: <?php echo $recSpeed; ?>, disableOnInteraction: false },
    });


  });
</script>

<!-- ===== CONSENT BANNER: COOKIE + DATA PRIBADI (GDPR & UU PDP No.27/2022) ===== -->
<div id="omni-consent-backdrop" style="
    display:none; position:fixed; inset:0; z-index:9998;
    background:rgba(0,0,0,0.5); backdrop-filter:blur(4px);
"></div>

<div id="omni-consent-banner" style="
    position: fixed; bottom: 0; left: 0; right: 0; z-index: 9999;
    transform: translateY(100%);
    transition: transform 0.55s cubic-bezier(0.22, 1, 0.36, 1);
    padding: 0 16px 20px;
    pointer-events: none;
">
    <!-- Langkah 1: Banner utama ringkas -->
    <div id="omni-consent-step1" style="
        max-width: 960px; margin: 0 auto;
        background: #0F172A;
        border: 1px solid rgba(212,175,55,0.35);
        border-radius: 20px;
        padding: 18px 20px 18px 26px;
        display: flex; flex-wrap: wrap; align-items: center; gap: 14px;
        box-shadow: 0 -8px 50px rgba(0,0,0,0.5), 0 0 0 1px rgba(212,175,55,0.08);
        pointer-events: auto; position: relative;
    ">
        <!-- Tombol X tutup banner (sementara hide, bukan decline) -->
        <button onclick="omniConsentTempHide()" title="Tutup sementara" style="
            position:absolute; top:10px; right:12px;
            background:rgba(255,255,255,0.06); border:1px solid rgba(255,255,255,0.12);
            color:#64748B; width:26px; height:26px; border-radius:50%;
            cursor:pointer; font-size:14px; line-height:1;
            display:flex; align-items:center; justify-content:center;
            transition:all .2s; flex-shrink:0;
        " onmouseover="this.style.color='#fff';this.style.background='rgba(255,255,255,0.14)'" onmouseout="this.style.color='#64748B';this.style.background='rgba(255,255,255,0.06)'">✕</button>

        <!-- Icon + Teks -->
        <div style="display:flex; align-items:flex-start; gap:14px; flex:1; min-width:240px; padding-right:20px;">
            <div style="background:rgba(212,175,55,0.15); border-radius:12px; padding:11px; flex-shrink:0;">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#D4AF37" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
            </div>
            <div>
                <div style="color:#fff; font-family:'Outfit',sans-serif; font-size:14px; font-weight:700; margin-bottom:5px;">
                    Privasi & Persetujuan Data Anda 🔒
                </div>
                <div style="color:#94A3B8; font-family:'Outfit',sans-serif; font-size:12px; line-height:1.65;">
                    Kami menggunakan <strong style="color:#cbd5e1;">cookies</strong> dan memproses <strong style="color:#cbd5e1;">data pribadi</strong> Anda sesuai <strong style="color:#D4AF37;">UU PDP No. 27/2022</strong> dan standar <strong style="color:#D4AF37;">GDPR</strong>.
                    Dengan melanjutkan, Anda memberikan persetujuan. <button onclick="omniConsentShowDetail()" style="background:none;border:none;padding:0;color:#D4AF37;font-size:12px;font-family:'Outfit',sans-serif;cursor:pointer;text-decoration:underline;font-weight:600;">Lihat detail →</button>
                </div>
            </div>
        </div>
        <!-- Tombol aksi -->
        <div style="display:flex; flex-wrap:wrap; gap:10px; flex-shrink:0; align-items:center;">
            <button onclick="omniConsentEssentialOnly()" style="
                background:rgba(255,255,255,0.07); border:1px solid rgba(255,255,255,0.15);
                color:#cbd5e1; padding:9px 16px; border-radius:10px;
                font-family:'Outfit',sans-serif; font-size:12px; font-weight:500;
                cursor:pointer; transition:all .2s;
            " onmouseover="this.style.background='rgba(255,255,255,0.14)'" onmouseout="this.style.background='rgba(255,255,255,0.07)'">
                Esensial Saja
            </button>
            <button onclick="omniConsentAcceptAll()" style="
                background:linear-gradient(135deg, #D4AF37, #B8962E);
                border:none; color:#fff; padding:9px 20px; border-radius:10px;
                font-family:'Outfit',sans-serif; font-size:12px; font-weight:700;
                cursor:pointer; transition:all .2s;
                box-shadow:0 4px 15px rgba(212,175,55,0.35);
            " onmouseover="this.style.transform='translateY(-1px)';this.style.boxShadow='0 6px 22px rgba(212,175,55,0.55)'" onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 4px 15px rgba(212,175,55,0.35)'">
                Terima Semua ✓
            </button>
        </div>
    </div>
</div>

<!-- Langkah 2: Modal detail (UU PDP + GDPR) -->
<div id="omni-consent-detail" style="
    display:none; position:fixed; inset:0; z-index:10000;
    align-items:center; justify-content:center; padding:16px;
">
    <div style="
        background:#0F172A; border:1px solid rgba(212,175,55,0.3);
        border-radius:24px; max-width:680px; width:100%; max-height:88vh;
        overflow-y:auto; box-shadow:0 24px 80px rgba(0,0,0,0.7);
        font-family:'Outfit',sans-serif;
    ">
        <!-- Header Modal -->
        <div style="position:sticky;top:0;background:#0F172A;border-bottom:1px solid rgba(255,255,255,0.08);padding:20px 24px;display:flex;justify-content:space-between;align-items:center;z-index:1;border-radius:24px 24px 0 0;">
            <div>
                <div style="color:#D4AF37;font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;margin-bottom:4px;">Pusat Privasi</div>
                <div style="color:#fff;font-size:17px;font-weight:700;">Pengaturan Privasi & Persetujuan</div>
            </div>
            <button onclick="omniConsentHideDetail()" style="background:rgba(255,255,255,0.08);border:none;color:#94A3B8;width:36px;height:36px;border-radius:50%;cursor:pointer;font-size:18px;display:flex;align-items:center;justify-content:center;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='#94A3B8'">✕</button>
        </div>

        <!-- Body Modal -->
        <div style="padding:24px;">

            <!-- Dasar Hukum -->
            <div style="background:rgba(212,175,55,0.08);border:1px solid rgba(212,175,55,0.2);border-radius:14px;padding:16px;margin-bottom:20px;">
                <div style="color:#D4AF37;font-size:12px;font-weight:700;margin-bottom:8px;">⚖️ Dasar Hukum Pemrosesan Data</div>
                <div style="color:#94A3B8;font-size:12px;line-height:1.7;">
                    Pemrosesan data pribadi Anda didasarkan pada:<br>
                    • <strong style="color:#cbd5e1;">UU No. 27 Tahun 2022</strong> tentang Perlindungan Data Pribadi (UU PDP) — Indonesia<br>
                    • <strong style="color:#cbd5e1;">Peraturan GDPR (EU) 2016/679</strong> — untuk pengguna di wilayah Eropa<br>
                    • Persetujuan eksplisit Anda sebagai Subjek Data (Pasal 9 UU PDP)
                </div>
            </div>

            <!-- Data yang Dikumpulkan -->
            <div style="margin-bottom:20px;">
                <div style="color:#fff;font-size:13px;font-weight:700;margin-bottom:12px;">📋 Data Pribadi yang Kami Kumpulkan</div>
                <?php
                $data_items = [
                    ['icon'=>'👤','title'=>'Data Identitas','desc'=>'Nama lengkap, alamat email, dan nomor WhatsApp — dikumpulkan saat Anda mengisi form Demo atau menghubungi kami.'],
                    ['icon'=>'🏢','title'=>'Data Perusahaan','desc'=>'Nama perusahaan dan alamat kantor — untuk keperluan penjadwalan dan tindak lanjut layanan.'],
                    ['icon'=>'🌐','title'=>'Data Teknis','desc'=>'Alamat IP, jenis browser, halaman yang dikunjungi, dan waktu akses — dikumpulkan otomatis oleh sistem untuk keamanan dan analitik.'],
                    ['icon'=>'🍪','title'=>'Data Cookie','desc'=>'Cookie sesi (wajib), cookie analitik (opsional), dan cookie preferensi — untuk memastikan website berfungsi dengan baik.'],
                ];
                foreach ($data_items as $item): ?>
                <div style="display:flex;gap:12px;padding:12px;background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.07);border-radius:12px;margin-bottom:8px;">
                    <div style="font-size:18px;flex-shrink:0;"><?php echo $item['icon']; ?></div>
                    <div>
                        <div style="color:#fff;font-size:13px;font-weight:600;margin-bottom:3px;"><?php echo $item['title']; ?></div>
                        <div style="color:#64748B;font-size:12px;line-height:1.6;"><?php echo $item['desc']; ?></div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Tujuan Pemrosesan -->
            <div style="margin-bottom:20px;">
                <div style="color:#fff;font-size:13px;font-weight:700;margin-bottom:12px;">🎯 Tujuan Pemrosesan</div>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:8px;">
                    <?php
                    $purposes = [
                        ['Pemenuhan Layanan','Menindaklanjuti permintaan demo, konsultasi, dan pertanyaan layanan Anda.'],
                        ['Keamanan Sistem','Mendeteksi dan mencegah akses tidak sah serta aktivitas berbahaya.'],
                        ['Analitik & Peningkatan','Memahami cara pengguna menggunakan layanan untuk meningkatkan kualitas.'],
                        ['Komunikasi Pemasaran','Mengirimkan informasi produk & penawaran (hanya dengan persetujuan Anda).'],
                    ];
                    foreach ($purposes as $p): ?>
                    <div style="background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.07);border-radius:10px;padding:12px;">
                        <div style="color:#D4AF37;font-size:12px;font-weight:600;margin-bottom:4px;"><?php echo $p[0]; ?></div>
                        <div style="color:#64748B;font-size:11px;line-height:1.5;"><?php echo $p[1]; ?></div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Hak Subjek Data (UU PDP Pasal 5-16) -->
            <div style="margin-bottom:20px;">
                <div style="color:#fff;font-size:13px;font-weight:700;margin-bottom:12px;">🛡️ Hak Anda sebagai Subjek Data <span style="color:#64748B;font-weight:400;font-size:11px;">(UU PDP Pasal 5–16)</span></div>
                <div style="background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.07);border-radius:12px;padding:14px;">
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:6px 16px;color:#94A3B8;font-size:12px;">
                        <div>✓ Hak mengakses data pribadi Anda</div>
                        <div>✓ Hak mengoreksi data yang tidak akurat</div>
                        <div>✓ Hak menghapus/melupakan data</div>
                        <div>✓ Hak membatasi pemrosesan</div>
                        <div>✓ Hak mencabut persetujuan sewaktu-waktu</div>
                        <div>✓ Hak mengajukan pengaduan ke KOMINFO</div>
                    </div>
                    <div style="margin-top:10px;padding-top:10px;border-top:1px solid rgba(255,255,255,0.07);color:#64748B;font-size:11px;">
                        Untuk menggunakan hak Anda, hubungi: <a href="https://wa.me/6281283835553" style="color:#D4AF37;">WhatsApp Tim Kami</a> atau email ke alamat yang tertera di website.
                    </div>
                </div>
            </div>

            <!-- Toggle Kategori Cookie -->
            <div style="margin-bottom:24px;">
                <div style="color:#fff;font-size:13px;font-weight:700;margin-bottom:12px;">⚙️ Kelola Preferensi Cookie</div>
                <?php
                $cookie_cats = [
                    ['id'=>'c_essential','label'=>'Cookie Esensial','desc'=>'Diperlukan agar website berfungsi. Tidak dapat dinonaktifkan.','locked'=>true],
                    ['id'=>'c_analytics','label'=>'Cookie Analitik','desc'=>'Membantu kami memahami penggunaan website (Google Analytics, dll).','locked'=>false],
                    ['id'=>'c_marketing','label'=>'Cookie Pemasaran','desc'=>'Untuk menampilkan iklan yang relevan dan mengukur efektivitas kampanye.','locked'=>false],
                ];
                foreach ($cookie_cats as $cat): ?>
                <div style="display:flex;justify-content:space-between;align-items:center;padding:12px 14px;background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.07);border-radius:12px;margin-bottom:8px;">
                    <div style="flex:1;margin-right:12px;">
                        <div style="color:#fff;font-size:13px;font-weight:600;margin-bottom:2px;"><?php echo $cat['label']; ?><?php if($cat['locked']): ?> <span style="color:#D4AF37;font-size:10px;background:rgba(212,175,55,0.15);padding:1px 6px;border-radius:4px;">Wajib</span><?php endif; ?></div>
                        <div style="color:#64748B;font-size:11px;"><?php echo $cat['desc']; ?></div>
                    </div>
                    <label style="position:relative;display:inline-block;width:44px;height:24px;flex-shrink:0;">
                        <input type="checkbox" id="<?php echo $cat['id']; ?>" <?php if($cat['locked']): ?>checked disabled<?php endif; ?> style="opacity:0;width:0;height:0;">
                        <span onclick="<?php if(!$cat['locked']): ?>omniToggleCookie('<?php echo $cat['id']; ?>')<?php endif; ?>" style="
                            position:absolute;cursor:<?php echo $cat['locked']?'not-allowed':'pointer';?>;
                            top:0;left:0;right:0;bottom:0;
                            background:<?php echo $cat['locked']?'#D4AF37':'rgba(255,255,255,0.15)';?>;
                            border-radius:999px;transition:.3s;
                        " id="toggle_<?php echo $cat['id']; ?>">
                            <span style="
                                position:absolute;content:'';height:18px;width:18px;left:3px;bottom:3px;
                                background:white;border-radius:50%;transition:.3s;
                                transform:<?php echo $cat['locked']?'translateX(20px)':'translateX(0)';?>;
                            " id="knob_<?php echo $cat['id']; ?>"></span>
                        </span>
                    </label>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Tombol Aksi -->
            <div style="display:flex;gap:12px;flex-wrap:wrap;">
                <button onclick="omniConsentSavePrefs()" style="
                    flex:1;background:rgba(255,255,255,0.07);border:1px solid rgba(255,255,255,0.15);
                    color:#cbd5e1;padding:12px;border-radius:12px;
                    font-family:'Outfit',sans-serif;font-size:13px;font-weight:600;
                    cursor:pointer;transition:all .2s;min-width:140px;
                " onmouseover="this.style.background='rgba(255,255,255,0.14)'" onmouseout="this.style.background='rgba(255,255,255,0.07)'">
                    Simpan Preferensi
                </button>
                <button onclick="omniConsentAcceptAll()" style="
                    flex:2;background:linear-gradient(135deg,#D4AF37,#B8962E);
                    border:none;color:#fff;padding:12px;border-radius:12px;
                    font-family:'Outfit',sans-serif;font-size:13px;font-weight:700;
                    cursor:pointer;transition:all .2s;
                    box-shadow:0 4px 15px rgba(212,175,55,0.35);
                " onmouseover="this.style.boxShadow='0 6px 22px rgba(212,175,55,0.55)'" onmouseout="this.style.boxShadow='0 4px 15px rgba(212,175,55,0.35)'">
                    Setujui Semua & Tutup ✓
                </button>
            </div>
            <div style="text-align:center;margin-top:14px;color:#334155;font-size:11px;">
                Dengan menekan "Setujui Semua", Anda memberikan persetujuan eksplisit atas pemrosesan data pribadi Anda sesuai ketentuan yang berlaku. Anda dapat mencabut persetujuan kapan saja.
            </div>
        </div>
    </div>
</div>

<script>
(function() {
    var banner      = document.getElementById('omni-consent-banner');
    var backdrop    = document.getElementById('omni-consent-backdrop');
    var detail      = document.getElementById('omni-consent-detail');
    var CONSENT_KEY = 'omni_pdp_consent_v1';
    var cookieState = { c_analytics: false, c_marketing: false };

    function showBanner() {
        banner.style.transform = 'translateY(0)';
        banner.style.pointerEvents = 'auto';
    }
    function hideBanner() {
        banner.style.transform = 'translateY(120%)';
        banner.style.pointerEvents = 'none';
        setTimeout(function() { banner.style.opacity = '0'; }, 600);
    }

    function saveConsent(type, prefs) {
        var record = {
            version: 1, type: type, timestamp: new Date().toISOString(),
            prefs: prefs || cookieState
        };
        try {
            localStorage.setItem(CONSENT_KEY, JSON.stringify(record));
        } catch(e) { console.error('Consent storage failed', e); }
        
        hideBanner();
        omniConsentHideDetail();
    }

    window.omniConsentAcceptAll = function() {
        saveConsent('all', { c_analytics: true, c_marketing: true });
    };
    window.omniConsentEssentialOnly = function() {
        saveConsent('essential', { c_analytics: false, c_marketing: false });
    };
    window.omniConsentDecline = function() {
        saveConsent('declined', { c_analytics: false, c_marketing: false });
    };
    window.omniConsentSavePrefs = function() {
        saveConsent('custom', cookieState);
    };

    window.omniConsentShowDetail = function() {
        detail.style.display = 'flex';
        backdrop.style.display = 'block';
        document.body.style.overflow = 'hidden';
    };
    window.omniConsentHideDetail = function() {
        detail.style.display = 'none';
        backdrop.style.display = 'none';
        document.body.style.overflow = '';
    };
    backdrop.addEventListener('click', omniConsentHideDetail);

    window.omniToggleCookie = function(id) {
        cookieState[id] = !cookieState[id];
        var toggle = document.getElementById('toggle_' + id);
        var knob   = document.getElementById('knob_' + id);
        if (toggle) toggle.style.background = cookieState[id] ? '#D4AF37' : 'rgba(255,255,255,0.15)';
        if (knob)   knob.style.transform    = cookieState[id] ? 'translateX(20px)' : 'translateX(0)';
    };

    // Tutup sementara (tanpa simpan consent — banner muncul lagi next visit)
    window.omniConsentTempHide = function() {
        try {
            sessionStorage.setItem(CONSENT_KEY + '_dismissed', '1');
        } catch(e) {}
        hideBanner();
    };

    // Buka kembali dari footer
    window.omniConsentShowBanner = function() {
        banner.style.opacity = '1';
        showBanner();
    };

    // Tampilkan banner hanya jika belum pernah consent dan belum di-dismiss di sesi ini
    var existing = null;
    var dismissed = null;
    try {
        existing = localStorage.getItem(CONSENT_KEY);
        dismissed = sessionStorage.getItem(CONSENT_KEY + '_dismissed');
    } catch(e) {}
    
    if (!existing && !dismissed) {
        setTimeout(showBanner, 1200); // Setelah loading screen
    }
})();
</script>
<!-- ===== END CONSENT BANNER ===== -->

<?php wp_footer(); ?>
</body>
</html>
