<?php
/* Template Name: Careers Page (Clean) */
defined('ABSPATH') || exit;
?>

<div class="container mt-5 pt-5">
  <div class="row">
    <div class="col-12">
      <h1 class="section-title"><?php the_title(); ?></h1>
      <div class="page-content">
        <?php the_content(); ?>
      </div>
    </div>
  </div>
</div>


<?php
// Career news, BG only, category 199
$career_news = new WP_Query(array(
  'post_type'           => 'post',
  'posts_per_page'      => 6,          // use -1 for all, change to 6 if you want a cap
  'cat'                 => 199,
  'orderby'             => 'date',
  'order'               => 'DESC',
  'ignore_sticky_posts' => true,
  'suppress_filters'    => false,       // Polylang
  'lang'                => 'bg'         // Polylang safety
));
if ($career_news->have_posts()) : ?>
  <div class="container mt-5">
    <div class="row">
      <div class="col-12">
        <h2 class="section-title">Кариерни Новини</h2>
      </div>
    </div>
    <div class="row">
      <?php while ($career_news->have_posts()) : $career_news->the_post(); ?>
        <div class="col-lg-4 col-md-6 mb-4">
          <a href="<?php the_permalink(); ?>">
            <img class="img-fluid"
                 src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'medium_large')); ?>"
                 alt="<?php echo esc_attr(get_the_title()); ?>">
            <h3 class="h5 mt-2"><?php the_title(); ?></h3>
          </a>
        </div>
      <?php endwhile; wp_reset_postdata(); ?>
    </div>
  </div>
<?php endif; ?>


<?php if ( (int) get_queried_object_id() === 216 ) : ?>

<div class="accent-box tq-benefits tq-benefits--dark mt-5 pt-5 pb-5">

  <div class="container">
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
</div>



<!-- Careers feature rows -->
<style>
  .tq-vid{position:relative;width:100%;padding-top:56.25%}
  .tq-vid iframe{position:absolute;top:0;left:0;width:100%;height:100%;border:0}
</style>

<div class="container my-5">
  <!-- Row 1 -->
  <div class="row align-items-center mb-5">
    <div class="col-lg-6 mb-3 mb-lg-0" data-aos="fade-up" data-aos-duration="800">
      <h2 class="section-title">Защо TINQIN: Екипна работа</h2>
      <p>В TINQIN вярваме, че успехът идва, когато работим заедно. За нас екипната работа е култура, която подхранва индивидуалния и колективния успех.</p>
      <p>Гордеем се с отличието ни за екипна работа <em>(Teamwork)</em>, както и с третото място в класацията на
        <a href="https://www.tinqin.com/tinqin-e-%d1%81%d1%80%d0%b5%d0%b4-%d0%bd%d0%b0%d0%b9-%d0%b1%d1%8a%d1%80%d0%b7%d0%be-%d1%80%d0%b0%d1%81%d1%82%d1%8f%d1%89%d0%b8%d1%82%d0%b5-it-%d0%ba%d0%be%d0%bc%d0%bf%d0%b0%d0%bd%d0%b8%d0%b8-%d0%b2.html">най-бързо растящите IT компании</a> в България, организирано от Forbes.</p>
    </div>
    <div class="col-lg-6" data-aos="fade-up" data-aos-duration="800" data-aos-delay="150">
      <div class="tq-vid">
        <iframe title="TINQIN Teambuilding 2024" src="https://www.youtube.com/embed/AsMGfoXhBpM" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
      </div>
    </div>
  </div>

  <hr class="my-4">

  <!-- Row 2 -->
  <div class="row align-items-center mb-5">
    <div class="col-lg-6 order-lg-2 mb-3 mb-lg-0" data-aos="fade-up" data-aos-duration="800">
      <h2 class="section-title">Защо TINQIN: Иновативни продукти</h2>
      <p>Разработваме <a href="https://www.tinqin.com/%d0%bf%d1%80%d0%be%d0%b4%d1%83%d0%ba%d1%82%d0%b8">иновативни решения</a> за водещи европейски застрахователни компании.</p>
      <p>Един от ключовите ни продукти е <strong><a href="https://www.kipmi.com/">Kipmi</a></strong>, мобилно приложение, част от европейска платформа за дигитално доверие, електронна идентичност и сигурно подписване на документи.</p>
    </div>
    <div class="col-lg-6 order-lg-1" data-aos="fade-up" data-aos-duration="800" data-aos-delay="150">
      <div class="tq-vid">
        <iframe title="Kipmi - Onboarding" src="https://www.youtube.com/embed/ZFUYohK6QU4" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
      </div>
    </div>
  </div>

  <hr class="my-4">

  <!-- Row 3 -->
  <div class="row align-items-center mb-5">
    <div class="col-lg-6 mb-3 mb-lg-0" data-aos="fade-up" data-aos-duration="800">
      <h2 class="section-title">Защо TINQIN: Международни клиенти</h2>
      <p>Все повече компании, като френския застраховател <strong><a href="https://www.groupe-uneo.fr/">Unéo</a></strong>, избират да работят с нашия център за развойна дейност или да се възползват от нашите <a href="https://www.tinqin.com/%d1%83%d1%81%d0%bb%d1%83%d0%b3%d0%b8">консултантски услуги</a>.</p>
      <p>Партнираме си дългосрочно по сложни бизнес системи, като залагаме на качество, прозрачност и добри практики.</p>
    </div>
    <div class="col-lg-6" data-aos="fade-up" data-aos-duration="800" data-aos-delay="150">
      <div class="tq-vid">
        <iframe title="Unéo Testimonial" src="https://www.youtube.com/embed/pSECV3sTr8s" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
      </div>
    </div>
  </div>
</div>





<?php endif; ?>

