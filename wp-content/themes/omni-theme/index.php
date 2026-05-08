<?php
get_header();
?>
<main style="padding: 2rem; text-align: center;">
    <h1>Welcome to Omni Theme</h1>
    <p>This is a custom theme for omnichannel.biz.id</p>
    <?php
    if ( have_posts() ) :
        while ( have_posts() ) : the_post();
            the_content();
        endwhile;
    endif;
    ?>
</main>
<?php
get_footer();
