<?php
get_header();
?>

<!-- Navbar (Mobile Only, Desktop Nav is inside Hero) -->
<nav class="lg:hidden fixed w-full bg-white/90 backdrop-blur-md z-50 border-b border-slate-200">
  <div class="px-4">
    <div class="flex justify-between items-center h-20">
      <div class="flex items-center gap-2">
        <div class="bg-blue-600 p-2 rounded-lg">
          <i data-lucide="headphones" class="h-6 w-6 text-white"></i>
        </div>
        <span class="font-bold text-xl tracking-tight text-slate-800">OmniServe</span>
      </div>
      <div class="flex items-center">
        <button id="mobile-menu-btn" class="text-slate-600">
          <i data-lucide="menu" class="h-6 w-6 menu-icon"></i>
          <i data-lucide="x" class="h-6 w-6 close-icon hidden"></i>
        </button>
      </div>
    </div>
  </div>
  <div id="mobile-menu-panel" class="hidden bg-white border-b border-slate-200 px-4 pt-2 pb-4 space-y-1 shadow-lg">
    <a href="#fitur" class="block px-3 py-2 rounded-md font-medium text-slate-700 hover:text-blue-600">Fitur</a>
    <a href="#usecase" class="block px-3 py-2 rounded-md font-medium text-slate-700 hover:text-blue-600">Use Case</a>
    <a href="#analitik" class="block px-3 py-2 rounded-md font-medium text-slate-700 hover:text-blue-600">Analitik Data</a>
  </div>
</nav>

