<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage TINQIN
 * @since 1.0.0
 */

  $lang = pll_current_language();


?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <script id="Cookiebot" data-culture="<?php echo $lang; ?>" src="https://consent.cookiebot.com/uc.js" data-cbid="bd1d06b7-f90d-4eaa-bdc9-190f7521cc94" data-blockingmode="auto" type="text/javascript"></script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>
	  <?php
	  
	  	if( is_home() ){
			bloginfo('name'); ?> &raquo; <?php bloginfo('description');
		}
	    else{
			wp_title( '', true, '|' ); ?> &raquo; <?php bloginfo('description');
		}
	  
	  ?>
  </title>

  <!-- Bootstrap core CSS -->
  <link href="<?php echo get_template_directory_uri(); ?>/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous" />
  <link href="<?php echo get_template_directory_uri(); ?>/css/hamburgers.css" rel="stylesheet" />
  <link href="<?php echo get_template_directory_uri(); ?>/css/infinite-slider.css" rel="stylesheet" />
  <link href="<?php echo get_template_directory_uri(); ?>/css/tinqin.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.css" rel="stylesheet" />
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js"></script>
  <link href="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.css" rel="stylesheet">
  <meta name="facebook-domain-verification" content="q5vwp1r1yp5ov5ut56s2b73o39pxc2" />

    <?php wp_head(); ?>

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
		            <div class="top-menu ml-5">
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