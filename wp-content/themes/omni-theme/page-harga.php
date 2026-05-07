<?php get_header(); ?>

<div class="flex-1 bg-white w-full">
  <div class="py-20 text-center max-w-3xl mx-auto px-6">
    <h1 class="text-4xl md:text-5xl font-bold text-omni-dark mb-6">
      Harga Transparan, <span class="text-omni-secondary">Tanpa Biaya Tersembunyi</span>
    </h1>
    <p class="text-omni-text-muted text-lg">
      Pilih paket yang paling sesuai dengan kebutuhan pusat layanan pelanggan Anda. Semua paket dilengkapi dengan uji coba gratis 14 hari.
    </p>
  </div>

  <div class="max-w-7xl mx-auto px-6 pb-24">
    <div class="grid md:grid-cols-3 gap-8 items-stretch">
      <?php for ($i = 1; $i <= 3; $i++) :
          $default_plans = array(
              1 => array('name' => 'Starter', 'price' => 'Rp 299.000', 'period' => '/agen/bulan', 'desc' => 'Sempurna untuk tim kecil yang baru memulai.', 'btn' => 'Mulai Uji Coba Gratis', 'features' => "Hingga 5 saluran komunikasi\nKotak masuk terpusat\nLaporan standar\nDukungan email 24/7"),
              2 => array('name' => 'Pro', 'price' => 'Rp 799.000', 'period' => '/agen/bulan', 'desc' => 'Fitur lanjutan untuk tim yang berkembang.', 'btn' => 'Mulai Uji Coba Gratis', 'features' => "Semua saluran tidak terbatas\nOtomatisasi & Routing (ACD)\nAnalitik Real-time & Custom\nPrioritas dukungan live chat\nIntegrasi CRM"),
              3 => array('name' => 'Enterprise', 'price' => 'Custom', 'period' => '', 'desc' => 'Skalabilitas dan keamanan maksimal.', 'btn' => 'Hubungi Sales', 'features' => "SLA 99.9% Uptime\nDedicated Account Manager\nKeamanan berbasis peran (RBAC)\nOn-premise deployment option\nPelatihan agen eksklusif")
          );

          $name = get_theme_mod('omni_pricing_'.$i.'_name', $default_plans[$i]['name']);
          $price = get_theme_mod('omni_pricing_'.$i.'_price', $default_plans[$i]['price']);
          $period = get_theme_mod('omni_pricing_'.$i.'_period', $default_plans[$i]['period']);
          $desc = get_theme_mod('omni_pricing_'.$i.'_desc', $default_plans[$i]['desc']);
          $btn = get_theme_mod('omni_pricing_'.$i.'_btn', $default_plans[$i]['btn']);
          $features_raw = get_theme_mod('omni_pricing_'.$i.'_features', $default_plans[$i]['features']);
          $features = array_filter(array_map('trim', explode("\n", $features_raw)));
          
          $is_popular = ($i == 2);
          
          $color_class = $is_popular ? 'bg-omni-dark' : ($i == 1 ? 'bg-white' : 'bg-[#F4F9F0]');
          $text_color = $is_popular ? 'text-white' : 'text-omni-dark';
          $border_shadow = $is_popular ? 'border-omni-accent shadow-2xl relative transform md:-translate-y-4' : 'border-omni-border shadow-md';
          
          $btn_color = $is_popular ? 'bg-omni-accent text-white hover:bg-omni-accent-hover' : ($i == 1 ? 'bg-omni-light text-omni-button-hover hover:bg-omni-border' : 'bg-omni-button-hover text-white hover:bg-omni-dark-border');
      ?>
      <div class="<?php echo esc_attr($color_class . ' ' . $text_color . ' rounded-3xl p-8 border ' . $border_shadow); ?> flex flex-col">
        <?php if ($is_popular) : ?>
          <div class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-omni-accent text-white px-4 py-1 rounded-full text-sm font-bold shadow-md whitespace-nowrap">
            Paling Populer
          </div>
        <?php endif; ?>
        
        <h3 class="text-2xl font-bold mb-2"><?php echo esc_html($name); ?></h3>
        <p class="mb-6 text-sm <?php echo $is_popular ? 'text-white/80' : 'text-omni-text-muted'; ?>">
            <?php echo esc_html($desc); ?>
        </p>
        
        <div class="mb-8">
          <span class="text-4xl font-extrabold"><?php echo esc_html($price); ?></span>
          <span class="text-sm font-medium <?php echo $is_popular ? 'text-white/80' : 'text-omni-button-hover'; ?>"><?php echo esc_html($period); ?></span>
        </div>
        
        <ul class="space-y-4 mb-8 flex-1">
          <?php foreach ($features as $feat) : ?>
            <li class="flex items-start gap-3">
              <i data-lucide="check" class="w-5 h-5 shrink-0 <?php echo $is_popular ? 'text-omni-accent' : 'text-omni-secondary'; ?>"></i>
              <span class="font-medium text-sm md:text-base"><?php echo esc_html($feat); ?></span>
            </li>
          <?php endforeach; ?>
        </ul>
        
        <button class="w-full py-4 rounded-xl font-bold transition-all <?php echo esc_attr($btn_color); ?>">
          <?php echo esc_html($btn); ?>
        </button>
      </div>
      <?php endfor; ?>
    </div>
  </div>
</div>

<?php get_footer(); ?>
