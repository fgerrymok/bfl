<?php
get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();
			$hero = get_field('upcoming_events_hero');

			if ($hero) {
				$eventsPoster = $hero['event_poster'];
				$eventName = $hero['event_name'];
				$fightDate = $hero['fight_date'];
				$venue = $hero['venue'];
				?>
				<section class="single-event-hero">
					<?php
					if (!empty($eventName)) {
						?>
						<h1 class="single-event-heading"><?php echo esc_html($eventName); ?></h1>
						<?php
					}
					?>
					<?php
					if (!empty($eventsPoster)) {
						?>
						<div class="event-poster">
							<?php echo wp_get_attachment_image($eventsPoster, 'full'); ?>
						</div>	
						<?php
					}
					?>
					<?php
					if (!empty($eventName)) {
						?>
						<div class="event-bar">
							<h2><?php echo esc_html($eventName); ?></h2>
						</div>
						<?php
					}
					?>
					<?php
					if (!empty($fightDate) && !empty($venue)) {
						?>
						<div class="core-details">
							<hr class="core-details-line">
							<p><?php echo esc_html($fightDate); ?></p>
							<p><?php echo esc_html($venue); ?></p>
						</div>
						<?php
					}
					?>
				</section>
				<?php
			}

			$fightCardRepeater = get_field('fight_card');

			if($fightCardRepeater) {
				?>
				<section class="fight-roster">
				<?php
				foreach ($fightCardRepeater as $row) {
					$fighter1Name = $row['fighter_1_name'];
					$fighter1Image = $row['fighter_1_image'];
					$fighter1Profile = $row['fighter_1_profile'];
					$fighter2Name = $row['fighter_2_name'];
					$fighter2Image = $row['fighter_2_image'];
					$fighter2Profile = $row['fighter_2_profile'];

					if (!empty($fighter1Name) && !empty($fighter2Name)) {
						?>
						<section class="fight-card">
							<div class="fighter-container">
								<a href="<?php foreach ($fighter1Profile as $fighter1ProfileId) {
									echo get_permalink($fighter1ProfileId);
									} ?>">
									<?php
										if (!empty($fighter1Image)) {
											echo wp_get_attachment_image($fighter1Image, 'full');
										} else {
											?>
											<img src="<?php echo esc_url(get_template_directory_uri() . '/assets/default-champion.png'); ?>" alt="Default Image" />
											<?php
										}
									?>
								</a>
							</div>

							<?php
							if ($fighter1Name && $fighter2Name) {
								?>
								<div class="fight-title">
									<p class="fighter"><?php echo esc_html($fighter1Name); ?></p>
									<p class="vs"><?php echo esc_html("vs"); ?></p>
									<p class="fighter"><?php echo esc_html($fighter2Name); ?></p>
								</div>
								<?php
							}
							?>
							<div class="fighter-container">
								<a href="<?php foreach ($fighter2Profile as $fighter2ProfileId) {
									echo get_permalink($fighter2ProfileId);
									} ?>">
									<?php
										if (!empty($fighter2Image)) {
											echo wp_get_attachment_image($fighter2Image, 'full');
										} else {
											?>
											<img src="<?php echo esc_url(get_template_directory_uri() . '/assets/default-champion.png'); ?>" alt="Default Image" />
											<?php
										}
									?>
								</a>
							</div>
						</section>
						<?php
					}
				}
				?>
				</section>
				<?php
			}

		endwhile;

		$term = get_term_by('slug', 'past-events', 'bfl-event-type');
			if ($term) {
				$linkToPastEvents = get_term_link($term);
				?>
				<section class="link-to-past-events">
					<a href="<?php echo esc_url($linkToPastEvents); ?>">
						<?php echo esc_html("Past Events"); ?>
					</a>
				</section>
				<?php	
			}
		?>

	</main>

<?php
get_footer();