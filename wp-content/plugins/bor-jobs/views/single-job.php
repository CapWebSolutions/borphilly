<?php
/**
 * Job Post Type: Single Post View
 *
 * @package    Project Jobs
 * @author     Cap Web Solutions
 * @copyright  2017 Matt Ryan 
 *
 */

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
	$classification       = get_the_term_list( get_the_ID(), 'classification', '', ', ', '' );

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

