<?php
/**
 * Summary. BOR Jobs Main.
 *
 * Description: Adds the Job post type for the theme.
 *
 * Plugin Name: BOR Jobs
 *
 * @link    https://github.com/CapWebSolutions/bor-jobs.git/
 * Author: Cap Web Solutions
 * Version: 1.0.0
 * Author URI: https://capwebsolutions.com/
 *
 * @package Project Jobs
 * @license GPL-2.0+
 */

// * Get all the things.
require_once dirname( __FILE__ ) . '/bor-jobs-example.php';
require_once dirname( __FILE__ ) . '/post-types.php';
require_once dirname( __FILE__ ) . '/meta-boxes.php';  // meta box sample.
require_once dirname( __FILE__ ) . '/taxonomies.php';
require_once dirname( __FILE__ ) . '/helper-functions.php';

add_action( 'wp_enqueue_scripts', 'load_jobs_style_sheet' );
/**
 * Load custom style sheet for bor-jobs
 *
 * @return void
 */
function load_jobs_style_sheet() {
	wp_enqueue_style( 'jobs-stylesheet', plugin_dir_url( __FILE__ ) . 'assets/css/bor-jobs.css', array(), '1.0.0' );
}

// add_action( 'plugins_loaded', 'pineland_jobs_init' );
/**
 * Load Translations.
 *
 * @return void
 */
function bor_jobs_init() {
	load_plugin_textdomain( 'bor-jobs', false, 'bor-jobs/languages' );
}

// * Setup new image sizes.
adds_new_jobs_image_sizes();

// * Set up templates for new post type.
// add_filter( 'archive_template', 'load_archive_template' );
// add_filter( 'archive_template', 'load_taxonomy_archive_template', 11 );
// add_filter( 'single_template', 'load_single_template' );

add_action( 'rwmb_frontend_after_process', function( $config, $post_id ) {
    if ( '_bor_job_metabox' !== $config['id'] ) {
        return;
    }
    $email = rwmb_meta( '_bor_job_contact_email', '', $post_id );
    $name = rwmb_meta( '_bor_job_contact_name', '', $post_id );
    $subject = rwmb_meta( '_bor_job_post_title', '', $post_id );
    $message = rwmb_meta( '_bor_job_post_detail', '', $post_id );
    $body = "<p>Name: $name</p>
        <p>Email: $email</p>
        <p>Subject: $subject</p>
        <p>Message: $message</p>";

    $headers = ['Content-type: text/html', "Reply-To: $email"];
	wp_mail( 'info@capwebsolutionms.com', 'New Job Posting ready for review', $body );
	wp_safe_redirect( 'thank-you-for-your-submission' );
	die;
}, 10, 2 );


// this code will run for form 2 only To verify expiration date is in the future.
add_filter('gform_validation_2', 'verify_expiration_date');
function verify_expiration_date( $validation_result ) {

    // retrieve the $form
    $form = $validation_result['form'];

    // Expiration date is submitted in field 2 in the format MM-DD-YY.
    // change the 5 here to your field ID.
	$expire_date = rgpost('input_9');
 
	// is expire date less than midnight today?
    if( strtotime( $expire_date ) <= strtotime( date( 'm/d/Y 23:59:59' ) ) ) {
 
        // set the form validation to false 
        $validation_result['is_valid'] = false;
 
        // find field with ID of 2 and mark it as failed validation
        foreach($form['fields'] as &$field){
 
            if($field['id'] == '9'){
                $field['failed_validation'] = true;
                $field['validation_message'] = 'Expiration date must be in the future.';
                break;
            }
 
        }
 
    }
    // assign modified $form object back to the validation result
    $validation_result['form'] = $form;
    return $validation_result;
}
