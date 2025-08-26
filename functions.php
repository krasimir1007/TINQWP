<?php
/*************************************************
 * ASSETS: single, clean enqueue with scoping
 *************************************************/

/** 1) Remove jquery-migrate dep (front only) */
add_action('wp_default_scripts', function ($scripts) {
  if (!is_admin() && isset($scripts->registered['jquery'])) {
    $scripts->registered['jquery']->deps = []; // no jquery-migrate
  }
});

/** 2) Re-register core jQuery (minified) in footer (front only) */
add_action('wp_enqueue_scripts', function () {
  if (is_admin()) return;
  wp_deregister_script('jquery');
  // Core minified jQuery from WordPress includes (footer)
  wp_register_script('jquery', includes_url('/js/jquery/jquery.min.js'), [], null, true);
}, 5);

/** 3) KILL Gutenberg/block CSS on the FRONT END (robust) */
add_action('init', function () {
  if (is_admin()) return;

  // Unhook core actions that enqueue block/global styles very early
  if (has_action('wp_enqueue_scripts', 'wp_common_block_scripts_and_styles')) {
    remove_action('wp_enqueue_scripts', 'wp_common_block_scripts_and_styles');
  }
  if (function_exists('wp_enqueue_global_styles') && has_action('wp_enqueue_scripts', 'wp_enqueue_global_styles')) {
    remove_action('wp_enqueue_scripts', 'wp_enqueue_global_styles');
  }
  if (function_exists('wp_enqueue_classic_theme_styles') && has_action('wp_enqueue_scripts', 'wp_enqueue_classic_theme_styles')) {
    remove_action('wp_enqueue_scripts', 'wp_enqueue_classic_theme_styles');
  }
}, 0);

// Belt & suspenders: dequeue/deregister late in the chain in case plugins re-add them
add_action('wp_enqueue_scripts', function () {
  if (is_admin()) return;

  $handles = [
    'wp-block-library',
    'wp-block-library-theme',
    'global-styles',           // theme.json front-end CSS
    'classic-theme-styles',    // WP 6.x classic theme CSS
    'gutenberg-block-library', // Gutenberg plugin (if active)
    'wc-block-style',          // WooCommerce blocks
    'wc-blocks-style',
  ];

  foreach ($handles as $h) {
    wp_dequeue_style($h);
    wp_deregister_style($h);
  }
}, 999);

/** 4) Page‑scoped assets (example placeholder) */
function tinqin_enqueue_about_assets() {
  if (is_page([63, 336, 652])) {
    // Example:
    // wp_enqueue_style('slick', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css', [], '1.8.1');
    // wp_enqueue_script('slick', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js', ['jquery'], '1.8.1', true);
  }
}
add_action('wp_enqueue_scripts', 'tinqin_enqueue_about_assets', 30);

/** 5) Optionally REMOVE assets on pages that don’t need them */
function tinqin_dequeue_home_extras() {
  if (is_front_page()) {
    // If you don’t need jQuery on the home page:
    // wp_dequeue_script('jquery');

    // If no Bootstrap JS components used on home:
    // wp_dequeue_script('bootstrap-bundle');

    // If the hamburger CSS is only used on inner pages:
    // wp_dequeue_style('hamburgers');
  }
}
add_action('wp_enqueue_scripts', 'tinqin_dequeue_home_extras', 99);

/** 6) Add defer to specific non-critical scripts (expand list as needed) */
function tinqin_defer_scripts($tag, $handle) {
  $defer_handles = ['slick', 'aos', 'chart'];
  if (in_array($handle, $defer_handles, true)) {
    $tag = str_replace(' src', ' defer src', $tag);
  }
  return $tag;
}
add_filter('script_loader_tag', 'tinqin_defer_scripts', 10, 2);

/** 7) DNS prefetch (optional) */
function tinqin_dns_hints() {
  echo '<link rel="dns-prefetch" href="https://cdnjs.cloudflare.com">' . "\n";
  echo '<link rel="dns-prefetch" href="https://cdn.jsdelivr.net">' . "\n";
  echo '<link rel="dns-prefetch" href="https://stackpath.bootstrapcdn.com">' . "\n";
}
add_action('wp_head', 'tinqin_dns_hints', 1);

/** 8) Global assets (Bootstrap CSS + local theme CSS; Bootstrap JS bundle in footer) */
add_action('wp_enqueue_scripts', function () {
  // Fonts & core styles
  wp_enqueue_style('tinqin-fonts', 'https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&family=Montserrat:wght@400;500;600;700;800;900&display=swap', [], null);
  wp_enqueue_style('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css', [], '4.5.2');
  wp_enqueue_style('hamburgers', get_template_directory_uri() . '/css/hamburgers.css', [], null);
  wp_enqueue_style('tinqin', get_template_directory_uri() . '/css/tinqin.css', ['bootstrap','hamburgers'], filemtime(get_stylesheet_directory() . '/css/tinqin.css'));

  // Core scripts
  wp_enqueue_script('jquery'); // uses the footer-registered core jQuery above
  wp_enqueue_script('bootstrap-bundle', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js', ['jquery'], '4.5.2', true);
});

/** 9) Remove WP block editor frontend CSS on home as an extra guard (safe duplicate) */
add_action('wp_enqueue_scripts', function () {
  if (is_front_page()) {
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('global-styles');
    wp_dequeue_style('classic-theme-styles');
    wp_dequeue_style('wc-block-style');
    wp_dequeue_style('wc-blocks-style');
  }
}, 100);


// Function to align WP Menus to bootstrap 4
require_once('bs4navwalker.php');

// Post thumbnail support
add_theme_support( 'post-thumbnails' );
add_post_type_support( 'page', 'excerpt' );

// Registering all menus needed by the theme
function myp_menus() {
  register_nav_menu('primary-menu',__( 'Primary Menu' ));
  register_nav_menu('top-menu',__( 'Top Menu' ));
  register_nav_menu('mobile-menu',__( 'Mobile Menu' ));
  register_nav_menu('footer-1-menu',__( 'Footer Column 1 Menu' ));
  register_nav_menu('footer-2-menu',__( 'Footer Column 2 Menu' ));
  register_nav_menu('footer-3-menu',__( 'Footer Column 3 Menu' ));
  register_nav_menu('cookie-policy-menu',__( 'Cookie Policy Menu' ));
}
add_action( 'init', 'myp_menus' );


// Latest 3 posts for single posts, excludes Careers and the current post
function tq_latest_posts_html() {
  $exclude = array(199, 201, 203);
  $current_id = get_the_ID();
  $lang = function_exists('pll_current_language') ? pll_current_language('slug') : '';

  $q = new WP_Query(array(
    'post_type'           => 'post',
    'posts_per_page'      => 3,
    'post__not_in'        => array($current_id),
    'ignore_sticky_posts' => true,
    'category__not_in'    => $exclude,
    'suppress_filters'    => false,       // Polylang
    'lang'                => $lang        // Polylang
  ));
  if (!$q->have_posts()) return '';

  ob_start(); ?>
  <div class="container mt-5">
    <div class="row">
      <div class="col-12">
        <h2 class="section-title"><?php echo function_exists('pll__') ? pll__('Latest from TINQIN') : 'Latest from TINQIN'; ?></h2>
      </div>
    </div>
    <div class="row">
      <?php while ($q->have_posts()) : $q->the_post(); ?>
        <div class="col-lg-4 col-md-6 mb-4">
          <a href="<?php echo esc_url(get_permalink()); ?>">
            <img class="img-fluid" src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'medium')); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
            <h3 class="h5 mt-2"><?php echo esc_html(get_the_title()); ?></h3>
          </a>
        </div>
      <?php endwhile; wp_reset_postdata(); ?>
    </div>
  </div>
  <?php
  return ob_get_clean();
}





// Register sidebars
function theme_sidebars() {

  register_sidebar( array(
    'name'          => 'Post Sidebar',
    'id'            => 'post-sidebar',
    'description'   => 'This sidebar is visible in both the single post view and the archive views (if selected)',
    'class'         => '',
    'before_widget' => '<div id="%1$s" class="sidebar-area %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h2 class="section-title sidebar-title">',
    'after_title'   => '</h2>' 
  ) );
  register_sidebar( array(
    'name'          => 'Social Icons',
    'id'            => 'social-sidebar',
    'description'   => 'This sidebar is situated in the footer and is used to display the social icons',
    'class'         => '',
    'before_widget' => '<div id="%1$s" class="social-icons %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '',
    'after_title'   => '' 
  ) );
}
add_action( 'widgets_init', 'theme_sidebars' );

// Register and load the widget
function tinqin_load_widgets() {
    register_widget( 'tinqin_widget_recent_posts' );
    register_widget( 'tinqin_widget_show_services' );
    register_widget( 'tinqin_widget_show_social' );
}
add_action( 'widgets_init', 'tinqin_load_widgets' );

// Custom sidebars
class tinqin_widget_recent_posts extends WP_Widget {
 
    function __construct() {
        parent::__construct( 'tinqin_widget_recent_posts', __('TINQIN Recent posts'), array( 'description' => __( 'Use this widget to display recent TINQIN news' ), ) 
        );
    }     
    public function widget( $args, $instance ) {
        echo $args['before_widget'];
        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }

