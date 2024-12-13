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
 </section>
 <section class='videos-section'>
     <?php
         // Custom Query for Videos
         $args = array(
             'post_type'      => 'post',
             'posts_per_page' => 9,
             'orderby'        => 'date',
             'order'          => 'DESC',
         );
 
         $query = new WP_Query($args);
         if ($query->have_posts()) {
             while ($query->have_posts()) {
                 $query->the_post();
 
                 echo '<div class="video-item">';
 
                 // Extract videos from the post content
                 $content = get_the_content();
                 $videos = get_media_embedded_in_content($content, array('video', 'iframe'));
 
                 if (!empty($videos)) {
                     // Display the first video found
                     echo $videos[0];
                 } else {
                     echo '<p>No video available for this post.</p>';
                 }
 
                 // Display the title
                 echo '<h3>' . get_the_title() . '</h3>';
 
                 echo '</div>';
             }
         } else {
             echo '<p>No posts found.</p>';
         }
 
         wp_reset_postdata();
     ?>
 </section>
 
 </main>
 <?php
 get_footer();
 