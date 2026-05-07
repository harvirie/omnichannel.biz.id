<?php
get_header();
?>

<!-- Navbar (Mobile Only, Desktop Nav is inside Hero) -->
<nav class="lg:hidden fixed w-full bg-[#EBF4E3]/90 backdrop-blur-md z-50 border-b border-[#d2e3c9]">
  <div class="px-4">
    <div class="flex justify-between items-center h-20">
      <div class="flex items-center gap-2">
        <div class="bg-[#415B45] p-2 rounded-lg">
          <i data-lucide="headphones" class="h-6 w-6 text-white"></i>
        </div>
        <span class="font-bold text-xl tracking-tight text-[#1C2C1F]">OmniServe</span>
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
    
    <!-- Top Header Area (Desktop) -->
    <div class="hidden lg:flex justify-between items-center px-4 pt-4 pb-6 absolute top-0 left-0 w-full z-30 pointer-events-none">
      <div class="w-1/3"></div> <!-- Placeholder for logo space inside card -->
      
      <!-- Sign In Pill -->
      <div class="w-1/3 flex justify-center pointer-events-auto mt-4">
         <div class="flex items-center shadow-lg rounded-full bg-[#FDB854] p-1 pr-1.5 transition-transform hover:scale-105 cursor-pointer">
           <span class="text-white px-6 py-1.5 font-medium text-sm">Masuk</span>
           <div class="bg-[#e89e3a] text-white p-1.5 rounded-full"><i data-lucide="arrow-right" class="h-4 w-4"></i></div>
         </div>
      </div>

      <!-- Navigation -->
      <nav class="w-1/3 flex justify-end gap-8 text-white pr-8 pointer-events-auto mt-4">
        <a href="#fitur" class="hover:text-[#FDB854] text-sm font-medium transition-colors">Fitur</a>
        <a href="#usecase" class="hover:text-[#FDB854] text-sm font-medium transition-colors">Use Case</a>
        <a href="#analitik" class="hover:text-[#FDB854] text-sm font-medium transition-colors">Analitik Data</a>
      </nav>
    </div>

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
            <!-- bottom: 175+780=955, shape-bottom≈1014, bottom-pad=59 -->
            <clipPath id="imageClip">
              <rect x="950" y="175" width="990" height="780" rx="44" ry="44"/>
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
          <image href="https://images.unsplash.com/photo-1766066014237-00645c74e9c6?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxtb2Rlcm4lMjBjYWxsJTIwY2VudGVyJTIwYWdlbnQlMjB0YWxraW5nJTIwb24lMjBoZWFkc2V0fGVufDF8fHx8MTc3ODE0Njc3NXww&ixlib=rb-4.1.0&q=80&w=1080"
            x="950" y="175" width="990" height="780"
            preserveAspectRatio="xMidYMid slice"
            clip-path="url(#imageClip)"/>

          <!-- Gradient overlay on photo -->
          <rect x="950" y="175" width="990" height="780" rx="44" ry="44" fill="url(#imgGrad)"/>
        </svg>

        <!-- Left Text Content: positioned absolutely over SVG -->
        <div class="absolute top-[5%] left-[4%] w-[40%] z-20 flex flex-col">
          <div class="flex items-center gap-2 mb-8">
            <div class="bg-[#415B45] p-2 rounded-xl shadow-sm">
              <i data-lucide="headphones" class="h-6 w-6 text-white"></i>
            </div>
            <span class="font-bold text-[1.4vw] xl:text-2xl tracking-tight text-[#1C2C1F] font-serif">OmniServe</span>
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
          <img src="https://images.unsplash.com/photo-1766066014237-00645c74e9c6?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxtb2Rlcm4lMjBjYWxsJTIwY2VudGVyJTIwYWdlbnQlMjB0YWxraW5nJTIwb24lMjBoZWFkc2V0fGVufDF8fHx8MTc3ODE0Njc3NXww&ixlib=rb-4.1.0&q=80&w=1080" class="absolute inset-0 w-full h-full object-cover" />
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

