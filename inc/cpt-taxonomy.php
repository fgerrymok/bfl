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

// Register custom post types: Events, News, Results, Fighters, General Blog
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
        'not_found' => __( 'No Events found.' ),
        'not_found_in_trash' => __( 'No Events found in Trash.' ),
        'archives' => __( 'Event Archives'),
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 2,
        'menu_icon' => 'dashicons-text-page',
        'supports' => array( 'title', 'thumbnail', 'editor' ),
        'has_archive' => true,
    );
    register_post_type( 'bfl-events', $args );

    // Register Results CPT
    $labels = array(
        'name' => _x( 'Results', 'post type general name' ),
        'singular_name' => _x( 'Result', 'post type singular name'),
        'menu_name' => _x( 'Results', 'admin menu' ),
        'name_admin_bar' => _x( 'Result', 'add new on admin bar' ),
        'add_new' => _x( 'Add New', 'Result' ),
        'add_new_item' => __( 'Add New Result' ),
        'new_item' => __( 'New Result' ),
        'edit_item' => __( 'Edit Result' ),
        'view_item' => __( 'View Result' ),
        'all_items' => __( 'All Results' ),
        'search_items' => __( 'Search Results' ),
        'not_found' => __( 'No Results found.' ),
        'not_found_in_trash' => __( 'No Results found in Trash.' ),
        'archives' => __( 'Result Archives'),
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 2,
        'menu_icon' => 'dashicons-chart-line',
        'supports' => array( 'title', 'thumbnail', 'editor' ),
        'has_archive' => true,
    );
    register_post_type( 'bfl-results', $args );


    // Register News CPT
    $labels = array(
        'name' => _x( 'News', 'post type general name' ),
        'singular_name' => _x( 'News', 'post type singular name'),
        'menu_name' => _x( 'News', 'admin menu' ),
        'name_admin_bar' => _x( 'News', 'add new on admin bar' ),
        'add_new' => _x( 'Add New', 'News' ),
        'add_new_item' => __( 'Add New News' ),
        'new_item' => __( 'New News' ),
        'edit_item' => __( 'Edit News' ),
        'view_item' => __( 'View News' ),
        'all_items' => __( 'All News' ),
        'search_items' => __( 'Search News' ),
        'not_found' => __( 'No News found.' ),
        'not_found_in_trash' => __( 'No News found in Trash.' ),
        'archives' => __( 'News Archives'),
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 4,
        'menu_icon' => 'dashicons-star-filled',
        'supports' => array( 'title', 'thumbnail', 'editor' ),
        'has_archive' => true,
    );
    register_post_type( 'bfl-news', $args );

    

    // Register Fighters CPT
    $labels = array(
        'name' => _x( 'Fighters', 'post type general name' ),
        'singular_name' => _x( 'Fighter', 'post type singular name'),
        'menu_name' => _x( 'Fighters', 'admin menu' ),
        'name_admin_bar' => _x( 'Fighter', 'add new on admin bar' ),
        'add_new' => _x( 'Add New', 'Fighter' ),
        'add_new_item' => __( 'Add New Fighter' ),
        'new_item' => __( 'New Fighter' ),
        'edit_item' => __( 'Edit Fighter' ),
        'view_item' => __( 'View Fighter' ),
        'all_items' => __( 'All Fighters' ),
        'search_items' => __( 'Search Fighters' ),
        'not_found' => __( 'No Fighters found.' ),
        'not_found_in_trash' => __( 'No Fighters found in Trash.' ),
        'archives' => __( 'Fighter Archives'),
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 9,
        'menu_icon' => 'dashicons-universal-access-alt',
        'supports' => array( 'title', 'thumbnail', 'editor' ),
        'has_archive' => true,
    );
    register_post_type( 'bfl-fighters', $args );

}

add_action('init', 'bfl_register_custom_post_types');


