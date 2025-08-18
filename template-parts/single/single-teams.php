<?php
// Template Name: Single team Content
global $post;
$lang = pll_get_post_language($post->ID);
$titleimg = $files = rwmb_meta( 'tq-team-title-bgr' );
?>
  <div class="container mt-5 pt-5 mb-5">
    <div class="row">
      <div class="col-12">
        <div class="clipped-title text-center">
			<img src="<?php echo  rwmb_meta( 'tq-team-title-bgr' ); ?>" style="width: 100%" />
			<h1>
				<?php the_title(); ?>
			</h1>
        </div>
      </div>
    </div>
    <div class="row mt-5 pt-2 mt-1-5-small d-flex justify-content-center">
      <div class="col-12 mt-5 no-margin-small">
        <?php the_content(); ?>
      </div>

    </div>
	  </div>
	  

<div class="accent-box-alt">
	<div class="container pb-5">
			    <div class="row">
      <div class="col-12 pt-2 mt-5 pt-2 mb-3" data-aos="fade-up" data-aos-duration='1000' data-aos-delay='200'>
        <h2 class="section-title mt-3 mb-3"><?php pll_e( 'Опознай ни... с факти' ) ?></h2>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
      	<div class="row">
      		
	      <div class="col-md-6 mb-4 team-chart" data-aos="fade-up" data-aos-duration='1000' data-aos-delay='350'>
	        <h4 class="mb-4 pb-2"><?php if( rwmb_meta( 'tq-team-specific-title-count' ) == 'pmvspmo' ) { pll_e( 'Проектни ръководители vs. PMOs' ); } else {  pll_e( 'Младши vs. Старши' );  } ?></h4>
			  <div class="d-flex align-items-center">
				<img src="<?php echo get_template_directory_uri(); ?>/images/team.svg" style="width: 28%" />
				  <div class="ml-4">
					<h4 class="counter"><?php echo rwmb_meta( 'tq-team-data-juniors' ) ?></h4>
					<span class="counter-subtitle"><?php if( rwmb_meta( 'tq-team-specific-title-count' ) == 'pmvspmo' ) { pll_e( 'проектни ръководители' ); } else {  pll_e( 'младши' );  } ?></span>
				  </div>
				   <div class="ml-4">
					<h4 class="counter"><?php echo rwmb_meta( 'tq-team-data-seniors' ) ?></h4>
					<span class="counter-subtitle"><?php if( rwmb_meta( 'tq-team-specific-title-count' ) == 'pmvspmo' ) { echo 'PMOs'; } else {  pll_e( 'старши' );  } ?></span>
				  </div>
			  </div>
	      </div>
	      <div class="col-md-6 mb-4 pt-3-small team-chart"  data-aos="fade-up" data-aos-duration='1000' data-aos-delay='500'>
	        <h4 class="mb-2"><?php pll_e( 'Години в компанията' ) ?></h4>
			<div class="chart-container" style="position: relative; height:auto; width:320px">
			<canvas id="PieChart" ></canvas>
			</div>
			<script>
			var ctx = document.getElementById('PieChart').getContext('2d');
			var myChart = new Chart(ctx, {
			    type: 'doughnut',
			    data: {
			        labels: [ <?php 

			        	$labels = explode( ',', rwmb_meta( 'tq-team-data-pie-labels' ) );
			        	$count = count( $labels );
			        	$i = 0;
			        	foreach ($labels as $label) {
			        		$i++;
			        		echo '"' . $label .'"';
			        		if ( $i < $count )
			        			echo ",";
			        	}

			        ?> ],
			        datasets: [{
			            data: [

			            <?php

			        	$labels = explode( ',', rwmb_meta( 'tq-team-data-pie-values' ) );
			        	$count = count( $labels );
			        	$i = 0;
			        	foreach ($labels as $label) {
			        		$i++;
			        		echo '"' . $label .'"';
			        		if ( $i < $count )
			        			echo ",";
			        	}

			            	?>

			            ],
			            backgroundColor: [
			                <?php echo rwmb_meta( 'tq-team-data-pie-colors' ) ?>
			            ],
			            borderWidth: 0
			        }]
			    },
																		 
					options: {
      					legend: {
         					position: 'right',
							labels: {
                			fontColor: 'rgb(0, 0, 0)',
							fontSize:14,
							fontFamily: 'Montserrat',
							boxWidth:15,
							
            				}
      					}
   					}					 
			});
			</script>
	      </div>
	      <div class="col-md-6 mb-4 mt-4 mt-2-small team-chart"  data-aos="fade-up" data-aos-duration='1000' data-aos-delay='650'>
	        <h4 class="mb-4 "><?php pll_e( 'Спечелини трофеи в TINQIN игрите' ) ?></h4>
			  <div class="d-flex align-items-center">
				<img src="<?php echo get_template_directory_uri(); ?>/images/awards.svg" style="width: 28%" />
				  <div class="ml-4">
					<h4 class="counter"><?php echo rwmb_meta( 'tq-team-data-trophies' ) ?></h4>
					<span class="counter-subtitle"><?php pll_e( '... и още предстоят' ) ?></span>
				  </div>
			  </div>
	      </div>
	      <div class="col-md-6 mb-4 mt-4  pt-3-small team-chart"  data-aos="fade-up" data-aos-duration='1000' data-aos-delay='800'>
	        <h4 class="mb-4 "><?php pll_e( rwmb_meta( 'tq-team-specific-title' ) ) ?></h4>
			   
											   
											   
			  <div class="d-flex align-items-center">
				<img src="<?php $file = reset( rwmb_meta( 'tq-team-specific-icon', array( 'limit' => 1 ) ) ); echo $file['url']; ?>" style="width: 28%" />
				  <div class="ml-4">
					 <h4 class="counter"><?php echo rwmb_meta( 'tq-team-data-team-specific' ) ?></h4>
					<span class="counter-subtitle"><?php pll_e( '... mil' ) ?></span>
				  </div>
			  </div>					   
											   
	      </div>

      	</div>
      </div>
    </div>
  </div>
