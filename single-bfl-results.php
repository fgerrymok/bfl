<?php
get_header();
?>

	<main id="primary" class="site-main">
		<?php
		while ( have_posts() ) :
			the_post();
			$heroImage = get_field('results_hero_image');
			$eventName = get_field('results_event_name');
			$fightTitle = get_field('results_fight_title');
			$fightDate = get_field('results_fight_date');
			$cardType1 = get_field('card_type_1');
			$cardType1Table = get_field('card_type_1_table');
			$cardType2 = get_field('card_type_2');
			$cardType2Table = get_field('card_type_2_table');

			?>
			<section class="results-hero">
			<h1><?php echo esc_html("Results"); ?></h1>
			<?php
			if($heroImage) {
				echo wp_get_attachment_image($heroImage, 'full');
			}
			?>
			</section>
			<?php

			if ($eventName) {
				?>
				<h2><?php echo esc_html($eventName); ?></h2>
				<?php
			}

			if ($fightTitle) {
				?>
				<p><?php echo esc_html($fightTitle); ?></p>
				<?php
			}

			if ($fightDate) {
				?>
				<p><?php echo esc_html($fightDate); ?></p>
				<?php
			}

			if ($cardType1) {
				?>
				<h3><?php echo esc_html($cardType1); ?></h3>
				<?php
			}

			if ($cardType1Table) {
				?>
				<table>
				<?php
				foreach ($cardType1Table as $oneRow) {
					?>
					<tr>
						<td>
						<?php
						echo($oneRow['card_type_1_result']);
						?>
						</td>
					</tr>
					<?php
				}
				?>
				</table>
				<?php
			}

			if ($cardType2) {
				?>
				<h3><?php echo esc_html($cardType2); ?></h3>
				<?php
			}

			if ($cardType2Table) {
				?>
				<table>
				<?php
				foreach ($cardType2Table as $oneRow) {
					?>
					<tr>
						<td>
						<?php
						echo($oneRow['card_type_2_result']);
						?>
						</td>
					</tr>
					<?php
				}
				?>
				</table>
				<?php
			}

		endwhile;
		?>
	</main>

<?php
get_footer();