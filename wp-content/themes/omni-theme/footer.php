<!-- Footer -->
<footer class="bg-slate-900 text-slate-400 py-12 border-t border-slate-800">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid md:grid-cols-4 gap-8">
    <div class="col-span-1 md:col-span-2 space-y-4">
      <div class="flex items-center gap-2">
        <?php if ( function_exists( 'has_custom_logo' ) && has_custom_logo() ) : ?>
            <?php the_custom_logo(); ?>
        <?php else : ?>
            <div class="bg-blue-600 p-1.5 rounded-lg inline-block">
            <i data-lucide="headphones" class="h-5 w-5 text-white"></i>
            </div>
            <span class="font-bold text-xl tracking-tight text-white"><?php bloginfo( 'name' ); ?></span>
        <?php endif; ?>
      </div>
      <p class="max-w-xs">
        Membawa masa depan layanan pelanggan ke bisnis Anda hari ini melalui platform omnichannel revolusioner.
      </p>
    </div>
    <div>
      <h4 class="text-white font-semibold mb-4">Produk</h4>
      <ul class="space-y-2">
        <li><a href="#" class="hover:text-white transition-colors">Fitur Utama</a></li>
        <li><a href="#" class="hover:text-white transition-colors">Harga</a></li>
        <li><a href="#" class="hover:text-white transition-colors">Integrasi API</a></li>
        <li><a href="#" class="hover:text-white transition-colors">Keamanan Data</a></li>
      </ul>
    </div>
    <div>
      <h4 class="text-white font-semibold mb-4">Perusahaan</h4>
      <ul class="space-y-2">
        <li><a href="#" class="hover:text-white transition-colors">Tentang Kami</a></li>
        <li><a href="#" class="hover:text-white transition-colors">Karir</a></li>
        <li><a href="#" class="hover:text-white transition-colors">Blog</a></li>
        <li><a href="#" class="hover:text-white transition-colors">Hubungi Kami</a></li>
      </ul>
    </div>
  </div>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-12 pt-8 border-t border-slate-800 text-sm flex flex-col md:flex-row justify-between items-center">
    <p>&copy; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?> Inc. Hak cipta dilindungi undang-undang. Theme Design by Harizal.</p>
    <div class="space-x-4 mt-4 md:mt-0">
      <a href="#" class="hover:text-white transition-colors">Kebijakan Privasi</a>
      <a href="#" class="hover:text-white transition-colors">Syarat & Ketentuan</a>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
