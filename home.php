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
 <main id="primary" class="site-main">
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
    <section class="videos-section">
    <div id="video-container">
        <?php
    // Custom function to extract the video thumbnail from an oEmbed URL
function get_acf_oembed_thumbnail($video_url) {
    // First, check if it's a YouTube URL
    if (strpos($video_url, 'youtube.com') !== false || strpos($video_url, 'youtu.be') !== false) {
        // Handle standard YouTube URL
        if (strpos($video_url, 'youtube.com/watch?v=') !== false) {
            parse_str(parse_url($video_url, PHP_URL_QUERY), $query_vars);
            if (isset($query_vars['v'])) {
                $video_id = $query_vars['v'];
            }
        }
        // Handle shortened YouTube URL (youtu.be)
        elseif (strpos($video_url, 'youtu.be') !== false) {
            $path = parse_url($video_url, PHP_URL_PATH);
            $video_id = trim($path, '/');
        }

        // If we got a video ID, create the thumbnail URL
        if (!empty($video_id)) {
            return 'https://img.youtube.com/vi/' . esc_attr($video_id) . '/hqdefault.jpg';
        }
    }

    return ''; // Return empty if no thumbnail found
}


// Initial 9 Videos Load
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

        // Check if the post has a featured image (thumbnail)
        if (has_post_thumbnail()) {
            // Output the post's thumbnail
            $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'medium'); // You can change 'medium' to other sizes like 'large'
            if ($thumbnail_url) {
                // Get the permalink of the current post
                $post_permalink = get_permalink();
                if ($post_permalink) {
                    // Wrap the thumbnail image in a clickable link
                    echo '<a href="' . esc_url($post_permalink) . '" target="_blank">';
                    echo '<img src="' . esc_url($thumbnail_url) . '" alt="' . esc_attr(get_the_title()) . ' Thumbnail">';
                    echo '</a>';
                }
            }
        } else {
            // If no post thumbnail, check if there's a video (either from content or ACF field)
            $content = get_the_content();
            $videos  = get_media_embedded_in_content($content, ['video', 'iframe']);

            if (!empty($videos)) {
                // If video is in post content (block/classic editor)
                $thumbnail_url = get_acf_oembed_thumbnail($videos[0]);
                
                if ($thumbnail_url) {
                    // Get the permalink of the current post
                    $post_permalink = get_permalink();
                
                    // Check if permalink is valid before using it
                    if ($post_permalink) {
                        // Wrap the thumbnail image in a clickable link
                        echo '<a href="' . esc_url($post_permalink) . '" target="_blank">';
                        echo '<img src="' . esc_url($thumbnail_url) . '" alt="Video Thumbnail" style="max-width: 100%; height: auto;">'; // Optional: added style for responsive images
                        echo '</a>';
                    }
                }
            } else {
                // If video is in ACF oEmbed field
                if (have_rows('add_a_video')) {
                    while (have_rows('add_a_video')) {
                        the_row();
                        $embed_video = get_sub_field('video_url',false,false);
                        if ($embed_video) {
                            $thumbnail_url = get_acf_oembed_thumbnail($embed_video);
                            if ($thumbnail_url) {
                                // Display the thumbnail image
                                echo '<img src="' . esc_url($thumbnail_url) . '" alt="Video Thumbnail">';
                            }
                        }
                    }
                }
            }
        }

        // Output the title
        echo '<h3>' . get_the_title() . '</h3>';
        echo '</div>';
    }
} else {
    echo '<p>No posts found.</p>';
}

wp_reset_postdata();
?>
        <button id="load-more" data-page="1">Load More</button>
    </section>
 </main>
 <?php
 get_footer();