<?php
/**
 * Register taxonomy(s) for testimonial CPT.
 *
 * @return void
 */
function project_register_taxonomy() {

	$args = array (
		'label' => esc_html__( 'Classifications', 'project' ),
		'labels' => array(
			'menu_name' => esc_html__( 'Classifications', 'project' ),
			'all_items' => esc_html__( 'All Classifications', 'project' ),
			'edit_item' => esc_html__( 'Edit Classification', 'project' ),
			'view_item' => esc_html__( 'View Classification', 'project' ),
			'update_item' => esc_html__( 'Update Classification', 'project' ),
			'add_new_item' => esc_html__( 'Add new Classification', 'project' ),
			'new_item_name' => esc_html__( 'New Classification', 'project' ),
			'parent_item' => esc_html__( 'Parent Classification', 'project' ),
			'parent_item_colon' => esc_html__( 'Parent Classification:', 'project' ),
			'search_items' => esc_html__( 'Search Classifications', 'project' ),
			'popular_items' => esc_html__( 'Popular Classifications', 'project' ),
			'separate_items_with_commas' => esc_html__( 'Separate Classifications with commas', 'project' ),
			'add_or_remove_items' => esc_html__( 'Add or remove Classifications', 'project' ),
			'choose_from_most_used' => esc_html__( 'Choose most used Classifications', 'project' ),
			'not_found' => esc_html__( 'No Classifications found', 'project' ),
			'name' => esc_html__( 'Classifications', 'project' ),
			'singular_name' => esc_html__( 'Classification', 'project' ),
		),
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud' => true,
		'show_in_quick_edit' => true,
		'show_admin_column' => true,
		'show_in_rest' => false,
		'hierarchical' => false,
		'query_var' => true,
		'sort' => false,
		'rewrite_no_front' => false,
		'rewrite_hierarchical' => false,
		'rewrite' => true,
	);

	register_taxonomy( 'classification', array( 'testimonial' ), $args );
}
add_action( 'init', 'project_register_taxonomy', 0 );