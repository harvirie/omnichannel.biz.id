<?php get_header(); ?>

<div class="flex-1 bg-white w-full">
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
  <section class="py-24">
    <div class="max-w-7xl mx-auto px-6">
      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php
          $features = [
            [
              'icon' => 'globe',
              'title' => 'Integrasi Semua Channel',
              'description' => 'Telepon, WhatsApp, Instagram, Email, dan Live Chat dalam satu kotak masuk (inbox). Agen tidak perlu berpindah tab.'
            ],
            [
              'icon' => 'zap',
              'title' => 'Otomatisasi Cerdas (ACD)',
              'description' => 'Distribusikan tiket secara otomatis ke agen yang paling tepat berdasarkan keahlian atau beban kerja saat ini.'
            ],
            [
              'icon' => 'bar-chart-3',
              'title' => 'Laporan Siap Pakai',
              'description' => 'Hasilkan laporan kinerja harian, mingguan, hingga bulanan hanya dengan satu klik. Ekspor dalam PDF atau Excel.'
            ],
            [
              'icon' => 'shield-check',
              'title' => 'Keamanan Data Enterprise',
              'description' => 'Enkripsi end-to-end, kepatuhan GDPR, dan manajemen akses berbasis peran (RBAC) untuk melindungi data pelanggan.'
            ],
            [
              'icon' => 'message-square',
              'title' => 'Templat Balasan Cepat',
              'description' => 'Simpan jawaban untuk pertanyaan yang sering diajukan (FAQ) agar agen merespons lebih cepat dan konsisten.'
            ],
            [
              'icon' => 'headphones',
              'title' => 'Pemantauan Panggilan',
              'description' => 'Supervisor dapat mendengarkan panggilan secara real-time (barge-in) atau memberi arahan tersembunyi (whisper).'
            ]
          ];
          foreach ($features as $f) :
        ?>
          <div class="bg-[#F4F9F0] rounded-2xl p-8 border border-[#d2e3c9] hover:shadow-xl hover:border-[#7A9E7E] hover:-translate-y-1 transition-all duration-300 group">
            <div class="bg-white w-14 h-14 rounded-xl shadow-sm flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
              <i data-lucide="<?php echo esc_attr($f['icon']); ?>" class="h-7 w-7 text-[#FDB854]"></i>
            </div>
            <h4 class="text-xl font-bold text-[#1C2C1F] mb-4"><?php echo esc_html($f['title']); ?></h4>
            <p class="text-[#4F6854] leading-relaxed"><?php echo esc_html($f['description']); ?></p>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- Integration Banner -->
  <section class="py-20 bg-[#1C2C1F] text-white text-center px-6">
    <h2 class="text-3xl md:text-4xl font-bold mb-6 text-[#EBF4E3]">Mudah Diintegrasikan dengan Tools Anda</h2>
    <p class="text-white/80 max-w-2xl mx-auto mb-10">
      OmniServe menyediakan lebih dari 50+ integrasi langsung dengan CRM, ERP, dan aplikasi produktivitas populer seperti Salesforce, Zendesk, Slack, dan lainnya.
    </p>
    <a href="<?php echo home_url('/use-case'); ?>" class="inline-block bg-white text-[#1C2C1F] px-8 py-3 rounded-full font-bold hover:bg-[#FDB854] hover:text-white transition-colors shadow-lg">
      Lihat Studi Kasus
    </a>
  </section>
</div>

<?php get_footer(); ?>
