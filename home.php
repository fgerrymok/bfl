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
    <section class='hero-section'>
    <?php
        // Page ID to fetch the ACF field from
        $page_id = 12;
        $page = get_post($page_id);
        if ($page) {
            echo '<h1>' . esc_html($page->post_title) . '</h1>';
     
            $featured_video_section = get_field('featured_video_section', $page_id);
            if($featured_video_section){
                $featured_video      = $featured_video_section['fetured_video_url'];
                $featured_video_text = $featured_video_section['featured_video_text'];

                if($featured_video){
                    ?>
                    <div class='featured-video'>
                        <?php echo ($featured_video); ?>
                    </div>
                    <?php
                }
                if($featured_video_text){
                    ?>
                     <div class='featured-text'>
                        <p>
                            <?php echo esc_html($featured_video_text); ?>
                        </p>
                    </div>
                    <?php
                }
            }

        } else {
            echo '<p>Page not found.</p>';
        }
    ?>
    </section>

    <!-- TESTING NOW -->
        



    <!-- END HERO SECTION -->
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
    'posts_per_page' => 9,
    'orderby'        => 'date',
    'order'          => 'DESC',
];

$query = new WP_Query($args);

if ($query->have_posts()) {
    while ($query->have_posts()) {
        $query->the_post();

        echo '<div class="video-item">';

  
        if (has_post_thumbnail()) {
  
            $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'medium');
            if ($thumbnail_url) {
                $post_permalink = get_permalink();
                if ($post_permalink) {
           
                    echo '<a href="' . esc_url($post_permalink) . '" target="_blank">';
                    echo '<img src="' . esc_url($thumbnail_url) . '" alt="' . esc_attr(get_the_title()) . ' Thumbnail">';
                    echo '</a>';
                }
            }
        } else {
            $content = get_the_content();
            $videos  = get_media_embedded_in_content($content, ['video', 'iframe']);

            if (!empty($videos)) {
                $thumbnail_url = get_acf_oembed_thumbnail($videos[0]);
            
                if ($thumbnail_url) {
                    echo '<div class="video-item">';
                    echo '<a href="#" class="video-thumbnail" data-video-url="' . esc_url($videos[0]) . '">';
                    echo '<img src="' . esc_url($thumbnail_url) . '" alt="Video Thumbnail">';
                    echo '</a>';
                    echo '</div>';
                }
            }
             else {
                if (have_rows('add_a_video')) {
                    while (have_rows('add_a_video')) {
                        the_row();
                        $embed_video = get_sub_field('video_url', false, false);
                    
                        // Assuming $embed_video holds the YouTube URL
                        if ($embed_video) {
                            $video_id = '';
                        // Extract the video ID
                        if (strpos($embed_video, 'youtube.com/watch?v=') !== false) {
                            parse_str(parse_url($embed_video, PHP_URL_QUERY), $query_vars);
                            $video_id = $query_vars['v'];
                        } elseif (strpos($embed_video, 'youtu.be') !== false) {
                            $path = parse_url($embed_video, PHP_URL_PATH);
                            $video_id = trim($path, '/');
                        }

                        if (!empty($video_id)) {
                            $embed_url = 'https://www.youtube.com/embed/' . esc_attr($video_id);
                            $thumbnail_url = 'https://img.youtube.com/vi/' . esc_attr($video_id) . '/hqdefault.jpg';

                            echo '<div class="video-item">';
                            echo '<img 
                                    src="' . esc_url($thumbnail_url) . '" 
                                    data-video-url="' . esc_url($embed_url) . '" 
                                    alt="Video Thumbnail" 
                                    class="video-thumbnail">';
                            echo '</div>';
                        }
                        }
                        
                    }
                }
                
            }
        }
?>
        <p class="card-date"><?php echo get_the_date('M j'); ?></p>
        <p class="card-title"><?php echo the_title(); ?></p>
    </div>
<?php
    }
} else {
    echo '<p>No posts found.</p>';
}

wp_reset_postdata();
?>
        <button id="load-more" data-page="1">Load More</button>
        <div id="video-modal" class="modal">
            <div class="modal-inner">
                <span id="close-modal" class="close">&times;</span>
                <div id="modal-content"></div>
            </div>
        </div>

</div>

</div>

    </section>
 </main>
 <?php
 get_footer();