<?php
get_header();
?>

<!-- Navbar (Mobile Only, Desktop Nav is inside Hero) -->
<nav class="lg:hidden fixed w-full bg-[#EBF4E3]/90 backdrop-blur-md z-50 border-b border-[#d2e3c9]">
  <div class="px-4">
    <div class="flex justify-between items-center h-20">
      <div class="flex items-center gap-2">
        <?php if ( function_exists( 'has_custom_logo' ) && has_custom_logo() ) : ?>
            <?php the_custom_logo(); ?>
        <?php else : ?>
            <div class="bg-[#415B45] p-2 rounded-lg">
            <i data-lucide="headphones" class="h-6 w-6 text-white"></i>
            </div>
            <span class="font-bold text-xl tracking-tight text-[#1C2C1F]"><?php bloginfo( 'name' ); ?></span>
        <?php endif; ?>
      </div>
      <div class="flex items-center">
        <button id="mobile-menu-btn" class="text-[#4F6854]">
          <i data-lucide="menu" class="h-6 w-6 menu-icon"></i>
          <i data-lucide="x" class="h-6 w-6 close-icon hidden"></i>
        </button>
      </div>
    </div>
  </div>
  <div id="mobile-menu-panel" class="hidden bg-[#EBF4E3] border-b border-[#d2e3c9] px-4 pt-2 pb-4 space-y-1 shadow-lg">
    <a href="#fitur" class="block px-3 py-2 rounded-md font-medium text-[#4F6854] hover:text-[#567558]">Fitur</a>
    <a href="#usecase" class="block px-3 py-2 rounded-md font-medium text-[#4F6854] hover:text-[#567558]">Use Case</a>
    <a href="#analitik" class="block px-3 py-2 rounded-md font-medium text-[#4F6854] hover:text-[#567558]">Analitik Data</a>
  </div>
</nav>

<!-- Custom Hero (Cmouse Layout Replica) -->
<section class="p-4 md:p-6 min-h-screen bg-[#7A9E7E] flex flex-col justify-center pt-24 lg:pt-6 relative">
  <div class="relative w-full max-w-[1400px] mx-auto min-h-[85vh] flex flex-col">
    
<!-- Floating Desktop Navbar (Figma Match) -->
<nav class="hidden lg:flex fixed top-6 left-1/2 -translate-x-1/2 z-50 w-[95%] max-w-6xl bg-[#1C2C1F] rounded-full px-8 py-3 justify-between items-center shadow-2xl border border-white/10">
  <!-- Logo -->
  <div class="flex items-center gap-2">
    <?php if ( function_exists( 'has_custom_logo' ) && has_custom_logo() ) : ?>
        <?php the_custom_logo(); ?>
    <?php else : ?>
        <div class="bg-white/10 p-1.5 rounded-lg">
        <i data-lucide="headphones" class="h-5 w-5 text-white"></i>
        </div>
        <span class="font-bold text-xl tracking-tight text-white"><?php bloginfo( 'name' ); ?></span>
    <?php endif; ?>
  </div>

  <!-- Links -->
  <div class="flex gap-8 text-white/80">
    <a href="#fitur" class="hover:text-[#FDB854] text-sm font-medium transition-colors border-b-2 border-transparent hover:border-[#FDB854] pb-1">Fitur</a>
    <a href="#usecase" class="hover:text-[#FDB854] text-sm font-medium transition-colors border-b-2 border-transparent hover:border-[#FDB854] pb-1">Use Case</a>
    <a href="#analitik" class="hover:text-[#FDB854] text-sm font-medium transition-colors border-b-2 border-transparent hover:border-[#FDB854] pb-1">Analitik Data</a>
    <a href="#harga" class="hover:text-[#FDB854] text-sm font-medium transition-colors border-b-2 border-transparent hover:border-[#FDB854] pb-1">Harga</a>
  </div>

  <!-- Sign In Pill -->
  <div>
    <div class="flex items-center shadow-lg rounded-full bg-[#FDB854] p-1 pr-1.5 transition-transform hover:scale-105 cursor-pointer">
      <span class="text-white px-5 py-1.5 font-medium text-sm">Masuk</span>
      <div class="bg-[#e89e3a] text-white p-1.5 rounded-full"><i data-lucide="arrow-right" class="h-4 w-4"></i></div>
    </div>
  </div>
