<!-- Shared Footer -->
<footer class="bg-[#1C2C1F] text-white/70 py-12 border-t border-white/10 mt-auto">
  <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-8">
    <div class="col-span-1 md:col-span-2">
      <div class="flex items-center gap-2 mb-4">
        <?php if ( function_exists( 'has_custom_logo' ) && has_custom_logo() ) : ?>
            <?php the_custom_logo(); ?>
        <?php else : ?>
            <div class="bg-[#415B45] p-2 rounded-lg">
              <i data-lucide="headphones" class="h-5 w-5 text-white"></i>
            </div>
            <span class="font-bold text-xl tracking-tight text-white"><?php bloginfo( 'name' ); ?></span>
        <?php endif; ?>
      </div>
      <p class="max-w-xs text-sm leading-relaxed mb-6">
        Satu layar untuk semua saluran. Tingkatkan kepuasan pelanggan dengan sistem omnichannel terbaik.
      </p>
    </div>
    <div>
      <h4 class="text-white font-semibold mb-4">Produk</h4>
      <ul class="space-y-2 text-sm">
        <li><a href="<?php echo home_url('/fitur'); ?>" class="hover:text-[#FDB854] transition-colors">Fitur Utama</a></li>
        <li><a href="<?php echo home_url('/analitik'); ?>" class="hover:text-[#FDB854] transition-colors">Analitik Data</a></li>
        <li><a href="<?php echo home_url('/use-case'); ?>" class="hover:text-[#FDB854] transition-colors">Use Case</a></li>
        <li><a href="<?php echo home_url('/harga'); ?>" class="hover:text-[#FDB854] transition-colors">Harga</a></li>
      </ul>
    </div>
    <div>
      <h4 class="text-white font-semibold mb-4">Perusahaan</h4>
      <ul class="space-y-2 text-sm">
        <li><a href="#" class="hover:text-[#FDB854] transition-colors">Tentang Kami</a></li>
        <li><a href="#" class="hover:text-[#FDB854] transition-colors">Karir</a></li>
        <li><a href="#" class="hover:text-[#FDB854] transition-colors">Hubungi Kami</a></li>
      </ul>
    </div>
  </div>
  <div class="max-w-7xl mx-auto px-6 mt-12 pt-8 border-t border-white/10 text-sm flex flex-col md:flex-row justify-between items-center text-center">
    <p>&copy; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?>. Hak Cipta Dilindungi. Theme Design by Harizal.</p>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
