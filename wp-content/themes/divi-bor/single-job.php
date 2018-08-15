<?php

get_header();

$is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() );


//Identify today's date for fresh job listings. 
$min_date = ( new \DateTime() )->format( 'Y-m-d H:i:s' );

// $show_navigation = get_post_meta( get_the_ID(), '_et_pb_project_nav', true );
$show_default_title = get_post_meta( get_the_ID(), '_et_pb_show_title', true );
?>

<div id="main-content">

<?php if ( ! $is_page_builder_used ) : ?>

	<div class="container">
		<div id="content-area" class="clearfix">
			<div id="left-area">

<?php endif; ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<?php if ( ! $is_page_builder_used ) : ?>

					<div class="et_main_title">
						<h1 class="entry-title"><?php the_title(); ?></h1>
						<span class="et_project_categories"><?php echo get_the_term_list( get_the_ID(), 'project_category', '', ', ' ); ?></span>
					</div>

				<?php
					$thumb = '';

					$width = (int) apply_filters( 'et_pb_portfolio_single_image_width', 1080 );
					$height = (int) apply_filters( 'et_pb_portfolio_single_image_height', 9999 );
					$classtext = 'et_featured_image';
					$titletext = get_the_title();
					// $thumbnail = get_thumbnail( $width, $height, $classtext, $titletext, $titletext, false, 'Projectimage' );
					$thumbnail = get_thumbnail( $width, $height, $classtext, $titletext, $titletext, false, 'Blogimage' );
					$thumb = $thumbnail["thumb"];

					$page_layout = get_post_meta( get_the_ID(), '_et_pb_page_layout', true );

					if ( '' !== $thumb )
						print_thumbnail( $thumb, $thumbnail["use_timthumb"], $titletext, $width, $height );
				?>

				<?php endif; ?>

					<div class="entry-content">
					<?php
						echo '<strong>Details</strong>';
						the_content();
						$prefix = '_bor_job_';
						echo '<p class="job-contact"><strong>Contact Name:</strong> ' . rwmb_meta( $prefix . 'contact_name' ) . '<br>';
						
						$phone_given = rwmb_meta( $prefix . 'contact_phone' );
						if ( $phone_given ) echo '<strong>Contact Phone:</strong> ' . $phone_given . '<br>';
						
						echo '<strong>Contact Email:</strong> ' . rwmb_meta( $prefix . 'contact_email' ) . '<br></p>';
						
						$job_expires = rwmb_meta( $prefix . 'expiration_date' );
						if ( $job_expires < $min_date ) {
							echo '<p class="job-expired"><strong>Posting Expired:</strong> ' . $job_expires . '<br></p>';
						} else {
							echo '<p class="job-expires"><strong>Posting Expires:</strong> ' . $job_expires . '<br></p>';
						}

						if ( ! $is_page_builder_used )
							wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'Divi' ), 'after' => '</div>' ) );
					?>
					</div> <!-- .entry-content -->

				<?php if ( ! $is_page_builder_used || ( $is_page_builder_used && 'on' === $show_navigation ) ) : ?>

					<div class="nav-single clearfix">
						<span class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . et_get_safe_localization( _x( '&larr;', 'Previous post link', 'Divi' ) ) . '</span> %title' ); ?></span>
						<span class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . et_get_safe_localization( _x( '&rarr;', 'Next post link', 'Divi' ) ) . '</span>' ); ?></span>
					</div><!-- .nav-single -->

				<?php endif; ?>

				</article> <!-- .et_pb_post -->

			<?php endwhile; ?>

<?php if ( ! $is_page_builder_used ) : ?>

			</div> <!-- #left-area -->

			<?php if ( 'et_full_width_page' === $page_layout ) et_pb_portfolio_meta_box(); ?>

			<?php get_sidebar(); ?>
		</div> <!-- #content-area -->
	</div> <!-- .container -->

<?php endif; ?>

</div> <!-- #main-content -->

<?php get_footer(); ?>