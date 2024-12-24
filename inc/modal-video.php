<?php 

function render_video_item($post) {
    setup_postdata($post);
    ob_start(); 
    ?>
    <div class="video-item">
        <?php

  
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
        <p class="card-date video"><?php echo get_the_date( 'M j' ); ?></p>
        <p class="card-title video"><?php echo get_the_title(); ?></p>
    </div>
    <?php
    wp_reset_postdata();
    return ob_get_clean(); 
}
