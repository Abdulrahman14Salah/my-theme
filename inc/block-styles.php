<?php
/**
 * Block Styles
 *
 * @package a-salah
 */

if ( function_exists( 'register_block_style' ) ) {
	/**
	 * Button Styles
	 */
	register_block_style(
		'core/button',
		array(
			'name'  => 'primary-gradient',
			'label' => __( 'Primary Gradient', 'a-salah' ),
		)
	);

	register_block_style(
		'core/button',
		array(
			'name'  => 'outline',
			'label' => __( 'Outline', 'a-salah' ),
		)
	);

	/**
	 * Image Styles
	 */
	register_block_style(
		'core/image',
		array(
			'name'  => 'rounded-shadow',
			'label' => __( 'Rounded Shadow', 'a-salah' ),
		)
	);

	/**
	 * Quote Styles
	 */
	register_block_style(
		'core/quote',
		array(
			'name'  => 'modern-quote',
			'label' => __( 'Modern Quote', 'a-salah' ),
		)
	);
}
