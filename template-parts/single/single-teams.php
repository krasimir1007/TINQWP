<?php
/** single-teams.php — v2025-08-26-2 (no $post dependency) */
if (!defined('ABSPATH')) exit;

$post_id = get_queried_object_id();
$lang    = function_exists('pll_get_post_language') ? pll_get_post_language($post_id) : '';
$titleimg = rwmb_meta('tq-team-title-bgr', [], $post_id);

function tq_https($url){ return esc_url( set_url_scheme((string)$url, 'https') ); }

/* Chart data */
$pie_labels = array_filter(array_map('trim', explode(',', (string) rwmb_meta('tq-team-data-pie-labels', [], $post_id))));
$pie_values = array_map('trim', explode(',', (string) rwmb_meta('tq-team-data-pie-values', [], $post_id)));
$pie_colors_raw = trim((string) rwmb_meta('tq-team-data-pie-colors', [], $post_id));
$pie_colors = [];
if ($pie_colors_raw !== '') {
  $json = json_decode($pie_colors_raw, true);
  $pie_colors = is_array($json) ? $json : array_map('trim', explode(',', $pie_colors_raw));
}
if (empty($pie_colors)) { $pie_colors = ['#CE3531', '#5b6570', '#f3f4f6']; }

/* Jobs (query early so we can use its emptiness for spacing) */
$jobs = get_posts([
  'post_type'    => 'jobs',
  'numberposts'  => 4,
  'orderby'      => 'rand',
  'post__not_in' => [$post_id],
  'meta_query'   => [[
    'key'     => 'tq-jobs-team',
    'value'   => $post_id,
    'compare' => '=',
    'type'    => 'TEXT',
  ]],
]);
?>
<div class="container mt-5 pt-5 mb-5">
  <div class="row">
    <div class="col-12">
      <div class="clipped-title text-center">
        <?php if ($titleimg): ?>
          <img src="<?php echo tq_https($titleimg); ?>" style="width:100%" />
        <?php endif; ?>
        <h1><?php the_title(); ?></h1>
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
      <div class="col-12 pt-2 mt-5 pt-2 mb-3" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
        <h2 class="section-title mt-3 mb-3"><?php pll_e('Опознай ни... с факти'); ?></h2>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-12">
        <div class="row">

          <!-- Juniors vs Seniors / PM vs PMO -->
          <div class="col-md-6 mb-4 team-chart" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="350">
            <h4 class="mb-4 pb-2">
              <?php $count_mode = rwmb_meta('tq-team-specific-title-count', [], $post_id);
                echo ($count_mode === 'pmvspmo') ? pll__('Проектни ръководители vs. PMOs') : pll__('Младши vs. Старши'); ?>
            </h4>
            <div class="d-flex align-items-center">
              <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/team.svg" style="width:28%" />
              <div class="ml-4">
                <h4 class="counter"><?php echo esc_html( rwmb_meta('tq-team-data-juniors', [], $post_id) ); ?></h4>
                <span class="counter-subtitle">
                  <?php echo ($count_mode === 'pmvspmo') ? pll__('проектни ръководители') : pll__('младши'); ?>
                </span>
              </div>
              <div class="ml-4">
                <h4 class="counter"><?php echo esc_html( rwmb_meta('tq-team-data-seniors', [], $post_id) ); ?></h4>
                <span class="counter-subtitle">
                  <?php echo ($count_mode === 'pmvspmo') ? 'PMOs' : pll__('старши'); ?>
                </span>
              </div>
            </div>
          </div>

          <!-- Doughnut chart -->
          <div class="col-md-6 mb-4 pt-3-small team-chart" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="500">
            <h4 class="mb-2"><?php pll_e('Години в компанията'); ?></h4>
            <div class="chart-container" style="position:relative;height:auto;width:320px">
              <canvas id="PieChart"></canvas>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js" defer></script>
            <script>
              document.addEventListener('DOMContentLoaded', function(){
                var el = document.getElementById('PieChart'); if(!el) return;
                var ctx = el.getContext('2d');
                new Chart(ctx, {
                  type: 'doughnut',
                  data: {
                    labels: <?php echo wp_json_encode($pie_labels); ?>,
                    datasets: [{
                      data: <?php echo wp_json_encode($pie_values); ?>,
                      backgroundColor: <?php echo wp_json_encode($pie_colors); ?>,
                      borderWidth: 0
                    }]
                  },
                  options: {
                    plugins: {
                      legend: {
                        position: 'right',
                        labels: { color: 'rgb(0,0,0)', font: { size: 14, family: 'Montserrat' }, boxWidth: 15 }
                      }
                    }
                  }
                });
              });
            </script>
          </div>

          <!-- Trophies -->
          <div class="col-md-6 mb-4 mt-4 mt-2-small team-chart" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="650">
            <h4 class="mb-4 "><?php pll_e('Спечелини трофеи в TINQIN игрите'); ?></h4>
            <div class="d-flex align-items-center">
              <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/awards.svg" style="width:28%" />
              <div class="ml-4">
                <h4 class="counter"><?php echo esc_html( rwmb_meta('tq-team-data-trophies', [], $post_id) ); ?></h4>
                <span class="counter-subtitle"><?php pll_e('... и още предстоят'); ?></span>
              </div>
            </div>
          </div>

          <!-- Team-specific metric -->
          <div class="col-md-6 mb-4 mt-4 pt-3-small team-chart" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="800">
            <h4 class="mb-4 "><?php pll_e( (string) rwmb_meta('tq-team-specific-title', [], $post_id) ); ?></h4>
            <div class="d-flex align-items-center">
              <?php
                $icon_files = rwmb_meta('tq-team-specific-icon', ['limit'=>1], $post_id);
                $icon_file  = is_array($icon_files) ? reset($icon_files) : null;
                $icon_url   = $icon_file['url'] ?? '';
                if ($icon_url): ?>
                  <img src="<?php echo tq_https($icon_url); ?>" style="width:28%" />
              <?php endif; ?>
              <div class="ml-4">
                <h4 class="counter"><?php echo esc_html( rwmb_meta('tq-team-data-team-specific', [], $post_id) ); ?></h4>
                <span class="counter-subtitle"><?php pll_e('... mil'); ?></span>
              </div>
            </div>
          </div>

        </div><!-- /.row -->
      </div>
    </div>
  </div>
