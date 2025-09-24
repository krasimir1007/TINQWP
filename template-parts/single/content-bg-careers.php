<?php
/* Template Name: BG Careers Page */
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

</style>

<div class="container mt-5 pt-5">
  <div class="row">
    <div class="col-12">
      <h1 class="section-title"><?php the_title(); ?></h1>
        <?php the_content(); ?>
    </div>
  </div>
</div>


<?php
// Career news, BG only, category 199
$career_news = new WP_Query(array(
  'post_type'           => 'post',
  'posts_per_page'      => 6,   // use -1 for all, change to 6 if you want a cap
  'cat'                 => 199,
  'orderby'             => 'date',
  'order'               => 'DESC',
  'ignore_sticky_posts' => true,
  'suppress_filters'    => false, // Polylang
  'lang'                => 'bg'   // Polylang safety
));

if ( $career_news->have_posts() ) : ?>
  <div class="container mt-2 container-nopad">
    <div class="row">
      <div class="col-12">
        <h2 class="section-title">Кариерни Новини</h2>
      </div>
    </div>
    <div class="row">
      <?php while ( $career_news->have_posts() ) : $career_news->the_post(); ?>
        <div class="col-lg-4 col-md-6 mb-1">
          <article class="team-panel">
            <a href="<?php the_permalink(); ?>" class="stretched-link">
              <?php if ( has_post_thumbnail() ) : ?>
                <img
                  src="<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'large' ) ); ?>"
                  alt="<?php the_title_attribute(); ?>"
                  class="img-fluid"
                  loading="lazy"
                />
              <?php else : ?>
                <img
                  src="<?php echo esc_url( get_template_directory_uri() . '/img/placeholder-16x9.jpg' ); ?>"
                  alt="<?php the_title_attribute(); ?>"
                  class="img-fluid"
                  loading="lazy"
                />
              <?php endif; ?>

              <div class="card-body">
                <h3 class="card-title"><?php the_title(); ?></h3>
              </div>
            </a>
          </article>
        </div>
      <?php endwhile; wp_reset_postdata(); ?>
    </div>
  </div>
<?php endif; ?>





<?php if ( (int) get_queried_object_id() === 216 ) : ?>

<div class="container tq-benefits tq-benefits--dark mt-3 pt-2 pb-2">


    <div class="row">
      <div class="col-12 text-center mb-4">
        <h2 class="section-title no-bullet m-0">Придобивки за екипа</h2>
      </div>
    </div>

    <?php
    $benefits = [
    ['icon' => 'benefits-icon-home-office.svg',         'label' => 'Работа от вкъщи'],
	      ['icon' => 'benefits-icon-working-time.svg',        'label' => 'Гъвкаво работно време'],
	['icon' => 'benefits-icon-medical-insurance.svg',   'label' => 'Застраховка „Best Doctors“'],
      ['icon' => 'benefits-icon-medical-insurance-2.svg', 'label' => 'Допълнително здравно осигуряване'],
      ['icon' => 'benefits-flexible.svg',                 'label' => 'Карта за спорт'],
      ['icon' => 'benefits-icon-employee-support.svg',    'label' => 'Програма за подпомагане на служителите'],
      ['icon' => 'benefits-icon-home-office.svg',         'label' => 'Хибриден модел'],
      ['icon' => 'benefits-icon-holiday.svg',             'label' => 'Допълнителни дни отпуск'],
    ];
    ?>

    <div class="row">
      <?php foreach ($benefits as $b) : ?>
        <div class="col-6 col-md-4 col-lg-3 mb-4 text-center">
          <img
            src="<?php echo esc_url( get_template_directory_uri() . '/images/' . $b['icon'] ); ?>"
            alt="<?php echo esc_attr( $b['label'] ); ?>"
            width="80" height="80" class="mb-2"
          />
          <span class="benefits-label d-block"><?php echo esc_html( $b['label'] ); ?></span>
        </div>
      <?php endforeach; ?>
    </div>

</div>




<div class="container my-5">

     <?php
      // Child page holds Gutenberg Columns: left .copy, right .video
      if ($video_page = get_page_by_path('career-videos-bg')) {
        $orig_post = $post; $post = $video_page; setup_postdata($post);
        the_content();                                   // no extra wrappers
        wp_reset_postdata(); $post = $orig_post;
      }
    ?>


<?php endif; ?>

</div>