<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package BFL
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <div class="entry-content">
                <?php

                 // Display the post title
                 echo '<h3><a href="' . esc_url(get_permalink()) . '">' . esc_html(get_the_title()) . '</a></h3>';
                 echo '</div>';
                // Display the first embedded video or ACF field
                $content = get_the_content();
                $videos = get_media_embedded_in_content($content, ['video', 'iframe']);

                if (!empty($videos)) {
                    echo '<div class="video-wrapper">' . $videos[0] . '</div>';
                } else {
                    if (have_rows('add_a_video')) {
                        while (have_rows('add_a_video')) {
                            the_row();
                            $embed_video = get_sub_field('video_url');
                            if ($embed_video) echo '<div class="video-wrapper">' . $embed_video . '</div>';
                        }
                    } else {
                        echo '<p>No video found.</p>';
                    }
                }
                ?>
                
                </div>
            </article>
            <!-- social media link buttons for sharing -->
		<ul class="social-share-buttons">
			<?php $image_size = ['24', '24']; ?>
			<!-- facebook -->
			<li>
				<a class="social-facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank" rel="noopener noreferrer">
					<?php echo wp_get_attachment_image(14871, $image_size, false, ['class' => 'social-icon']); ?>
				</a>
			</li>
			<!-- twitter -->
			<li>
				<a class="social-twitter" href="https://twitter.com/intent/tweet?text=<?php echo urlencode(get_the_title()); ?>&url=<?php echo urlencode(get_permalink()); ?>" target="_blank" rel="noopener noreferrer">
					<?php echo wp_get_attachment_image(14874, $image_size, false, ['class' => 'social-icon']); ?>
				</a>
			</li>
			<!-- linkedin -->
			<li>
				<a class="social-linkedin" href="https://www.linkedin.com/shareArticle?url=<?php echo urlencode(get_permalink()); ?>&title=<?php echo urlencode(get_the_title()); ?>" target="_blank" rel="noopener noreferrer">
					<?php echo wp_get_attachment_image(14873, $image_size, false, ['class' => 'social-icon']); ?>
				</a>
			</li>
			<!-- whatsapp -->
			<li>
				<a class="social-whatsapp" href="https://api.whatsapp.com/send?text=<?php echo urlencode(get_the_title() . ' ' . get_permalink()); ?>" target="_blank" rel="noopener noreferrer">
					<?php echo wp_get_attachment_image(14875, $image_size, false, ['class' => 'social-icon']); ?>
				</a>
			</li>
			<!-- copy link -->
			<li>
				<button class="social-copy" id="copy-link">
					<?php echo wp_get_attachment_image(14870, $image_size, false, ['class' => 'social-icon']); ?>
				</button>
			</li>
		</ul>
            <?php
		endwhile;
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
