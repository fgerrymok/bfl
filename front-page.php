<?php

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();
			$heroFlex = get_field('homepage_hero');
			if ($heroFlex) {
				?>
				<section class="homepage-hero">
					<?php
					foreach ($heroFlex as $layout) {
						if ($layout['acf_fc_layout'] === "upcoming_event") {
							$eventPoster = $layout['homepage_event_image'];
							echo wp_get_attachment_image($eventPoster, 'full');
							
							$args = array(
								'post_type' => 'bfl-events',
								'posts_per_page' => '1',
								'tax_query' => array(
									array(
										'taxonomy' => 'bfl-event-type',
										'field' => 'slug',
										'terms' => 'upcoming-events',
									)
								)
							);

							$query = new WP_Query($args);

							if ($query->have_posts()) {
								while ($query->have_posts()) {
									$query->the_post();
									?>
									<a href="<?php echo esc_url(the_permalink()); ?>"><?php echo esc_html("See Details") ?></a>
									<?php
									
								}
							}
							wp_reset_postdata();
						
						} else if ($layout['acf_fc_layout'] === "video") {
							$heroVideo = $layout['homepage_hero_video'];
							if ($heroVideo) {
								echo $heroVideo;
							}
						}
					}
					?>
				</section>
				<section class="homepage-body">
					<?php
					$args = array(
						'post_type' => 'bfl-results',
						'posts_per_page' => 4,
						'orderby' => 'date',
						'order' => 'DESC',
						'tax_query' => array(
							array(
								'taxonomy' => 'bfl-results-type',
								'field' => 'slug',
								'terms' => 'fight-results',
							)
						)
					);
					?>

					<!-- Past Events -->
					<section class="homepage-section">
						<h2><?php echo esc_html("Past Events"); ?></h2>
						<?php
						$pastEventsQuery = new WP_Query($args);

						if ($pastEventsQuery->have_posts()) {
						while ($pastEventsQuery->have_posts()) {
							$pastEventsQuery->the_post();
							?>
							<article class="homepage-cards">
								<a href="<?php echo esc_url(the_permalink()); ?>">
									<?php
									$featuredImage = get_field('results_hero_image');
									$fightDate = get_field('results_fight_date');
									$eventName = get_field('results_event_name');

									if ($featuredImage) {
										echo wp_get_attachment_image($featuredImage, 'full');
									}

									if ($fightDate) {
										?>
										<p><?php echo esc_html($fightDate); ?></p>
										<?php
									}

									if ($eventName) {
										?>
										<p><?php echo esc_html($eventName); ?></p>
										<?php
									}
								?>
								</a>
							</article>
							<?php
						}
					}
					?>
					</section>
					<?php
					
					wp_reset_postdata();
					?>
				</section>

				<!-- Recent Posts -->
				<section class="homepage-section">
					<h2><?php echo esc_html("Recent Posts") ?></h2>
					<?php
					$args = array(
						'post_type' => 'bfl-news',
						'posts_per_page' => 4,
						'orderby' => 'date',
						'order' => 'DESC',
					);

					$recentPostsQuery = new WP_Query($args);

					if ($recentPostsQuery->have_posts()) {
						while ($recentPostsQuery->have_posts()) {
							$recentPostsQuery->the_post();
							?>
							<article class="homepage-cards">
								<a href="<?php echo esc_url(the_permalink()) ?>">
									<?php
									echo the_content();
									echo the_title();
									?>
								</a>
							</article>
							<?php
						}
					}

					wp_reset_postdata();
					?>
				</section>
				
				<!-- Videos -->
				<section class="homepage-section">
					<h2><?php echo esc_html("Videos") ?></h2>
					<?php
					$args = array(
						'post_type' => 'post',
						'posts_per_page' => 4,
						'orderby' => 'date',
						'order' => 'DESC',
					);

					$recentPostsQuery = new WP_Query($args);

					if ($recentPostsQuery->have_posts()) {
						while ($recentPostsQuery->have_posts()) {
							$recentPostsQuery->the_post();
							?>
							<article class="homepage-cards">
							<?php
							echo the_content();
							echo the_title();
							?>
							</article>
							<?php
						}
					}

					wp_reset_postdata();
					?>
				</section>

				<!-- BFL Professional Champions -->

				<?php
			}
			?>
			
			<?php

		endwhile;
		?>

	</main>

<?php
get_footer();
