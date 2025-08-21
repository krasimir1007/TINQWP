<?php
/**
 * Template Name: About
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

<div class=" naming-container mt-3 mt-lg-5">
	
	<img src="<?php echo get_template_directory_uri(); ?>/images/aboutus-background.png"  class="naming-container-background" />
	<div class="container pt-5 pb-5 pt-lg-5 pb-lg-5">
		<div class="naming-content pt-3 pb-3 pt-lg-5 pb-lg-5">
			<div class="row mb-4">
				<div class="col-lg-6 col-md-6 col-sm-12 text-right naming-right">
					<img class="naming-logo mb-lg-2" src="<?php echo get_template_directory_uri(); ?>/images/logo-blue.svg" class="img-fluid" />
					<h4 class="text-blue">Technology Expertise</h4>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-12 naming-left">
					<img class="naming-logo mb-lg-2 " src="<?php echo get_template_directory_uri(); ?>/images/logo-orange.svg" class="img-fluid" />
					<h4 class="text-orange">Industry Knowledge</h4>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-12 text-right naming-right">
					<img class="naming-logo mb-lg-2" src="<?php echo get_template_directory_uri(); ?>/images/logo-green.svg" class="img-fluid" />
					<h4 class="text-green">Quality Focus</h4>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-12 naming-left">
					<img class="naming-logo mb-lg-2 " src="<?php echo get_template_directory_uri(); ?>/images/logo-red.svg" class="img-fluid" />
					<h4 class="text-red">Innovation Spirit</h4>
				</div>
			</div>
		</div>
	</div>
<!-- Clients -->
  <div class="container mt-lg-5 mb-lg-5 mt-3 mb-3" data-aos="fade-up" data-aos-duration='1000' data-aos-delay='200'>
	<section class="home-hero-logos">
	  <div class="container" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
		<section class="customer-logos slider">
		  <?php
		  $logos = get_posts(array(
			'post_type'   => 'testimonials',
			'numberposts' => -1
		  ));
		  if ($logos) {
			foreach ($logos as $logo) {
			  ?>
			  <div class="slide">
				<img src="<?php echo esc_url( get_the_post_thumbnail_url($logo->ID) ); ?>"
					 alt="<?php echo esc_attr( $logo->post_title ); ?>">
			  </div>
			  <?php
			}
		  }
		  ?>
		</section>
	  </div>
	</section>
  </div>


  

</div>
<div class="container mt-5 pt-3 pt-lg-5 mt-lg-5">
	<div class="row">
		<div class="col-12">
			<h2 class="section-title"><?php pll_e( 'Защо да избереш TINQIN', 'tinqin' ); ?></h2>
			<?php the_content(); ?>
		</div>
	</div>
</div>


<div id="carouselExampleIndicators" class="carousel slide mt-3 pt-lg-3 pb-lg-3 mt-lg-4" data-ride="carousel">
	<div class="carousel-inner">
	  <div class="carousel-item active">
	    <img src="<?php echo get_template_directory_uri(); ?>/images/office-01.jpg" class="img-fluid" />
	  </div>
	  <div class="carousel-item">
	    <img src="<?php echo get_template_directory_uri(); ?>/images/office-01a.jpg" class="img-fluid" />
	  </div>
	  <div class="carousel-item">
	    <img src="<?php echo get_template_directory_uri(); ?>/images/office-01e.jpg" class="img-fluid" />
	  </div>
	</div>
</div>

  <div class="container mt-lg-5 mt-5">

	<div class="row">
      <div class="col-12 mb-3" data-aos="fade-up" data-aos-duration='1000' data-aos-delay='200'>
     	<h2 class="section-title"><?php pll_e( 'Tinqin екип', 'tinqin' ) ?></h2>
		<p class="section-subtitle"><?php pll_e( 'Запознай се с екипа ни', 'tinqin' ); ?></p>
      </div>
    </div>
	  
    <div class="row spacing-bottom-s">
      <?php

        // Display all temas in this term
        $teams = get_posts(array(
          'post_type' => 'teams',
          'numberposts' => -1
        ));
        if( $teams ){
		  $delay = 350;
          foreach( $teams as $team ){
            ?>

      <div class="col-lg-3 col-md-6 mb-4  d-flex align-items-lg-stretch align-items-md-stretch" data-aos="fade-up" data-aos-duration='1000' data-aos-delay='<?php echo $delay; ?>'>
		        <a href="<?php echo get_permalink( $team->ID ); ?>" class="card list-item card-teams <?php echo rwmb_meta( 'tq-team-card-class',  '', $team->ID ); ?> <?php echo rwmb_meta( 'tq-team-gradient-class',  '', $team->ID ); ?>">
	        <div class="card-body" style="background-image: url('<?php echo get_the_post_thumbnail_url( $team->ID ) ?>') !important">
			<div class="card-body-content">
				<div class="card-image pb-2"> </div>
				<h3 class="card-title fat-title mb-3"><?php echo $team->post_title; ?></h3>
				<p class="card-text"><?php echo $team->post_excerpt; ?></p>
			</div>
        </div>
					
      </a>
		  
		  
      </div>

            <?php
			  $delay = $delay + 150;
          }
        }

      ?>
    </div>
  </div>

<div class="container mb-4 pt-3 mt-lg-5 pt-lg-5">
	<div class="row">
		<div class="col-12"  data-aos="fade-up" data-aos-duration='1000' data-aos-delay='200'>
			<h2 class="section-title mb-3"><?php pll_e( 'Няколко думи от нашите основатели', 'tinqin' ) ?></h2>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12" data-aos="fade-up" data-aos-duration='1000' data-aos-delay='350'>
			<?php

			// Get statement
			$statement = get_post( pll_get_post( 65 ) );
			$title = $statement->post_title;
			$content = $statement->post_content;

			?>
			<img src="<?php echo get_template_directory_uri(); ?>/images/Francois-and-Jean-Charles-Miginiac.jpg" max-width='1000px' width="100%" class="img-fluid" />
			<h4 class="fat-title mt-4"><?php echo $title; ?></h4>
			<?php echo apply_filters('the_content', $content); ?>
		</div>
		<!--<div class="col-lg-12 col-md-12 mb-4" data-aos="fade-up" data-aos-duration='1000' data-aos-delay='500'>
			<img src="<?php echo get_template_directory_uri(); ?>/images/Francois-and-Jean-Charles-Miginiac.jpg" width="100%" class="img-fluid" />		
		</div>-->
	</div>
</div>
		<?php

	}
	
}
get_footer();

 
  <!-- Bootstrap core JavaScript -->
  <script src="<?php echo get_stylesheet_directory_uri(); ?>/vendor/jquery/jquery.slim.min.js"></script>

  <script src="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.js"></script>
  <script type="text/javascript">
    $('.hamburger').click(function(){
      $(this).toggleClass('is-active');
    });
    $( document ).ready(function() {
        $('#navbarResponsive .nav-link').each(function(){
          var label = $(this).text();
          $(this).attr('data-hover', label);
        })
    });
	$(window).on('load', function () {
	  AOS.refresh();
	});
	$(function () {
	  AOS.init();
	});
    $(document).ready(function(){
      $('.customer-logos').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 1000,
        arrows: false,
        dots: false,
        pauseOnHover: false,
        responsive: [{
          breakpoint: 768,
          settings: {
            slidesToShow: 4
          }
        }, {
          breakpoint: 768,
          settings: {
            slidesToShow: 2
          }
        }]
      });
    });
    $(document).ready(function(){
      $('.perks-slider').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 1000,
        arrows: false,
        dots: false,
        pauseOnHover: true,
        responsive: [{
          breakpoint: 768,
          settings: {
            slidesToShow: 4
          }
        }, {
          breakpoint: 768,
          settings: {
            slidesToShow: 2
          }
        }]
      });
    });

    $(window).on("load",function() {
      $(window).scroll(function() {
        var windowBottom = $(this).scrollTop() + $(this).innerHeight();
        $(".load-anim").each(function() {
          /* Check the location of each desired element */
          var objectBottom = $(this).offset().top + $(this).outerHeight();
          
          /* If the element is completely within bounds of the window, fade it in */
          if (objectBottom < windowBottom) { //object comes into view (scrolling down)
            if ($(this).css("opacity")==0) {$(this).fadeTo(500,1);}
          } else { //object goes out of view (scrolling up)
            if ($(this).css("opacity")==1) {$(this).fadeTo(500,0);}
          }
        });
      }).scroll(); //invoke scroll-handler on page-load
    });
	  
    $(document).ready(function(){
		$('#sofia-office').text( $('#sofia-office-source').text() );
		$('#paris-office').text( $('#paris-office-source').text() );
		$('#varna-office').text( $('#varna-office-source').text() );
		
		$('#sofia-address').text( $('#sofia-address-source').text() );
		$('#paris-address').text( $('#paris-address-source').text() );
		$('#varna-address').text( $('#varna-address-source').text() );
		
		$('#sofia-phone').text( $('#sofia-phone-source').text() );
		$('#paris-phone').text( $('#paris-phone-source').text() );
		$('#varna-phone').text( $('#varna-phone-source').text() );
		
		$('#sofia-mail').text( $('#sofia-mail-source').text() ).attr( 'href', 'mailto:' + $('#sofia-mail-source').text() );
		$('#paris-mail').text( $('#paris-mail-source').text() ).attr( 'href', 'mailto:' + $('#paris-mail-source').text() );
		$('#varna-mail').text( $('#varna-mail-source').text() ).attr( 'href', 'mailto:' + $('#varna-mail-source').text() );
    });
	  
	  $('#sender-cv').change(function(){
		  var filename = $(this).val().replace(/C:\\fakepath\\/i, '');
		 $('.custom-file-label').text(filename);
	  });

	  $("#form-location").change(function(){
		 var value = $(this).val();
		  if( value == 'sofia' || value == 'varna' ){
			  $('.show-on-bg').show();
		  }
		  else{
			  $('.show-on-bg').hide();
		  }
	  });
	  
  </script>

	<script>
		AOS.init({
			once: true,
			disable: 'mobile'
		}); 
	</script>
  <?php wp_footer(); ?>