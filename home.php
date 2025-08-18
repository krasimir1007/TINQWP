<?php
// Template Name: Home
$lang = pll_current_language();
get_header();

?>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "SoftwareOrganization",
  "name": "TINQIN",
  "url": "https://www.tinqin.com",
  "logo": "https://www.tinqin.com/wp-content/themes/tinqin/images/logo.svg",
  "foundingDate": "2013",
  "description": "TINQIN develops custom software solutions for the insurance and finance industries across Europe.",
  "founders": [
    {
      "@type": "Person",
      "name": "Jean-Charles Miginiac"
    },
    {
      "@type": "Person",
      "name": "François Miginiac"
    }
  ],
"location": [
  {
    "@type": "Place",
    "name": "TINQIN Sofia",
    "address": {
      "@type": "PostalAddress",
      "streetAddress": "Megapark115G Tsarigradsko shose Blvd, , fl. 5",
      "addressLocality": "Sofia",
      "postalCode": "1784",
      "addressCountry": "BG"
    },
    "telephone": "+359 2 8056898"
  },
  {
    "@type": "Place",
    "name": "TINQIN Paris",
    "address": {
      "@type": "PostalAddress",
      "streetAddress": "15 – 17 rue Scribe",
      "addressLocality": "Paris",
      "postalCode": "75009",
      "addressCountry": "FR"
    },
    "telephone": "+33 1 85730282"
  }
],
  "numberOfEmployees": "520",
  "email": "engage@tinqin.com",
  "telephone": "+359 2 805 68 98",
  "sameAs": [
    "https://www.linkedin.com/company/tinqin",
    "https://www.facebook.com/tinqin.solutions" 
  ]
}
</script>
<div class="container mt-lg-5 mb-3 pt-lg-5 mt-3 pt-5">
  <div class="row">
    <div class="col-md-12">
           <!-- <h2 class="section-title"><?php the_title(); ?></h2> -->
     <?php the_content(); ?> 
    </div>
  </div>
