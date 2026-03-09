<?php
/**
 * SEO Enhancements
 *
 * @package a-salah
 */

/**
 * Add Open Graph Tags
 */
function a_salah_og_tags() {
	if ( is_single() || is_page() ) {
		global $post;
		$description = get_the_excerpt();
		if ( ! $description ) {
			$description = wp_trim_words( $post->post_content, 20 );
		}
		?>
		<meta property="og:title" content="<?php the_title(); ?>" />
		<meta property="og:description" content="<?php echo esc_attr( $description ); ?>" />
		<meta property="og:type" content="article" />
		<meta property="og:url" content="<?php the_permalink(); ?>" />
		<?php if ( has_post_thumbnail() ) : ?>
			<meta property="og:image" content="<?php echo esc_url( get_the_post_thumbnail_url( $post->ID, 'large' ) ); ?>" />
		<?php endif; ?>
		<meta name="twitter:card" content="summary_large_image" />
		<?php if ( get_theme_mod( 'a_salah_twitter_url' ) ) : ?>
			<meta name="twitter:site" content="<?php echo esc_attr( '@' . basename( get_theme_mod( 'a_salah_twitter_url' ) ) ); ?>" />
		<?php endif; ?>
		<?php
	} elseif ( is_home() || is_front_page() ) {
		?>
		<meta property="og:title" content="<?php bloginfo( 'name' ); ?>" />
		<meta property="og:description" content="<?php bloginfo( 'description' ); ?>" />
		<meta property="og:type" content="website" />
		<meta property="og:url" content="<?php echo esc_url( home_url( '/' ) ); ?>" />
		<meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/screenshot.png" />
		<?php
	}
}
add_action( 'wp_head', 'a_salah_og_tags' );

/**
 * Add Schema.org Markup
 */
function a_salah_schema_markup() {
	if ( is_single() ) {
		global $post;
		$schema = array(
			'@context' => 'https://schema.org',
			'@type'    => 'BlogPosting',
			'headline' => get_the_title(),
			'datePublished' => get_the_date( 'c' ),
			'dateModified'  => get_the_modified_date( 'c' ),
			'author'        => array(
				'@type' => 'Person',
				'name'  => get_the_author(),
			),
			'publisher'     => array(
				'@type' => 'Organization',
				'name'  => get_bloginfo( 'name' ),
				'logo'  => array(
					'@type' => 'ImageObject',
					'url'   => get_template_directory_uri() . '/assets/images/logo.png',
				),
			),
		);

		if ( has_post_thumbnail() ) {
			$schema['image'] = get_the_post_thumbnail_url( $post->ID, 'large' );
		}

		echo '<script type="application/ld+json">' . wp_json_encode( $schema ) . '</script>';
	}
}
add_action( 'wp_head', 'a_salah_schema_markup' );
