  <!-- Footer -->
  <footer >
  <picture>
    <!-- Mobile (max 1200px) -->
    <source 
      media="(max-width: 800px)" 
      srcset="<?php echo get_template_directory_uri(); ?>/images/footer-background1.webp">

    <!-- Default / Desktop -->
    <img 
      src="<?php echo get_template_directory_uri(); ?>/images/footer-background.webp" 
      alt="Footer Background">
  </picture>
	<div class="container-fluid mb-lg-4 mb-md-3 mb-sm-1 px-0">
		<div class="row  d-flex justify-content-center">
		  
        	<div class="col-lg-9 col-md-12 text-center">
					<h5 class="mb-3 no-accent"><?php pll_e( 'Иновирай с нас', 'tinqin' ) ?></h2>
					<p class=""><?php pll_e( 'TINQIN е софтуерна компания, специализираща в услугите и разработките за застрахователния пазар. Компанията е базирана в София, а клиентската поддръжка и отделът ни за продажби - в Париж.', 'tinqin' ) ?></p>
   					<a href="<?php echo get_permalink( pll_get_post( 68 ) ); ?>" class="mt-3 mb-4 btn btn-primary btn-lg"><?php pll_e( 'Свържи се с нас' ) ?></a>
        	</div>
		</div>
		<div class="row pt-lg-5 pt-md-3">
        <div class="col-lg-3 col-md-4 col-6 mt-4 offset-lg-2">
			 <h4 class="fat-title mb-2"><?php pll_e( 'Навигация', 'tinqin' ) ?></h4>
          <nav>
          <?php
            $menuParameters = array(
              'theme_location'  => 'footer-1-menu',
              'container'       => false,
              'echo'            => false,
              'items_wrap'      => '%3$s',
              'depth'           => 0,
            );

            echo strip_tags(wp_nav_menu( $menuParameters ), '<a>' );
          ?>
          </nav>
        </div>
        <div class="col-lg-3 col-md-4 col-6 mt-4">
			 <h4 class="fat-title mb-2"><?php pll_e( 'Услуги', 'tinqin' ) ?></h4>
          <nav>
          <?php
            $menuParameters = array(
              'theme_location'  => 'footer-2-menu',
              'container'       => false,
              'echo'            => false,
              'items_wrap'      => '%3$s',
              'depth'           => 0,
            );

            echo strip_tags(wp_nav_menu( $menuParameters ), '<a>' );
          ?>
          </nav>
        </div>
		<div class="col-lg-2 col-md-4 col-12 mt-4 center-on-mobile">
			 <h4 class="fat-title mb-2"><?php pll_e( 'Последвай ни', 'tinqin' ) ?></h4>
			<div class="pt-2">
					<!-- SOCIAL -->
			<div class="social-icons" aria-label="Follow TINQIN">
			  <a class="si" href="https://www.facebook.com/tinqin.solutions" target="_blank" rel="noopener" aria-label="Facebook">
				<span class="icon" style="--icon:url('/wp-content/themes/tinqin/images/facebook.svg')"></span>
			  </a>
			  <a class="si" href="https://www.linkedin.com/company/tinqin/" target="_blank" rel="noopener" aria-label="LinkedIn">
				<span class="icon" style="--icon:url('/wp-content/themes/tinqin/images/linkedin.svg')"></span>
			  </a>
			  <a class="si" href="https://www.youtube.com/channel/UCqOS5xs7CVE9PPSzz5QELsw/videos" target="_blank" rel="noopener" aria-label="YouTube">
				<span class="icon" style="--icon:url('/wp-content/themes/tinqin/images/youtube.svg')"></span>
			  </a>
			</div>

			</div>
        </div>
      </div>

      <div class="row pt-lg-5 pt-md-3 pt-sm-2">
		<div class="col-12 mt-4 text-center">
		    <div class="copyright-label ">Copyright &copy; <?php echo date( 'Y', strtotime( 'now' ) ) ?></div>
		    <nav class="cookie-policy-lists">
                <?php
                  $menuParameters = array(
                    'theme_location'  => 'cookie-policy-menu',
                    'container'       => false,
                    'echo'            => false,
                    'items_wrap'      => '%3$s',
                    'depth'           => 0,
                  );
                  echo strip_tags(wp_nav_menu( $menuParameters ), '<a>' );
                ?>
			</nav>
		  </div>
      </div>
    </div>
  </footer>
  
  <?php wp_footer(); ?>
</body>

</html>