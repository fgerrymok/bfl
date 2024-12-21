<?php
get_header();
?>

	<main id="primary" class="site-main">

		<?php if ( have_posts() ) : ?>

			<?php
			
			while ( have_posts() ) :
				the_post();
				?>
				<h1 class="single-event-heading"><?php echo esc_html('Past Events'); ?></h1>
				<?php

				$args = array(
					'post_type' => 'bfl-events',
					'posts_per_page' => -1,
				);

				$fightCards = new WP_Query($args);
				
				if ($fightCards->have_posts()) {
					while($fightCards->have_posts()) {
						$fightCards->the_post();
						?>
						<article class="single-event">
						<?php
						$hero = get_field('upcoming_events_hero');
						
						if ($hero) {
							$eventName = $hero['event_name'];
							?>
							<h2><?php echo esc_html($eventName); ?></h2>
							<?php
						}

						$fightCardRepeater = get_field('fight_card');
						if ($fightCardRepeater) {
							foreach ($fightCardRepeater as $row) {
								$fighter1Image = $row['fighter_1_image'];
								$fighter2Image = $row['fighter_2_image'];
								$fighter1Name = $row['fighter_1_name'];
								$fighter2Name = $row['fighter_2_name'];
								echo wp_get_attachment_image($fighter1Image, 'full');
								?>
								<p><?php echo esc_html("vs"); ?></p>
								<?php
								echo wp_get_attachment_image($fighter2Image, 'full');

								?>
								<div class="past-events-fight-details">
									
									<p><?php echo esc_html($fighter1Name); ?></p>
									<p><?php echo esc_html('vs'); ?></p>
									<p><?php echo esc_html($fighter2Name); ?></p>
									<?php
							}
						}

						if ($hero) {
							$fightDate = $hero['fight_date'];
							$venue = $hero['venue'];
							?>
							<p><?php echo esc_html($fightDate); ?></p>
							<p><?php echo esc_html($venue); ?></p>
							<?php
						}
						?>
						<a href="<?php echo get_permalink() ?>"><?php echo esc_html("Fight Card"); ?></a>
						<?php

						$tags = get_the_terms(get_the_ID(), 'post_tag');
						foreach ($tags as $tag) {
							$eventTag = $tag->slug;
							
							if ($eventTag) {
								$args = array(
									'post_type' => 'bfl-results',
									'tax_query' => array(
										array(
											'taxonomy' => 'bfl-results-type',
											'field' => 'slug',
											'terms' => 'fight-results',
										),
										array(
											'taxonomy' => 'post_tag',
											'field' => 'slug',
											'terms' => $eventTag,
										)
									)
								);

								$resultsQuery = new WP_Query($args);

								if ($resultsQuery->have_posts()) {
									$resultsQuery->the_post();
									?>
									<a href="<?php echo esc_url(the_permalink()); ?>"><?php echo esc_html("Results"); ?></a>
									<?php
								}
								wp_reset_postdata();
							}
						}
						
						?>
						</div>
						</article>
						<?php
					}
					
				}

				wp_reset_postdata();

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main>

<?php
get_footer();