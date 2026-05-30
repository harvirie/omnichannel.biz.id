<?php
/**
 * Template Name: Analitik OmniServe
 */

// Override SEO meta for this virtual page
add_filter('pre_get_document_title', function() {
    return 'Analitik Komprehensif OmniServe - Omnichannel & Call Center Kabayan';
}, 99);
add_action('wp_head', function() {
    echo '<meta name="description" content="Pantau performa layanan pelanggan secara real-time dengan Analitik Komprehensif OmniServe. Identifikasi tren keluhan, ukur kinerja agen, dan buat keputusan cerdas.">' . "\n";
    echo '<link rel="canonical" href="' . esc_url(home_url('/analitik')) . '">' . "\n";
    // Preload LCP hero image (WebP) agar LCP turun signifikan
    echo '<link rel="preload" as="image" href="' . get_template_directory_uri() . '/assets/img/analitik-hero-updated.webp" type="image/webp">' . "\n";
}, 5);
?>
<?php get_header(); 

// Fetch data from Omni Editor
$omni_analitik = get_option('omni_editor_analitik', []);

// Fallbacks mapping
$hero_badge = $omni_analitik['hero']['badge'] ?? 'Analitik Komprehensif';
$hero_title = $omni_analitik['hero']['title'] ?? 'Berhenti Sekadar Merespon.<br /><span class="text-omni-button-hover">Ubah Interaksi Menjadi Data.</span>';
$hero_sub = $omni_analitik['hero']['subtitle'] ?? 'Pelayanan pelanggan bukan lagi sekadar cost center. Melalui OmniServe, setiap keluhan, pertanyaan, dan saran direkam, dianalisis, dan divisualisasikan.';
$hero_img = !empty($omni_analitik['hero']['image_url']) ? $omni_analitik['hero']['image_url'] : get_template_directory_uri() . '/assets/img/analitik-hero-updated.webp';

$content_title = $omni_analitik['content']['title'] ?? 'Wawasan Real-Time untuk Keputusan Bisnis Cerdas';
$content_sub = $omni_analitik['content']['subtitle'] ?? 'Platform analitik kami dirancang khusus untuk memantau sentimen pelanggan dan mengukur produktivitas agen secara komprehensif.';
$content_img = !empty($omni_analitik['content']['image_url']) ? $omni_analitik['content']['image_url'] : get_template_directory_uri() . '/assets/img/analytics-dashboard.webp';
$content_items = !empty($omni_analitik['content']['items']) ? $omni_analitik['content']['items'] : (
    class_exists('OmniEditorData') ? OmniEditorData::defaults('analitik')['content']['items'] : []
);

$metrics_title = $omni_analitik['metrics']['title'] ?? 'Metrik Utama yang Dipantau';
$metrics_sub = $omni_analitik['metrics']['subtitle'] ?? 'Segala indikator kinerja kunci (KPI) pusat layanan dalam satu layar.';
$metrics_items = !empty($omni_analitik['metrics']['items']) ? $omni_analitik['metrics']['items'] : [
    [ 'title' => 'Customer Satisfaction (CSAT)', 'val' => '98%', 'desc' => 'Tingkat kepuasan rata-rata dari interaksi', 'icon' => 'users' ],
    [ 'title' => 'First Contact Resolution', 'val' => '85%', 'desc' => 'Persentase masalah yang diselesaikan di kontak pertama', 'icon' => 'check-circle-2' ],
    [ 'title' => 'Average Handling Time', 'val' => '3.2m', 'desc' => 'Waktu rata-rata penyelesaian masalah pelanggan', 'icon' => 'trending-up' ]
];

$cta_title = $omni_analitik['cta']['title'] ?? 'Mulai Gunakan Analisis Data Hari Ini';
$cta_btn = $omni_analitik['cta']['btn_text'] ?? 'Lihat Paket Harga';
$cta_url = $omni_analitik['cta']['btn_url'] ?? '/harga';
?>

<!-- CSS inline di dalam #swup agar tetap aktif saat Swup navigation -->
<style data-page="analitik">
  .hero-illustration-container {
    margin-top: -70px;
  }
  @media (min-width: 768px) {
    .hero-illustration-container {
      margin-top: -10%;
    }
  }
</style>

