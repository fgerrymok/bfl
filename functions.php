<?php
/**
 * BFL functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package BFL
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function bfl_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on BFL, use a find and replace
		* to change 'bfl' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'bfl', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'bfl' ),
			'footer-events'       => esc_html__('Footer Events Menu','bfl'),
			'footer-company'      => esc_html__('Footer Company Menu', 'bfl'),
			'footer-resources'    => esc_html__('Footer Resources Menu', 'bfl'),
			'footer-social-icons' => esc_html__('Footer Social Icons', 'bfl'),
			'footer-logo'         => esc_html__('Footer Logo', 'bfl'),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'bfl_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'bfl_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function bfl_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'bfl_content_width', 640 );
}
add_action( 'after_setup_theme', 'bfl_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function bfl_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'bfl' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'bfl' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'bfl_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function bfl_scripts() {
	wp_enqueue_style( 'bfl-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'bfl-style', 'rtl', 'replace' );

	wp_enqueue_script( 'bfl-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	
	if ( is_page('rankings') ) {
		wp_enqueue_script( 'bfl-ranking-tab', get_template_directory_uri() . '/js/ranking-tab.js', array(), _S_VERSION, true );
	}
	wp_enqueue_script( 'custom-nav', get_template_directory_uri() . '/js/custom-nav.js', array(), _S_VERSION, true );
	if ( is_page( 'bfl-to-ufc' ) ) {
		wp_enqueue_script( 'bfl-to-ufc-tab', get_template_directory_uri() . '/js/bfl-to-ufc-tab.js', array(), _S_VERSION, true );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular( 'bfl-news' ) ) {
		wp_enqueue_script( 'copy-link-button', get_template_directory_uri(). '/js/copylinkbutton.js', array(), _S_VERSION, true );
	}

	// loadmore news
	if ( is_post_type_archive( 'bfl-news' ) ) {
		wp_enqueue_script('loadmore-news', get_template_directory_uri() . '/js/loadmore-news.js', ['jquery'], null, true);
		wp_localize_script('loadmore-news', 'bfl_ajax', ['ajax_url' => admin_url('admin-ajax.php'),]);
	}

	// loadmore video(post)
	if ( is_home() ) {
		wp_enqueue_script('loadmore-video', get_template_directory_uri() . '/js/loadmore-post.js', ['jquery'], null, true);
		wp_localize_script('loadmore-video', 'ajax_object', ['ajaxurl' => admin_url('admin-ajax.php'), ]);
	}

	// Enqueue Accordion Script
	wp_enqueue_script('bfl-theme-accordion', get_template_directory_uri() . '/js/accordion.js', array(), '1.0.0', true );

	// Enqueue Google Fonts ('Inter and Bebas Neue')
	wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap', [], null);

	// Enqueue Video Modal Function
	if ( is_home() || is_front_page() ) {
		wp_enqueue_script(
			'modal-script', 
			get_template_directory_uri() . '/js/modal.js', 
			['jquery'], // Optional: Dependencies like jQuery
			null, 
			true // Load in the footer
		);
	}


	// Slick CSS
	wp_enqueue_style('slick-css', get_template_directory_uri() . '/extra_css/slick.css');
	// Slick JS
	wp_enqueue_script('slick-js', get_template_directory_uri() . '/js/slick.min.js', array('jquery'), null, true);
	// Custom Slider Init Script
	wp_enqueue_script('ws-slick-init', get_template_directory_uri() . '/js/ws-slick.js', array('jquery', 'slick-js'), null, true);
}
add_action( 'wp_enqueue_scripts', 'bfl_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
* Custom Post Types and Taxonomies.
*/
require get_template_directory() . '/inc/cpt-taxonomy.php';

/**
* Custom functions.
*/
require get_template_directory() . '/inc/rearrange-admin-menu.php';
require get_template_directory() . '/inc/loadmore-news.php';
require get_template_directory() . '/inc/loadmore-post.php';
require get_template_directory() . '/inc/modal-video.php';


// remove the title of about page
add_filter('the_title', 'remove_about_page_title',10,2);

function remove_about_page_title($title, $id){
	if(is_page(8633) && in_the_loop()){
		return '';
	}
	return $title;
}


// Disable the block editor for all post types except for the Homepage and Contact Page
function disable_block_editor_except_pages($can_edit, $post_type) {

	$id = 2;

	if ( get_the_ID() === $id ) {
		return true;
	} else {
		return false;
	}
}

add_filter('use_block_editor_for_post', 'disable_block_editor_except_pages', 10, 2);
add_filter('gutenberg_can_edit_post_type', 'disable_block_editor_except_pages', 10, 2);



// Add theme support for custom logo
function my_theme_setup() {
    add_theme_support( 'custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-width'  => true, 
        'flex-height' => true, 
    ));
}
add_action( 'after_setup_theme', 'my_theme_setup' );


/**
 * All functions to build a custom dashboard in WordPress
 */
require get_template_directory() . '/inc/wordpress-dashboard-functions.php';


/**
 * Register and enqueue a custom stylesheet for the dashboard and login screen
 */
function wpdocs_enqueue_custom_admin_style() {
	wp_register_style( 'backend_css', get_template_directory_uri() . '/backend.css', false, '1.0.0' );
	wp_enqueue_style( 'backend_css' );
}
add_action( 'admin_enqueue_scripts', 'wpdocs_enqueue_custom_admin_style' );


// Adding custom logo to WordPress login
function my_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo esc_url(get_stylesheet_directory_uri() . '/backend/site-logo.png'); ?>);
            background-repeat: no-repeat;
            padding-bottom: 30px;
            width: 100%; /* Adjust width as needed */
            height: 80px; /* Adjust height as needed */
            background-size: contain; /* Ensure logo fits properly */
        }
    </style>
<?php }
add_action('login_enqueue_scripts', 'my_login_logo');

// Updating the link so that the new WordPress logo leads to the site
function my_login_logo_url() {
    return home_url();
}
add_filter('login_headerurl', 'my_login_logo_url');

// Updating the title attribute of the login logo
function my_login_logo_url_title() {
    return 'BFL';
}
add_filter('login_headertitle', 'my_login_logo_url_title');


// Custom Styles for Login Page
function custom_login_styles() {
    wp_enqueue_style('custom-login', get_stylesheet_directory_uri() . '/custom-login.css');
}
add_action('login_enqueue_scripts', 'custom_login_styles');