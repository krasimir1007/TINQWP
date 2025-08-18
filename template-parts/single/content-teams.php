<?php
// Template Name: Teams page content
global $post;

  ?>

  <div class="container mt-5 pt-5"> 
	<div class="row">
      <div class="col-12 col-12 mb-3 mt-3">
         <h2 class="section-title"><?php the_title(); ?></h2>
	     <p class="section-subtitle"><?php pll_e( 'Запознай се с екипа ни', 'tinqin' ); ?></p>
      </div>
    </div>
	  
    <div class="row mb-3 pb-3 aos-init aos-animate" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
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
			$delay += 150;
          }
        }
		
      ?>
    </div>
	  
    <div class="row pb-3">
	  <div class="col-md-12 mb-5" data-aos="fade-up" data-aos-duration='1000' data-aos-delay='200'>
	     <h2 class="section-title"><?php pll_e( 'Нашите колеги споделят...', 'tinqin' ) ?></h2>
	  </div>
      <?php

        // Display random staff testimonial
        $staffs = get_posts(array(
          'post_type' => 'staff',
          'posts_per_page' => 3,
		  'orderby' => 'rand'
        ));
        if( $staffs ){
		  $delay = 350;
          foreach( $staffs as $staff ){
            ?>

      <div class="col-md-4 mb-5 text-center staff-panels" data-aos="fade-up" data-aos-duration='1000' data-aos-delay='<?php echo $delay; ?>'>
	    <img src="<?php echo get_the_post_thumbnail_url( $staff->ID ) ?>" class="img-fluid mb-3" style="border-radius: 50%" />
		<div class="staff-text"><?php echo $staff->post_content; ?></div>
		<small class="staff-name"><?php echo $staff->post_title; ?></small>
		<small class="staff-position" style="display: block;"><?php echo rwmb_meta( 'tq-staff-position', '', $staff->ID ); ?></small>
      </div>
		  

            <?php
			$delay +=150;
          }
        }
		
      ?>
    </div>
	  
  </div>
