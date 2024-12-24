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
	<ul>
		<li><button data-target="men_professional">Men's Professional</button></li>
		<li><button data-target="women_professional">Women's Professional</button></li>
		<li><button data-target="men_amateur">Men's Amateur</button></li>
		<li><button data-target="women_amateur">Women's Amateur</button></li>
		<li><button data-target="kickboxing">Kickboxing</button></li>
	</ul>
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
				<h2><?php echo esc_html($groupLabels[$groupKey]); ?></h2>
				<?php foreach ($divisions as $division) : 
					$layout = $division['acf_fc_layout'];

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
									if ($fighter['rank'] == 'champion') : ?>
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
														$image_id = get_field('single_fighter_image');
														?>
														
														<!-- Output -->
														<a href="<?php the_permalink(); ?>" class="champion-box-link">
															<div class="card-thumbnail-box">
																<?php
																if ($image_id) {
																	echo wp_get_attachment_image($image_id, "", "",[ 'class' => 'slider-image champions']);
																}
																?>
															</div>
														</a>
														
														<?php
													}
												}
                                            wp_reset_postdata();
										?>
											<p class="fighter-record"><?php echo esc_html($fighter['bfl-win']); ?>W - <?php echo esc_html($fighter['bfl-lose']); ?>L - <?php echo esc_html($fighter['bfl-draw']); ?>D</p>        
										</div>
									<?php
									endif;
								endforeach; ?>

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
												<tr>
													<td class="rank"><p><?php echo esc_html($fighter['rank']); ?></p></td>
													<td class="fighter-name"><p>
														<a href="<?php echo esc_url( home_url( '/fighters/' . sanitize_title($fighter['name']) . '/' ) ); ?>">
															<?php echo esc_html($fighter['name']); ?>
														</a>
													</p></td>
													<td class="fighter-record"><p><?php echo esc_html($fighter['bfl-win']); ?>W - <?php echo esc_html($fighter['bfl-lose']); ?>L - <?php echo esc_html($fighter['bfl-draw']); ?>D</p></td>
													<td class="overall-record"><p><?php echo esc_html($fighter['all-win']); ?>W - <?php echo esc_html($fighter['all-lose']); ?>L - <?php echo esc_html($fighter['all-draw']); ?>D</p></td>
												</tr>
												<!-- single fighter output end -->

											<?php 
											endif; 
										endforeach; ?>
									</tbody>
								</table>
							<?php endif; ?>
					</div><!-- single division end -->

				<?php endforeach; ?>
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
