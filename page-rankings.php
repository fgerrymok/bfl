<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package BFL
 */

get_header();
?>

	<main id="primary" class="site-main rankings-page">

		<?php
		while ( have_posts() ) : the_post(); ?> 
			
			<section class="hero-section hero"> 
				<h1>Rankings</h1>

				<?php
				$img = get_field('hero_background_image');
				if ( $img ) : 
					
					echo wp_get_attachment_image( $img, 'medium', "", [ 'class' => 'hero-img' ] );
					
				endif; ?>
			</section>

			<section class="content-section">
<div class="ranking-header">

<select id="tab-dropdown" class="mobile-dropdown">
    <option value="men_professional">Men's Professional</option>
    <option value="women_professional">Women's Professional</option>
    <option value="men_amateur">Men's Amateur</option>
    <option value="women_amateur">Women's Amateur</option>
    <option value="kickboxing">Kickboxing</option>
  </select>

	<div class='tabs-wrapper'>
		<ul>
			<li><button data-target="men_professional">Men's Professional</button></li>
			<li><button data-target="women_professional">Women's Professional</button></li>
			<li><button data-target="men_amateur">Men's Amateur</button></li>
			<li><button data-target="women_amateur">Women's Amateur</button></li>
			<li><button data-target="kickboxing">Kickboxing</button></li>
		</ul>
		<div class='tab-slider'></div>
	</div>
</div>

