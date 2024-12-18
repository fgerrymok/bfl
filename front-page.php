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
					<!-- Past Events -->
					<section class="homepage-section past-events">
						<?php
						$args = array(
							'post_type' => 'bfl-results',
							'posts_per_page' => 3,
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

						<h2><?php echo esc_html("Past Events"); ?></h2>
						<div class="cards-container past-events">
							<?php
							$pastEventsQuery = new WP_Query($args);

							if ($pastEventsQuery->have_posts()) {
							while ($pastEventsQuery->have_posts()) {
								$pastEventsQuery->the_post();
								?>
								<article class="cards">
									<a href="<?php echo esc_url(the_permalink()) ?>">	
										<div class="card-thumbnail-box">
											<?php echo get_the_post_thumbnail( "", "", [ 'class' => 'card-thumbnail-img']); ?>
										</div>
										<p class="card-title"><?php echo the_title(); ?></p>
									</a>
								</article>
								<?php
								}
							}
							?>
						</div>
					</section>
					<?php
					
					wp_reset_postdata();
					?>
				</section>

				<!-- Recent Posts -->
				<section class="homepage-section recent-posts">
					<h2><?php echo esc_html("Recent Posts") ?></h2>
					<div class="cards-container">
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
							<article class="cards">
								<a href="<?php echo esc_url(the_permalink()) ?>">	
									<div class="card-thumbnail-box">
										<?php echo get_the_post_thumbnail( "", "", [ 'class' => 'card-thumbnail-img']); ?>
									</div>
									<p class="card-date"><?php echo get_the_date( 'M j' ); ?></p>
									<p class="card-title"><?php echo the_title(); ?></p>
								</a>
							</article>
							<?php
						}
					}

					wp_reset_postdata();
					?>
					</div>
				</section>
				
				<!-- Videos -->
				<section class="homepage-section videos">
					<h2><?php echo esc_html("Videos") ?></h2>
					<div class="cards-container">
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
							<article class="cards">
								<a href="<?php echo esc_url(the_permalink()) ?>">	
									<div class="card-thumbnail-box">
										<?php echo get_the_post_thumbnail( "", "", [ 'class' => 'card-thumbnail-img']); ?>
									</div>
									<p class="card-date"><?php echo get_the_date( 'M j' ); ?></p>
									<p class="card-title"><?php echo the_title(); ?></p>
								</a>
							</article>
							<?php
						}
					}

					wp_reset_postdata();
					?>
					</div>
				</section>


				<!-- BFL Professional Champions -->
                <section class="homepage-section champions">
                    <h2><a href="<?php echo get_permalink(14581); ?>">BFL Professional Champions</a></h2>
					<div class="cards-container champions">
                    <?php
                    $page_id = 14581;
                    $divisions = get_field('division', $page_id);

                    if ($divisions) {
                        foreach ($divisions as $division) {
                            $layout = $division['acf_fc_layout'];

                            // Generate Division Label
                            if (strpos($layout, 'men_professional_') === 0 || strpos($layout, 'women_professional_') === 0) {
                                $parts = explode('_', $layout);
                                $gender = ucfirst($parts[0]);
                                $weight_class = ucfirst(end($parts));
                                $label = $gender . ' ' . $weight_class; 
								?>
								<article class="cards">
									<h3 class="card-division-name"><?php echo esc_html($label); ?></h3>
									<?php
									if (!empty($division['fighter'])) {
										foreach ($division['fighter'] as $fighter) {
											if ($fighter['rank'] === 'champion') {
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
																	echo wp_get_attachment_image($image_id, "", "",[ 'class' => 'card-thumbnail-img']);
																} else {
																	echo '<img src="' . esc_url(get_template_directory_uri() . '/assets/default-champion.png') . '" alt="Default Image" />';
																}
																?>
															</div>
															<p class="champion-title">Champion</p>
															<p class="champion-name"><?php echo esc_html($fighter['name']); ?></p>
														</a>
														
														<?php
													}
												}
                                            wp_reset_postdata();
                                        }
                                    }
                                } ?>
								</article>
								<?php
                            }
                        }
                    }
                    ?>
					</div>
                </section>

				<?php
			}
			?>
				
				<section class='homepage-section instagram'>
					<?php echo do_shortcode('[instagram-feed]'); ?>
				</section>

				<section class='homepage-section sponsor'>
					<?php
						if(have_rows('sponsors_section')):
							while(have_rows('sponsors_section')): the_row();
								$sponsor_section_title = get_sub_field('sponsor_section_title');
								$sponsor_section_text  = get_sub_field('sponsor_section_text');

								if($sponsor_section_title){
									?>
										<div class='sponsors-title-text'>
											<h2><?php echo esc_html($sponsor_section_title); ?></h2>
											<?php
												if($sponsor_section_text){
													?>
													<p><?php echo esc_html($sponsor_section_text); ?></p>
													<?php
												}
												?>
										</div>
									<?php
								
								if(have_rows('sponsor')){
									while(have_rows('sponsor')): the_row();	
										$sponsor_name = get_sub_field('sponsor_name');
										$sponsor_logo = get_sub_field('sponsor_logo');
										?>
										<div class='logo-item'>
											<?php
											if($sponsor_name){
												?>
												<p><?php echo esc_html($sponsor_name); ?></p>
												<?php
											}
											if($sponsor_logo){
												echo wp_get_attachment_image($sponsor_logo,'medium');
											}
											?>
										</div>
										<?php

									endwhile;							
								}
								}
							endwhile;
						endif;
					?>
				</section>
			<?php

		endwhile;
		?>

	</main>

<?php
get_footer();
