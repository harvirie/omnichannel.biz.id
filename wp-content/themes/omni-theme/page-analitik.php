<?php get_header(); ?>

<div class="flex-1 bg-white w-full">
  <!-- Hero Header -->
  <div class="bg-slate-50 pt-20 pb-24 md:pb-32 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 text-center relative z-10">
      <div class="inline-flex items-center gap-2 bg-omni-dark/10 text-omni-button-hover px-4 py-2 rounded-full text-sm font-semibold mb-6">
        <i data-lucide="bar-chart-2" class="h-4 w-4"></i>
        Analitik Komprehensif
      </div>
      <h1 class="text-4xl md:text-5xl font-bold text-omni-dark mb-6 leading-tight">
        Berhenti Sekadar Merespon.<br />
        <span class="text-omni-button-hover">Ubah Interaksi Menjadi Data.</span>
      </h1>
      <p class="text-omni-text-muted text-lg md:text-xl max-w-2xl mx-auto">
        Pelayanan pelanggan bukan lagi sekadar cost center. Melalui OmniServe, setiap keluhan, pertanyaan, dan saran direkam, dianalisis, dan divisualisasikan.
      </p>
    </div>
    
    <!-- Animated SVG Boundary Line -->
    <div class="absolute bottom-0 left-0 w-full z-0 pointer-events-none" style="line-height: 0;">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 3973.17 333.48" class="text-omni-dark" preserveAspectRatio="xMidYMax meet" style="display: block; width: 100%; height: auto;">
        <!-- White filler below the curve to blend with the next section -->
        <path fill="#ffffff" d="M3973.17 333.48 l-717.15 0 -0.03 -0.03c-34.38,-0.22 -66.48,-11.11 -95.36,-28.68 -32.86,-20 -61.55,-48.7 -84.61,-80.14l-0.42 -0.63 -82.73 -135.38c-12.18,-20.97 -29.12,-40.5 -51.49,-53.66 -18.67,-10.99 -41.27,-17.6 -68.25,-16.98l-0.17 0.03 -2872.96 0 L0 400 L3973.17 400 Z" />
        
        <path fill="currentColor" d="M0 0.01l2872.96 0 0 0.03c30.48,-0.66 56.16,6.9 77.49,19.45 25.33,14.9 44.35,36.72 57.92,60.06l82.35 134.74c21.74,29.59 48.64,56.5 79.27,75.14 26.25,15.98 55.24,25.88 86.03,26.08l0 -0.03 717.15 0 0 18 -717.15 0 -0.03 -0.03c-34.38,-0.22 -66.48,-11.11 -95.36,-28.68 -32.86,-20 -61.55,-48.7 -84.61,-80.14l-0.42 -0.63 -82.73 -135.38c-12.18,-20.97 -29.12,-40.5 -51.49,-53.66 -18.67,-10.99 -41.27,-17.6 -68.25,-16.98l-0.17 0.03 -2872.96 0 0 -18z"/>
        <path class="svg-glow-path-wide" pathLength="100" d="M0 0.01l2872.96 0 0 0.03c30.48,-0.66 56.16,6.9 77.49,19.45 25.33,14.9 44.35,36.72 57.92,60.06l82.35 134.74c21.74,29.59 48.64,56.5 79.27,75.14 26.25,15.98 55.24,25.88 86.03,26.08l0 -0.03 717.15 0 0 18 -717.15 0 -0.03 -0.03c-34.38,-0.22 -66.48,-11.11 -95.36,-28.68 -32.86,-20 -61.55,-48.7 -84.61,-80.14l-0.42 -0.63 -82.73 -135.38c-12.18,-20.97 -29.12,-40.5 -51.49,-53.66 -18.67,-10.99 -41.27,-17.6 -68.25,-16.98l-0.17 0.03 -2872.96 0 0 -18z"/>
        <path class="svg-glow-path" pathLength="100" d="M0 0.01l2872.96 0 0 0.03c30.48,-0.66 56.16,6.9 77.49,19.45 25.33,14.9 44.35,36.72 57.92,60.06l82.35 134.74c21.74,29.59 48.64,56.5 79.27,75.14 26.25,15.98 55.24,25.88 86.03,26.08l0 -0.03 717.15 0 0 18 -717.15 0 -0.03 -0.03c-34.38,-0.22 -66.48,-11.11 -95.36,-28.68 -32.86,-20 -61.55,-48.7 -84.61,-80.14l-0.42 -0.63 -82.73 -135.38c-12.18,-20.97 -29.12,-40.5 -51.49,-53.66 -18.67,-10.99 -41.27,-17.6 -68.25,-16.98l-0.17 0.03 -2872.96 0 0 -18z"/>
      </svg>
    </div>
  </div>

  <!-- Main Content Area -->
  <section class="pb-24 pt-16 md:pt-24 -mt-10 md:-mt-16 relative z-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid lg:grid-cols-2 gap-16 items-center">
        <div class="order-2 lg:order-1 relative">
          <div class="absolute -inset-4 bg-omni-secondary/20 rounded-[2.5rem] transform -rotate-2"></div>
          <img
            src="<?php echo get_template_directory_uri(); ?>/assets/img/analytics-dashboard.webp"
            alt="Data Analytics"
            class="relative rounded-2xl shadow-2xl border border-white/50 object-cover h-[450px] w-full"
          />
        </div>
        
        <div class="order-1 lg:order-2 space-y-8">
          <h2 class="text-3xl font-bold leading-tight text-omni-dark">
            Wawasan Real-Time untuk Keputusan Bisnis Cerdas
          </h2>
          <p class="text-omni-text-muted text-lg leading-relaxed">
            Platform analitik kami dirancang khusus untuk memantau sentimen pelanggan dan mengukur produktivitas agen secara komprehensif.
          </p>
          
          <ul class="space-y-4 pt-4">
            <?php
              $items = [
                'Identifikasi tren keluhan sebelum menjadi krisis',
                'Ukur kinerja agen secara objektif dengan metrik akurat',
                'Pahami preferensi saluran komunikasi pelanggan Anda',
                'Prediksi lonjakan panggilan berdasarkan riwayat data'
              ];
              foreach ($items as $item) :
            ?>
              <li class="flex items-start gap-3 bg-white p-4 rounded-xl shadow-sm border border-omni-border">
                <div class="bg-omni-light p-1.5 rounded-full mt-0.5 shrink-0">
                  <i data-lucide="check-circle-2" class="h-5 w-5 text-omni-button-hover"></i>
                </div>
                <span class="text-omni-dark font-medium"><?php echo esc_html($item); ?></span>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!-- Metrics Section -->
  <section class="bg-white py-24 border-t border-omni-border">
    <div class="max-w-7xl mx-auto px-6">
      <div class="text-center mb-16">
        <h2 class="text-3xl font-bold text-omni-dark mb-4">Metrik Utama yang Dipantau</h2>
        <p class="text-omni-text-muted">Segala indikator kinerja kunci (KPI) pusat layanan dalam satu layar.</p>
      </div>
      
      <div class="grid md:grid-cols-3 gap-8">
        <?php
          $metrics = [
            [ 'title' => 'Customer Satisfaction (CSAT)', 'val' => '98%', 'desc' => 'Tingkat kepuasan rata-rata dari interaksi', 'icon' => 'users' ],
            [ 'title' => 'First Contact Resolution', 'val' => '85%', 'desc' => 'Persentase masalah yang diselesaikan di kontak pertama', 'icon' => 'check-circle-2' ],
            [ 'title' => 'Average Handling Time', 'val' => '3.2m', 'desc' => 'Waktu rata-rata penyelesaian masalah pelanggan', 'icon' => 'trending-up' ]
          ];
          foreach ($metrics as $metric) :
        ?>
          <div class="bg-omni-light rounded-2xl p-8 border border-omni-border text-center hover:-translate-y-1 transition-transform">
            <div class="bg-omni-accent w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-4 text-white shadow-md">
              <i data-lucide="<?php echo esc_attr($metric['icon']); ?>" class="w-6 h-6"></i>
            </div>
            <h3 class="text-omni-text-muted font-medium mb-2"><?php echo esc_html($metric['title']); ?></h3>
            <div class="text-4xl font-bold text-omni-dark mb-3"><?php echo esc_html($metric['val']); ?></div>
            <p class="text-sm text-omni-text-muted/80"><?php echo esc_html($metric['desc']); ?></p>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
  
  <!-- Mini CTA -->
  <section class="bg-omni-secondary py-16 text-center">
    <h2 class="text-2xl font-bold text-white mb-6">Mulai Gunakan Analisis Data Hari Ini</h2>
    <a href="<?php echo home_url('/harga'); ?>" class="inline-block bg-omni-accent text-white px-8 py-3 rounded-full font-bold hover:bg-omni-accent-hover transition-colors shadow-lg">
      Lihat Paket Harga
    </a>
  </section>
</div>

<?php get_footer(); ?>
