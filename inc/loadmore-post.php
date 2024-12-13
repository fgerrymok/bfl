<?php
add_action('wp_ajax_loadmore_posts', 'loadmore_posts_handler');
add_action('wp_ajax_nopriv_loadmore_posts', 'loadmore_posts_handler');

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
            echo '<div class="video-item">';
            $content = get_the_content();
            $videos = get_media_embedded_in_content($content, ['video', 'iframe']);
            if (!empty($videos)) {
                echo $videos[0];
            } else {
                if (have_rows('add_a_video')) {
                    while (have_rows('add_a_video')) {
                        the_row();
                        $embed_video = get_sub_field('video_url');
                        if ($embed_video) echo $embed_video;
                    }
                }
            }
            echo '<h3>' . get_the_title() . '</h3>';
            echo '</div>';
        }
    } else {
        echo '<p>No more posts to load.</p>';
    }

    wp_die(); // Important for AJAX
}
?>
