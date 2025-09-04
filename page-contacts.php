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
<style id="contact-tabs-css">
  /* show only active pane */
  #GMContent .tab-pane { display: none; }
  #GMContent .tab-pane.show.active { display: block; }

  /* basic look for the tab headers (mobile-first) */
  .contact-tab .nav { display:flex; gap:12px; padding:0; margin:0; list-style:none; }
  .contact-tab .nav-item { flex:1; }
  .contact-tab .nav-link { 
    width:100%; display:block; text-align:left; padding:12px 14px; border:1px solid #e5e7eb; 
    border-radius:8px; background:#fff; cursor:pointer; 
  }
  .contact-tab .nav-link.active { border-color:#CE3531; box-shadow:0 0 0 2px rgba(206,53,49,.12) inset; }
  .contact-tab h3 { margin:0 0 6px 0; font-weight:700; }
  .contact-tab .mb-3 { display:block; margin-bottom:6px; color:#5b6570; }
  .contact-tab .meta { display:block; }

  /* map aspect ratio */
  .contact-tab .tab-pane { aspect-ratio: 16 / 9; }
  .contact-tab iframe { width:100%; height:100%; border:0; }

  /* spacing */
  .spacing-bottom-s { margin-bottom:24px; }
</style>

<!-- Vanilla JS: simple tabs (no jQuery/Bootstrap) -->
<script>
document.addEventListener('DOMContentLoaded', function () {
  const tablist = document.getElementById('GMSwitcher');
  if (!tablist) return;

  const tabs  = tablist.querySelectorAll('.nav-link.contacts-panel');
  const panes = document.querySelectorAll('#GMContent .tab-pane');

  function activate(targetSel) {
    tabs.forEach(t => t.classList.remove('active'));
    panes.forEach(p => p.classList.remove('show','active'));

    const pane = document.querySelector(targetSel);
    if (pane) { pane.classList.add('show','active'); }

    tabs.forEach(t => {
      const tgt = t.getAttribute('href') || t.dataset.target;
      if (tgt === targetSel) t.classList.add('active');
    });
  }

  tabs.forEach(tab => {
    tab.addEventListener('click', function (e) {
      e.preventDefault();
      const href = this.getAttribute('href') || this.dataset.target;
      if (href) activate(href);
    });
  });

  // initial
  const initial = document.querySelector('#GMContent .tab-pane.show.active');
  activate(initial ? '#'+initial.id : (tabs[0].getAttribute('href') || tabs[0].dataset.target));
});
</script>

<div class="container mt-lg-5 pt-lg-5 mt-5 pt-5">
  <div class="row">
    <div class="col-12">
      <h2 class="section-title"><?php pll_e( 'Локации', 'tinqin' ) ?></h2>

      <div class="contact-tab spacing-bottom-s">
        <!-- TAB HEADERS -->
        <ul class="nav" id="GMSwitcher" role="tablist">
          <li class="nav-item">
            <button type="button" class="nav-link contacts-panel active" id="paris-tab" data-target="#paris" role="tab" aria-controls="paris" aria-selected="true">
              <h3>TINQIN Paris</h3>
              <span class="mb-3">15 - 17 rue Scribe, 75009</span>
              <span class="meta">+33 01 85 73 02 82</span>
              <span class="meta"><a href="mailto:engage@tinqin.com">engage@tinqin.com</a></span>
            </button>
          </li>
          <li class="nav-item">
            <button type="button" class="nav-link contacts-panel" id="sofia-tab" data-target="#sofia" role="tab" aria-controls="sofia" aria-selected="false">
              <h3>TINQIN Sofia</h3>
              <span class="mb-3">Megapark Offices, étage 5</span>
              <span class="meta">+359 2 805 68 98</span>
              <span class="meta"><a href="mailto:engage@tinqin.com">engage@tinqin.com</a></span>
            </button>
          </li>
          <li class="nav-item">
            <button type="button" class="nav-link contacts-panel" id="varna-tab" data-target="#varna" role="tab" aria-controls="varna" aria-selected="false">
              <h3>TINQIN Varna</h3>
              <span class="mb-3">12 Jan Palach, office 101</span>
              <span class="meta">+359 2 805 68 70</span>
              <span class="meta"><a href="mailto:engage@tinqin.com">engage@tinqin.com</a></span>
            </button>
          </li>
        </ul>

        <!-- TAB PANES (maps) -->
        <div class="tab-content" id="GMContent">
          <div class="tab-pane fade" id="sofia" role="tabpanel" aria-labelledby="sofia-tab">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2933.9927420140916!2d23.379873!3d42.6615092!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x6266524903df6104!2sTinqin!5e0!3m2!1sen!2sbg!4v1602687025687!5m2!1sen!2sbg" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
          </div>

          <div class="tab-pane fade show active" id="paris" role="tabpanel" aria-labelledby="paris-tab">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2624.2519837073664!2d2.3285223158538337!3d48.872472707668656!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66e36c6c18853%3A0x8b794b07f6823621!2s15%2F17%20Rue%20Scribe%2C%2075009%20Paris%2C%20France!5e0!3m2!1sen!2sbg!4v1602686952568!5m2!1sen!2sbg" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
          </div>

          <div class="tab-pane fade" id="varna" role="tabpanel" aria-labelledby="varna-tab">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2907.4926054637267!2d27.91233171548369!3d43.22013057913852!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40a455b4a6123649%3A0x7185d0280ee78cdc!2z0KLQmNCd0JrQmNCdINCS0LDRgNC90LA!5e0!3m2!1sen!2sbg!4v1636534863280!5m2!1sen!2sbg" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div style="display:none" id="contact-feeder">
    <?php the_content(); ?>
  </div>
</div>

<div class="container mt-3 mb-5 mt-lg-5 mb-lg-5">
  <div class="row text-md-left">
    <div class="col-12 col-md-6 mb-4 mb-md-0" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="500">
      <h2 class="section-title"><?php pll_e( 'TINQIN продажби', 'tinqin' ) ?></h2>
      <p class="section-subtitle email-link">
        <a href="mailto:sales@tinqin.com">sales@tinqin.com</a>
      </p>
    </div>
    <div class="col-12 col-md-6" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="650">
      <h2 class="section-title"><?php pll_e( 'TINQIN кариери', 'tinqin' ) ?></h2>
      <p class="section-subtitle email-link">
        <a href="mailto:engage@tinqin.com">engage@tinqin.com</a>
      </p>
    </div>
  </div>
</div>

<style>
/* Mobile-first fix for email links */
.email-link a {
  display:inline-block;
  padding:10px 14px;
  border:1px solid var(--tq-red);
  border-radius:8px;
  font-weight:600;
  font-size:16px;
  color:var(--tq-red);
  background:#fff;
}
.email-link a:hover {
  background:var(--tq-red);
  color:#fff;
}
@media (max-width:767px){
  .email-link a {
    font-size:15px;
    width:100%; /* full-width button feel */
    text-align:center;
  }
}
</style>



<?php
  } // while
} // if
get_footer();
