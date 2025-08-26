<?php
/**
 * Template Name: Careers
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */

get_header();

// Loop
if ( have_posts() ) {
    while ( have_posts() ) {
        the_post();

        // Bulgarian Careers (ID 216) → custom fragment
        if ( is_page(216) ) {
            get_template_part('template-parts/single/content', 'bg-careers');
        } else {
            // Default Careers fragment
            get_template_part('template-parts/single/content', 'careers');
        }
    }
}

get_footer();
