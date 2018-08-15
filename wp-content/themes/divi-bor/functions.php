<?php
/**
 * This will hide the Divi "Project" post type.
 * Thanks to georgiee (https://gist.github.com/EngageWP/062edef103469b1177bc#gistcomment-1801080) for his improved solution.
 *
 */

add_filter( 'et_project_posttype_args', 'mytheme_et_project_posttype_args', 10, 1 );
function mytheme_et_project_posttype_args( $args ) {
	return array_merge( $args, array(
		'public'              => false,
		'exclude_from_search' => false,
		'publicly_queryable'  => false,
		'show_in_nav_menus'   => false,
		'show_ui'             => false
	));
}

// Redirect front end form submission to another page. 
add_action( 'rwmb_frontend_after_process', function( $config, $post_id ) {
    if ( '_bor_job_metabox' === $config['id'] ) {
        wp_mail( 'admin@borphilly.org', 'New submission', 'A new post has been just submitted.' );
        wp_safe_redirect( 'thank-you' );
        die;
    }
}, 10, 2 );

// Enable the confirmation anchor on all forms. Causes top of form to be displayed on error.
add_filter( 'gform_confirmation_anchor', '__return_true' );