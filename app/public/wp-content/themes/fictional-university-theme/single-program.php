<?php
//add header
get_header();




//body content - BEGINNING
while (have_posts()) {
    the_post(); ?>

    <div class="page-banner">
        <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg') ?>);"></div>
        <div class="page-banner__content container container--narrow">
            <h1 class="page-banner__title"><?php the_title() ?></h1>
            <div class="page-banner__intro">
                <p>DONT FORGET TO REPLACE ME LATER</p>
            </div>
        </div>
    </div>

    <div class="container container--narrow page-section">
        <div class="metabox metabox--position-up metabox--with-home-link">
            <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('program') ?>"><i class="fa fa-home" aria-hidden="true"></i> All Programs</a> <span class="metabox__main"><?php the_title() ?></span></p>
        </div>

        <div class="generic-content">
            <?php the_content();  ?>
        </div>

        <?php
        $today = date('Ymd');
        //Custom Query for 2 most rapidly approaching upcoming event posts
        $homepageEvents = new WP_Query(array(
            'posts_per_page' => 2, //-1 returns everything that meets the query.
            'post_type' => 'event',
            'meta_key' => 'event_date', //describes the meta key to look for
            'orderby' => 'meta_value_num', //tell wp to order by meta value
            'order' => 'ASC',
            'meta_query' => array( //only show post where
                array(
                    'key' => 'event_date', //event date
                    'compare' => '>=', //is greater than or equal to
                    'value' => $today, //today's date
                    'type' => 'numeric' //specify types of values to look for.
                ),
                array(
                    'key' => 'related_programs',
                    'compare' => 'LIKE',
                    'value' => '"' . get_the_ID() . '"'
                )
            )
        ));

        if ($homepageEvents->have_posts()) {
            echo '<hr class="section-break"/>';
            echo '<h2 class="headline headline--medium">Upcoming ' . get_the_title() . ' Events</h2>';

            while ($homepageEvents->have_posts()) { //repeats as long as posts are there
                $homepageEvents->the_post(); //gets data ready for each post
        ?>
                <div class="event-summary">
                    <a class="event-summary__date t-center" href="#">
                        <span class="event-summary__month"><?php
                                                            $eventDate = new DateTime(get_field('event_date'));
                                                            echo $eventDate->format('M');
                                                            ?></span>
                        <span class="event-summary__day"><?php echo $eventDate->format('d'); ?></span>
                    </a>
                    <div class="event-summary__content">
                        <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h5>
                        <p><?php if (has_excerpt()) {
                                echo  get_the_excerpt();
                            } else {
                                echo wp_trim_words(get_the_content(), 18);
                            } ?><a href="<?php the_permalink() ?>" class="nu gray">Learn more</a></p>
                    </div>
                </div>
        <?php  }
        }

        ?>

    </div>

    <!-- body content - END -->
<?php }

//add footer
get_footer();
?>