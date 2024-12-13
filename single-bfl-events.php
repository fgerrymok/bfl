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
					<h1 class="single-event-heading"><?php echo esc_html($eventName); ?></h1>
					<div class="event-poster">
						<?php echo wp_get_attachment_image($eventsPoster, 'full'); ?>
					</div>
					<?php
					?>
					<div class="fight-details">
						<h2><?php echo esc_html($eventName); ?></h2>
						<p><?php echo esc_html($fightDate); ?></p>
						<p><?php echo esc_html($venue); ?></p>
					</div>
				</section>
				<?php
			}

			$fightCardRepeater = get_field('fight_card');
			if($fightCardRepeater) {

				foreach ($fightCardRepeater as $row) {
					$fighter1Image = $row['fighter_1_image'];
					$fighter1Profile = $row['fighter_1_profile'];
					$fighter2Image = $row['fighter_2_image'];
					$fighter2Profile = $row['fighter_2_profile'];
					$fightTitle = $row['fight_title'];
					?>
					<section class="fight-card">
						<a href="<?php foreach ($fighter1Profile as $fighter1ProfileId) {
							echo get_permalink($fighter1ProfileId);
							} ?>">
							<?php echo wp_get_attachment_image($fighter1Image, 'full'); ?>
						</a>
						<p><?php echo esc_html('vs'); ?></p>
						<a href="<?php foreach ($fighter2Profile as $fighter2ProfileId) {
							echo get_permalink($fighter2ProfileId);
							} ?>">
							<?php echo wp_get_attachment_image($fighter2Image, 'full'); ?>
						</a>
					</section>
					<?php
				}
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
		?>

	</main>

<?php
get_footer();