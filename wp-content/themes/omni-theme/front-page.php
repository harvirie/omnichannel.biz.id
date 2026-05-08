<?php 
get_header(); 
$front_id = get_option('page_on_front');
$hero_title = get_post_meta($front_id, 'omni_hero_title', true) ?: 'Satu Layar untuk<br/>Semua Saluran.';
$hero_sub = get_post_meta($front_id, 'omni_hero_sub', true) ?: 'Tingkatkan kepuasan pelanggan dan produktivitas tim yang menghubungkan suara, chat, email, dan sosmed dalam satu tempat.';
$hero_badge1 = get_post_meta($front_id, 'omni_hero_badge1', true) ?: 'Tanpa Kartu Kredit';
$hero_badge2 = get_post_meta($front_id, 'omni_hero_badge2', true) ?: 'Setup 5 Menit';
$integration_title = get_post_meta($front_id, 'omni_integration_title', true) ?: 'Integrasi<br/><em class="text-omni-accent italic">Tanpa Batas</em>';
$cta_title = get_post_meta($front_id, 'omni_cta_title', true) ?: 'Siap Mengubah Cara Anda Melayani?';
$cta_sub = get_post_meta($front_id, 'omni_cta_sub', true) ?: 'Bergabunglah dengan ratusan perusahaan lain yang telah mendigitalisasi pusat layanan pelanggan mereka dengan OmniServe.';
$trusted_title = get_post_meta($front_id, 'omni_trusted_title', true) ?: 'Dipercaya Oleh Berbagai Instansi';
$trusted_sub = get_post_meta($front_id, 'omni_trusted_sub', true) ?: 'Bergabunglah dengan perusahaan terkemuka yang telah bertransformasi bersama kami.';
?>

