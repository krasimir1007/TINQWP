<?php
// Template Name: Careers Page template
global $post;

	if( isset( $_POST['form-type'] ) ){
		$name 		= sanitize_text_field( $_POST['sender-name'] );
		$mail 		= sanitize_email( $_POST['sender-email'] );
		$phone 		= sanitize_text_field( $_POST['sender-phone'] );
		$message	= sanitize_textarea_field( $_POST['msg'] );
		$location	= sanitize_text_field( $_POST['sender-location'] );
		$team		= sanitize_text_field( $_POST['sender-team'] );
		$concent    = $_POST['concent'];

		if( isset( $_POST['is-recommended'] ) ){
			$recom_email		= sanitize_email( $_POST['recom-email'] );
			$recom_name			= sanitize_text_field( $_POST['recom-name'] );
		}
		
		$to = 'careers@tinqin.com';
		
		switch( $location ){
			case 'paris':
				$location = 'TINQIN Paris Office';
				break;
			case 'varna':
				$location = 'TINQIN Varna Office';
				break;
			case 'sofia':
				$location = 'TINQIN Sofia Office';
				break;
		}
		
		$validation = tinqin_validate_forms( $_POST, $_FILES );
		if( $validation != true ){
			$error = $validation;
		}
		else{

			if( isset( $_POST['is-recommended'] ) ){
				$msg_prefix = 'The applicant has listed <strong>' . $recom_name . '</strong> as the contact that referred them for the position. A notification message has been sent.<br /><br /><br />';
				$message = $msg_prefix.$message;
			}
			
			$headers 			= array('Content-Type: text/html; charset=UTF-8', 'From: TINQIN Careers <careersform@tinqinweb.com>' );
			$html 				= return_mail_content( $name, $mail, $phone, $message, 'general-application-form', '', $location, $team );
			$topic				= 'New CV submitted';
			if ( ! function_exists( 'wp_handle_upload' ) ) {
				require_once( ABSPATH . 'wp-admin/includes/file.php' );
			}

			$uploadedfile       = $_FILES['sender-cv'];
			$upload_overrides   = array( 'test_form' => false );
			$movefile           = wp_handle_upload( $uploadedfile, $upload_overrides );

			if( $movefile && $_FILES['sender-cv']['size'] < 5242880 ) {
				$attachments = $movefile[ 'file' ];
				$send	 	= wp_mail( $to, $topic, $html, $headers, $attachments );
				if( isset( $recom_email ) && isset( $recom_name ) ){
					$copy = return_mail_content( $recom_name, $name, null, null, 'recommendation-copy', '', null, null );
					wp_mail( $recom_email, 'Job Application Referral: Verification Request', $copy, $headers );
				}
				if( $send )
					$success = pll__( 'Съобщението е изпратено', 'tinqin' );
				else
					$error = pll__( 'Съобщението не беше изпратено. Опитайте отново.', 'tinqin' );
			}
			else
				$error = pll__( 'Прикаченият файл е по-голям от 5 МВ', 'tinqin' );
		}	
	}

?>

