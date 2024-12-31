<?php

get_header();
?>

	<main id="primary" class="site-main frontpage">

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
										<a href="<?php echo esc_url(the_permalink()); ?>">
											<?php echo wp_get_attachment_image($eventPoster, 'full'); ?>
										</a>
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
					// UFC banner
					?>
					<a href="" class="ufc-banner-link"> 
						<?php
						$image_id = 14995; // UFC Image ID
						echo wp_get_attachment_image( $image_id, 'full', "", [ 'class' => 'ufc-banner home']);
						?>
					</a>
				</section>
				<section class="homepage-body">

					<!-- Past Events -->
					<section class="homepage-section past-events">
					<a href="<?php echo esc_url( get_term_link( 'past-events', 'bfl-event-type' ) ); ?>" class="heading-link">
						<h2><?php echo esc_html("Past Events >") ?></h2>
					</a>
					<div class="slick-slider">
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
						$query = new WP_Query($args);

						if ($query->have_posts()) :
							while ($query->have_posts()) : $query->the_post(); ?>
								<div class="slider-item">
									<?php if (has_post_thumbnail()) : ?>
										<a href="<?php the_permalink(); ?>">
											<?php echo get_the_post_thumbnail( "", "", [ 'class' => 'slider-image past-events']); ?>
										</a>
									<?php endif; ?>
									<p class="card-title past-events"><?php echo the_title(); ?></p>
								</div>
							<?php endwhile;
							wp_reset_postdata();
						endif; ?>
					</div>
				</section>


				<!-- Recent Posts -->
				<section class="homepage-section recent-posts">
				<a href="<?php echo esc_url( get_post_type_archive_link( 'bfl-news' ) ); ?>" class="heading-link">
					<h2><?php echo esc_html("Recent Posts >") ?></h2>
				</a>
					<div class="slick-slider">
						<?php
						$args = array(
							'post_type' => 'bfl-news',
							'posts_per_page' => 4,
							'orderby' => 'date',
							'order' => 'DESC',
						);
						$query = new WP_Query($args);

						if ($query->have_posts()) :
							while ($query->have_posts()) : $query->the_post(); ?>
								<div class="slider-item">
									<?php if (has_post_thumbnail()) : ?>
										<a href="<?php the_permalink(); ?>">
											<?php echo get_the_post_thumbnail( "", "", [ 'class' => 'slider-image']); ?>
										</a>
									<?php endif; ?>
									<p class="card-date"><?php echo get_the_date( 'M j' ); ?></p>
									<p class="card-title"><?php echo the_title(); ?></p>
								</div>
							<?php endwhile;
							wp_reset_postdata();
						endif; ?>
					</div>
				</section>
				
				<!-- Videos -->
				<section class="homepage-section videos videos-page">
				<a href="<?php echo esc_url( get_post_type_archive_link('post') ); ?>" class="heading-link">
					<h2><?php echo esc_html("Videos >") ?></h2>
				</a>

				<?php
				// Custom function to extract the video thumbnail from an oEmbed URL
				function get_acf_oembed_thumbnail($video_url) {

					if (strpos($video_url, 'youtube.com') !== false || strpos($video_url, 'youtu.be') !== false) {
				
						if (strpos($video_url, 'youtube.com/watch?v=') !== false) {
							parse_str(parse_url($video_url, PHP_URL_QUERY), $query_vars);
							if (isset($query_vars['v'])) {
								$video_id = $query_vars['v'];
							}
						}
				
						elseif (strpos($video_url, 'youtu.be') !== false) {
							$path = parse_url($video_url, PHP_URL_PATH);
							$video_id = trim($path, '/');
						}

						if (!empty($video_id)) {
							return 'https://img.youtube.com/vi/' . esc_attr($video_id) . '/hqdefault.jpg';
						}
					}

					return '';
				}
				?>



				<div class="slick-slider">
					<?php
					$args = array(
						'post_type' => 'post',
						'posts_per_page' => 4,
						'orderby' => 'date',
						'order' => 'DESC',
					);

					$query = new WP_Query($args);

					if ($query->have_posts()) :
						while ($query->have_posts()) : $query->the_post(); ?>
							<div class="slider-item">
							<div class="video-item">
								<?php 
								// video (home.php)
								if (has_post_thumbnail()) {
  
									$thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'medium');
									if ($thumbnail_url) {
										$post_permalink = get_permalink();
										if ($post_permalink) {
								   
											echo '<a href="' . esc_url($post_permalink) . '" target="_blank">';
											echo '<img src="' . esc_url($thumbnail_url) . '" alt="' . esc_attr(get_the_title()) . ' Thumbnail">';
											echo '</a>';
										}
									}
								} else {
									$content = get_the_content();
									$videos  = get_media_embedded_in_content($content, ['video', 'iframe']);
						
									if (!empty($videos)) {
										$thumbnail_url = get_acf_oembed_thumbnail($videos[0]);
									
										if ($thumbnail_url) {
											echo '<div class="video-item">';
											echo '<a href="#" class="video-thumbnail" data-video-url="' . esc_url($videos[0]) . '">';
											echo '<img src="' . esc_url($thumbnail_url) . '" alt="Video Thumbnail">';
											echo '</a>';
											echo '</div>';
										}
									}
									 else {
										if (have_rows('add_a_video')) {
											while (have_rows('add_a_video')) {
												the_row();
												$embed_video = get_sub_field('video_url', false, false);
											
												// Assuming $embed_video holds the YouTube URL
												if ($embed_video) {
													$video_id = '';
												// Extract the video ID
												if (strpos($embed_video, 'youtube.com/watch?v=') !== false) {
													parse_str(parse_url($embed_video, PHP_URL_QUERY), $query_vars);
													$video_id = $query_vars['v'];
												} elseif (strpos($embed_video, 'youtu.be') !== false) {
													$path = parse_url($embed_video, PHP_URL_PATH);
													$video_id = trim($path, '/');
												}
						
												if (!empty($video_id)) {
													$embed_url = 'https://www.youtube.com/embed/' . esc_attr($video_id);
													$thumbnail_url = 'https://img.youtube.com/vi/' . esc_attr($video_id) . '/hqdefault.jpg';
						
													echo '<div class="video-item">';
													echo '<img 
															src="' . esc_url($thumbnail_url) . '" 
															data-video-url="' . esc_url($embed_url) . '" 
															alt="Video Thumbnail" 
															class="video-thumbnail">';
													echo '</div>';
												}
												}
												
											}
										}
										
									}
								}
								?>
								<p class="card-date"><?php echo get_the_date('M j'); ?></p>
								<p class="card-title"><?php echo the_title(); ?></p>
							</div>
							</div>
						<?php endwhile;
						wp_reset_postdata();
					endif; ?>
				</div>
				<!-- modal window HTML -->
				<div id="video-modal" class="modal">
					<div class="modal-inner">
						<span id="close-modal" class="close">&times;</span>
						<div id="modal-content"></div>
					</div>
				</div>
				</section>

				<!-- BFL Professional Champions -->
                <section class="homepage-section champions">
                    <h2>
						<a href="<?php echo get_permalink(14581); ?>" class="heading-link"><?php echo esc_html("BFL Professional Champions >") ?></a>
					</h2>
					<div class="slick-slider champions">
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

									<?php
									if (!empty($division['fighter'])) {
									    $has_champion = false; 
										foreach ($division['fighter'] as $fighter) {
											if ($fighter['rank'] === 'champion' && $fighter['name'] != 'vacant' && $fighter['name'] != 'Vacant') { ?>
												<div class="slider-item">
													<?php
													$has_champion = true;
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
                                            wp_reset_postdata(); ?>
											</div>
											<?php 
                                        }
                                    }
                                } ?>

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
				<!-- social media section -->
				<section class='homepage-section instagram'>
					<h2><?php echo esc_html("Recent posts on social media") ?></h2>
					<?php echo do_shortcode('[instagram-feed]'); ?>
				</section>


				<!-- sponsor section -->
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
										</div>
									<?php
								}
								if(have_rows('sponsor')){ ?>
									<div class="logo-wrapper"> 
									<?php
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

									endwhile; ?>
									</div> 
								<?php						
								}
								if($sponsor_section_text){ ?>
									<p class="description"><?php echo esc_html($sponsor_section_text); ?></p>
									<?php
								}
								
								?>
								<div class="sponsor-cta-wrapper">
									<a href="<?php echo esc_url( home_url( '/about/' ) . '#contact-section-title' ); ?>" class="home-sponsor-cta">Partner with Us</a>
									</div>
								<?php 
	

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
