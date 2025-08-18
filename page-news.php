<?php
/**
 * Template Name: News
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */
get_header();

// Determine current page
if ( have_posts() ) {
	// Load posts loop.
	while ( have_posts() ) {
		the_post();
		?>

	<div class="container mt-5 pt-5 mb-5">
		<div class="row">
			<div class="col-12">
				<h2 class="section-title"><?php the_title(); ?></h2>
				<p class="section-subtitle"><?php pll_e( 'Компанията ни се развива', 'tinqin' ); ?></p>
				<?php the_content(); ?>

					<?php 

					$wpb_all_query = new WP_Query([
					  'post_type'           => 'post',
					  'post_status'         => 'publish',
					  'posts_per_page'      => -1,               // or set e.g. 12 and use pagination
					  'ignore_sticky_posts' => true,
					  'category__in'        => [1, 8, 12],  	 // your include list
					  'suppress_filters'    => false             // let Polylang filter by language
					]);
					?>
				 
				<?php if ( $wpb_all_query->have_posts() ) : ?>
				 
				<div class="row">
				 
				    <!-- the loop -->
				    <?php $i=1; $delay = 200; while ( $wpb_all_query->have_posts() ) : $wpb_all_query->the_post(); ?>
					      <div class="col-lg-4 col-md-6 team-panel mb-4" <?php if($i>3){ ?> data-aos="fade-up" data-aos-duration='1000' data-aos-delay='<?php echo $delay; ?>'<?php } ?>>
							 <div class="card-news">
								 
					        <a href="<?php the_permalink(); ?>">
								 <div  style="height:190px; overflow:hidden;">
								   <img src="<?php echo get_the_post_thumbnail_url( $post->ID ) ?>" alt="<?php the_title(); ?>" class="img-fluid" />
							  </div>
					         <div class="card-body">
								<small class="post-date mt-1 "><i class="fas fa-calendar-alt"></i> <?php echo get_the_date( false, $post->ID ); ?></small>
								<h3 class="mt-2 mb-2 card-title"><?php the_title(); ?></h3>
							 </div>
					        </a>


					      </div>
				 
				    <!-- end of the loop -->
				 
							  </div>
					   <?php $delay += 20; $i++; endwhile; ?>
				</div>
				<?php wp_reset_postdata(); ?>
				 
				<?php else : ?>
				    <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
				<?php endif; ?>

			</div>
		</div>
	</div>

		<?php
	}
	
}
get_footer();