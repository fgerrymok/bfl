<?php 

function bfl_load_more_posts() {
    
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $posts_per_page = isset($_GET['posts_per_page']) ? intval($_GET['posts_per_page']) : 8;


    $args = [
        'post_type' => 'bfl-news',
        'posts_per_page' => $posts_per_page,
        'paged' => $page,
    ];

    $query = new WP_Query($args);

    $html = '';
    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            ob_start();
            ?>
                <div class="news-item">
                    <a href="<?php the_permalink(); ?>">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="news-image">
                            <?php echo wp_get_attachment_image(get_post_thumbnail_id(), 'full', false, ['class' => 'card-thumbnail-img news']); ?>
                        </div>
                    <?php endif; ?>
                        <p class="card-date news"><?php echo get_the_date( 'M j' ); ?></p>
                        <p class="card-title news"><?php echo the_title(); ?></p>
                    </a>
                </div>
            <?php
            $html .= ob_get_clean();
        endwhile;
        wp_reset_postdata();
    endif;

    $has_more = $query->max_num_pages > $page;

    wp_send_json_success(['html' => $html, 'has_more' => $has_more]);
}
add_action('wp_ajax_load_more_posts', 'bfl_load_more_posts');
add_action('wp_ajax_nopriv_load_more_posts', 'bfl_load_more_posts');
