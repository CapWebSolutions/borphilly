<?php
/**
 * Job Post Type: Single Post View
 *
 * @package    Project Jobs
 * @author     Cap Web Solutions
 * @copyright  2017 Matt Ryan 
 *
 */
// remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );

// * Remove the author box on single posts HTML5 Themes
// remove_action( 'genesis_after_entry', 'genesis_do_author_box_single', 8 );

// * Force full-width-content layout setting
// add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

// * Remove the breadcrumbs
// remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

add_action( 'entry_header', 'bor_job_info', 10 );
/**
 * Project Job Info Output View
 *
 * @return void
 */
function bor_job_info() {

	global $post;
	$post_id = get_the_ID( $post->ID );
	$prefix  = '_bor_job_';

	$job_title  = rwmb_get_value( $prefix . 'post_title' );
	$job_detail = rwmb_get_value( $prefix . 'post_detail' );

	$display_excerpt      = rwmb_get_value( $prefix . 'display_excerpt' );
	var_dump($job_title);
	var_dump($job_detail);

	$classification       = get_the_term_list( get_the_ID(), 'classification', '', ', ', '' );

	// $job_featured_img = '';
	// if ( has_post_thumbnail( $post_id ) ) {
	// 	$job_featured_img = genesis_get_image( array(
	// 		'format' => 'html',
	// 		'size'   => 'bor-job-image',
	// 		'attr'   => array(
	// 			'class' => 'author-image',
	// 			),
	// 		)
	// 	);
	// }

	$job_content = '<div class="job-wrap">';

	if ( ! empty( $job_featured_img ) ) {
		$job_content .= sprintf( '<span class="alignright job-image">%s</span>', $job_featured_img );
	}
	if ( $classification ) {
		$job_content .= sprintf( '<div class="job-classification">' . esc_attr( strip_tags( $classification ) ) . '</div>' );
	}
	if ( ! empty( $job_title ) ) {
		$job_content .= sprintf( '<div class="job-company">%s</div>', $job_title );
	}
	if ( ! empty( $job_detail ) ) {
		$job_content .= sprintf( '<div class="job-location">%s</div>', $job_detail );
	}
	$job_content .= '</div>';  // close job-wrap.

	printf( '<article class="job-entry">%s</article>', $job_content );

}

// genesis();
