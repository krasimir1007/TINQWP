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
  
  <!-- Bootstrap core JavaScript -->
  <script src="<?php echo get_stylesheet_directory_uri(); ?>/vendor/jquery/jquery.slim.min.js"></script>

  <script src="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.js"></script>
  <script type="text/javascript">
    $('.hamburger').click(function(){
      $(this).toggleClass('is-active');
    });
    $( document ).ready(function() {
        $('#navbarResponsive .nav-link').each(function(){
          var label = $(this).text();
          $(this).attr('data-hover', label);
        })
    });
	$(window).on('load', function () {
	  AOS.refresh();
	});
	$(function () {
	  AOS.init();
	});
    $(document).ready(function(){
      $('.customer-logos').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 1000,
        arrows: false,
        dots: false,
        pauseOnHover: false,
        responsive: [{
          breakpoint: 768,
          settings: {
            slidesToShow: 4
          }
        }, {
          breakpoint: 768,
          settings: {
            slidesToShow: 2
          }
        }]
      });
    });
    $(document).ready(function(){
      $('.perks-slider').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 1000,
        arrows: false,
        dots: false,
        pauseOnHover: true,
        responsive: [{
          breakpoint: 768,
          settings: {
            slidesToShow: 4
          }
        }, {
          breakpoint: 768,
          settings: {
            slidesToShow: 2
          }
        }]
      });
    });

    $(window).on("load",function() {
      $(window).scroll(function() {
        var windowBottom = $(this).scrollTop() + $(this).innerHeight();
        $(".load-anim").each(function() {
          /* Check the location of each desired element */
          var objectBottom = $(this).offset().top + $(this).outerHeight();
          
          /* If the element is completely within bounds of the window, fade it in */
          if (objectBottom < windowBottom) { //object comes into view (scrolling down)
            if ($(this).css("opacity")==0) {$(this).fadeTo(500,1);}
          } else { //object goes out of view (scrolling up)
            if ($(this).css("opacity")==1) {$(this).fadeTo(500,0);}
          }
        });
      }).scroll(); //invoke scroll-handler on page-load
    });
	  
    $(document).ready(function(){
		$('#sofia-office').text( $('#sofia-office-source').text() );
		$('#paris-office').text( $('#paris-office-source').text() );
		$('#varna-office').text( $('#varna-office-source').text() );
		
		$('#sofia-address').text( $('#sofia-address-source').text() );
		$('#paris-address').text( $('#paris-address-source').text() );
		$('#varna-address').text( $('#varna-address-source').text() );
		
		$('#sofia-phone').text( $('#sofia-phone-source').text() );
		$('#paris-phone').text( $('#paris-phone-source').text() );
		$('#varna-phone').text( $('#varna-phone-source').text() );
		
		$('#sofia-mail').text( $('#sofia-mail-source').text() ).attr( 'href', 'mailto:' + $('#sofia-mail-source').text() );
		$('#paris-mail').text( $('#paris-mail-source').text() ).attr( 'href', 'mailto:' + $('#paris-mail-source').text() );
		$('#varna-mail').text( $('#varna-mail-source').text() ).attr( 'href', 'mailto:' + $('#varna-mail-source').text() );
    });
	  
	  $('#sender-cv').change(function(){
		  var filename = $(this).val().replace(/C:\\fakepath\\/i, '');
		 $('.custom-file-label').text(filename);
	  });

	  $("#form-location").change(function(){
		 var value = $(this).val();
		  if( value == 'sofia' || value == 'varna' ){
			  $('.show-on-bg').show();
		  }
		  else{
			  $('.show-on-bg').hide();
		  }
	  });
	  
  </script>

	<script>
		AOS.init({
			once: true,
			disable: 'mobile'
		}); 
	</script>
  <?php wp_footer(); ?>
</body>

</html>