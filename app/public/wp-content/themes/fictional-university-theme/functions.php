<?php

//REUSEABLE FUNCTION for page banner
function pageBanner($args = NULL)
{
    //default value for title and subtitle
    if (!$args['title']) {
        $args['title'] = get_the_title();
    }

    if (!$args['subtitle']) {
        $args['subtitle'] = get_field('page_banner_subtitle');
    }

    if (!$args['photo']) {
        if (get_field('page_banner_background_image') and !is_archive() and !is_home()) {
            $args['photo'] = get_field('page_banner_background_image')['sizes']['pageBanner'];
        } else {
            $args['photo'] = get_theme_file_uri('/images/ocean.jpg');
        }
    }

?>
    <div class="page-banner">
        <div class="page-banner__bg-image" style="background-image: url(<?php echo $args['photo'] ?>);"></div>
        <div class="page-banner__content container container--narrow">
            <h1 class="page-banner__title"><?php echo $args['title'] ?></h1>
            <div class="page-banner__intro">
                <p><?php echo $args['subtitle'] ?></p>
            </div>
        </div>
    </div>
<?php };

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
        wp_enqueue_script('main-university-js', get_theme_file_uri('/bundled-assets/scripts.0bb0a6ecbcf3d344dd44.js'), NULL, '1.0', true);
        wp_enqueue_style('our-main-styles', get_theme_file_uri('/bundled-assets/styles.0bb0a6ecbcf3d344dd44.css'));
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
    add_theme_support('post-thumbnails');

    add_image_size('professorLandscape', 400, 260, false); //args('nickname', width, height, crop) crop can be true,false, or array
    add_image_size('professorPortrait', 480, 650, false);
    add_image_size('pageBanner', 1500, 350, true);
}
//call function
add_action('after_setup_theme', 'university_features');
// -------------------------------

//UNIVERSITY ADJUST QUERIES

// -------------------------------
function university_adjust_queries($query)
{
    /*
    FOR GOOGLE MAPS 
    if (!is_admin() and is_post_type_archive('campus') and $query->is_main_query()) {
        $query->set('posts_per_page', -1);
    }

    */

    if (!is_admin() and is_post_type_archive('program') and $query->is_main_query()) {
        $query->set('orderby', 'title');
        $query->set('order', 'ASC');
        $query->set('posts_per_page', -1);
    }

    if (!is_admin() and is_post_type_archive('event') and $query->is_main_query()) {
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


//GOOGLE MAPS IMPLEMENTATIONS

// function universityMapKey($api)
// {
//     $api['key'] = 'enter API key here';
//     return $api;
// }
// add_filter('acf/fields/google_map/api', 'universityMapKey');
