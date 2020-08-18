<?php
//add header
get_header();


//body content - BEGINNING
while (have_posts()) {
    the_post(); ?>
    <h2>
        <?php the_title(); ?>
    </h2>
    <?php the_content(); ?>
<?php }
//body content - END


//add footer
get_footer();
?>

