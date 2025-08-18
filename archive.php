<?php
/**
 * Template Name: Archives Page
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
	?>

  <div class="container mt-5">
    <div class="row">
      <div class="col-12">
        <div class="row">
          <div class="col-12">
            <?php if ( have_posts() ) { ?>
            <h2 class="section-title"><?php if( is_tag() ){ echo 'Етикет: '; single_term_title(); } else single_term_title(); ?></h2>
            <div class="row">
            <?php
              // Load posts loop.
              while ( have_posts() ) {
                the_post();
                ?>

                <div class="col-lg-4 col-md-6 team-panel mb-5">
                  <a href="<?php the_permalink(); ?>">
                    <img src="<?php echo get_the_post_thumbnail_url() ?>" alt="<?php the_title(); ?>" class="img-fluid" />
                  </a>
                  <a href="<?php the_permalink(); ?>" class="team-title">
                    <h3 class="mt-2"><?php the_title(); ?></h3>
                  </a>
                  <small class="post-date"><i class="fas fa-calendar-alt"></i> <?php echo get_the_date( false, $post->ID ); ?> <i class="fas fa-clock"></i> <?php echo get_the_time( false, $post->ID ); ?></small>
                  <?php the_excerpt(); ?>
                </div>

                <?php
              }
              ?>
              </div>
                  <nav class="navigation" role="navigation">
                      <div class="nav-previous"><?php next_posts_link( 'Предишни публикации' ); ?></div>
                      <div class="nav-next"><?php previous_posts_link( 'Следващи публикации' ); ?></div>
                  </nav>
              <?php
              
            } else {
              // If no content, include the "No posts found" template.
              get_template_part( 'template-parts/content/content', 'none' );
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php
get_footer();