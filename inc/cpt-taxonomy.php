<?php

// Change default 'Post' labels to 'Videos' and update the menu icon.
function change_post_object_labels_to_video() {
    $post_type = get_post_type_object('post');

    if ($post_type) {
        $labels = $post_type->labels;

        $new_labels = array(
            'name'                  => 'Videos',
            'singular_name'         => 'Video',
            'add_new'               => 'Add Video',
            'add_new_item'          => 'Add New Video',
            'edit_item'             => 'Edit Video',
            'new_item'              => 'New Video',
            'view_item'             => 'View Video',
            'search_items'          => 'Search Videos',
            'not_found'             => 'No Videos found',
            'not_found_in_trash'    => 'No Videos found in Trash',
            'all_items'             => 'All Videos',
            'menu_name'             => 'Videos',
            'name_admin_bar'        => 'Video',
        );

        // Update the default labels with the new ones
        foreach ($new_labels as $key => $value) {
            if (isset($labels->$key)) {
                $labels->$key = $value;
            }
        }
    }

    // Change the admin menu icon for the 'Post' type
    add_action('admin_menu', function() {
        global $menu;
        foreach ($menu as $key => $value) {
            if ($value[2] == 'edit.php') {
                $menu[$key][6] = 'dashicons-video-alt3';
            }
        }
    });
}
add_action('init', 'change_post_object_labels_to_video');


function bfl_register_custom_post_types() {

    // Register Events CPT
	$labels = array(
        'name' => _x( 'Events', 'post type general name' ),
        'singular_name' => _x( 'Event', 'post type singular name'),
        'menu_name' => _x( 'Events', 'admin menu' ),
        'name_admin_bar' => _x( 'Event', 'add new on admin bar' ),
        'add_new' => _x( 'Add New', 'Event' ),
        'add_new_item' => __( 'Add New Event' ),
        'new_item' => __( 'New Event' ),
        'edit_item' => __( 'Edit Event' ),
        'view_item' => __( 'View Event' ),
        'all_items' => __( 'All Events' ),
        'search_items' => __( 'Search Events' ),
        'parent_item_colon' => __( 'Parent Events:' ),
        'not_found' => __( 'No Events found.' ),
        'not_found_in_trash' => __( 'No Events found in Trash.' ),
        'archives' => __( 'Event Archives'),
        'insert_into_item' => __( 'Insert into Event'),
        'uploaded_to_this_item' => __( 'Uploaded to this Event'),
        'filter_item_list' => __( 'Filter Events list'),
        'items_list_navigation' => __( 'Events list navigation'),
        'items_list' => __( 'Events list'),
        'featured_image' => __( 'Event featured image'),
        'set_featured_image' => __( 'Set Event featured image'),
        'remove_featured_image' => __( 'Remove Event featured image'),
        'use_featured_image' => __( 'Use as featured image'),
        );
    
        $args = array(
            'labels' => $labels,
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_nav_menus' => true,
            'show_in_admin_bar' => true,
            'show_in_rest' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => 'events' ),
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => 50,
            'menu_icon' => 'dashicons-id',
            'supports' => array( 'title', 'thumbnail', 'editor' ),
        );
        register_post_type( 'bfl-events', $args );
}

add_action('init', 'bfl_register_custom_post_types');



// // Register Custom Post Types
// function bfl_register_custom_post_types() {
//     $post_types = [
//         'bfl-events' => [
//             'name' => 'Events',
//             'singular_name' => 'Event',
//             'menu_icon' => 'dashicons-text-page',
//         ],
//         'bfl-results' => [
//             'name' => 'Results',
//             'singular_name' => 'Result',
//             'menu_icon' => 'dashicons-chart-line',
//         ],
//         'bfl-news' => [
//             'name' => 'News',
//             'singular_name' => 'News',
//             'menu_icon' => 'dashicons-star-filled',
//         ],
//         'bfl-fighters' => [
//             'name' => 'Fighters',
//             'singular_name' => 'Fighter',
//             'menu_icon' => 'dashicons-universal-access-alt',
//         ],
//     ];

//     foreach ($post_types as $slug => $details) {
//         $labels = [
//             'name' => _x($details['name'], 'post type general name'),
//             'singular_name' => _x($details['singular_name'], 'post type singular name'),
//             'menu_name' => _x($details['name'], 'admin menu'),
//             'add_new_item' => __('Add New ' . $details['singular_name']),
//             'edit_item' => __('Edit ' . $details['singular_name']),
//             'view_item' => __('View ' . $details['singular_name']),
//             'all_items' => __('All ' . $details['name']),
//             'search_items' => __('Search ' . $details['name']),
//         ];

//         $args = [
//             'labels' => $labels,
//             'public' => true,
//             'show_ui' => true,
//             'show_in_menu' => true,
//             'menu_icon' => $details['menu_icon'],
//             'supports' => ['title', 'thumbnail', 'editor'],
//             'has_archive' => true,
//         ];

//         register_post_type($slug, $args);
//     }
// }
// add_action('init', 'bfl_register_custom_post_types');

// Register Taxonomies
function bfl_register_taxonomies() {
    $taxonomies = [
        'bfl-weight-class' => [
            'name' => 'Weight Class',
            'post_types' => ['bfl-fighters'],
            'default_terms' => ['Bantamweight', 'Featherweight', 'Lightweight', 'Super Lightweight', 'Welterweight', 'Super Welterweight'],
        ],
        'bfl-fighter-category' => [
            'name' => 'Fighter Category',
            'post_types' => ['bfl-fighters'],
            'default_terms' => ['Men’s Professional', 'Women’s Professional', 'Women’s Amateur', 'Kickboxing'],
        ],
        'bfl-results-type' => [
            'name' => 'Results Type',
            'post_types' => ['bfl-results'],
            'default_terms' => ['Fight Results', 'Weigh-In Results'],
        ],
        'bfl-event-type' => [
            'name' => 'Event Type',
            'post_types' => ['bfl-events'],
            'default_terms' => ['Upcoming Events', 'Past Events'],
        ],
    ];

    foreach ($taxonomies as $slug => $details) {
        $labels = [
            'name' => _x($details['name'], 'taxonomy general name'),
            'singular_name' => _x($details['name'], 'taxonomy singular name'),
            'search_items' => __('Search ' . $details['name']),
            'all_items' => __('All ' . $details['name']),
            'edit_item' => __('Edit ' . $details['name']),
            'add_new_item' => __('Add New ' . $details['name']),
        ];

        $args = [
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'show_admin_column' => true,
            'show_in_rest' => true,
            'query_var' => true,
            'rewrite' => ['slug' => $slug],
        ];

        register_taxonomy($slug, $details['post_types'], $args);

        // Add default terms
        if (!empty($details['default_terms'])) {
            foreach ($details['default_terms'] as $term) {
                if (!term_exists($term, $slug)) {
                    wp_insert_term($term, $slug);
                }
            }
        }
    }
}
add_action('init', 'bfl_register_taxonomies');