<!-- Custom Hero (Cmouse Layout + OmniServe Content + Blue Theme) -->
<section class="p-4 md:p-6 min-h-screen bg-slate-50 flex items-center justify-center pt-24 lg:pt-6 relative">
  <div class="relative w-full max-w-[1400px] mx-auto rounded-[2.5rem] bg-slate-900 p-6 grid grid-cols-1 lg:grid-cols-12 gap-6 min-h-[85vh] shadow-2xl">
    
    <!-- Dynamic Animated SVG Background -->
    <div class="absolute inset-0 w-full h-full pointer-events-none z-0 overflow-hidden rounded-[2.5rem]">
      <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" class="w-full h-full opacity-70" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd; transform-origin: center; animation: pulseSvg 6s ease-in-out infinite alternate;"
      viewBox="0 0 2003.61 1165.9" preserveAspectRatio="none"
       xmlns:xlink="http://www.w3.org/1999/xlink">
       <defs>
        <style type="text/css">
         <![CDATA[
          @keyframes pulseSvg {
            0% { transform: scale(1); opacity: 0.4; }
            100% { transform: scale(1.02); opacity: 0.8; }
          }
          @keyframes drawStroke {
            0% { stroke-dashoffset: 7000; }
            100% { stroke-dashoffset: 0; }
          }
          .str0 {
            stroke:#332D2B;
            stroke-width:4;
            stroke-miterlimit:22.9256;
            stroke-dasharray: 7000;
            animation: drawStroke 15s linear infinite;
          }
          .fil0 {fill:none}
         ]]>
        </style>
       </defs>
       <g id="Layer_x0020_1">
        <metadata id="CorelCorpID_0Corel-Layer"/>
        <path class="fil0 str0" d="M59.63 1.15c-31.36,2.09 -57.24,35.21 -58.48,63.77l0 868.48c0.21,40.7 31.44,80.21 57.9,82.71l620.34 0c44.47,-2.37 78.19,19.13 86.85,53.76l16.6 42.02c10.6,29.56 32.67,51.95 57.96,52.85l1097.19 0c40.74,-3.5 63.9,-32.96 64.46,-63.25l0 -898.05c-0.2,-32.85 -23.01,-53.99 -53.35,-53.35l-1115.9 0c-25.65,-2.32 -54.43,-18.18 -64.46,-44.46l-26.68 -71.13c-12.41,-25.7 -33.16,-31.61 -62.24,-33.35l-620.19 0z"/>
       </g>
      </svg>
    </div>

    <!-- Top Nav (Desktop) -->
    <nav class="absolute top-10 right-12 z-20 hidden lg:flex items-center gap-8">
      <a href="#fitur" class="text-slate-300 hover:text-white text-sm font-medium transition-colors">Fitur</a>
      <a href="#usecase" class="text-slate-300 hover:text-white text-sm font-medium transition-colors">Use Case</a>
      <a href="#analitik" class="text-slate-300 hover:text-white text-sm font-medium transition-colors">Analitik Data</a>
    </nav>

    <!-- Left Column (Light Card + Slate Card) -->
    <div class="lg:col-span-7 flex flex-col gap-6">
      
      <!-- Light Card -->
      <div class="bg-white rounded-[2rem] p-8 md:p-12 flex-1 relative z-10 flex flex-col justify-center">
        <!-- Header -->
        <div class="flex justify-between items-center mb-12 relative">
          <div class="flex items-center gap-2">
            <div class="bg-blue-600 p-2 rounded-lg">
              <i data-lucide="headphones" class="h-6 w-6 text-white"></i>
            </div>
            <span class="font-bold text-2xl tracking-tight text-slate-800 font-serif">OmniServe</span>
          </div>
          
          <!-- Pseudo-auth button popping out right side -->
          <div class="hidden lg:flex items-center shadow-xl rounded-full absolute right-[-4.5rem] z-30">
            <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-l-full font-medium transition-colors">Masuk</button>
            <button class="bg-blue-700 text-white p-3 rounded-r-full hover:bg-blue-800 transition-colors border-l border-blue-500"><i data-lucide="arrow-right" class="h-5 w-5"></i></button>
          </div>
        </div>

        <!-- Content -->
        <div class="max-w-xl">
          <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-50 text-blue-600 font-medium text-xs border border-blue-100 mb-6">
            <i data-lucide="zap" class="h-4 w-4"></i> <span>Platform Call Center Masa Depan</span>
          </div>
          
          <h1 class="text-4xl md:text-5xl lg:text-[52px] font-bold leading-[1.15] text-slate-900 mb-6 font-serif">
            Satu Layar untuk <br><span class="text-blue-600 font-sans font-semibold">Semua Saluran</span> Pelanggan.
          </h1>
          <p class="text-slate-600 mb-10 text-lg leading-relaxed max-w-md">
            Tingkatkan kepuasan pelanggan dan produktivitas tim yang menghubungkan suara, chat, email, dan sosmed dalam satu tempat.
          </p>

          <div class="flex flex-col sm:flex-row gap-4 mb-10">
            <button class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-full font-semibold transition-all shadow-lg shadow-blue-600/20 flex items-center justify-center gap-2">
              Mulai Gratis 14 Hari
            </button>
            <button class="bg-slate-100 hover:bg-slate-200 text-slate-700 px-8 py-4 rounded-full font-semibold transition-all">
              Jadwalkan Demo
            </button>
          </div>

          <div class="flex items-center gap-6 text-sm text-slate-500">
            <div class="flex items-center gap-2"><div class="bg-slate-900 rounded-full p-1"><i data-lucide="star" class="h-3 w-3 text-yellow-400 fill-yellow-400"></i></div> <span class="font-medium">Tanpa Kartu Kredit</span></div>
            <div class="flex items-center gap-2"><div class="bg-slate-900 rounded-full p-1"><i data-lucide="star" class="h-3 w-3 text-yellow-400 fill-yellow-400"></i></div> <span class="font-medium">Setup 5 Menit</span></div>
          </div>
        </div>
      </div>

      <!-- Slate Card (Bottom Left) -->
      <div class="bg-slate-800 rounded-[2rem] p-8 flex flex-col sm:flex-row justify-between items-center gap-6 lg:mr-[-8%] relative z-20 shadow-2xl">
        <div class="text-white min-w-max">
          <h2 class="font-serif text-3xl font-medium mb-1">Integrasi<br><em class="text-cyan-400 font-sans italic">Tanpa Batas</em></h2>
          <div class="flex gap-4 mt-4">
             <button class="bg-blue-600 hover:bg-blue-700 px-6 py-2.5 rounded-full text-sm font-medium transition-colors flex items-center gap-2">Pelajari Fitur <i data-lucide="arrow-right" class="h-4 w-4"></i></button>
          </div>
        </div>
        
        <div class="flex gap-3 overflow-x-auto w-full pb-2 sm:pb-0 scrollbar-hide">
          <div class="bg-slate-700/50 border border-slate-600 rounded-2xl p-4 flex flex-col items-center justify-center min-w-[85px] hover:bg-slate-700 transition-colors">
            <i data-lucide="phone" class="h-6 w-6 text-cyan-400 mb-2"></i>
            <span class="text-xs text-slate-300 font-medium">Telepon</span>
          </div>
          <div class="bg-slate-700/50 border border-slate-600 rounded-2xl p-4 flex flex-col items-center justify-center min-w-[85px] hover:bg-slate-700 transition-colors">
            <i data-lucide="message-circle" class="h-6 w-6 text-green-400 mb-2"></i>
            <span class="text-xs text-slate-300 font-medium">WhatsApp</span>
          </div>
          <div class="bg-slate-700/50 border border-slate-600 rounded-2xl p-4 flex flex-col items-center justify-center min-w-[85px] hover:bg-slate-700 transition-colors">
            <i data-lucide="instagram" class="h-6 w-6 text-pink-400 mb-2"></i>
            <span class="text-xs text-slate-300 font-medium">Instagram</span>
          </div>
          <div class="bg-slate-700/50 border border-slate-600 rounded-2xl p-4 flex flex-col items-center justify-center min-w-[85px] hover:bg-slate-700 transition-colors">
            <i data-lucide="mail" class="h-6 w-6 text-blue-400 mb-2"></i>
            <span class="text-xs text-slate-300 font-medium">Email</span>
          </div>
        </div>
      </div>

    </div>

    <!-- Right Column (Image) -->
    <div class="lg:col-span-5 relative z-10 rounded-[2rem] overflow-hidden min-h-[400px] lg:mt-24">
      <img src="https://images.unsplash.com/photo-1766066014237-00645c74e9c6?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxtb2Rlcm4lMjBjYWxsJTIwY2VudGVyJTIwYWdlbnQlMjB0YWxraW5nJTIwb24lMjBoZWFkc2V0fGVufDF8fHx8MTc3ODE0Njc3NXww&ixlib=rb-4.1.0&q=80&w=1080" class="absolute inset-0 w-full h-full object-cover" />
      <div class="absolute inset-0 bg-blue-900/10"></div>
      
      <div class="absolute top-1/2 left-8 -translate-y-1/2">
        <span class="text-white font-serif text-4xl lg:text-5xl shadow-sm drop-shadow-xl opacity-90">Omnichannel</span>
      </div>

      <div class="absolute bottom-6 left-6 right-6 bg-slate-900/60 backdrop-blur-md border border-white/10 rounded-2xl p-5 text-white shadow-xl">
        <div class="flex items-center gap-3 mb-2">
          <div class="bg-cyan-500 p-2 rounded-full shadow-lg shadow-cyan-500/20"><i data-lucide="phone-call" class="h-4 w-4 text-white"></i></div>
          <h3 class="font-medium text-lg">Panggilan Masuk <span class="text-cyan-300 text-[10px] ml-2 border border-cyan-400/50 px-2 py-0.5 rounded-full uppercase tracking-wider">Live</span></h3>
        </div>
        <p class="text-sm text-white/90">Budi Santoso - Keluhan Produk <br><span class="text-xs opacity-70">Menunggu antrean (0:45)</span></p>
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
