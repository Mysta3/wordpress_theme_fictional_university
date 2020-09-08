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
            <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('program') ?>"><i class="fa fa-home" aria-hidden="true"></i> All Programs</a> <span class="metabox__main"><?php the_title() ?></span></p>
        </div>

        <div class="generic-content">
            <?php the_content();  ?>
        </div>

        <?php
        $relatedProfessors = new WP_Query(array(
            'posts_per_page' => 2, //-1 returns everything that meets the query.
            'post_type' => 'professor',
            'orderby' => 'title',
            'order' => 'ASC',
            'meta_query' => array( //only show post where
                array(
                    'key' => 'related_programs',
                    'compare' => 'LIKE',
                    'value' => '"' . get_the_ID() . '"'
                )
            )
        ));

        if ($relatedProfessors->have_posts()) {
            echo '<hr class="section-break"/>';
            echo '<h2 class="headline headline--medium">' . get_the_title() . ' Professors</h2>';


            echo '<ul class="professor-cards">';
            while ($relatedProfessors->have_posts()) { //repeats as long as posts are there
                $relatedProfessors->the_post(); //gets data ready for each post
        ?>
                <li class="professor-card__list-item">
                    <a class="professor-card" href="<?php the_permalink() ?>">
                        <img class="professor-card__image" src="<?php the_post_thumbnail_url('professorLandscape') ?>" alt="">
                        <span class="professor-card__name">
                            <?php the_title();  ?>
                        </span>
                    </a>
                </li>
            <?php  }

            echo '</ul>';
        }

        wp_reset_postdata(); //run in between 2 queries
        //  *********************************************


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