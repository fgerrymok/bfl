<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package BFL
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'bfl' ); ?></a>
	<header id="masthead" class="site-header">
		<div class="site-branding">
			<?php
			if (has_custom_logo()) {
				the_custom_logo();
			}
			?>
			<div class="header-logo-text"><?php echo esc_html("Battlefield Fight League"); ?></div>
			<?php
			if ( is_front_page() && is_home() ) :
				?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php
			else :
				?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
			endif;
			$bfl_description = get_bloginfo( 'description', 'display' );
			if ( $bfl_description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php echo $bfl_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
			<?php endif; ?>
		</div><!-- .site-branding -->

		<!-- Countdown Timer -->
		<div class="countdown-timer">
			<div><?php echo esc_html("Next Event"); ?><span><?php echo esc_html("Starting In"); ?></span></div>
    		<?php echo do_shortcode('[sales_countdown_timer id="salescountdowntimer"]'); ?>
			<a href=""><?php echo esc_html("Get Your Tickets"); ?></a>
		</div>

		<nav id="site-navigation" class="main-navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'bfl' ); ?></button>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
				)
			);
			?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->
