<?php

//UNIVERSITY FILES

// -------------------------------
//add styles & scripts to pages function
function university_files()
{
    wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');

    if (strstr($_SERVER['SERVER_NAME'], 'fictional-university.local/')) {
        wp_enqueue_script('main-university-js', 'http://localhost:3000/bundled.js', NULL, '1.0', true);
    } else {
        wp_enqueue_script('our-vendors-js', get_theme_file_uri('/bundled-assets/vendors~scripts.8c97d901916ad616a264.js'), NULL, '1.0', true);
        wp_enqueue_script('main-university-js', get_theme_file_uri('/bundled-assets/scripts.e514aaae8003cfbdaea0.js'), NULL, '1.0', true);
        wp_enqueue_style('our-main-styles', get_theme_file_uri('/bundled-assets/styles.e514aaae8003cfbdaea0.css'));
    }
}
//generates scripts and uses hooks
add_action('wp_enqueue_scripts', 'university_files'); //calls function
// -------------------------------

// UNIVERSITY FEATURES

// -------------------------------
//create function
function university_features()
{
    add_theme_support('title-tag');
}
//call function
add_action('after_setup_theme', 'university_features');
// -------------------------------

//UNIVERSITY ADJUST QUERIES

// -------------------------------
function university_adjust_queries($query)
{
    if (!is_admin() and is_post_type_archive('program') and is_main_query()) {
        $query->set('orderby', 'title');
        $query->set('order', 'ASC');
        $query->set('posts_per_page', -1);
    }

    if (!is_admin() and is_post_type_archive('event') and is_main_query()) {
        $today = date('Ymd'); //today's date
        $query->set('meta_key', 'event_date');
        $query->set('orderby', 'meta_value_num');
        $query->set('order', 'ASC');
        $query->set('meta_query', array( //only show post where
            array(
                'key' => 'event_date', //event date
                'compare' => '>=', //is greater than or equal to
                'value' => $today, //today's date
                'type' => 'numeric' //specify types of values to look for.
            )
        ));
    }
}

add_action('pre_get_posts', 'university_adjust_queries');
// -------------------------------