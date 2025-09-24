<?php
/**
 * Template Name: Contacts
 */

get_header();

if ( have_posts() ) {
  while ( have_posts() ) {
    the_post();
    ?>

<!-- Minimal CSS for tabs + map -->
<?php
/* DROP-IN for Contacts page
 * Replaces the old tabs/map block with 3 contact-style cards + team image
 * Paste OVER the block starting at <!-- TAB HEADERS --> down to the </picture> close.
 */
?>

<style id="contacts-contact-css">
/* Locations (light variant) */
.section-contact{color:var(--tq-ink);padding:36px 16px 0 16px;background:#fff}
.contact-container{max-width:1110px;margin:0 auto}
.contact-container h1{font-size:2rem;margin:0 0 6px;color:var(--tq-ink);font-weight:600;}
.contact-bottom{display:grid;grid-template-columns:1fr;gap:16px}
@media(min-width:768px){.contact-bottom{grid-template-columns:repeat(3,1fr)}}
.contact-card{background:#f3f4f6;border-radius:10px;padding:14px}
.contact-card h3{font-size:1.2rem;margin:0 0 6px;color:var(--tq-ink);font-weight:600;}
.contact-card p{margin:0 0 8px;color:var(--tq-gray)}
.contact-card a{font-weight:600;color:var(--tq-blue);text-decoration:none}
.contact-card a:hover{text-decoration:underline}
.contact-actions{display:flex;gap:8px;flex-wrap:wrap;margin-top:8px}
.contact-btn{display:inline-block;padding:8px 12px;border:1px solid var(--tq-gray);border-radius:999px;background:#fff;color:var(--tq-ink);font-weight:600;font-size:.92rem}
.contact-btn:hover{border-color:var(--tq-red);background:var(--tq-red);color:#fff}


/* Team image */
.contact-media{margin:16px auto 0;max-width:1110px}
.contact-media picture,.contact-media img{display:block;width:100%;height:auto;border-radius:12px}
</style>

<!-- Locations as cards -->
<section class="section-contact" aria-labelledby="locTitle">
  <div class="contact-container">
    <h1 id="locTitle">TINQIN: <?php pll_e( 'Локации', 'tinqin' ) ?></h1>

    <div class="contact-bottom">
      <!-- Paris -->
      <article class="contact-card" aria-label="TINQIN Paris">
        <h2 class="section-title">TINQIN Paris</h2>
        <p>15 – 17 rue Scribe, 75009</p>
        <p><a href="tel:+33185730282" aria-label="Call TINQIN France office">+33 1 85 73 02 82</a></p>
        <div class="contact-actions">
          <a class="contact-btn" href="https://maps.app.goo.gl/2fD54AytQLcgxiNCA" target="_blank" rel="noopener">Google Maps</a>
		  <a class="contact-btn" href="https://maps.apple.com/place?address=15+Rue+Scribe%2C+75009+Paris%2C+France&coordinate=48.8725809%2C2.3307751&name=15+Rue+Scribe" target="_blank" rel="noopener">Apple Maps</a>
          
        </div>
      </article>

      <!-- Sofia -->
      <article class="contact-card" aria-label="TINQIN Sofia">
        <h2 class="section-title">TINQIN Sofia</h2>
        <p>Megapark Offices, étage 5</p>
        <p><a href="tel:+35928056898" aria-label="Call TINQIN Sofia office">+359 2 805 68 98</a></p>
        <div class="contact-actions">
          <a class="contact-btn" href="https://maps.apple.com/place?place-id=I5515CEDD63731ED&_provider=9902" target="_blank" rel="noopener">Google Maps</a>
		  <a class="contact-btn" href="https://maps.apple.com/?q=Megapark%20Offices%2C%20Sofia" target="_blank" rel="noopener">Apple Maps</a>
          
        </div>
      </article>

      <!-- Varna -->
      <article class="contact-card" aria-label="TINQIN Varna">
        <h2 class="section-title">TINQIN Varna</h2>
        <p>12 Jan Palach, office 101</p>
		<p><a href="tel:+35928056870" aria-label="Call TINQIN Sofia office">+359 2 805 68 70</a></p>
        <div class="contact-actions">
          <a class="contact-btn" href="https://maps.app.goo.gl/ivtGjwbGbbG2D2V28" target="_blank" rel="noopener">Google Maps</a>
		  <a class="contact-btn" href="https://maps.apple.com/place?place-id=IEE49EE9C1FD7314D&_provider=9902" target="_blank" rel="noopener">Apple Maps</a>
          
        </div>
      </article>
    </div>
  </div>
</section>

<!-- Team image (replaces map visual) -->
<div class="contact-media">
  <picture>
    <!-- Mobile ≤768px -->
    <source
      media="(max-width: 768px)"
      sizes="100vw"
      srcset="<?php echo get_template_directory_uri(); ?>/images/tinqin-contacts-mobile@1x.webp 360w,
              <?php echo get_template_directory_uri(); ?>/images/tinqin-contacts-mobile@2x.webp 720w,
              <?php echo get_template_directory_uri(); ?>/images/tinqin-contacts-mobile@3x.webp 1110w">
    <!-- Desktop ≥769px -->
    <source
      media="(min-width: 769px)"
      sizes="1110px"
      srcset="<?php echo get_template_directory_uri(); ?>/images/tinqin-contacts-desktop@1x.webp 555w,
              <?php echo get_template_directory_uri(); ?>/images/tinqin-contacts-desktop@2x.webp 1110w">
    <img
      src="<?php echo get_template_directory_uri(); ?>/images/tinqin-contacts-desktop@1x.webp"
      alt="TINQIN team"
      width="1110" height="420"
      loading="lazy" decoding="async" />
  </picture>
</div>

<!-- Contacts as cards -->
<section class="section-contact" aria-labelledby="contactTitle">
  <div class="contact-container">
    <div class="contact-bottom">
      <!-- Sales -->
      <article class="contact-card" aria-label="TINQIN Sales" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="500">
        <h2 class="section-title"><?php pll_e( 'TINQIN продажби', 'tinqin' ); ?></h2>
        <p class="section-subtitle email-link">
          <a class="contact-btn" href="mailto:sales@tinqin.com">@</a>
          <a href="mailto:sales@tinqin.com">sales@tinqin.com</a>
        </p>

      </article>

      <!-- Careers -->
      <article class="contact-card" aria-label="TINQIN Careers" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="650">
        <h2 class="section-title"><?php pll_e( 'TINQIN кариери', 'tinqin' ); ?></h2>
        <p class="section-subtitle email-link">
          <a class="contact-btn" href="mailto:engage@tinqin.com">@</a>
		  <a href="mailto:engage@tinqin.com">engage@tinqin.com</a>
        </p>
      </article>

      <!-- Media -->
      <article class="contact-card" aria-label="TINQIN Media" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="800">
        <h2 class="section-title">TINQIN media</h2>
        <p class="section-subtitle email-link">
          <a class="contact-btn" href="mailto:marketing@tinqin.com">@</a>
		  <a href="mailto:marketing@tinqin.com">marketing@tinqin.com</a>
		</p>

      </article>
    </div>
  </div>
</section>






<?php
  } // while
} // if
get_footer();