<div class="ranking-content">
	<?php 
	$divisions = get_field('division'); 

	// Group 
	$groupedDivisions = [
		'men_professional' => [],
		'women_professional' => [],
		'men_amateur' => [],
		'women_amateur' => [],
		'kickboxing' => []
	];

	if ($divisions) : 
		foreach ($divisions as $division) : 
			// current layout key
			$layout = $division['acf_fc_layout']; 

			// Add the layout to the grouping array
			if (strpos($layout, 'men_professional') === 0) :
				$groupedDivisions['men_professional'][] = $division;
			elseif (strpos($layout, 'women_professional') === 0) :
				$groupedDivisions['women_professional'][] = $division;
			elseif (strpos($layout, 'men_amateur') === 0) :
				$groupedDivisions['men_amateur'][] = $division;
			elseif (strpos($layout, 'women_amateur') === 0) :
				$groupedDivisions['women_amateur'][] = $division;
			elseif (strpos($layout, 'kickboxing') === 0) :
				$groupedDivisions['kickboxing'][] = $division;
			endif;
		endforeach;
	endif;

	// create label for each group
	$groupLabels = [
		'men_professional' => "Men's Professional",
		'women_professional' => "Women's Professional",
		'men_amateur' => "Men's Amateur",
		'women_amateur' => "Women's Amateur",
		'kickboxing' => "Kickboxing"
	];

	foreach ($groupedDivisions as $groupKey => $divisions) :
		if (!empty($divisions)) : ?>
			<section class="division-group <?php echo esc_attr($groupKey); ?>" id="<?php echo esc_attr($groupKey); ?>">
				<div class='division-group-wrapper'>
				<h2><?php echo esc_html($groupLabels[$groupKey]); ?></h2>
				<?php foreach ($divisions as $division) : 
					$layout = $division['acf_fc_layout'];

				// Check for champion and other ranked fighters separately
				$hasChampion = false;
				$hasRankedFighters = false;

				if (!empty($division['fighter'])) {
					foreach ($division['fighter'] as $fighter) {
						if ($fighter['rank'] == 'champion') {
							$hasChampion = true;
						} else if ($fighter['rank'] != 'out of rank') {
							$hasRankedFighters = true;
						}
					}
				}

				// Skip only if there's no champion AND no ranked fighters
				if (!$hasChampion && !$hasRankedFighters) {
					continue;
				}


					// get label from ACF and convert to output
					$label = '';
					if (strpos($layout, 'kickboxing_') === 0) { 
						// Handle kickboxing layouts
						$parts = explode('_', $layout);
						if (count($parts) >= 3) {
							// Combine all parts while preserving '-' in the last part
							$label = ucfirst($parts[1]) . ' ' . ucfirst($parts[2]);
						}
					} elseif (strpos($layout, 'men_') === 0 || strpos($layout, 'women_') === 0) { 
						// Handle men/women layouts
						$parts = explode('_', $layout);
						if (count($parts) > 2) {
							// Combine all parts after the first one while preserving '-'
							$label = ucfirst($parts[1]) . ' ' . ucfirst(implode(' ', array_slice($parts, 2)));
						} else {
							$label = ucfirst(end($parts));
						}
					} else {
						// Generic fallback
						$label = str_replace('_', ' ', ucfirst($layout));
					}
					?>
					
					<div class="division <?php echo esc_attr($layout); ?>">
						<h3 class="division-title"><?php echo esc_html($label); ?></h3>
							<?php if (!empty($division['fighter'])) : 
								foreach ($division['fighter'] as $fighter) : 
									if ($fighter['rank'] == 'champion') :
										if($fighter['name'] == 'vacant' || $fighter['name'] == 'Vacant') : 
											// IF CHAMPION IS VACANT
										?>
											<div class="champion-box">
												<!-- Output -->
												<a href="<?php the_permalink(); ?>" class="champion-box-link">
													<div class="card-thumbnail-box">
														<img src="<?php echo esc_url(get_template_directory_uri() . '/assets/default-champion.png'); ?>" alt="Default Image" class="slider-image champions vacant" />
													</div>
												</a>
												<p class="fighter-name">Vacant</p>
												<p class="fighter-record"></p>
											</div>
										<?php
										else : 
												// IF CHAMPION EXISTS
										?>
											<div class="champion-box">
												<?php
												$fighter_query = new WP_Query([
													'post_type' => 'bfl-fighters',
													'title' => $fighter['name'],
													'posts_per_page' => 1,
												]);

													if ($fighter_query->have_posts()) {
														while ($fighter_query->have_posts()) {
															$fighter_query->the_post();
															?>
															
															<!-- Output -->
															<a href="<?php the_permalink(); ?>" class="champion-box-link">
																<div class="card-thumbnail-box">
																	<?php 
																	if(get_the_post_thumbnail()) :
																		echo get_the_post_thumbnail( "", "", [ 'class' => 'slider-image champions']);
																	else : 
																		$image_id = get_field('single_fighter_image');
																		echo wp_get_attachment_image( $image_id, 'full', "", [ 'class' => 'slider-image champions' ]);
																	?>
																		<?php
																	endif;
																	?>
																</div>
															</a>
															
															<?php
														}
													}
												wp_reset_postdata();
												?>
												<p class="fighter-name"><?php echo $fighter['name']; ?></p>
												<p class="fighter-record">
													<?php
													if(!empty($fighter['bfl-win']) || !empty($fighter['bfl-lose']) || !empty($fighter['bfl-draw'])){
														$bfl_win  = !empty($fighter['bfl-win']) ? $fighter['bfl-win'] : 0;
														$bfl_lose = !empty($fighter['bfl-lose']) ? $fighter['bfl-lose'] : 0;
														$bfl_draw = !empty($fighter['bfl-draw']) ? $fighter['bfl-draw'] : 0;
														echo esc_html($bfl_win . 'W-' . $bfl_lose . 'L-' . $bfl_draw . 'D');
													}

													?>
												</p>        
											</div>
										<?php
										endif;
									endif;
								endforeach;
				
								if($hasRankedFighters):
								?>
								<table class="ranking-table">
									<thead>
										<tr>
											<th>#</th>
											<th>Fighter</th>
											<th>W-L-D</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($division['fighter'] as $fighter) : 
											if ($fighter['rank'] != 'out of rank' && $fighter['rank'] != 'champion') : ?>




												<!-- single fighter output -->
												<tr class='fighter-row'>
													<td class="rank"><p><?php echo esc_html($fighter['rank']); ?></p></td>
													<td class="fighter-name"><p>
														<!-- LINK -->
														<?php
														$fighter_query = new WP_Query([
															'post_type' => 'bfl-fighters',
															'title' => $fighter['name'],
															'posts_per_page' => 1,
														]);
														if ($fighter_query->have_posts()) {
															// if single fighter page exists
															while ($fighter_query->have_posts()) { 
															$fighter_query->the_post(); ?>
															<a href="<?php echo esc_url( home_url( '/fighters/' . sanitize_title($fighter['name']) . '/' ) ); ?>">
																<?php echo esc_html($fighter['name']); ?>
															</a>
															<?php
															}
														} else {
															// if single fighter page doesn't exist
															echo esc_html($fighter['name']);
														} 
														wp_reset_postdata();
														?>
														<!-- LINK -->
													</p></td>
													
													<td class="fighter-record">
														<?php
															if($fighter['all-win'] ||$fighter['all-lose'] || $fighter['all-draw']){
																?>
																	<table class="record-table">
																		<tr>
																			<th>All</th>
																			<td>
																			<?php
																			$all_win = !empty($fighter['all-win']) ? $fighter['all-win'] : 0;
																			$all_lose = !empty($fighter['all-lose']) ? $fighter['all-lose'] : 0;
																			$all_draw = !empty($fighter['all-draw']) ? $fighter['all-draw'] : 0;

																			echo esc_html("$all_win-$all_lose-$all_draw");
																			?>

																			</td>
																		</tr>
																		<tr>
																			<?php
																				if($fighter['bfl-win'] || $fighter['bfl-lose'] || $fighter['bfl-draw']){
																					?>
																					<th>BFL</th>
																					<td>
																						<?php
																						$bfl_win = !empty($fighter['bfl-win']) ? $fighter['bfl-win'] : 0;
																						$bfl_lose = !empty($fighter['bfl-lose']) ? $fighter['bfl-lose'] : 0;
																						$bfl_draw = !empty($fighter['bfl-draw']) ? $fighter['bfl-draw'] : 0;

																						echo esc_html("$bfl_win-$bfl_lose-$bfl_draw");
																						?>
																					</td>
																					<?php
																				}
																			?>
																		</tr>
   																	</table>

																<?php
															}
															else{
																?>
																	<p>
																		<?php
																			// Ensure all fields are set to 0 if they are empty
																			$bfl_win = !empty($fighter['bfl-win']) ? $fighter['bfl-win'] : 0;
																			$bfl_lose = !empty($fighter['bfl-lose']) ? $fighter['bfl-lose'] : 0;
																			$bfl_draw = !empty($fighter['bfl-draw']) ? $fighter['bfl-draw'] : 0;

																			// Output the formatted string
																			echo esc_html("$bfl_win-$bfl_lose-$bfl_draw");
																		?>
																	</p>
																<?php
															}
														?>
													</td>
												</tr>
												<!-- single fighter output end -->

											<?php 
											endif; 
										endforeach; ?>
									</tbody>
								</table>
							<?php
								endif; 
							endif;
							?>
					</div><!-- single division end -->

				<?php endforeach; ?>
				</div>
			</section><!-- single division group end -->

		<?php endif;
	endforeach; ?>
</div><!-- ranking-content end -->

</section><!-- content section end -->

			<?php
		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
