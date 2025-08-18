<?php
// Template Name: Job single template
global $post;

	$location = rwmb_meta( 'tq-jobs-location' );
	if( rwmb_meta( 'tq-jobs-location-city' ) != 'Select city' ){
	    $city = rwmb_meta( 'tq-jobs-location-city' );
	}
	else{
	    $city = false;
	}
	$to = 'careers@tinqin.com';
	$team = get_the_title( rwmb_meta( 'tq-jobs-team' ) );

	if( isset( $_POST['form-type'] ) ){
		$name 		= sanitize_text_field( $_POST['sender-name'] );
		$mail 		= sanitize_email( $_POST['sender-email'] );
		$phone 		= sanitize_text_field( $_POST['sender-phone'] );
		$message	= sanitize_textarea_field( $_POST['msg'] );

		if( isset( $_POST['is-recommended'] ) ){
			$recom_email		= sanitize_email( $_POST['recom-email'] );
			$recom_name			= sanitize_text_field( $_POST['recom-name'] );
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
			$html 				= return_mail_content( $name, $mail, $phone, $message, 'position-application-form', $post->ID );
			$topic				= 'New Applicant for' . $post->post_title;
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

<div class="container mt-5 pt-5">
  <div class="row">
    <div class="col-12">
      <h2 class="section-title"><?php the_title(); ?></h2>
      <p class="section-subtitle mb-5"><?php
            if( $city ){
                if( $city == 'Sofia' ){
                    pll_e( 'Искаш ли да си част от нашия страхотен екип в София? Кандидатствай сега!', 'tinqin' );
                }
                if( $city == 'Varna' ){
                    pll_e( 'Искаш ли да си част от нашия страхотен екип във Варна? Кандидатствай сега!', 'tinqin' );
                }
            }else{
                pll_e( 'Мислиш, че си правилният човек за тази позиция? Кандидатствай сега!', 'tinqin' );          
            }
      
       ?></p>
      <?php the_content(); ?>
    </div>
  </div>
</div>

<div class="container mb-5">
  <!-- job application form -->
  <div class="row">
      <div class="col-12 pt-5" id="scroll-to-here">
		  <form method="post" enctype="multipart/form-data" action="<?php echo get_permalink() . '#apply-form'; ?>" class="contact-form" id="apply-form">
			<div data-aos="fade-up" data-aos-duration='1000' data-aos-delay='200'>
				<div class="row">
					<div class="col mb-4">
						<h2 class="section-title"><?php pll_e( 'Кандидатствай за тази позиция', 'tinqin' ) ?></h2>
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
				<input type="hidden" name="form-type" value="position-application-form" />
            
				<label class="form-group">
					<span><?php pll_e( 'Съобщение', 'tinqin' ) ?>:</span>
					<textarea class="form-control" name="msg" required></textarea>
				</label>

				<div class="form-check mb-3">
					<input class="form-check-input" type="checkbox" value="" id="concent">
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
            <label class="mt-3" data-aos="fade-up" data-aos-duration='1000' data-aos-delay='350'>
                <input class="btn btn-primary btn-lg" type="submit" value="<?php pll_e( 'Кандидатствай', 'tinqin' ) ?>" />
            </label>
        </form>
      </div>
  </div>   
</div>  

<div class="accent-box pt-5 pb-5 ">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 pb-4 mb-5 mt-4 text-center" data-aos="fade-up" data-aos-duration='1000' data-aos-delay='200'>
        <h1><?php pll_e( 'Изгради кариерата си в TINQIN' ) ?></h1>
        <h4><?php pll_e( 'Развивай себе си, създавай с нас', 'tinqin' ); ?></h4>
      </div>
    </div>
	<div class="row">
  		<div class="col-lg-10 mb-4 offset-lg-1 text-center">
  			<div class="row mt-3">
	          <div class="col-md-4 text-center" data-aos="fade-up" data-aos-duration='1000' data-aos-delay='350'>
	            <img src="<?php echo get_template_directory_uri(); ?>/images/user-basic.svg" style="height:100px;" />
	            <h4 class="mt-3 font-weight-700"><?php echo rwmb_meta( 'tq-jobs-data-career-step-1' ) ?></h4>
	            <h6><?php echo rwmb_meta( 'tq-jobs-data-career-xp-step-1' ) ?> <?php pll_e( 'години' ) ?></h6>
	          </div>
	          <div class="col-md-4 pt-3-small text-center " data-aos="fade-up" data-aos-duration='1000' data-aos-delay='500'>
	            <img src="<?php echo get_template_directory_uri(); ?>/images/user-mid.svg" style="height:100px;" />
	            <h4 class="mt-3 font-weight-700"><?php echo rwmb_meta( 'tq-jobs-data-career-step-2' ) ?></h4>
	            <h6><?php echo rwmb_meta( 'tq-jobs-data-career-xp-step-2' ) ?> <?php pll_e( 'години' ) ?></h6>
	          </div>
	          <div class="col-md-4 pt-3-small text-center " data-aos="fade-up" data-aos-duration='1000' data-aos-delay='650'>
	            <img src="<?php echo get_template_directory_uri(); ?>/images/user-high.svg" style="height:100px;" />
	            <h4 class="mt-3 font-weight-700"><?php echo rwmb_meta( 'tq-jobs-data-career-step-3' ) ?></h4>
	            <h6><?php echo rwmb_meta( 'tq-jobs-data-career-xp-step-3' ) ?> <?php pll_e( 'години' ) ?></h6>
	          </div>
  			</div>
  		</div>
		</div>
  </div>
</div>   

          <?php

            $jobs = get_posts(
              array(
                'post_type'       => 'jobs',
                'numberposts'	  => 4,
                'orderby'        => 'rand',
                'meta_query' => array(
                    array(
                        'key' => 'tq-jobs-team',
                        'value' => rwmb_meta( 'tq-jobs-team' ),
                        'compare' => '=',
                        'type' => 'TEXT',
                    ),
                ),
              )
            );
            if( $jobs ){
              ?>


<div class="container mb-5 pb-3 pt-5 mt-5 no-padding-small">
  <div class="row mt-3">
    <div class="col-12" data-aos="fade-up" data-aos-duration='1000' data-aos-delay='200'>
      <h2 class="section-title"><?php echo $team; ?> <?php pll_e( 'екипът ни търси също и...', 'tinqin' ) ?></h2>
      <p class="section-subtitle"><?php pll_e( 'Не искаме нищо по-малко от най-добрите хора за нашия екип. Искаш да си част от него? Кандидатствай сега!', 'tinqin' ) ?></p>
		
    </div>
  </div>
  <div class="row">

            <?php
			$delay = 350;
            foreach( $jobs as $position ){

              ?>

	      <div class="col-lg-4 col-md-6 mb-2 jobs-panel d-flex align-items-lg-stretch align-items-md-stretch" data-aos="fade-up" data-aos-duration='1000' data-aos-delay='<?php echo $delay; ?>'>
      <a href="<?php echo get_permalink( $position->ID ); ?>" class="card list-item card-jobs <?php echo rwmb_meta( 'tq-career-card-class', '', $position->ID ); ?>" >
        <div class="card-body">
          <h5 class="card-title fat-title"><?php echo $position->post_title; ?></h5>
          <p class="card-text"><?php echo get_the_title( rwmb_meta( 'tq-jobs-team', '', $position->ID ) ); ?></p>
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