</div>

<?php
/* Technologies — fix key (latin 'e'), https, pass post_id; fallback to legacy misspelling */
$technologies = rwmb_meta('tq-team-technologies-used', [], $post_id);
if (empty($technologies)) { $technologies = rwmb_meta('tq-team-tеchnologies-used', [], $post_id); }
if (!empty($technologies)): ?>
  <div class="load-anim" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="800">
    <div class="container mt-3 mb-3">
<section class="customer-logos customer-logos-teams grid">
  <?php foreach ((array)$technologies as $technology):
    $logo = isset($technology['url']) ? tq_https($technology['url']) : '';
    if (!$logo) continue; ?>
    <div class="slide"><img src="<?php echo $logo; ?>" alt=""></div>
  <?php endforeach; ?>
</section>

    </div>
  </div>
<?php endif; ?>

<?php if (rwmb_meta('tq-team-specific-title-count', [], $post_id) !== 'pmvspmo'): ?>
  <div class="accent-box pt-5 pb-5 <?php echo empty($jobs) ? 'mt-5' : ''; ?>">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 pb-4 mb-5 mt-4 text-center" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
          <h1><?php pll_e('Тези лога ти говорят нещо?'); ?></h1>
          <h4><?php pll_e('Прегледай кариерния план в този екип'); ?></h4>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-10 mb-4 offset-lg-1 text-center">
          <div class="row mt-3">
            <div class="col-md-4 text-center" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="350">
              <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/user-basic.svg" style="height:100px;" />
              <h4 class="mt-3 font-weight-700"><?php echo esc_html( rwmb_meta('tq-team-data-career-step-1', [], $post_id) ); ?></h4>
              <h6><?php echo esc_html( rwmb_meta('tq-team-data-career-xp-step-1', [], $post_id) ); ?> <?php pll_e('години'); ?></h6>
            </div>
            <div class="col-md-4 pt-3-small text-center" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="500">
              <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/user-mid.svg" style="height:100px;" />
              <h4 class="mt-3 font-weight-700"><?php echo esc_html( rwmb_meta('tq-team-data-career-step-2', [], $post_id) ); ?></h4>
              <h6><?php echo esc_html( rwmb_meta('tq-team-data-career-xp-step-2', [], $post_id) ); ?> <?php pll_e('години'); ?></h6>
            </div>
            <div class="col-md-4 pt-3-small text-center" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="650">
              <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/user-high.svg" style="height:100px;" />
              <h4 class="mt-3 font-weight-700"><?php echo esc_html( rwmb_meta('tq-team-data-career-step-3', [], $post_id) ); ?></h4>
              <h6><?php echo esc_html( rwmb_meta('tq-team-data-career-xp-step-3', [], $post_id) ); ?> <?php pll_e('години'); ?></h6>
            </div>
          </div>
        </div>
      </div>
    </div><!-- /.container -->
  </div>