<!-- Clients -->
  <div class="container mt-lg-5 mb-lg-5 mt-3 mb-3" data-aos="fade-up" data-aos-duration='1000' data-aos-delay='200'>
    <section class="customer-logos slider">
      <?php

        $logos = get_posts( array(
            'post_type'     => 'testimonials',
            'numberposts'   => -1
        ) );
        if( $logos )
          foreach ($logos as $logo) {

            $file = rwmb_meta( 'tq-client-slider', '', $logo->ID );

            ?>
      <div class="slide"><img src="<?php echo get_the_post_thumbnail_url( $logo->ID ) ?>" alt="<?php echo $logo->post_title; ?>"></div>
            <?php
          }

      ?>
    </section>
  </div>


  
  <!-- TINQIN Blog -->
          <?php

            $news = get_posts(
              array(
                'post_type'     => 'post',
                'numberposts'   => 6,
				  'ignore_sticky_posts' => true,
				  'category__in'        => [1, 8, 12],
				  'suppress_filters'    => false // keeps Polylang filters working
              )
            );
            if( $news ){
              ?>

  <div class="container" data-aos="fade-up" data-aos-duration='1000' data-aos-delay='200'>
    <div class="row">
      <div class="col-8 mb-lg-4 mb-md-3">
        <h2 class="section-title"><a href="<?php echo get_permalink( pll_get_post( 94 ) ); ?>"><?php echo function_exists('pll__') ? pll__('Latest from TINQIN') : 'Latest from TINQIN'; ?></a></h2>

      </div>
      <div class="col-4 text-right">
        <a href="<?php echo get_permalink( pll_get_post( 94 ) ); ?>"><?php pll_e( '>>', 'tinqin' ) ?></a>
      </div>
    </div>
    <div class="row">

              <?php
		      $delay = 50;
              foreach( $news as $position ){
				
                ?>

      <div class="col-lg-4 col-md-6 team-panel mb-lg-5 mb-4"  data-aos="fade-up" data-aos-duration='1000' data-aos-delay='<?php echo $delay; ?>'>
        <a href="<?php echo get_permalink( $position->ID ); ?>">
			<div style="">
          <img src="<?php echo get_the_post_thumbnail_url( $position->ID ) ?>" alt="<?php echo $position->post_title; ?>" class="img-fluid" />
			</div>
        </a>
        <a href="<?php echo get_permalink( $position->ID ); ?>" class="team-title ">
          <h3 class="font-weight-500"><?php echo $position->post_title; ?></h3>
        </a>
      </div>
                <?php
				$delay += 150;
              }
              ?>
    </div>
  </div>  

            <?php
        }
            ?>



  <!-- Quality primer -->
  <div class="accent-box tq-benefits--dark pt-5 pb-5 mt-lg-5 mt-md-3" id='parent-offer'>
    <div class="container">
      <div class="row">
        <div class="col-lg-12 mb-5 mt-4 text-center" data-aos="fade-up" data-aos-duration='1000' data-aos-delay='200'>
          <h2><?php pll_e( 'Можеш да разчиташ на TINQIN. Ето защо...' ) ?></h2>
        </div>
      </div>
      <div class="row mt-3 mb-3">
        <div class="col-md-4 text-center"  data-aos="fade-up" data-aos-duration='1000' data-aos-delay='350'>
			<div class="d-flex justify-content-center align-items-center" style="height:100px;">
				          <img src="<?php echo get_template_directory_uri(); ?>/images/tinqin-consultants.svg"  /  style="height:100%;">
			</div>

          <h5 class="mt-4"><?php pll_e( 'Познаваме клиентите ти, познаваме бизнеса ти! Нашите консултантите са на твое разположение!' ) ?></h5>
        </div>
        <div class="col-md-4 pt-3-small text-center "  data-aos="fade-up" data-aos-duration='1000' data-aos-delay='500'>
			<div class="d-flex justify-content-center align-items-center" style="height:100px;">
				          <img src="<?php echo get_template_directory_uri(); ?>/images/tinqin-technology.svg" /  style="height:100%;">
			</div>

          <h5 class="mt-4"><?php pll_e( 'Използваме последните и най-добри технологии, не следваме модите - създаваме ги!' ) ?></h5>
        </div>
        <div class="col-md-4 pt-3-small text-center"  data-aos="fade-up" data-aos-duration='1000' data-aos-delay='650'>
			<div class="d-flex justify-content-center align-items-center" style="height:100px;">
				          <img src="<?php echo get_template_directory_uri(); ?>/images/tinqin-quality.svg" / style="height:90%;">
			</div>

          <h5 class="mt-4"><?php pll_e( 'Фокусирани сме върху качеството и доброто изживяване за крайния потребител! Клиентите и служителите ти до заслужават!' ) ?></h5>
        </div>
      </div>
    </div>
  </div>    




  <!-- TINQIN Team primer -->
  <div class="container mb-lg-5 mb-sm-3">
    <div class="row">
      <div class="col-12 mb-5 mt-5 pt-4 pt-3-small" data-aos="fade-up" data-aos-duration='1000' data-aos-delay='200'>
        <h2 class="section-title"><?php pll_e( 'Как постигаме целите си' ) ?></h2>
        <p class="section-subtitle"><?php pll_e( 'В TINQIN вярваме, че всичко е постижимо. Ето защо изградихме екип от млади, мотивирани, талантливи и иновативни експерти.' ) ?></p>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12 text-center" id='parent-team'>
		<?php $rand = rand(1, 2); ?>
        <img data-aos="fade-up" data-aos-duration='1000' data-aos-delay='350' src="<?php echo get_template_directory_uri(); ?>/images/meet-the-team-1.jpg" class="img-fluid" />
		<div class="col" data-aos="fade-up" data-aos-duration='1000' data-aos-delay='350' data-aos-anchor='#parent-team' data-aos-once="true">
			<a href="<?php echo get_permalink( pll_get_post( 35 ) ); ?>" class="mt-5 mb-5 btn btn-primary btn-lg"><?php pll_e( 'Запознай се с екипа' ) ?></a>
		</div>
      </div>
    </div>
  </div>
  

  <?php

    $testimonials = get_posts( array(
        'post_type'       => 'testimonials',
        'numberposts'     => 6,
        'orderby'         => 'rand',
        'meta_query' => array(
            array(
                'key' => 'tq-client-testimonial',
                'value' => 1,
                'compare' => '=',
                'type' => 'NUMERIC',
            ),
        ),
    ) );

    if( $testimonials ){

      ?>


  <!-- Client random post -->
  <div class="client-box tq-benefits--dark pt-5 pb-5" data-aos="fade-up" data-aos-duration='1000' data-aos-delay='200'>	  
	  <div id="testimonialCarousel" class="carousel slide" data-ride="carousel" data-interval="false">
		  <div class="carousel-inner"> 
			  <?php $i = 0; foreach ( $testimonials as $testimonal ) { ?>
			  <div class="carousel-item pb-5 <?php if( $i == 0 ) echo 'active'; ?>" style="position: relative;">
				  <div class="container">
					  <div class="row d-flex justify-content-center">
						  <div class="col-lg-7 col-md-12">
							  <h2 class="mb-3 white"><?php pll_e( 'Стани един от доволните ни клиенти!' ) ?></h2>
							  <?php echo $testimonal->post_content; ?>
						  </div>
						  <div class="col-lg-3 col-md-12 text-right" data-aos="fade-up" data-aos-duration='1000' data-aos-delay='350' data-aos-anchor='#parent1'>
							  <img src="<?php echo get_template_directory_uri(); ?>/images/icon-speech-bubble.svg"  /  style="max-width:180px;">
						  </div>	
					  </div>
				  </div>
			  </div>
			  <?php $i++; } ?>
		  </div>
		  <ol class="carousel-indicators">
			  <?php $i = 0; foreach ( $testimonials as $testimonal ) {
			  	if( $i == 0 ) $active = 'class="active"';
			  ?>
			  <li data-target="#testimonialCarousel" data-slide-to="<?php echo $i; ?>" <?php echo $active; ?>></li>
			  <?php $i++; } ?>
		  </ol>
	  </div>
  </div>  

      <?php

    }

  ?> 


  


<?php get_footer(); ?>