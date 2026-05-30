<?php
/**
 * Template Name: Harga OmniServe
 */

// Override SEO meta for this virtual page
add_filter('pre_get_document_title', function() {
    return 'Pilihan Paket & Harga Sewa Omnichannel Call Center | OmniServe';
}, 99);
add_action('wp_head', function() {
    echo '<meta name="description" content="Pilihan paket harga sewa omnichannel call center OmniServe transparan: Paket Standard & Professional Plus. Mulai sewa call center pemerintah & korporasi sekarang.">' . "\n";
    echo '<link rel="canonical" href="' . esc_url(home_url('/harga')) . '">' . "\n";
    // Preload LCP hero image (WebP) agar LCP turun signifikan
    echo '<link rel="preload" as="image" href="' . get_template_directory_uri() . '/assets/img/harga-hero-updated.webp" type="image/webp">' . "\n";
}, 5);
?>
<?php get_header(); 

// Fetch data from Omni Editor
$omni_harga = get_option('omni_editor_harga', []);

// Fallbacks
$hero_badge = $omni_harga['hero']['badge'] ?? 'Harga OmniServe';
$hero_title = $omni_harga['hero']['title'] ?? 'Investasi Tepat untuk <span class="text-omni-button-hover">Layanan Hebat</span>';
$hero_sub   = $omni_harga['hero']['subtitle'] ?? 'Solusi call center omnichannel profesional dengan harga transparan.<br>Tanpa biaya tersembunyi. Dukungan penuh dari tim kami.';
$hero_img   = !empty($omni_harga['hero']['image_url']) ? $omni_harga['hero']['image_url'] : get_template_directory_uri() . '/assets/img/harga-hero-updated.webp';

$packages = !empty($omni_harga['packages']) ? $omni_harga['packages'] : [];
$disclaimer = $omni_harga['disclaimer'] ?? '* Harga belum termasuk PPN. Syarat & ketentuan berlaku. Hubungi tim kami untuk penawaran custom sesuai kebutuhan instansi Anda.';

$cta_title = $omni_harga['cta']['title'] ?? 'Butuh Paket <span class="text-omni-accent">Khusus untuk Instansi?</span>';
$cta_sub = $omni_harga['cta']['subtitle'] ?? 'Kami melayani pengadaan resmi, integrasi sistem pemerintah, dan kebutuhan enterprise skala besar.';
$cta_btn = $omni_harga['cta']['btn_text'] ?? 'Hubungi Tim Sales Kami';
$cta_url = $omni_harga['cta']['btn_url'] ?? 'https://wa.me/6281283835553';
?>

