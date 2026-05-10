<?php
/**
 * Template Name: Use Case OmniServe
 * SEO: omnichannel pemerintah, call center pemerintah, sewa call center, layanan omnichannel call center kabayan
 */

// Override SEO meta for this virtual page
add_filter('pre_get_document_title', function() {
    return 'Studi Kasus Omnichannel & Call Center Pemerintah | Sewa Layanan Call Center Kabayan';
}, 99);
add_action('wp_head', function() {
    echo '<meta name="description" content="Lihat bagaimana layanan omnichannel call center Kabayan membantu e-commerce, perbankan, klinik, instansi pemerintah & korporasi B2B. Sewa call center omnichannel terpercaya untuk semua industri.">' . "\n";
    echo '<meta name="keywords" content="omnichannel pemerintah, call center pemerintah, sewa call center, sewa omni channel, layanan omnichannel call center, omnichannel kabayan, call center kabayan, use case omnichannel, call center instansi">' . "\n";
    echo '<meta property="og:title" content="Studi Kasus Omnichannel & Call Center Pemerintah | Kabayan">' . "\n";
    echo '<meta property="og:description" content="Solusi sewa omnichannel call center untuk pemerintah, perbankan, e-commerce, klinik, dan B2B. Terbukti meningkatkan kualitas layanan publik.">' . "\n";
    echo '<meta property="og:type" content="website">' . "\n";
    echo '<link rel="canonical" href="' . esc_url(home_url('/use-case')) . '">' . "\n";
    // Preload LCP hero image (WebP) agar LCP turun signifikan
    echo '<link rel="preload" as="image" href="' . get_template_directory_uri() . '/assets/img/usecase-hero.webp" type="image/webp">' . "\n";
}, 5);
?>
<?php get_header(); ?>