        $selected_posts = get_posts(
            array(
                'lang'          => pll_current_language(),
                'post_type'     => 'post',
                'numberposts'   => 3
            )
        );
        ?>
        <div class="row">
        <?php $delay = 200; foreach ( $selected_posts as $post ) { ?>
            <div class="col-md-4 mb-2" data-aos="fade-up" data-aos-duration='1000' data-aos-delay='<?php echo $delay; ?>'>
                <div class="card team-panel">
                  <a href="<?php echo get_permalink( $post->ID ); ?>" style="overflow: hidden; height: 200px;"><img class="card-img-top" src="<?php echo get_the_post_thumbnail_url( $post->ID ) ?>" alt="<?php echo $post->post_title; ?>" /></a>
                  <div class="card-body">
                    <small class="mt-1 post-date"><i class="fas fa-calendar-alt"></i> <?php echo get_the_date( false, $post->ID ); ?></small>
                    <a href="<?php echo get_permalink( $post->ID ); ?>"><h5 class="mt-2  card-title"><?php echo $post->post_title; ?></h5></a>
                  </div>
                </div>
            </div>

        <?php 
			$delay = $delay + 150;
		} ?>
        </div>
        <?php
        echo $args['after_widget'];
    }
             
    // Widget Backend 
    public function form( $instance ) {
        if ( isset( $instance ) ) {
            // Widget title
            $title = $instance[ 'title' ];

        }
        // Widget admin form        
        ?>
        <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <?php
    }
         
    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        return $instance;
    }
}
class tinqin_widget_show_services extends WP_Widget {
 
    function __construct() {
        parent::__construct( 'tinqin_widget_show_services', __('TINQIN Services'), array( 'description' => __( 'Use this widget to display recent TINQIN news' ), ) 
        );
    }     
    public function widget( $args, $instance ) {
        echo $args['before_widget'];
        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }

        $selected_posts = get_posts(
            array(
                'lang'          => pll_current_language(),
                'post_type'     => 'solutions',
                'numberposts'   => -1
            )
        );
        ?>
        <div class="card">
          <ul class="list-group list-group-flush">
        <?php foreach ( $selected_posts as $post ) { ?>
            <li class="list-group-item">
                <a href="<?php echo get_permalink( $post->ID ); ?>"><?php echo $post->post_title; ?></a>
            </li>
        <?php } ?>
          </ul>
        </div>
        <?php
        echo $args['after_widget'];
    }
             
    // Widget Backend 
    public function form( $instance ) {
        if ( isset( $instance ) ) {
            // Widget title
            $title = $instance[ 'title' ];

        }
        // Widget admin form        
        ?>
        <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <?php
    }
         
    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        return $instance;
    }
}
class tinqin_widget_show_social extends WP_Widget {
 
    function __construct() {
        parent::__construct( 'tinqin_widget_show_social', __('Social Footer Icons'), array( 'description' => __( 'Use this widget to display social icons' ), ) 
        );
    }     
    public function widget( $args, $instance ) {
        echo $args['before_widget'];

        if( $instance['facebook'] ){
            ?>
            <a href="<?php echo $instance['facebook'] ?>" target="_blank" class="facebook"><i class="fab fa-facebook-f"></i></a>
            <?php
        }
        if( $instance['instagram'] ){
            ?>
            <a href="<?php echo $instance['instagram'] ?>" target="_blank" class="instagram"><i class="fab fa-instagram"></i></a>
            <?php
        }
        if( $instance['twitter'] ){
            ?>
            <a href="<?php echo $instance['twitter'] ?>" target="_blank" class="twitter"><i class="fab fa-twitter"></i></a>
            <?php
        }
        if( $instance['linkedin'] ){
            ?>
            <a href="<?php echo $instance['linkedin'] ?>" target="_blank" class="linkedin"><i class="fab fa-linkedin-in"></i></a>
            <?php
        }
        if( $instance['youtube'] ){
            ?>
            <a href="<?php echo $instance['youtube'] ?>" target="_blank" class="youtube"><i class="fab fa-youtube"></i></a>
            <?php
        }

        echo $args['after_widget'];
    }
             
    // Widget Backend 
    public function form( $instance ) {
        if ( isset( $instance ) ) {
            // Widget title

            $fb = $instance[ 'facebook' ];
            $tw = $instance[ 'twitter' ];
            $li = $instance[ 'linkedin' ];
            $yt = $instance[ 'youtube' ];
            $ig = $instance[ 'instagram' ];

        }
        // Widget admin form        
        ?>
        <p>
        <label for="<?php echo $this->get_field_id( 'facebook' ); ?>"><?php _e( 'Facebook URL:' ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" type="text" value="<?php echo esc_attr( $fb ); ?>" />
        </p>
        <p>
        <label for="<?php echo $this->get_field_id( 'twitter' ); ?>"><?php _e( 'Twitter URL:' ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>" type="text" value="<?php echo esc_attr( $tw ); ?>" />
        </p>
        <p>
        <label for="<?php echo $this->get_field_id( 'instagram' ); ?>"><?php _e( 'Instagram URL:' ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'instagram' ); ?>" name="<?php echo $this->get_field_name( 'instagram' ); ?>" type="text" value="<?php echo esc_attr( $ig ); ?>" />
        </p>
        <p>
        <label for="<?php echo $this->get_field_id( 'linkedin' ); ?>"><?php _e( 'LinkedIn URL:' ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'linkedin' ); ?>" name="<?php echo $this->get_field_name( 'linkedin' ); ?>" type="text" value="<?php echo esc_attr( $li ); ?>" />
        </p>
        <p>
        <label for="<?php echo $this->get_field_id( 'youtube' ); ?>"><?php _e( 'YouTUbe URL:' ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'youtube' ); ?>" name="<?php echo $this->get_field_name( 'youtube' ); ?>" type="text" value="<?php echo esc_attr( $yt ); ?>" />
        </p>
        <?php
    }
         
    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['facebook'] = ( ! empty( $new_instance['facebook'] ) ) ? strip_tags( $new_instance['facebook'] ) : '';
        $instance['twitter'] = ( ! empty( $new_instance['twitter'] ) ) ? strip_tags( $new_instance['twitter'] ) : '';
        $instance['linkedin'] = ( ! empty( $new_instance['linkedin'] ) ) ? strip_tags( $new_instance['linkedin'] ) : '';
        $instance['youtube'] = ( ! empty( $new_instance['youtube'] ) ) ? strip_tags( $new_instance['youtube'] ) : '';
        $instance['instagram'] = ( ! empty( $new_instance['instagram'] ) ) ? strip_tags( $new_instance['instagram'] ) : '';
        return $instance;
    }
}

// Custom post types
function set_tq_post_type() {
 
    register_post_type( 'teams',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Teams' ),
                'singular_name' => __( 'Team' )
            ),
            'public'        => true,
            'has_archive'   => true,
            'hierarchical'  => true,
            'supports'      => array( 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes' ),
            'show_in_rest'  => true,
            'rewrite'       => array('slug' => 'teams'),
        )
    ); 
    register_post_type( 'solutions',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Offers' ),
                'singular_name' => __( 'Offer' )
            ),
            'public'        => true,
            'has_archive'   => true,
            'hierarchical'  => true,
            'supports'      => array( 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes' ),
            'show_in_rest'  => true,
            'rewrite'       => array('slug' => 'offers'),
        )
    );
    register_post_type( 'consulting',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Consulting items' ),
                'singular_name' => __( 'Consulting' )
            ),
            'public'        => true,
            'has_archive'   => true,
            'hierarchical'  => true,
            'supports'      => array( 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes' ),
            'show_in_rest'  => true,
            'rewrite'       => array('slug' => 'consulting'),
        )
    );
    register_post_type( 'jobs',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Jobs' ),
                'singular_name' => __( 'Job' )
            ),
            'public'        => true,
            'has_archive'   => true,
            'hierarchical'  => true,
            'supports'      => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
            'show_in_rest'  => true,
            'rewrite'       => array('slug' => 'careers'),
        )
    );
    register_post_type( 'testimonials',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Clients' ),
                'singular_name' => __( 'Clients' )
            ),
            'public'        => true,
            'has_archive'   => true,
            'hierarchical'  => true,
            'supports'      => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
            'show_in_rest'  => true,
            'rewrite'       => array('slug' => 'testimonial'),
        )
    ); 
    register_post_type( 'staff',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Staff' ),
                'singular_name' => __( 'Staff' )
            ),
            'public'        => true,
            'has_archive'   => true,
            'hierarchical'  => true,
            'supports'      => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
            'show_in_rest'  => true,
            'rewrite'       => array('slug' => 'staff'),
        )
    );	
    register_post_type( 'products',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Products' ),
                'singular_name' => __( 'Product' )
            ),
            'public'        => true,
            'has_archive'   => true,
            'hierarchical'  => true,
            'supports'      => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
            'show_in_rest'  => true,
            'rewrite'       => array('slug' => 'product'),
        )
    ); 
}
// Hooking up our function to theme setup
add_action( 'init', 'set_tq_post_type' );

// add tag support to pages
function tags_support_all() {
    register_taxonomy_for_object_type('post_tag', 'page');
}

// ensure all tags are included in queries
function tags_support_query($wp_query) {
    if ($wp_query->get('tag')) $wp_query->set('post_type', 'any');
}

// tag hooks
add_action('init', 'tags_support_all');
add_action('pre_get_posts', 'tags_support_query');
add_action('admin_head', 'my_custom_fonts');

