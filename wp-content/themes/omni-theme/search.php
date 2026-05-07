<?php get_header(); ?>

<main class="pt-[100px] pb-24 bg-[#EBF4E3] min-h-[calc(100vh-200px)]">
    <div class="max-w-4xl mx-auto px-6">
        <div class="mb-12">
            <h1 class="text-3xl md:text-5xl font-bold text-[#1C2C1F] mb-4">Hasil Pencarian</h1>
            <p class="text-lg text-[#4F6854]">Menampilkan hasil untuk: <span class="font-bold">"<?php echo get_search_query(); ?>"</span></p>
        </div>

        <div class="space-y-6">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <div class="bg-white p-6 md:p-8 rounded-3xl shadow-sm border border-[#d2e3c9] hover:shadow-md transition-shadow group">
                    <h2 class="text-2xl font-bold text-[#1C2C1F] mb-3 group-hover:text-[#FDB854] transition-colors">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h2>
                    <div class="text-[#4F6854] text-sm mb-4">
                        <?php echo wp_trim_words(get_the_excerpt(), 25); ?>
                    </div>
                    <a href="<?php the_permalink(); ?>" class="inline-flex items-center text-[#567558] font-bold text-sm hover:text-[#415B45]">
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
                <div class="bg-white p-12 rounded-3xl shadow-sm border border-[#d2e3c9] text-center">
                    <i data-lucide="search-x" class="w-16 h-16 text-[#d2e3c9] mx-auto mb-4"></i>
                    <h3 class="text-2xl font-bold text-[#1C2C1F] mb-2">Tidak ditemukan</h3>
                    <p class="text-[#4F6854]">Maaf, kami tidak dapat menemukan apa yang Anda cari. Silakan coba dengan kata kunci lain.</p>
                    
                    <form method="get" action="<?php echo esc_url(home_url('/')); ?>" class="max-w-md mx-auto mt-8 flex items-center bg-[#EBF4E3]/50 p-1.5 rounded-full border border-[#d2e3c9]">
                        <input type="text" name="s" placeholder="Cari kembali..." class="flex-1 px-4 text-sm text-slate-600 bg-transparent outline-none min-w-0" value="<?php echo get_search_query(); ?>" />
                        <button type="submit" class="bg-[#FDB854] hover:bg-[#e89e3a] transition-colors p-2.5 rounded-full text-white shadow-md">
                            <i data-lucide="search" class="w-5 h-5"></i>
                        </button>
                    </form>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>