</nav>

    <!-- =============================================
         DESKTOP HERO - Two independent SVG blocks
         ============================================= -->
    <div class="hidden lg:block w-full mt-10">

      <!-- == TOP CARD == -->
      <!-- Uses SVG atas aspect ratio 2000.62 : 1163.2 ≈ 1.72:1 -->
      <!-- The image is clipped INSIDE the SVG shape via clipPath -->
      <div class="relative w-full min-h-[580px]" style="aspect-ratio: 2000.62 / 1163.2;">
        <!-- SVG atas: light green shape + image clipped inside -->
        <svg viewBox="0 0 2000.62 1163.2" class="absolute inset-0 w-full h-full drop-shadow-xl" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg">
          <defs>
            <!-- Portrait card clipPath: clear padding on all 4 sides -->
            <!-- right-edge: 950+990=1940, right-pad=(2001-1940)=61 -->
            <!-- bottom: 215+740=955, shape-bottom≈1014, bottom-pad=59 -->
            <clipPath id="imageClip">
              <rect x="950" y="215" width="990" height="740" rx="44" ry="44"/>
            </clipPath>
            <linearGradient id="imgGrad" x1="0" y1="1" x2="0" y2="0">
              <stop offset="0%" stop-color="#1C2C1F" stop-opacity="0.9"/>
              <stop offset="38%" stop-color="#1C2C1F" stop-opacity="0.2"/>
              <stop offset="100%" stop-color="#1C2C1F" stop-opacity="0"/>
            </linearGradient>
          </defs>

          <!-- Background fill for whole top card -->
          <path fill="#EBF4E3" d="M58.46 0c-31.35,2.09 -57.22,35.2 -58.46,63.75l0 868.18c0.2,40.69 31.43,80.18 57.88,82.69l620.13 0c44.45,-2.37 78.16,19.12 86.82,53.74l16.59 42.01c10.6,29.54 32.66,51.92 57.94,52.83l1096.82 0c40.73,-3.51 63.88,-32.95 64.44,-63.23l0 -897.75c-0.2,-32.84 -23,-53.97 -53.33,-53.34l-1115.52 0c-25.65,-2.32 -54.42,-18.17 -64.44,-44.44l-26.67 -71.11c-12.41,-25.68 -33.15,-31.59 -62.22,-33.33l-619.98 0z"/>

          <!-- Photo as portrait card floating inside the SVG -->
          <image href="<?php echo esc_url(get_theme_mod('omni_hero_image', 'https://images.unsplash.com/photo-1766066014237-00645c74e9c6?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxtb2Rlcm4lMjBjYWxsJTIwY2VudGVyJTIwYWdlbnQlMjB0YWxraW5nJTIwb24lMjBoZWFkc2V0fGVufDF8fHx8MTc3ODE0Njc3NXww&ixlib=rb-4.1.0&q=80&w=1080')); ?>"
            x="950" y="215" width="990" height="740"
            preserveAspectRatio="xMidYMid slice"
            clip-path="url(#imageClip)"/>

          <!-- Gradient overlay on photo -->
          <rect x="950" y="215" width="990" height="740" rx="44" ry="44" fill="url(#imgGrad)"/>
        </svg>

        <!-- Left Text Content: positioned absolutely over SVG -->
        <div class="absolute top-[5%] left-[4%] w-[40%] z-20 flex flex-col">
          <div class="flex items-center gap-2 mb-8">
            <?php if ( function_exists( 'has_custom_logo' ) && has_custom_logo() ) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <div class="bg-[#415B45] p-2 rounded-xl shadow-sm">
                <i data-lucide="headphones" class="h-6 w-6 text-white"></i>
                </div>
                <span class="font-bold text-[1.4vw] xl:text-2xl tracking-tight text-[#1C2C1F] font-serif"><?php bloginfo( 'name' ); ?></span>
            <?php endif; ?>
          </div>

          <h1 class="text-[3.2vw] xl:text-[58px] font-serif text-[#1C2C1F] mb-5 leading-[1.05]">
            Satu Layar untuk<br>Semua Saluran.
          </h1>
          <p class="text-[#4F6854] text-[1vw] xl:text-base max-w-[92%] mb-8 font-medium leading-relaxed">
            Tingkatkan kepuasan pelanggan dan produktivitas tim yang menghubungkan suara, chat, email, dan sosmed dalam satu tempat.
          </p>

          <!-- Search Bar -->
          <div class="flex items-center bg-white p-1.5 rounded-full w-full shadow-sm mb-8 border border-[#d2e3c9]">
            <button class="bg-[#567558] hover:bg-[#415B45] transition-colors text-white px-[1.2vw] py-[0.6vw] rounded-full text-[0.85vw] xl:text-sm font-semibold whitespace-nowrap">Coba Gratis</button>
            <button class="px-[1vw] py-[0.6vw] text-[0.85vw] xl:text-sm font-semibold text-[#4F6854] hover:bg-slate-50 rounded-full transition-colors">Demo</button>
            <div class="flex-1 px-3 text-[0.8vw] xl:text-sm text-slate-400 font-medium overflow-hidden text-ellipsis whitespace-nowrap">Pusat Layanan...</div>
            <button class="bg-[#FDB854] hover:bg-[#e89e3a] transition-colors p-[0.6vw] xl:p-2.5 rounded-full text-white shadow-md flex-shrink-0">
              <i data-lucide="search" class="h-[1.1vw] w-[1.1vw] xl:h-5 xl:w-5"></i>
            </button>
          </div>

          <!-- Trusted -->
          <div class="flex items-center gap-3">
            <div class="bg-[#1C2C1F] p-2 rounded-full">
              <i data-lucide="star" class="h-[1.1vw] w-[1.1vw] xl:h-5 xl:w-5 text-[#34d399] fill-[#34d399]"></i>
            </div>
            <div>
              <div class="font-serif italic text-[1vw] xl:text-base text-[#1C2C1F] font-medium">Tanpa Kartu Kredit</div>
              <div class="text-[0.8vw] xl:text-sm font-semibold text-[#4F6854]">Setup 5 Menit</div>
            </div>
          </div>
        </div>

        <!-- Recommended overlay — positioned inside the photo card bounds -->
        <div class="absolute z-20 pointer-events-none" style="bottom: 9%; right: 6%; width: 37%;">
          <h3 class="font-serif text-[1.6vw] xl:text-2xl mb-3 text-white drop-shadow-md">Recommended</h3>
          <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-[1vw] xl:p-5 text-white shadow-xl">
            <div class="flex items-center gap-2 mb-1">
              <h4 class="font-medium text-[1.1vw] xl:text-lg text-white">Panggilan Masuk</h4>
              <div class="bg-[#ef4444] p-1 rounded-full"><i data-lucide="star" class="h-3 w-3 text-white fill-white"></i></div>
              <span class="text-[0.8vw] xl:text-sm font-semibold ml-1">(2.3k+)</span>
            </div>
            <p class="text-[0.85vw] xl:text-sm text-white/90">Budi Santoso - Keluhan Produk<br>
              <span class="text-[0.75vw] xl:text-xs opacity-80">Menunggu antrean (0:45)</span>
            </p>
          </div>
        </div>
      </div>

      <!-- GAP: small so green bg shows through -->
      <div class="h-1"></div>

      <!-- == BOTTOM CARD == -->
      <!-- Uses SVG bawah aspect ratio 1995.03 : 448.88 ≈ 4.44:1 -->
      <div class="relative w-full min-h-[200px]" style="aspect-ratio: 1995.03 / 448.88;">
        <!-- SVG bawah background shape with orange drop-shadow -->
        <svg viewBox="0 0 1995.03 448.88" class="absolute inset-0 w-full h-full text-[#1C2C1F]"
          preserveAspectRatio="xMidYMid meet"
          style="filter: drop-shadow(-8px 8px 0px #FDB854);"
          xmlns="http://www.w3.org/2000/svg">
          <path fill="currentColor" d="M59.35 0l631.96 0c22.48,2.75 39.94,17.53 49.38,44.36l20.7 58.21c10.75,24.5 20.49,48 47.28,49.43l1128.5 0c36.34,2.91 56.63,24.87 57.86,53.86l0 200.62c-0.56,23.16 -18.18,41.31 -52.85,42.4l-1177.42 0 -361 0 -346.41 0c-25.14,-1.43 -56.29,-25.93 -57.35,-58.45l0 -327.01c2.73,-29.17 26.53,-60.34 59.35,-63.42z"/>
        </svg>

        <!-- Bottom Content positioned absolutely -->
        <div class="absolute inset-0 z-10 flex items-center justify-between px-[6%]">
          <!-- Text Left -->
          <div class="text-white">
            <h2 class="font-serif text-[2.5vw] xl:text-5xl mb-5 text-[#EBF4E3] leading-tight">
              Integrasi<br><em class="text-[#FDB854] font-sans italic">Tanpa Batas</em>
            </h2>
            <div class="flex items-center w-fit shadow-lg rounded-full bg-[#FDB854] hover:bg-[#e89e3a] transition-all p-1 pr-1.5 cursor-pointer hover:scale-105">
              <span class="text-white px-5 py-1.5 font-semibold text-[0.85vw] xl:text-sm">Pelajari</span>
              <div class="bg-[#e89e3a] text-white p-1.5 rounded-full">
                <i data-lucide="arrow-right" class="h-[1vw] w-[1vw] xl:h-4 xl:w-4"></i>
              </div>
            </div>
          </div>

          <!-- Service Cards Right -->
          <div class="flex gap-[1.2vw] xl:gap-4">
            <div class="border border-[#2C4131] rounded-2xl p-[1.2vw] xl:p-5 w-[8vw] xl:w-[120px] flex flex-col items-center text-center hover:bg-[#2A3E2F] transition-all cursor-pointer group hover:-translate-y-1 bg-[#1C2C1F]/80">
              <i data-lucide="phone" class="h-[1.8vw] w-[1.8vw] xl:h-7 xl:w-7 text-[#FDB854] mb-2 group-hover:scale-110 transition-transform"></i>
              <span class="text-[0.75vw] xl:text-xs text-slate-200 font-medium">Telepon</span>
            </div>
            <div class="border border-[#2C4131] rounded-2xl p-[1.2vw] xl:p-5 w-[8vw] xl:w-[120px] flex flex-col items-center text-center hover:bg-[#2A3E2F] transition-all cursor-pointer group hover:-translate-y-1 bg-[#1C2C1F]/80">
              <i data-lucide="message-circle" class="h-[1.8vw] w-[1.8vw] xl:h-7 xl:w-7 text-[#FDB854] mb-2 group-hover:scale-110 transition-transform"></i>
              <span class="text-[0.75vw] xl:text-xs text-slate-200 font-medium">WhatsApp</span>
            </div>
            <div class="border border-[#2C4131] rounded-2xl p-[1.2vw] xl:p-5 w-[8vw] xl:w-[120px] flex flex-col items-center text-center hover:bg-[#2A3E2F] transition-all cursor-pointer group hover:-translate-y-1 bg-[#1C2C1F]/80">
              <i data-lucide="instagram" class="h-[1.8vw] w-[1.8vw] xl:h-7 xl:w-7 text-[#FDB854] mb-2 group-hover:scale-110 transition-transform"></i>
              <span class="text-[0.75vw] xl:text-xs text-slate-200 font-medium">Instagram</span>
            </div>
            <div class="border border-[#2C4131] rounded-2xl p-[1.2vw] xl:p-5 w-[8vw] xl:w-[120px] flex flex-col items-center text-center hover:bg-[#2A3E2F] transition-all cursor-pointer group hover:-translate-y-1 bg-[#1C2C1F]/80">
              <i data-lucide="mail" class="h-[1.8vw] w-[1.8vw] xl:h-7 xl:w-7 text-[#FDB854] mb-2 group-hover:scale-110 transition-transform"></i>
              <span class="text-[0.75vw] xl:text-xs text-slate-200 font-medium">Email</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Mobile Hero Container (Stacked Flex Layout) -->
    <div class="flex lg:hidden relative w-full flex-col pt-12 z-10 pb-12">
      <!-- Top Card -->
      <div class="bg-[#EBF4E3] rounded-[2rem] p-6 md:p-8 shadow-2xl relative z-10">
        <!-- Logo -->
        <div class="flex items-center gap-2 mb-8">
          <div class="bg-[#415B45] p-2 rounded-xl shadow-sm">
            <i data-lucide="headphones" class="h-5 w-5 text-white"></i>
          </div>
          <span class="font-bold text-xl tracking-tight text-[#1C2C1F] font-serif">OmniServe</span>
        </div>
        
        <h1 class="text-4xl md:text-5xl font-serif text-[#1C2C1F] mb-4 leading-[1.1]">
          Satu Layar untuk<br>Semua Saluran.
        </h1>
        <p class="text-[#4F6854] text-base max-w-md mb-8 font-medium leading-relaxed">
          Tingkatkan kepuasan pelanggan dan produktivitas tim yang menghubungkan suara, chat, email, dan sosmed dalam satu tempat.
        </p>

        <!-- Search Bar Pill -->
        <div class="flex items-center bg-white p-2 rounded-full shadow-sm mb-8 border border-[#d2e3c9]">
          <button class="bg-[#567558] hover:bg-[#415B45] transition-colors text-white px-4 py-2.5 rounded-full text-xs font-semibold whitespace-nowrap">Coba Gratis</button>
          <button class="px-4 py-2.5 text-xs font-semibold text-[#4F6854] hover:bg-slate-50 rounded-full transition-colors">Demo</button>
          <div class="flex-1 px-2 text-xs text-slate-400 font-medium whitespace-nowrap overflow-hidden text-ellipsis">Pusat Layanan...</div>
          <button class="bg-[#FDB854] transition-colors p-2.5 rounded-full text-white shadow-md flex-shrink-0"><i data-lucide="search" class="h-4 w-4"></i></button>
        </div>

        <!-- Trusted Pilot -->
        <div class="flex items-center gap-3 mb-8">
          <div class="bg-[#1C2C1F] p-2 rounded-full"><i data-lucide="star" class="h-4 w-4 text-[#34d399] fill-[#34d399]"></i></div>
          <div>
             <div class="font-serif italic text-base text-[#1C2C1F] font-medium">Tanpa Kartu Kredit</div>
             <div class="text-xs font-semibold text-[#4F6854]">Setup 5 Menit</div>
          </div>
        </div>

        <!-- Image -->
        <div class="relative w-full h-[300px] md:h-[400px] rounded-[1.5rem] overflow-hidden shadow-xl">
          <img src="<?php echo esc_url(get_theme_mod('omni_hero_image', 'https://images.unsplash.com/photo-1766066014237-00645c74e9c6?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxtb2Rlcm4lMjBjYWxsJTIwY2VudGVyJTIwYWdlbnQlMjB0YWxraW5nJTIwb24lMjBoZWFkc2V0fGVufDF8fHx8MTc3ODE0Njc3NXww&ixlib=rb-4.1.0&q=80&w=1080')); ?>" class="absolute inset-0 w-full h-full object-cover" />
          <div class="absolute inset-0 bg-gradient-to-t from-[#1C2C1F]/90 via-[#1C2C1F]/20 to-transparent"></div>
          
          <div class="absolute bottom-4 left-4 right-4">
            <h3 class="font-serif text-xl mb-3 text-white drop-shadow-md">Recommended</h3>
            <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-xl p-4 text-white shadow-lg">
               <div class="flex items-center gap-2 mb-1">
                 <h4 class="font-medium text-base text-white">Panggilan Masuk</h4>
                 <div class="bg-[#ef4444] p-1 rounded-full"><i data-lucide="star" class="h-3 w-3 text-white fill-white"></i></div>
                 <span class="text-xs font-semibold ml-1">(2.3k+)</span>
               </div>
               <p class="text-xs text-white/90">Budi Santoso - Keluhan Produk <br><span class="text-[10px] opacity-80">Menunggu antrean (0:45)</span></p>
            </div>
          </div>
        </div>
      </div>

      <!-- Bottom Card -->
      <div class="bg-[#1C2C1F] rounded-[2rem] p-6 md:p-8 shadow-[inset_4px_4px_0px_#FDB854] relative z-20 mt-[-40px] md:mt-[-60px] pt-14 md:pt-20">
         <div class="text-white mb-6">
            <h2 class="font-serif text-3xl md:text-4xl mb-4 text-[#EBF4E3]">Integrasi<br><em class="text-[#FDB854] font-sans italic">Tanpa Batas</em></h2>
            <div class="flex items-center w-fit shadow-lg rounded-full bg-[#FDB854] p-1 pr-1.5 transition-transform hover:scale-105 cursor-pointer">
               <span class="text-white px-4 py-1.5 font-semibold text-xs">Pelajari</span>
               <div class="bg-[#e89e3a] text-white p-1.5 rounded-full"><i data-lucide="arrow-right" class="h-3 w-3"></i></div>
            </div>
         </div>
         
         <div class="flex gap-3 overflow-x-auto w-full pb-4 scrollbar-hide">
             <div class="border border-[#2C4131] rounded-2xl p-4 min-w-[100px] flex flex-col items-center justify-center text-center bg-[#1C2C1F]/80 shadow-md">
               <i data-lucide="phone" class="h-6 w-6 text-[#FDB854] mb-3"></i>
               <span class="text-xs text-slate-200 font-medium">Telepon</span>
             </div>
             <div class="border border-[#2C4131] rounded-2xl p-4 min-w-[100px] flex flex-col items-center justify-center text-center bg-[#1C2C1F]/80 shadow-md">
               <i data-lucide="message-circle" class="h-6 w-6 text-[#FDB854] mb-3"></i>
               <span class="text-xs text-slate-200 font-medium">WhatsApp</span>
             </div>
             <div class="border border-[#2C4131] rounded-2xl p-4 min-w-[100px] flex flex-col items-center justify-center text-center bg-[#1C2C1F]/80 shadow-md">
               <i data-lucide="instagram" class="h-6 w-6 text-[#FDB854] mb-3"></i>
               <span class="text-xs text-slate-200 font-medium">Instagram</span>
             </div>
             <div class="border border-[#2C4131] rounded-2xl p-4 min-w-[100px] flex flex-col items-center justify-center text-center bg-[#1C2C1F]/80 shadow-md">
               <i data-lucide="mail" class="h-6 w-6 text-[#FDB854] mb-3"></i>
               <span class="text-xs text-slate-200 font-medium">Email</span>
             </div>
         </div>
      </div>
    </div>
  </div>
