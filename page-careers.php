<?php


 
 
 
 
get_header();

// Determine current page
if ( have_posts() ) {
	// Load posts loop.
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/single/content', 'careers' );
	}
	
}
get_footer();