<!-- Hero Section -->
<section class="p-4 md:p-6 bg-omni-secondary flex flex-col justify-center relative flex-1 min-h-[calc(100vh-6rem)] overflow-x-hidden">
  <div class="relative w-full max-w-[1400px] mx-auto flex flex-col items-center justify-center pt-8 lg:pt-0">
    
    <!-- Responsive Hero (Desktop & Mobile) -->
    <div class="w-full relative pb-10 md:pb-0">
      <!-- Top Card -->
      <div class="relative z-10 w-[300vw] -left-[55vw] md:w-full md:left-0 transition-all" style="aspect-ratio: 2000.62 / 1163.2;">
        <svg viewBox="0 0 2000.62 1163.2" class="absolute inset-0 w-full h-full drop-shadow-xl" preserveAspectRatio="xMidYMid meet">
          <defs>
            <filter id="glow-filter" x="-20%" y="-20%" width="140%" height="140%" color-interpolation-filters="sRGB">
              <feGaussianBlur in="SourceGraphic" stdDeviation="6" result="blur"/>
              <feComposite in="blur" in2="SourceGraphic" operator="over"/>
            </filter>
          </defs>
          <path fill="#EBF4E3" d="M 64 0 A 64 64 0 0 0 0 64 L 0 950.62 A 64 64 0 0 0 64 1014.62 L 678 1014.62 A 74.29 74.29 0 0 1 752.29 1088.91 A 74.29 74.29 0 0 0 826.58 1163.2 L 1936.62 1163.2 A 64 64 0 0 0 2000.62 1099.2 L 2000.62 212.88 A 64 64 0 0 0 1936.62 148.88 L 826.58 148.88 A 74.44 74.44 0 0 1 752.14 74.44 A 74.44 74.44 0 0 0 677.7 0 Z"/>
          <path class="svg-glow-path-wide" pathLength="100" d="M 64 0 A 64 64 0 0 0 0 64 L 0 950.62 A 64 64 0 0 0 64 1014.62 L 678 1014.62 A 74.29 74.29 0 0 1 752.29 1088.91 A 74.29 74.29 0 0 0 826.58 1163.2 L 1936.62 1163.2 A 64 64 0 0 0 2000.62 1099.2 L 2000.62 212.88 A 64 64 0 0 0 1936.62 148.88 L 826.58 148.88 A 74.44 74.44 0 0 1 752.14 74.44 A 74.44 74.44 0 0 0 677.7 0 Z"/>
          <path class="svg-glow-path" pathLength="100" d="M 64 0 A 64 64 0 0 0 0 64 L 0 950.62 A 64 64 0 0 0 64 1014.62 L 678 1014.62 A 74.29 74.29 0 0 1 752.29 1088.91 A 74.29 74.29 0 0 0 826.58 1163.2 L 1936.62 1163.2 A 64 64 0 0 0 2000.62 1099.2 L 2000.62 212.88 A 64 64 0 0 0 1936.62 148.88 L 826.58 148.88 A 74.44 74.44 0 0 1 752.14 74.44 A 74.44 74.44 0 0 0 677.7 0 Z"/>
        </svg>

        <!-- Inner Image Container (Desktop) -->
        <div class="hidden md:block absolute z-10 rounded-[2.5vw] overflow-hidden shadow-2xl" style="top: 17.55%; right: 4.5%; bottom: 11.45%; width: 43%;">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/images/hero-agent.webp" class="absolute inset-0 w-full h-full object-cover" alt="Call center agent" fetchpriority="high" decoding="async" />
          <div class="absolute inset-0 bg-gradient-to-t from-omni-dark/90 via-omni-dark/20 to-transparent"></div>
          
          <!-- Recommended Card -->
          <div class="absolute bottom-[6%] left-[6%] right-[6%] pointer-events-none">
            <h3 class="text-[1.6vw] xl:text-2xl mb-[1vw] xl:mb-3 text-white drop-shadow-md">Recommended</h3>
            <div class="swiper swiper-recommended w-full pointer-events-auto overflow-hidden rounded-2xl">
              <div class="swiper-wrapper">
                <?php 
                $defaults = [
                    1 => ['title' => 'Panggilan Masuk', 'rating' => '(2.3k+)', 'desc' => 'Budi Santoso - Keluhan Produk', 'sub' => 'Menunggu antrean (0:45)'],
                    2 => ['title' => 'Pesan Masuk', 'rating' => '(1.5k+)', 'desc' => 'Siti Aminah - Info Layanan', 'sub' => 'Dialihkan ke Tim B (0:12)'],
                    3 => ['title' => 'Email Baru', 'rating' => '(900+)', 'desc' => 'Agus Pratama - Kerjasama', 'sub' => 'Belum dibaca (5m yang lalu)'],
                ];
                for ($i = 1; $i <= 3; $i++): 
                    $title = get_theme_mod("omni_rec_{$i}_title", $defaults[$i]['title']);
                    if (!$title) continue;
                ?>
                <div class="swiper-slide">
                  <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-[1vw] xl:p-5 text-white shadow-xl cursor-grab active:cursor-grabbing">
                    <div class="flex items-center gap-2 mb-1">
                      <h4 class="font-medium text-[1.1vw] xl:text-lg text-white"><?php echo esc_html($title); ?></h4>
                      <div class="bg-omni-accent p-1 rounded-full">
                        <i data-lucide="star" class="h-3 w-3 text-white fill-white"></i>
                      </div>
                      <span class="text-[0.8vw] xl:text-sm font-semibold ml-1"><?php echo esc_html(get_theme_mod("omni_rec_{$i}_rating", $defaults[$i]['rating'])); ?></span>
                    </div>
                    <p class="text-[0.85vw] xl:text-sm text-white/90">
                      <?php echo esc_html(get_theme_mod("omni_rec_{$i}_desc", $defaults[$i]['desc'])); ?><br/>
                      <span class="text-[0.75vw] xl:text-xs opacity-80"><?php echo esc_html(get_theme_mod("omni_rec_{$i}_sub", $defaults[$i]['sub'])); ?></span>
                    </p>
                  </div>
                </div>
                <?php endfor; ?>
              </div>
            </div>
          </div>
        </div>

        <!-- Left Content (Desktop) -->
        <div class="hidden md:flex absolute top-[7%] left-[5%] w-[38%] z-20 flex-col">
          <div class="flex items-center gap-[0.55vw] xl:gap-2 mb-[2.2vw] xl:mb-8">
            <div class="bg-omni-button-hover p-[0.55vw] xl:p-2 rounded-[0.8vw] xl:rounded-xl shadow-sm">
              <i data-lucide="headphones" class="h-[1.66vw] w-[1.66vw] xl:h-6 xl:w-6 text-white"></i>
            </div>
            <span class="font-bold text-[1.4vw] xl:text-2xl tracking-tight text-omni-dark"><?php bloginfo( 'name' ); ?></span>
          </div>

          <h1 class="text-[3.2vw] xl:text-[58px] text-omni-dark mb-[1.38vw] xl:mb-5 leading-[1.05]">
            <?php echo $hero_title; ?>
          </h1>
          <div class="text-omni-text-muted text-[1vw] xl:text-base max-w-[92%] mb-[2.2vw] xl:mb-8 font-medium leading-relaxed omni-rich-text">
            <?php echo wpautop($hero_sub); ?>
          </div>

          <!-- Search Bar -->
          <form method="get" action="<?php echo esc_url(home_url('/')); ?>" class="flex items-center bg-white p-[0.4vw] xl:p-1.5 rounded-full w-full shadow-sm mb-[2.2vw] xl:mb-8 border border-omni-border">
            <a href="<?php echo home_url('/harga'); ?>" class="bg-omni-button hover:bg-omni-button-hover transition-colors text-white px-[1.2vw] py-[0.6vw] rounded-full text-[0.85vw] xl:text-sm font-semibold whitespace-nowrap">Coba Gratis</a>
            <button type="button" onclick="document.getElementById('demo-modal').classList.remove('hidden')" class="px-[1vw] py-[0.6vw] text-[0.85vw] xl:text-sm font-semibold text-omni-text-muted hover:bg-slate-50 rounded-full transition-colors shrink-0">Demo</button>
            <input type="text" name="s" placeholder="Pencarian" class="flex-1 px-3 text-[0.8vw] xl:text-sm text-slate-600 font-medium bg-transparent outline-none min-w-0" />
            <button type="submit" class="bg-omni-accent hover:bg-omni-accent-hover transition-colors p-[0.6vw] xl:p-2.5 rounded-full text-white shadow-md flex-shrink-0">
              <i data-lucide="search" class="h-[1.1vw] w-[1.1vw] xl:h-5 xl:w-5"></i>
            </button>
          </form>

          <!-- Trusted -->
          <div class="flex items-center gap-[0.8vw] xl:gap-3">
            <div class="bg-omni-dark p-[0.55vw] xl:p-2 rounded-full">
              <i data-lucide="star" class="h-[1.1vw] w-[1.1vw] xl:h-5 xl:w-5 text-omni-accent fill-omni-accent"></i>
            </div>
            <div>
              <div class="italic text-[1vw] xl:text-base text-omni-dark font-medium"><?php echo esc_html($hero_badge1); ?></div>
              <div class="text-[0.8vw] xl:text-sm font-semibold text-omni-text-muted"><?php echo esc_html($hero_badge2); ?></div>
            </div>
          </div>
        </div>

        <!-- Mobile Content -->
        <div class="flex md:hidden absolute top-0 z-20 flex-col px-6 pt-8 pb-6" style="width: 100vw; left: 55vw; height: 100%;">

          <div class="translate-y-[70px] -translate-x-[10px] mb-[70px]">
            <h1 class="text-4xl text-omni-dark font-bold leading-[1.05] mb-3 drop-shadow-sm mt-[5px]">
              <?php echo $hero_title; ?>
            </h1>
            <div class="text-omni-text-muted text-[15px] font-medium leading-relaxed mb-5 w-[90%] omni-rich-text">
              <?php echo wpautop($hero_sub); ?>
            </div>
          </div>

          <!-- Search Bar -->
          <form method="get" action="<?php echo esc_url(home_url('/')); ?>" class="flex items-center bg-white p-1.5 rounded-full shadow-sm mb-5 border border-omni-border w-full max-w-[340px]">
            <a href="<?php echo home_url('/harga'); ?>" class="bg-omni-button hover:bg-omni-button-hover text-white px-4 py-2 rounded-full text-xs font-semibold whitespace-nowrap">Coba Gratis</a>
            <button type="button" onclick="document.getElementById('demo-modal').classList.remove('hidden')" class="px-2 py-2 text-xs font-semibold text-omni-text-muted hover:bg-slate-50 rounded-full transition-colors shrink-0">Demo</button>
            <input type="text" name="s" placeholder="Pencarian" class="flex-1 px-2 text-xs text-slate-600 font-medium bg-transparent outline-none min-w-0" />
            <button type="submit" class="bg-omni-accent p-2 rounded-full text-white shadow-md shrink-0">
              <i data-lucide="search" class="h-4 w-4"></i>
            </button>
          </form>

          <!-- Mobile Image Container -->
          <div class="relative mt-4 mb-4 w-full max-w-[340px] mx-auto shrink-0 h-[200px] rounded-3xl overflow-hidden shadow-xl border border-white/20 -translate-x-[10px]">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/hero-agent.webp" class="absolute inset-0 w-full h-full object-cover" alt="Call center agent" loading="lazy" decoding="async" />
            <div class="absolute inset-0 bg-gradient-to-t from-omni-dark/90 via-omni-dark/20 to-transparent"></div>
            
            <div class="absolute bottom-3 left-3 right-3">
              <div class="swiper swiper-recommended w-full overflow-hidden rounded-xl">
                <div class="swiper-wrapper">
                  <?php 
                  $defaults = [
                      1 => ['title' => 'Panggilan Masuk', 'rating' => '(2.3k+)', 'desc' => 'Budi Santoso - Keluhan Produk', 'sub' => 'Menunggu antrean (0:45)'],
                      2 => ['title' => 'Pesan Masuk', 'rating' => '(1.5k+)', 'desc' => 'Siti Aminah - Info Layanan', 'sub' => 'Dialihkan ke Tim B (0:12)'],
                      3 => ['title' => 'Email Baru', 'rating' => '(900+)', 'desc' => 'Agus Pratama - Kerjasama', 'sub' => 'Belum dibaca (5m yang lalu)'],
                  ];
                  for ($i = 1; $i <= 3; $i++): 
                      $title = get_theme_mod("omni_rec_{$i}_title", $defaults[$i]['title']);
                      if (!$title) continue;
                  ?>
                  <div class="swiper-slide">
                    <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-xl p-3 text-white shadow-lg cursor-grab active:cursor-grabbing">
                      <div class="flex items-center gap-2 mb-1">
                        <h4 class="font-medium text-sm text-white"><?php echo esc_html($title); ?></h4>
                        <div class="bg-omni-accent p-1 rounded-full">
                          <i data-lucide="star" class="h-3 w-3 text-white fill-white"></i>
                        </div>
                        <span class="text-[0.8vw] xl:text-sm font-semibold ml-1"><?php echo esc_html(get_theme_mod("omni_rec_{$i}_rating", $defaults[$i]['rating'])); ?></span>
                      </div>
                      <p class="text-xs text-white/90"><?php echo esc_html(get_theme_mod("omni_rec_{$i}_desc", $defaults[$i]['desc'])); ?></p>
                    </div>
                  </div>
                  <?php endfor; ?>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

      <!-- Bottom Card -->
      <div class="relative z-20 w-[300vw] -left-[55vw] md:w-full md:left-0 transition-all max-md:!-mt-[9.6vw]" style="aspect-ratio: 2000.62 / 448.88; margin-top: -2.99%;">
        <svg viewBox="0 0 2000.62 448.88" class="absolute inset-0 w-full h-full text-omni-dark"
          preserveAspectRatio="xMidYMid meet"
          style="filter: drop-shadow(-8px 8px 0px #FDB854);">
          <defs>
            <filter id="glow-filter-b" x="-20%" y="-20%" width="140%" height="140%" color-interpolation-filters="sRGB">
              <feGaussianBlur in="SourceGraphic" stdDeviation="6" result="blur"/>
              <feComposite in="blur" in2="SourceGraphic" operator="over"/>
            </filter>
          </defs>
          <path fill="currentColor" d="M 64 0 L 674.58 0 A 76 76 0 0 1 750.58 76 A 76 76 0 0 0 826.58 152 L 1936.62 152 A 64 64 0 0 1 2000.62 216 L 2000.62 384.88 A 64 64 0 0 1 1936.62 448.88 L 64 448.88 A 64 64 0 0 1 0 384.88 L 0 64 A 64 64 0 0 1 64 0 Z"/>
          <path class="svg-glow-path-wide" pathLength="100" style="filter: url(#glow-filter-b);" d="M 64 0 L 674.58 0 A 76 76 0 0 1 750.58 76 A 76 76 0 0 0 826.58 152 L 1936.62 152 A 64 64 0 0 1 2000.62 216 L 2000.62 384.88 A 64 64 0 0 1 1936.62 448.88 L 64 448.88 A 64 64 0 0 1 0 384.88 L 0 64 A 64 64 0 0 1 64 0 Z"/>
          <path class="svg-glow-path" pathLength="100" style="filter: url(#glow-filter-b);" d="M 64 0 L 674.58 0 A 76 76 0 0 1 750.58 76 A 76 76 0 0 0 826.58 152 L 1936.62 152 A 64 64 0 0 1 2000.62 216 L 2000.62 384.88 A 64 64 0 0 1 1936.62 448.88 L 64 448.88 A 64 64 0 0 1 0 384.88 L 0 64 A 64 64 0 0 1 64 0 Z"/>
        </svg>

        <!-- Desktop Bottom Card Content -->
        <div class="hidden md:flex absolute inset-0 z-10 items-center justify-between px-[6%]">
          <div class="text-white">
            <h2 class="text-[2.5vw] xl:text-5xl mb-[1.38vw] xl:mb-5 text-omni-light leading-tight">
              <?php echo $integration_title; ?>
            </h2>
            <a href="<?php echo home_url('/fitur'); ?>" class="flex items-center w-fit shadow-lg rounded-full bg-omni-accent hover:bg-omni-accent-hover transition-all p-[0.27vw] xl:p-1 pr-[0.41vw] xl:pr-1.5 cursor-pointer hover:scale-105">
              <span class="text-white px-[1.38vw] xl:px-5 py-[0.41vw] xl:py-1.5 font-semibold text-[0.85vw] xl:text-sm">Pelajari</span>
              <div class="bg-omni-accent-hover text-white p-[0.41vw] xl:p-1.5 rounded-full">
                <i data-lucide="arrow-right" class="h-[1vw] w-[1vw] xl:h-4 xl:w-4"></i>
              </div>
            </a>
          </div>

          <div class="flex gap-[1.2vw] xl:gap-4" style="margin-top: 3.47%;">
            <div class="border border-omni-dark-border rounded-[1.11vw] xl:rounded-2xl p-[1.2vw] xl:p-5 w-[8vw] xl:w-[120px] flex flex-col items-center text-center hover:bg-omni-dark-hover transition-all cursor-pointer group hover:-translate-y-1 bg-omni-dark/80">
              <i data-lucide="phone" class="h-[1.8vw] w-[1.8vw] xl:h-7 xl:w-7 text-omni-accent mb-[0.55vw] xl:mb-2 group-hover:scale-110 transition-transform"></i>
              <span class="text-[0.75vw] xl:text-xs text-slate-200 font-medium">Telepon</span>
            </div>
            <div class="border border-omni-dark-border rounded-[1.11vw] xl:rounded-2xl p-[1.2vw] xl:p-5 w-[8vw] xl:w-[120px] flex flex-col items-center text-center hover:bg-omni-dark-hover transition-all cursor-pointer group hover:-translate-y-1 bg-omni-dark/80">
              <i data-lucide="message-circle" class="h-[1.8vw] w-[1.8vw] xl:h-7 xl:w-7 text-omni-accent mb-[0.55vw] xl:mb-2 group-hover:scale-110 transition-transform"></i>
              <span class="text-[0.75vw] xl:text-xs text-slate-200 font-medium">WhatsApp</span>
            </div>
            <div class="border border-omni-dark-border rounded-[1.11vw] xl:rounded-2xl p-[1.2vw] xl:p-5 w-[8vw] xl:w-[120px] flex flex-col items-center text-center hover:bg-omni-dark-hover transition-all cursor-pointer group hover:-translate-y-1 bg-omni-dark/80">
              <i class="fa-brands fa-instagram text-omni-accent text-[1.8vw] xl:text-2xl mb-[0.55vw] xl:mb-2 group-hover:scale-110 transition-transform"></i>
              <span class="text-[0.75vw] xl:text-xs text-slate-200 font-medium">Instagram</span>
            </div>
            <div class="border border-omni-dark-border rounded-[1.11vw] xl:rounded-2xl p-[1.2vw] xl:p-5 w-[8vw] xl:w-[120px] flex flex-col items-center text-center hover:bg-omni-dark-hover transition-all cursor-pointer group hover:-translate-y-1 bg-omni-dark/80">
              <i data-lucide="mail" class="h-[1.8vw] w-[1.8vw] xl:h-7 xl:w-7 text-omni-accent mb-[0.55vw] xl:mb-2 group-hover:scale-110 transition-transform"></i>
              <span class="text-[0.75vw] xl:text-xs text-slate-200 font-medium">Email</span>
            </div>
          </div>
        </div>

        <!-- Mobile Bottom Card Content -->
        <div class="flex md:hidden absolute top-[15%] z-10 flex-col justify-center px-6 -translate-y-[10px] -translate-x-[20px]" style="width: 100vw; left: 55vw; height: 85%;">
          <div class="text-white mb-5">
            <h2 class="text-3xl mb-3 text-omni-light leading-tight">
              <?php echo $integration_title; ?>
            </h2>
            <a href="<?php echo home_url('/fitur'); ?>" class="flex items-center w-fit shadow-lg rounded-full bg-omni-accent transition-all p-1 pr-1.5">
              <span class="text-white px-4 py-1 font-semibold text-xs">Pelajari Lebih Lanjut</span>
              <div class="bg-omni-accent-hover text-white p-1 rounded-full">
                <i data-lucide="arrow-right" class="h-3 w-3"></i>
              </div>
            </a>
          </div>

          <div class="swiper integration-swiper w-[100vw] -mx-2 px-2 pt-2 pb-4" style="overflow: visible;">
            <div class="swiper-wrapper">
              <!-- Slide Set 1 -->
              <div class="swiper-slide">
                <div class="border border-omni-light/30 rounded-xl p-3 flex flex-col items-center justify-center text-center bg-omni-secondary shadow-sm h-[80px]">
                  <i data-lucide="phone" class="h-6 w-6 text-omni-accent mb-2 drop-shadow-sm"></i>
                  <span class="text-xs text-white font-medium">Telepon</span>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="border border-omni-light/30 rounded-xl p-3 flex flex-col items-center justify-center text-center bg-omni-secondary shadow-sm h-[80px]">
                  <i data-lucide="message-circle" class="h-6 w-6 text-omni-accent mb-2 drop-shadow-sm"></i>
                  <span class="text-xs text-white font-medium">WhatsApp</span>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="border border-omni-light/30 rounded-xl p-3 flex flex-col items-center justify-center text-center bg-omni-secondary shadow-sm h-[80px]">
                  <i class="fa-brands fa-instagram text-omni-accent text-2xl mb-2 drop-shadow-sm"></i>
                  <span class="text-xs text-white font-medium">Instagram</span>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="border border-omni-light/30 rounded-xl p-3 flex flex-col items-center justify-center text-center bg-omni-secondary shadow-sm h-[80px]">
                  <i data-lucide="mail" class="h-6 w-6 text-omni-accent mb-2 drop-shadow-sm"></i>
                  <span class="text-xs text-white font-medium">Email</span>
                </div>
              </div>
              
              <!-- Slide Set 2 (Duplicate for loop warning) -->
              <div class="swiper-slide">
                <div class="border border-omni-light/30 rounded-xl p-3 flex flex-col items-center justify-center text-center bg-omni-secondary shadow-sm h-[80px]">
                  <i data-lucide="phone" class="h-6 w-6 text-omni-accent mb-2 drop-shadow-sm"></i>
                  <span class="text-xs text-white font-medium">Telepon</span>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="border border-omni-light/30 rounded-xl p-3 flex flex-col items-center justify-center text-center bg-omni-secondary shadow-sm h-[80px]">
                  <i data-lucide="message-circle" class="h-6 w-6 text-omni-accent mb-2 drop-shadow-sm"></i>
                  <span class="text-xs text-white font-medium">WhatsApp</span>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="border border-omni-light/30 rounded-xl p-3 flex flex-col items-center justify-center text-center bg-omni-secondary shadow-sm h-[80px]">
                  <i class="fa-brands fa-instagram text-omni-accent text-2xl mb-2 drop-shadow-sm"></i>
                  <span class="text-xs text-white font-medium">Instagram</span>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="border border-omni-light/30 rounded-xl p-3 flex flex-col items-center justify-center text-center bg-omni-secondary shadow-sm h-[80px]">
                  <i data-lucide="mail" class="h-6 w-6 text-omni-accent mb-2 drop-shadow-sm"></i>
                  <span class="text-xs text-white font-medium">Email</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- CTA Section Harmonized with OmniServe Colors -->