<div class="flex-1 bg-white w-full">

  <!-- Hero Header -->
  <div class="-mt-20 md:-mt-32 pt-40 md:pt-52 relative overflow-hidden" style="background-color: #f1f5f9;">
    <div class="max-w-7xl mx-auto px-6 text-center relative z-10" style="padding-bottom: 20px;">
      <div class="inline-flex items-center gap-2 bg-omni-dark/10 text-omni-button-hover px-4 py-2 rounded-full text-sm font-semibold mb-6">
        <i data-lucide="briefcase" class="h-4 w-4"></i>
        Solusi Nyata untuk Bisnis Nyata
      </div>
      <h1 class="text-4xl md:text-5xl font-bold text-omni-dark mb-6 leading-tight">
        Bagaimana OmniServe <span class="text-omni-button-hover">Mengubah Operasional</span><br>di Berbagai Industri
      </h1>
      <p class="text-omni-text-muted text-lg md:text-xl max-w-2xl mx-auto">
        Dari WhatsApp Unlimited hingga Telepon PSTN dengan Recording — pelajari bagaimana fitur-fitur nyata kami menyelesaikan tantangan nyata di lapangan.
      </p>
    </div>
    <!-- Background shapes -->
    <div class="absolute top-10 left-10 w-64 h-64 bg-omni-accent/10 rounded-full blur-3xl z-0"></div>
    <div class="absolute bottom-10 right-10 w-80 h-80 bg-omni-dark/5 rounded-full blur-3xl z-0"></div>
    
    <!-- Animated SVG Boundary Line -->
    <div class="w-full z-0 pointer-events-none" style="line-height: 0;">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 3973.17 333.48" class="text-omni-dark h-[60px] md:h-auto" preserveAspectRatio="none" style="display: block; width: 100%;">
        <!-- White filler below the curve to blend with the next section -->
        <path fill="#ffffff" d="M3973.17 333.48 l-717.15 0 -0.03 -0.03c-34.38,-0.22 -66.48,-11.11 -95.36,-28.68 -32.86,-20 -61.55,-48.7 -84.61,-80.14l-0.42 -0.63 -82.73 -135.38c-12.18,-20.97 -29.12,-40.5 -51.49,-53.66 -18.67,-10.99 -41.27,-17.6 -68.25,-16.98l-0.17 0.03 -2872.96 0 L0 400 L3973.17 400 Z" />
        
        <path fill="currentColor" d="M0 0.01l2872.96 0 0 0.03c30.48,-0.66 56.16,6.9 77.49,19.45 25.33,14.9 44.35,36.72 57.92,60.06l82.35 134.74c21.74,29.59 48.64,56.5 79.27,75.14 26.25,15.98 55.24,25.88 86.03,26.08l0 -0.03 717.15 0 0 18 -717.15 0 -0.03 -0.03c-34.38,-0.22 -66.48,-11.11 -95.36,-28.68 -32.86,-20 -61.55,-48.7 -84.61,-80.14l-0.42 -0.63 -82.73 -135.38c-12.18,-20.97 -29.12,-40.5 -51.49,-53.66 -18.67,-10.99 -41.27,-17.6 -68.25,-16.98l-0.17 0.03 -2872.96 0 0 -18z"/>
        <path class="svg-glow-path-wide" pathLength="100" d="M0 0.01 l2872.96 0 0 0.03 c30.48,-0.66 56.16,6.9 77.49,19.45 25.33,14.9 44.35,36.72 57.92,60.06 l82.35 134.74 c21.74,29.59 48.64,56.5 79.27,75.14 26.25,15.98 55.24,25.88 86.03,26.08 l0 -0.03 717.15 0"/>
        <path class="svg-glow-path" pathLength="100" d="M0 0.01 l2872.96 0 0 0.03 c30.48,-0.66 56.16,6.9 77.49,19.45 25.33,14.9 44.35,36.72 57.92,60.06 l82.35 134.74 c21.74,29.59 48.64,56.5 79.27,75.14 26.25,15.98 55.24,25.88 86.03,26.08 l0 -0.03 717.15 0"/>
      </svg>
    </div>
  </div>

  <!-- Use Case Hero Illustration — WebP dengan fallback PNG untuk LCP optimal -->
  <div class="max-w-5xl mx-auto px-6 mt-0 md:-mt-[60px] mb-8 relative z-10">
    <picture>
      <source
        srcset="<?php echo get_template_directory_uri(); ?>/assets/img/usecase-hero.webp"
        type="image/webp"
      >
      <img
        src="<?php echo get_template_directory_uri(); ?>/assets/img/usecase-hero.png"
        alt="Solusi omnichannel call center untuk berbagai industri: e-commerce, perbankan, klinik, pemerintah, dan B2B"
        width="1024" height="1024"
        class="w-full rounded-3xl shadow-2xl border border-omni-border object-cover"
        fetchpriority="high"
        loading="eager"
        decoding="async"
      >
    </picture>
  </div>

  <!-- Package Context Banner -->
  <div class="bg-omni-light border-b border-omni-border py-6">
    <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row gap-4 items-center justify-center md:justify-between">
      <p class="text-omni-text-muted text-sm font-medium text-center md:text-left">Setiap use case di bawah ini menunjukkan <strong class="text-omni-dark">fitur paket yang relevan</strong> untuk solusi tersebut.</p>
      <div class="flex items-center gap-4">
        <div class="flex items-center gap-2">
          <div class="w-3 h-3 rounded-full bg-omni-secondary"></div>
          <span class="text-xs font-semibold text-omni-dark">Paket Standard</span>
        </div>
        <div class="flex items-center gap-2">
          <div class="w-3 h-3 rounded-full bg-omni-accent"></div>
          <span class="text-xs font-semibold text-omni-dark">Paket Professional Plus</span>
        </div>
      </div>
    </div>
  </div>

  <!-- Use Cases Section -->
  <section class="py-20">
    <div class="max-w-7xl mx-auto px-6 space-y-10">

      <!-- E-Commerce -->
      <div class="bg-omni-light rounded-3xl p-8 md:p-10 border border-omni-border hover:shadow-xl transition-shadow duration-300">
        <div class="flex flex-col md:flex-row gap-8">
          <div class="shrink-0 bg-white p-4 rounded-2xl shadow-sm h-fit">
            <i data-lucide="shopping-bag" class="w-10 h-10 text-omni-accent"></i>
          </div>
          <div class="flex-1">
            <div class="flex flex-wrap items-center gap-3 mb-3">
              <h2 class="text-2xl font-bold text-omni-dark">E-Commerce & Ritel</h2>
              <span class="inline-flex items-center gap-1.5 bg-omni-secondary/20 text-omni-button-hover text-xs font-bold px-3 py-1 rounded-full">
                <div class="w-2 h-2 rounded-full bg-omni-secondary"></div>
                Cocok: Paket Standard
              </span>
            </div>
            <p class="text-omni-text-muted mb-6 leading-relaxed">
              Lonjakan pesan saat flash sale atau Harbolnas bisa ditangani tanpa menambah agen. Dengan <strong>WhatsApp Unlimited Interaction</strong>, tidak ada pesan yang terlewat meski ribuan order masuk dalam satu momen. Bot <strong>Multilevel Menu</strong> menangani cek status pengiriman secara otomatis.
            </p>
            <div class="grid sm:grid-cols-3 gap-4">
              <div class="bg-white rounded-xl p-4 border border-omni-border">
                <i data-lucide="infinity" class="h-5 w-5 text-omni-secondary mb-2"></i>
                <p class="text-xs font-bold text-omni-dark">Unlimited Interaction</p>
                <p class="text-xs text-omni-text-muted mt-1">Tanpa batas volume chat WhatsApp & Instagram.</p>
              </div>
              <div class="bg-white rounded-xl p-4 border border-omni-border">
                <i data-lucide="bot" class="h-5 w-5 text-omni-secondary mb-2"></i>
                <p class="text-xs font-bold text-omni-dark">FAQ & Multilevel Bot</p>
                <p class="text-xs text-omni-text-muted mt-1">Status order, retur, promo — dijawab otomatis.</p>
              </div>
              <div class="bg-white rounded-xl p-4 border border-omni-border">
                <i data-lucide="code-2" class="h-5 w-5 text-omni-secondary mb-2"></i>
                <p class="text-xs font-bold text-omni-dark">API Integrasi Custom</p>
                <p class="text-xs text-omni-text-muted mt-1">Hubungkan data pengiriman langsung ke chat agen.</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Financial Services -->
      <div class="bg-omni-light rounded-3xl p-8 md:p-10 border border-omni-border hover:shadow-xl transition-shadow duration-300">
        <div class="flex flex-col md:flex-row gap-8">
          <div class="shrink-0 bg-white p-4 rounded-2xl shadow-sm h-fit">
            <i data-lucide="building-2" class="w-10 h-10 text-omni-button-hover"></i>
          </div>
          <div class="flex-1">
            <div class="flex flex-wrap items-center gap-3 mb-3">
              <h2 class="text-2xl font-bold text-omni-dark">Layanan Keuangan & Perbankan</h2>
              <span class="inline-flex items-center gap-1.5 bg-omni-accent/20 text-omni-dark text-xs font-bold px-3 py-1 rounded-full">
                <div class="w-2 h-2 rounded-full bg-omni-accent"></div>
                Ideal: Paket Professional Plus
              </span>
            </div>
            <p class="text-omni-text-muted mb-6 leading-relaxed">
              Kepercayaan nasabah dibangun dari konsistensi pelayanan. <strong>Voice Call Recording</strong> memastikan setiap percakapan telepon terdokumentasi untuk kebutuhan audit dan kepatuhan. <strong>Dashboard Analytics</strong> membantu manajer operasional memantau performa tim secara real-time.
            </p>
            <div class="grid sm:grid-cols-3 gap-4">
              <div class="bg-white rounded-xl p-4 border border-omni-border">
                <i data-lucide="mic" class="h-5 w-5 text-omni-accent mb-2"></i>
                <p class="text-xs font-bold text-omni-dark">Voice Call Recording</p>
                <p class="text-xs text-omni-text-muted mt-1">Semua panggilan terekam untuk audit & kepatuhan.</p>
              </div>
              <div class="bg-white rounded-xl p-4 border border-omni-border">
                <i data-lucide="phone-call" class="h-5 w-5 text-omni-accent mb-2"></i>
                <p class="text-xs font-bold text-omni-dark">PSTN + Nomor 021</p>
                <p class="text-xs text-omni-text-muted mt-1">Tampil profesional dengan nomor lokal Jakarta.</p>
              </div>
              <div class="bg-white rounded-xl p-4 border border-omni-border">
                <i data-lucide="bar-chart-2" class="h-5 w-5 text-omni-accent mb-2"></i>
                <p class="text-xs font-bold text-omni-dark">Dashboard Analytics</p>
                <p class="text-xs text-omni-text-muted mt-1">Monitoring real-time untuk SLA dan KPI layanan.</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Healthcare -->
      <div class="bg-omni-light rounded-3xl p-8 md:p-10 border border-omni-border hover:shadow-xl transition-shadow duration-300">
        <div class="flex flex-col md:flex-row gap-8">
          <div class="shrink-0 bg-white p-4 rounded-2xl shadow-sm h-fit">
            <i data-lucide="stethoscope" class="w-10 h-10 text-omni-secondary"></i>
          </div>
          <div class="flex-1">
            <div class="flex flex-wrap items-center gap-3 mb-3">
              <h2 class="text-2xl font-bold text-omni-dark">Layanan Kesehatan & Klinik</h2>
              <span class="inline-flex items-center gap-1.5 bg-omni-secondary/20 text-omni-button-hover text-xs font-bold px-3 py-1 rounded-full">
                <div class="w-2 h-2 rounded-full bg-omni-secondary"></div>
                Cocok: Paket Standard
              </span>
            </div>
            <p class="text-omni-text-muted mb-6 leading-relaxed">
              Antrean telepon pasien tidak perlu panjang. Bot <strong>FAQ Database</strong> menjawab pertanyaan umum seputar jadwal dokter, prosedur pendaftaran, hingga estimasi biaya. Notifikasi pengingat janji temu dikirim otomatis via <strong>WhatsApp Blue Tick</strong> yang dipercaya pasien.
            </p>
            <div class="grid sm:grid-cols-3 gap-4">
              <div class="bg-white rounded-xl p-4 border border-omni-border">
                <i data-lucide="message-circle" class="h-5 w-5 text-omni-secondary mb-2"></i>
                <p class="text-xs font-bold text-omni-dark">WhatsApp Blue Tick</p>
                <p class="text-xs text-omni-text-muted mt-1">Notifikasi & pengingat dari nomor terverifikasi.</p>
              </div>
              <div class="bg-white rounded-xl p-4 border border-omni-border">
                <i data-lucide="bot" class="h-5 w-5 text-omni-secondary mb-2"></i>
                <p class="text-xs font-bold text-omni-dark">FAQ Database</p>
                <p class="text-xs text-omni-text-muted mt-1">Jawab otomatis info jadwal, biaya & prosedur.</p>
              </div>
              <div class="bg-white rounded-xl p-4 border border-omni-border">
                <i data-lucide="users" class="h-5 w-5 text-omni-secondary mb-2"></i>
                <p class="text-xs font-bold text-omni-dark">Unlimited Agent</p>
                <p class="text-xs text-omni-text-muted mt-1">Tambah petugas reservasi tanpa biaya ekstra.</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Government / Enterprise -->
      <div class="bg-omni-dark rounded-3xl p-8 md:p-10 border-2 border-omni-accent hover:shadow-[0_20px_60px_rgba(253,184,84,0.25)] transition-shadow duration-300">
        <div class="flex flex-col md:flex-row gap-8">
          <div class="shrink-0 bg-white/10 p-4 rounded-2xl h-fit">
            <i data-lucide="landmark" class="w-10 h-10 text-omni-accent"></i>
          </div>
          <div class="flex-1">
            <div class="flex flex-wrap items-center gap-3 mb-3">
              <h2 class="text-2xl font-bold text-white">Instansi Pemerintah & Korporasi</h2>
              <span class="inline-flex items-center gap-1.5 bg-omni-accent/20 text-omni-accent text-xs font-bold px-3 py-1 rounded-full">
                <div class="w-2 h-2 rounded-full bg-omni-accent"></div>
                Ideal: Paket Professional Plus
              </span>
            </div>
            <p class="text-white/70 mb-6 leading-relaxed">
              Layanan publik skala besar membutuhkan sistem yang andal dan terukur. <strong class="text-white">Custom Agent Setup</strong> dengan 5 dedicated lines memastikan distribusi beban yang terstruktur. <strong class="text-white">Laporan bulanan tercetak</strong> mendukung kebutuhan dokumentasi dan transparansi anggaran.
            </p>
            <div class="grid sm:grid-cols-3 gap-4">
              <div class="bg-white/10 rounded-xl p-4 border border-white/20">
                <i data-lucide="user-check" class="h-5 w-5 text-omni-accent mb-2"></i>
                <p class="text-xs font-bold text-white">Custom Agent Setup</p>
                <p class="text-xs text-white/60 mt-1">5 dedicated lines dikonfigurasi sesuai struktur Anda.</p>
              </div>
              <div class="bg-white/10 rounded-xl p-4 border border-white/20">
                <i data-lucide="file-text" class="h-5 w-5 text-omni-accent mb-2"></i>
                <p class="text-xs font-bold text-white">Laporan Bulanan Cetak</p>
                <p class="text-xs text-white/60 mt-1">Dokumentasi formal siap pakai untuk manajemen.</p>
              </div>
              <div class="bg-white/10 rounded-xl p-4 border border-white/20">
                <i data-lucide="server" class="h-5 w-5 text-omni-accent mb-2"></i>
                <p class="text-xs font-bold text-white">Cloud Server Terkelola</p>
                <p class="text-xs text-white/60 mt-1">Infrastruktur enterprise tanpa beban IT internal.</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- B2B / Agency -->
      <div class="bg-omni-light rounded-3xl p-8 md:p-10 border border-omni-border hover:shadow-xl transition-shadow duration-300">
        <div class="flex flex-col md:flex-row gap-8">
          <div class="shrink-0 bg-white p-4 rounded-2xl shadow-sm h-fit">
            <i data-lucide="briefcase" class="w-10 h-10 text-omni-dark"></i>
          </div>
          <div class="flex-1">
            <div class="flex flex-wrap items-center gap-3 mb-3">
              <h2 class="text-2xl font-bold text-omni-dark">Layanan B2B & Agensi Digital</h2>
              <span class="inline-flex items-center gap-1.5 bg-omni-secondary/20 text-omni-button-hover text-xs font-bold px-3 py-1 rounded-full">
                <div class="w-2 h-2 rounded-full bg-omni-secondary"></div>
                Cocok: Semua Paket
              </span>
            </div>
            <p class="text-omni-text-muted mb-6 leading-relaxed">
              Kelola komunikasi multi-klien dari satu platform. <strong>API Integrasi Custom</strong> memungkinkan koneksi ke berbagai CRM dan sistem tiket. <strong>Unlimited Agent</strong> di Paket Standard ideal untuk agensi yang terus berkembang tanpa khawatir biaya per kursi.
            </p>
            <div class="grid sm:grid-cols-3 gap-4">
              <div class="bg-white rounded-xl p-4 border border-omni-border">
                <i data-lucide="code-2" class="h-5 w-5 text-omni-secondary mb-2"></i>
                <p class="text-xs font-bold text-omni-dark">API Custom</p>
                <p class="text-xs text-omni-text-muted mt-1">Integrasi CRM & sistem tiket klien Anda.</p>
              </div>
              <div class="bg-white rounded-xl p-4 border border-omni-border">
                <i data-lucide="users" class="h-5 w-5 text-omni-secondary mb-2"></i>
                <p class="text-xs font-bold text-omni-dark">Unlimited Agent</p>
                <p class="text-xs text-omni-text-muted mt-1">Skalakan tim tanpa biaya tambahan per agen.</p>
              </div>
              <div class="bg-white rounded-xl p-4 border border-omni-border">
                <svg class="h-5 w-5 mb-2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <defs>
                    <radialGradient id="ig-grad-usecase" cx="30%" cy="107%" r="150%">
                      <stop offset="0%" stop-color="#fdf497"/>
                      <stop offset="45%" stop-color="#fd5949"/>
                      <stop offset="60%" stop-color="#d6249f"/>
                      <stop offset="90%" stop-color="#285AEB"/>
                    </radialGradient>
                  </defs>
                  <rect x="2" y="2" width="20" height="20" rx="5" ry="5" fill="url(#ig-grad-usecase)"/>
                  <circle cx="12" cy="12" r="4.5" fill="none" stroke="white" stroke-width="1.8"/>
                  <circle cx="17.5" cy="6.5" r="1.2" fill="white"/>
                </svg>
                <p class="text-xs font-bold text-omni-dark">WA + Instagram</p>
                <p class="text-xs text-omni-text-muted mt-1">Kelola semua akun sosial klien dari satu inbox.</p>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>

  <!-- Mini CTA -->
  <section class="bg-omni-dark py-16 text-center border-t border-omni-button-hover px-6">
    <h2 class="text-2xl md:text-3xl font-bold text-omni-light mb-4">Industri Anda Tidak Ada di Sini?</h2>
    <p class="text-white/60 max-w-xl mx-auto mb-8">
      Kami melayani berbagai jenis bisnis dan instansi. Konsultasikan kebutuhan spesifik Anda dan dapatkan rekomendasi paket yang paling efisien.
    </p>
    <div class="flex flex-col sm:flex-row gap-4 justify-center">
      <a href="<?php echo home_url('/'); ?>?demo=1" onclick="document.getElementById('demo-modal')?.classList.remove('hidden'); return false;"
         class="inline-flex items-center gap-2 bg-omni-accent hover:bg-omni-accent-hover text-white font-bold py-4 px-8 rounded-full transition-all shadow-lg hover:-translate-y-1">
        <i data-lucide="phone" class="h-5 w-5"></i>
        Konsultasi Gratis
      </a>
      <a href="<?php echo home_url('/harga'); ?>"
         class="inline-flex items-center gap-2 bg-white/10 hover:bg-white/20 text-white font-bold py-4 px-8 rounded-full transition-all border border-white/20">
        <i data-lucide="layers" class="h-5 w-5"></i>
        Lihat Paket & Harga
      </a>
    </div>
  </section>

</div>

<?php get_footer(); ?>
