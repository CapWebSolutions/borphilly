<?php
/**
 * Adds new image sizes.
 *
 * @since 1.0.0
 *
 * @return void
 */
function adds_new_jobs_image_sizes() {
	$config = array(
		'bor-job-image' => array(
			'width'  => 200,
			'height' => 200,
			'crop'   => true,
		),
	);

	foreach ( $config as $name => $args ) {
		$crop = array_key_exists( 'crop', $args ) ? $args['crop'] : false;

		add_image_size( $name, $args['width'], $args['height'], $crop );
	}
}

/**
 * Project Job Post Type
 *
 * @package    Simple_Listing_Post_Type
 * @author     Robin Cornett <hello@robincornett.com>
 * @copyright  2017 Matt Ryan
 *
 */


 /**
 * Load Job archive template.
 * @param  template $archive_template requires Genesis
 *
 * @since  1.2.0
 */
function load_archive_template( $archive_template ) {
	if ( is_post_type_archive( 'job' ) || is_tax( 'classification' ) ) {
		$archive_template = dirname( __FILE__ ) . '/views/single-job.php';
	}

	return $archive_template;

}

 /**
 * Load Job archive template.
 * @param  template $archive_template requires Genesis
 *
 * @since  1.2.0
 */
function load_taxonomy_archive_template( $taxonomy_archive_template ) {
	if ( is_post_type_archive( 'job' ) && is_archive( 'classification', array( 'clients', 'colleagues', 'professionals' ) ) ) {
		$taxonomy_archive_template = dirname( __FILE__ ) . '/views/single-job.php';
	}

	return $taxonomy_archive_template;

}

/**
 * Load single Job template.
 * 
 * @param  template $single_template requires Genesis
 * @since 1.2.0
 */
function load_single_template( $single_template ) {
	if ( is_singular( 'job' ) ) {
		$single_template = dirname( __FILE__ ) . '/views/single-job.php';
	}
	return $single_template;

}
