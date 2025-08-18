<?php
// Template Name: Offers Single
global $post;
add_filter( 'body_class','my_body_classes' );
function my_body_classes( $classes ) {
    $classes[] = rwmb_meta( 'tq-solution-palette-class', $post->ID );
    return $classes;
}
get_header();

// Determine current page
if ( have_posts() ) {
	// Load posts loop.
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/single/single', 'solutions' );
	}
	
} else {
	// If no content, include the "No posts found" template.
	get_template_part( 'template-parts/content/content', 'none' );
}
get_footer();