</div>															 
	

			<?php
						
			$staffs = get_posts(
              array(
                'post_type'       => 'staff',
                'numberposts'	  => 3,
                'orderby'        => 'rand',
                'meta_query' => array(
                    array(
                        'key' => 'tq-staff-team',
                        'value' => $post->ID,
                        'compare' => '=',
                        'type' => 'TEXT',
                    ),
                ),
              )
            );
			if( $staffs ){
				?>
   <div class="container mt-5 pt-2 pb-3">
    <div class="row pb-3">
	  <div class="col-md-12 mb-3" data-aos="fade-up" data-aos-duration='1000' data-aos-delay='200'>
	     <h2 class="section-title"><?php pll_e( 'Нашите колеги споделят...', 'tinqin' ) ?></h2>
	  </div>
      <?php
		  $delay = 350;
          foreach( $staffs as $staff ){
            ?>

      <div class="col-md-4 text-center staff-panels" data-aos="fade-up" data-aos-duration='1000' data-aos-delay='<?php echo $delay; ?>'>
	    <img src="<?php echo get_the_post_thumbnail_url( $staff->ID ) ?>" class="img-fluid mb-3" style="border-radius: 50%" />
		<div class="staff-text"><?php echo $staff->post_content; ?></div>
		<small class="staff-name"><?php echo $staff->post_title; ?></small>
		<small class="staff-position" style="display: block;"><?php echo rwmb_meta( 'tq-staff-position', '', $staff->ID ); ?></small>
      </div>
		  

            <?php
			$delay +=150;
          }		
      ?>
    </div>
   </div>
				<?php
			}

  $technologies = rwmb_meta('tq-team-tеchnologies-used');
  if( $technologies ) { ?>
  <!-- Clients -->
  <div class="load-anim" data-aos="fade-up" data-aos-duration='1000' data-aos-delay='800'>
    <div class="container mt-3 mb-3">
      <section class="customer-logos customer-logos-teams slider">
  		<?php foreach( $technologies as $technology ) { ?>
			<div class="slide"><img src="<?php echo $technology['url']; ?>"></div>
	  	<?php } ?>
      </section>
    </div>    
  </div>
<?php } 		
		if( rwmb_meta( 'tq-team-specific-title-count' ) != 'pmvspmo' ) {
            ?>
																	 
  <div class="accent-box pt-5 pb-5 <?php if( !$jobs ) echo 'mt-5' ?>">
  	<div class="container">
        <div class="row">
          <div class="col-lg-12 pb-4 mb-5 mt-4 text-center" data-aos="fade-up" data-aos-duration='1000' data-aos-delay='200'>
            <h1><?php pll_e( 'Тези лога ти говорят нещо?' ) ?></h1>
            <h4><?php pll_e( 'Прегледай кариерния план в този екип' ) ?></h4>
          </div>
        </div>
  		<div class="row">
	  		<div class="col-lg-10 mb-4 offset-lg-1 text-center">
	  			<div class="row mt-3">
		          <div class="col-md-4 text-center" data-aos="fade-up" data-aos-duration='1000' data-aos-delay='350'>
		            <img src="<?php echo get_template_directory_uri(); ?>/images/user-basic.svg" style="height:100px;" />
		            <h4 class="mt-3 font-weight-700"><?php echo rwmb_meta( 'tq-team-data-career-step-1' ) ?></h4>
		            <h6><?php echo rwmb_meta( 'tq-team-data-career-xp-step-1' ) ?> <?php pll_e( 'години' ) ?></h6>
		          </div>
		          <div class="col-md-4 pt-3-small text-center" data-aos="fade-up" data-aos-duration='1000' data-aos-delay='500'>
		            <img src="<?php echo get_template_directory_uri(); ?>/images/user-mid.svg" style="height:100px;" />
		            <h4 class="mt-3 font-weight-700"><?php echo rwmb_meta( 'tq-team-data-career-step-2' ) ?></h4>
		            <h6><?php echo rwmb_meta( 'tq-team-data-career-xp-step-2' ) ?> <?php pll_e( 'години' ) ?></h6>
		          </div>
		          <div class="col-md-4 pt-3-small text-center" data-aos="fade-up" data-aos-duration='1000' data-aos-delay='650'>
		            <img src="<?php echo get_template_directory_uri(); ?>/images/user-high.svg" style="height:100px;" />
		            <h4 class="mt-3 font-weight-700"><?php echo rwmb_meta( 'tq-team-data-career-step-3' ) ?></h4>
		            <h6><?php echo rwmb_meta( 'tq-team-data-career-xp-step-3' ) ?> <?php pll_e( 'години' ) ?></h6>
		          </div>
	  			</div>
	  		</div>
  		</div>
  	</div>
  </div>

  <!-- Services overview -->
          <?php	
		}
            $jobs = get_posts(
              array(
                'post_type'       => 'jobs',
                'numberposts'	  => 4,
                'orderby'        => 'rand',
                'post__not_in' => array( $post->ID ),
                'meta_query' => array(
                    array(
                        'key' => 'tq-jobs-team',
                        'value' => $post->ID,
                        'compare' => '=',
                        'type' => 'TEXT',
                    ),
                ),
              )
            );
            if( $jobs ){
              ?>


<div class="container mb-5 pb-3 pt-5 mt-5 no-padding-small">
  <div class="row">
    <div class="col-12"  data-aos="fade-up" data-aos-duration='1000' data-aos-delay='200'>
      <h2 class="section-title"><?php pll_e( 'Нашият екип', 'tinqin' ) ?> <?php the_title(); ?> <?php pll_e( 'екипът ни търси също и...', 'tinqin' ) ?></h2>
      <p class="section-subtitle"><?php pll_e( 'Не искаме нищо по-малко от най-добрите хора за нашия екип. Искаш да си част от него? Кандидатствай сега!', 'tinqin' ) ?></p>
    </div>
  </div>
  <div class="row">

            <?php
			$delay = 350;
            foreach( $jobs as $position ){

              ?>
    <div class="col-lg-4 col-md-6 mb-2 jobs-panel d-flex align-items-lg-stretch align-items-md-stretch" data-aos="fade-up" data-aos-duration='1000' data-aos-delay='<?php echo $delay; ?>'>
      <a href="<?php echo get_permalink( $position->ID ); ?>" class="card list-item card-jobs <?php echo rwmb_meta( 'tq-team-card-class' ); ?>">
        <div class="card-body">
          <h5 class="card-title fat-title"><?php echo $position->post_title; ?></h5>
          <p class="card-text"><?php echo rwmb_meta( 'tq-jobs-team-label', '', $position->ID ); ?></p>
			<button class="btn btn-primary btn-lg btn-white"><?php pll_e( 'Кандидатствай' ) ?></button> 
        </div>
      </a>					  
    </div>
																						      
              <?php
			$delay = $delay + 150;
            }
            ?>
  </div>
</div>

            <?php
        }

?>

  <div class="container mt-5 mb-5">

	<div class="row">
      <div class="col-12 mb-3" data-aos="fade-up" data-aos-duration='1000' data-aos-delay='200'>
     	<h2 class="section-title"><?php pll_e( 'Запознай се с другите ни екипи', 'tinqin' ) ?></h2>
		<p class="section-subtitle"><?php pll_e( 'Запознай се с екипа ни', 'tinqin' ); ?></p>
      </div>
    </div>
	  
    <div class="row spacing-bottom-s">
      <?php

        // Display all temas in this term
        $teams = get_posts(array(
          'post_type' => 'teams',
          'numberposts' => -1,
		  'exclude' => $post->ID
        ));
        if( $teams ){
		  $delay = 350;
          foreach( $teams as $team ){
            ?>

      <div class="col-lg-4 col-md-4 mb-4  d-flex align-items-lg-stretch align-items-md-stretch" data-aos="fade-up" data-aos-duration='1000' data-aos-delay='<?php echo $delay; ?>'>
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