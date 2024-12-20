<?php
get_header();
?>

	<main id="primary" class="site-main">

		<?php if ( have_posts() ) : ?>

			<?php
			
			while ( have_posts() ) :
				the_post();
				?>
				<h1 class="single-event-heading"><?php echo esc_html('Upcoming Events'); ?></h1>
				<?php
				$hero = get_field('upcoming_events_hero');
	
				if ($hero) {
					$bettingOddsLink = $hero['betting_odds_link'];
					$ticketsLink = $hero['tickets_link'];
					$eventsPoster = $hero['event_poster'];
					$eventName = $hero['event_name'];
					$fightDate = $hero['fight_date'];
					$venue = $hero['venue'];
					?>
					<section class="single-event-hero">
						<div class="external-links">
							<?php
							if (!empty($bettingOddsLink)) {
								?>
								<a href="<?php echo esc_url($bettingOddsLink) ?>" class="betting-odds"><?php echo esc_html('Betting Odds'); ?></a>
								<?php
							}
		
							if (!empty($ticketsLink)) {
								?>
								<a href="<?php echo esc_url($ticketsLink) ?>" class="tickets"><?php echo esc_html('Tickets'); ?></a>
								<?php
							}
							?>
						</div>
						<div class="event-poster">
							<?php echo wp_get_attachment_image($eventsPoster, 'full'); ?>
						</div>
						<?php
						?>
						<div class="event-bar">
							<h2><?php echo esc_html($eventName); ?></h2>
						</div>
						<div class="core-details">
							<hr>
							<p><?php echo esc_html($fightDate); ?></p>
							<p><?php echo esc_html($venue); ?></p>
						</div>
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
						?>
						<section class="fight-card">
							<a href="<?php foreach ($fighter1Profile as $fighter1ProfileId) {
								echo get_permalink($fighter1ProfileId);
								} ?>">
								<?php echo wp_get_attachment_image($fighter1Image, 'full'); ?>
							</a>

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
							
							<a href="<?php foreach ($fighter2Profile as $fighter2ProfileId) {
								echo get_permalink($fighter2ProfileId);
								} ?>">
								<?php echo wp_get_attachment_image($fighter2Image, 'full'); ?>
							</a>
						</section>
						<?php
					}
					?>
					</section>
					<?php
				}
				?>
				<h3><?php echo esc_html("Behind The Fights"); ?></h3>
				<?php
	
				if ($hero) {
					$eventName = $hero['event_name'];
					$tag = sanitize_title(strtolower($eventName));
					$tag = str_replace(' ', '', $tag);
					
					$args = array(
						'post_type' => 'post',
						'posts_per_page' => 3,
						'tag' => $tag,
					);
		
					$query = new WP_Query($args);
					if ($query->have_posts()) {
						?>
						<section class="single-event-videos">
						<?php
						while ($query->have_posts()) {
							$query->the_post();
							echo the_content();
						}
						?>
						</section>
						<?php
					}
					
					wp_reset_postdata();
				}
	
			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main>

<?php
get_footer();
