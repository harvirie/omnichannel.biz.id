<!-- Shared Footer -->
<footer class="bg-omni-dark text-white/70 py-12 border-t border-white/10 mt-auto">
  <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-8">
    <div class="col-span-1 md:col-span-2">
      <div class="flex items-center gap-2 mb-4">
        <?php if ( function_exists( 'has_custom_logo' ) && has_custom_logo() ) : ?>
            <?php the_custom_logo(); ?>
        <?php else : ?>
            <div class="bg-omni-button-hover p-2 rounded-lg">
              <i data-lucide="headphones" class="h-5 w-5 text-white"></i>
            </div>
            <span class="font-bold text-xl tracking-tight text-white"><?php bloginfo( 'name' ); ?></span>
        <?php endif; ?>
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
        <li><a href="#" class="hover:text-omni-accent transition-colors">Hubungi Kami</a></li>
      </ul>
    </div>
  </div>
  <div class="max-w-7xl mx-auto px-6 mt-12 pt-8 border-t border-white/10 text-sm flex flex-col md:flex-row justify-between items-center text-center">
    <p>&copy; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?>. Hak Cipta Dilindungi. Theme Design by Harizal.</p>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
  // Initialize Lucide icons
  if (typeof lucide !== 'undefined') {
    lucide.createIcons();
  }

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
    // Initialize Swiper Carousel for Customers
    if (document.querySelector('.customers-swiper')) {
      const swiper = new Swiper('.customers-swiper', {
        slidesPerView: 1,
        spaceBetween: 20,
        loop: true,
        autoplay: {
          delay: 3000,
          disableOnInteraction: false,
        },
        pagination: {
          el: '.swiper-pagination',
          clickable: true,
        },
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        },
        breakpoints: {
          640: {
            slidesPerView: 2,
            spaceBetween: 20,
          },
          1024: {
            slidesPerView: 3,
            spaceBetween: 30,
          },
          1280: {
            slidesPerView: 4,
            spaceBetween: 30,
          },
        }
      });
    }

    // Initialize Integration Swiper (Mobile only)
    if (document.querySelector('.integration-swiper')) {
      new Swiper('.integration-swiper', {
        slidesPerView: 2,
        spaceBetween: 12,
        loop: true,
        autoplay: {
          delay: 5000,
          disableOnInteraction: false,
        },
      });
    }

    // Initialize Swiper Carousel for Recommended
    if (document.querySelector('.swiper-recommended')) {
      const recSpeed = <?php echo (int)get_theme_mod('omni_rec_speed', 10) * 1000; ?>;
      new Swiper('.swiper-recommended', {
        slidesPerView: 1,
        loop: true,
        speed: 1000, // Smooth 1-second slide transition
        grabCursor: true, // Allow users to swipe manually
        autoplay: {
          delay: recSpeed,
          disableOnInteraction: false,
        },
      });
    }
  });
</script>
<?php wp_footer(); ?>
</body>
</html>
