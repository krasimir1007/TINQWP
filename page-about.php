<?php
/* Template Name: About */
get_header();

if ( have_posts() ) :
  while ( have_posts() ) : the_post(); ?>

<style>
/* Force team cards full-width background on small screens */
@media (max-width: 767px) {
  .row.spacing-bottom-s .col-md-6 {
    flex: 0 0 100% !important;
    max-width: 100% !important;
  }

  .card.card-teams {
    width: 100% !important;
  }

  .card.card-teams .card-body {
    background-size: cover !important;   /* cover instead of contain */
    background-position: center center !important;
    min-height: 250px;                   /* ensures the image shows enough height */
  }
}
</style>


    <div class="container mt-5 pt-3 pt-lg-5">
      <div class="row">
        <div class="col-12">
          <h2 class="section-title"><?php pll_e('Защо да избереш TINQIN'); ?></h2>
          <?php the_content(); ?>
        </div>
      </div>
    </div>
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
    <!-- Founders -->
    <div class="container mb-4 pt-3 mt-1 pt-lg-2">
      <div class="row">
        <div class="col-12" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
          <h2 class="section-title mb-3"><?php pll_e('Няколко думи от нашите основатели'); ?></h2>
        </div>
      </div>
      <div class="row">
        <div class="col-12" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="350">
          <?php
          $statement_id = function_exists('pll_get_post') ? pll_get_post(65) : 65;
          $statement    = $statement_id ? get_post($statement_id) : null;
          if ( $statement ) :
            $title   = get_the_title($statement);
            $content = apply_filters('the_content', $statement->post_content);
          ?>
			<picture>
			  <!-- Mobile first (max-width 767px) -->
			  <source 
				srcset="<?php echo esc_url( get_template_directory_uri().'/images/Francois-and-Jean-Charles-Miginiac2.webp' ); ?>" 
				media="(max-width: 767px)" 
				type="image/webp">
			  
			  <!-- Default / Desktop -->
			  <img 
				src="<?php echo esc_url( get_template_directory_uri().'/images/Francois-and-Jean-Charles-Miginiac.webp' ); ?>" 
				class="img-fluid w-100" 
				alt="TINQIN founders" 
				loading="lazy" 
				decoding="async">
			</picture>

            <h4 class="fat-title mt-4"><?php echo esc_html($title); ?></h4>
            <?php echo $content; ?>
          <?php endif; ?>
        </div>
      </div>
    </div>


	
    <!-- Team -->	
	
    <div class="container mt-5">
      <div class="row">
        <div class="col-12 mb-3" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
          <h2 class="section-title"><?php pll_e('Tinqin екип'); ?></h2>
          <p class="section-subtitle"><?php pll_e('Запознай се с екипа ни'); ?></p>
        </div>
      </div>

      <div class="row spacing-bottom-s">
        <?php
        $teams = get_posts([
          'post_type'      => 'teams',
          'numberposts'    => -1,
          'orderby'        => 'menu_order',
          'order'          => 'ASC',
        ]);
        if ( $teams ) {
          $delay = 350;
          foreach ( $teams as $team ) : ?>
            <div class="col-lg-3 col-md-6 mb-4 d-flex align-items-stretch"
                 data-aos="fade-up" data-aos-duration="1000" data-aos-delay="<?php echo esc_attr($delay); ?>">
              <a href="<?php echo esc_url( get_permalink($team->ID) ); ?>"
                 class="card list-item card-teams <?php echo esc_attr( rwmb_meta('tq-team-card-class','',$team->ID) ); ?> <?php echo esc_attr( rwmb_meta('tq-team-gradient-class','',$team->ID) ); ?>">
                <div class="card-body" style="background-image:url('<?php echo esc_url( get_the_post_thumbnail_url($team->ID,'large') ); ?>')">
                  <div class="card-body-content">
                    <div class="card-image pb-2"></div>
                    <h3 class="card-title fat-title mb-3"><?php echo esc_html( $team->post_title ); ?></h3>
                    <p class="card-text"><?php echo esc_html( $team->post_excerpt ); ?></p>
                  </div>
                </div>
              </a>
            </div>
          <?php
            $delay += 150;
          endforeach;
          wp_reset_postdata();
        }
        ?>
      </div>
    </div>



<?php
  endwhile;
endif;

get_footer();
