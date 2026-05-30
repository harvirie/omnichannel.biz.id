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
    echo '<link rel="preload" as="image" href="' . get_template_directory_uri() . '/assets/img/usecase-hero-updated.webp" type="image/webp">' . "\n";
}, 5);
?>
<?php get_header(); 

// Fetch data from Omni Editor
$omni_usecase = get_option('omni_editor_usecase', []);

// Setup fallbacks if empty
$hero_badge = $omni_usecase['hero']['badge'] ?? 'Solusi Nyata untuk Bisnis Nyata';
$hero_title = $omni_usecase['hero']['title'] ?? 'Bagaimana OmniServe <span class="text-omni-button-hover">Mengubah Operasional</span><br>di Berbagai Industri';
$hero_sub   = $omni_usecase['hero']['subtitle'] ?? 'Dari WhatsApp Unlimited hingga Telepon PSTN dengan Recording — pelajari bagaimana fitur-fitur nyata kami menyelesaikan tantangan nyata di lapangan.';
$hero_img   = !empty($omni_usecase['hero']['image_url']) ? $omni_usecase['hero']['image_url'] : get_template_directory_uri() . '/assets/img/usecase-hero-updated.png';

$sections   = !empty($omni_usecase['sections']) ? $omni_usecase['sections'] : [];
?>

<!-- CSS inline di dalam #swup agar tetap aktif saat Swup navigation -->
<style data-page="use-case">
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

  <!-- Hero Section -->
  <div class="-mt-20 md:-mt-32 pt-40 md:pt-52 relative overflow-hidden" style="background-color: #f1f5f9; z-index: 30;">
    <div class="max-w-7xl mx-auto px-6 text-center relative" style="padding-bottom: 100px; z-index: 10;">
      <div class="inline-flex items-center gap-2 bg-omni-dark/10 text-omni-button-hover px-4 py-2 rounded-full text-sm font-semibold mb-6">
        <i data-lucide="briefcase" class="h-4 w-4"></i>
        <?php echo $hero_badge; ?>
      </div>
      <h1 class="text-4xl md:text-5xl font-bold text-omni-dark mb-6 leading-tight">
        <?php echo $hero_title; ?>
      </h1>
      <div class="text-omni-text-muted text-lg md:text-xl max-w-2xl mx-auto omni-rich-text">
        <?php echo wpautop($hero_sub); ?>
      </div>
    </div>
    <!-- Background shapes -->
    <div class="absolute top-10 left-10 w-64 h-64 bg-omni-accent/10 rounded-full blur-3xl z-0"></div>
    <div class="absolute bottom-10 right-10 w-80 h-80 bg-omni-dark/5 rounded-full blur-3xl z-0">    </div>
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
        alt="Solusi omnichannel call center"
        width="1886" height="834"
        class="w-full h-auto object-cover"
        fetchpriority="high"
        loading="eager"
        decoding="async"
      >
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

      <!-- Dynamic Use Cases -->
      <?php 
      if (empty($sections)) {
          // Fallback if no sections in options
          if (class_exists('OmniEditorData')) {
              $sections = OmniEditorData::defaults('usecase')['sections'];
          }
      }
      ?>

      <?php foreach ($sections as $sec): 
          $is_dark = ($sec['style'] ?? 'light') === 'dark';
          
          $bg_class = $is_dark ? 'bg-omni-dark border-2 border-omni-accent hover:shadow-[0_20px_60px_rgba(253,184,84,0.25)]' : 'bg-omni-light border border-omni-border hover:shadow-xl';
          $icon_bg = $is_dark ? 'bg-white/10' : 'bg-white shadow-sm';
          $icon_color = $is_dark ? 'text-omni-accent' : 'text-omni-accent'; // Default fallback if not custom styled, let's just use accent
          
          $badge_bg = $is_dark ? 'bg-omni-accent/20 text-omni-accent' : 'bg-omni-secondary/20 text-omni-button-hover';
          
          $title_color = $is_dark ? 'text-white' : 'text-omni-dark';
          $desc_color = $is_dark ? 'text-white/70' : 'text-omni-text-muted';
          
          $item_bg = $is_dark ? 'bg-white/10 border-white/20' : 'bg-white border-omni-border';
          $item_title = $is_dark ? 'text-white' : 'text-omni-dark';
          $item_desc = $is_dark ? 'text-white/60' : 'text-omni-text-muted';
      ?>
      <div class="rounded-3xl p-8 md:p-10 transition-shadow duration-300 <?php echo $bg_class; ?>">
        <div class="flex flex-col md:flex-row gap-8">
          <div class="shrink-0 p-4 rounded-2xl h-fit <?php echo $icon_bg; ?>">
            <?php 
            $sec_icon = $sec['icon'] ?? 'briefcase';
            if (strpos($sec_icon, 'fa-') !== false) {
                echo '<i class="text-4xl ' . esc_attr($sec_icon) . ' ' . $icon_color . '"></i>';
            } else {
                echo '<i data-lucide="' . esc_attr($sec_icon) . '" class="w-10 h-10 ' . $icon_color . '"></i>';
            }
            ?>
          </div>
          <div class="flex-1">
            <div class="flex flex-wrap items-center gap-3 mb-3">
              <h2 class="text-2xl font-bold <?php echo $title_color; ?>"><?php echo $sec['title']; ?></h2>
              <?php if (!empty($sec['badge'])): ?>
              <span class="inline-flex items-center gap-1.5 text-xs font-bold px-3 py-1 rounded-full <?php echo $badge_bg; ?>">
                <div class="w-2 h-2 rounded-full <?php echo $is_dark ? 'bg-omni-accent' : 'bg-omni-secondary'; ?>"></div>
                <?php echo $sec['badge']; ?>
              </span>
              <?php endif; ?>
            </div>
            <div class="mb-6 leading-relaxed omni-rich-text <?php echo $desc_color; ?>">
              <?php echo wpautop($sec['description']); ?>
            </div>
            <div class="grid sm:grid-cols-3 gap-4">
              <?php foreach (($sec['items'] ?? []) as $item): ?>
              <div class="rounded-xl p-4 border <?php echo $item_bg; ?>">
                <?php 
                $item_icon = $item['icon'] ?? 'check-circle';
                $item_icon_color = $is_dark ? 'text-omni-accent' : 'text-omni-secondary';
                if (strpos($item_icon, 'fa-') !== false) {
                    echo '<i class="text-xl mb-2 ' . esc_attr($item_icon) . ' ' . $item_icon_color . '"></i>';
                } else {
                    echo '<i data-lucide="' . esc_attr($item_icon) . '" class="h-5 w-5 mb-2 ' . $item_icon_color . '"></i>';
                }
                ?>
                <p class="text-xs font-bold mt-1 <?php echo $item_title; ?>"><?php echo $item['title']; ?></p>
                <p class="text-xs mt-1 <?php echo $item_desc; ?>"><?php echo $item['desc']; ?></p>
              </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>

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

</main>

<?php get_footer(); ?>
