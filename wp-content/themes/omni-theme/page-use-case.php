<?php get_header(); ?>

<div class="flex-1 bg-white w-full">
  <!-- Header Area -->
  <div class="bg-omni-secondary py-24 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 text-center relative z-10">
      <h1 class="text-4xl md:text-5xl font-bold text-white mb-6 drop-shadow-sm">
        Solusi <span class="text-omni-accent">Untuk Setiap Industri</span>
      </h1>
      <p class="text-omni-light text-lg md:text-xl max-w-2xl mx-auto drop-shadow-sm">
        Pelajari bagaimana perusahaan di berbagai sektor menggunakan OmniServe untuk mentransformasi pengalaman pelanggan mereka.
      </p>
    </div>
    
    <!-- Background shapes -->
    <div class="absolute top-10 left-10 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-10 right-10 w-80 h-80 bg-omni-dark/20 rounded-full blur-3xl"></div>
  </div>

  <!-- Use Cases Section -->
  <section class="py-20">
    <div class="max-w-7xl mx-auto px-6">
      <div class="grid md:grid-cols-2 gap-12">
        
        <!-- E-Commerce -->
        <div class="flex flex-col md:flex-row gap-6 bg-[#F4F9F0] p-8 rounded-3xl border border-omni-border">
          <div class="shrink-0 bg-white p-4 rounded-2xl shadow-sm h-fit">
            <i data-lucide="shopping-bag" class="w-10 h-10 text-omni-accent"></i>
          </div>
          <div>
            <h3 class="text-2xl font-bold text-omni-dark mb-3">E-Commerce & Ritel</h3>
            <p class="text-omni-text-muted mb-4">
              Atasi lonjakan permintaan selama flash sale atau Harbolnas tanpa membuat pelanggan menunggu. Integrasikan status pengiriman secara langsung ke layar agen.
            </p>
            <ul class="list-disc list-inside text-omni-button-hover space-y-1 ml-4 text-sm font-medium">
              <li>Tingkatkan resolusi chat WhatsApp hingga 40%</li>
              <li>Kurangi pengabaian keranjang belanja</li>
            </ul>
          </div>
        </div>

        <!-- Financial -->
        <div class="flex flex-col md:flex-row gap-6 bg-[#F4F9F0] p-8 rounded-3xl border border-omni-border">
          <div class="shrink-0 bg-white p-4 rounded-2xl shadow-sm h-fit">
            <i data-lucide="building-2" class="w-10 h-10 text-omni-button-hover"></i>
          </div>
          <div>
            <h3 class="text-2xl font-bold text-omni-dark mb-3">Layanan Keuangan</h3>
            <p class="text-omni-text-muted mb-4">
              Keamanan setara perbankan untuk menangani informasi sensitif nasabah. Verifikasi identitas yang aman dan alur kerja pengaduan terstruktur.
            </p>
            <ul class="list-disc list-inside text-omni-button-hover space-y-1 ml-4 text-sm font-medium">
              <li>Kepatuhan penuh pada regulasi privasi data</li>
              <li>Prioritas routing untuk nasabah VIP</li>
            </ul>
          </div>
        </div>

        <!-- Healthcare -->
        <div class="flex flex-col md:flex-row gap-6 bg-[#F4F9F0] p-8 rounded-3xl border border-omni-border">
          <div class="shrink-0 bg-white p-4 rounded-2xl shadow-sm h-fit">
            <i data-lucide="stethoscope" class="w-10 h-10 text-omni-secondary"></i>
          </div>
          <div>
            <h3 class="text-2xl font-bold text-omni-dark mb-3">Layanan Kesehatan</h3>
            <p class="text-omni-text-muted mb-4">
              Permudah penjadwalan janji temu, konfirmasi asuransi, hingga konsultasi telemedis darurat tanpa membuat antrean telepon menumpuk.
            </p>
            <ul class="list-disc list-inside text-omni-button-hover space-y-1 ml-4 text-sm font-medium">
              <li>Notifikasi pengingat via WhatsApp Otomatis</li>
              <li>Pusat panggilan 24/7 tanpa henti</li>
            </ul>
          </div>
        </div>

        <!-- B2B Services -->
        <div class="flex flex-col md:flex-row gap-6 bg-[#F4F9F0] p-8 rounded-3xl border border-omni-border">
          <div class="shrink-0 bg-white p-4 rounded-2xl shadow-sm h-fit">
            <i data-lucide="briefcase" class="w-10 h-10 text-omni-dark"></i>
          </div>
          <div>
            <h3 class="text-2xl font-bold text-omni-dark mb-3">Layanan B2B</h3>
            <p class="text-omni-text-muted mb-4">
              Bangun relasi mendalam dengan klien bisnis Anda melalui manajemen SLA (Service Level Agreement) yang presisi dan resolusi dukungan teknis tingkat tinggi.
            </p>
            <ul class="list-disc list-inside text-omni-button-hover space-y-1 ml-4 text-sm font-medium">
              <li>Manajemen SLA multi-tier</li>
              <li>Eskalasi tiket cerdas ke tim teknis</li>
            </ul>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- Mini CTA -->
  <section class="bg-omni-dark py-16 text-center border-t border-omni-button-hover">
    <h2 class="text-2xl font-bold text-omni-light mb-6">Punya studi kasus khusus?</h2>
    <a href="<?php echo home_url('/harga'); ?>" class="inline-block bg-omni-accent text-omni-dark px-8 py-3 rounded-full font-bold hover:bg-omni-accent-hover hover:text-white transition-colors shadow-lg">
      Konsultasi Gratis dengan Tim Kami
    </a>
  </section>
</div>

<?php get_footer(); ?>