</section>

<!-- Analitik Section (Redesain dari Figma) -->
<section id="analitik" class="flex-1 bg-[#F4F9F0] w-full mt-12">
  <!-- Header Area -->
  <div class="bg-[#1C2C1F] py-20 relative overflow-hidden">
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-[#415B45]/40 rounded-full blur-[100px] -translate-y-1/2 translate-x-1/2"></div>
    <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-[#FDB854]/10 rounded-full blur-[80px] translate-y-1/2 -translate-x-1/2"></div>
    
    <div class="max-w-7xl mx-auto px-6 relative z-10 text-center">
      <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#FDB854]/20 border border-[#FDB854]/30 text-[#FDB854] mb-6">
        <i data-lucide="bar-chart-3" class="w-4 h-4"></i>
        <span class="text-sm font-semibold tracking-wide uppercase">Analitik Data</span>
      </div>
      <h1 class="text-4xl md:text-6xl font-bold text-white mb-6">
        Berhenti Sekadar Merespon.<br />
        <span class="text-[#FDB854]">Ubah Interaksi Menjadi Data.</span>
      </h1>
      <p class="text-[#EBF4E3] text-lg md:text-xl max-w-2xl mx-auto">
        Pelayanan pelanggan bukan lagi sekadar cost center. Melalui OmniServe, setiap keluhan, pertanyaan, dan saran direkam, dianalisis, dan divisualisasikan.
      </p>
    </div>
  </div>

  <!-- Main Content Area -->
  <div class="py-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid lg:grid-cols-2 gap-16 items-center">
      <div class="order-2 lg:order-1 relative">
        <div class="absolute -inset-4 bg-[#7A9E7E]/20 rounded-[2.5rem] transform -rotate-2"></div>
        <img
          src="https://images.unsplash.com/photo-1759752394755-1241472b589d?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxkYXRhJTIwYW5hbHl0aWNzJTIwZGFzaGJvYXJkJTIwc2NyZWVufGVufDF8fHx8MTc3ODE0NTkwNnww&ixlib=rb-4.1.0&q=80&w=1080"
          alt="Data Analytics"
          class="relative rounded-2xl shadow-2xl border border-white/50 object-cover h-[450px] w-full"
        />
      </div>
      
      <div class="order-1 lg:order-2 space-y-8">
        <h2 class="text-3xl font-bold leading-tight text-[#1C2C1F]">
          Wawasan Real-Time untuk Keputusan Bisnis Cerdas
        </h2>
        <p class="text-[#4F6854] text-lg leading-relaxed">
          Platform analitik kami dirancang khusus untuk memantau sentimen pelanggan dan mengukur produktivitas agen secara komprehensif.
        </p>
        
        <ul class="space-y-4 pt-4">
          <li class="flex items-start gap-3 bg-white p-4 rounded-xl shadow-sm border border-[#d2e3c9]">
            <div class="bg-[#EBF4E3] p-1.5 rounded-full mt-0.5 shrink-0">
              <i data-lucide="check-circle-2" class="h-5 w-5 text-[#415B45]"></i>
            </div>
            <span class="text-[#1C2C1F] font-medium">Identifikasi tren keluhan sebelum menjadi krisis</span>
          </li>
          <li class="flex items-start gap-3 bg-white p-4 rounded-xl shadow-sm border border-[#d2e3c9]">
            <div class="bg-[#EBF4E3] p-1.5 rounded-full mt-0.5 shrink-0">
              <i data-lucide="check-circle-2" class="h-5 w-5 text-[#415B45]"></i>
            </div>
            <span class="text-[#1C2C1F] font-medium">Ukur kinerja agen secara objektif dengan metrik akurat</span>
          </li>
          <li class="flex items-start gap-3 bg-white p-4 rounded-xl shadow-sm border border-[#d2e3c9]">
            <div class="bg-[#EBF4E3] p-1.5 rounded-full mt-0.5 shrink-0">
              <i data-lucide="check-circle-2" class="h-5 w-5 text-[#415B45]"></i>
            </div>
            <span class="text-[#1C2C1F] font-medium">Pahami preferensi saluran komunikasi pelanggan Anda</span>
          </li>
          <li class="flex items-start gap-3 bg-white p-4 rounded-xl shadow-sm border border-[#d2e3c9]">
            <div class="bg-[#EBF4E3] p-1.5 rounded-full mt-0.5 shrink-0">
              <i data-lucide="check-circle-2" class="h-5 w-5 text-[#415B45]"></i>
            </div>
            <span class="text-[#1C2C1F] font-medium">Prediksi lonjakan panggilan berdasarkan riwayat data</span>
          </li>
        </ul>
      </div>
    </div>
  </div>

  <!-- Metrics Section -->
  <div class="bg-white py-24 border-t border-[#d2e3c9]">
    <div class="max-w-7xl mx-auto px-6">
      <div class="text-center mb-16">
        <h2 class="text-3xl font-bold text-[#1C2C1F] mb-4">Metrik Utama yang Dipantau</h2>
        <p class="text-[#4F6854]">Segala indikator kinerja kunci (KPI) pusat layanan dalam satu layar.</p>
      </div>
      
      <div class="grid md:grid-cols-3 gap-8">
        <div class="bg-[#F4F9F0] rounded-2xl p-8 border border-[#d2e3c9] text-center hover:-translate-y-1 transition-transform">
          <div class="bg-[#FDB854] w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-4 text-white shadow-md">
            <i data-lucide="users" class="w-6 h-6"></i>
          </div>
          <h3 class="text-[#4F6854] font-medium mb-2">Customer Satisfaction (CSAT)</h3>
          <div class="text-4xl font-bold text-[#1C2C1F] mb-3">98%</div>
          <p class="text-sm text-[#4F6854]/80">Tingkat kepuasan rata-rata dari interaksi</p>
        </div>
        <div class="bg-[#F4F9F0] rounded-2xl p-8 border border-[#d2e3c9] text-center hover:-translate-y-1 transition-transform">
          <div class="bg-[#FDB854] w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-4 text-white shadow-md">
            <i data-lucide="check-circle-2" class="w-6 h-6"></i>
          </div>
          <h3 class="text-[#4F6854] font-medium mb-2">First Contact Resolution</h3>
          <div class="text-4xl font-bold text-[#1C2C1F] mb-3">85%</div>
          <p class="text-sm text-[#4F6854]/80">Persentase masalah yang diselesaikan di kontak pertama</p>
        </div>
        <div class="bg-[#F4F9F0] rounded-2xl p-8 border border-[#d2e3c9] text-center hover:-translate-y-1 transition-transform">
          <div class="bg-[#FDB854] w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-4 text-white shadow-md">
            <i data-lucide="trending-up" class="w-6 h-6"></i>
          </div>
          <h3 class="text-[#4F6854] font-medium mb-2">Average Handling Time</h3>
          <div class="text-4xl font-bold text-[#1C2C1F] mb-3">3.2m</div>
          <p class="text-sm text-[#4F6854]/80">Waktu rata-rata penyelesaian masalah pelanggan</p>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Mini CTA -->
  <div class="bg-[#7A9E7E] py-16 text-center">
    <h2 class="text-2xl font-bold text-white mb-6">Mulai Gunakan Analisis Data Hari Ini</h2>
    <a href="#harga" class="inline-block bg-[#FDB854] text-white px-8 py-3 rounded-full font-bold hover:bg-[#e89e3a] transition-colors shadow-lg">
      Lihat Paket Harga
    </a>
  </div>
</section>

<!-- Fitur Section (Redesain dari Figma) -->
<section id="fitur" class="bg-white w-full">
  <!-- Header Area -->
  <div class="bg-[#EBF4E3] py-20 border-b border-[#d2e3c9]">
    <div class="max-w-7xl mx-auto px-6 text-center">
      <h1 class="text-4xl md:text-5xl font-bold text-[#1C2C1F] mb-6">
        Fitur <span class="text-[#415B45]">OmniServe</span>
      </h1>
      <p class="text-[#4F6854] text-lg md:text-xl max-w-2xl mx-auto">
        Sistem canggih yang dibuat sederhana. Desain antarmuka intuitif memastikan tim Anda langsung bekerja tanpa pelatihan panjang.
      </p>
    </div>
  </div>

  <!-- Main Features Grid -->
  <div class="py-24 max-w-7xl mx-auto px-6">
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
      <!-- Feature 1 -->
      <div class="bg-[#F4F9F0] rounded-2xl p-8 border border-[#d2e3c9] hover:shadow-xl hover:border-[#7A9E7E] hover:-translate-y-1 transition-all duration-300 group">
        <div class="bg-white w-14 h-14 rounded-xl shadow-sm flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
          <i data-lucide="globe" class="h-7 w-7 text-[#FDB854]"></i>
        </div>
        <h4 class="text-xl font-bold text-[#1C2C1F] mb-4">Integrasi Semua Channel</h4>
        <p class="text-[#4F6854] leading-relaxed">Telepon, WhatsApp, Instagram, Email, dan Live Chat dalam satu kotak masuk (inbox). Agen tidak perlu berpindah tab.</p>
      </div>
      <!-- Feature 2 -->
      <div class="bg-[#F4F9F0] rounded-2xl p-8 border border-[#d2e3c9] hover:shadow-xl hover:border-[#7A9E7E] hover:-translate-y-1 transition-all duration-300 group">
        <div class="bg-white w-14 h-14 rounded-xl shadow-sm flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
          <i data-lucide="zap" class="h-7 w-7 text-[#FDB854]"></i>
        </div>
        <h4 class="text-xl font-bold text-[#1C2C1F] mb-4">Otomatisasi Cerdas (ACD)</h4>
        <p class="text-[#4F6854] leading-relaxed">Distribusikan tiket secara otomatis ke agen yang paling tepat berdasarkan keahlian atau beban kerja saat ini.</p>
      </div>
      <!-- Feature 3 -->
      <div class="bg-[#F4F9F0] rounded-2xl p-8 border border-[#d2e3c9] hover:shadow-xl hover:border-[#7A9E7E] hover:-translate-y-1 transition-all duration-300 group">
        <div class="bg-white w-14 h-14 rounded-xl shadow-sm flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
          <i data-lucide="bar-chart-3" class="h-7 w-7 text-[#FDB854]"></i>
        </div>
        <h4 class="text-xl font-bold text-[#1C2C1F] mb-4">Laporan Siap Pakai</h4>
        <p class="text-[#4F6854] leading-relaxed">Hasilkan laporan kinerja harian, mingguan, hingga bulanan hanya dengan satu klik. Ekspor dalam PDF atau Excel.</p>
      </div>
      <!-- Feature 4 -->
      <div class="bg-[#F4F9F0] rounded-2xl p-8 border border-[#d2e3c9] hover:shadow-xl hover:border-[#7A9E7E] hover:-translate-y-1 transition-all duration-300 group">
        <div class="bg-white w-14 h-14 rounded-xl shadow-sm flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
          <i data-lucide="shield-check" class="h-7 w-7 text-[#FDB854]"></i>
        </div>
        <h4 class="text-xl font-bold text-[#1C2C1F] mb-4">Keamanan Data Enterprise</h4>
        <p class="text-[#4F6854] leading-relaxed">Enkripsi end-to-end, kepatuhan GDPR, dan manajemen akses berbasis peran (RBAC) untuk melindungi data pelanggan.</p>
      </div>
      <!-- Feature 5 -->
      <div class="bg-[#F4F9F0] rounded-2xl p-8 border border-[#d2e3c9] hover:shadow-xl hover:border-[#7A9E7E] hover:-translate-y-1 transition-all duration-300 group">
        <div class="bg-white w-14 h-14 rounded-xl shadow-sm flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
          <i data-lucide="message-square" class="h-7 w-7 text-[#FDB854]"></i>
        </div>
        <h4 class="text-xl font-bold text-[#1C2C1F] mb-4">Templat Balasan Cepat</h4>
        <p class="text-[#4F6854] leading-relaxed">Simpan jawaban untuk pertanyaan yang sering diajukan (FAQ) agar agen merespons lebih cepat dan konsisten.</p>
      </div>
      <!-- Feature 6 -->
      <div class="bg-[#F4F9F0] rounded-2xl p-8 border border-[#d2e3c9] hover:shadow-xl hover:border-[#7A9E7E] hover:-translate-y-1 transition-all duration-300 group">
        <div class="bg-white w-14 h-14 rounded-xl shadow-sm flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
          <i data-lucide="headphones" class="h-7 w-7 text-[#FDB854]"></i>
        </div>
        <h4 class="text-xl font-bold text-[#1C2C1F] mb-4">Pemantauan Panggilan</h4>
        <p class="text-[#4F6854] leading-relaxed">Supervisor dapat mendengarkan panggilan secara real-time (barge-in) atau memberi arahan tersembunyi (whisper).</p>
      </div>
    </div>
  </div>

  <!-- Integration Banner -->
  <div class="py-20 bg-[#1C2C1F] text-white text-center px-6">
    <h2 class="text-3xl md:text-4xl font-bold mb-6 text-[#EBF4E3]">Mudah Diintegrasikan dengan Tools Anda</h2>
    <p class="text-white/80 max-w-2xl mx-auto mb-10">
      OmniServe menyediakan lebih dari 50+ integrasi langsung dengan CRM, ERP, dan aplikasi produktivitas populer seperti Salesforce, Zendesk, Slack, dan lainnya.
    </p>
    <a href="#use-case" class="inline-block bg-white text-[#1C2C1F] px-8 py-3 rounded-full font-bold hover:bg-[#FDB854] hover:text-white transition-colors shadow-lg">
      Lihat Studi Kasus
    </a>
  </div>
</section>

<!-- Customers Section -->
<section class="py-24 bg-[#EBF4E3] relative" id="customers">
  <div class="max-w-6xl mx-auto px-6 md:px-12 relative z-10">
    <div class="text-center mb-16">
      <h2 class="text-3xl md:text-5xl font-bold text-[#1C2C1F] mb-4">Dipercaya Oleh Berbagai Instansi</h2>
      <p class="text-[#4F6854] text-lg max-w-2xl mx-auto">
        Kami bangga dapat mendukung pelayanan terbaik yang diberikan oleh mitra dan pelanggan kami.
      </p>
    </div>

    <!-- Grid Layout for Desktop, Scrollable Flex for Mobile -->
    <div class="flex overflow-x-auto snap-x md:grid md:grid-cols-2 lg:grid-cols-4 gap-6 pb-8 md:pb-0 hide-scrollbar -mx-6 px-6 md:mx-0 md:px-0">
      <?php for ( $i = 1; $i <= 4; $i++ ) : 
        $cust_name = get_theme_mod('omni_customer_'.$i.'_name', 'Pelanggan '.$i);
        $cust_desc = get_theme_mod('omni_customer_'.$i.'_desc', 'Deskripsi pelanggan '.$i);
        $default_imgs = array(
            1 => 'https://images.unsplash.com/photo-1636217432188-3a81bccad020?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxnb3Zlcm5tZW50JTIwb2ZmaWNlJTIwYnVpbGRpbmd8ZW58MXx8fHwxNzc4MTcyNDE5fDA&ixlib=rb-4.1.0&q=80&w=1080',
            2 => 'https://images.unsplash.com/photo-1770775776141-6b3ac7ef9dd3?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxtb2Rlcm4lMjBpbW1pZ3JhdGlvbiUyMG9mZmljZXxlbnwxfHx8fDE3NzgxNzI0MjB8MA&ixlib=rb-4.1.0&q=80&w=1080',
            3 => 'https://images.unsplash.com/photo-1766898211749-00820c5dc505?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxjb25jcmV0ZSUyMG1peGVyJTIwY29uc3RydWN0aW9ufGVufDF8fHx8MTc3ODE3MjQxOXww&ixlib=rb-4.1.0&q=80&w=1080',
            4 => 'https://images.unsplash.com/photo-1721411480070-fcb558776d54?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxlbWVyZ2VuY3klMjBtZWRpY2FsJTIwYW1idWxhbmNlfGVufDF8fHx8MTc3ODE3MjQyMHww&ixlib=rb-4.1.0&q=80&w=1080'
        );
        $cust_img = get_theme_mod('omni_customer_'.$i.'_img', $default_imgs[$i]);
      ?>
      <div class="bg-white rounded-3xl overflow-hidden shadow-lg border border-[#d2e3c9] flex flex-col group hover:-translate-y-2 transition-all duration-300 min-w-[300px] snap-center">
        <div class="relative h-48 overflow-hidden">
          <img src="<?php echo esc_url($cust_img); ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" alt="<?php echo esc_attr($cust_name); ?>" />
          <div class="absolute inset-0 bg-gradient-to-t from-[#1C2C1F]/80 to-transparent"></div>
          <div class="absolute bottom-4 left-4 right-4">
            <h3 class="text-white font-bold text-xl leading-tight drop-shadow-md"><?php echo esc_html($cust_name); ?></h3>
          </div>
        </div>
        <div class="p-6 flex-1 flex flex-col">
          <p class="text-[#4F6854] text-sm leading-relaxed flex-1">
            <?php echo esc_html($cust_desc); ?>
          </p>
        </div>
      </div>
      <?php endfor; ?>
    </div>
  </div>
</section>

<!-- CTA Section Harmonized with OmniServe Colors -->
<section class="py-20 bg-[#1C2C1F] relative overflow-hidden">
  <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-[#415B45]/40 rounded-full blur-[100px] -translate-y-1/2 translate-x-1/2"></div>
  <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-[#FDB854]/10 rounded-full blur-[80px] translate-y-1/2 -translate-x-1/2"></div>

  <div class="max-w-4xl mx-auto px-4 text-center relative z-10">
    <h2 class="text-3xl md:text-5xl font-bold text-white mb-6">Siap Mengubah Cara Anda Melayani?</h2>
    <p class="text-[#EBF4E3] text-xl mb-10 max-w-2xl mx-auto opacity-90">
      Bergabunglah dengan ratusan perusahaan lain yang telah mendigitalisasi pusat layanan pelanggan mereka dengan OmniServe.
    </p>
    <div class="flex flex-col sm:flex-row justify-center gap-4">
      <a href="#harga" class="bg-[#FDB854] text-white hover:bg-[#e89e3a] px-8 py-4 rounded-full font-bold text-lg transition-all shadow-lg hover:shadow-xl hover:-translate-y-1 inline-block">
        Mulai Uji Coba Gratis
      </a>
      <button class="bg-transparent text-white hover:bg-white/10 border border-white/30 px-8 py-4 rounded-full font-bold text-lg transition-all">
        Hubungi Sales Kami
      </button>
    </div>
  </div>
</section>

<script>
  lucide.createIcons();
  document.addEventListener('DOMContentLoaded', () => {
    const btn = document.getElementById('mobile-menu-btn');
    const panel = document.getElementById('mobile-menu-panel');
    const menuIcon = document.querySelector('.menu-icon');
    const closeIcon = document.querySelector('.close-icon');

    if (btn) {
      btn.addEventListener('click', () => {
        const isHidden = panel.classList.contains('hidden');
        if (isHidden) {
          panel.classList.remove('hidden');
          menuIcon.classList.add('hidden');
          closeIcon.classList.remove('hidden');
        } else {
          panel.classList.add('hidden');
          menuIcon.classList.remove('hidden');
          closeIcon.classList.add('hidden');
        }
      });
    }
  });
</script>

<?php
get_footer();
?>
