<?php
get_header();

pageBanner(array(
    'title' => 'Past Events',
    'subtitle' => 'See what\'s Happened'
))

?>



<div class="container container--narrow page-section">
    <?php

    $today = date('Ymd');
    //Custom Query for event posts
    $pastEvents = new WP_Query(array(
        'paged' => get_query_var('paged', 1),
        'post_type' => 'event',
        'meta_key' => 'event_date', //describes the meta key to look for
        'orderby' => 'meta_value_num', //tell wp to order by meta value
        'order' => 'ASC',
        'meta_query' => array( //only show post where
            array(
                'key' => 'event_date', //event date
                'compare' => '<', //is greater than or equal to
                'value' => $today, //today's date
                'type' => 'numeric' //specify types of values to look for.
            )
        )
    ));

    while ($pastEvents->have_posts()) {
        $pastEvents->the_post(); ?>
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
                <p><?php echo wp_trim_words(get_the_content(), '18') ?><a href="<?php the_permalink() ?>" class="nu gray">Learn more</a></p>
            </div>
        </div>

    <?php
    }
    echo paginate_links(array(
        'total' => $pastEvents->max_num_pages
    ));
    ?>
</div>



<?php
get_footer();
?>