<!-- Analitik Section -->
<section id="analitik" class="py-24 bg-slate-900 text-white relative overflow-hidden">
  <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-blue-600/20 rounded-full blur-[100px] -translate-y-1/2 translate-x-1/2"></div>
  <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-cyan-500/20 rounded-full blur-[80px] translate-y-1/2 -translate-x-1/2"></div>
  
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
    <div class="grid lg:grid-cols-2 gap-16 items-center">
      <div class="order-2 lg:order-1">
        <img 
          src="https://images.unsplash.com/photo-1759752394755-1241472b589d?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxkYXRhJTIwYW5hbHl0aWNzJTIwZGFzaGJvYXJkJTIwc2NyZWVufGVufDF8fHx8MTc3ODE0NTkwNnww&ixlib=rb-4.1.0&q=80&w=1080" 
          alt="Data Analytics" 
          class="rounded-2xl shadow-2xl border border-slate-700/50 object-cover h-[450px] w-full"
        />
      </div>
      <div class="order-1 lg:order-2 space-y-8">
        <h2 class="text-3xl md:text-5xl font-bold leading-tight font-serif">
          Berhenti Sekadar Merespon. <br />
          <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-300 font-sans">
            Ubah Interaksi Menjadi Data.
          </span>
        </h2>
        <p class="text-slate-300 text-lg md:text-xl leading-relaxed">
          Pelayanan pelanggan bukan lagi sekadar cost center. Melalui OmniServe, setiap keluhan, pertanyaan, dan saran direkam, dianalisis, dan divisualisasikan menjadi wawasan bisnis yang kuat secara real-time.
        </p>
        <ul class="space-y-4 pt-4">
          <li class="flex items-start gap-3">
            <div class="bg-blue-500/20 p-1 rounded-full mt-1">
              <i data-lucide="check-circle-2" class="h-5 w-5 text-blue-400"></i>
            </div>
            <span class="text-slate-200 text-lg">Identifikasi tren keluhan sebelum menjadi krisis</span>
          </li>
          <li class="flex items-start gap-3">
            <div class="bg-blue-500/20 p-1 rounded-full mt-1">
              <i data-lucide="check-circle-2" class="h-5 w-5 text-blue-400"></i>
            </div>
            <span class="text-slate-200 text-lg">Ukur kinerja agen secara objektif dengan metrik akurat</span>
          </li>
          <li class="flex items-start gap-3">
            <div class="bg-blue-500/20 p-1 rounded-full mt-1">
              <i data-lucide="check-circle-2" class="h-5 w-5 text-blue-400"></i>
            </div>
            <span class="text-slate-200 text-lg">Pahami preferensi saluran komunikasi pelanggan Anda</span>
          </li>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- Fitur Section -->
<section id="fitur" class="py-24 bg-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center max-w-3xl mx-auto mb-16">
      <h2 class="text-blue-600 font-semibold tracking-wide uppercase text-sm mb-3">Kemudahan Maksimal</h2>
      <h3 class="text-3xl md:text-4xl font-bold text-slate-900 mb-6 font-serif">Sistem Rumit yang Dibuat Sederhana</h3>
      <p class="text-lg text-slate-600">
        Desain antarmuka yang intuitif memastikan agen Anda bisa langsung bekerja tanpa perlu masa pelatihan berbulan-bulan. Fokus melayani, bukan belajar aplikasi.
      </p>
    </div>

    <div class="grid md:grid-cols-3 gap-8 mb-16">
      <div class="bg-slate-50 rounded-2xl p-8 border border-slate-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
        <div class="bg-white w-14 h-14 rounded-xl shadow-sm flex items-center justify-center mb-6">
          <i data-lucide="globe" class="h-7 w-7 text-blue-600"></i>
        </div>
        <h4 class="text-xl font-bold text-slate-900 mb-4">Integrasi Semua Channel</h4>
        <p class="text-slate-600 leading-relaxed">
          Telepon, WhatsApp, Instagram, Email, dan Live Chat dalam satu kotak masuk (inbox). Agen tidak perlu lagi berpindah-pindah tab.
        </p>
      </div>
      <div class="bg-slate-50 rounded-2xl p-8 border border-slate-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
        <div class="bg-white w-14 h-14 rounded-xl shadow-sm flex items-center justify-center mb-6">
          <i data-lucide="zap" class="h-7 w-7 text-cyan-500"></i>
        </div>
        <h4 class="text-xl font-bold text-slate-900 mb-4">Otomatisasi Cerdas</h4>
        <p class="text-slate-600 leading-relaxed">
          Distribusikan tiket secara otomatis (ACD) ke agen yang paling tepat berdasarkan keahlian atau beban kerja.
        </p>
      </div>
      <div class="bg-slate-50 rounded-2xl p-8 border border-slate-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
        <div class="bg-white w-14 h-14 rounded-xl shadow-sm flex items-center justify-center mb-6">
          <i data-lucide="bar-chart-3" class="h-7 w-7 text-blue-500"></i>
        </div>
        <h4 class="text-xl font-bold text-slate-900 mb-4">Laporan Siap Pakai</h4>
        <p class="text-slate-600 leading-relaxed">
          Hasilkan laporan kinerja harian, mingguan, hingga bulanan hanya dengan satu klik. Ekspor dalam format PDF atau Excel.
        </p>
      </div>
    </div>
  </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-blue-600 relative overflow-hidden">
  <div class="max-w-4xl mx-auto px-4 text-center relative z-10">
    <h2 class="text-3xl md:text-5xl font-bold text-white mb-6 font-serif">Siap Mengubah Cara Anda Melayani?</h2>
    <p class="text-blue-100 text-xl mb-10 max-w-2xl mx-auto">
      Bergabunglah dengan ratusan perusahaan lain yang telah mendigitalisasi pusat layanan pelanggan mereka dengan OmniServe.
    </p>
    <div class="flex flex-col sm:flex-row justify-center gap-4">
      <button class="bg-white text-blue-600 hover:bg-slate-50 px-8 py-4 rounded-full font-bold text-lg transition-all shadow-lg">
        Mulai Uji Coba Gratis
      </button>
      <button class="bg-blue-700 text-white hover:bg-blue-800 border border-blue-500 px-8 py-4 rounded-full font-bold text-lg transition-all">
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