<!-- CSS inline di dalam #swup agar tetap aktif saat Swup navigation -->
<style data-page="harga">
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
        <i data-lucide="tag" class="h-4 w-4"></i>
        <?php echo $hero_badge; ?>
      </div>
      <h1 class="text-4xl md:text-5xl font-bold text-omni-dark mb-6 leading-tight">
        <?php echo $hero_title; ?>
      </h1>
      <div class="text-omni-text-muted text-lg max-w-2xl mx-auto leading-relaxed omni-rich-text">
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
        alt="Daftar Paket Harga OmniServe"
        width="1886" height="834"
        class="w-full h-auto object-cover"
        fetchpriority="high"
        loading="eager"
        decoding="async"
      >
  </div>

  <!-- Pricing Cards -->
  <div class="max-w-6xl mx-auto px-6 pb-24 mt-16 md:mt-24 relative z-10">
    <div class="grid md:grid-cols-2 gap-8 items-stretch">

      <!-- Dynamic Packages -->
      <?php 
      $packages = [];
      $pkg_std = $omni_harga['paket_standard'] ?? (class_exists('OmniEditorData') ? OmniEditorData::defaults('harga')['paket_standard'] : null);
      $pkg_pro = $omni_harga['paket_pro'] ?? (class_exists('OmniEditorData') ? OmniEditorData::defaults('harga')['paket_pro'] : null);
      
      if ($pkg_std) $packages[] = $pkg_std;
      if ($pkg_pro) $packages[] = $pkg_pro;
      ?>

      <?php foreach ($packages as $index => $pkg): 
          $is_dark = $index === 1; // Second package (Pro) is dark
          
          $bg_class = $is_dark ? 'bg-omni-dark border-2 border-omni-accent shadow-2xl hover:shadow-[0_30px_80px_rgba(212,175,55,0.3)]' : 'bg-white border border-omni-border shadow-lg hover:shadow-2xl';
          $extra_style = $is_dark ? 'filter: drop-shadow(-6px 6px 0px #D4AF37);' : '';
          
          $badge_bg = $is_dark ? 'bg-white/10 text-omni-accent' : 'bg-omni-light text-omni-button-hover';
          $title_color = $is_dark ? 'text-white' : 'text-omni-dark';
          
          $price_box = $is_dark ? 'bg-white/10 border border-white/20' : 'bg-omni-light';
          $price_monthly_color = $is_dark ? 'text-omni-accent' : 'text-omni-dark';
          $price_total_color = $is_dark ? 'text-omni-accent' : 'text-omni-secondary';
          
          $btn_class = $is_dark ? 'bg-omni-accent hover:bg-omni-accent-hover text-white shadow-lg hover:shadow-omni-accent/50' : 'bg-omni-light text-omni-button-hover hover:bg-omni-border border border-omni-border';
          $btn_text = $is_dark ? 'Mulai Sekarang' : 'Konsultasi Gratis';
          $btn_url = '/?demo=1';
      ?>
      <div class="rounded-3xl p-8 flex flex-col relative group hover:-translate-y-1 transition-all duration-300 <?php echo $bg_class; ?>" style="<?php echo $extra_style; ?>">
        
        <?php if (!empty($pkg['badge'])): ?>
        <div class="absolute -top-4 left-1/2 transform -translate-x-1/2 bg-omni-accent text-white px-5 py-1.5 rounded-full text-sm font-bold shadow-lg whitespace-nowrap flex items-center gap-2">
          <i data-lucide="star" class="h-3.5 w-3.5 fill-white"></i>
          <?php echo esc_html($pkg['badge']); ?>
        </div>
        <div class="mt-2"></div>
        <?php endif; ?>

        <div class="mb-6">
          <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-bold mb-4 <?php echo $badge_bg; ?>">
            <i data-lucide="<?php echo $is_dark ? 'zap' : 'layers'; ?>" class="h-3.5 w-3.5"></i>
            <?php echo $is_dark ? 'Professional Plus' : 'Standard'; ?>
          </div>
          <h2 class="text-3xl font-extrabold mb-2 <?php echo $title_color; ?>"><?php echo esc_html($pkg['name'] ?? ''); ?></h2>
        </div>

        <!-- Price -->
        <div class="rounded-2xl p-5 mb-6 <?php echo $price_box; ?>">
          <div class="flex items-end gap-2 mb-1">
            <span class="text-3xl md:text-4xl font-extrabold <?php echo $price_monthly_color; ?>"><?php echo esc_html($pkg['price'] ?? ''); ?></span>
            <span class="font-medium mb-1 <?php echo $is_dark ? 'text-white/70' : 'text-omni-text-muted'; ?>"><?php echo esc_html($pkg['price_unit'] ?? ''); ?></span>
          </div>
          <p class="text-sm font-semibold <?php echo $price_total_color; ?>"><?php echo esc_html($pkg['total'] ?? ''); ?></p>
          <p class="text-xs mt-1 <?php echo $is_dark ? 'text-white/60' : 'text-omni-text-muted'; ?>"><?php echo esc_html($pkg['duration'] ?? ''); ?></p>
        </div>

        <!-- Features Table -->
        <ul class="space-y-3 mb-8 flex-1">
          <?php foreach (($pkg['features'] ?? []) as $f) : 
              $is_hl = !empty($f['highlight']);
              if ($is_dark) {
                  $li_bg = $is_hl ? 'bg-white/10' : 'hover:bg-white/5';
                  $ic_box = $is_hl ? 'bg-omni-accent' : 'bg-white/10';
                  $ic_col = $is_hl ? 'text-white' : 'text-omni-accent';
                  $lbl_col = 'text-white/50';
                  $val_col = $is_hl ? 'text-omni-accent' : 'text-white';
              } else {
                  $li_bg = $is_hl ? 'bg-omni-light' : 'hover:bg-omni-light/50';
                  $ic_box = $is_hl ? 'bg-omni-secondary/20' : 'bg-omni-light';
                  $ic_col = $is_hl ? 'text-omni-button-hover' : 'text-omni-secondary';
                  $lbl_col = 'text-omni-text-muted';
                  $val_col = 'text-omni-dark';
              }
          ?>
          <li class="flex items-start gap-3 p-3 rounded-xl transition-colors <?php echo $li_bg; ?>">
            <div class="p-1.5 rounded-lg shrink-0 mt-0.5 <?php echo $ic_box; ?>">
              <?php 
              $icon = $f['icon'] ?? 'check';
              if (strpos($icon, 'fa-') !== false) {
                  echo '<i class="' . esc_attr($icon) . ' h-4 w-4 ' . $ic_col . '"></i>';
              } else {
                  echo '<i data-lucide="' . esc_attr($icon) . '" class="h-4 w-4 ' . $ic_col . '"></i>';
              }
              ?>
            </div>
            <div class="flex-1 min-w-0">
              <span class="block text-xs font-semibold uppercase tracking-wide <?php echo $lbl_col; ?>"><?php echo $f['label']; ?></span>
              <span class="block text-sm font-medium <?php echo $val_col; ?>"><?php echo $f['value']; ?></span>
            </div>
          </li>
          <?php endforeach; ?>
        </ul>

        <a href="<?php echo esc_url($btn_url); ?>" <?php if(strpos($btn_url, 'demo=1')!==false) echo 'onclick="document.getElementById(\'demo-modal\')?.classList.remove(\'hidden\'); return false;"'; ?>
           class="w-full py-4 rounded-xl font-bold text-center transition-all flex items-center justify-center gap-2 <?php echo $btn_class; ?>">
          <i data-lucide="arrow-right" class="h-5 w-5"></i>
          <?php echo esc_html($btn_text); ?>
        </a>
      </div>
      <?php endforeach; ?>

    </div>

    <!-- Disclaimer -->
    <div class="text-center text-sm text-omni-text-muted mt-8 opacity-70 omni-rich-text">
      <?php echo wpautop($disclaimer); ?>
    </div>
  </div>

  <!-- Bottom CTA -->
  <div class="bg-omni-dark py-16 text-center px-6">
    <h3 class="text-2xl md:text-3xl font-bold text-white mb-4"><?php echo $cta_title; ?></h3>
    <p class="text-white/60 mb-8 max-w-xl mx-auto"><?php echo wpautop($cta_sub); ?></p>
    <a href="<?php echo esc_url($cta_url); ?>" target="_blank" rel="noopener noreferrer"
       class="inline-flex items-center gap-2 bg-omni-accent hover:bg-omni-accent-hover text-white font-bold py-4 px-8 rounded-full transition-all shadow-lg hover:-translate-y-1">
      <i data-lucide="phone" class="h-5 w-5"></i>
      <?php echo $cta_btn; ?>
    </a>
  </div>

</div>

</main>

<?php get_footer(); ?>