<?php endif; ?>

<?php if (!empty($jobs)): ?>
  <div class="container mb-5 pb-3 pt-5 mt-5 no-padding-small">
    <div class="row">
      <div class="col-12" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
        <h2 class="section-title">
          <?php pll_e('Нашият екип', 'tinqin'); ?> <?php the_title(); ?>
          <?php pll_e('екипът ни търси също и...', 'tinqin'); ?>
        </h2>
        <p class="section-subtitle">
          <?php pll_e('Не искаме нищо по-малко от най-добрите хора за нашия екип. Искаш да си част от него? Кандидатствай сега!', 'tinqin'); ?>
        </p>
      </div>
    </div>
    <div class="row">
      <?php $delay = 350; foreach ($jobs as $position): ?>
        <div class="col-lg-4 col-md-6 mb-2 jobs-panel d-flex align-items-lg-stretch align-items-md-stretch"
             data-aos="fade-up" data-aos-duration="1000" data-aos-delay="<?php echo (int)$delay; ?>">
          <a href="<?php echo esc_url( get_permalink($position->ID) ); ?>"
             class="card list-item card-jobs <?php echo esc_attr( rwmb_meta('tq-team-card-class', [], $post_id) ); ?>">
            <div class="card-body">
              <h5 class="card-title fat-title"><?php echo esc_html($position->post_title); ?></h5>
              <p class="card-text"><?php echo esc_html( rwmb_meta('tq-jobs-team-label', '', $position->ID) ); ?></p>
              <button class="btn btn-primary btn-lg btn-white"><?php pll_e('Кандидатствай'); ?></button>
            </div>
          </a>
        </div>
      <?php $delay += 150; endforeach; ?>
    </div>
  </div>
<?php endif; ?>

<div class="container mt-5 mb-5">
  <div class="row">
    <div class="col-12 mb-3" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
      <h2 class="section-title"><?php pll_e('Запознай се с другите ни екипи', 'tinqin'); ?></h2>
      <p class="section-subtitle"><?php pll_e('Запознай се с екипа ни', 'tinqin'); ?></p>
    </div>
  </div>

  <div class="row spacing-bottom-s">
    <?php
      $teams = get_posts([
        'post_type'    => 'teams',
        'numberposts'  => -1,
        'exclude'      => $post_id
      ]);
      if ($teams):
        $delay = 350;
        foreach ($teams as $team):
          $thumb = tq_https( get_the_post_thumbnail_url($team->ID, 'full') );
          $card_class = trim((string) rwmb_meta('tq-team-card-class', '', $team->ID));
          $grad_class = trim((string) rwmb_meta('tq-team-gradient-class', '', $team->ID));
    ?>
      <div class="col-lg-4 col-md-4 mb-4 d-flex align-items-lg-stretch align-items-md-stretch"
           data-aos="fade-up" data-aos-duration="1000" data-aos-delay="<?php echo (int)$delay; ?>">
        <a href="<?php echo esc_url( get_permalink($team->ID) ); ?>"
           class="card list-item card-teams <?php echo esc_attr($card_class . ' ' . $grad_class); ?>">
          <div class="card-body" style="background-image:url('<?php echo $thumb; ?>') !important">
            <div class="card-body-content">
              <div class="card-image pb-2"></div>
              <h3 class="card-title fat-title mb-3"><?php echo esc_html($team->post_title); ?></h3>
              <p class="card-text"><?php echo esc_html($team->post_excerpt); ?></p>
            </div>
          </div>
        </a>
      </div>
    <?php
        $delay += 150;
        endforeach;
      endif;
    ?>
  </div>
</div>
