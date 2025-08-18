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
 * @subpackage PlanZaSofia
 * @since 1.0.0
 */

get_header();
?>
  <!-- Page Content -->
  <div class="container">

  <div class="container news mt-lg-5 mt-3 pt-5 pb-3">
    <div class="row">
      <div class="col-12">
        <div class="row">
          <div class="col-md-12 text-center">

			  <h1 class="no-cont-title">404</h1>
			  <p class="no-cont-subtitle"><?php pll_e( 'Не намираме тази страница', 'tinqin' ) ?></p>
			  <p class="section-subtitle mb-5">
				  <?php pll_e( 'Наскоро променихме сайта си. Може това, което търсиш, да се е преместило някъде другаде.', 'tinqin' ); ?>
			  </p>

          </div>
        </div>
      </div>
    </div>
  </div>
  </div>

<?php
get_footer();