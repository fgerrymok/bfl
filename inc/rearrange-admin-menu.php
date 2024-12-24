<?php 
function custom_admin_menu_order( $menu_order ) {

    // reorder menu
    $new_menu_order = array(
        'index.php',          // Dashboard
        'edit.php?post_type=bfl-events',   // Events
        'edit.php?post_type=bfl-results', // Results
        'edit.php?post_type=bfl-news',    // News
        'edit.php',                       // Videos (default Posts with changed labels)
        'edit.php?post_type=bfl-fighters', // Fighters
        'upload.php',         // Media
        'edit-comments.php',  // Comments
        'themes.php',         // Appearance
        'plugins.php',        // Plugins
        'users.php',          // Users
        'tools.php',          // Tools
        'options-general.php', // Settings

    );

    
    return array_merge( array_intersect( $new_menu_order, $menu_order ), array_diff( $menu_order, $new_menu_order ) );
}

add_filter( 'custom_menu_order', '__return_true' );
add_filter( 'menu_order', 'custom_admin_menu_order' );
