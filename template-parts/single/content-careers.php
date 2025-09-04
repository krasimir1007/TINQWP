<?php
/* Template Name: Careers Page */
defined('ABSPATH') || exit;


function tinqin_wrap_iframes_in_responsive_div( $content ) {
    // Look for any iframe and wrap it
    $pattern = '~<iframe[^>]+></iframe>|<iframe.*?</iframe>~is';
    $replacement = '<div class="responsive-video">$0</div>';
    return preg_replace( $pattern, $replacement, $content );
}
add_filter( 'the_content', 'tinqin_wrap_iframes_in_responsive_div' );


?>

<style>
/* Responsive video wrapper */
.responsive-video {
  position: relative;
  padding-bottom: 56.25%; /* 16:9 aspect ratio */
  height: 0;
  overflow: hidden;
  max-width: 100%;
}

.responsive-video iframe,
.responsive-video object,
.responsive-video embed {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  border: 0;
}


</style>


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

          <?php

        }

      ?>

</div>
<?php
$lang = function_exists('pll_current_language') ? pll_current_language() : 'en';

if ( $lang === 'en' ) : ?>
  
  <div class="accent-box tq-benefits tq-benefits--dark mt-5 pt-5 pb-5">
    <div class="container">
      <div class="row">
        <div class="col-12 text-center mb-4">
          <h2 class="section-title no-bullet m-0">Team Benefits</h2>
        </div>
      </div>
      <div class="row">
        <?php
        $benefits_en = [
          [ 'icon' => 'benefits-icon-home-office.svg',        'label' => 'Work from home' ],
          [ 'icon' => 'benefits-icon-working-time.svg',       'label' => 'Flexible working hours' ],
          [ 'icon' => 'benefits-icon-medical-insurance.svg',  'label' => '“Best Doctors” insurance' ],
          [ 'icon' => 'benefits-icon-medical-insurance-2.svg','label' => 'Additional health insurance' ],
          [ 'icon' => 'benefits-flexible.svg',                'label' => 'Sports card' ],
          [ 'icon' => 'benefits-icon-employee-support.svg',   'label' => 'Employee Assistance Program' ],
          [ 'icon' => 'benefits-icon-home-office.svg',        'label' => 'Hybrid model' ],
          [ 'icon' => 'benefits-icon-holiday.svg',            'label' => 'Additional paid leave' ],
        ];
        $img_base = trailingslashit( get_template_directory_uri() ) . 'images/';
        foreach ( $benefits_en as $b ) : ?>
          <div class="col-6 col-md-4 col-lg-3 mb-4 text-center">
            <img src="<?php echo esc_url( $img_base . $b['icon'] ); ?>"
                 alt="<?php echo esc_attr( $b['label'] ); ?>"
                 width="80" height="80" class="mb-2" />
            <span class="benefits-label d-block"><?php echo esc_html( $b['label'] ); ?></span>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>

<?php elseif ( $lang === 'fr' ) : ?>

  <div class="accent-box tq-benefits tq-benefits--dark mt-5 pt-5 pb-5">
    <div class="container">
      <div class="row">
        <div class="col-12 text-center mb-4">
          <h2 class="section-title no-bullet m-0">Avantages Équipe</h2>
        </div>
      </div>
      <div class="row">
        <?php
        $benefits_fr = [
          [ 'icon' => 'benefits-icon-home-office.svg',        'label' => 'Télétravail' ],
          [ 'icon' => 'benefits-icon-working-time.svg',       'label' => 'Horaires flexibles' ],
          [ 'icon' => 'benefits-icon-medical-insurance.svg',  'label' => 'Assurance « Best Doctors »' ],
          [ 'icon' => 'benefits-icon-medical-insurance-2.svg','label' => 'Complémentaire santé' ],
          [ 'icon' => 'benefits-flexible.svg',                'label' => 'Carte de sport' ],
          [ 'icon' => 'benefits-icon-employee-support.svg',   'label' => 'Programme d’aide aux employés' ],
          [ 'icon' => 'benefits-icon-home-office.svg',        'label' => 'Modèle hybride' ],
          [ 'icon' => 'benefits-icon-holiday.svg',            'label' => 'Jours de congé supplémentaires' ],
        ];
        $img_base = trailingslashit( get_template_directory_uri() ) . 'images/';
        foreach ( $benefits_fr as $b ) : ?>
          <div class="col-6 col-md-4 col-lg-3 mb-4 text-center">
            <img src="<?php echo esc_url( $img_base . $b['icon'] ); ?>"
                 alt="<?php echo esc_attr( $b['label'] ); ?>"
                 width="80" height="80" class="mb-2" />
            <span class="benefits-label d-block"><?php echo esc_html( $b['label'] ); ?></span>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>

<?php endif; ?>
