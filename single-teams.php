<?php
// Template Name: Team Single
if (!defined('ABSPATH')) exit;

/**
 * Add team palette class to <body> safely (no $post dependency).
 */
add_filter('body_class', function(array $classes){
    $post_id = get_queried_object_id();
    if ($post_id) {
        // rwmb_meta(field, args, post_id)
        $palette = rwmb_meta('tq-team-palette-class', [], $post_id);
        if (!empty($palette) && is_string($palette)) {
            $classes[] = $palette;
        }
    }
    return $classes;
});

get_header();

// Determine current page
if (have_posts()) {
    while (have_posts()) {
        the_post();
        // Load the teams single template part
        get_template_part('template-parts/single/single', 'teams');
    }
} else {
    // If no content, include the "No posts found" template.
    get_template_part('template-parts/content/content', 'none');
}

get_footer();
