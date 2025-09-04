<?php
/**
 * Template Name: Solutions
 * Description: Solutions landing page. Wrapper template, actual markup in template-parts/single/content-solutions.php
 *
 * @package TINQIN
 */

get_header();

if ( have_posts() ) :
  while ( have_posts() ) :
    the_post();
    get_template_part( 'template-parts/single/content', 'solutions' );
  endwhile;
else :
  echo '<main class="container py-4"><p>No content found.</p></main>';
endif;

get_footer();
