<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Cookie consent -->
  <?php $lang = function_exists('pll_current_language') ? pll_current_language() : get_locale(); ?>


  <!-- Canonical -->
  <?php
  if ( is_singular() ) {
    printf('<link rel="canonical" href="%s" />'."\n", esc_url( get_permalink() ));
  } elseif ( function_exists('pll_home_url') && is_front_page() ) {
    printf('<link rel="canonical" href="%s" />'."\n", esc_url( pll_home_url() ));
  } else {
    printf('<link rel="canonical" href="%s" />'."\n", esc_url( home_url( add_query_arg( [], $wp->request ?? '' ) ) ));
  }
  ?>



  <title><?php
    if ( is_home() || is_front_page() ) {
      bloginfo('name'); echo ' » '; bloginfo('description');
    } else {
      wp_title(''); echo ' » '; bloginfo('description');
    }
  ?></title>

  <?php

  wp_head();
  ?>
  <link rel="stylesheet" id='bootstrap-used-css' href="/wp-content/themes/tinqin/css/bootstrap-used-subset.css" type='text/css' media='all' />  
  <link rel='stylesheet' id='tinqin-css' href='https://www.tinqin.com/wp-content/themes/tinqin/css/tinqin.css' type='text/css' media='all' />

</head>


<body <?php body_class(); ?>>

  <!-- Navigation -->

  <div class="d-block d-lg-none">
	  
    <div class=" mt-3 mb-2 fixed-top bg-white">
      <div class="row d-flex align-items-center">
        <div class="col-9">
          <div class="logo-wrapper d-flex align-items-center">
            <a href="<?php echo home_url(); ?>" class="d-flex align-items-flex-start"><img src="<?php echo get_template_directory_uri(); ?>/images/logo.svg" alt="TINQIN logo" class="site-logo img-responsive" /></a>
          </div>
        </div>
        <div class="col-3 text-right">
          <button class="hamburger hamburger--elastic d-inline-flex" type="button" id="MobileMenuTrigger" data-toggle="collapse" data-target="#MobileMenuContainer" aria-expanded="false" aria-controls="MobileMenuTrigger">
            <span class="hamburger-box">
              <span class="hamburger-inner"></span>
            </span>
          </button>
        </div>
      </div>
    </div>
    <hr />
	<div class="top-menu-item text-center">
		<ul class="nav lang-nav">
			<?php pll_the_languages($args); ?>
		</ul>
	</div>

    <div class="collapse" id="MobileMenuContainer">
      <div>
        <?php
         wp_nav_menu(array(
           'menu'            => 'Mobile menu',
           'theme_location'  => 'mobile-menu',
           'container'       => 'div',
           'container_id'    => 'MobileMenu',
           'container_class' => 'mobile-menu-container', 
           'menu_id'         => false,
           'menu_class'      => '',
           'depth'           => 2
         ));
        ?>
		<!-- Mobile languages -->
			<ul class="mobile-lang-nav">
			  <?php
				// text-only, short slugs (FR / EN / BG); current is highlighted via .current-lang
				pll_the_languages([
				  'show_flags'               => 0,
				  'display_names_as'         => 'names',
				  'hide_if_no_translation'   => 1,
				]);
			  ?>
			</ul>
      </div>
    </div>

  </div>

  <div class="d-none d-lg-block mt-4">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-right">

        </div>
      </div>
      <div class="row">
        <div class="col-lg-12 text-center">
          <a href="<?php echo home_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/logo.svg" alt="TINQIN logo" class="site-logo img-responsive" /></a>
          <hr class="header-breaker" />
        </div>
      </div>
    </div>
	<div class="container">
    <nav class="navbar navbar-expand-lg static-top  justify-content-center">
        <?php
         wp_nav_menu(array(
           'menu'            => 'Primary menu',
           'theme_location'  => 'primary-menu',
           'container'       => 'div',
           'container_id'    => 'navbarResponsive',
           'container_class' => 'navbar-expand-xl collapse navbar-collapse',
           'menu_id'         => false,
           'menu_class'      => 'navbar-nav',
           'depth'           => 2,
           'fallback_cb'     => 'bs4navwalker::fallback',
           'walker'          => new bs4navwalker()
         ));
        ?>
		            <div class="top-menu">
<!-- 						
            <div class="top-menu-item">
              <?php
               wp_nav_menu(array(
                 'menu'            => 'Top menu',
                 'theme_location'  => 'top-menu'
               ));
              ?>
            </div>
 -->
            <div class="top-menu-item">
              <ul class="nav lang-nav">
                <?php pll_the_languages($args); ?>
              </ul>
            </div>
          </div>
    </nav>
		  </div>
  </div>