<section class="py-20 bg-omni-dark relative overflow-hidden">
  <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-omni-button-hover/40 rounded-full blur-[100px] -translate-y-1/2 translate-x-1/2"></div>
  <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-omni-accent/10 rounded-full blur-[80px] translate-y-1/2 -translate-x-1/2"></div>

  <div class="max-w-4xl mx-auto px-4 text-center relative z-10">
    <h2 class="text-3xl md:text-5xl font-bold text-white mb-6"><?php echo esc_html($cta_title); ?></h2>
    <div class="text-omni-light text-xl mb-10 max-w-2xl mx-auto opacity-90 omni-rich-text">
      <?php echo wpautop($cta_sub); ?>
    </div>
    <div class="flex flex-col sm:flex-row justify-center gap-4">
      <a href="<?php echo home_url('/harga'); ?>" class="bg-omni-accent text-white hover:bg-omni-accent-hover px-8 py-4 rounded-full font-bold text-lg transition-all shadow-lg hover:shadow-xl hover:-translate-y-1">
        Mulai Uji Coba Gratis
      </a>
      <a href="https://wa.me/6281283835553" target="_blank" rel="noopener noreferrer" class="bg-transparent text-white hover:bg-white/10 border border-white/30 px-8 py-4 rounded-full font-bold text-lg transition-all flex items-center justify-center">
        Hubungi Sales Kami
      </a>
    </div>
  </div>
