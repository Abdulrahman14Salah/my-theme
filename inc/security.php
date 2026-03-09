<?php
/**
 * Security Enhancements
 *
 * @package a-salah
 */

/**
 * Disable XML-RPC
 */
add_filter( 'xmlrpc_enabled', '__return_false' );

/**
 * Remove WordPress Version from Head
 */
remove_action( 'wp_head', 'wp_generator' );

/**
 * Disable File Editing
 */
if ( ! defined( 'DISALLOW_FILE_EDIT' ) ) {
	define( 'DISALLOW_FILE_EDIT', true );
}

/**
 * Hide Login Errors
 */
function a_salah_no_wordpress_errors() {
	return 'Something is wrong!';
}
add_filter( 'login_errors', 'a_salah_no_wordpress_errors' );

/**
 * Sanitize Text Field Helper
 */
function a_salah_sanitize_text( $input ) {
	return sanitize_text_field( $input );
}

/**
 * Add Security Headers
 */
function a_salah_security_headers() {
	header( 'X-XSS-Protection: 1; mode=block' );
	header( 'X-Content-Type-Options: nosniff' );
	header( 'Referrer-Policy: no-referrer-when-downgrade' );
}
add_action( 'send_headers', 'a_salah_security_headers' );
