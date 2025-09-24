<?php
/**
 * Template Name: Solutions
 * Description: Solutions landing page. Wrapper template, actual markup in template-parts/single/content-solutions.php
 *
 * @package TINQIN
 */

get_header();

if ( have_posts() ) :
  while ( have_posts() ) : the_post();

    // === Hard-coded page IDs ===
    $PAGE_FR = 4585;   // French Solutions page ID
    $PAGE_BG = 4647;   // Bulgarian Solutions page ID
    // ===========================

    $pid = (int) get_the_ID();

    if ( $pid === $PAGE_FR ) {
      // French fragment
      get_template_part( 'template-parts/single/content', 'solutions-fr' );

    } elseif ( $pid === $PAGE_BG ) {
      // Bulgarian fragment
      get_template_part( 'template-parts/single/content', 'solutions-bg' );

    } else {
      // Default (EN) fragment
      get_template_part( 'template-parts/single/content', 'solutions' );
    }

  endwhile;

else :
  echo '<main class="container py-4"><p>No content found.</p></main>';

endif;

get_footer();