</section>

<!-- Customers Section -->
<section class="py-24 bg-omni-light relative">
  <div class="max-w-7xl mx-auto px-6 md:px-12 relative z-10">
    <div class="text-center mb-16">
      <h2 class="text-3xl md:text-5xl font-bold text-omni-dark mb-4"><?php echo esc_html($trusted_title); ?></h2>
      <div class="text-omni-text-muted text-lg max-w-2xl mx-auto omni-rich-text">
        <?php echo wpautop($trusted_sub); ?>
      </div>
    </div>

    <!-- Swiper Container Wrapper -->
    <div class="relative w-full px-6 md:px-14">
      <!-- Swiper Carousel -->
      <div class="swiper customers-swiper !pb-16">
        <div class="swiper-wrapper">
          <?php 
          // Print slides twice to ensure enough elements for Swiper loop mode on large screens
          for ($duplicate = 1; $duplicate <= 2; $duplicate++) :
            for ( $i = 1; $i <= 4; $i++ ) : 
              $cust_name = get_theme_mod('omni_customer_'.$i.'_name', 'Pelanggan '.$i);
              $cust_desc = get_theme_mod('omni_customer_'.$i.'_desc', 'Deskripsi pelanggan '.$i);
              $default_imgs = array(
                  1 => get_template_directory_uri() . '/assets/images/customer-1-pemerintah.webp',
                  2 => get_template_directory_uri() . '/assets/images/customer-2-imigrasi.webp',
                  3 => get_template_directory_uri() . '/assets/images/customer-3-konstruksi.webp',
                  4 => get_template_directory_uri() . '/assets/images/customer-4-medis.webp'
              );
              $cust_img = get_theme_mod('omni_customer_'.$i.'_img', $default_imgs[$i]);
            ?>
            <div class="swiper-slide h-auto">
              <div class="bg-white rounded-3xl overflow-hidden shadow-lg border border-omni-border flex flex-col group transition-all duration-300 h-full">
                <div class="relative h-48 overflow-hidden shrink-0">
                  <img src="<?php echo esc_url($cust_img); ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="<?php echo esc_attr($cust_name); ?>" loading="lazy" decoding="async" />
                  <div class="absolute inset-0 bg-gradient-to-t from-omni-dark/90 via-omni-dark/40 to-transparent opacity-80 group-hover:opacity-100 transition-opacity duration-300"></div>
                  <div class="absolute bottom-4 left-6 right-6 transform translate-y-2 group-hover:translate-y-0 transition-transform duration-300">
                    <h3 class="text-white font-bold text-2xl leading-tight drop-shadow-md mb-1"><?php echo esc_html($cust_name); ?></h3>
                    <div class="w-12 h-1 bg-omni-accent rounded-full transform origin-left scale-x-0 group-hover:scale-x-100 transition-transform duration-300 delay-100"></div>
                  </div>
                </div>
                <div class="p-6 flex-1 flex flex-col">
                  <p class="text-omni-text-muted text-[15px] leading-relaxed flex-1">
                    <?php echo esc_html($cust_desc); ?>
                  </p>
                </div>
              </div>
            </div>
            <?php 
            endfor;
          endfor; 
          ?>
        </div>
        
        <!-- Custom Swiper Navigation -->
        <div class="swiper-pagination !bottom-0 pb-2"></div>
      </div>
      
      <!-- Outer Navigation Buttons -->
      <!-- Menggunakan padding 10px+ (translate) agar menjauh dari card -->
      <div class="swiper-button-prev !text-omni-dark !w-12 !h-12 !bg-white/80 hover:!bg-white backdrop-blur-sm rounded-full shadow-lg border border-omni-border transition-all !absolute !left-0 top-[40%] -translate-y-1/2 z-20 after:!hidden !hidden md:!flex items-center justify-center -ml-2 md:-ml-[10px]">
        <i class="fa-solid fa-chevron-left text-xl"></i>
      </div>
      <div class="swiper-button-next !text-omni-dark !w-12 !h-12 !bg-white/80 hover:!bg-white backdrop-blur-sm rounded-full shadow-lg border border-omni-border transition-all !absolute !right-0 top-[40%] -translate-y-1/2 z-20 after:!hidden !hidden md:!flex items-center justify-center -mr-2 md:-mr-[10px]">
        <i class="fa-solid fa-chevron-right text-xl"></i>
      </div>
    </div>
  </div>
