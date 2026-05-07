<?php get_header(); ?>

<main class="pt-[100px] pb-24 bg-omni-light min-h-[calc(100vh-200px)]">
    <div class="max-w-6xl mx-auto px-6">
        <div class="text-center mb-16">
            <h1 class="text-4xl md:text-5xl font-bold text-omni-dark mb-4">Artikel & Insights</h1>
            <p class="text-omni-text-muted text-lg max-w-2xl mx-auto">
                Temukan berbagai informasi, tips, dan update terbaru seputar layanan pelanggan dan teknologi omnichannel.
            </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php 
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $args = array(
                'post_type' => 'post',
                'post_status' => 'publish',
                'posts_per_page' => 9,
                'paged' => $paged
            );
            $query = new WP_Query($args);

            if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); 
            ?>
                <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl border border-omni-border group transition-all duration-300 hover:-translate-y-2 flex flex-col h-full">
                    <?php if(has_post_thumbnail()) : ?>
                        <div class="h-48 overflow-hidden relative">
                            <a href="<?php the_permalink(); ?>" class="block w-full h-full">
                                <?php the_post_thumbnail('medium_large', ['class' => 'w-full h-full object-cover group-hover:scale-110 transition-transform duration-500']); ?>
                            </a>
                            <div class="absolute inset-0 bg-black/10 group-hover:bg-transparent transition-colors"></div>
                        </div>
                    <?php else: ?>
                        <div class="h-48 bg-omni-dark flex items-center justify-center relative overflow-hidden">
                             <a href="<?php the_permalink(); ?>" class="absolute inset-0 z-10"></a>
                             <i data-lucide="image" class="w-12 h-12 text-white/20"></i>
                        </div>
                    <?php endif; ?>
                    
                    <div class="p-6 flex flex-col flex-1">
                        <div class="text-xs text-omni-accent font-bold mb-3 tracking-wide uppercase">
                            <?php echo get_the_date(); ?>
                        </div>
                        <h2 class="text-xl font-bold text-omni-dark mb-3 leading-tight group-hover:text-omni-button transition-colors">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h2>
                        <div class="text-omni-text-muted text-sm mb-6 flex-1">
                            <?php echo wp_trim_words(get_the_excerpt(), 18); ?>
                        </div>
                        
                        <a href="<?php the_permalink(); ?>" class="inline-flex items-center text-omni-dark font-bold text-sm group-hover:text-omni-accent transition-colors mt-auto w-fit">
                            Baca Artikel <i data-lucide="arrow-right" class="w-4 h-4 ml-1 transition-transform group-hover:translate-x-1"></i>
                        </a>
                    </div>
                </div>
            <?php endwhile; ?>
            
            <div class="col-span-full pt-8 flex justify-center">
                <?php 
                echo paginate_links(array(
                    'total' => $query->max_num_pages,
                    'current' => $paged,
                    'prev_text' => '&laquo; Prev',
                    'next_text' => 'Next &raquo;',
                    'class' => 'flex gap-2'
                )); 
                ?>
            </div>
            
            <?php wp_reset_postdata(); else : ?>
                <div class="col-span-full text-center py-20">
                    <i data-lucide="file-text" class="w-16 h-16 text-omni-border mx-auto mb-4"></i>
                    <h3 class="text-2xl font-bold text-omni-dark mb-2">Belum ada artikel</h3>
                    <p class="text-omni-text-muted">Artikel baru akan segera hadir.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>
