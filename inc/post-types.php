<?php
/**
 * Register Custom Post Types
 *
 * @package a-salah
 */

function a_salah_register_post_types() {

	// Portfolio Post Type
	$labels_portfolio = array(
		'name'                  => _x( 'Portfolio', 'Post Type General Name', 'a-salah' ),
		'singular_name'         => _x( 'Project', 'Post Type Singular Name', 'a-salah' ),
		'menu_name'             => __( 'Portfolio', 'a-salah' ),
		'name_admin_bar'        => __( 'Project', 'a-salah' ),
		'archives'              => __( 'Project Archives', 'a-salah' ),
		'attributes'            => __( 'Project Attributes', 'a-salah' ),
		'parent_item_colon'     => __( 'Parent Project:', 'a-salah' ),
		'all_items'             => __( 'All Projects', 'a-salah' ),
		'add_new_item'          => __( 'Add New Project', 'a-salah' ),
		'add_new'               => __( 'Add New', 'a-salah' ),
		'new_item'              => __( 'New Project', 'a-salah' ),
		'edit_item'             => __( 'Edit Project', 'a-salah' ),
		'update_item'           => __( 'Update Project', 'a-salah' ),
		'view_item'             => __( 'View Project', 'a-salah' ),
		'view_items'            => __( 'View Projects', 'a-salah' ),
		'search_items'          => __( 'Search Project', 'a-salah' ),
		'not_found'             => __( 'Not found', 'a-salah' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'a-salah' ),
		'featured_image'        => __( 'Featured Image', 'a-salah' ),
		'set_featured_image'    => __( 'Set featured image', 'a-salah' ),
		'remove_featured_image' => __( 'Remove featured image', 'a-salah' ),
		'use_featured_image'    => __( 'Use as featured image', 'a-salah' ),
		'insert_into_item'      => __( 'Insert into project', 'a-salah' ),
		'uploaded_to_this_item' => __( 'Uploaded to this project', 'a-salah' ),
		'items_list'            => __( 'Projects list', 'a-salah' ),
		'items_list_navigation' => __( 'Projects list navigation', 'a-salah' ),
		'filter_items_list'     => __( 'Filter projects list', 'a-salah' ),
	);
	$args_portfolio = array(
		'label'                 => __( 'Project', 'a-salah' ),
		'description'           => __( 'Portfolio Projects', 'a-salah' ),
		'labels'                => $labels_portfolio,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
		'taxonomies'            => array( 'portfolio_category' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-portfolio',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
		'show_in_rest'          => true,
	);
	register_post_type( 'portfolio', $args_portfolio );

	// Services Post Type
	$labels_services = array(
		'name'                  => _x( 'Services', 'Post Type General Name', 'a-salah' ),
		'singular_name'         => _x( 'Service', 'Post Type Singular Name', 'a-salah' ),
		'menu_name'             => __( 'Services', 'a-salah' ),
		'all_items'             => __( 'All Services', 'a-salah' ),
		'add_new_item'          => __( 'Add New Service', 'a-salah' ),
		'edit_item'             => __( 'Edit Service', 'a-salah' ),
		'view_item'             => __( 'View Service', 'a-salah' ),
	);
	$args_services = array(
		'label'                 => __( 'Service', 'a-salah' ),
		'labels'                => $labels_services,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 6,
		'menu_icon'             => 'dashicons-hammer',
		'show_in_rest'          => true,
		'has_archive'           => true,
	);
	register_post_type( 'service', $args_services );

	// Testimonials Post Type
	$labels_testimonials = array(
		'name'                  => _x( 'Testimonials', 'Post Type General Name', 'a-salah' ),
		'singular_name'         => _x( 'Testimonial', 'Post Type Singular Name', 'a-salah' ),
		'menu_name'             => __( 'Testimonials', 'a-salah' ),
		'all_items'             => __( 'All Testimonials', 'a-salah' ),
		'add_new_item'          => __( 'Add New Testimonial', 'a-salah' ),
		'edit_item'             => __( 'Edit Testimonial', 'a-salah' ),
	);
	$args_testimonials = array(
		'label'                 => __( 'Testimonial', 'a-salah' ),
		'labels'                => $labels_testimonials,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
		'public'                => false,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 7,
		'menu_icon'             => 'dashicons-format-quote',
		'show_in_rest'          => true,
	);
	register_post_type( 'testimonial', $args_testimonials );

}
add_action( 'init', 'a_salah_register_post_types', 0 );

// Register Portfolio Taxonomy
function a_salah_register_taxonomies() {
	$labels = array(
		'name'              => _x( 'Portfolio Categories', 'taxonomy general name', 'a-salah' ),
		'singular_name'     => _x( 'Portfolio Category', 'taxonomy singular name', 'a-salah' ),
		'search_items'      => __( 'Search Portfolio Categories', 'a-salah' ),
		'all_items'         => __( 'All Portfolio Categories', 'a-salah' ),
		'parent_item'       => __( 'Parent Portfolio Category', 'a-salah' ),
		'parent_item_colon' => __( 'Parent Portfolio Category:', 'a-salah' ),
		'edit_item'         => __( 'Edit Portfolio Category', 'a-salah' ),
		'update_item'       => __( 'Update Portfolio Category', 'a-salah' ),
		'add_new_item'      => __( 'Add New Portfolio Category', 'a-salah' ),
		'new_item_name'     => __( 'New Portfolio Category Name', 'a-salah' ),
		'menu_name'         => __( 'Categories', 'a-salah' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'portfolio-category' ),
		'show_in_rest'      => true,
	);

	register_taxonomy( 'portfolio_category', array( 'portfolio' ), $args );
}
add_action( 'init', 'a_salah_register_taxonomies', 0 );
