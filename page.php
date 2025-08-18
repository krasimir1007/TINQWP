<?php
/**
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

<div class="container mt-5">
  <div class="row">
    <div class="col-12 mb-5">
      <h2 class="section-title mt-3 mb-3"><?php the_title(); ?></h2>
      <?php the_content(); ?>
    </div>
  </div>
</div>

		<?php
	}
	
} else {
	// If no content, include the "No posts found" template.
	get_template_part( 'template-parts/content/content', 'none' );
}
get_footer();