<div class="container mt-lg-5 mt-5 pt-5">
  <div class="row">
    <div class="col-12">
      <h2 class="section-title"><?php the_title(); ?></h2>
      
      <?php the_content(); ?>
    </div>
  </div> 

      <?php

        $hasposts = get_posts( array( 'post_type' => 'jobs' ) );
        if( $hasposts ){

          ?>

  <div class="row">
    <div class="col-12 pt-1">
      <h2 class="section-title mb-4"><?php pll_e( 'Отворени позиции' ) ?></h2>
      <ul class="nav nav-pills mb-2" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="bulgaria-jobs" data-toggle="tab" href="#bulgaria" role="tab" aria-controls="home" aria-selected="true"><?php pll_e( 'България', 'tinqin' ) ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="france-jobs" data-toggle="tab" href="#france" role="tab" aria-controls="profile" aria-selected="false"><?php pll_e( 'Франция', 'tinqin' ) ?></a>
        </li>
      </ul>
      <div class="tab-content pt-2" id="OpenPositions">
        <div class="tab-pane fade show active" id="bulgaria" role="tabpanel" aria-labelledby="bulgaria-tab">
          
          <?php

            $sofia = get_posts(
              array(
                'post_type'       => 'jobs',
								'numberposts'     => -1,
                'meta_query' => array(
                    array(
                        'key' => 'tq-jobs-location',
                        'value' => 'България',
                        'compare' => '=',
                        'type' => 'TEXT',
                    ),
                ),
              )
            );
			$count = count( $sofia );
            if( $sofia ){
              ?>
          <div class="row">

            <?php
			$delay = 350;
			$i = 1;
            foreach( $sofia as $position ){

              ?>


    <div class="col-lg-4 col-md-6 mb-2 mb-md-4 jobs-panel d-flex align-items-lg-stretch align-items-md-stretch" data-aos="fade-up" data-aos-duration='1000' data-aos-delay='<?php echo $delay; ?>'>
      <a href="<?php echo get_permalink( $position->ID ); ?>" class="card list-item card-jobs <?php echo rwmb_meta( 'tq-career-card-class', '', $position->ID ); ?>" >
        <div class="card-body">
          <h5 class="card-title fat-title"><?php echo $position->post_title; ?></h5>
          <p class="card-text"><?php echo rwmb_meta( 'tq-jobs-team-label', '', $position->ID ); ?></p>
		<button class="btn btn-primary btn-lg btn-white"><?php pll_e( 'Изпрати ни своето CV' ) ?></button> 
        </div>  
     
      </a>  
         
    </div>
                                                                                               
              <?php
				  
				$delay = $delay + 150;
				$i++;
            }

            ?>

          </div>

              <?php
            }
            else{
              ?>

              <div class="alert alert-info" role="alert">
                <?php pll_e( 'В момента нямаме отворени позии за', 'tinqin' ) ?> <?php pll_e( 'България', 'tinqin' ) ?>. <?php pll_e( 'Можете да изпратите своето CV на', 'tinqin' ) ?> <a href="mailto:careers@tinqin.com" class="alert-link">careers@tinqin.com</a>.
              </div>

              <?php
            }

          ?>

        </div>
        <div class="tab-pane fade" id="france" role="tabpanel" aria-labelledby="france-tab">

          <?php

            $sofia = get_posts(
              array(
                'post_type'       => 'jobs',
				'numberposts'     => -1,
                'meta_query' => array(
                    array(
                        'key' => 'tq-jobs-location',
                        'value' => 'Франция',
                        'compare' => '=',
                        'type' => 'TEXT',
                    ),
                ),
              )
            );
			$count = count( $sofia );
            if( $sofia ){
              ?>
          <div class="row no-gutters">

            <?php

			$delay = 350;
			$i = 1;
            foreach( $sofia as $position ){

              ?>

    <div class="col-lg-4 col-md-6 <?php if( $i < $count ) { echo 'mb-2'; } ?> jobs-panel d-flex align-items-lg-stretch align-items-md-stretch" data-aos="fade-up" data-aos-duration='1000' data-aos-delay='<?php echo $delay; ?>'>
      <a href="<?php echo get_permalink( $position->ID ); ?>" class="card list-item card-jobs <?php echo rwmb_meta( 'tq-career-card-class', '', $position->ID ); ?>" >
        <div class="card-body">
          <h5 class="card-title fat-title"><?php echo $position->post_title; ?></h5>
          <p class="card-text"><?php echo rwmb_meta( 'tq-jobs-team-label', '', $position->ID ); ?></p>
		<button class="btn btn-primary btn-lg btn-white"><?php pll_e( 'Изпрати ни своето CV' ) ?></button> 
        </div>  
     
      </a>  
         
    </div>

              <?php				  
				$delay = $delay + 150;
				$i++;
            }

            ?>

          </div>

              <?php
            }
            else{
              ?>

              <div class="alert alert-info" role="alert">
                <?php pll_e( 'В момента нямаме отворени позии за', 'tinqin' ) ?> <?php pll_e( 'Франция', 'tinqin' ) ?>. <?php pll_e( 'Можете да изпратите своето CV на', 'tinqin' ) ?> <a href="mailto:careers@tinqin.com" class="alert-link">careers@tinqin.com</a>.
              </div>

              <?php
            }

          ?>

        </div>
      </div>

    </div>
  </div>
          <?php

        }

      ?>

</div>

