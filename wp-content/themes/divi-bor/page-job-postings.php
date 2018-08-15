<?php
/*
Template Name: Job Posts
*/

get_header();

//Identify today's date for fresh job listings. 
$min_date = ( new \DateTime() )->format( 'Y-m-d H:i:s' );
$prefix = '_bor_job_';

?>
<div id="main-content">
	<div class="container">
		<div id="content-area" class="clearfix">
			<div id="left-area">
<?php 

// Set up custom query for non-expired job posts
$args = array(
	'post_type'        => 'job',
	'post_status'      => 'publish',
	'orderby'          => 'post_date',
	'order'            => 'DESC',
	'meta_key'         => $prefix . 'expiration_date',
	'meta_query'       => array( 
		array(
			'key'     => $prefix . 'expiration_date', 
			'value'   => $min_date,
			'compare' => '>=',
			'type'    => 'DATE',
		),
	),
);

$query = new WP_Query( $args );

			if ( $query->have_posts() ) 

			while ( $query->have_posts() ) { 

				$query->the_post();
?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<h2 class="main_title"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h2>

				<?php
					$thumb = '';

					$width = (int) apply_filters( 'et_pb_index_blog_image_width', 1080 );

					$height = (int) apply_filters( 'et_pb_index_blog_image_height', 675 );
					$classtext = 'et_featured_image';
					$titletext = get_the_title();
					$thumbnail = get_thumbnail( $width, $height, $classtext, $titletext, $titletext, false, 'Blogimage' );
					$thumb = $thumbnail["thumb"];

					if ( 'on' === et_get_option( 'divi_page_thumbnails', 'false' ) && '' !== $thumb )
						print_thumbnail( $thumb, $thumbnail["use_timthumb"], $titletext, $width, $height );
				?>

					<div class="entry-content">
					<?php
						the_excerpt();

						echo '<p class="job-contact"><strong>Contact:</strong> ' . rwmb_meta( $prefix . 'contact_name' );
						echo '<strong>&nbsp;&mdash;</strong> ' . rwmb_meta( $prefix . 'contact_email' ) . '<br></p>';

						wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'Divi' ), 'after' => '</div>' ) );
					?>
					</div> <!-- .entry-content -->

				</article> <!-- .et_pb_post -->

			<?php } ?>

			<?php wp_reset_postdata(); ?>


			</div> <!-- #left-area -->

			<?php get_sidebar(); ?>
		</div> <!-- #content-area -->
	</div> <!-- .container -->


</div> <!-- #main-content -->

<?php get_footer(); ?>