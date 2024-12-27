<?php

function loadmore_posts_handler() {
    $paged = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $paged++;

    $args = [
        'post_type'      => 'post',
        'posts_per_page' => 9,
        'paged'          => $paged,
        'orderby'        => 'date',
        'order'          => 'DESC',
    ];

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            echo render_video_item($query->post);
        }
    } else {
        echo ''; 
    }

    wp_die();
}

add_action('wp_ajax_loadmore_posts', 'loadmore_posts_handler');
add_action('wp_ajax_nopriv_loadmore_posts', 'loadmore_posts_handler');
