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
        $pastEvents->the_post();
        //takes two arguments(location,whatever the dash you want to add example: excerpt)
        //2nd arg is optional
        get_template_part('template-parts/content', 'event');
    }
    echo paginate_links(array(
        'total' => $pastEvents->max_num_pages
    ));
    ?>
</div>



<?php
get_footer();
?>