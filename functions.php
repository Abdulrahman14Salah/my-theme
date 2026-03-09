<?php

/**
 * a-salah functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package a-salah
 */

if (! defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function a_salah_setup()
{
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on a-salah, use a find and replace
		* to change 'a-salah' to the name of your theme in all the template files.
		*/
	load_theme_textdomain('a-salah', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support('title-tag');

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support('post-thumbnails');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__('Primary', 'a-salah'),
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
			'a_salah_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

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
add_action('after_setup_theme', 'a_salah_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function a_salah_content_width()
{
	$GLOBALS['content_width'] = apply_filters('a_salah_content_width', 640);
}
add_action('after_setup_theme', 'a_salah_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function a_salah_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'a-salah'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'a-salah'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__('Footer Column 1', 'a-salah'),
			'id'            => 'footer-1',
			'description'   => esc_html__('First footer column.', 'a-salah'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__('Footer Column 2', 'a-salah'),
			'id'            => 'footer-2',
			'description'   => esc_html__('Second footer column.', 'a-salah'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__('Footer Column 3', 'a-salah'),
			'id'            => 'footer-3',
			'description'   => esc_html__('Third footer column.', 'a-salah'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__('Header Widget', 'a-salah'),
			'id'            => 'header-widget',
			'description'   => esc_html__('Widget area in the header.', 'a-salah'),
			'before_widget' => '<div id="%1$s" class="header-widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="screen-reader-text">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'a_salah_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function a_salah_scripts()
{
	wp_enqueue_style('a-salah-style', get_stylesheet_uri(), array(), _S_VERSION);
	wp_style_add_data('a-salah-style', 'rtl', 'replace');
	wp_enqueue_style('tailwind-css', get_template_directory_uri() . '/frontend/public/style.min.css', array(), _S_VERSION, 'all');
	wp_enqueue_script('a-salah-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);
	wp_enqueue_script('a-salah-main-js', get_template_directory_uri() . '/js/main.js', array('jquery'), _S_VERSION, true);

	wp_localize_script('a-salah-main-js', 'a_salah_ajax', array(
		'ajax_url' => admin_url('admin-ajax.php'),
		'nonce'    => wp_create_nonce('a_salah_nonce')
	));

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'a_salah_scripts');

/**
 * AJAX Load More Handler
 */
function a_salah_load_more_posts() {
	check_ajax_referer('a_salah_nonce', 'nonce');

	$args = array(
		'post_type' => 'post',
		'post_status' => 'publish',
		'paged' => $_POST['page'],
	);

	$query = new WP_Query($args);

	if ($query->have_posts()) {
		ob_start();
		while ($query->have_posts()) {
			$query->the_post();
			get_template_part('template-parts/content', get_post_type());
		}
		wp_send_json_success(ob_get_clean());
	} else {
		wp_send_json_error('No more posts');
	}
	wp_die();
}
add_action('wp_ajax_load_more_posts', 'a_salah_load_more_posts');
add_action('wp_ajax_nopriv_load_more_posts', 'a_salah_load_more_posts');

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
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Custom Post Types.
 */
require get_template_directory() . '/inc/post-types.php';

/**
 * Security Enhancements.
 */
require get_template_directory() . '/inc/security.php';

/**
 * SEO Enhancements.
 */
require get_template_directory() . '/inc/seo.php';

/**
 * Block Styles.
 */
require get_template_directory() . '/inc/block-styles.php';

/**
 * WooCommerce Support.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

/**
 * Register Block Patterns.
 */
function a_salah_register_block_patterns() {
	register_block_pattern_category(
		'a-salah',
		array( 'label' => __( 'A-Salah', 'a-salah' ) )
	);

	register_block_pattern(
		'a-salah/hero-section',
		require get_template_directory() . '/block-patterns/hero-section.php'
	);

	register_block_pattern(
		'a-salah/services-grid',
		require get_template_directory() . '/block-patterns/services-grid.php'
	);
}
add_action( 'init', 'a_salah_register_block_patterns' );

/**
 * Custom Walker Nav Menu.
 */
class Custom_Walker_Nav_Menu extends Walker_Nav_Menu
{

	// Start the <ul> for submenus
	function start_lvl(&$output, $depth = 0, $args = null)
	{
		$output .= '<ul class="custom-submenu-class">';
	}

	// Start each <li> element
	function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
	{
		// Ensure $item->classes is an array
		$classes = !empty($item->classes) && is_array($item->classes) ? implode(' ', $item->classes) : '';

		$output .= '<li class="custom-li-class ' . esc_attr($classes) . '">';

		$attributes = !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
		$output .= '<a class="custom-a-class text-white hover:link md:px-4 block font-bold" ' . $attributes . '>';
		$output .= apply_filters('the_title', $item->title, $item->ID);
		$output .= '</a>';
	}
}



/**
 * Add Class Dark Mode to body.
 */
function add_dark_mode_classes($classes)
{
	$classes[] = 'bg-gray-950 dark:bg-gray-950';
	return $classes;
}
add_filter('body_class', 'add_dark_mode_classes');


/**
 * Remove Block Library.
 */
function remove_block_library_css()
{
	wp_dequeue_style('wp-block-library');
}
add_action('wp_enqueue_scripts', 'remove_block_library_css', 100);


function a_salah_services_shortcode()
{
	ob_start();
?>
	<div class="space-y-8 md:grid md:grid-cols-2 lg:grid-cols-3 md:gap-12 md:space-y-0 md:px-4">
		<div>
			<div class="flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-primary-900 lg:h-12 lg:w-12">
				<svg class="w-5 h-5 lg:w-6 lg:h-6 text-primary-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
					<path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 0l-2 2a1 1 0 101.414 1.414L8 10.414l1.293 1.293a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
				</svg>
			</div>
			<h3 class="mb-2 text-xl font-bold text-white">WordPress Website Design & Development</h3>
			<p class="text-gray-400">We create professional, high-performance WordPress websites tailored to your needs. Whether it’s a business site, eCommerce store, or portfolio, we ensure a seamless user experience and modern design.</p>
		</div>
		<div>
			<div class="flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-primary-900 lg:h-12 lg:w-12">
				<svg class="w-5 h-5 lg:w-6 lg:h-6 text-primary-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
					<path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"></path>
				</svg>
			</div>
			<h3 class="mb-2 text-xl font-bold text-white">WordPress Plugin & Theme Development</h3>
			<p class="text-gray-400">Custom WordPress plugins and themes built from scratch to enhance functionality and design. We develop secure, scalable, and optimized solutions that fit your website’s unique requirements.</p>
		</div>
		<div>
			<div class="flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-primary-900 lg:h-12 lg:w-12">
				<svg class="w-5 h-5 lg:w-6 lg:h-6 text-primary-300" fill="currentColor" viewBox="0 0 100 100" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">

					<g id="network" />

					<g id="connection" />

					<g id="page" />

					<g id="support" />

					<g id="configuration" />

					<g id="cloud_storage" />

					<g id="password" />

					<g id="search_engine" />

					<g id="history" />

					<g id="SEO">

						<g>

							<path d="M82,4H18c-2.8,0-5,2.2-5,5v67c0,2.8,2.2,5,5,5h25v12c0,1.7,1.3,3,3,3h8c1.7,0,3-1.3,3-3V81h25c2.8,0,5-2.2,5-5V9    C87,6.2,84.8,4,82,4z M55,93c0,0.6-0.4,1-1,1h-8c-0.6,0-1-0.4-1-1V74c0-0.6,0.4-1,1-1h8c0.6,0,1,0.4,1,1V93z M72.2,31.4L71,29.2    l8.5,0.9l-3.5,8l-1-1.8c-0.1-0.2-0.4-0.4-0.6-0.5c-0.3-0.1-0.5,0-0.8,0.1l-7.5,4.7c0,0,0,0,0,0L49,51.5l-5.4-8.3    c-0.1-0.2-0.4-0.4-0.6-0.4c-0.3-0.1-0.5,0-0.8,0.2l-7.8,5.4C34.1,47.2,34,46.1,34,45c0-0.3,0-0.6,0-0.9l10.4-7l5.4,8.3    c0.3,0.5,0.9,0.6,1.4,0.3L65,37c0,0,0,0,0,0c0,0,0,0,0,0l6.8-4.3C72.3,32.4,72.5,31.8,72.2,31.4z M66,45c0,8.8-7.2,16-16,16    c-6.8,0-12.8-4.2-15.1-10.6l7.5-5.2l5.4,8.3c0.2,0.3,0.5,0.5,0.8,0.5c0.2,0,0.4,0,0.5-0.2l16.7-10.6C66,43.8,66,44.4,66,45z     M34.4,41.3C36.1,34.2,42.5,29,50,29c5.3,0,10.1,2.5,13.1,6.9L51,43.4l-5.4-8.3c-0.1-0.2-0.4-0.4-0.6-0.4c-0.3-0.1-0.5,0-0.8,0.1    L34.4,41.3z M64.8,34.7C61.5,29.8,56,27,50,27c-9.3,0-17.1,7.2-17.9,16.4C32,43.8,32,44.4,32,45c0,1.8,0.3,3.6,0.8,5.3    C35.1,57.8,42,63,50,63c9.9,0,18-8.1,18-18c0-1-0.1-1.9-0.3-2.9l2.7-1.7c0.3,1.5,0.5,3.1,0.5,4.7c0,11.6-9.4,21-21,21    c-8.6,0-16.5-5.4-19.6-13.5c-0.7-1.9-1.2-3.8-1.3-5.8C29,46.1,29,45.5,29,45c0-11.6,9.4-21,21-21c7,0,13.4,3.4,17.4,9.2L64.8,34.7    z M53,67.8V71h-6v-3.2c1,0.1,2,0.2,3,0.2C51,68,52,67.9,53,67.8z M85,76c0,1.7-1.3,3-3,3H57v-5c0-1.3-0.8-2.4-2-2.8v-3.7    C65.3,65.2,73,56,73,45c0-2-0.3-3.9-0.8-5.8l1.5-1l1.4,2.6c0.2,0.3,0.5,0.5,0.9,0.5c0.4,0,0.7-0.2,0.9-0.6l4.9-11.1    c0.1-0.3,0.1-0.6-0.1-0.9s-0.4-0.5-0.8-0.5L69.3,27c-0.4,0-0.7,0.1-0.9,0.4c-0.2,0.3-0.2,0.7,0,1l1.7,3l-0.9,0.6    C64.8,25.7,57.7,22,50,22c-12.7,0-23,10.3-23,23c0,0.4,0,0.9,0,1.3l-8.6,5.8c-0.4,0.3-0.6,0.9-0.3,1.3l3,5.1    c0.1,0.2,0.4,0.4,0.6,0.5c0.1,0,0.1,0,0.2,0c0.2,0,0.4-0.1,0.6-0.2l6.5-4.4c3,6.6,9,11.5,16,13v3.8c-1.2,0.4-2,1.5-2,2.8v5H18    c-1.7,0-3-1.3-3-3V18h70V76z M28.3,52.5l-6,4.1l-2-3.4l6.9-4.7C27.5,49.9,27.8,51.2,28.3,52.5z M85,16H15V9c0-1.7,1.3-3,3-3h64    c1.7,0,3,1.3,3,3V16z" />

							<circle cx="79" cy="11" r="2" />

							<circle cx="73" cy="11" r="2" />

							<circle cx="67" cy="11" r="2" />

						</g>

					</g>

					<g id="optimization" />

					<g id="backlink" />

					<g id="performance" />

					<g id="analytics" />

					<g id="security" />

					<g id="dark_web" />

					<g id="video_player" />

					<g id="upload_download" />

					<g id="incognito_tab" />

					<g id="bookmark" />

				</svg>
			</div>
			<h3 class="mb-2 text-xl font-bold text-white">Website Optimization & SEO</h3>
			<p class="text-gray-400">Boost your website’s speed, performance, and search engine ranking. We optimize loading times, enhance SEO strategies, and implement best practices to increase visibility and user engagement.</p>
		</div>
		<div>
			<div class="flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-primary-900 lg:h-12 lg:w-12">
				<svg class="w-5 h-5 lg:w-6 lg:h-6 text-primary-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
					<path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"></path>
					<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"></path>
				</svg>
			</div>
			<h3 class="mb-2 text-xl font-bold text-white">Website Maintenance & Updates</h3>
			<p class="text-gray-400">Keep your website secure, up-to-date, and running smoothly. We handle regular updates, security patches, bug fixes, and performance monitoring to ensure seamless operation.</p>
		</div>
		<div>
			<div class="flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-primary-900 lg:h-12 lg:w-12">
				<svg class="w-5 h-5 lg:w-6 lg:h-6 text-primary-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
					<path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"></path>
				</svg>
			</div>
			<h3 class="mb-2 text-xl font-bold text-white">Laravel Web Development</h3>
			<p class="text-gray-400">Build powerful, scalable web applications with Laravel. We create custom solutions that are secure, fast, and tailored to your business needs, ensuring a smooth user experience.</p>
		</div>
		<div>
			<div class="flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-primary-900 lg:h-12 lg:w-12">
				<svg class="w-5 h-5 lg:w-6 lg:h-6 text-primary-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
					<path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path>
				</svg>
			</div>
			<h3 class="mb-2 text-xl font-bold text-white">Web Hosting Management & Domain Registration</h3>
			<p class="text-gray-400">We manage hosting setup, server configurations, and domain registration for a hassle-free experience. Enjoy reliable performance, security, and backups for your website.</p>
		</div>
	</div>
<?php
	return ob_get_clean();
}
add_shortcode('a_salah_services', 'a_salah_services_shortcode');