<?php

	if( pll_current_language() != 'fr' ){
		?>

<div class="accent-box mt-lg-5 mt-5 pt-5 pb-5">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 mb-5 mt-4 text-center" data-aos="fade-up" data-aos-duration='1000' data-aos-delay='200'>
        <h1><?php pll_e( 'Нашият екип се наслаждава на...', 'tinqin' ) ?></h1>
      </div>
    </div>
    <div class="row">
        <div class="col-12" data-aos="fade-up" data-aos-duration='1000' data-aos-delay='250'>
            <section class="perks-slider slider">
              <div class="slide text-center">
                  <img src="<?php echo get_template_directory_uri(); ?>/images/benefits-icon-medical-insurance.svg" width="100" style="width: 100px" />
			      <span class="benefits-label"><?php pll_e( 'Застраховка „Best doctors“', 'tinqin' ) ?></span>
              </div>
              <div class="slide text-center">
                  <img src="<?php echo get_template_directory_uri(); ?>/images/benefits-icon-medical-insurance-2.svg" width="100" style="width: 100px" />
			      <span class="benefits-label"><?php pll_e( 'Допълнително здравно осигуряване', 'tinqin' ) ?></span>
              </div>
              <div class="slide text-center">
                  <img src="<?php echo get_template_directory_uri(); ?>/images/benefits-flexible.svg" width="100" style="width: 100px" />
			      <span class="benefits-label"><?php pll_e( 'Карта за спорт', 'tinqin' ) ?></span>
              </div>
              <div class="slide text-center">
                  <img src="<?php echo get_template_directory_uri(); ?>/images/benefits-icon-employee-support.svg" width="100" style="width: 100px" />
			      <span class="benefits-label"><?php pll_e( 'Програма за подпомагане на служителите', 'tinqin' ) ?></span>
              </div>
              <div class="slide text-center">
                  <img src="<?php echo get_template_directory_uri(); ?>/images/benefits-icon-working-time.svg" width="100" style="width: 100px" />
			      <span class="benefits-label"><?php pll_e( 'Гъвкаво работно време', 'tinqin' ) ?></span>
              </div>
              <div class="slide text-center">
                  <img src="<?php echo get_template_directory_uri(); ?>/images/benefits-icon-home-office.svg" width="100" style="width: 100px" />
			      <span class="benefits-label"><?php pll_e( 'Работа от вкъщи', 'tinqin' ) ?></span>
              </div>
              <div class="slide text-center">
                  <img src="<?php echo get_template_directory_uri(); ?>/images/benefits-icon-holiday.svg" width="100" style="width: 100px" />
			      <span class="benefits-label"><?php pll_e( 'Допълнителни дни отпуск', 'tinqin' ) ?></span>
              </div>
            </section>
        </div>
    </div>
  </div>
</div>

		<?php
	}

?>

