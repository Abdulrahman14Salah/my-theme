<?php
/**
 * SEO Enhancements.
 *
 * @package a-salah
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Output OG and Twitter meta tags.
 */
function a_salah_og_tags() {
	if ( ! is_singular() && ! is_front_page() && ! is_home() ) {
		return;
	}

	$title       = wp_get_document_title();
	$description = get_bloginfo( 'description' );
	$url         = home_url( '/' );
	$image       = get_template_directory_uri() . '/assets/images/logo.png';
	$type        = 'website';

	if ( is_singular() ) {
		$title       = get_the_title();
		$description = has_excerpt() ? get_the_excerpt() : wp_trim_words( wp_strip_all_tags( get_the_content() ), 25 );
		$url         = get_permalink();
		$type        = 'article';
		if ( has_post_thumbnail() ) {
			$image = get_the_post_thumbnail_url( get_the_ID(), 'large' );
		}
	}
	?>
	<meta name="description" content="<?php echo esc_attr( $description ); ?>" />
	<meta property="og:title" content="<?php echo esc_attr( $title ); ?>" />
	<meta property="og:description" content="<?php echo esc_attr( $description ); ?>" />
	<meta property="og:type" content="<?php echo esc_attr( $type ); ?>" />
	<meta property="og:url" content="<?php echo esc_url( $url ); ?>" />
	<meta property="og:image" content="<?php echo esc_url( $image ); ?>" />
	<meta name="twitter:card" content="summary_large_image" />
	<?php
}
add_action( 'wp_head', 'a_salah_og_tags', 5 );

/**
 * Add basic schema markup for single posts.
 */
function a_salah_schema_markup() {
	if ( ! is_single() ) {
		return;
	}

	$schema = array(
		'@context'      => 'https://schema.org',
		'@type'         => 'BlogPosting',
		'headline'      => get_the_title(),
		'datePublished' => get_the_date( DATE_W3C ),
		'dateModified'  => get_the_modified_date( DATE_W3C ),
		'mainEntityOfPage' => get_permalink(),
		'author'        => array(
			'@type' => 'Person',
			'name'  => get_the_author(),
		),
		'publisher'     => array(
			'@type' => 'Organization',
			'name'  => get_bloginfo( 'name' ),
		),
	);

	if ( has_post_thumbnail() ) {
		$schema['image'] = get_the_post_thumbnail_url( get_the_ID(), 'large' );
	}

	echo '<script type="application/ld+json">' . wp_json_encode( $schema ) . '</script>';
}
add_action( 'wp_head', 'a_salah_schema_markup' );