function my_custom_fonts() {
  echo '<style>
    .rwmb-text {
      width: 100%;
    } 
  </style>';
}

// Register strings
function register_strings() {

   // register our translatable strings - again first check if function exists.

    if ( function_exists( 'pll_register_string' ) ) {
        // Home page panel
		pll_register_string( 'LatestPostsTitle', 'Latest from TINQIN', 'tinqin', false );

        pll_register_string( '05 HomePanelMainText',        'TINQIN е екипът, от който застрахователният ти бизнес се нуждае, за да е функционален, адаптивен и красив', 'tinqin', false );
        pll_register_string( '06 HomePanelTitle',           'Можеш да разчиташ на TINQIN. Ето защо...', 'tinqin', false );
        pll_register_string( '07 HomePanelTitle1',          'Познаваме клиентите ти, познаваме бизнеса ти! Нашите консултантите са на твое разположение!', 'tinqin', false );
        pll_register_string( '08 HomePanelTitle2',          'Използваме последните и най-добри технологии, не следваме модите - създаваме ги!', 'tinqin', false );
        pll_register_string( '09 HomePanelTitle3',          'Фокусирани сме върху качеството и доброто изживяване за крайния потребител! Клиентите и служителите ти до заслужават!', 'tinqin', false );

        // Home page service panel
        pll_register_string( '10 ServicePanelTitle',        'Какво предлагаме',                 'tinqin', false );
        pll_register_string( '11 ServicePanelSubtitle',     'Създаваме застрахователен софтуер: бек и фронт офис системи, публични уеб сайтове, интегрираме и съществуващи решение - можем всичко!', 'tinqin', false );
        pll_register_string( '12 TeamPanelTitle',           'Как постигаме целите си',          'tinqin', false );
        pll_register_string( '13 TeamPanelSubtitle',        'В TINQIN вярваме, че всичко е постижимо. Ето защо изградихме екип от млади, мотивирани, талантливи и иновативни експерти.', 'tinqin', false );

        // Home page buttons
        pll_register_string( '14 GetQuoteBtn',              'Поискай оферта',                   'tinqin', false );
        pll_register_string( '15 MeetTheTeamBtn',           'Запознай се с екипа',              'tinqin', false );

        // Testimonials
        pll_register_string( '16 TestimonialsTitle',        'Стани един от доволните ни клиенти!','tinqin', false );

        // Teams
        pll_register_string( '17 TeamsDataTitle',           'Опознай ни... с факти',            'tinqin', false );
        pll_register_string( '18 TeamsJuniorvsSeniorTitle', 'Младши vs. Старши',                'tinqin', false );
        pll_register_string( '18 TeamsJuniorvsSeniorTitle', 'Проектни ръководители vs. PMOs',   'tinqin', false );
		pll_register_string( '18 TeamsJunior', 				'младши',                			'tinqin', false );
		pll_register_string( '18 TeamsSenior', 				'старши',                			'tinqin', false );
		pll_register_string( '18 TeamsSenior', 				'проектни ръководители',            'tinqin', false );
        pll_register_string( '19 TeamsExperienceTitle',     'Години в компанията',              'tinqin', false );
		pll_register_string( '19 TeamdCodeLine', 			'... mil',                			'tinqin', false );
        pll_register_string( '20 TeamsTinqinTrophies',      'Спечелини трофеи в TINQIN игрите', 'tinqin', false );
        pll_register_string( '21 TeamsTrophiesCounting',    '... и още предстоят',              'tinqin', false );
        pll_register_string( '22 TeamsCodeRowsTitle',       'Редове написан код',               'tinqin', false );
        pll_register_string( '23 TeamsTestsPerformed',      'Брой проведени тестове',           'tinqin', false );
        pll_register_string( '24 TeamsTasksDelegated',      'Брой дадени задачи',               'tinqin', false );
        pll_register_string( '25 TeamsDocumentPages',       'Написани страници документация',   'tinqin', false );
        pll_register_string( '25 TeamsMockupsDrawn',        'Брой нарисувани модели',   		'tinqin', false );
        pll_register_string( '26 TeamTechnologyTitle',      'Постигаме всичко това с...',       'tinqin', false );
        pll_register_string( '27 TeamCareerPlanTitle',      'Тези лога ти говорят нещо?',       'tinqin', false );
        pll_register_string( '28 TeamCareerPlanSubtitle',   'Прегледай кариерния план в този екип','tinqin', false );
        pll_register_string( '28 TeamOtherTeamsPanel',   	'Запознай се с другите ни екипи',	'tinqin', false );
        pll_register_string( '29 GeneralTerms_Year',        'години',                           'tinqin', false );
		pll_register_string( '29 Staff_Title',        		'Нашите колеги споделят...',        'tinqin', false );

        // Careers
        pll_register_string( '30 CareersPageSubtitle',      'Създаваме застрахователния софтуер на бъдещето. Присъедини се към нас!', 'tinqin', false );
        pll_register_string( '31 CareersOpenPositions',     'Отворени позиции',                 'tinqin', false );
        pll_register_string( '32 CareersLocationBulgaria',  'България',                         'tinqin', false );
        pll_register_string( '33 CareersLocationFrance',    'Франция',                          'tinqin', false );
        pll_register_string( '34 CareersNoPositions',       'В момента нямаме отворени позии за','tinqin', false );
        pll_register_string( '35 CareersEmailPosition',     'Можете да изпратите своето CV на', 'tinqin', false );
        pll_register_string( '36 CareersCTASubtitle',       'Мислиш, че си правилният човек за тази позиция? Кандидатствай сега!', 'tinqin', false );
        pll_register_string( '37 CareersDevelopmenTitle',   'Изгради кариерата си в TINQIN', 'tinqin', false );
        pll_register_string( '38 CareersDevelopmenSubtitle','Развивай себе си, създавай с нас', 'tinqin', false );
        pll_register_string( '39 CareersApplyTitle',        'Кандидатствай сега', 'tinqin', false );
        pll_register_string( '40 CareersApplySubitle',      'Изпрати ни своето CV, портфолио и мотивационно писмо на ', 'tinqin', false );
		pll_register_string( '41 CareersAlsoLookingTitlePrefix',  'Нашият екип', 'tinqin', false );
        pll_register_string( '41 CareersAlsoLookingTitle',  'екипът ни търси също и...', 'tinqin', false );
        pll_register_string( '42 CareersAlsoLookingSubtitle','Не искаме нищо по-малко от най-добрите хора за нашия екип. Искаш да си част от него? Кандидатствай сега!', 'tinqin', false );
		pll_register_string( '42 CareersBenefits Title',  	'Нашият екип се наслаждава на...', 'tinqin', false );
		pll_register_string( '42 CareersBenefits 01',  		'Застраховка „Best doctors“', 'tinqin', false );
		pll_register_string( '42 CareersBenefits 02',  		'Гъвкаво работно време', 'tinqin', false );
		pll_register_string( '42 CareersBenefits 03',  		'Допълнителни дни отпуск', 'tinqin', false );
		pll_register_string( '42 CareersBenefits 04',  		'Ваучери за храна', 'tinqin', false );
		pll_register_string( '42 CareersBenefits 05',  		'Допълнително здравно осигуряване', 'tinqin', false );
		pll_register_string( '42 CareersBenefits 06',  		'Работа от вкъщи', 'tinqin', false );
		pll_register_string( '42 CareersBenefits 07',  		'Карта за спорт', 'tinqin', false );
		pll_register_string( '42 CareersBenefits 08',  		'Програма за подпомагане на служителите', 'tinqin', false );
		
		pll_register_string( 'Language alterations',  		'Искаш ли да си част от нашия страхотен екип в София? Кандидатствай сега!', 'tinqin', false );
		pll_register_string( 'Language alterations',  		'Искаш ли да си част от нашия страхотен екип във Варна? Кандидатствай сега!', 'tinqin', false );

        // About page
        pll_register_string( '43 AboutTitle',            	'Защо да избереш TINQIN','tinqin', false );
        pll_register_string( '43 AboutFounders',            'Няколко думи от нашите основатели','tinqin', false );
        pll_register_string( '44 AboutFoundersSubtitle',    'Основният ни екип е базиран в София, България','tinqin', false );
		pll_register_string( '79 AboutFoundersSubtitle',    'Tinqin екип','tinqin', false );

        // Services page
        pll_register_string( '80 ServicesTitle',   			'Как създаваме софтуерните си решения?','tinqin', false );
		pll_register_string( '81 ServicesTitle2',   		'Фокусираме се върху изискванията на клиента и ги обличаме в иновации','tinqin', false );
        pll_register_string( '45 ServicesLifecicleStep1',   'Определяме клиентските изисквания','tinqin', false );
        pll_register_string( '46 ServicesLifecicleStep2',   'Създаваме прототипи и определяме бюджет','tinqin', false );
        pll_register_string( '47 ServicesLifecicleStep3',   'Започваме разработката','tinqin', false );
        pll_register_string( '48 ServicesClientsUsingThis', 'От тази услуга се възползваха...','tinqin', false );	

        // Consultations page
        pll_register_string( '49 ConsultationsSubtitle',    'В TINQIN познаваме застрахователния бизнес и можем да ти помогнем да развиеш твоя','tinqin', false );

        // News
        pll_register_string( '50 NewsSubtitle',             'Компанията ни се развива',         'tinqin', false );

        // Footer
        pll_register_string( '51 FooterDescription',        'TINQIN е софтуерна компания, специализираща в услугите и разработките за застрахователния пазар. Компанията е базирана в София, а клиентската поддръжка и отделът ни за продажби - в Париж.', 'tinqin', false );
		pll_register_string( '52 FooterTitle',        		'Иновирай с нас', 'tinqin', false );
		pll_register_string( '53 FooteColumnTitle1',        'Навигация', 'tinqin', false );
		pll_register_string( '54 FooteColumnTitle2',        'Услуги', 'tinqin', false );
		pll_register_string( '55 FooteColumnTitle3',        'Продукти', 'tinqin', false );
		pll_register_string( '56 FooteColumnTitle4',        'Последвай ни', 'tinqin', false );
		pll_register_string( '57 GetInTouch',        		'Свържи се с нас', 'tinqin', false );
		
		// All teams
		pll_register_string( '58 Meet the team',        	'Запознай се с екипа ни', 'tinqin', false );
		
		// Contacts
		pll_register_string( '59 Maps title',        		'Локации', 'tinqin', false );
		pll_register_string( '60 Contact form title',       'Свържи се с нас', 'tinqin', false );
		pll_register_string( '61 Contact form submit button','Изпрати', 'tinqin', false );
		pll_register_string( '62 TINQIN sales title',        'TINQIN продажби', 'tinqin', false );
		pll_register_string( '63 TINQIN careers title',      'TINQIN кариери', 'tinqin', false );
		
		// Form labels
		pll_register_string( '64 Form label - Name',		'Име', 'tinqin', false );
		pll_register_string( '65 Form label - Company name','Име на компанията', 'tinqin', false );
		pll_register_string( '66 Form label - email',		'Email', 'tinqin', false );
		pll_register_string( '67 Form label - Company mail','Служебен Email', 'tinqin', false );
		pll_register_string( '68 Form label - Phone',		'Телефон', 'tinqin', false );
		pll_register_string( '69 Form label - Location',	'Локация', 'tinqin', false );
		pll_register_string( '70 Form label - messagel',	'Съобщение', 'tinqin', false );
		pll_register_string( '71 Select default value', 	'Избери...', 'tinqin', false );
		pll_register_string( '72 Form label - Interested',	'Аз съм...', 'tinqin', false );
		pll_register_string( '73 Form label - CV upload',	'Прикачи CV', 'tinqin', false );
		pll_register_string( '73 Form label - File label',	'Избери файл', 'tinqin', false );
		pll_register_string( '74 Form label - Apply button','Кандидатствай', 'tinqin', false );
		pll_register_string( '75 Form label - Request button','Поискай оферта', 'tinqin', false );
		pll_register_string( '75 Form label - Concent',		'Данните Ви ще бъдат използвани само за обработка на питането Ви', 'tinqin', false );
		pll_register_string( '75 Form label - Concent 2',	'Данните Ви ще бъдат използвани само за обработка на кандидатурата Ви', 'tinqin', false );
		pll_register_string( '75 Form label - Concent 3',	'за целите на разглеждане и преценка на моята кандидатура, както и провеждане на процедури по набиране и подбор на персонал.', 'tinqin', false );
		
		pll_register_string( '76 Job location - Sofia',		'София, България', 'tinqin', false );
		pll_register_string( '77 Job location - Varna',		'Варна, България', 'tinqin', false );
		pll_register_string( '78 Job location - Paris',		'Париж, Франция', 'tinqin', false );
		pll_register_string( '79 Job team', 				'Други...', 'tinqin', false );

		pll_register_string( '84 Referral',	'Препоръчан/а съм от...', 'tinqin', false );
        pll_register_string( '84 Referral',	'Име на TINQIN служителя', 'tinqin', false );
        pll_register_string( '84 Referral',	'Email на TINQIN служителя', 'tinqin', false );
		
		// Form titles
		pll_register_string( '76 Form title - Careers',		'Изпрати ни своето CV', 'tinqin', false );
		pll_register_string( '77 Form title - Job apply',	'Кандидатствай за тази позиция', 'tinqin', false );
		pll_register_string( '78 Form title - Solutions and products','Поискайте оферта', 'tinqin', false );
		
		// 404
		pll_register_string( '79 404 title',				'Не намираме тази страница', 'tinqin', false );		
		pll_register_string( '79 404 message',				'Наскоро променихме сайта си. Може това, което търсиш да се е преместило някъде другаде.', 'tinqin', false );
				
		// Products
		pll_register_string( '84 Products title',			'Продуктите и решенията на TINQIN са предпочитани от лидерите в застрахователия бизнес', 'tinqin', false );
		pll_register_string( '80 Module products',			'Модулни приложения', 'tinqin', false );
		pll_register_string( '81 Module products subtitle',	'Надстройте офисните си системи с конфигуратори, работещи за Вас', 'tinqin', false );
		pll_register_string( '82 Accelerator products',		'Ускорители', 'tinqin', false );
		pll_register_string( '83 Accelerator products subtitle', 'Всичко, от което един застрахователен бизнес има нужда', 'tinqin', false );
    }
}
 add_action( 'after_setup_theme', 'register_strings' );

