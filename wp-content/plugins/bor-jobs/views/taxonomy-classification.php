<?php
/**
 * Job Post Type: Taxonomy View
 *
 * @package    Project Jobs
 * @author     Cap Web Solutions
 * @copyright  2017 Matt Ryan 
 *
 */
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );

//* Remove the author box on single posts HTML5 Themes
remove_action( 'genesis_after_entry', 'genesis_do_author_box_single', 8 );

//* Force full-width-content layout setting
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

//* Remove the breadcrumbs
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

add_action( 'genesis_entry_header', 'pineland_job_taxonomy_info', 10 );
function pineland_job_taxonomy_info() {

	global $post;
	$post_id = get_the_ID( $post->ID );
	$job_descriptor = get_post_meta( $post_id, '_pineland_job_descriptor', true );
	$job_featured_img = '';
	if( has_post_thumbnail( $post_id ) ) {
		$job_featured_img = genesis_get_image( array( 'format' => 'html', 'size' => 'bor-job-image', 'attr' => array( 'class' => 'author-image' ) ) );
	}
	
	$job_content = '<div class="job-wrap">';
	$source   = get_the_term_list( get_the_ID(), 'source', '', ', ', '' );
	if ( $source ) {
		$job_content .= sprintf('<div class="job-source">' . esc_attr( strip_tags( $source ) ) . '</div>');
	}
	$job_content .= sprintf('<div class="job-descriptor">%s</div>', $job_descriptor );
	if( !empty( $job_featured_img ) ) { 
		$job_content .= sprintf('<span class="alignright job-image">%s</span>', $job_featured_img ); 
	}	
	if( !empty( $job_company ) ) { 
		$job_content .= sprintf('<p class="job-company">%s</p>', $job_company ); 
	}
	if( !empty( $job_location ) ) { 
		$job_content .= sprintf('<p class="job-location">%s</p>', $job_location ); 
	}
	$job_content .= '</div>';  // close job-wrap

	printf( '<article class="job-entry">%s</article>', $job_content  );

}

genesis();