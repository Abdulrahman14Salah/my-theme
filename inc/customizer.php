<?php
/**
 * a-salah Theme Customizer
 *
 * @package a-salah
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function a_salah_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'a_salah_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'a_salah_customize_partial_blogdescription',
			)
		);
	}

	// Social Media Section
	$wp_customize->add_section('a_salah_social_media', array(
		'title'    => __('Social Media Links', 'a-salah'),
		'priority' => 30,
	));

	// Facebook URL
	$wp_customize->add_setting('a_salah_facebook_url', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
		'transport'         => 'refresh',
	));

	$wp_customize->add_control('a_salah_facebook_url', array(
		'label'       => __('Facebook URL', 'a-salah'),
		'description' => __('Enter your Facebook page URL', 'a-salah'),
		'section'     => 'a_salah_social_media',
		'type'        => 'url',
	));

	// Twitter URL
	$wp_customize->add_setting('a_salah_twitter_url', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
		'transport'         => 'refresh',
	));

	$wp_customize->add_control('a_salah_twitter_url', array(
		'label'       => __('Twitter/X URL', 'a-salah'),
		'description' => __('Enter your Twitter/X profile URL', 'a-salah'),
		'section'     => 'a_salah_social_media',
		'type'        => 'url',
	));

	// Discord URL
	$wp_customize->add_setting('a_salah_discord_url', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
		'transport'         => 'refresh',
	));

	$wp_customize->add_control('a_salah_discord_url', array(
		'label'       => __('Discord URL', 'a-salah'),
		'description' => __('Enter your Discord server URL', 'a-salah'),
		'section'     => 'a_salah_social_media',
		'type'        => 'url',
	));

	// Color Scheme Section
	$wp_customize->add_section('a_salah_colors', array(
		'title'    => __('Color Scheme', 'a-salah'),
		'priority' => 40,
	));

	// Primary Color
	$wp_customize->add_setting('a_salah_primary_color', array(
		'default'           => '#8b5cf6',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	));

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'a_salah_primary_color', array(
		'label'    => __('Primary Color', 'a-salah'),
		'section'  => 'a_salah_colors',
	)));

	// Secondary Color
	$wp_customize->add_setting('a_salah_secondary_color', array(
		'default'           => '#06b6d4',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	));

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'a_salah_secondary_color', array(
		'label'    => __('Secondary Color', 'a-salah'),
		'section'  => 'a_salah_colors',
	)));

	// Background Color
	$wp_customize->add_setting('a_salah_background_color', array(
		'default'           => '#0f172a',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	));

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'a_salah_background_color', array(
		'label'    => __('Background Color', 'a-salah'),
		'section'  => 'a_salah_colors',
	)));

	// Typography Section
	$wp_customize->add_section('a_salah_typography', array(
		'title'    => __('Typography', 'a-salah'),
		'priority' => 50,
	));

	// Heading Font
	$wp_customize->add_setting('a_salah_heading_font', array(
		'default'           => 'Inter',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh',
	));

	$wp_customize->add_control('a_salah_heading_font', array(
		'label'       => __('Heading Font', 'a-salah'),
		'description' => __('Enter the font family name (e.g., Inter, Roboto)', 'a-salah'),
		'section'     => 'a_salah_typography',
		'type'        => 'text',
	));

	// Body Font
	$wp_customize->add_setting('a_salah_body_font', array(
		'default'           => 'Inter',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh',
	));

	$wp_customize->add_control('a_salah_body_font', array(
		'label'       => __('Body Font', 'a-salah'),
		'description' => __('Enter the font family name (e.g., Inter, Roboto)', 'a-salah'),
		'section'     => 'a_salah_typography',
		'type'        => 'text',
	));

	// Layout Options Section
	$wp_customize->add_section('a_salah_layout', array(
		'title'    => __('Layout Options', 'a-salah'),
		'priority' => 60,
	));

	// Container Width
	$wp_customize->add_setting('a_salah_container_width', array(
		'default'           => '1280',
		'sanitize_callback' => 'absint',
		'transport'         => 'refresh',
	));

	$wp_customize->add_control('a_salah_container_width', array(
		'label'       => __('Container Width (px)', 'a-salah'),
		'section'     => 'a_salah_layout',
		'type'        => 'number',
	));

	// Sidebar Position
	$wp_customize->add_setting('a_salah_sidebar_position', array(
		'default'           => 'right',
		'sanitize_callback' => 'a_salah_sanitize_sidebar_position',
		'transport'         => 'refresh',
	));

	$wp_customize->add_control('a_salah_sidebar_position', array(
		'label'       => __('Sidebar Position', 'a-salah'),
		'section'     => 'a_salah_layout',
		'type'        => 'select',
		'choices'     => array(
			'right' => __('Right Sidebar', 'a-salah'),
			'left'  => __('Left Sidebar', 'a-salah'),
			'none'  => __('No Sidebar', 'a-salah'),
		),
	));
}

/**
 * Sanitize Sidebar Position
 */
function a_salah_sanitize_sidebar_position( $input ) {
	$valid = array( 'right', 'left', 'none' );
	if ( in_array( $input, $valid, true ) ) {
		return $input;
	}
	return 'right';
}

/**
 * Generate Custom CSS
 */
function a_salah_custom_css() {
	$primary_color = get_theme_mod('a_salah_primary_color', '#8b5cf6');
	$secondary_color = get_theme_mod('a_salah_secondary_color', '#06b6d4');
	$background_color = get_theme_mod('a_salah_background_color', '#0f172a');
	$container_width = get_theme_mod('a_salah_container_width', '1280');
	$heading_font = get_theme_mod('a_salah_heading_font', 'Inter');
	$body_font = get_theme_mod('a_salah_body_font', 'Inter');

	$custom_css = "
		:root {
			--primary-color: {$primary_color};
			--secondary-color: {$secondary_color};
			--background-color: {$background_color};
		}
		body {
			background-color: var(--background-color);
			font-family: '{$body_font}', sans-serif;
		}
		h1, h2, h3, h4, h5, h6 {
			font-family: '{$heading_font}', sans-serif;
		}
		.container {
			max-width: {$container_width}px;
		}
		a {
			color: var(--primary-color);
		}
		a:hover {
			color: var(--secondary-color);
		}
		.btn, button, input[type='button'], input[type='submit'] {
			background-color: var(--primary-color);
		}
		.btn:hover, button:hover, input[type='button']:hover, input[type='submit']:hover {
			background-color: var(--secondary-color);
		}
	";

	wp_add_inline_style('a-salah-style', $custom_css);
}
add_action('wp_enqueue_scripts', 'a_salah_custom_css');
add_action( 'customize_register', 'a_salah_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function a_salah_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function a_salah_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function a_salah_customize_preview_js() {
	wp_enqueue_script( 'a-salah-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), _S_VERSION, true );
}
add_action( 'customize_preview_init', 'a_salah_customize_preview_js' );