<div class="flex-1 bg-white w-full">
  <!-- Hero Header -->
  <div class="-mt-20 md:-mt-32 pt-40 md:pt-52 relative overflow-hidden" style="background-color: #f1f5f9; z-index: 30;">
    <div class="max-w-7xl mx-auto px-6 text-center relative" style="padding-bottom: 100px; z-index: 10;">
      <div class="inline-flex items-center gap-2 bg-omni-dark/10 text-omni-button-hover px-4 py-2 rounded-full text-sm font-semibold mb-6">
        <i data-lucide="bar-chart-2" class="h-4 w-4"></i>
        <?php echo $hero_badge; ?>
      </div>
      <h1 class="text-4xl md:text-5xl font-bold text-omni-dark mb-6 leading-tight">
        <?php echo $hero_title; ?>
      </h1>
      <div class="text-omni-text-muted text-lg md:text-xl max-w-2xl mx-auto omni-rich-text">
        <?php echo wpautop($hero_sub); ?>
      </div>
    </div>
  </div>
    
  <!-- Animated SVG Boundary Line -->
  <div class="w-full relative pointer-events-none" style="line-height: 0; margin-top: -1px; z-index: 20;">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 3973.17 333.48" class="text-omni-dark h-[60px] md:h-auto" preserveAspectRatio="none" style="display: block; width: 100%; shape-rendering: geometricPrecision;">
        <!-- Gray filler above the curve to mask the image underneath -->
        <path fill="#f1f5f9" d="M3973.17 333.48 L3973.17 0 L0 0 L0 0.01 l2872.96 0 0 0.03 c30.48,-0.66 56.16,6.9 77.49,19.45 25.33,14.9 44.35,36.72 57.92,60.06 l82.35 134.74 c21.74,29.59 48.64,56.5 79.27,75.14 26.25,15.98 55.24,25.88 86.03,26.08 l0 -0.03 717.15 0 Z" />
        
        <path fill="currentColor" d="M0 0.01l2872.96 0 0 0.03c30.48,-0.66 56.16,6.9 77.49,19.45 25.33,14.9 44.35,36.72 57.92,60.06l82.35 134.74c21.74,29.59 48.64,56.5 79.27,75.14 26.25,15.98 55.24,25.88 86.03,26.08l0 -0.03 717.15 0 0 18 -717.15 0 -0.03 -0.03c-34.38,-0.22 -66.48,-11.11 -95.36,-28.68 -32.86,-20 -61.55,-48.7 -84.61,-80.14l-0.42 -0.63 -82.73 -135.38c-12.18,-20.97 -29.12,-40.5 -51.49,-53.66 -18.67,-10.99 -41.27,-17.6 -68.25,-16.98l-0.17 0.03 -2872.96 0 0 -18z"/>
        <path class="svg-glow-path-wide" pathLength="100" d="M0 0.01 l2872.96 0 0 0.03 c30.48,-0.66 56.16,6.9 77.49,19.45 25.33,14.9 44.35,36.72 57.92,60.06 l82.35 134.74 c21.74,29.59 48.64,56.5 79.27,75.14 26.25,15.98 55.24,25.88 86.03,26.08 l0 -0.03 717.15 0"/>
        <path class="svg-glow-path" pathLength="100" d="M0 0.01 l2872.96 0 0 0.03 c30.48,-0.66 56.16,6.9 77.49,19.45 25.33,14.9 44.35,36.72 57.92,60.06 l82.35 134.74 c21.74,29.59 48.64,56.5 79.27,75.14 26.25,15.98 55.24,25.88 86.03,26.08 l0 -0.03 717.15 0"/>
      </svg>
  </div>

  <!-- Hero Illustration -->
  <div class="w-full relative hero-illustration-container" style="z-index: 0;">
      <img
        src="<?php echo esc_url($hero_img); ?>"
        alt="Dashboard Analitik OmniServe"
        width="1886" height="834"
        class="w-full h-auto object-cover"
        fetchpriority="high"
        loading="eager"
        decoding="async"
      >
  </div>

  <!-- Main Content Area -->
  <section class="py-24 relative z-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid lg:grid-cols-2 gap-16 items-center">
        <div class="order-2 lg:order-1 relative">
          <div class="absolute -inset-4 bg-omni-secondary/20 rounded-[2.5rem] transform -rotate-2"></div>
          <img
            src="<?php echo esc_url($content_img); ?>"
            alt="Data Analytics"
            class="relative rounded-2xl shadow-2xl border border-white/50 object-cover h-[450px] w-full"
            loading="lazy"
            decoding="async"
          />
        </div>
        
        <div class="order-1 lg:order-2 space-y-8">
          <h2 class="text-3xl font-bold leading-tight text-omni-dark">
            <?php echo $content_title; ?>
          </h2>
          <div class="text-omni-text-muted text-lg leading-relaxed omni-rich-text">
            <?php echo wpautop($content_sub); ?>
          </div>
          
          <ul class="space-y-4 pt-4">
            <?php foreach ($content_items as $item) : ?>
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
        <h2 class="text-3xl font-bold text-omni-dark mb-4"><?php echo $metrics_title; ?></h2>
        <p class="text-omni-text-muted"><?php echo $metrics_sub; ?></p>
      </div>
      
      <div class="grid md:grid-cols-3 gap-8">
        <?php foreach ($metrics_items as $metric) : ?>
          <div class="bg-omni-light rounded-2xl p-8 border border-omni-border text-center hover:-translate-y-1 transition-transform">
            <div class="bg-omni-accent w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-4 text-white shadow-md">
              <?php 
              $icon = $metric['icon'] ?? 'check-circle-2';
              if (strpos($icon, 'fa-') !== false) {
                  echo '<i class="text-xl ' . esc_attr($icon) . '"></i>';
              } else {
                  echo '<i data-lucide="' . esc_attr($icon) . '" class="w-6 h-6"></i>';
              }
              ?>
            </div>
            <h3 class="text-omni-text-muted font-medium mb-2"><?php echo $metric['title']; ?></h3>
            <div class="text-4xl font-bold text-omni-dark mb-3"><?php echo $metric['val']; ?></div>
            <p class="text-sm text-omni-text-muted/80"><?php echo $metric['desc']; ?></p>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
  
  <!-- Mini CTA -->
  <section class="bg-omni-secondary py-16 text-center">
    <h2 class="text-2xl font-bold text-white mb-6"><?php echo $cta_title; ?></h2>
    <a href="<?php echo esc_url($cta_url); ?>" class="inline-block bg-omni-accent text-white px-8 py-3 rounded-full font-bold hover:bg-omni-accent-hover transition-colors shadow-lg">
      <?php echo $cta_btn; ?>
    </a>
  </section>
</div>

</main>

<?php get_footer(); ?>
