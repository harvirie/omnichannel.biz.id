<!-- Shared Footer -->
<footer class="bg-omni-dark text-white/70 py-12 border-t border-white/10 mt-auto">
  <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-8">
    <div class="col-span-1 md:col-span-2">
      <div class="flex items-center mb-4">
        <!-- Logo full untuk latar gelap (footer) -->
        <a href="<?php echo home_url('/'); ?>">
          <img src="https://res.cloudinary.com/dtxwwevxl/image/upload/v1778221347/logo_long_wh_ysccoa.svg"
               alt="<?php bloginfo('name'); ?>"
               class="h-16 w-auto object-contain"
               loading="lazy">
        </a>
      </div>
      <p class="max-w-xs text-sm leading-relaxed mb-6">
        Satu layar untuk semua saluran. Tingkatkan kepuasan pelanggan dengan sistem omnichannel terbaik.
      </p>
    </div>
    <div>
      <h4 class="text-white font-semibold mb-4">Produk</h4>
      <ul class="space-y-2 text-sm">
        <li><a href="<?php echo home_url('/fitur'); ?>" class="hover:text-omni-accent transition-colors">Fitur Utama</a></li>
        <li><a href="<?php echo home_url('/analitik'); ?>" class="hover:text-omni-accent transition-colors">Analitik Data</a></li>
        <li><a href="<?php echo home_url('/use-case'); ?>" class="hover:text-omni-accent transition-colors">Use Case</a></li>
        <li><a href="<?php echo home_url('/harga'); ?>" class="hover:text-omni-accent transition-colors">Harga</a></li>
      </ul>
    </div>
    <div>
      <h4 class="text-white font-semibold mb-4">Perusahaan</h4>
      <ul class="space-y-2 text-sm">
        <li><a href="#" class="hover:text-omni-accent transition-colors">Tentang Kami</a></li>
        <li><a href="#" class="hover:text-omni-accent transition-colors">Karir</a></li>
        <li><a href="https://wa.me/6281283835553" target="_blank" rel="noopener noreferrer" class="hover:text-omni-accent transition-colors">Hubungi Kami</a></li>
      </ul>
    </div>
  </div>
  <div class="max-w-7xl mx-auto px-6 mt-12 pt-8 border-t border-white/10 text-sm flex flex-col md:flex-row justify-between items-center text-center">
    <p>&copy; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?>. Hak Cipta Dilindungi. Theme Design by Harizal.</p>
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
            if (typeof Swiper !== 'undefined') {
              new Swiper(selector, config);
            } else {
              // Swiper belum loaded, coba lagi setelah 100ms
              setTimeout(() => new Swiper(selector, config), 100);
            }
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
<?php wp_footer(); ?>
</body>
</html>
