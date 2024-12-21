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
		<div class="left-header">
			<div class="site-branding">
				<?php
				the_custom_logo();
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
			</div>
		</div>

		<div class="right-header">
			<!-- Site Navigation -->
			<nav id="site-navigation" class="main-navigation">
					<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
						<svg clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m22 16.75c0-.414-.336-.75-.75-.75h-18.5c-.414 0-.75.336-.75.75s.336.75.75.75h18.5c.414 0 .75-.336.75-.75zm0-5c0-.414-.336-.75-.75-.75h-18.5c-.414 0-.75.336-.75.75s.336.75.75.75h18.5c.414 0 .75-.336.75-.75zm0-5c0-.414-.336-.75-.75-.75h-18.5c-.414 0-.75.336-.75.75s.336.75.75.75h18.5c.414 0 .75-.336.75-.75z" fill-rule="nonzero"/></svg>
					</button>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-1',
							'menu_id'        => 'primary-menu',
						)
					);
					?>
				</nav>

			<!-- Countdown Section -->
			<?php
			$startDate = get_option('ws_countdown_from');
			$endDate = get_option('ws_countdown_to');
			$currentDate = date('Y-m-d\TH:i:s');

			if (strtotime($currentDate) > strtotime($startDate) && strtotime($endDate) !== false && strtotime($currentDate) < strtotime($endDate)) {
				?>

				<!-- Countdown -->
				<div class="countdown-section">
					<div class="clock">
						<div class="timer-text">
							<p class="next-event"><?php echo esc_html("Next Event"); ?></p>
							<p class="starting-in"><?php echo esc_html("Starting In"); ?></p>
						</div>
						<div class="countdown-timer-box">
							<?php echo do_shortcode( '[ws_countdown_timer]' ); ?>
						</div>
					</div>

					<?php
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
							$tickets = get_field('upcoming_events_hero')["tickets_link"];
							if ($tickets) {
								?>
								<a href="<?php echo esc_url($tickets); ?>" class="header-cta"><?php echo esc_html("Get Your Tickets"); ?></a>
								<?php
							}
						}
					}
					wp_reset_postdata();
					?>

					<!-- Decorative Line -->
					<hr class="decorative-line">

				</div>
				<?php
			}
			?>
		</div>

	</header>
