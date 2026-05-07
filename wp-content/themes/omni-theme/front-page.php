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

    <!-- Main Content Grid -->
    <div class="relative w-full flex-1 flex flex-col pt-12 lg:pt-0 lg:mt-16">
      
      <!-- Top Card (Light Green) -->
      <div class="bg-[#EBF4E3] rounded-[2.5rem] p-8 md:p-12 lg:p-16 flex flex-col lg:flex-row gap-12 shadow-2xl relative z-10 pb-32">
        
        <!-- Left Content -->
        <div class="flex-1">
          <!-- Logo -->
          <div class="flex items-center gap-2 mb-10">
            <div class="bg-[#415B45] p-2 rounded-xl shadow-sm">
              <i data-lucide="headphones" class="h-6 w-6 text-white"></i>
            </div>
            <span class="font-bold text-2xl tracking-tight text-[#1C2C1F] font-serif">OmniServe</span>
          </div>
          
          <h1 class="text-5xl md:text-6xl lg:text-[64px] font-serif text-[#1C2C1F] mb-6 leading-[1.05]">
            Satu Layar untuk<br>Semua Saluran.
          </h1>
          <p class="text-[#4F6854] text-lg max-w-md mb-12 font-medium leading-relaxed">
            Tingkatkan kepuasan pelanggan dan produktivitas tim yang menghubungkan suara, chat, email, dan sosmed dalam satu tempat.
          </p>

          <!-- Search Bar Pill -->
          <div class="flex items-center bg-white p-2 rounded-full max-w-md shadow-sm mb-12 border border-[#d2e3c9]">
            <button class="bg-[#567558] hover:bg-[#415B45] transition-colors text-white px-6 py-3 rounded-full text-sm font-semibold">Coba Gratis</button>
            <button class="px-6 py-3 text-sm font-semibold text-[#4F6854] hover:bg-slate-50 rounded-full transition-colors">Demo</button>
            <div class="flex-1 px-4 text-sm text-slate-400 font-medium">Pusat Layanan...</div>
            <button class="bg-[#FDB854] hover:bg-[#e89e3a] transition-colors p-3 rounded-full text-white shadow-md"><i data-lucide="search" class="h-5 w-5"></i></button>
          </div>

          <!-- Trusted Pilot -->
          <div class="flex items-center gap-3">
            <div class="bg-[#0f172a] p-2.5 rounded-full"><i data-lucide="star" class="h-5 w-5 text-[#34d399] fill-[#34d399]"></i></div>
            <div>
               <div class="font-serif italic text-lg text-[#1C2C1F] font-medium">Tanpa Kartu Kredit</div>
               <div class="text-sm font-semibold text-[#4F6854]">Setup 5 Menit</div>
            </div>
          </div>
        </div>

        <!-- Right Content (Image) -->
        <div class="flex-1 relative min-h-[400px] lg:min-h-[500px] rounded-[2rem] overflow-hidden shadow-2xl">
          <img src="https://images.unsplash.com/photo-1766066014237-00645c74e9c6?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxtb2Rlcm4lMjBjYWxsJTIwY2VudGVyJTIwYWdlbnQlMjB0YWxraW5nJTIwb24lMjBoZWFkc2V0fGVufDF8fHx8MTc3ODE0Njc3NXww&ixlib=rb-4.1.0&q=80&w=1080" class="absolute inset-0 w-full h-full object-cover" />
          
          <div class="absolute inset-0 bg-gradient-to-t from-[#1C2C1F]/80 via-transparent to-transparent"></div>
          
          <!-- Glassmorphism overlay on Image -->
          <div class="absolute bottom-6 left-6 right-6">
            <h3 class="font-serif text-3xl mb-4 text-white drop-shadow-md">Recommended</h3>
            <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-5 text-white shadow-xl">
               <div class="flex items-center gap-2 mb-2">
                 <h4 class="font-medium text-xl text-white">Panggilan Masuk</h4>
                 <div class="bg-[#ef4444] p-1 rounded-full"><i data-lucide="star" class="h-3 w-3 text-white fill-white"></i></div>
                 <span class="text-sm font-semibold ml-1">(2.3k+)</span>
               </div>
               <p class="text-sm text-white/90">Budi Santoso - Keluhan Produk <br><span class="text-xs opacity-80">Menunggu antrean (0:45)</span></p>
            </div>
          </div>
        </div>
      </div>

      <!-- Bottom Dark Card (SVG background) -->
      <div class="relative w-full mt-[-80px] lg:mt-[-120px] z-20 min-h-[300px] md:min-h-[350px] flex items-end drop-shadow-2xl">
        <!-- SVG Shape -->
        <div class="absolute inset-0 w-full h-full pointer-events-none overflow-hidden rounded-b-[2.5rem]">
           <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" class="w-full h-full drop-shadow-2xl" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
            viewBox="0 0 1998.02 451.34" preserveAspectRatio="none"
            xmlns:xlink="http://www.w3.org/1999/xlink">
            <defs>
             <style type="text/css">
              <![CDATA[
               .str0 {
                  stroke: #FDB854; 
                  stroke-width: 4;
                  stroke-dasharray: 4000;
                  animation: drawOutline 6s ease-in-out infinite alternate;
               }
               .fil0 {fill: #1C2C1F;}
               @keyframes drawOutline {
                 0% { stroke-dashoffset: 4000; }
                 100% { stroke-dashoffset: 0; }
               }
              ]]>
             </style>
            </defs>
            <g id="Layer_x0020_1">
             <path class="fil0 str0" d="M60.53 1.15l632.17 0c22.48,2.75 39.95,17.54 49.39,44.38l20.71 58.23c10.75,24.51 20.49,48.01 47.3,49.45l1128.88 0c36.35,2.9 56.65,24.87 57.88,53.87l0 200.69c-0.56,23.17 -18.18,41.32 -52.87,42.42l-1177.81 0 -361.13 0 -346.53 0c-25.14,-1.43 -56.31,-25.94 -57.37,-58.48l0 -327.12c2.74,-29.17 26.54,-60.35 59.38,-63.44z"/>
            </g>
           </svg>
        </div>

        <!-- Bottom Content inside SVG -->
        <div class="relative z-10 w-full flex flex-col lg:flex-row justify-between items-center p-8 md:p-12 pb-12 pt-24 md:pt-32 gap-8">
           <!-- Text -->
           <div class="text-white pl-4 lg:pl-12">
              <h2 class="font-serif text-4xl lg:text-5xl mb-6 text-[#EBF4E3]">Integrasi<br><em class="text-[#FDB854] font-sans italic">Tanpa Batas</em></h2>
              <div class="flex items-center w-fit shadow-lg rounded-full bg-[#FDB854] p-1 pr-1.5 transition-transform hover:scale-105 cursor-pointer">
                 <span class="text-white px-6 py-2 font-semibold text-sm">Pelajari</span>
                 <div class="bg-[#e89e3a] text-white p-2 rounded-full"><i data-lucide="arrow-right" class="h-4 w-4"></i></div>
              </div>
           </div>
           
           <!-- Services Cards -->
           <div class="flex gap-4 overflow-x-auto w-full lg:w-auto pb-4 lg:pb-0 scrollbar-hide pr-4 lg:pr-12">
               <div class="border border-[#2C4131] rounded-2xl p-6 min-w-[130px] flex flex-col items-center justify-center text-center hover:bg-[#2A3E2F] transition-all cursor-pointer group hover:-translate-y-1 bg-[#1C2C1F]/50 backdrop-blur-sm shadow-xl">
                 <i data-lucide="phone" class="h-8 w-8 text-[#FDB854] mb-4 group-hover:scale-110 transition-transform"></i>
                 <span class="text-sm text-slate-200 font-medium">Telepon</span>
               </div>
               <div class="border border-[#2C4131] rounded-2xl p-6 min-w-[130px] flex flex-col items-center justify-center text-center hover:bg-[#2A3E2F] transition-all cursor-pointer group hover:-translate-y-1 bg-[#1C2C1F]/50 backdrop-blur-sm shadow-xl">
                 <i data-lucide="message-circle" class="h-8 w-8 text-[#FDB854] mb-4 group-hover:scale-110 transition-transform"></i>
                 <span class="text-sm text-slate-200 font-medium">WhatsApp</span>
               </div>
               <div class="border border-[#2C4131] rounded-2xl p-6 min-w-[130px] flex flex-col items-center justify-center text-center hover:bg-[#2A3E2F] transition-all cursor-pointer group hover:-translate-y-1 bg-[#1C2C1F]/50 backdrop-blur-sm shadow-xl">
                 <i data-lucide="instagram" class="h-8 w-8 text-[#FDB854] mb-4 group-hover:scale-110 transition-transform"></i>
                 <span class="text-sm text-slate-200 font-medium">Instagram</span>
               </div>
               <div class="border border-[#2C4131] rounded-2xl p-6 min-w-[130px] flex flex-col items-center justify-center text-center hover:bg-[#2A3E2F] transition-all cursor-pointer group hover:-translate-y-1 bg-[#1C2C1F]/50 backdrop-blur-sm shadow-xl">
                 <i data-lucide="mail" class="h-8 w-8 text-[#FDB854] mb-4 group-hover:scale-110 transition-transform"></i>
                 <span class="text-sm text-slate-200 font-medium">Email</span>
               </div>
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
