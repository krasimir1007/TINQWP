<?php
// Template Name: Consulting page content
global $post;
?>

<div class="container mt-lg-5 mt-5 pt-5 pb-3">
  <div class="row">
	<div class="col-12">
     <h2 class="section-title"><?php the_title(); ?></h2>
     <?php the_content(); ?> 
    </div>
  </div>
</div>
<div class="container">
          <?php

            $solutions = get_posts(
              array(
                'post_type'       => 'consulting',
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
      				    $palette = rwmb_meta( 'tq-consulting-palette-class', '', $ac->ID );
      				    $card    = rwmb_meta( 'tq-consulting-card-class', '', $ac->ID );
      				    $files   = rwmb_meta( 'tq-consulting-icon', array( 'limit' => 1 ), $ac->ID );
      					$file    = reset( $files );
      					$icon    = $file['url'];
                if( $i % 2 ) { $content_class = 'order-md-last'; $picture_class = 'order-md-first'; } else { $content_class = 'order-md-first'; $picture_class = 'order-md-last'; }
      					?>
                  <div class="row mt-lg-5 mb-md-3">
                    <div class="col-lg-4 col-md-4 mb-4 <?php echo $picture_class; ?>" <?php if( $i > 2 ){ ?>data-aos="fade-up" data-aos-duration='1000' data-aos-delay='<?php echo $delay; ?>'<?php } ?>>
                       <a class="card list-item card-services d-flex align-items-lg-stretch align-items-md-stretch <?php echo $palette; ?> <?php echo $card; ?> srike-hover">
                        <div class="card-body" style="background-image: url('<?php echo get_the_post_thumbnail_url( $ac->ID ) ?>') !important; background-size: contain;">
                          <div class="card-body-content">
                            <img src="<?php echo $icon; ?>" width="100" />
                          </div>
                        </div>	
                      </a>
                    </div>
                    <div class="col-md-8 mb-3 <?php echo $content_class; ?>" <?php if( $i > 2 ){ ?>data-aos="fade-up" data-aos-duration='1000' data-aos-delay='<?php echo $delay; ?>'<?php } ?> >
                		  <div class="card product-card h-100 content-<?php echo $card; ?> srike-hover">
                			  <div class="card-body d-flex flex-column">
                				  <h3 class="card-title mt-2"><?php echo $ac->post_title; ?></h3>
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
  <div class="client-box pt-5 pb-5 mt-lg-5" data-aos="fade-up" data-aos-duration='1000' data-aos-delay='200'>	  
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
			 <!-- <li data-target="#testimonialCarousel" data-slide-to="0" class="active"></li>
			  <li data-target="#testimonialCarousel" data-slide-to="1"></li>
			  <li data-target="#testimonialCarousel" data-slide-to="2"></li> -->
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


    <!-- Clients (grid, no slider) -->
    <div class="container mt-5 mb-5" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
      <section class="home-hero-logos" aria-label="Нашите клиенти">
	     <h2 class="section-title"><?php pll_e('Стани един от доволните ни клиенти!'); ?></h2>
        <div class="customer-logos customer-logos-teams grid">
          <?php
          $logos = get_posts([
            'post_type'   => 'testimonials',
            'numberposts' => -1,
          ]);
          if ( $logos ) {
            foreach ( $logos as $logo ) {
              $src = get_the_post_thumbnail_url( $logo->ID, 'full' );
              if ( ! $src ) { continue; }
              $src = esc_url( set_url_scheme( $src, 'https' ) );
              $alt = esc_attr( get_the_title( $logo->ID ) );
              echo '<div class="slide"><img src="'.$src.'" alt="'.$alt.'" loading="lazy" decoding="async"></div>';
            }
          }
          wp_reset_postdata();
          ?>
        </div>
      </section>
    </div>	