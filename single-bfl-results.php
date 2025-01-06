<?php
get_header();
?>

	<main id="primary" class="site-main">
		<?php
		while ( have_posts() ) :
			the_post();
		
			$tags = get_the_terms(get_the_ID(), 'bfl-results-type');
			if ($tags && !is_wp_error($tags)) {
				foreach ($tags as $tag) {
					$resultsTag = $tag->slug;
					if ($resultsTag === "fight-results") {
						$heroImage = get_field('results_hero_image');
						$eventName = get_field('results_event_name');
						$fightTitle = get_field('results_fight_title');
						$fightDate = get_field('results_fight_date');
						$cardType1 = get_field('card_type_1');
						$cardType1Table = get_field('card_type_1_table');
						$cardType2 = get_field('card_type_2');
						$cardType2Table = get_field('card_type_2_table');
			
						?>
						<section class="results-hero hero">
							<h1><?php echo esc_html("Fight Results"); ?></h1>
							<?php
							if($heroImage) {
								echo wp_get_attachment_image($heroImage, 'full');
							} else {
								?>
								<img src="<?php echo get_template_directory_uri() . '/assets/default_results.png' ?>" alt="Default Champion">
								<?php
							}
							?>
						</section>
						<div class="event-bar">
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
							?>
						</div>
						<section class="results-main">
							<?php
							if ($fightDate) {
								?>
								<p class="fight-date"><?php echo esc_html($fightDate); ?></p>
								<?php
							}
							
							?>
							<div class="results-table">
								<?php
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
								?>
							</div>
							
							<div class="results-table">
							<?php
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
								?>
							</div>
							<?php
							// More Event Results
							$moreResultsFlex = get_field('more_event_results');
							if ($moreResultsFlex) {
								foreach ($moreResultsFlex as $result) {
									$eventType = $result['card_type_3'];
									$eventTable = $result['card_type_3_table'];
									?>
									<div class="results-table">
									<?php
										if ($eventType) {
											?>
											<h3><?php echo esc_html($eventType); ?></h3>
											<?php
										}
							
										if ($eventTable) {
											?>
											<table>
											<?php
											foreach ($eventTable as $oneRow) {
												?>
												<tr>
													<td>
													<?php
													echo($oneRow['card_type_3_result']);
													?>
													</td>
												</tr>
												<?php
											}
											?>
											</table>
											<?php
										}
									?>
									</div>
									<?php
								}
							}
							?>
						</section>
						<?php
					} else if ($resultsTag === "weigh-in-results") {
						$heroImage = get_field('weigh_in_hero_image');
						$eventName = get_field('weigh_in_event_name');
						$fightTitle = get_field('weigh_in_fight_title');
						$weighInTable = get_field('weigh_in_table');

						if ($heroImage) {
							?>
							<section class="results-hero hero">
							<h1><?php echo esc_html("Weigh In Results"); ?></h1>
							<?php
							if($heroImage) {
								echo wp_get_attachment_image($heroImage, 'full');
							} else {
								?>
								<img src="<?php echo get_template_directory_uri() . '/assets/default_results.png' ?>" alt="Default Champion">
								<?php
							}
							?>
							</section>
							<section class="event-bar">
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
								?>
							</section>
							<section class="weigh-in-main">
								<h3><?php echo esc_html("Weigh In Results"); ?></h3>
								<div class="results-table">
									<?php
									if ($weighInTable) {
										?>
										<table>
										<?php
										foreach ($weighInTable as $oneRow) {
											?>
											<tr>
												<td>
												<?php
												echo($oneRow['weigh_in_row']);
												?>
												</td>
											</tr>
											<?php
										}
										?>
										</table>
										<?php
									}
									?>
								</div>
							</section>
							<?php
						}
					}
				}
			}

		endwhile;
		?>
	</main>

<?php
get_footer();