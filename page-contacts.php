<?php
/**
 * Template Name: Contacts
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */


get_header();

// Determine current page
if ( have_posts() ) {
	// Load posts loop.
	while ( have_posts() ) {
		the_post();
		?>

<div class="container mt-lg-5 pt-lg-5 mt-5 pt-5">
	<div class="row">
		<div class="col-12">
			<h2 class="section-title"><?php pll_e( 'Локации', 'tinqin' ) ?></h2>
			<div class="contact-tab spacing-bottom-s">
				<ul class="nav nav-tabs" id="GMSwitcher" role="tablist">
				  <li class="nav-item">
					<div class="nav-link contacts-panel active" id="paris-tab" data-toggle="tab" href="#paris" role="tab">
						<h3 id="paris-office"></h3>
						<span id="paris-address" class="mb-3"></span>
						<span id="paris-phone"></span>
						<a id="paris-mail"></a>
					</div>
				  </li>
				  <li class="nav-item">
					<div class="nav-link contacts-panel" id="sofia-tab" data-toggle="tab" href="#sofia" role="tab">
						<h3 id="sofia-office"></h3>
						<span id="sofia-address" class="mb-3"></span>
						<span id="sofia-phone"></span>
						<a id="sofia-mail"></a>
					</div>
				  </li>
				  <li class="nav-item">
					<div class="nav-link contacts-panel" id="varna-tab" data-toggle="tab" href="#varna" role="tab">
						<h3 id="varna-office"></h3>
						<span id="varna-address" class="mb-3"></span>
						<span id="varna-phone"></span>
						<a id="varna-mail"></a>
					</div>
				  </li>
				</ul>
				<div class="tab-content" id="GMContent">
				  <div class="tab-pane fade" id="sofia" role="tabpanel" aria-labelledby="sofia-tab">
				  	<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2933.9927420140916!2d23.379873!3d42.6615092!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x6266524903df6104!2sTinqin!5e0!3m2!1sen!2sbg!4v1602687025687!5m2!1sen!2sbg" width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
			      </div>
				  <div class="tab-pane fade show active" id="paris" role="tabpanel" aria-labelledby="paris-tab">
					  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2624.2519837073664!2d2.3285223158538337!3d48.872472707668656!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66e36c6c18853%3A0x8b794b07f6823621!2s15%2F17%20Rue%20Scribe%2C%2075009%20Paris%2C%20France!5e0!3m2!1sen!2sbg!4v1602686952568!5m2!1sen!2sbg" width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
				  </div>
				  <div class="tab-pane fade" id="varna" role="tabpanel" aria-labelledby="varna-tab">
					  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2907.4926054637267!2d27.91233171548369!3d43.22013057913852!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40a455b4a6123649%3A0x7185d0280ee78cdc!2z0KLQmNCd0JrQmNCdINCS0LDRgNC90LA!5e0!3m2!1sen!2sbg!4v1636534863280!5m2!1sen!2sbg" width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
				  </div>
				</div>
			</div>
		</div>
	</div>
	<div style="display: none" id="contact-feeder">
		<?php the_content(); ?>
	</div>
	  <!-- contact form -->
	  
</div>

<div class="container mt-3 mb-5 mt-lg-5 mb-lg-5">
	<div class="row">
		<div class="col-md-6" data-aos="fade-up" data-aos-duration='1000' data-aos-delay='500'>
			<h2 class="section-title"><?php pll_e( 'TINQIN продажби', 'tinqin' ) ?></h2>
			<p class="section-subtitle"><a href="mailto:sales@tinqin.com">sales@tinqin.com</a></p>
		</div>
		<div class="col-md-6" data-aos="fade-up" data-aos-duration='1000' data-aos-delay='650'>
			<h2 class="section-title"><?php pll_e( 'TINQIN кариери', 'tinqin' ) ?></h2>
			<p class="section-subtitle"><a href="mailto:careers@tinqin.com">careers@tinqin.com</a></p>
		</div>
	</div>
</div>
		<?php

	}
	
}
get_footer();