function teams_field( $meta_boxes ) {
    $prefix = 'tq-';
    $meta_boxes[]       = array(
        'id'            => 'team_',
        'title'         => esc_html__( 'Team Details', 'tinqin' ),
        'post_types'    => array('teams' ),
        'context'       => 'advanced',
        'priority'      => 'default',
        'autosave'      => 'false',
        'fields'        => array(
            array(
                'id'    => $prefix . 'team-palette-class',
                'type'  => 'text',
                'name'  => esc_html__( 'Body class for this team', 'tinqin' ),
                'desc'  => esc_html__( 'Input the CSS class, that will be applied to the body tag in order to render the team in the correct color palette.', 'tinqin' ),
            ),
			            array(
                'id'    => $prefix . 'team-gradient-class',
                'type'  => 'text',
                'name'  => esc_html__( 'Body class for this gradient', 'tinqin' ),
                'desc'  => esc_html__( 'Input the CSS class, that will be applied to the body tag in order to render the team in the correct gradient.', 'tinqin' ),
            ),
            array(
                'id'    => $prefix . 'team-card-class',
                'type'  => 'text',
                'name'  => esc_html__( 'Class for cards in the team\'s palette', 'tinqin' ),
                'desc'  => esc_html__( 'Input the CSS class, that will be applied to cards for job offers for this team.', 'tinqin' ),
            ),
            array(
                'id'    => $prefix . 'team-title-bgr',
                'type'  => 'file_input',
                'name'  => esc_html__( 'Title Background', 'tinqin' ),
                'desc'  => esc_html__( 'Upload the image you\'d like to appear in the team\'s title', 'tinqin' ),
            ),
            array(
                'id' => $prefix . 'team-specific-title-count',
                'name' => esc_html__( 'Choose the first chart title', 'tinqin' ),
                'type' => 'select',
                'placeholder' => esc_html__( 'Choose first chart title', 'tinqin' ),
                'options' => array(
                    'svj' => esc_html__( 'Juniors vs. Seniors', 'tinqin' ),
                    'pmvspmo' => esc_html__( 'Project managers vs. PMOs', 'tinqin' ),
                ),
            ),
            array(
                'id'    => $prefix . 'team-data-juniors',
                'type'  => 'number',
                'name'  => esc_html__( 'First chart number 1', 'tinqin' ),
                'desc'  => esc_html__( 'Input the 1st number for the first chart', 'tinqin' ),
            ),
            array(
                'id'    => $prefix . 'team-data-seniors',
                'type'  => 'number',
                'name'  => esc_html__( 'First chart number 2', 'tinqin' ),
                'desc'  => esc_html__( 'Input the 2nd number for the first chart', 'tinqin' ),
            ),
            array(
                'id'    => $prefix . 'team-data-trophies',
                'type'  => 'number',
                'name'  => esc_html__( 'Number of TINQIN Game wins', 'tinqin' ),
                'desc'  => esc_html__( 'Input the number of wins the team has scored', 'tinqin' ),
            ),
            array(
                'id'    => $prefix . 'team-data-pie-labels',
                'type'  => 'text',
                'name'  => esc_html__( 'Experience (years)', 'tinqin' ),
                'desc'  => esc_html__( 'Input the labels for the experience pie chart', 'tinqin' ),
                'std'   => '<1, 1 - 3, 3 - 5, 5+',
            ),
            array(
                'id'    => $prefix . 'team-data-pie-values',
                'type'  => 'text',
                'name'  => esc_html__( 'Experience (years)', 'tinqin' ),
                'desc'  => esc_html__( 'Input the values for the experience pie charts', 'tinqin' ),
            ),
            array(
                'id'    => $prefix . 'team-data-pie-colors',
                'type'  => 'text',
                'name'  => esc_html__( 'Pie colors', 'tinqin' ),
                'desc'  => esc_html__( 'Input escapred hex codes for the pie chart\'s colours, separated with commas. Example: \'#158693\', \'#189EAD\', \'#1CB6C7\', \'#116475\'', 'tinqin' ),
            ),
            array(
                'id'    => $prefix . 'team-specific-icon',
                'type'  => 'file_upload',
                'name'  => esc_html__( 'Choose the icon for the last chart title', 'tinqin' ),
                'desc'  => esc_html__( 'Upload the image as .svg', 'tinqin' ),
            ),
            array(
                'id' => $prefix . 'team-specific-title',
                'name' => esc_html__( 'Choose the chart title', 'tinqin' ),
                'type' => 'select',
                'placeholder' => esc_html__( 'Choose chart title', 'tinqin' ),
                'options' => array(
                    'Редове написан код' => esc_html__( 'Number of code lines written', 'tinqin' ),
                    'Брой проведени тестове' => esc_html__( 'Number of tests performed', 'tinqin' ),
                    'Брой дадени задачи' => esc_html__( 'Number of tasks delegated', 'tinqin' ),
                    'Написани страници документация' => esc_html__( 'Number of documentation pages written', 'tinqin' ),
                    'Брой нарисувани модели' => esc_html__( 'Number of mockups drawn', 'tinqin' ),
                ),
            ),
            array(
                'id'    => $prefix . 'team-data-team-specific',
                'type'  => 'text',
                'name'  => esc_html__( 'Number of Team specific value', 'tinqin' ),
                'desc'  => esc_html__( 'Input the number of the team specific field', 'tinqin' ),
            ),
            array(
                'id'    => $prefix . 'team-data-career-step-1',
                'type'  => 'text',
                'name'  => esc_html__( 'Career plan Step 1', 'tinqin' ),
                'desc'  => esc_html__( 'Input the lowest position in the career plan', 'tinqin' ),
            ),
            array(
                'id'    => $prefix . 'team-data-career-xp-step-1',
                'type'  => 'text',
                'name'  => esc_html__( 'Step 1 Experince', 'tinqin' ),
                'desc'  => esc_html__( 'Input the Experience eligable for Step 1', 'tinqin' ),
            ),
            array(
                'id'    => $prefix . 'team-data-career-step-2',
                'type'  => 'text',
                'name'  => esc_html__( 'Career plan Step 2', 'tinqin' ),
                'desc'  => esc_html__( 'Input the medium position in the career plan', 'tinqin' ),
            ),
            array(
                'id'    => $prefix . 'team-data-career-xp-step-2',
                'type'  => 'text',
                'name'  => esc_html__( 'Step 2 Experince', 'tinqin' ),
                'desc'  => esc_html__( 'Input the Experience eligable for Step 2', 'tinqin' ),
            ),
            array(
                'id'    => $prefix . 'team-data-career-step-3',
                'type'  => 'text',
                'name'  => esc_html__( 'Career plan Step 3', 'tinqin' ),
                'desc'  => esc_html__( 'Input the highest position in the career plan', 'tinqin' ),
            ),
            array(
                'id'    => $prefix . 'team-data-career-xp-step-3',
                'type'  => 'text',
                'name'  => esc_html__( 'Step 3 Experince', 'tinqin' ),
                'desc'  => esc_html__( 'Input the Experience eligable for Step 1', 'tinqin' ),
            ),
            array(
                'id'    => $prefix . 'team-tеchnologies-used',
                'type'  => 'file_upload',
                'name'  => esc_html__( 'Technologies', 'tinqin' ),
                'desc'  => esc_html__( 'Upload the logos of the technologies, used by that team', 'tinqin' ),
            ),
        ),
    );

    return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'teams_field' );

