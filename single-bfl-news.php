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

			the_title();

			the_content();
		?>

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
		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
