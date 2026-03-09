<?php
/**
 * WooCommerce Support
 *
 * @package a-salah
 */

function a_salah_woocommerce_setup() {
	add_theme_support(
		'woocommerce',
		array(
			'thumbnail_image_width' => 150,
			'single_image_width'    => 300,
			'product_grid'          => array(
				'default_rows'    => 3,
				'min_rows'        => 2,
				'max_rows'        => 8,
				'default_columns' => 4,
				'min_columns'     => 2,
				'max_columns'     => 5,
			),
		)
	);
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'a_salah_woocommerce_setup' );

/**
 * WooCommerce Wrapper
 */
function a_salah_woocommerce_wrapper_before() {
	?>
	<main id="primary" class="site-main container py-12">
	<?php
}
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
add_action( 'woocommerce_before_main_content', 'a_salah_woocommerce_wrapper_before', 10 );

function a_salah_woocommerce_wrapper_after() {
	?>
	</main><!-- #main -->
	<?php
}
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
add_action( 'woocommerce_after_main_content', 'a_salah_woocommerce_wrapper_after', 10 );