function careers_field( $meta_boxes ) {
    $prefix = 'tq-';
    $meta_boxes[]       = array(
        'id'            => 'careers_',
        'title'         => esc_html__( 'Job Details', 'tinqin' ),
        'post_types'    => array('jobs' ),
        'context'       => 'advanced',
        'priority'      => 'default',
        'autosave'      => 'false',
        'fields'        => array(
			
						array(
                'id'    => $prefix . 'career-palette-class',
                'type'  => 'text',
                'name'  => esc_html__( 'Body class for this position', 'tinqin' ),
                'desc'  => esc_html__( 'Input the CSS class, that will be applied to the body tag in order to render the solution in the correct color palette.', 'tinqin' ),
            ),
            array(
                'id'    => $prefix . 'career-card-class',
                'type'  => 'text',
                'name'  => esc_html__( 'Class for cards in the position\'s palette', 'tinqin' ),
                'desc'  => esc_html__( 'Input the CSS class, that will be applied to cards for solutions lists etc.', 'tinqin' ),
            ),
			
			
            array(
                'id' => $prefix . 'jobs-location',
                'name' => esc_html__( 'Choose job location', 'tinqin' ),
                'type' => 'select',
                'placeholder' => esc_html__( 'Choose job location', 'tinqin' ),
                'options' => array(
                    'България' => esc_html__( 'Bulgaria', 'tinqin' ),
                    'Франция' => esc_html__( 'France', 'tinqin' )
                ),
            ),
            array(
                'id' => $prefix . 'jobs-location-city',
                'name' => esc_html__( 'Choose city (only if Bulgaria is selected)', 'tinqin' ),
                'desc'  => esc_html__( 'Select the city where this job offer applies for. If nothing is selected, the job will be listed as Sofia or Varna', 'online-generator' ),
                'type' => 'select',
                'placeholder' => esc_html__( 'Select city', 'tinqin' ),
                'options' => array(
                    'Sofia' => esc_html__( 'Sofia', 'tinqin' ),
                    'Varna' => esc_html__( 'Varna', 'tinqin' )
                ),
            ),
            array(
                'id' => $prefix . 'jobs-team',
                'type' => 'post',
                'name' => esc_html__( 'Choose Team for this position', 'tinqin' ),
                'post_type' => 'teams',
                'field_type' => 'radio_list',
            ),
            array(
                'id' => $prefix . 'jobs-team-label',
                'type'    => 'select',
                'name' 	  => esc_html__( 'Choose label for this position\'s listing', 'tinqin' ),
                'desc'    => esc_html__( 'Choose the label depicted under the job position', 'online-generator' ),
                'options' => [
                    'Business Analyst' => esc_html__( 'Business Analyst', 'online-generator' ),
                    'Back-End'         => esc_html__( 'Back-End', 'online-generator' ),
                    'Frond-End'        => esc_html__( 'Frond-End', 'online-generator' ),
					'Developer'        => esc_html__( 'Developer', 'online-generator' ),
                    'PMO'              => esc_html__( 'PMO', 'online-generator' ),
                    'Project Manager'  => esc_html__( 'Project Manager', 'online-generator' ),
                    'UX Designer'      => esc_html__( 'UX Designer', 'online-generator' ),
                    'Web Designer'     => esc_html__( 'Web Designer', 'online-generator' ),
                ],
            ),
            array(
                'id'    => $prefix . 'jobs-data-career-step-1',
                'type'  => 'text',
                'name'  => esc_html__( 'Career level current position', 'tinqin' ),
                'desc'  => esc_html__( 'Input the career level of the current position', 'tinqin' ),
            ),
            array(
                'id'    => $prefix . 'jobs-data-career-xp-step-1',
                'type'  => 'text',
                'name'  => esc_html__( 'Step 1 Experince', 'tinqin' ),
                'desc'  => esc_html__( 'Input the Experience eligable for Step 1', 'tinqin' ),
            ),
            array(
                'id'    => $prefix . 'jobs-data-career-step-2',
                'type'  => 'text',
                'name'  => esc_html__( 'Following career level', 'tinqin' ),
                'desc'  => esc_html__( 'Input the following career level from the current position', 'tinqin' ),
            ),
            array(
                'id'    => $prefix . 'jobs-data-career-xp-step-2',
                'type'  => 'text',
                'name'  => esc_html__( 'Step 2 Experince', 'tinqin' ),
                'desc'  => esc_html__( 'Input the Experience eligable for Step 2', 'tinqin' ),
            ),
            array(
                'id'    => $prefix . 'jobs-data-career-step-3',
                'type'  => 'text',
                'name'  => esc_html__( 'Final careers level', 'tinqin' ),
                'desc'  => esc_html__( 'Input the highest career level', 'tinqin' ),
            ),
            array(
                'id'    => $prefix . 'jobs-data-career-xp-step-3',
                'type'  => 'text',
                'name'  => esc_html__( 'Step 3 Experince', 'tinqin' ),
                'desc'  => esc_html__( 'Input the Experience eligable for Step 1', 'tinqin' ),
            ),
        ),
    );

    return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'careers_field' );

function solutions_field( $meta_boxes ) {
    $prefix = 'tq-';
    $meta_boxes[]       = array(
        'id'            => 'solutions_',
        'title'         => esc_html__( 'Solution Details', 'tinqin' ),
        'post_types'    => array( 'solutions' ),
        'context'       => 'advanced',
        'priority'      => 'default',
        'autosave'      => 'false',
        'fields'        => array(
			array(
                'id'    => $prefix . 'solution-palette-class',
                'type'  => 'text',
                'name'  => esc_html__( 'Body class for this solution', 'tinqin' ),
                'desc'  => esc_html__( 'Input the CSS class, that will be applied to the body tag in order to render the solution in the correct color palette.', 'tinqin' ),
            ),
            array(
                'id'    => $prefix . 'solution-card-class',
                'type'  => 'text',
                'name'  => esc_html__( 'Class for cards in the solution\'s palette', 'tinqin' ),
                'desc'  => esc_html__( 'Input the CSS class, that will be applied to cards for solutions lists etc.', 'tinqin' ),
            ),
             array(
                'id'    => $prefix . 'solution-icon',
                'type'  => 'file_upload',
                'name'  => esc_html__( 'Consulting item icon', 'tinqin' ),
                'desc'  => esc_html__( 'Upload the icon you wish to be displayed in the list with solutions', 'tinqin' ),
             ),
        ),
    );

    return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'solutions_field' );

