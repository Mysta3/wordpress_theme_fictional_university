<?php
//add header
get_header();




//body content - BEGINNING
while (have_posts()) {
    the_post();
    pageBanner();

?>



    <div class="container container--narrow page-section">
        <div class="metabox metabox--position-up metabox--with-home-link">
            <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('campus') ?>"><i class="fa fa-home" aria-hidden="true"></i> All Campuses</a> <span class="metabox__main"><?php the_title() ?></span></p>
        </div>

        <div class="generic-content">
            <?php the_content();  ?>
        </div>

        <?php
        $relatedPrograms = new WP_Query(array(
            'posts_per_page' => -1, //-1 returns everything that meets the query.
            'post_type' => 'program',
            'orderby' => 'title',
            'order' => 'ASC',
            'meta_query' => array( //only show post where
                array(
                    'key' => 'related_campus',
                    'compare' => 'LIKE',
                    'value' => '"' . get_the_ID() . '"'
                )
            )
        ));

        if ($relatedPrograms->have_posts()) {
            echo '<hr class="section-break"/>';
            echo '<h2 class="headline headline--medium">Programs Available At This Campus</h2>';


            echo '<ul class="min-list link-list">';
            while ($relatedPrograms->have_posts()) { //repeats as long as posts are there
                $relatedPrograms->the_post(); //gets data ready for each post
        ?>
                <li>
                    <a href="<?php the_permalink() ?>">
                        <?php the_title();  ?>
                    </a>
                </li>
        <?php  }

            echo '</ul>';
        }

        wp_reset_postdata(); //run in between 2 queries
        //  *********************************************


        //ENABLE IF YOU CREATE A RELATIONSHIP BETWEEN CAMPUSES & EVENTS
        // $today = date('Ymd');
        // //Custom Query for 2 most rapidly approaching upcoming event posts
        // $homepageEvents = new WP_Query(array(
        //     'posts_per_page' => 2, //-1 returns everything that meets the query.
        //     'post_type' => 'event',
        //     'meta_key' => 'event_date', //describes the meta key to look for
        //     'orderby' => 'meta_value_num', //tell wp to order by meta value
        //     'order' => 'ASC',
        //     'meta_query' => array( //only show post where
        //         array(
        //             'key' => 'event_date', //event date
        //             'compare' => '>=', //is greater than or equal to
        //             'value' => $today, //today's date
        //             'type' => 'numeric' //specify types of values to look for.
        //         ),
        //         array(
        //             'key' => 'related_programs',
        //             'compare' => 'LIKE',
        //             'value' => '"' . get_the_ID() . '"'
        //         )
        //     )
        // ));

        // if ($homepageEvents->have_posts()) {
        //     echo '<hr class="section-break"/>';
        //     echo '<h2 class="headline headline--medium">Upcoming ' . get_the_title() . ' Events</h2>';

        //     while ($homepageEvents->have_posts()) { //repeats as long as posts are there
        //         $homepageEvents->the_post(); //gets data ready for each post

        //         //takes two arguments(location,whatever the dash you want to add example: excerpt)
        //         //2nd arg is optional
        //         get_template_part('template-parts/content', 'event');
        //     }
        // }

        ?>

    </div>

    <!-- body content - END -->
<?php }

//add footer
get_footer();
?>