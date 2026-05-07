<?php get_header(); ?>

<main class="pt-[100px] pb-24 bg-white min-h-[calc(100vh-200px)]">
    <div class="max-w-4xl mx-auto px-6">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article class="bg-white rounded-3xl overflow-hidden">
                <!-- Meta Info -->
                <div class="flex items-center gap-4 text-sm text-omni-text-muted font-medium mb-6">
                    <span class="flex items-center gap-1.5 bg-omni-light px-3 py-1 rounded-full text-omni-button">
                        <i data-lucide="calendar" class="w-4 h-4"></i> <?php echo get_the_date(); ?>
                    </span>
                    <span class="flex items-center gap-1.5">
                        <i data-lucide="user" class="w-4 h-4"></i> <?php the_author(); ?>
                    </span>
                </div>

                <!-- Title -->
                <h1 class="text-3xl md:text-5xl font-bold text-omni-dark mb-8 leading-[1.2]"><?php the_title(); ?></h1>

                <!-- Featured Image -->
                <?php if(has_post_thumbnail()) : ?>
                    <div class="rounded-3xl overflow-hidden mb-12 shadow-lg border border-gray-100">
                        <?php the_post_thumbnail('full', ['class' => 'w-full h-auto object-cover max-h-[500px]']); ?>
                    </div>
                <?php endif; ?>

                <!-- Content -->
                <div class="prose prose-lg max-w-none text-omni-text-muted prose-headings:text-omni-dark prose-a:text-omni-accent hover:prose-a:text-omni-accent-hover prose-img:rounded-2xl">
                    <?php the_content(); ?>
                </div>

                <!-- Footer Navigation -->
                <div class="mt-16 pt-8 border-t border-omni-border flex justify-between items-center">
                    <a href="<?php echo home_url('/artikel'); ?>" class="inline-flex items-center gap-2 text-omni-button font-bold hover:text-omni-dark transition-colors">
                        <i data-lucide="arrow-left" class="w-5 h-5"></i> Kembali ke Artikel
                    </a>
                </div>
            </article>
        <?php endwhile; endif; ?>
    </div>
</main>

<?php get_footer(); ?>
