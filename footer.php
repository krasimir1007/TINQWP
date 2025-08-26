  <!-- Footer -->
  <footer >
	<img src="<?php echo get_template_directory_uri(); ?>/images/footer-background.webp" />
	<div class="container mb-lg-4 mb-md-3 mb-sm-1">
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
							    <?php if ( is_active_sidebar( 'social-sidebar' ) ) : ?>
              <?php dynamic_sidebar( 'social-sidebar' ); ?>
          <?php endif; ?>
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