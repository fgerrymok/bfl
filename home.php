<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package BFL
 */
 get_header();
 ?>
 <main id="primary" class="site-main videos-page">
     <section class="hero-section">
        <h1>VIDEOS</h1>
        <?php
        $args = [
            'post_type'      => 'post',
            'posts_per_page' => 1, 
            'orderby'        => 'date',
            'order'          => 'DESC',
        ];

        $hero_query = new WP_Query($args);

        if ($hero_query->have_posts()) {
            while ($hero_query->have_posts()) {
                $hero_query->the_post();
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
                ?>
                <p class="card-date hero"><?php echo get_the_date( 'M j' ); ?></p>
                <p class="card-title hero"><?php echo get_the_title(); ?></p>
                <div class="hero-text"><?php echo apply_filters('the_content', $content); ?></div>
                <?php
            }
        }
        wp_reset_postdata();
        ?>
    </section>
    <section class="videos-section">
    <div id="video-container">
        <?php
    // Custom function to extract the video thumbnail from an oEmbed URL
    function get_acf_oembed_thumbnail($video_url) {

        if (strpos($video_url, 'youtube.com') !== false || strpos($video_url, 'youtu.be') !== false) {
    
            if (strpos($video_url, 'youtube.com/watch?v=') !== false) {
                parse_str(parse_url($video_url, PHP_URL_QUERY), $query_vars);
                if (isset($query_vars['v'])) {
                    $video_id = $query_vars['v'];
                }
            }
    
            elseif (strpos($video_url, 'youtu.be') !== false) {
                $path = parse_url($video_url, PHP_URL_PATH);
                $video_id = trim($path, '/');
            }

            if (!empty($video_id)) {
                return 'https://img.youtube.com/vi/' . esc_attr($video_id) . '/hqdefault.jpg';
            }
        }

        return '';
    }



$args = [
    'post_type'      => 'post',
    'posts_per_page' => 8, 
    'orderby'        => 'date',
    'order'          => 'DESC',
    'offset'         => 1,
];

$query = new WP_Query($args);

if ($query->have_posts()) {
    while ($query->have_posts()) {
        $query->the_post();
        echo render_video_item($query->post);
    }
} else {
    echo '<p>No posts found.</p>';
}

wp_reset_postdata();
?>



                <!-- modal window HTML -->
                <div id="video-modal" class="modal">
                    <div class="modal-inner">
                        <span id="close-modal" class="close">&times;</span>
                        <div id="modal-content"></div>
                    </div>
                </div>
            </div><!-- Video Container END -->

        <!-- Load More Button HTML -->
        <div id="load-more-wrapper">
            <button id="load-more" data-page="1">Load More</button>
        </div>
    </section>
 </main>
 <?php
 get_footer();