function consulting_field( $meta_boxes ) {
    $prefix = 'tq-';
    $meta_boxes[]       = array(
        'id'            => 'consulting_',
        'title'         => esc_html__( 'Consulting Item Details', 'tinqin' ),
        'post_types'    => array('consulting' ),
        'context'       => 'advanced',
        'priority'      => 'default',
        'autosave'      => 'false',
        'fields'        => array(
			array(
                'id'    => $prefix . 'consulting-palette-class',
                'type'  => 'text',
                'name'  => esc_html__( 'Body class for this consulting item', 'tinqin' ),
                'desc'  => esc_html__( 'Input the CSS class, that will be applied to the body tag in order to render the consulting item in the correct color palette.', 'tinqin' ),
            ),
            array(
                'id'    => $prefix . 'consulting-card-class',
                'type'  => 'text',
                'name'  => esc_html__( 'Class for cards in the solution\'s palette', 'tinqin' ),
                'desc'  => esc_html__( 'Input the CSS class, that will be applied to cards for consulting item lists etc.', 'tinqin' ),
            ),
             array(
                'id'    => $prefix . 'consulting-icon',
                'type'  => 'file_upload',
                'name'  => esc_html__( 'Consulting item icon', 'tinqin' ),
                'desc'  => esc_html__( 'Upload the icon you wish to be displayed in the list with consulting items', 'tinqin' ),
             ),
        ),
    );

    return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'consulting_field' );

function products_field( $meta_boxes ) {
    $prefix = 'tq-';
    $meta_boxes[]       = array(
        'id'            => 'products_',
        'title'         => esc_html__( 'Product Details', 'tinqin' ),
        'post_types'    => array( 'products' ),
        'context'       => 'advanced',
        'priority'      => 'default',
        'autosave'      => 'false',
        'fields'        => array(
            array(
                'id'    => $prefix . 'product-type',
                'type'  => 'radio',
				'options' => [
                    'ma' => esc_html__( 'Modular apps', 'online-generator' ),
                    'ac' => esc_html__( 'Accelerators', 'online-generator' ),
                ],
                'name'  => esc_html__( 'Product type', 'tinqin' ),
                'desc'  => esc_html__( 'Choose a product type to prep it for grouping on the page', 'tinqin' ),
            ),
			array(
                'id'    => $prefix . 'product-palette-class',
                'type'  => 'text',
                'name'  => esc_html__( 'Body class for this product', 'tinqin' ),
                'desc'  => esc_html__( 'Input the CSS class, that will be applied to the body tag in order to render the product in the correct color palette.', 'tinqin' ),
            ),
            array(
                'id'    => $prefix . 'product-card-class',
                'type'  => 'text',
                'name'  => esc_html__( 'Class for cards in the product\'s palette', 'tinqin' ),
                'desc'  => esc_html__( 'Input the CSS class, that will be applied to cards for product lists etc.', 'tinqin' ),
            ),
             array(
                'id'    => $prefix . 'product-icon',
                'type'  => 'file_upload',
                'name'  => esc_html__( 'Consulting item icon', 'tinqin' ),
                'desc'  => esc_html__( 'Upload the icon you wish to be displayed in the list with products', 'tinqin' ),
             ),
        ),
    );

    return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'products_field' );

function clients_field( $meta_boxes ) {
    $prefix = 'tq-';
    $meta_boxes[]       = array(
        'id'            => 'solutions_',
        'title'         => esc_html__( 'Client Details', 'tinqin' ),
        'post_types'    => array('testimonials' ),
        'context'       => 'advanced',
        'priority'      => 'default',
        'autosave'      => 'false',
        'fields'        => array(
            array(
                'id' => $prefix . 'client-testimonial',
                'name' => esc_html__( 'This client has givven a testimonial', 'metabox-online-generator' ),
                'type' => 'checkbox',
                'desc' => esc_html__( 'Check if you want this client\'s post content to be shown on the Home page' , 'metabox-online-generator' ),
            ),
        ),
    );

    return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'clients_field' );

function staff_field( $meta_boxes ) {
    $prefix = 'tq-';
    $meta_boxes[]       = array(
        'id'            => 'staff_',
        'title'         => esc_html__( 'Staff Details', 'tinqin' ),
        'post_types'    => array('staff' ),
        'context'       => 'advanced',
        'priority'      => 'default',
        'autosave'      => 'false',
        'fields'        => array(
            array(
                'id' => $prefix . 'staff-team',
                'type' => 'post',
                'name' => esc_html__( 'Choose Team for this staff member', 'tinqin' ),
                'post_type' => 'teams',
                'field_type' => 'radio_list',
            ),
            array(
                'id' => $prefix . 'staff-position',
                'type'  => 'text',
                'name'  => esc_html__( 'Staff position', 'tinqin' ),
                'desc'  => esc_html__( 'Input the position of the staff member. It will appear under their name' , 'tinqin' ),
            ),
        ),
    );

    return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'staff_field' );

