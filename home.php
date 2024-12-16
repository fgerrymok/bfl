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
            // Output the page title
            echo '<h1>' . esc_html($page->post_title) . '</h1>';
            // Retrieve the ACF field for this page
            $featured_video = get_field('featured_video_of_videos_page', $page_id);
            if ($featured_video) {
                echo '<div class="featured-video">';
                echo $featured_video;
                echo '</div>';
            } else {
                echo '<p>No featured video available.</p>';
            }
        } else {
            echo '<p>Page not found.</p>';
        }
    ?>
    </section>
    <section class="videos-section">
    <div id="video-container">
        <?php
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
                ?>
                <div class='video-item'>


                <?php
                if (has_post_thumbnail()) {
                    echo '<a href="' . get_permalink() . '">';
                    the_post_thumbnail('medium');
                    echo '</a>';
                } else {
                    echo '<p>No thumbnail available.</p>';
                }
                echo '<h3><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>';
                ?>
                </div>
                <?php
               
            }
        } else {
            echo '<p>No posts found.</p>';
        }
        wp_reset_postdata();
        ?>
    </div>
        <button id="load-more" data-page="1">Load More</button>
    </section>
 </main>
 <?php
 get_footer();