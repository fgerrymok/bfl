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
		<div class="site-info">
				<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Built by: %s' ), '<a href="http://wsstudio.ca">Whitespace Studio</a>' );
				?>
		</div><!-- .site-info -->

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
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
