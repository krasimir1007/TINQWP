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
						<?php while ( $wpb_all_query->have_posts() ) : $wpb_all_query->the_post(); ?>
						  <div class="col-lg-4 col-md-6 mb-1">
							<article class="team-panel">
							  <a href="<?php the_permalink(); ?>" class="stretched-link">
								<?php if ( has_post_thumbnail() ) : ?>
								  <img
									src="<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'large' ) ); ?>"
									alt="<?php the_title_attribute(); ?>"
									class="img-fluid"
									loading="lazy"
								  />
								<?php else : ?>
								  <img
									src="<?php echo esc_url( get_template_directory_uri() . '/img/placeholder-16x9.jpg' ); ?>"
									alt="<?php the_title_attribute(); ?>"
									class="img-fluid"
									loading="lazy"
								  />
								<?php endif; ?>

								<div class="card-body">
								  <h3 class="card-title"><?php the_title(); ?></h3>
								</div>
							  </a>
							</article>
						  </div>
						<?php endwhile; wp_reset_postdata(); ?>
					  </div>
					<?php endif; ?>



			</div>
		</div>
	</div>

		<?php
	}
	
}
get_footer();