<?php 
function custom_admin_menu_order( $menu_order ) {
    // new menu order
    $new_menu_order = array(
        'index.php',          // Dashboard
        'edit.php?post_type=page', // Pages
        'edit.php',           // Posts
        'upload.php',         // Media
        'edit-comments.php',  // Comments
        'themes.php',         // Appearance
        'plugins.php',        // Plugins
        'users.php',          // Users
        'tools.php',          // Tools
        'options-general.php' // Settings
    );

    return array_merge( array_intersect( $new_menu_order, $menu_order ), array_diff( $menu_order, $new_menu_order ) );
}

// add_filter( 'custom_menu_order', '__return_true' ); 
// add_filter( 'menu_order', 'custom_admin_menu_order' );
