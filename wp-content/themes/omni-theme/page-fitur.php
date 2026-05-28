<?php
/**
 * Template Name: Fitur OmniServe
 * SEO: omnichannel kabayan, call center kabayan, sewa omnichannel, layanan omnichannel call center
 */

// Override SEO meta for this virtual page
add_filter('pre_get_document_title', function() {
    return 'Fitur Lengkap Omnichannel & Call Center Kabayan | Sewa Layanan Call Center Pemerintah';
}, 99);
add_action('wp_head', function() {
    echo '<meta name="description" content="Fitur lengkap platform omnichannel call center Kabayan: WhatsApp Blue Tick, PSTN, Bot FAQ, Unlimited Agent, Voice Recording & API Integrasi. Solusi sewa call center pemerintah dan bisnis terpercaya.">' . "\n";
    echo '<meta name="keywords" content="omnichannel kabayan, call center kabayan, sewa omnichannel, sewa call center, layanan omnichannel call center, call center pemerintah, omnichannel pemerintah, fitur call center, whatsapp business call center">' . "\n";
    echo '<meta property="og:title" content="Fitur Lengkap Omnichannel & Call Center Kabayan">' . "\n";
    echo '<meta property="og:description" content="Sewa layanan omnichannel call center lengkap: WhatsApp Blue Tick, PSTN, Bot FAQ, Unlimited Agent. Terpercaya untuk pemerintah & korporasi.">' . "\n";
    echo '<meta property="og:type" content="website">' . "\n";
    echo '<link rel="canonical" href="' . esc_url(home_url('/fitur')) . '">' . "\n";
    // Preload LCP hero image (WebP) agar LCP turun signifikan
    echo '<link rel="preload" as="image" href="' . get_template_directory_uri() . '/assets/img/fitur-hero-updated.webp" type="image/webp">' . "\n";
    // Custom style: hero-wrap menutup area putih di bawah SVG wave
    echo '<style>
      .hero-wrap { position: relative; }
      .hero-wrap .hero-svg-boundary { position: absolute; bottom: 0; left: 0; width: 100%; line-height: 0; z-index: 20; pointer-events: none; }
      .hero-wrap .hero-svg-boundary svg { display: block; width: 100%; }
      .hero-illustration-container { position: relative; z-index: 10; margin-top: 0; }
    </style>' . "\n";
}, 5);
?>
<?php get_header(); ?>

