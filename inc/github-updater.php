<?php
/**
 * GitHub updater integration for theme releases.
 *
 * @package a-salah
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Retrieve latest release information from GitHub.
 *
 * @return array|false
 */
function a_salah_get_github_release_data() {
	$cached = get_transient( 'a_salah_github_release' );

	if ( false !== $cached ) {
		return $cached;
	}

	$request = wp_remote_get(
		'https://api.github.com/repos/' . A_SALAH_GITHUB_REPO . '/releases/latest',
		array(
			'timeout' => 15,
			'headers' => array(
				'Accept'     => 'application/vnd.github+json',
				'User-Agent' => 'WordPress/' . get_bloginfo( 'version' ) . '; ' . home_url( '/' ),
			),
		)
	);

	if ( is_wp_error( $request ) ) {
		set_transient( 'a_salah_github_release', false, HOUR_IN_SECONDS );
		return false;
	}

	$status_code = wp_remote_retrieve_response_code( $request );
	$body        = wp_remote_retrieve_body( $request );
	$data        = json_decode( $body, true );

	if ( 200 !== $status_code || empty( $data['tag_name'] ) || empty( $data['zipball_url'] ) ) {
		set_transient( 'a_salah_github_release', false, HOUR_IN_SECONDS );
		return false;
	}

	$version = ltrim( (string) $data['tag_name'], 'vV' );
	$release = array(
		'version' => $version,
		'zip'     => esc_url_raw( $data['zipball_url'] ),
		'url'     => ! empty( $data['html_url'] ) ? esc_url_raw( $data['html_url'] ) : '',
		'body'    => isset( $data['body'] ) ? wp_kses_post( $data['body'] ) : '',
	);

	set_transient( 'a_salah_github_release', $release, 6 * HOUR_IN_SECONDS );

	return $release;
}

/**
 * Inject update details into WordPress update transient.
 *
 * @param stdClass $transient The theme update transient.
 * @return stdClass
 */
function a_salah_check_for_theme_update( $transient ) {
	if ( empty( $transient->checked ) || ! is_object( $transient ) ) {
		return $transient;
	}

	$theme = wp_get_theme();
	$slug  = $theme->get_stylesheet();

	if ( empty( $transient->checked[ $slug ] ) ) {
		return $transient;
	}

	$release = a_salah_get_github_release_data();

	if ( empty( $release['version'] ) || version_compare( $theme->get( 'Version' ), $release['version'], '>=' ) ) {
		return $transient;
	}

	$transient->response[ $slug ] = array(
		'theme'       => $slug,
		'new_version' => $release['version'],
		'url'         => $release['url'],
		'package'     => $release['zip'],
		'requires'    => '6.0',
		'requires_php'=> '7.4',
	);

	return $transient;
}
add_filter( 'pre_set_site_transient_update_themes', 'a_salah_check_for_theme_update' );

/**
 * Provide release details for the theme update modal.
 *
 * @param false|object|array $result Update API result.
 * @param string             $action Action type.
 * @param object             $args   Arguments.
 * @return false|object|array
 */
function a_salah_theme_update_info( $result, $action, $args ) {
	if ( 'theme_information' !== $action || empty( $args->slug ) || get_template() !== $args->slug ) {
		return $result;
	}

	$release = a_salah_get_github_release_data();

	if ( empty( $release['version'] ) ) {
		return $result;
	}

	$theme = wp_get_theme();

	return (object) array(
		'name'        => $theme->get( 'Name' ),
		'slug'        => $theme->get_stylesheet(),
		'version'     => $release['version'],
		'author'      => $theme->get( 'Author' ),
		'homepage'    => $theme->get( 'ThemeURI' ),
		'requires'    => '6.0',
		'requires_php'=> '7.4',
		'last_updated'=> gmdate( 'Y-m-d' ),
		'sections'    => array(
			'description' => $theme->get( 'Description' ),
			'changelog'   => wpautop( wp_kses_post( $release['body'] ) ),
		),
		'download_link' => $release['zip'],
	);
}
add_filter( 'themes_api', 'a_salah_theme_update_info', 10, 3 );

/**
 * Ensure GitHub zip install target folder matches the stylesheet slug.
 *
 * @param array $response Install response.
 * @return array
 */
function a_salah_fix_github_zip_folder_name( $response ) {
	if ( empty( $response['destination'] ) || empty( $response['remote_destination'] ) || empty( $response['source'] ) ) {
		return $response;
	}

	$source_basename = basename( $response['source'] );

	if ( false === strpos( $source_basename, 'my-theme-' ) ) {
		return $response;
	}

	$target = trailingslashit( $response['remote_destination'] ) . get_template();

	if ( ! @rename( $response['source'], $target ) ) {
		return $response;
	}

	$response['destination'] = $target;
	return $response;
}
add_filter( 'upgrader_install_package_result', 'a_salah_fix_github_zip_folder_name' );

/**
 * Flush updater cache after theme switch.
 */
function a_salah_flush_release_cache() {
	delete_transient( 'a_salah_github_release' );
}
add_action( 'switch_theme', 'a_salah_flush_release_cache' );
