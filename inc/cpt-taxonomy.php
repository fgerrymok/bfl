<?php

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

function bfl_register_taxonomies() {
    
    // Add Events Taxonomy
    $labels = array(
        'name'              => _x( 'Event Types', 'taxonomy general name' ),
        'singular_name'     => _x( 'Event Type', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Event Types' ),
        'all_items'         => __( 'All Event Types' ),
        'parent_item'       => __( 'Parent Event Type' ),
        'parent_item_colon' => __( 'Parent Event Type:' ),
        'edit_item'         => __( 'Edit Event Types' ),
        'update_item'       => __( 'Update Event Types' ),
        'add_new_item'      => __( 'Add New Event Type' ),
        'new_item_name'     => __( 'New Event Type' ),
        'menu_name'         => __( 'Event Types' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'event-type' ),
    );

    register_taxonomy( 'bfl-event-type', array( 'bfl-events' ), $args );
}

add_action('init', 'bfl_register_taxonomies');