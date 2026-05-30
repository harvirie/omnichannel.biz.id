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
}, 5);
?>
<?php get_header(); 

// Fetch data from Omni Editor
$omni_fitur = get_option('omni_editor_fitur', []);

// Setup fallbacks if empty
$hero_badge = $omni_fitur['hero']['badge'] ?? 'Platform Omnichannel Terpadu';
$hero_title = $omni_fitur['hero']['title'] ?? 'Semua Fitur yang Anda Butuhkan,<br><span class="text-omni-button-hover">dalam Satu Platform</span>';
$hero_sub   = $omni_fitur['hero']['subtitle'] ?? 'Dari WhatsApp Verified Blue Tick hingga integrasi telepon PSTN — OmniServe hadir dengan fitur lengkap yang siap meningkatkan performa tim customer service Anda.';
$hero_img   = !empty($omni_fitur['hero']['image_url']) ? $omni_fitur['hero']['image_url'] : get_template_directory_uri() . '/assets/img/fitur-hero-updated.png';

$sections   = !empty($omni_fitur['sections']) ? $omni_fitur['sections'] : [];
?>

<!-- CSS inline di dalam #swup agar tetap aktif saat Swup navigation -->
<style data-page="fitur">
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
        <i data-lucide="zap" class="h-4 w-4"></i>
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
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 3973.17 333.48" class="text-omni-dark h-[60px] md:h-auto" preserveAspectRatio="none" style="display: block; width: 100%; shape-rendering: geometricPrecision; overflow: visible;">
        <defs>
          <filter id="omni-glow-filter-fitur" x="-40%" y="-200%" width="180%" height="500%" color-interpolation-filters="sRGB">
            <!-- flood-color = --omni-accent (#D4AF37) untuk konsistensi UI -->
            <feFlood flood-color="#D4AF37" flood-opacity="1" result="gold"/>
            <feComposite in="gold" in2="SourceGraphic" operator="in" result="gold-src"/>
            <feGaussianBlur in="gold-src" stdDeviation="6" result="glow-core"/>
            <feGaussianBlur in="gold-src" stdDeviation="20" result="glow-mid"/>
            <feGaussianBlur in="gold-src" stdDeviation="50" result="glow-wide"/>
            <feComponentTransfer in="glow-core" result="glow-core-bright">
              <feFuncR type="linear" slope="2.5"/>
              <feFuncG type="linear" slope="2"/>
              <feFuncB type="linear" slope="0.8"/>
            </feComponentTransfer>
            <feMerge>
              <feMergeNode in="glow-wide"/>
              <feMergeNode in="glow-mid"/>
              <feMergeNode in="glow-core-bright"/>
              <feMergeNode in="SourceGraphic"/>
            </feMerge>
          </filter>
        </defs>
        <!-- Gray filler above the curve to mask the image underneath -->
        <path fill="#f1f5f9" d="M3973.17 333.48 L3973.17 0 L0 0 L0 0.01 l2872.96 0 0 0.03 c30.48,-0.66 56.16,6.9 77.49,19.45 25.33,14.9 44.35,36.72 57.92,60.06 l82.35 134.74 c21.74,29.59 48.64,56.5 79.27,75.14 26.25,15.98 55.24,25.88 86.03,26.08 l0 -0.03 717.15 0 Z" />
        <path fill="currentColor" d="M0 0.01l2872.96 0 0 0.03c30.48,-0.66 56.16,6.9 77.49,19.45 25.33,14.9 44.35,36.72 57.92,60.06l82.35 134.74c21.74,29.59 48.64,56.5 79.27,75.14 26.25,15.98 55.24,25.88 86.03,26.08l0 -0.03 717.15 0 0 18 -717.15 0 -0.03 -0.03c-34.38,-0.22 -66.48,-11.11 -95.36,-28.68 -32.86,-20 -61.55,-48.7 -84.61,-80.14l-0.42 -0.63 -82.73 -135.38c-12.18,-20.97 -29.12,-40.5 -51.49,-53.66 -18.67,-10.99 -41.27,-17.6 -68.25,-16.98l-0.17 0.03 -2872.96 0 0 -18z"/>
        <path class="svg-glow-path-wide" pathLength="100" filter="url(#omni-glow-filter-fitur)" d="M0 0.01 l2872.96 0 0 0.03 c30.48,-0.66 56.16,6.9 77.49,19.45 25.33,14.9 44.35,36.72 57.92,60.06 l82.35 134.74 c21.74,29.59 48.64,56.5 79.27,75.14 26.25,15.98 55.24,25.88 86.03,26.08 l0 -0.03 717.15 0"/>
        <path class="svg-glow-path" pathLength="100" filter="url(#omni-glow-filter-fitur)" d="M0 0.01 l2872.96 0 0 0.03 c30.48,-0.66 56.16,6.9 77.49,19.45 25.33,14.9 44.35,36.72 57.92,60.06 l82.35 134.74 c21.74,29.59 48.64,56.5 79.27,75.14 26.25,15.98 55.24,25.88 86.03,26.08 l0 -0.03 717.15 0"/>
      </svg>
  </div>

  <!-- Hero Illustration -->
  <div class="w-full relative hero-illustration-container" style="z-index: 0;">
      <img
        src="<?php echo esc_url($hero_img); ?>"
        alt="Dashboard omnichannel call center"
        width="1886" height="834"
        class="w-full h-auto object-cover"
        fetchpriority="high"
        loading="eager"
        decoding="async"
      >
  </div>  <!-- Dynamic Feature Sections -->
  <?php 
  if (empty($sections)) {
      // Fallback if no sections in options
      if (class_exists('OmniEditorData')) {
          $sections = OmniEditorData::defaults('fitur')['sections'];
      }
  }

  foreach ($sections as $index => $sec): 
      $is_even = $index % 2 !== 0;
      $bg_class = $is_even ? 'bg-omni-light' : 'bg-white';
  ?>
  <section id="<?php echo esc_attr($sec['id'] ?? 'sec-'.$index); ?>" class="py-20 <?php echo $bg_class; ?> border-b border-omni-border">
    <div class="max-w-7xl mx-auto px-6">
      <div class="flex flex-col <?php echo $is_even ? 'md:flex-row-reverse' : 'md:flex-row'; ?> gap-12 items-center">
        <div class="md:w-1/2">
          <div class="inline-flex items-center gap-2 <?php echo $is_even ? 'bg-white' : 'bg-omni-light'; ?> text-omni-button-hover px-3 py-1.5 rounded-full text-xs font-bold mb-4">
            <i data-lucide="layers" class="h-3.5 w-3.5"></i>
            <?php echo esc_html($sec['badge'] ?? 'Fitur'); ?>
          </div>
          <h2 class="text-3xl font-bold text-omni-dark mb-4 leading-tight"><?php echo $sec['title']; ?></h2>
          <div class="text-omni-text-muted leading-relaxed mb-6 omni-rich-text">
            <?php echo wpautop($sec['subtitle']); ?>
          </div>
        </div>
        <div class="md:w-1/2 w-full">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <?php foreach (($sec['items'] ?? []) as $item): ?>
                <div class="bg-white rounded-2xl p-6 border border-omni-border shadow-sm hover:shadow-md transition-shadow">
                    <div class="bg-omni-light w-12 h-12 rounded-xl flex items-center justify-center mb-4 text-omni-secondary">
                        <?php 
                        $icon = $item['icon'] ?? 'check-circle';
                        // Check if it's font-awesome (usually has spaces or starts with fa-)
                        if (strpos($icon, 'fa-') !== false) {
                            echo '<i class="text-xl ' . esc_attr($icon) . '"></i>';
                        } else {
                            echo '<i data-lucide="' . esc_attr($icon) . '"></i>';
                        }
                        ?>
                    </div>
                    <h4 class="font-bold text-omni-dark text-sm mb-2"><?php echo $item['title']; ?></h4>
                    <p class="text-xs text-omni-text-muted leading-relaxed"><?php echo $item['desc']; ?></p>
                </div>
              <?php endforeach; ?>
            </div>
        </div>
      </div>
    </div>
  </section>
  <?php endforeach; ?>

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
