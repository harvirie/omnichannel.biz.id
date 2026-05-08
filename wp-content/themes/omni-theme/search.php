<?php get_header(); ?>

<main class="pt-[100px] pb-24 bg-omni-light min-h-[calc(100vh-200px)]">
    <div class="max-w-4xl mx-auto px-6">
        <div class="mb-12">
            <h1 class="text-3xl md:text-5xl font-bold text-omni-dark mb-4">Hasil Pencarian</h1>
            <p class="text-lg text-omni-text-muted">Menampilkan hasil untuk: <span class="font-bold">"<?php echo get_search_query(); ?>"</span></p>
        </div>

        <div class="space-y-6">
            <?php 
            $search_query = strtolower(get_search_query());
            $virtual_pages = [
                [
                    'title' => 'Fitur Utama',
                    'url' => home_url('/fitur'),
                    'excerpt' => 'Pelajari semua fitur utama yang ditawarkan oleh omnichannel untuk meningkatkan produktivitas tim dan kepuasan pelanggan.',
                    'keywords' => ['fitur', 'features', 'layanan', 'unggulan']
                ],
                [
                    'title' => 'Use Case',
                    'url' => home_url('/use-case'),
                    'excerpt' => 'Berbagai studi kasus dan contoh penggunaan sistem omnichannel di berbagai industri dan jenis bisnis.',
                    'keywords' => ['use case', 'studi kasus', 'contoh penggunaan', 'industri']
                ],
                [
                    'title' => 'Analitik Data',
                    'url' => home_url('/analitik'),
                    'excerpt' => 'Pantau performa agen dan analisis data interaksi pelanggan secara real-time dengan dashboard analitik komprehensif.',
                    'keywords' => ['analitik', 'data', 'laporan', 'report', 'dashboard', 'statistik']
                ],
                [
                    'title' => 'Harga & Paket',
                    'url' => home_url('/harga'),
                    'excerpt' => 'Pilihan paket harga yang fleksibel untuk bisnis skala kecil hingga enterprise. Mulai berlangganan sekarang.',
                    'keywords' => ['harga', 'paket', 'pricing', 'biaya', 'berlangganan', 'gratis']
                ],
                [
                    'title' => 'Artikel & Insights',
                    'url' => home_url('/artikel'),
                    'excerpt' => 'Kumpulan artikel, panduan, dan tips terbaru seputar layanan pelanggan dan strategi omnichannel.',
                    'keywords' => ['artikel', 'blog', 'berita', 'tips', 'panduan']
                ]
            ];

            $virtual_results = [];
            if (!empty($search_query)) {
                foreach ($virtual_pages as $vp) {
                    // Check if query matches title, excerpt, or keywords
                    $match = false;
                    if (strpos(strtolower($vp['title']), $search_query) !== false) $match = true;
                    if (strpos(strtolower($vp['excerpt']), $search_query) !== false) $match = true;
                    foreach ($vp['keywords'] as $kw) {
                        if (strpos($kw, $search_query) !== false || strpos($search_query, $kw) !== false) {
                            $match = true;
                            break;
                        }
                    }
                    if ($match) $virtual_results[] = $vp;
                }
            }

            $has_results = have_posts() || !empty($virtual_results);
            ?>

            <?php if ($has_results) : ?>
                
                <?php 
                // 1. Tampilkan Hasil Halaman Virtual Dulu
                foreach ($virtual_results as $v_res) : 
                ?>
                    <div class="bg-white p-6 md:p-8 rounded-3xl shadow-sm border border-omni-border hover:shadow-md transition-shadow group relative overflow-hidden">
                        <div class="absolute top-0 right-0 bg-omni-light text-omni-text-muted px-3 py-1 rounded-bl-xl text-xs font-bold uppercase tracking-wider">Halaman Utama</div>
                        <h2 class="text-2xl font-bold text-omni-dark mb-3 group-hover:text-omni-accent transition-colors pr-24">
                            <a href="<?php echo esc_url($v_res['url']); ?>"><?php echo esc_html($v_res['title']); ?></a>
                        </h2>
                        <div class="text-omni-text-muted text-sm mb-4">
                            <?php echo esc_html($v_res['excerpt']); ?>
                        </div>
                        <a href="<?php echo esc_url($v_res['url']); ?>" class="inline-flex items-center text-omni-button font-bold text-sm hover:text-omni-button-hover">
                            Lihat Halaman <i data-lucide="arrow-right" class="w-4 h-4 ml-1"></i>
                        </a>
                    </div>
                <?php endforeach; ?>

                <?php 
                // 2. Tampilkan Hasil Artikel WP Standard
                while (have_posts()) : the_post(); 
                ?>
                    <div class="bg-white p-6 md:p-8 rounded-3xl shadow-sm border border-omni-border hover:shadow-md transition-shadow group">
                        <h2 class="text-2xl font-bold text-omni-dark mb-3 group-hover:text-omni-accent transition-colors">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h2>
                        <div class="text-omni-text-muted text-sm mb-4">
                            <?php echo wp_trim_words(get_the_excerpt(), 25); ?>
                        </div>
                        <a href="<?php the_permalink(); ?>" class="inline-flex items-center text-omni-button font-bold text-sm hover:text-omni-button-hover">
                            Baca Selengkapnya <i data-lucide="arrow-right" class="w-4 h-4 ml-1"></i>
                        </a>
                    </div>
                <?php endwhile; ?>
                
                <div class="pt-8">
                    <?php the_posts_pagination(array(
                        'prev_text' => '&laquo; Sebelumnya',
                        'next_text' => 'Selanjutnya &raquo;',
                        'class'     => 'pagination'
                    )); ?>
                </div>

            <?php else : ?>
                <div class="bg-white p-12 rounded-3xl shadow-sm border border-omni-border text-center">
                    <i data-lucide="search-x" class="w-16 h-16 text-omni-border mx-auto mb-4"></i>
                    <h3 class="text-2xl font-bold text-omni-dark mb-2">Tidak ditemukan</h3>
                    <p class="text-omni-text-muted">Maaf, kami tidak dapat menemukan halaman atau artikel terkait "<strong><?php echo esc_html(get_search_query()); ?></strong>". Silakan coba dengan kata kunci lain.</p>
                    
                    <form method="get" action="<?php echo esc_url(home_url('/')); ?>" class="max-w-md mx-auto mt-8 flex items-center bg-omni-light/50 p-1.5 rounded-full border border-omni-border">
                        <input type="text" name="s" placeholder="Cari kembali..." class="flex-1 px-4 text-sm text-slate-600 bg-transparent outline-none min-w-0" value="<?php echo get_search_query(); ?>" />
                        <button type="submit" class="bg-omni-accent hover:bg-omni-accent-hover transition-colors p-2.5 rounded-full text-white shadow-md">
                            <i data-lucide="search" class="w-5 h-5"></i>
                        </button>
                    </form>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>