<div class="container">

  <!-- product form -->
  <!-- job application form -->
  <div class="row">
      <div class="col-12 <?php if( pll_current_language() != 'fr' ){ ?>pt-lg-5 mt-lg-5<?php } ?> mt-5 mb-5" id="scroll-to-here">
		  <form method="post" enctype="multipart/form-data" action="<?php echo get_permalink() . '#apply-form'; ?>" class="contact-form" id="apply-form">
			<div  data-aos="fade-up" data-aos-duration='1000' data-aos-delay='200'>
				<div class="row">
					<div class="col">
						<h2 class="section-title"><?php pll_e( 'Изпрати ни своето CV', 'tinqin' ) ?></h2>
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
							<span><?php pll_e( 'Име', 'tinqin' ) ?>:</span>
							<input class="form-control" type="text" name="sender-name" required />
						</label>
					</div>
					<div class="col-sm-12 col-md-4">
						<label class="form-group">
							<span><?php pll_e( 'Email', 'tinqin' ) ?>:</span>
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
				<div class="row">
					<div class="col-sm-12 col-md-6">
						<div class="input-group">
						  <div class="input-group-prepend">
							<label class="input-group-text"><?php pll_e( 'Локация', 'tinqin' ) ?></label>
						  </div>
						  <select class="custom-select" name="sender-location" id="form-location" required>
							<option selected><?php pll_e( 'Избери...', 'tinqin' ) ?></option>
							<?php if( pll_current_language() != 'fr' ) { ?><option value="sofia"><?php pll_e( 'София, България', 'tinqin' ) ?></option><?php } ?>
							<?php if( pll_current_language() != 'fr' ) { ?><option value="varna"><?php pll_e( 'Варна, България', 'tinqin' ) ?></option><?php } ?>
							<option value="paris"><?php pll_e( 'Париж, Франция', 'tinqin' ) ?></option>
						  </select>
						</div>
					</div>
					<div class="col-sm-12 col-md-6">
						<div class="input-group">
						  <div class="input-group-prepend">
							<label class="input-group-text"><?php pll_e( 'Аз съм...', 'tinqin' ) ?></label>
						  </div>
						  <select class="custom-select" name="sender-team" id="form-teams" required>
							<option selected><?php pll_e( 'Избери...', 'tinqin' ) ?></option>
							<option class="show-on-bg">Front End</option>
							<option class="show-on-bg">Back End</option>
							<option class="show-on-bg">Designer</option>
							<option class="show-on-bg">Business Analyst</option>
							<option>PMO</option>
							<option value="Other"><?php pll_e( 'Други...', 'tinqin' ) ?></option>
						  </select>
						</div>
					</div>
				</div>
				<div class="input-group input-custom-fileupload">
					<div class="input-group-prepend">
						<span class="input-group-text"><?php pll_e( 'Прикачи CV', 'tinqin' ) ?></span>
					</div>
					<div class="custom-file">
						<input type="file" name="sender-cv" class="custom-file-input" id="sender-cv" accept="image/*, application/pdf, .doc, .docx, .ppt, .pptx" required />
						<label class="custom-file-label" for="sender-cv"><?php pll_e( 'Избери файл', 'tinqin' ) ?></label>
					</div>
				</div>
				<small class="form-text text-muted">JPEG, PNG, PDF, DOC max. 5MB</small>
				<div class="form-check mb-3">
					<input class="form-check-input" name="is-recommended" data-toggle="collapse" data-target="#recommend_collapse" type="checkbox" value="" id="is-recommended">
					<label class="form-check-label" for="is-recommended"><?php pll_e( 'Препоръчан/а съм от...', 'tinqin' ) ?></label>
				</div>
				<div class="collapse" id="recommend_collapse">
					<div class="row">
						<div class="col-sm-12 col-md-6">
							<label class="form-group">
								<span><?php pll_e( 'Име на TINQIN служителя', 'tinqin' ) ?>:</span>
								<input class="form-control" type="text" name="recom-name" />
							</label>
						</div>
						<div class="col-sm-12 col-md-6">
							<label class="form-group">
								<span><?php pll_e( 'Email на TINQIN служителя', 'tinqin' ) ?>:</span>
								<input class="form-control" type="email" name="recom-email" />
							</label>
						</div>
					</div>
				</div>
				<input type="hidden" name="form-type" value="general-application-form" />

				<label class="form-group">
					<span><?php pll_e( 'Съобщение', 'tinqin' ) ?>:</span>
					<textarea class="form-control" name="msg" required></textarea>
				</label>
				
				<div class="form-check mb-3">
					<input class="form-check-input" type="checkbox" name="concent" value="" id="concent">
					<label class="form-check-label" for="concent">
						<?php
							
							$policy = pll_get_post( 2486 );
							$url = get_permalink( $policy );
							$title = get_the_title( $policy );
						
						?>
						<?php pll_e( 'Данните Ви ще бъдат използвани само за обработка на кандидатурата Ви', 'tinqin' ) ?> <a href="<?php echo $url; ?>" target="_blank"><?php echo $title; ?></a> <?php pll_e( 'за целите на разглеждане и преценка на моята кандидатура, както и провеждане на процедури по набиране и подбор на персонал.', 'tinqin' ) ?>
					</label>
				</div>
				
			</div>
            <label class="mt-3" data-aos="fade-up" data-aos-duration='1000' data-aos-delay='350' data-aos-once="true">
                <input class="btn btn-primary btn-lg" type="submit" value="<?php pll_e( 'Кандидатствай', 'tinqin' ) ?>" />
            </label>
        </form>
      </div>
  </div>   	

</div>