// Mail content composer
function return_mail_content( $name, $mail, $phone, $message, $type = 'contact-form', $post_id = null, $location = null, $team = null ){

	switch( $type ){
		case 'contact-form':

			$origin 		= 'TINQIN\'s Contact page';
			$content 		= '<table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt !important;mso-table-rspace: 0pt !important;border-spacing: 0 !important;border-collapse: collapse !important;table-layout: fixed !important;">
					<tr style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
						<td valign="middle" class="bg_light footer email-section" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background: #fafafa;padding: 1.5em;border-top: 1px solid rgba(0,0,0,.05);color: rgba(0,0,0,.5);mso-table-lspace: 0pt !important;mso-table-rspace: 0pt !important;">
								<table style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt !important;mso-table-rspace: 0pt !important;border-spacing: 0 !important;border-collapse: collapse !important;table-layout: fixed !important;margin: 0 auto !important;">
										<tr style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
											<td valign="top" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt !important;mso-table-rspace: 0pt !important;">
												<table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt !important;mso-table-rspace: 0pt !important;border-spacing: 0 !important;border-collapse: collapse !important;table-layout: fixed !important;margin: 0 auto !important;">
													<tr style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
														<td style="text-align: left;padding-right: 10px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt !important;mso-table-rspace: 0pt !important;">
															<h3 class="heading" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;font-family: \'Lato\', sans-serif;color: #000;margin-top: 0;font-weight: 400;font-size: 20px;">Sender</h3>
															<p style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">' . $name . '</p>
														</td>
													</tr>
												</table>
											</td>
											<td valign="top" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt !important;mso-table-rspace: 0pt !important;">
												<table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt !important;mso-table-rspace: 0pt !important;border-spacing: 0 !important;border-collapse: collapse !important;table-layout: fixed !important;margin: 0 auto !important;">
													<tr style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
														<td style="text-align: left;padding-left: 5px;padding-right: 5px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt !important;mso-table-rspace: 0pt !important;">
															<h3 class="heading" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;font-family: \'Lato\', sans-serif;color: #000;margin-top: 0;font-weight: 400;font-size: 20px;">Contact Info</h3>
															<ul style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;margin: 0;padding: 0;">
																<li style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;list-style: none;margin-bottom: 10px; margin-left: 0; padding-left: 0;">
																	<span class="text" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">' . $mail . '</span>
																</li>
																<li style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;list-style: none;margin-bottom: 10px; margin-left: 0; padding-left: 0;">
																	<span class="text" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">' . $phone . '</span>
																</li>
															</ul>
														</td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>';
		break;
		case 'service-products-form':

			$origin 		= 'TINQIN\'s Services & Products catalogue';
			$permalink 		= get_permalink( $post_id );
			$item_name		= get_the_title( $post_id );
			$content 		= '<table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt !important;mso-table-rspace: 0pt !important;border-spacing: 0 !important;border-collapse: collapse !important;table-layout: fixed !important;">
					<tr style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
						<td valign="middle" class="bg_light footer email-section" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background: #fafafa;padding: 1.5em;border-top: 1px solid rgba(0,0,0,.05);color: rgba(0,0,0,.5);mso-table-lspace: 0pt !important;mso-table-rspace: 0pt !important;">
								<table style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt !important;mso-table-rspace: 0pt !important;border-spacing: 0 !important;border-collapse: collapse !important;table-layout: fixed !important;margin: 0 auto !important;">
										<tr style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
											<td valign="top" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt !important;mso-table-rspace: 0pt !important;">
												<table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt !important;mso-table-rspace: 0pt !important;border-spacing: 0 !important;border-collapse: collapse !important;table-layout: fixed !important;margin: 0 auto !important;">
													<tr style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
														<td style="text-align: left;padding-right: 10px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt !important;mso-table-rspace: 0pt !important;">
															<h3 class="heading" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;font-family: \'Lato\', sans-serif;color: #000;margin-top: 0;font-weight: 400;font-size: 20px;">Sender</h3>
															<p style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">' . $name . '</p>
														</td>
													</tr>
													<tr style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
														<td style="text-align: left;padding-right: 10px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt !important;mso-table-rspace: 0pt !important;">
															<h3 class="heading" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;font-family: \'Lato\', sans-serif;color: #000;margin-top: 0;font-weight: 400;font-size: 20px;">Interested in</h3>
															<p style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;"><a href="' . $permalink . '" style="color: #cd3532; text-decoration: underline;">' . $item_name . '</a></p>
														</td>
													</tr>
												</table>
											</td>
											<td valign="top" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt !important;mso-table-rspace: 0pt !important;">
												<table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt !important;mso-table-rspace: 0pt !important;border-spacing: 0 !important;border-collapse: collapse !important;table-layout: fixed !important;margin: 0 auto !important;">
													<tr style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
														<td style="text-align: left;padding-left: 5px;padding-right: 5px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt !important;mso-table-rspace: 0pt !important;">
															<h3 class="heading" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;font-family: \'Lato\', sans-serif;color: #000;margin-top: 0;font-weight: 400;font-size: 20px;">Contact Info</h3>
															<ul style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;margin: 0;padding: 0;">
																<li style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;list-style: none;margin-bottom: 10px; margin-left: 0; padding-left: 0;">
																	<span class="text" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">' . $mail . '</span>
																</li>
																<li style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;list-style: none;margin-bottom: 10px; margin-left: 0; padding-left: 0;">
																	<span class="text" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">' . $phone . '</span>
																</li>
															</ul>
														</td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>';
		break;
		case 'general-application-form':

			$origin 		= 'TINQIN\'s Careers Page';
			$content 		= '<table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt !important;mso-table-rspace: 0pt !important;border-spacing: 0 !important;border-collapse: collapse !important;table-layout: fixed !important;">
					<tr style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
						<td valign="middle" class="bg_light footer email-section" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background: #fafafa;padding: 1.5em;border-top: 1px solid rgba(0,0,0,.05);color: rgba(0,0,0,.5);mso-table-lspace: 0pt !important;mso-table-rspace: 0pt !important;">
								<table style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt !important;mso-table-rspace: 0pt !important;border-spacing: 0 !important;border-collapse: collapse !important;table-layout: fixed !important;margin: 0 auto !important;">
										<tr style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
											<td valign="top" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt !important;mso-table-rspace: 0pt !important;">
												<table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt !important;mso-table-rspace: 0pt !important;border-spacing: 0 !important;border-collapse: collapse !important;table-layout: fixed !important;margin: 0 auto !important;">
													<tr style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
														<td style="text-align: left;padding-right: 10px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt !important;mso-table-rspace: 0pt !important;">
															<h3 class="heading" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;font-family: \'Lato\', sans-serif;color: #000;margin-top: 0;font-weight: 400;font-size: 20px;">Sender</h3>
															<p style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">' . $name . '</p>
														</td>
													</tr>
													<tr style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
														<td style="text-align: left;padding-right: 10px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt !important;mso-table-rspace: 0pt !important;">
															<h3 class="heading" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;font-family: \'Lato\', sans-serif;color: #000;margin-top: 0;font-weight: 400;font-size: 20px;">Applied for</h3>
															<ul style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;margin: 0;padding: 0;">
																<li style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;list-style: none;margin-bottom: 10px; margin-left: 0; padding-left: 0;">
																	<span class="text" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">Positions in ' . $location . '</span>
																</li>
																<li style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;list-style: none;margin-bottom: 10px; margin-left: 0; padding-left: 0;">
																	<span class="text" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">For the ' . $team . ' team</span>
																</li>
															</ul>
														</td>
													</tr>
												</table>
											</td>
											<td valign="top" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt !important;mso-table-rspace: 0pt !important;">
												<table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt !important;mso-table-rspace: 0pt !important;border-spacing: 0 !important;border-collapse: collapse !important;table-layout: fixed !important;margin: 0 auto !important;">
													<tr style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
														<td style="text-align: left;padding-left: 5px;padding-right: 5px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt !important;mso-table-rspace: 0pt !important;">
															<h3 class="heading" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;font-family: \'Lato\', sans-serif;color: #000;margin-top: 0;font-weight: 400;font-size: 20px;">Contact Info</h3>
															<ul style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;margin: 0;padding: 0;">
																<li style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;list-style: none;margin-bottom: 10px; margin-left: 0; padding-left: 0;">
																	<span class="text" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">' . $mail . '</span>
																</li>
																<li style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;list-style: none;margin-bottom: 10px; margin-left: 0; padding-left: 0;">
																	<span class="text" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">' . $phone . '</span>
																</li>
															</ul>
														</td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>';
		break;
		case 'position-application-form':

			$origin 		= 'TINQIN\'s Services & Products catalogue';
			$permalink 		= get_permalink( $post_id );
			$item_name		= get_the_title( $post_id );
			$content 		= '<table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt !important;mso-table-rspace: 0pt !important;border-spacing: 0 !important;border-collapse: collapse !important;table-layout: fixed !important;">
					<tr style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
						<td valign="middle" class="bg_light footer email-section" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background: #fafafa;padding: 1.5em;border-top: 1px solid rgba(0,0,0,.05);color: rgba(0,0,0,.5);mso-table-lspace: 0pt !important;mso-table-rspace: 0pt !important;">
								<table style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt !important;mso-table-rspace: 0pt !important;border-spacing: 0 !important;border-collapse: collapse !important;table-layout: fixed !important;margin: 0 auto !important;">
										<tr style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
											<td valign="top" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt !important;mso-table-rspace: 0pt !important;">
												<table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt !important;mso-table-rspace: 0pt !important;border-spacing: 0 !important;border-collapse: collapse !important;table-layout: fixed !important;margin: 0 auto !important;">
													<tr style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
														<td style="text-align: left;padding-right: 10px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt !important;mso-table-rspace: 0pt !important;">
															<h3 class="heading" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;font-family: \'Lato\', sans-serif;color: #000;margin-top: 0;font-weight: 400;font-size: 20px;">Sender</h3>
															<p style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">' . $name . '</p>
														</td>
													</tr>
													<tr style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
														<td style="text-align: left;padding-right: 10px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt !important;mso-table-rspace: 0pt !important;">
															<h3 class="heading" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;font-family: \'Lato\', sans-serif;color: #000;margin-top: 0;font-weight: 400;font-size: 20px;">Applied for</h3>
															<p style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;"><a href="' . $permalink . '" style="color: #cd3532; text-decoration: underline;">' . $item_name . '</a></p>
														</td>
													</tr>
												</table>
											</td>
											<td valign="top" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt !important;mso-table-rspace: 0pt !important;">
												<table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt !important;mso-table-rspace: 0pt !important;border-spacing: 0 !important;border-collapse: collapse !important;table-layout: fixed !important;margin: 0 auto !important;">
													<tr style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
														<td style="text-align: left;padding-left: 5px;padding-right: 5px;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt !important;mso-table-rspace: 0pt !important;">
															<h3 class="heading" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;font-family: \'Lato\', sans-serif;color: #000;margin-top: 0;font-weight: 400;font-size: 20px;">Contact Info</h3>
															<ul style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;margin: 0;padding: 0;">
																<li style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;list-style: none;margin-bottom: 10px;">
																	<span class="text" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">' . $mail . '</span>
																</li>
																<li style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;list-style: none;margin-bottom: 10px;">
																	<span class="text" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">' . $phone . '</span>
																</li>
															</ul>
														</td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>';
		break;
    case 'recommendation-copy':
    
      $origin 		= 'TINQIN Careers';
      $content 		= '<table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt !important;mso-table-rspace: 0pt !important;border-spacing: 0 !important;border-collapse: collapse !important;table-layout: fixed !important;">
          <tr style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
            <td valign="middle" class="bg_light footer email-section" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background: #fafafa;padding: 1.5em;border-top: 1px solid rgba(0,0,0,.05);color: rgba(0,0,0,.5);mso-table-lspace: 0pt !important;mso-table-rspace: 0pt !important;">
                <p>Dear <strong>' . $name . '</strong>,</p>
                <p>We have received a job application from <strong>' . $mail . '</strong> who listed you as their referral for a position at TINQIN.</p>
                <p>If you do not recognize the name of the applicant, we kindly request that you contact our Human Resources department at <a href="mailto:hr@tinqin.com">hr@tinqin.com</a>. Your prompt response will greatly assist us in maintaining the integrity of our referral program and ensuring that only genuine candidates are considered.</p>
                <p>Thank you for your cooperation.</p>
                <p>HR Team</p>
                </td>
              </tr>
            </table>';
    break;
	}

	// HTML template for the mail
	$header = '<!DOCTYPE html><html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background: #f1f1f1;margin: 0 auto !important;padding: 0 !important;height: 100% !important;width: 100% !important;"><head style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;"> <meta charset="utf-8" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;"> <meta name="viewport" content="width=device-width" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;"> <meta http-equiv="X-UA-Compatible" content="IE=edge" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;"> <meta name="x-apple-disable-message-reformatting" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;"> <title style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;"></title> <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet" style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;"> <style style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">/* What it does: Remove spaces around the email design added by some email clients. */ /* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */ html,body{margin: 0 auto !important; padding: 0 !important; height: 100% !important; width: 100% !important; background: #f1f1f1;}/* What it does: Stops email clients resizing small text. */*{-ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;}/* What it does: Centers email on Android 4.4 */div[style*="margin: 16px 0"]{margin: 0 !important;}/* What it does: Stops Outlook from adding extra spacing to tables. */table,td{mso-table-lspace: 0pt !important; mso-table-rspace: 0pt !important;}/* What it does: Fixes webkit padding issue. */table{border-spacing: 0 !important; border-collapse: collapse !important; table-layout: fixed !important; margin: 0 auto !important;}/* What it does: Uses a better rendering method when resizing images in IE. */img{-ms-interpolation-mode:bicubic;}/* What it does: Prevents Windows 10 Mail from underlining links despite inline CSS. Styles for underlined links should be inline. */a{text-decoration: none;}/* What it does: A work-around for email clients meddling in triggered links. */*[x-apple-data-detectors], /* iOS */.unstyle-auto-detected-links *,.aBn{border-bottom: 0 !important; cursor: default !important; color: inherit !important; text-decoration: none !important; font-size: inherit !important; font-family: inherit !important; font-weight: inherit !important; line-height: inherit !important;}/* What it does: Prevents Gmail from displaying a download button on large, non-linked images. */.a6S{display: none !important; opacity: 0.01 !important;}/* What it does: Prevents Gmail from changing the text color in conversation threads. */.im{color: inherit !important;}/* If the above doesn\'t work, add a .g-img class to any image in question. */img.g-img + div{display: none !important;}/* What it does: Removes right gutter in Gmail iOS app: https://github.com/TedGoas/Cerberus/issues/89 *//* Create one of these media queries for each additional viewport size you\'d like to fix *//* iPhone 4, 4S, 5, 5S, 5C, and 5SE */@media only screen and (min-device-width: 320px) and (max-device-width: 374px){u ~ div .email-container{min-width: 320px !important;}}/* iPhone 6, 6S, 7, 8, and X */@media only screen and (min-device-width: 375px) and (max-device-width: 413px){u ~ div .email-container{min-width: 375px !important;}}/* iPhone 6+, 7+, and 8+ */@media only screen and (min-device-width: 414px){u ~ div .email-container{min-width: 414px !important;}}</style> <style style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">.primary{background: #30e3ca;}.bg_white{background: #ffffff;}.bg_light{background: #fafafa;}.bg_black{background: #000000;}.bg_dark{background: rgba(0,0,0,.8);}.email-section{padding:1.5em;}/*BUTTON*/.btn{padding: 10px 15px;display: inline-block;}.btn.btn-primary{border-radius: 5px;background: #30e3ca;color: #ffffff;}.btn.btn-white{border-radius: 5px;background: #ffffff;color: #000000;}.btn.btn-white-outline{border-radius: 5px;background: transparent;border: 1px solid #fff;color: #fff;}.btn.btn-black-outline{border-radius: 0px;background: transparent;border: 2px solid #000;color: #000;font-weight: 700;}h1,h2,h3,h4,h5,h6{font-family: \'Lato\', sans-serif;color: #000000;margin-top: 0;font-weight: 400;}body{font-family: \'Lato\', sans-serif;font-weight: 400;font-size: 15px;line-height: 1.8;color: rgba(0,0,0,.4);}a{color: #30e3ca;}table{}/*LOGO*/.logo h1{margin: 0;}.logo h1 a{color: #30e3ca;font-size: 24px;font-weight: 700;font-family: \'Lato\', sans-serif;}/*HERO*/.hero{position: relative;z-index: 0;}.hero .text{color: rgba(0,0,0,.8);}.hero .text h2{color: #000;font-size: 40px;margin-bottom: 0;font-weight: 400;line-height: 1.4;}.hero .text h3{font-size: 24px;font-weight: 300;}.hero .text h2 span{font-weight: 600;color: #30e3ca;}/*HEADING SECTION*/.heading-section{}.heading-section h2{color: #000000;font-size: 28px;margin-top: 0;line-height: 1.4;font-weight: 400;}.heading-section .subheading{margin-bottom: 20px !important;display: inline-block;font-size: 13px;text-transform: uppercase;letter-spacing: 2px;color: rgba(0,0,0,.4);position: relative;}.heading-section .subheading::after{position: absolute;left: 0;right: 0;bottom: -10px;content: \'\';width: 100%;height: 2px;background: #30e3ca;margin: 0 auto;}.heading-section-white{color: rgba(255,255,255,.8);}.heading-section-white h2{font-family: line-height: 1;padding-bottom: 0;}.heading-section-white h2{color: #ffffff;}.heading-section-white .subheading{margin-bottom: 0;display: inline-block;font-size: 13px;text-transform: uppercase;letter-spacing: 2px;color: rgba(255,255,255,.4);}ul.social{padding: 0;}ul.social li{display: inline-block;margin-right: 10px;}/*FOOTER*/.footer{border-top: 1px solid rgba(0,0,0,.05);color: rgba(0,0,0,.5);}.footer .heading{color: #000;font-size: 20px;}.footer ul{margin: 0;padding: 0;}.footer ul li{list-style: none;margin-bottom: 10px;}.footer ul li a{color: rgba(0,0,0,1);}@media screen and (max-width: 500px){}</style></head><body width="100%" style="margin: 0 auto !important;padding: 0 !important;mso-line-height-rule: exactly;background-color: #f1f1f1;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background: #f1f1f1;font-family: \'Lato\', sans-serif;font-weight: 400;font-size: 15px;line-height: 1.8;color: rgba(0,0,0,.4);height: 100% !important;width: 100% !important;"><center style="width: 100%;background-color: #f1f1f1;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;"> <div style="display: none;font-size: 1px;max-height: 0px;max-width: 0px;opacity: 0;overflow: hidden;mso-hide: all;font-family: sans-serif;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;"> &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp; </div><div style="max-width: 600px;margin: 0 auto;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" class="email-container"> <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt !important;mso-table-rspace: 0pt !important;border-spacing: 0 !important;border-collapse: collapse !important;table-layout: fixed !important;"> <tr style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;"> <td valign="middle" class="hero bg_white" style="padding: 3em 0 2em 0;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background: #ffffff;position: relative;z-index: 0;mso-table-lspace: 0pt !important;mso-table-rspace: 0pt !important;"> <img src="' . get_template_directory_uri() . '/images/logo.png" alt="TINQIN" style="width: 300px;max-width: 600px;height: auto;margin: auto;display: block;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;-ms-interpolation-mode: bicubic;"> </td></tr></table>';

	if( $message != null ) $text = '<table style="width: 100%; background: #fff; -ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt !important;mso-table-rspace: 0pt !important;border-spacing: 0 !important;border-collapse: collapse !important;table-layout: fixed !important;margin: 0 auto !important;"> <tr style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;"> <td style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt !important;mso-table-rspace: 0pt !important;"> <div class="text" style="padding: 20px 2.5em;text-align: center;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: rgba(0,0,0,.8);"> ' . $message . ' </div></td></tr></table>'; else $text = '';

	$footer = '</td></tr></table> <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;mso-table-lspace: 0pt !important;mso-table-rspace: 0pt !important;border-spacing: 0 !important;border-collapse: collapse !important;table-layout: fixed !important;"> <tr style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;"> <td class="bg_light" style="text-align: center;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background: #fafafa;mso-table-lspace: 0pt !important;mso-table-rspace: 0pt !important;"> <p style="-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">This message was generated by ' . $origin . ' on ' . date( 'd.m.Y', strtotime('now') ) . ' at ' . date( 'H:i', strtotime('now') ) . '</p></td></tr></table> </div></center></body></html>';

	// Compose the mail
	$html = $header.$content.$text.$footer;
	return $html;
}

