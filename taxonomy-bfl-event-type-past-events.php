<?php
get_header();
?>

	<main id="primary" class="site-main">

		<?php if ( have_posts() ) : ?>
			
			<h1 class="single-event-heading"><?php echo esc_html('Past Events'); ?></h1>
			<?php
			
			while ( have_posts() ) :
				the_post();
				$hero = get_field('upcoming_events_hero');
				if ($hero) {
					$eventName = $hero['event_name'];
				}
				?>
				<section class="all-past-events">
				<?php
				$fightCardRepeater = get_field('fight_card');
				if($fightCardRepeater) {
					?>
					<article class="one-past-event">
						<?php
						$mainCard = $fightCardRepeater[0];
						$fighter1Name = $mainCard['fighter_1_name'];
						$fighter1Image = $mainCard['fighter_1_image'];
						$fighter2Name = $mainCard['fighter_2_name'];
						$fighter2Image = $mainCard['fighter_2_image'];

						?>
						<div class="past-event-left">
						<?php
						if (!empty($eventName)) {
							?>
							<div class="past-event-name">
								<h2><?php echo esc_html($eventName); ?></h2>
							</div>
							<?php
						}

						if (!empty($fighter1Image) && !empty($fighter2Image)) {
							?>
							<div class="fighter-images">
								<?php
								echo wp_get_attachment_image($fighter1Image, 'full');
								?>
								<p class="vs"><?php echo esc_html("vs"); ?></p>
								<?php
								echo wp_get_attachment_image($fighter2Image, 'full');
								?>
							</div>
							<?php										
						}
						?>
						</div>

						<div class="past-event-right">
							<div class="past-event-fight-details">
							<?php
							if (!empty($fighter1Name) && !empty($fighter2Name)) {
								?>
								<p class="fight-title"><?php echo $fighter1Name . " vs " . $fighter2Name ?></p>
								<?php
							}

							if ($hero) {
								$venue = $hero['venue'];
								$fightDate = $hero['fight_date'];

								if (!empty($fightDate)) {
									?>
									<p class="fight-date"><?php echo esc_html($fightDate); ?></p>
									<?php
								}
		
								if (!empty($venue)) {
									?>
									<p class="fight-venue"><?php echo esc_html($venue); ?></p>
									<?php
								}
							}
							?>
							</div>
		
							<div class="past-event-links">
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
						</div>
					</article>
					<?php
				}
					?>
				</section>
				<?php
			endwhile;

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main>

<?php
get_footer();
