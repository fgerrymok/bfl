<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package BFL
 */

?>

	<footer id="colophon" class="site-footer">
		<!-- Site Logo -->
		 <?php
		 	$menu_location = 'footer-logo';
			$menu = wp_get_nav_menu_object(
				get_nav_menu_locations()[$menu_location]
			);
			if($menu){
				if(get_field('footer_logo','menu_'. $menu->term_id)){
				$logo_image = get_field('footer_logo','menu_'. $menu->term_id);
				$logo_link  = home_url();
				}
				?>
				<a href="<?php echo esc_url($logo_link); ?>">
					<?php echo wp_get_attachment_image($logo_image, 'medium'); ?>
				</a>
				<?php
		
			}
		 ?>

		<!-- navigation Section -->
		 <section>
			<div class='bfl-footer-column'>
				<p>Events</p>
				<nav class='bfl-footer-navigation'>
					 <?php
					 wp_nav_menu(array('theme_location' => 'footer-events'));
					 ?>
			 	</nav>	
			</div>
			<div class='bfl-footer-column'>
				<p>Company</p>
				<nav class='bfl-footer-navigation'>
					 <?php
					 wp_nav_menu(array('theme_location' => 'footer-company'));
					 ?>
			 	</nav>	
			</div>
			<div class='bfl-footer-column'>
				<p>Resources</p>
				<nav class='bfl-footer-navigation'>
					 <?php
					 wp_nav_menu(array('theme_location' => 'footer-resources'));
					 ?>
			 	</nav>	
			</div>
		 </section>
		 
		<!-- Social Icons Section -->
		 <section class='social-icons-footer'>
			<?php
				$social_menu_location = 'footer-social-icons';
				$social_menu          = wp_get_nav_menu_object(
					get_nav_menu_locations()[$social_menu_location]
				);

				if($social_menu){
					if(have_rows('footer_social_icons','menu_'. $social_menu->term_id)):
						while(have_rows('footer_social_icons','menu_'. $social_menu->term_id)): the_row();
							$facebook_icon   = get_sub_field('facebook_icon');
							$twitter_icon    = get_sub_field('twitter_icon');
							$instagram_icon  = get_sub_field('instagram_icon');
							$youtube_icon    = get_sub_field('youtube_icon');
							$tiktok_icon     = get_sub_field('tiktok_icon');
							?>
							<nav class='social-icons-nav'>
								<?php
								// facebook icon
									if($facebook_icon){
										$facebook_icon_image = wp_get_attachment_image($facebook_icon, 'thumbnail');
										$facebook_link = 'https://www.facebook.com/battlefieldfight/';
									?>
									<li><a href="<?php echo esc_url($facebook_link); ?>"><?php echo $facebook_icon_image;?></a></li>
									<?php
								}
								// twitter icon
									if($twitter_icon){
										$twitter_icon_image = wp_get_attachment_image($twitter_icon, 'thumbnail');
										$twitter_link = 'https://x.com/BattlefieldFL';
									?>
									<li><a href="<?php echo esc_url($twitter_link); ?>"><?php echo $twitter_icon_image;?></a></li>
									<?php
								}
								// instagram icon
								if($instagram_icon){
									$instagram_icon_image = wp_get_attachment_image($instagram_icon, 'thumbnail');
									$instagram_link = 'https://www.instagram.com/bflmma/';
								?>
								<li><a href="<?php echo esc_url($instagram_link); ?>"><?php echo $instagram_icon_image;?></a></li>
								<?php
								}
								// youtube icon
								if($youtube_icon){
									$youtube_icon_image = wp_get_attachment_image($youtube_icon, 'thumbnail');
									$youtube_link = 'https://www.youtube.com/@Battlefieldfl';
								?>
								<li><a href="<?php echo esc_url($youtube_link); ?>"><?php echo $youtube_icon_image;?></a></li>
								<?php
								}

								// tiktok icon
								if($tiktok_icon){
									$tiktok_icon_image = wp_get_attachment_image($tiktok_icon, 'thumbnail');
									$tiktok_link = 'https://www.tiktok.com/@battlefieldfl';
								?>
								<li><a href="<?php echo esc_url($tiktok_link); ?>"><?php echo $tiktok_icon_image;?></a></li>
								<?php
								}
								?>
								
							</nav>
							<?php

						endwhile;
					endif;
				}
			?>
		 </section>

		 <div class="site-info">
				<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Built by: %s' ), '<a href="http://wsstudio.ca">Whitespace Studio</a>' );
				?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
