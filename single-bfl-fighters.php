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
		while ( have_posts() ) : the_post(); 
		
	    $current_fighter_id = get_the_ID();
		$current_fighter_name = get_the_title();
		$ranking_page_id = 14581;
		$divisions = get_field('division', $ranking_page_id);
		$fighter_data = null;

		// Find data matching the current CPT title (player name) in the ranking data
        if ($divisions) :
            foreach ($divisions as $division) :
                if (!empty($division['fighter'])) :
                    foreach ($division['fighter'] as $fighter) :
                        if (trim(strtolower($fighter['name'])) === trim(strtolower($current_fighter_name))) :
                            $fighter_data = $fighter;
                            break 2; 
						endif;
                    endforeach;
                endif;
            endforeach;
		endif;
		?>

			<section class="fighter-hero-section">
				<?php
				$image_id = get_field('fighter_banner');
				echo wp_get_attachment_image( $image_id, ['150', '150'], "", [ 'class' => 'fighter-banner' ]);
				?>
				<h1><?php echo esc_html( get_field('single_fighter_name') ); ?></h1>
			</section>
			
			<section class="fighter-profile-section">
				<h2>about fighter</h2>
				
				<p class="fighter-description"><?php echo esc_html( get_field('single_fighter_description') ); ?></p>
				
				<?php
				$image_id = get_field('single_fighter_image');
				echo wp_get_attachment_image( $image_id, ['150', '150'], "", [ 'class' => 'fighter-photo' ]);

				// tags
				$tags = get_the_tags();
				if ($tags) :
					$tag_names = array();
					
					foreach ($tags as $tag) :
						$tag_names[] = $tag->name; 
					endforeach;

					echo implode(', ', $tag_names); 

				endif;

?>




				<!-- Fighter Record Output -->
				<?php if ($fighter_data): ?>
					<div class="fighter-record">
						<p>Rank: <?php echo esc_html($fighter_data['rank']); ?></p>
						<p>Wins: <?php echo esc_html($fighter_data['bfl-win']); ?></p>
						<p>Losses: <?php echo esc_html($fighter_data['bfl-lose']); ?></p>
						<p>Draws: <?php echo esc_html($fighter_data['bfl-draw']); ?></p>
						<p>Overall Record: <?php echo esc_html($fighter_data['all-win']); ?>W -
							<?php echo esc_html($fighter_data['all-lose']); ?>L -
							<?php echo esc_html($fighter_data['all-draw']); ?>D</p>
					</div>
				<?php else: ?>
					<p>No data found for this fighter.</p>
				<?php endif; ?>	
			</section>

			<?php
		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
