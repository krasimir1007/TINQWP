<?php
// Template Name: Single solution Content
global $post;
?>
  <div class="container mt-5 pt-5 mb-5">
    <div class="row">
      <div class="col-lg-6 col-md-12">
        <h2 class="section-title"><?php the_title(); ?></h2>
	  </div>
	</div>
    <div class="row">
      <div class="col-lg-6 col-md-12">
		  <div class="mt-5">
			  <?php the_content(); ?>
		  </div>
      </div>
	  <div class="col-lg-6 col-md-12 pt-5">
			
		  <?php

		  $files = rwmb_meta( 'tq-solution-slider' );
		  if( $files ){

			?>
		  <!-- Slider -->
			<div class="intro-container mb-4">
			  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
				<div class="carousel-inner"> 

				  <?php

					$i = 0;
					$counter = count( $files );
					foreach ( $files as $file ) {						
					  $i++;
					  if( $i == 1 ) $active = 'active'; else $active = '';
						?>

				  <div class="carousel-item <?php echo $active; ?>" style="position: relative;">
					<div class="<?php echo rwmb_meta( 'tq-solution-gradient-class' ); ?>" style="position: absolute; bottom: 0; left: 0; height: 50%; width: 100%; z-index: 3;">
						
					</div>
					<img src="<?php echo $file['url']; ?>" class="img-fluid" style="z-index: 1;" />
				  </div>

						<?php
					}

				  ?>

				</div>
				<ol class="carousel-indicators">
				  <?php for( $i=0; $i<$counter; $i++ ){ if( $i == 0 ) $active = 'active'; else $active = ''; ?>
				  <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i; ?>" class="<?php echo $active; ?>"></li>
				  <?php } ?>
				</ol>

			  </div>
			</div>

			<?php

		  } ?>
		  
		  <?php
		  	$blurb = rwmb_meta( 'tq-solution-text-blurb' );
		  	if( $blurb ){
				?>
		  <div class="accent-box mb-4 solution-blurb">
			  <div class="blurb-wrapper">
				  <?php echo $blurb; ?>
			  </div>
		  </div>
		  		<?php
			}
		  ?>
		</div>
    </div>
  </div>

  <?php

    $testimonials = get_posts( array(
        'post_type'       => 'testimonials',
        'numberposts'     => 3,
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
  <div class="client-box accent-box pt-5 pb-5" data-aos="fade-up" data-aos-duration='1000' data-aos-delay='350'>
    <div class="container pt-2 pb-2" id='solution-testimonal'>
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
						  <div class="col-lg-3 col-md-12 text-right">
							  <img src="<?php echo get_template_directory_uri(); ?>/images/icon-speech-bubble.svg"  /  style="max-width:180px;">
						  </div>	
					  </div>
				  </div>
			  </div>
			  <?php $i++; } ?>
		  </div>
		  <ol class="carousel-indicators">
			  <li data-target="#testimonialCarousel" data-slide-to="0" class="active"></li>
			  <li data-target="#testimonialCarousel" data-slide-to="1"></li>
			  <li data-target="#testimonialCarousel" data-slide-to="2"></li>
		  </ol>
	  </div>  
    </div>
  </div>  

<div class="container">

  <?php

		$form = 0;
		if( $form == 0 ){
			?>
			<div data-aos="fade-up" data-aos-duration='1000' data-aos-delay='200'>
				<div class="row">
					<div class="col mt-5">
						<h2 class="section-title"><?php pll_e( 'Поискайте оферта', 'tinqin' ) ?></h2>
						<p class="section-subtitle"><a href="mailto:sales@tinqin.com">sales@tinqin.com</a></p>
					</div>
				</div>
			</div>
			<?php
		}
		else{
			?>
	
  <!-- product form -->
  <!-- job application form -->
  <div class="row">
      <div class="col-12 pt-5" id="scroll-to-here">
		  <form method="post" enctype="multipart/form-data" action="<?php echo get_permalink() . '#apply-form'; ?>" class="contact-form" id="apply-form">
			<div data-aos="fade-up" data-aos-duration='1000' data-aos-delay='200'>
				<div class="row">
					<div class="col">
						<h2 class="section-title"><?php pll_e( 'Поискайте оферта', 'tinqin' ) ?></h2>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<?php
				if( $error != null ){
						?>
						<div class="alert alert-danger mt-5" role="alert"><?php echo $error; ?></div>
						<?php
				}

				if( $success != null ){
								?>
								<div class="alert alert-success mt-5" role="alert"><?php echo $success; ?></div>
								<?php
				}
						?>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12 col-md-4">
						<label class="form-group">
							<span><?php pll_e( 'Име на компанията', 'tinqin' ) ?>:</span>
							<input class="form-control" type="text" name="sender-name" required />
						</label>
					</div>
					<div class="col-sm-12 col-md-4">
						<label class="form-group">
							<span><?php pll_e( 'Служебен Email', 'tinqin' ) ?>:</span>
							<input class="form-control" type="email" name="sender-email" required />
						</label>
					</div>
					<div class="col-sm-12 col-md-4">
						<label class="form-group">
							<span><?php pll_e( 'Телефон', 'tinqin' ) ?>:</span>
							<input class="form-control" type="text" name="sender-phone" required />
						</label>
					</div>
				</div>
			  
				<input type="hidden" name="form-type" value="service-products-form" />

				<label class="form-group">
					<span><?php pll_e( 'Съобщение', 'tinqin' ) ?>:</span>
					<textarea class="form-control" name="msg" required></textarea>
				</label>
			</div>
            <label class="mt-3" data-aos="fade-up" data-aos-duration='1000' data-aos-delay='350'>
                <input class="btn btn-primary btn-lg" type="submit" value="<?php pll_e( 'Поискай оферта', 'tinqin' ) ?>" />
            </label>
        </form>
      </div>
  </div> 
			<?php
		}
	
  ?>

</div>

      <?php

    }

  ?> 

  <?php
  $logos = rwmb_meta( 'tq-solution-clients' );
   if( $logos ){
    ?>
  <!-- Slider -->
  <div class="container pt-5 mb-5 pb-3">
    <div class="row">
      <div class="col-12"  data-aos="fade-up" data-aos-duration='1000' data-aos-delay='350'>
        <h2 class="section-title"><?php pll_e( 'От тази услуга се възползваха...' ) ?></h2>
      </div>
    </div>

    <section class="customer-logos mt-3 slider" data-aos="fade-up" data-aos-duration='1000' data-aos-delay='350'>
      <?php foreach ($logos as $logo) { ?>
      <div class="slide"><img src="<?php echo get_the_post_thumbnail_url( $logo ); ?>" alt="<?php echo get_the_title( $logo ); ?>"></div>
      <?php } ?>
    </section>

  </div>
    <?php
  }

  ?>