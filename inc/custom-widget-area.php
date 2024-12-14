<?php
// Register the first widget area
function custom_widget_area() {
    register_sidebar(array(
        'name'          => __('Custom Widget Area', 'text_domain'), // Widget area name
        'id'            => 'custom-widget-area', // Unique ID for this widget area
        'description'   => __('A widget area for custom widgets.', 'text_domain'), // Description
        'before_widget' => '<div id="%1$s" class="widget %2$s">', // HTML before each widget
        'after_widget'  => '</div>', // HTML after each widget
        'before_title'  => '<h3 class="widget-title">', // HTML before the title
        'after_title'   => '</h3>', // HTML after the title
    ));
}
add_action('widgets_init', 'custom_widget_area');

// Register a second widget area
function another_widget_area() {
    register_sidebar(array(
        'name'          => __('Another Widget Area', 'text_domain'), // Widget area name
        'id'            => 'another-widget-area', // Unique ID for this widget area
        'description'   => __('Another widget area for additional content.', 'text_domain'), // Description
        'before_widget' => '<div id="%1$s" class="widget %2$s">', // HTML before each widget
        'after_widget'  => '</div>', // HTML after each widget
        'before_title'  => '<h3 class="widget-title">', // HTML before the title
        'after_title'   => '</h3>', // HTML after the title
    ));
}
add_action('widgets_init', 'another_widget_area');