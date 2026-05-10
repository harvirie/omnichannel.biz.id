<?php get_header(); ?>

<div class="flex-1 bg-white w-full">

  <!-- Hero Header -->
  <div class="py-20 text-center max-w-3xl mx-auto px-6">
    <div class="inline-flex items-center gap-2 bg-omni-dark/10 text-omni-button-hover px-4 py-2 rounded-full text-sm font-semibold mb-6">
      <i data-lucide="shield-check" class="h-4 w-4"></i>
      Harga Resmi & Transparan
    </div>
    <h1 class="text-4xl md:text-5xl font-bold text-omni-dark mb-6 leading-tight">
      Pilih Paket Sesuai <span class="text-omni-secondary">Kebutuhan Bisnis</span> Anda
    </h1>
    <p class="text-omni-text-muted text-lg leading-relaxed">
      Solusi call center omnichannel profesional dengan harga transparan.<br>
      Tanpa biaya tersembunyi. Dukungan penuh dari tim kami.
    </p>
  </div>

  <!-- Pricing Cards -->
  <div class="max-w-6xl mx-auto px-6 pb-24">
    <div class="grid md:grid-cols-2 gap-8 items-stretch">

      <!-- ===== PAKET STANDARD ===== -->
      <div class="bg-white rounded-3xl p-8 border border-omni-border shadow-lg flex flex-col group hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">
        <div class="mb-6">
          <div class="inline-flex items-center gap-2 bg-omni-light text-omni-button-hover px-3 py-1.5 rounded-full text-xs font-bold mb-4">
            <i data-lucide="layers" class="h-3.5 w-3.5"></i>
            Paket Standard
          </div>
          <h2 class="text-3xl font-extrabold text-omni-dark mb-2">Paket Standard</h2>
          <p class="text-omni-text-muted text-sm leading-relaxed">
            Cocok untuk kebutuhan operasional rutin dan efisiensi administratif.
          </p>
        </div>

        <!-- Price -->
        <div class="bg-omni-light rounded-2xl p-5 mb-6">
          <div class="flex items-end gap-2 mb-1">
            <span class="text-3xl md:text-4xl font-extrabold text-omni-dark">Rp 6.882.000</span>
            <span class="text-omni-text-muted font-medium mb-1">/Bulan*</span>
          </div>
          <p class="text-sm text-omni-secondary font-semibold">Total: Rp 48.174.500</p>
          <p class="text-xs text-omni-text-muted mt-1">minimal 6 bulan berlangganan</p>
        </div>

        <!-- Features Table -->
        <ul class="space-y-3 mb-8 flex-1">
          <?php
          $standard_features = [
            ['label' => 'Kanal Komunikasi',   'value' => 'WhatsApp (Verified Blue Tick) & Instagram',   'icon' => 'message-square'],
            ['label' => 'Kapasitas Pesan',    'value' => 'Unlimited Interaction',                        'icon' => 'infinity'],
            ['label' => 'Fitur Cerdas',       'value' => 'FAQ Database & Multilevel Menu (Bot)',          'icon' => 'bot'],
            ['label' => 'Manajemen Agen',     'value' => 'Unlimited Agent',                              'icon' => 'users'],
            ['label' => 'Fitur Khusus',       'value' => 'API Integrasi Custom',                         'icon' => 'code-2'],
            ['label' => 'Layanan & Support',  'value' => 'Helpdesk via WA Group & Cloud Server',         'icon' => 'headphones'],
            ['label' => 'Laporan',            'value' => 'Dokumen Laporan Bulanan (Cetak/Buku)',          'icon' => 'file-text'],
          ];
          foreach ($standard_features as $f) : ?>
          <li class="flex items-start gap-3 p-3 rounded-xl hover:bg-omni-light/50 transition-colors">
            <div class="bg-omni-light p-1.5 rounded-lg shrink-0 mt-0.5">
              <i data-lucide="<?php echo $f['icon']; ?>" class="h-4 w-4 text-omni-secondary"></i>
            </div>
            <div class="flex-1 min-w-0">
              <span class="block text-xs font-semibold text-omni-text-muted uppercase tracking-wide"><?php echo esc_html($f['label']); ?></span>
              <span class="block text-sm font-medium text-omni-dark"><?php echo esc_html($f['value']); ?></span>
            </div>
          </li>
          <?php endforeach; ?>
        </ul>

        <a href="<?php echo home_url('/'); ?>?demo=1" onclick="document.getElementById('demo-modal')?.classList.remove('hidden'); return false;"
           class="w-full py-4 rounded-xl font-bold text-center transition-all bg-omni-light text-omni-button-hover hover:bg-omni-border border border-omni-border flex items-center justify-center gap-2">
          <i data-lucide="calendar" class="h-5 w-5"></i>
          Mulai Demo Gratis
        </a>
      </div>

      <!-- ===== PAKET PROFESSIONAL PLUS ===== -->
      <div class="bg-omni-dark rounded-3xl p-8 border-2 border-omni-accent shadow-2xl flex flex-col relative group hover:shadow-[0_30px_80px_rgba(212,175,55,0.3)] hover:-translate-y-1 transition-all duration-300" style="filter: drop-shadow(-6px 6px 0px #D4AF37);">
        <!-- Badge -->
        <div class="absolute -top-4 left-1/2 transform -translate-x-1/2 bg-omni-accent text-white px-5 py-1.5 rounded-full text-sm font-bold shadow-lg whitespace-nowrap flex items-center gap-2">
          <i data-lucide="star" class="h-3.5 w-3.5 fill-white"></i>
          Paling Direkomendasikan
        </div>

        <div class="mb-6 mt-2">
          <div class="inline-flex items-center gap-2 bg-white/10 text-omni-accent px-3 py-1.5 rounded-full text-xs font-bold mb-4">
            <i data-lucide="zap" class="h-3.5 w-3.5"></i>
            Paket Professional Plus
          </div>
          <h2 class="text-3xl font-extrabold text-white mb-2">Professional Plus</h2>
          <p class="text-white/70 text-sm leading-relaxed">
            Solusi lengkap untuk volume trafik tinggi & integrasi telepon.
          </p>
        </div>

        <!-- Price -->
        <div class="bg-white/10 border border-white/20 rounded-2xl p-5 mb-6">
          <div class="flex items-end gap-2 mb-1">
            <span class="text-3xl md:text-4xl font-extrabold text-omni-accent">Rp 13.875.000</span>
            <span class="text-white/70 font-medium mb-1">/Bulan*</span>
          </div>
          <p class="text-sm text-omni-accent font-semibold">Total: Rp 166.500.000</p>
          <p class="text-xs text-white/60 mt-1">minimal 12 bulan berlangganan</p>
        </div>

        <!-- Features Table -->
        <ul class="space-y-3 mb-8 flex-1">
          <?php
          $pro_features = [
            ['label' => 'Kanal Komunikasi',   'value' => 'WhatsApp (Verified Blue Tick), Instagram & Telepon (PSTN)',    'icon' => 'phone-call',  'highlight' => true],
            ['label' => 'Kapasitas Pesan',    'value' => '6.000 Pesan Masuk/Bulan (Sistem Akumulasi/Rollover)',           'icon' => 'mail-check',  'highlight' => true],
            ['label' => 'Fitur Cerdas',       'value' => 'FAQ Database & Multilevel Menu (Bot)',                          'icon' => 'bot',         'highlight' => false],
            ['label' => 'Manajemen Agen',     'value' => 'Custom Agent Setup (5 dedicated agent lines)',                  'icon' => 'user-check',  'highlight' => true],
            ['label' => 'Fitur Khusus',       'value' => 'Voice Call Recording & Sistem Nomor Lokal (021)',               'icon' => 'mic',         'highlight' => true],
            ['label' => 'Layanan & Support',  'value' => 'Helpdesk via WA Group & Cloud Server',                         'icon' => 'headphones',  'highlight' => false],
            ['label' => 'Laporan',            'value' => 'Dashboard Monitoring & Analytics',                              'icon' => 'bar-chart-2', 'highlight' => true],
          ];
          foreach ($pro_features as $f) : ?>
          <li class="flex items-start gap-3 p-3 rounded-xl <?php echo $f['highlight'] ? 'bg-white/10' : 'hover:bg-white/5'; ?> transition-colors">
            <div class="<?php echo $f['highlight'] ? 'bg-omni-accent' : 'bg-white/10'; ?> p-1.5 rounded-lg shrink-0 mt-0.5">
              <i data-lucide="<?php echo $f['icon']; ?>" class="h-4 w-4 <?php echo $f['highlight'] ? 'text-white' : 'text-omni-accent'; ?>"></i>
            </div>
            <div class="flex-1 min-w-0">
              <span class="block text-xs font-semibold text-white/50 uppercase tracking-wide"><?php echo esc_html($f['label']); ?></span>
              <span class="block text-sm font-medium <?php echo $f['highlight'] ? 'text-omni-accent' : 'text-white'; ?>"><?php echo esc_html($f['value']); ?></span>
            </div>
          </li>
          <?php endforeach; ?>
        </ul>

        <a href="<?php echo home_url('/'); ?>?demo=1" onclick="document.getElementById('demo-modal')?.classList.remove('hidden'); return false;"
           class="w-full py-4 rounded-xl font-bold text-center transition-all bg-omni-accent hover:bg-omni-accent-hover text-white flex items-center justify-center gap-2 shadow-lg hover:shadow-omni-accent/50">
          <i data-lucide="arrow-right" class="h-5 w-5"></i>
          Konsultasi & Demo Sekarang
        </a>
      </div>

    </div>

    <!-- Disclaimer -->
    <p class="text-center text-sm text-omni-text-muted mt-8 opacity-70">
      * Harga belum termasuk PPN. Syarat & ketentuan berlaku. Hubungi tim kami untuk penawaran custom sesuai kebutuhan instansi Anda.
    </p>
  </div>

  <!-- Bottom CTA -->
  <div class="bg-omni-dark py-16 text-center px-6">
    <h3 class="text-2xl md:text-3xl font-bold text-white mb-4">Butuh Paket <span class="text-omni-accent">Khusus untuk Instansi?</span></h3>
    <p class="text-white/60 mb-8 max-w-xl mx-auto">Kami melayani pengadaan resmi, integrasi sistem pemerintah, dan kebutuhan enterprise skala besar.</p>
    <a href="https://wa.me/6281283835553" target="_blank" rel="noopener noreferrer"
       class="inline-flex items-center gap-2 bg-omni-accent hover:bg-omni-accent-hover text-white font-bold py-4 px-8 rounded-full transition-all shadow-lg hover:-translate-y-1">
      <i data-lucide="phone" class="h-5 w-5"></i>
      Hubungi Tim Sales Kami
    </a>
  </div>

</div>

<?php get_footer(); ?>