// Validate data
function tinqin_validate_forms( $post, $attachments = null ){
	// the form has been submited
	$type 		= sanitize_text_field( $post['form-type'] );
	$name 		= sanitize_text_field( $post['sender-name'] );
	$mail 		= sanitize_email( $post['sender-email'] );
	$phone 		= sanitize_text_field( $post['sender-phone'] );
	$message	= sanitize_textarea_field( $post['msg'] );

	switch ( $type ) {
		case 'position-application-form':
			if( !empty( $name ) && !empty( $mail ) && $mail != '' && !empty( $phone ) && !empty( $attachments ) ){
				return true;
			}
			else{
				if( $mail == '' ){
					return pll__( 'Въведеният Email е невалиден', 'tinqin' );
				}
				else
					return pll__( 'Всички полета са задължителни', 'tinqin' );
			}
			break;
		case 'general-application-form':
			if( !empty( $name ) && !empty( $mail ) && $mail != '' && !empty( $phone ) && !empty( $attachments ) ){
				return true;
			}
			else{
				if( $mail == '' ){
					return pll__( 'Въведеният Email е невалиден', 'tinqin' );
				}
				else
					return pll__( 'Всички полета са задължителни', 'tinqin' );
			}
			break;
		default:
			// required fields for the contacts form
			if( !empty( $name ) && !empty( $mail ) && $mail != '' && !empty( $phone ) && !empty( $message ) ){
				return pll__( 'Попълнете всички задължителни полета', 'tinqin' );
			}
			else{
				if( $mail == false ){
					return pll__( 'Въведеният Email е невалиден', 'tinqin' );
				}
				else{
					return true;
				}
			}
			break;
	}
	
}



/* ==== PERFORMANCE: Cookiebot + hints ==== */

// Preconnect to Cookiebot hosts (faster TLS handshake)
add_filter('wp_resource_hints', function($urls, $relation_type){
  if ($relation_type !== 'preconnect' && $relation_type !== 'dns-prefetch') return $urls;
  $hosts = [
    'https://consent.cookiebot.com',
    'https://consentcdn.cookiebot.com',
    'https://imgsct.cookiebot.com',
  ];
  return array_merge($urls, $hosts);
}, 10, 2);
