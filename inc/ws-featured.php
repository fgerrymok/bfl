<?php

// List of CPTs to add the 'Featured' functionality
$cpts_with_featured = ['bfl-events', 'post'];

// Add 'Featured' column to each CPT in the list
function add_featured_column_to_cpts($cpts) {
    foreach ($cpts as $cpt) {
        add_filter("manage_{$cpt}_posts_columns", function ($columns) {
            $columns['featured'] = 'Featured';
            return $columns;
        });

        // Display 'Featured' status and toggle link
        add_action("manage_{$cpt}_posts_custom_column", function ($column, $post_id) {
            if ($column === 'featured') {
                $is_featured = get_post_meta($post_id, '_is_featured', true);
                $featured_class = $is_featured ? 'dashicons-star-filled' : 'dashicons-star-empty';
                $toggle_action = $is_featured ? 'unset_featured' : 'set_featured';

                echo '<a href="' . esc_url(admin_url("admin-post.php?action=$toggle_action&post_id=$post_id")) . '">
                        <span class="dashicons ' . $featured_class . '"></span>
                      </a>';
            }
        }, 10, 2);
    }
}
add_featured_column_to_cpts($cpts_with_featured);

// Handle the 'Featured' toggle action
function toggle_featured_status() {
    if (isset($_GET['post_id']) && isset($_GET['action'])) {
        $post_id = intval($_GET['post_id']);
        $action = sanitize_text_field($_GET['action']);

        if ($action === 'set_featured') {
            update_post_meta($post_id, '_is_featured', true);
        } elseif ($action === 'unset_featured') {
            delete_post_meta($post_id, '_is_featured');
        }
    }

    // Redirect back to the previous page
    wp_redirect(wp_get_referer());
    exit;
}
add_action('admin_post_set_featured', 'toggle_featured_status');
add_action('admin_post_unset_featured', 'toggle_featured_status');


// Copy and add it to your WP_Query args
//  
// $args = [
//     'post_type' => 'bfl-events', // CPT Type
//     'meta_query' => [
//         [
//             'key' => '_is_featured',
//             'value' => true,
//             'compare' => '='
//         ]
//     ]
// ];