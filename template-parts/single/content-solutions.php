<?php
// Template Name: Solutions page content
global $post;
?>

<div class="container mt-lg-5 mt-3 pt-5 pb-3">
  <div class="row">	  
	<div class="col-12">
     <h2 class="section-title"><?php the_title(); ?></h2>
     <?php the_content(); ?> 
    </div>
  </div>
</div>
<div class="container mt-lg-5 mb-lg-5 md-3 mb-3">
          <?php

            $solutions = get_posts(
              array(
                'post_type'       => 'solutions',
                'numberposts'     => -1,
				'orderby'		  => 'menu_order',
				'sort_column' 	  => 'menu_order',
				'order' 		  => 'ASC'  
              )
            );
            if( $solutions ){
      				$delay = 200;
      				$i = 0;
      				foreach( $solutions as $ac ){
      				    $palette = rwmb_meta( 'tq-solution-palette-class', '', $ac->ID );
      				    $card    = rwmb_meta( 'tq-solution-card-class', '', $ac->ID );
      				    $files   = rwmb_meta( 'tq-solution-icon', array( 'limit' => 1 ), $ac->ID );
      					$file    = reset( $files );
      					$icon    = $file['url'];
                if( $i % 2 ) { $content_class = 'order-md-last'; $picture_class = 'order-md-first'; } else { $content_class = 'order-md-first'; $picture_class = 'order-md-last'; }
      					?>
                  <div class="row mt-lg-5 mb-md-3">
                    <div class="col-lg-4 col-md-4 mb-4 d-flex align-items-lg-stretch align-items-md-stretch <?php echo $picture_class; ?>" <?php if( $i > 2 ){ ?>data-aos="fade-up" data-aos-duration='1000' data-aos-delay='<?php echo $delay; ?>'<?php } ?>>
                       <a class="card list-item card-services <?php echo $palette; ?> <?php echo $card; ?> srike-hover">
                        <div class="card-body" style="background-image: url('<?php echo get_the_post_thumbnail_url( $ac->ID ) ?>') !important; background-size: contain;">
                          <div class="card-body-content">
                            <img src="<?php echo $icon; ?>" width="100" />
                          </div>
                        </div>	
                      </a>
                    </div>
                    <div class="col-md-8 mb-md-3 <?php echo $content_class; ?>" <?php if( $i > 2 ){ ?>data-aos="fade-up" data-aos-duration='1000' data-aos-delay='<?php echo $delay; ?>'<?php } ?> >
                		  <div class="card product-card h-100 content-<?php echo $card; ?>">
                			  <div class="card-body d-flex flex-column">
                				  <h3 class="card-title mt-3"><?php echo $ac->post_title; ?></h3>
                				  <div class="card-content"><?php echo apply_filters('the_content', $ac->post_content); ?></div>
                			  </div>
                		  </div>
                    </div>
                  </div>
      		  			<?php
      					if( $i > 2 ) $delay += 200; 
      					$i++;
      				}
      			}
            ?>
</div>

  <!-- Quality primer -->
  <div class="accent-box pt-5 pb-5" id='parent-offer'>
    <div class="container">
      <div class="row">
        <div class="col-lg-12 mb-5 mt-4 text-center" data-aos="fade-up" data-aos-duration='1000' data-aos-delay='200'>
          <h1><?php pll_e( 'Можеш да разчиташ на TINQIN. Ето защо...' ) ?></h1>
        </div>
      </div>
      <div class="row mt-3">
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
  <!-- Quote CTA -->
  <div class="container pt-5 mb-4" data-aos="fade-up" data-aos-duration='1000' data-aos-delay='800' data-aos-anchor='#parent-offer'>
    <div class="row">
      <div class="col-lg-12 text-center">
        <a href="mailto:sales@tinqin.com" class="btn btn-primary btn-lg btn-white"><?php pll_e( 'Поискай оферта' ) ?></a>
      </div>
    </div>
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
