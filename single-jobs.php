<?php
// Template Name: Job Single
global $post;
add_filter( 'body_class','my_body_classes' );
function my_body_classes( $classes ) {
    $classes[] = rwmb_meta( 'tq-team-palette-class', '', rwmb_meta( 'tq-jobs-team', $post->ID ) );
    return $classes;
}
get_header();

// Determine current page
if ( have_posts() ) {
	// Load posts loop.
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/single/single', 'jobs' );
	}
	
} else {
	// If no content, include the "No posts found" template.
	get_template_part( 'template-parts/content/content', 'none' );
}
get_footer();