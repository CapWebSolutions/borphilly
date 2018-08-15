<?php
add_filter( 'rwmb_meta_boxes', 'bor_meta_boxes' );
/**
 * BOR meta box registration for jobs.
 *
 * @param [type] $meta_boxes
 * @return $meta_boxes
 */
function bor_meta_boxes( $meta_boxes ) {

	$prefix       = '_bor_job_';
	$min_date = ( new \DateTime() )->format( 'Y-m-d H:i:s' );

	$meta_boxes[] = array(
		'id'           => $prefix . 'metabox',
		'title'        => __( 'Job Details:', 'bor-jobs' ),
		'post_types' => 'job',
		'style'      => 'seamless',
		'context'    => 'normal',
		'validation' => array(
			'rules'  => array(
				$prefix . 'contact_name'    => array( 'required' => true, ),
				$prefix . 'contact_email'   => array( 'required' => true, 'email' => true, ),
				$prefix . 'contact_phone'   => array( 'required' => false, 'minlength' => 10, 'phoneUS' => true, ),
				$prefix . 'expiration_date' => array( 'required' => true, 'min' => $min_date, ),
			),
			'messages' => array( $prefix . 'expiration_date' => array( 'min' => 'Expiration date must be in the future.', ),
			)
		),
		// 'query_args' => array(
		// 	'post_status' => array ( 'draft', 'publish', ),
		// 	$prefix . 'expiration_date',
		// ),
		'fields'     => array(
			array(
				'name' => __( 'Contact Name', 'bor-jobs' ),
				'id'   => $prefix . 'contact_name',
				'type' => 'text',
				'admin_columns' => 'after title',
				'desc' => __( 'This is the name of the individual to contact about this job post.', 'bor-jobs' ),
			),
			array(
				'name' => __( 'Contact Phone', 'bor-jobs' ),
				'id'   => $prefix . 'contact_phone',
				'type' => 'tel',
			),
			array(
				'name' => __( 'Contact Email', 'bor-jobs' ),
				'id'   => $prefix . 'contact_email',
				'type' => 'email',
				'admin_columns' => 'after title',
				'desc' => __( 'This is the email address of the individual to contact about this job post.', 'bor-jobs' ),
			),
			array(
				'name' => __( 'Expiration Date', 'bor-jobs' ),
				'id'   => $prefix . 'expiration_date',
				'type' => 'dateISO',
				'timestamp' => false,
				'js_options' => array(
					'dateFormat'      => 'yyyy-mm-dd',
					'showButtonPanel' => true,
				),
				'required' => true,
				'desc' => __( 'The date this job posting will expire.<br>Date Format <strong>yyyy-mm-dd</strong>', 'bor-jobs' ),
				'admin_columns' => 'after title',
			),
			// array(
			// 	'name' => esc_html__( 'Use Excerpt?', 'bor-jobs' ),
			// 	'id'   => $prefix . 'use_excerpt',
			// 	'type' => 'checkbox',
			// 	'desc' => __( 'Select to use excerpt. Leave blank to auto create excerpt from Post Detail above.', 'bor-jobs' ),

			// ),
			// array(
			// 	'name' => __( 'Job Post Excerpt', 'bor-jobs' ),
			// 	'id'   => 'post_excerpt',
			// 	'type' => 'textarea',
			// 	'desc' => __( 'Crafted excerpt of Job Post to show on <a href="/job-postings/" target="_blank">archive page</a>. Limit to 55 words. Text only. No HTML or formatting.', 'bor-jobs' ),
			// ),
		),
	);

	$field = apply_filters( 'rwmb_frontend_post_title', array(
		'type' => 'text',
		'name' => 'Title',
		'id'   => 'post_title',
	) );


	return $meta_boxes;
}
