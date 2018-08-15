<?php
/**
 * Setup custom post type for jobs.
 *
 * Be sure to replace all instances of 'BOR' with your BOR's prefix (i.e. Website text domian).
 *
 * @package  Demo_CMB2
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/CapWebSolutions/bor-jobs
 */

add_action( 'init', 'cptui_register_my_cpts_job' );
/**
 * Register custom posts types for job.
 *
 * @return void.
 */
function cptui_register_my_cpts_job() {

	/**
	 * Post Type: Jobs.
	 */

	$labels = array(
		'name'                  => __( 'Jobs', 'CapWebWP/BOR' ),
		'singular_name'         => __( 'Job', 'CapWebWP/BOR' ),
		'menu_name'             => __( 'Job Posts', 'CapWebWP/BOR' ),
		'all_items'             => __( 'All Jobs', 'CapWebWP/BOR' ),
		'add_new'               => __( 'Add New Job', 'CapWebWP/BOR' ),
		'add_new_item'          => __( 'Add New Job', 'CapWebWP/BOR' ),
		'edit_item'             => __( 'Edit Job', 'CapWebWP/BOR' ),
		'new_item'              => __( 'New Job', 'CapWebWP/BOR' ),
		'view_item'             => __( 'View Job', 'CapWebWP/BOR' ),
		'view_items'            => __( 'View Jobs', 'CapWebWP/BOR' ),
		'search_items'          => __( 'Search Jobs', 'CapWebWP/BOR' ),
		'not_found'             => __( 'No Jobs Found', 'CapWebWP/BOR' ),
		'not_found_in_trash'    => __( 'No Jobs found in trash', 'CapWebWP/BOR' ),
		'featured_image'        => __( 'Featured Image', 'CapWebWP/BOR' ),
		'set_featured_image'    => __( 'Set Featured Image for this job', 'CapWebWP/BOR' ),
		'remove_featured_image' => __( 'Remove Featured Image', 'CapWebWP/BOR' ),
		'use_featured_image'    => __( 'Use as Featured Image for this job', 'CapWebWP/BOR' ),
		'archives'              => __( 'Job Archives', 'CapWebWP/BOR' ),
		'insert_into_item'      => __( 'Insert into Job', 'CapWebWP/BOR' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Job', 'CapWebWP/BOR' ),
		'filter_items_list'     => __( 'Filter Job List', 'CapWebWP/BOR' ),
		'items_list'            => __( 'Job List', 'CapWebWP/BOR' ),
		'attributes'            => __( 'Job Attributes', 'CapWebWP/BOR' ),
	);

	$args = array(
		'label'               => __( 'Jobs', 'CapWebWP/BOR' ),
		'labels'              => $labels,
		'description'         => 'Manages jobs for website',
		'public'              => true,
		'publicly_queryable'  => true,
		'show_ui'             => true,
		'show_in_rest'        => false,
		'rest_base'           => '',
		'has_archive'         => 'jobs',
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'exclude_from_search' => false,
		'capability_type'     => 'post',
		'map_meta_cap'        => true,
		'hierarchical'        => false,
		'rewrite'             => array(
			'slug'       => 'job',
			'with_front' => true,
		),
		'query_var'           => true,
		'menu_icon'           => 'dashicons-universal-access-alt',
		'supports'            => array(
			'title',
			'editor',
			'thumbnail',
			// 'revisions',
			// 'excerpt',
		),
	);

	register_post_type( 'job', $args );
}


// add_filter( 'gettext', 'BOR_job_title' );
/**
 * Replace default post title with prompt for job Featured name.
 *
 * @param [string] $input post title placeholder.
 * @return $input.
 */
function BOR_job_title( $input ) {

	global $post_type;
	if ( is_admin() && 'Enter title here' === $input && 'job' === $post_type ) {
		return 'Job Posting Title';
	}
	return $input;
}

/**
 * Flsuh rewrite rules on activation of BOR Jobs
 */
function bor_rewrite_flush() {

    cptui_register_my_cpts_job();

    flush_rewrite_rules();
}
// register_activation_hook( __FILE__, 'bor_rewrite_flush' );