// Register Taxonomies
function bfl_register_taxonomies() {
    // 1. Fighter Weight-class
    register_taxonomy(
        'bfl-weight-class',
        'fighters',
        array(
            'labels' => array(
                'name' => __( 'Weight Class' ),
                'singular_name' => __( 'Weight Class' ),
                'search_items' => __( 'Search Weight Classes' ),
                'all_items' => __( 'All Weight Classes' ),
                'edit_item' => __( 'Edit Weight Class' ),
                'update_item' => __( 'Update Weight Class' ),
                'add_new_item' => __( 'Add New Weight Class' ),
                'new_item_name' => __( 'New Weight Class Name' ),
                'menu_name' => __( 'Weight Class' ),
            ),
            'hierarchical' => true,
            'show_ui' => true,
            'show_admin_column' => true,
            'rewrite' => array( 'slug' => 'weight-class' ),
            'show_in_rest' => true,
        )
    );

    // Add default terms for Weight Class
    $weight_classes = array( 'Bantamweight', 'Featherweight', 'Lightweight', 'Super Lightweight', 'Welterweight', 'Super Welterweight' );
    foreach ( $weight_classes as $term ) {
        if ( ! term_exists( $term, 'bfl-weight-class' ) ) {
            wp_insert_term( $term, 'bfl-weight-class' );
        }
    }

    // 2. Fighter Category
    register_taxonomy(
        'bfl-fighter-category',
        'fighters',
        array(
            'labels' => array(
                'name' => __( 'Fighter Category' ),
                'singular_name' => __( 'Fighter Category' ),
                'search_items' => __( 'Search Fighter Categories' ),
                'all_items' => __( 'All Fighter Categories' ),
                'edit_item' => __( 'Edit Fighter Category' ),
                'update_item' => __( 'Update Fighter Category' ),
                'add_new_item' => __( 'Add New Fighter Category' ),
                'new_item_name' => __( 'New Fighter Category Name' ),
                'menu_name' => __( 'Fighter Category' ),
            ),
            'hierarchical' => true,
            'show_ui' => true,
            'show_admin_column' => true,
            'rewrite' => array( 'slug' => 'fighter-category' ),
            'show_in_rest' => true,
        )
    );

    // Add default terms for Fighter Category
    $fighter_categories = array( 'Men’s Professional', 'Women’s Professional', 'Women’s Amateur', 'Kickboxing' );
    foreach ( $fighter_categories as $term ) {
        if ( ! term_exists( $term, 'bfl-fighter-category' ) ) {
            wp_insert_term( $term, 'bfl-fighter-category' );
        }
    }

    // 3. Results Type
    register_taxonomy(
        'bfl-results-type',
        'results',
        array(
            'labels' => array(
                'name' => __( 'Results Type' ),
                'singular_name' => __( 'Results Type' ),
                'search_items' => __( 'Search Results Types' ),
                'all_items' => __( 'All Results Types' ),
                'edit_item' => __( 'Edit Results Type' ),
                'update_item' => __( 'Update Results Type' ),
                'add_new_item' => __( 'Add New Results Type' ),
                'new_item_name' => __( 'New Results Type Name' ),
                'menu_name' => __( 'Results Type' ),
            ),
            'hierarchical' => true,
            'show_ui' => true,
            'show_admin_column' => true,
            'rewrite' => array( 'slug' => 'results-type' ),
            'show_in_rest' => true,
        )
    );

    // Add default terms for Results Type
    $results_types = array( 'Fight Results', 'Weigh-In Results' );
    foreach ( $results_types as $term ) {
        if ( ! term_exists( $term, 'bfl-results-type' ) ) {
            wp_insert_term( $term, 'bfl-results-type' );
        }
    }

    // 4. General Taxonomy
    register_taxonomy(
        'bfl-blog-posts-type',
        'blog-posts',
        array(
            'labels' => array(
                'name' => __( 'Blog Posts Type' ),
                'singular_name' => __( 'Blog Post Type' ),
                'search_items' => __( 'Search Blog Post Types' ),
                'all_items' => __( 'All Blog Post Types' ),
                'edit_item' => __( 'Edit Blog Post Type' ),
                'update_item' => __( 'Update Blog Post Type' ),
                'add_new_item' => __( 'Add New Blog Post Type' ),
                'new_item_name' => __( 'New Blog Post Type Name' ),
                'menu_name' => __( 'Blog Posts Type' ),
            ),
            'hierarchical' => true,
            'show_ui' => true,
            'show_admin_column' => true,
            'rewrite' => array( 'slug' => 'blog-posts-type' ),
            'show_in_rest' => true,
        )
    );

    // Add default terms for Blog Posts Type
    if ( ! term_exists( 'general', 'bfl-blog-posts-type' ) ) {
        wp_insert_term( 'general', 'bfl-blog-posts-type' );
    }

    // 5. Events Taxonomy
    register_taxonomy(
        'bfl-event-type',
        'events',
        array(
            'labels' => array(
                'name' => __( 'Event Type' ),
                'singular_name' => __( 'Event Type' ),
                'search_items' => __( 'Search Event Types' ),
                'all_items' => __( 'All Event Types' ),
                'edit_item' => __( 'Edit Event Type' ),
                'update_item' => __( 'Update Event Type' ),
                'add_new_item' => __( 'Add New Event Type' ),
                'new_item_name' => __( 'New Event Type Name' ),
                'menu_name' => __( 'Event Type' ),
            ),
            'hierarchical' => true,
            'show_ui' => true,
            'show_admin_column' => true,
            'rewrite' => array( 'slug' => 'event-type' ),
            'show_in_rest' => true,
        )
    );

    // Add default terms for Event Type
    $event_types = array( 'Upcoming Events', 'Past Events' );
    foreach ( $event_types as $term ) {
        if ( ! term_exists( $term, 'bfl-event-type' ) ) {
            wp_insert_term( $term, 'bfl-event-type' );
        }
    }
}
add_action( 'init', 'bfl_register_taxonomies' );