<div class="flex-1 bg-white w-full">

  <!-- Hero Section + Illustration dalam satu wrapper untuk zero-gap -->
  <div class="-mt-20 md:-mt-32 pt-40 md:pt-52 hero-wrap" style="background-color: #f1f5f9;">
    <div class="max-w-7xl mx-auto px-6 text-center relative z-10" style="padding-bottom: 100px;">
      <div class="inline-flex items-center gap-2 bg-omni-dark/10 text-omni-button-hover px-4 py-2 rounded-full text-sm font-semibold mb-6">
        <i data-lucide="zap" class="h-4 w-4"></i>
        Platform Omnichannel Terpadu
      </div>
      <h1 class="text-4xl md:text-5xl font-bold text-omni-dark mb-6 leading-tight">
        Semua Fitur yang Anda Butuhkan,<br><span class="text-omni-button-hover">dalam Satu Platform</span>
      </h1>
      <p class="text-omni-text-muted text-lg md:text-xl max-w-2xl mx-auto">
        Dari WhatsApp Verified Blue Tick hingga integrasi telepon PSTN &mdash; OmniServe hadir dengan fitur lengkap yang siap meningkatkan performa tim customer service Anda.
      </p>
    </div>

    <!-- Hero Illustration + SVG overlay dalam satu container = zero gap -->
    <div class="hero-illustration-container w-full">
      <div class="hero-svg-boundary">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 3973.17 333.48" class="text-omni-dark h-[60px] md:h-auto" preserveAspectRatio="none" style="shape-rendering: geometricPrecision;">
          <path fill="#f1f5f9" d="M3973.17 333.48 L3973.17 0 L0 0 L0 0.01 l2872.96 0 0 0.03 c30.48,-0.66 56.16,6.9 77.49,19.45 25.33,14.9 44.35,36.72 57.92,60.06 l82.35 134.74 c21.74,29.59 48.64,56.5 79.27,75.14 26.25,15.98 55.24,25.88 86.03,26.08 l0 -0.03 717.15 0 Z" />
          <path fill="currentColor" d="M0 0.01l2872.96 0 0 0.03c30.48,-0.66 56.16,6.9 77.49,19.45 25.33,14.9 44.35,36.72 57.92,60.06l82.35 134.74c21.74,29.59 48.64,56.5 79.27,75.14 26.25,15.98 55.24,25.88 86.03,26.08l0 -0.03 717.15 0 0 18 -717.15 0 -0.03 -0.03c-34.38,-0.22 -66.48,-11.11 -95.36,-28.68 -32.86,-20 -61.55,-48.7 -84.61,-80.14l-0.42 -0.63 -82.73 -135.38c-12.18,-20.97 -29.12,-40.5 -51.49,-53.66 -18.67,-10.99 -41.27,-17.6 -68.25,-16.98l-0.17 0.03 -2872.96 0 0 -18z"/>
          <path class="svg-glow-path-wide" pathLength="100" d="M0 0.01 l2872.96 0 0 0.03 c30.48,-0.66 56.16,6.9 77.49,19.45 25.33,14.9 44.35,36.72 57.92,60.06 l82.35 134.74 c21.74,29.59 48.64,56.5 79.27,75.14 26.25,15.98 55.24,25.88 86.03,26.08 l0 -0.03 717.15 0"/>
          <path class="svg-glow-path" pathLength="100" d="M0 0.01 l2872.96 0 0 0.03 c30.48,-0.66 56.16,6.9 77.49,19.45 25.33,14.9 44.35,36.72 57.92,60.06 l82.35 134.74 c21.74,29.59 48.64,56.5 79.27,75.14 26.25,15.98 55.24,25.88 86.03,26.08 l0 -0.03 717.15 0"/>
        </svg>
      </div>
      <picture>
        <source srcset="<?php echo get_template_directory_uri(); ?>/assets/img/fitur-hero-updated.webp" type="image/webp">
        <img
          src="<?php echo get_template_directory_uri(); ?>/assets/img/fitur-hero-updated.png"
          alt="Dashboard omnichannel call center Kabayan — WhatsApp, Instagram, PSTN dalam satu inbox terpadu"
          width="1886" height="834"
          class="w-full h-auto block"
          fetchpriority="high"
          loading="eager"
          decoding="async"
        >
      </picture>
    </div>
  </div>

  <!-- Feature Group 1: Kanal Komunikasi -->
  <section class="py-20 border-b border-omni-border">
    <div class="max-w-7xl mx-auto px-6">
      <div class="flex flex-col md:flex-row gap-12 items-center">
        <div class="md:w-1/2">
          <div class="inline-flex items-center gap-2 bg-omni-light text-omni-button-hover px-3 py-1.5 rounded-full text-xs font-bold mb-4">
            <i data-lucide="message-square" class="h-3.5 w-3.5"></i>
            Kanal Komunikasi
          </div>
          <h2 class="text-3xl font-bold text-omni-dark mb-4">WhatsApp, Instagram & Telepon PSTN dalam Satu Inbox</h2>
          <p class="text-omni-text-muted leading-relaxed mb-6">
            Semua pesan masuk dari berbagai kanal terkumpul di satu dashboard. Agen tidak perlu berpindah aplikasi. Paket Standard mencakup WhatsApp Verified Blue Tick & Instagram, sedangkan Professional Plus menambahkan saluran Telepon (PSTN) dengan nomor lokal 021.
          </p>
          <ul class="space-y-3">
            <li class="flex items-center gap-3 text-sm font-medium text-omni-dark">
              <i data-lucide="check-circle" class="h-5 w-5 text-omni-secondary shrink-0"></i>
              WhatsApp Business API — Centang Biru Terverifikasi
            </li>
            <li class="flex items-center gap-3 text-sm font-medium text-omni-dark">
              <i data-lucide="check-circle" class="h-5 w-5 text-omni-secondary shrink-0"></i>
              Instagram Direct Message terintegrasi
            </li>
            <li class="flex items-center gap-3 text-sm font-medium text-omni-dark">
              <i data-lucide="check-circle" class="h-5 w-5 text-omni-secondary shrink-0"></i>
              Telepon PSTN & Nomor Lokal 021 (Paket Pro+)
            </li>
          </ul>
        </div>
        <div class="md:w-1/2 grid grid-cols-2 gap-4">
          <div class="bg-omni-light rounded-2xl p-6 border border-omni-border text-center">
            <i data-lucide="message-circle" class="h-10 w-10 text-[#25D366] mx-auto mb-3"></i>
            <p class="font-bold text-omni-dark text-sm">WhatsApp</p>
            <p class="text-xs text-omni-text-muted mt-1">Blue Tick Verified</p>
          </div>
          <div class="bg-omni-light rounded-2xl p-6 border border-omni-border text-center">
            <svg class="h-10 w-10 mx-auto mb-3" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <defs>
                <radialGradient id="ig-grad-fitur" cx="30%" cy="107%" r="150%">
                  <stop offset="0%" stop-color="#fdf497"/>
                  <stop offset="5%" stop-color="#fdf497"/>
                  <stop offset="45%" stop-color="#fd5949"/>
                  <stop offset="60%" stop-color="#d6249f"/>
                  <stop offset="90%" stop-color="#285AEB"/>
                </radialGradient>
              </defs>
              <rect x="2" y="2" width="20" height="20" rx="5" ry="5" fill="url(#ig-grad-fitur)"/>
              <circle cx="12" cy="12" r="4.5" fill="none" stroke="white" stroke-width="1.8"/>
              <circle cx="17.5" cy="6.5" r="1.2" fill="white"/>
            </svg>
            <p class="font-bold text-omni-dark text-sm">Instagram</p>
            <p class="text-xs text-omni-text-muted mt-1">Direct Message</p>
          </div>
          <div class="bg-omni-dark rounded-2xl p-6 border-2 border-omni-accent text-center col-span-2">
            <i data-lucide="phone-call" class="h-10 w-10 text-omni-accent mx-auto mb-3"></i>
            <p class="font-bold text-white text-sm">Telepon PSTN</p>
            <p class="text-xs text-omni-accent mt-1">Nomor 021 — Paket Professional Plus</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Feature Group 2: Otomatisasi & Bot -->
  <section class="py-20 bg-omni-light border-b border-omni-border">
    <div class="max-w-7xl mx-auto px-6">
      <div class="flex flex-col md:flex-row-reverse gap-12 items-center">
        <div class="md:w-1/2">
          <div class="inline-flex items-center gap-2 bg-omni-light text-omni-button-hover px-3 py-1.5 rounded-full text-xs font-bold mb-4">
            <i data-lucide="bot" class="h-3.5 w-3.5"></i>
            Fitur Cerdas
          </div>
          <h2 class="text-3xl font-bold text-omni-dark mb-4">Chatbot Cerdas dengan FAQ Database & Multilevel Menu</h2>
          <p class="text-omni-text-muted leading-relaxed mb-6">
            Tersedia di semua paket. Bot kami mampu menangani pertanyaan umum secara otomatis menggunakan FAQ Database yang bisa Anda kelola sendiri, serta memandu pelanggan melalui Multilevel Menu interaktif — tanpa perlu campur tangan agen.
          </p>
          <ul class="space-y-3">
            <li class="flex items-center gap-3 text-sm font-medium text-omni-dark">
              <i data-lucide="check-circle" class="h-5 w-5 text-omni-secondary shrink-0"></i>
              FAQ Database yang mudah dikelola tim Anda
            </li>
            <li class="flex items-center gap-3 text-sm font-medium text-omni-dark">
              <i data-lucide="check-circle" class="h-5 w-5 text-omni-secondary shrink-0"></i>
              Multilevel Menu interaktif untuk panduan pelanggan
            </li>
            <li class="flex items-center gap-3 text-sm font-medium text-omni-dark">
              <i data-lucide="check-circle" class="h-5 w-5 text-omni-secondary shrink-0"></i>
              Handover otomatis ke agen manusia saat dibutuhkan
            </li>
          </ul>
        </div>
        <div class="md:w-1/2">
          <div class="bg-white rounded-3xl p-8 border border-omni-border shadow-lg">
            <div class="flex items-center gap-3 mb-6">
              <div class="bg-omni-light p-2.5 rounded-xl"><i data-lucide="bot" class="h-6 w-6 text-omni-secondary"></i></div>
              <div>
                <p class="font-bold text-omni-dark text-sm">OmniBot — FAQ Auto-Reply</p>
                <p class="text-xs text-omni-text-muted">Aktif 24/7 di semua kanal</p>
              </div>
            </div>
            <div class="space-y-3">
              <div class="bg-omni-light rounded-xl p-3 text-sm text-omni-dark">📦 Pilih menu: <strong>1</strong> - Status Order | <strong>2</strong> - Pengembalian | <strong>3</strong> - Promo</div>
              <div class="bg-omni-light rounded-xl p-3 text-sm text-omni-text-muted ml-4">Pelanggan ketik: <strong>1</strong></div>
              <div class="bg-omni-light rounded-xl p-3 text-sm text-omni-dark">✅ Order #1234 sedang dalam pengiriman. Estimasi tiba: <strong>Besok, 08:00</strong></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Feature Group 3: Manajemen Agen -->
  <section class="py-20 border-b border-omni-border">
    <div class="max-w-7xl mx-auto px-6">
      <div class="text-center mb-14">
        <div class="inline-flex items-center gap-2 bg-omni-light text-omni-button-hover px-3 py-1.5 rounded-full text-xs font-bold mb-4">
          <i data-lucide="users" class="h-3.5 w-3.5"></i>
          Manajemen Agen
        </div>
        <h2 class="text-3xl font-bold text-omni-dark mb-4">Kelola Tim Anda dengan Presisi</h2>
        <p class="text-omni-text-muted max-w-2xl mx-auto">Distribusikan beban kerja secara merata. Pantau performa secara real-time. Pastikan setiap pelanggan dilayani oleh agen yang paling tepat.</p>
      </div>
      <div class="grid md:grid-cols-3 gap-6">
        <?php
        $agent_features = [
          ['icon' => 'users', 'title' => 'Unlimited Agent', 'desc' => 'Paket Standard mendukung jumlah agen tak terbatas. Tidak ada biaya tambahan per kursi agen.', 'badge' => 'Standard & Pro+', 'highlight' => false],
          ['icon' => 'user-check', 'title' => 'Custom Agent Setup', 'desc' => 'Professional Plus hadir dengan 5 dedicated agent lines yang dikonfigurasi sesuai struktur tim Anda.', 'badge' => 'Professional Plus', 'highlight' => true],
          ['icon' => 'bar-chart-2', 'title' => 'Dashboard Monitoring', 'desc' => 'Supervisor dapat memantau status dan beban kerja semua agen secara real-time dari satu layar.', 'badge' => 'Professional Plus', 'highlight' => true],
        ];
        foreach ($agent_features as $f) :
        ?>
        <div class="<?php echo $f['highlight'] ? 'bg-omni-dark' : 'bg-omni-light'; ?> rounded-2xl p-8 border <?php echo $f['highlight'] ? 'border-omni-accent' : 'border-omni-border'; ?> hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
          <div class="<?php echo $f['highlight'] ? 'bg-omni-accent' : 'bg-white'; ?> w-14 h-14 rounded-xl shadow-sm flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
            <i data-lucide="<?php echo esc_attr($f['icon']); ?>" class="h-7 w-7 <?php echo $f['highlight'] ? 'text-white' : 'text-omni-accent'; ?>"></i>
          </div>
          <div class="inline-flex items-center gap-1 <?php echo $f['highlight'] ? 'bg-omni-accent/20 text-omni-accent' : 'bg-omni-light text-omni-button-hover'; ?> px-2.5 py-1 rounded-full text-xs font-bold mb-3">
            <?php echo esc_html($f['badge']); ?>
          </div>
          <h4 class="text-xl font-bold <?php echo $f['highlight'] ? 'text-white' : 'text-omni-dark'; ?> mb-3"><?php echo esc_html($f['title']); ?></h4>
          <p class="<?php echo $f['highlight'] ? 'text-white/70' : 'text-omni-text-muted'; ?> leading-relaxed text-sm"><?php echo esc_html($f['desc']); ?></p>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- Feature Group 4: API, Voice Recording, Laporan -->
  <section class="py-20 bg-omni-light border-b border-omni-border">
    <div class="max-w-7xl mx-auto px-6">
      <div class="text-center mb-14">
        <div class="inline-flex items-center gap-2 bg-omni-light text-omni-button-hover px-3 py-1.5 rounded-full text-xs font-bold mb-4">
          <i data-lucide="code-2" class="h-3.5 w-3.5"></i>
          Fitur Khusus & Integrasi
        </div>
        <h2 class="text-3xl font-bold text-omni-dark mb-4">Powerful di Balik Layar</h2>
        <p class="text-omni-text-muted max-w-2xl mx-auto">Fitur-fitur teknis yang mendukung operasional skala besar dan integrasi dengan sistem existing Anda.</p>
      </div>
      <div class="grid md:grid-cols-2 gap-8">
        <?php
        $tech_features = [
          ['icon' => 'code-2', 'title' => 'API Integrasi Custom', 'desc' => 'Hubungkan OmniServe dengan CRM, ERP, atau sistem internal bisnis Anda menggunakan REST API yang fleksibel dan terdokumentasi dengan baik.', 'badge' => 'Semua Paket'],
          ['icon' => 'mic', 'title' => 'Voice Call Recording', 'desc' => 'Rekam semua panggilan telepon secara otomatis untuk kebutuhan QA, pelatihan agen, dan perlindungan hukum. Tersedia di Paket Professional Plus.', 'badge' => 'Professional Plus'],
          ['icon' => 'file-text', 'title' => 'Laporan Bulanan Tercetak', 'desc' => 'Terima laporan performa bulanan dalam format dokumen siap cetak (PDF/Buku). Ideal untuk presentasi manajemen dan pelaporan KPI internal.', 'badge' => 'Paket Standard'],
          ['icon' => 'bar-chart-2', 'title' => 'Dashboard Analytics Real-Time', 'desc' => 'Pantau volume pesan, waktu respons rata-rata, tingkat resolusi, dan tren harian langsung dari dashboard berbasis data yang terus diperbarui.', 'badge' => 'Professional Plus'],
        ];
        foreach ($tech_features as $f) :
        ?>
        <div class="bg-white rounded-2xl p-8 border border-omni-border hover:shadow-xl hover:border-omni-secondary hover:-translate-y-1 transition-all duration-300 group flex gap-6">
          <div class="bg-omni-light w-14 h-14 rounded-xl flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
            <i data-lucide="<?php echo esc_attr($f['icon']); ?>" class="h-7 w-7 text-omni-secondary"></i>
          </div>
          <div>
            <div class="inline-flex items-center gap-1 bg-omni-light text-omni-button-hover px-2.5 py-1 rounded-full text-xs font-bold mb-3">
              <?php echo esc_html($f['badge']); ?>
            </div>
            <h4 class="text-xl font-bold text-omni-dark mb-3"><?php echo esc_html($f['title']); ?></h4>
            <p class="text-omni-text-muted leading-relaxed text-sm"><?php echo esc_html($f['desc']); ?></p>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- Feature Group 5: Support & Hosting -->
  <section class="py-20 border-b border-omni-border">
    <div class="max-w-7xl mx-auto px-6">
      <div class="flex flex-col md:flex-row gap-12 items-center">
        <div class="md:w-1/2">
          <div class="inline-flex items-center gap-2 bg-omni-light text-omni-button-hover px-3 py-1.5 rounded-full text-xs font-bold mb-4">
            <i data-lucide="headphones" class="h-3.5 w-3.5"></i>
            Layanan & Support
          </div>
          <h2 class="text-3xl font-bold text-omni-dark mb-4">Dukungan Penuh, Tidak Sendirian</h2>
          <p class="text-omni-text-muted leading-relaxed mb-6">
            Kami tidak hanya menyediakan platform — kami juga mendampingi operasional Anda. Semua paket sudah termasuk helpdesk via WhatsApp Group dan infrastruktur Cloud Server yang dikelola sepenuhnya oleh tim teknis kami.
          </p>
          <ul class="space-y-4">
            <li class="flex items-start gap-3">
              <div class="bg-omni-light p-2 rounded-lg shrink-0 mt-0.5"><i data-lucide="message-circle" class="h-5 w-5 text-omni-secondary"></i></div>
              <div>
                <p class="font-bold text-omni-dark text-sm">Helpdesk via WA Group</p>
                <p class="text-xs text-omni-text-muted">Tim support kami siap merespons laporan dan pertanyaan operasional Anda.</p>
              </div>
            </li>
            <li class="flex items-start gap-3">
              <div class="bg-omni-light p-2 rounded-lg shrink-0 mt-0.5"><i data-lucide="server" class="h-5 w-5 text-omni-secondary"></i></div>
              <div>
                <p class="font-bold text-omni-dark text-sm">Cloud Server Terkelola</p>
                <p class="text-xs text-omni-text-muted">Tidak perlu khawatir soal infrastruktur. Server kami skalabel dan dimonitor 24/7.</p>
              </div>
            </li>
            <li class="flex items-start gap-3">
              <div class="bg-omni-light p-2 rounded-lg shrink-0 mt-0.5"><i data-lucide="shield-check" class="h-5 w-5 text-omni-secondary"></i></div>
              <div>
                <p class="font-bold text-omni-dark text-sm">Tanpa Biaya Tersembunyi</p>
                <p class="text-xs text-omni-text-muted">Harga transparan, semua sudah termasuk dalam paket yang Anda pilih.</p>
              </div>
            </li>
          </ul>
        </div>
        <div class="md:w-1/2 grid grid-cols-1 gap-4">
          <div class="bg-omni-dark rounded-2xl p-6 flex items-center gap-4">
            <div class="bg-omni-accent/20 p-3 rounded-xl shrink-0"><i data-lucide="infinity" class="h-8 w-8 text-omni-accent"></i></div>
            <div>
              <p class="text-white font-bold">Unlimited Interaction</p>
              <p class="text-white/60 text-sm">Paket Standard — Tidak ada batasan volume pesan masuk.</p>
            </div>
          </div>
          <div class="bg-omni-dark rounded-2xl p-6 flex items-center gap-4">
            <div class="bg-omni-accent/20 p-3 rounded-xl shrink-0"><i data-lucide="mail-check" class="h-8 w-8 text-omni-accent"></i></div>
            <div>
              <p class="text-white font-bold">6.000 Pesan/Bulan + Rollover</p>
              <p class="text-white/60 text-sm">Paket Pro+ — Sisa kuota diakumulasi ke bulan berikutnya.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA Bottom -->
  <section class="py-20 bg-omni-dark text-white text-center px-6">
    <h2 class="text-3xl md:text-4xl font-bold mb-4 text-omni-light">Siap Memilih Paket yang Tepat?</h2>
    <p class="text-white/70 max-w-2xl mx-auto mb-10">
      Bandingkan fitur Standard dan Professional Plus, atau konsultasikan kebutuhan custom Anda langsung dengan tim kami.
    </p>
    <div class="flex flex-col sm:flex-row gap-4 justify-center">
      <a href="<?php echo home_url('/harga'); ?>" class="inline-flex items-center gap-2 bg-omni-accent hover:bg-omni-accent-hover text-white font-bold py-4 px-8 rounded-full transition-all shadow-lg hover:-translate-y-1">
        <i data-lucide="layers" class="h-5 w-5"></i>
        Lihat Paket & Harga
      </a>
      <a href="<?php echo home_url('/'); ?>?demo=1" onclick="document.getElementById('demo-modal')?.classList.remove('hidden'); return false;"
         class="inline-flex items-center gap-2 bg-white/10 hover:bg-white/20 text-white font-bold py-4 px-8 rounded-full transition-all border border-white/20">
        <i data-lucide="calendar" class="h-5 w-5"></i>
        Jadwalkan Demo Gratis
      </a>
    </div>
  </section>

</div>

</main>

<?php get_footer(); ?>