</section>

<!-- Demo Modal -->
<div id="demo-modal" class="fixed inset-0 z-[100] hidden">
  <div class="absolute inset-0 bg-black/50 backdrop-blur-sm transition-opacity" onclick="document.getElementById('demo-modal').classList.add('hidden')"></div>
  <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-md bg-white rounded-3xl p-8 shadow-2xl z-10 transition-transform">
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
        <label class="block text-sm font-medium text-omni-text-muted mb-1">Email Perusahaan</label>
        <input type="email" name="demo_email" required class="w-full px-4 py-2 border border-omni-border rounded-xl focus:outline-none focus:border-omni-accent focus:ring-1 focus:ring-omni-accent">
      </div>
      <div>
        <label class="block text-sm font-medium text-omni-text-muted mb-1">Nomor WhatsApp</label>
        <input type="tel" name="demo_phone" required class="w-full px-4 py-2 border border-omni-border rounded-xl focus:outline-none focus:border-omni-accent focus:ring-1 focus:ring-omni-accent">
      </div>
      <button type="submit" id="demo-submit-btn" class="w-full bg-omni-accent hover:bg-omni-accent-hover text-white font-bold py-3 rounded-xl transition-colors mt-2">Kirim Permohonan</button>
      <div id="demo-msg" class="hidden text-center text-sm font-medium mt-2"></div>
    </form>
  </div>
</div>

<script>
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
      msg.className = 'text-green-600 text-center text-sm font-medium mt-2';
      msg.innerText = data.data;
      form.reset();
      setTimeout(() => document.getElementById('demo-modal').classList.add('hidden'), 2000);
    } else {
      msg.className = 'text-red-500 text-center text-sm font-medium mt-2';
      msg.innerText = data.data || 'Terjadi kesalahan';
    }
  } catch (err) {
    msg.classList.remove('hidden');
    msg.className = 'text-red-500 text-center text-sm font-medium mt-2';
    msg.innerText = 'Gagal menghubungi server';
  }
  
  btn.disabled = false;
  btn.innerText = 'Kirim Permohonan';
}
</script>
<?php get_footer(); ?>
