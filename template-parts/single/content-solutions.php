<?php
// Template Name: Solutions Hero
$lang = function_exists('pll_current_language') ? pll_current_language() : '';
get_header();

?>
<style id="home-hero">
/* === TINQIN Sol Hero (Arial, compact) === */
.sol-hero{
  --font:Arial,system-ui,-apple-system,"Segoe UI",Roboto,sans-serif;
  --ink:#121417;--muted:#5b6570;--bg:#fff;--red:#CE3531;--h1-gray:#8b95a4;--stroke:6;
  background:var(--bg);padding:20px 0;font-family:var(--font)
}
.sol-hero>.container>h1{
  margin:0 0 8px;color:var(--h1-gray);
  font-size:4rem;line-height:1.18;font-weight:900; /* visible, not ultra-bold */
  letter-spacing:-.01em;max-width:38ch
}
.sol-grid{display:grid;gap:20px;align-items:start;max-width:1140px;margin:0 auto;grid-template-columns:1fr 2fr}
@media(min-width:992px){.sol-grid{grid-template-columns:1fr 1fr;gap:28px}}
.sol-copy h2{margin:0 0 10px;color:var(--ink);font-size:1.3rem;font-weight:600;line-height:1.3;max-width:60ch}
.sol-copy ul{margin:10px 0 14px;padding-left:1.1rem;color:var(--ink);font-size:1rem;line-height:1.25;}
.sol-hero .wp-block-list {list-style-type:"+ ";}
.sol-copy li {font-weight:600!important;}
.sol-copy li+li{margin-top:6px}.sol-copy li strong{color:var(--red)}
.wp-block-buttons{display:flex;flex-wrap:wrap;gap:12px 20px;margin:0}
.wp-block-button .wp-block-button__link{padding:.7rem 1.2rem;border-radius:9999px;font:600 15px/1 var(--font);transition:.15s}
.wp-block-button:not(.is-style-outline) .wp-block-button__link{background:#f3f4f6;color:var(--ink);border:2px solid var(--red)}
.wp-block-button:not(.is-style-outline) .wp-block-button__link:hover{background:var(--red);color:#fff}
.wp-block-button.is-style-outline .wp-block-button__link{background:#fff;border:1px solid #d6dbe1;color:var(--ink)}
.wp-block-button.is-style-outline .wp-block-button__link:hover{border-color:#c6ccd5}

@media(max-width:680px){
  .sol-hero>.container>h1{max-width:22ch;margin-inline:auto;text-align:center;font-size:2rem;}
  .sol-copy,.sol-copy *{text-align:center}
  .wp-block-buttons{justify-content:center;flex-wrap:nowrap}
  .wp-block-button .wp-block-button__link{font-size:14px;white-space:nowrap}
}

/* === CICD Infinity Animation (framed, gradient restored) === */
.cicd-wrap{
  --ink:#121417;--red:#CE3531;--accent:#1a73e8;
  --dur:6s;--stroke:22;--dot:18;
  width:100%;max-width:550px;margin:0 auto;
  background:#f9f9fa;
  border:1px solid #e5e7eb;border-radius:8px;
  padding:0 4px
}
.cicd-wrap svg{display:block;width:100%;height:auto}
@media(max-width:768px){.cicd-wrap{max-width:none}}

/* Infinity loop path (gradient) */
.cicd-wrap path:first-of-type{
  stroke:url(#cicd-grad);stroke-width:var(--stroke);
  fill:none;stroke-linecap:round;stroke-linejoin:round
}

/* Moving dots */
.cicd-tracer{
  stroke:#fff;stroke-width:var(--dot);stroke-linecap:round;fill:none;
  stroke-dasharray:.04 1;
  animation:cicd-orbit var(--dur) linear infinite,cicd-fade-h var(--dur) linear infinite;
  filter:drop-shadow(0 1px 2px rgba(0,0,0,.25))
}
.cicd-tracer.t2{animation-delay:calc(-1*var(--dur)/3),calc(-1*var(--dur)/3)}
.cicd-tracer.t3{animation-delay:calc(-2*var(--dur)/3),calc(-2*var(--dur)/3)}
@keyframes cicd-orbit{to{stroke-dashoffset:-1}}
@keyframes cicd-fade-h{0%,50%,100%{opacity:1}25%{opacity:0}40%{opacity:.4}}
@media(prefers-reduced-motion:reduce){.cicd-tracer{animation:none;opacity:1}}

.cicd-label{
  margin-top:.5rem;text-align:center;
  font:14px/1.3 Arial,system-ui,-apple-system,"Segoe UI",Roboto,Helvetica,sans-serif;
  color:var(--ink)
}

/* === CICD hit-zones: area tint instead of path glow === */

/* base hit areas */
.cicd-wrap{position:relative}
.cicd-hit{
  position:absolute; inset:0 12px auto 12px; height:calc(100% - 12px);
  background:transparent; border-radius:6px; pointer-events:auto;
  transition:background-color .2s ease, box-shadow .2s ease;
  /* let stroke show through nicely */
  mix-blend-mode:multiply;
}
.cicd-hit.hit-left{left:0; width:50%}
.cicd-hit.hit-right{left:50%; right:0}

/* tint the hovered half (left = red, right = blue) */
.cicd-wrap:has(.hit-left:hover)  .hit-left{
  background:rgba(206,53,49,.10);           /* TINQIN red tint */
  box-shadow:inset 0 0 0 1px rgba(206,53,49,.18);
}
.cicd-wrap:has(.hit-right:hover) .hit-right{
  background:rgba(26,115,232,.10);          /* accent blue tint */
  box-shadow:inset 0 0 0 1px rgba(26,115,232,.18);
}

/* keep your caption alignment behavior */
.cicd-label{
  display:flex; justify-content:center; align-items:center;
  margin-top:.5rem; font:14px/1.3 Arial,system-ui,-apple-system,"Segoe UI",Roboto,sans-serif; color:#121417
}
.cicd-label span{display:none; flex:1}
.cicd-label .label-default{display:block; text-align:center}
.cicd-wrap:has(.hit-left:hover)  .label-default,
.cicd-wrap:has(.hit-right:hover) .label-default{display:none}

.cicd-wrap:has(.hit-left:hover)  .label-left {display:block; text-align:left;  padding-left:4px; color:rgba(206,53,49); font-weight: 400}
.cicd-wrap:has(.hit-right:hover) .label-right{display:block; text-align:right; padding-right:4px; color:rgba(26,115,232); font-weight: 400}


/* Don’t scale inline label arrows */
.cicd-label svg {
  width: 1em !important;   /* scale with font size */
  height: 1em !important;
  display: inline-block !important;
  vertical-align: -0.125em;
}


/* === Mobile grid fix for Sol Hero === */

/* Stack columns on phones, give SVG full-width card */
@media (max-width: 768px){
  .sol-grid{grid-template-columns:1fr; gap:16px}

  /* Buttons: full-width, easy tap */
  .wp-block-buttons{flex-direction:column;align-items:stretch;gap:10px}
  .wp-block-button .wp-block-button__link{width:100%}

  /* CI/CD card scales up on mobile */
  .cicd-wrap{
    max-width:100%;
    margin-inline:auto;
    padding:12px;                 /* keep the frame spacing */
    border-radius:8px;            /* from previous framed style */
  }
  .cicd-wrap svg{width:100%;height:auto;aspect-ratio:11/6}
}

/* Tablet: give copy a bit more room (2:1 split) */
@media (min-width: 769px) and (max-width: 991.98px){
  .sol-grid{grid-template-columns:2fr 1fr; gap:24px}
  .cicd-wrap{max-width:520px;margin-left:auto}
}

/* Fixes*/



.sol-hero .wp-block-buttons{display:flex;gap:12px 20px;flex-wrap:wrap;margin:1.5rem 0;}
.sol-hero .wp-block-button .wp-block-button__link{padding:.78rem 1.25rem;border-radius:9999px;font-weight:600;font-size:16px;line-height:1;transition:background-color .15s,border-color .15s,color .15s,box-shadow .15s;box-shadow:none;}
.sol-hero .wp-block-button:not(.is-style-outline) .wp-block-button__link{background:#f3f4f6;color:#121417;border:2px solid #CC2B25;}
.sol-hero .wp-block-button:not(.is-style-outline) .wp-block-button__link:hover{background:#CC2B25;border-color:#CC2B25;color:#fff;}
.sol-hero .wp-block-button.is-style-outline .wp-block-button__link{background:#fff;border:1px solid #d6dbe1;color:#121417;}
.sol-hero .wp-block-button.is-style-outline .wp-block-button__link:hover{border-color:#c6ccd5;background:#fff;}

</style>

<section class="sol-hero">
  <div class="container mb-lg-5 mb-3">
  <h1><?php the_title(); ?></h1>

    <div class="sol-grid">
      <div class="sol-copy">
        <?php the_content(); ?>
      </div>
		<!-- CI/CD Infinity animation -->
		<div class="cicd-wrap" aria-label="CI/CD animation">
			  <!-- Tight box: minimal whitespace (extremes near edges). viewBox 0 0 720 500; path peaks ~x:20/700, y:20/480 -->
			<svg class="cicd-svg" viewBox="0 0 720 360" width="720" height="360" preserveAspectRatio="xMidYMin meet" role="img" aria-labelledby="cicdTitle cicdDesc">
			<title id="cicdTitle">CI/CD infinity animation</title>
				<desc id="cicdDesc">Three dots orbit an infinity symbol; dots fade at left and right extremes to suggest feedback flowing from production back to integration.</desc>

				<defs>
				  <linearGradient id="cicd-grad" x1="0" y1="0" x2="720" y2="360" gradientUnits="userSpaceOnUse">
					<stop offset="0"   stop-color="var(--red)"/>
					<stop offset=".55" stop-color="var(--ink)"/>
					<stop offset="1"   stop-color="var(--accent)"/>
				  </linearGradient>
				</defs>

					<!-- === Infinity path + tracers — SAME geometry (720×360), ordered UR → DR → UL → DL === -->

					<!-- Ribbon -->
					<path id="cicd-loop" d="M360,180
					  C480,0 705,0 705,180
					  C705,360 480,360 360,180
					  C240,0 15,0 15,180
					  C15,360 240,360 360,180"
					  fill="none"
					  stroke="url(#cicd-grad)"
					  stroke-width="var(--stroke)"
					  stroke-linecap="round"
					  stroke-linejoin="round"/>

					<!-- Tracers (explicit, no <use>) -->
					<path class="cicd-tracer"  pathLength="1" stroke-dasharray=".04 3" fill="none"
					  stroke="rgba(255,255,255,.85)" stroke-width="var(--dot,12)" stroke-linecap="round" stroke-linejoin="round"
					  d="M360,180
					  C480,0 705,0 705,180
					  C705,360 480,360 360,180
					  C240,0 15,0 15,180
					  C15,360 240,360 360,180"/>

					<path class="cicd-tracer t2" pathLength="1" stroke-dasharray=".04 1" fill="none"
					  stroke="rgba(255,255,255,.75)" stroke-width="var(--dot,12)" stroke-linecap="round" stroke-linejoin="round"
					  d="M360,180
					  C480,0 705,0 705,180
					  C705,360 480,360 360,180
					  C240,0 15,0 15,180
					  C15,360 240,360 360,180"/>

					<path class="cicd-tracer t3" pathLength="1" stroke-dasharray=".04 .3" fill="none"
					  stroke="rgba(255,255,255,.6)" stroke-width="var(--dot,12)" stroke-linecap="round" stroke-linejoin="round"
					  d="M360,180
					  C480,0 705,0 705,180
					  C705,360 480,360 360,180
					  C240,0 15,0 15,180
					  C15,360 240,360 360,180"/>
				<!-- Connector line to caption (just below center to avoid overlap) -->
				<line x1="360" y1="20" x2="360" y2="120" stroke="var(--ink)" stroke-width="1"/>
				<line x1="360" y1="240" x2="360" y2="360" stroke="var(--ink)" stroke-width="1"/>

			  </svg>

				  <!-- Invisible hit areas over the SVG -->
				  <div class="cicd-hit hit-left"  aria-label="TINQIN pipeline"></div>
				  <div class="cicd-hit hit-right" aria-label="Customer environment"></div>

				<div class="cicd-label">
				
				  <span class="label-default">
					<!-- Left triangle -->
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 10"
						 width="1em" height="1em" style="vertical-align:-0.15em;margin-right:.35em">
					  <polygon points="10,0 0,5 10,10" fill="currentColor"/>
					</svg>
					<strong>SYNCED CI|CD LOOPS&nbsp;</strong>
					<!-- Right triangle -->
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 10"
						 width="1em" height="1em" style="vertical-align:-0.15em;margin-left:.35em">
					  <polygon points="0,0 10,5 0,10" fill="currentColor"/>
					</svg>
					<br/>Regular Releases &raquo; Unified Codebase<br>Automated Tests &laquo; QA and Security
				  </span>

				  <span class="label-left">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 10"
						 width="1em" height="1em" style="vertical-align:-0.15em;margin-right:.35em">
					  <polygon points="10,0 0,5 10,10" fill="currentColor"/>
					</svg>
					<strong>TINQIN LOOP</strong><br>DevSecOps Pipeline<br>Execution & Delivery
				  </span>

				  <span class="label-right">
					<strong>CLIENT LOOP</strong>
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 10"
						 width="1em" height="1em" style="vertical-align:-0.15em;margin-left:.35em">
					  <polygon points="0,0 10,5 0,10" fill="currentColor"/>
					</svg>
					<br/>Production Pipeline<br>Validation & Discovery
				  </span>
				</div>
				
				</div>
			</div>
			</div>
		  </div>

</section>


<!-- ===================== HOW IT WORKS (WITH VIDEO) — DROP-IN USING PLUGIN MARKUP ===================== -->
<style>
.section-video{background:#121417;color:#fff;padding:28px 0;font-family:Arial,system-ui,-apple-system,"Segoe UI",Roboto,Helvetica,sans-serif}
.section-video h2{font-weight:800;font-size:1.375rem;line-height:1.2;margin:0 0 14px}
.video-container{box-sizing:border-box;width:100%;max-width:1100px;margin:0 auto;padding:0}
.section-video .grid{display:grid;grid-template-columns:1fr;gap:18px}
.section-video .copy{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.12);border-radius:12px;padding:16px}
.section-video .copy p{color:#f4f6f8;margin:0 0 12px}
.section-video .copy .lead{font-size:1.05rem;font-weight:700;color:#fff}
.video-card {background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.12);border-radius:12px}

/* ≥768px: strict 1fr / 1fr halves */
@media (min-width:768px){
  .section-video h2{font-size:1.5rem}
  .section-video .grid{grid-template-columns:1fr 1fr;gap:24px}
}
figure.video-card {margin-bottom:0!important}
</style>

<section class="section-video" aria-labelledby="how-title">
  <div class="video-container">
    <h2 id="how-title">How it works</h2>

    <div class="grid">
      <!-- LEFT -->
      <div class="copy">
        <p class="lead">Problem → Complex change of legacy systems.</p>
        <p><strong>Approach →</strong> An agile, senior team runs an R&amp;D sprint with pre-built accelerators. We quickly prove value against a tightly scoped user journey.</p>
        <p><strong>Value →</strong> In weeks, you have a secure PoC in production-like conditions, clear metrics, and a path to scale without lock-in.</p>
        <div class="cta-row">
          <a class="tq-btn" href="<?php echo esc_url( site_url('/consultation') ); ?>">Start your proof of concept</a>
          <span class="cta-note">Typical PoC: 2–4 weeks, joint team, measurable KPIs.</span>
        </div>
      </div>

      <div id="why" >
		<?php
		// Slug of the child page that holds only the YouTube block
		$video_page = get_page_by_path('solutions-video-cta'); 
		if ($video_page) {
		  $orig_post = $post; 
		  $post = $video_page; setup_postdata($post);
		  echo '<div class="video-card">'; 
		  the_content();            // plugin sees this and swaps to click-to-play
		  echo '</div>';
		  wp_reset_postdata();
		  $post = $orig_post;
		}
		?>
		</div>
    </div>
  </div>
</section>


<!-- ====== Solutions Hero LIST ====== -->
<style>

/* ===== Solutions Pyramid (scoped) ===== */
.solutions-hero{padding:24px 0 12px}
.solutions-hero h1{font-weight:800;margin:0 0 .25rem}
.solutions-hero p{margin:0;color:var(--tq-gray,#5b6570)}

.solutions-promo, .solutions-bottom {
  background:#f7f8f7;border:1px solid #e5e7eb;border-radius:12px;padding:16px 16px;margin:16px 0;
}
.solutions-promo h3, .solutions-bottom h3{margin:0 0 .25rem;font-weight:800}
.solutions-promo p, .solutions-bottom p{margin:.25rem 0 0}

.matrix-nav{
  margin:8px 0 0;display:flex;gap:8px;flex-wrap:wrap
}
.matrix-nav a{
  display:inline-block;padding:6px 10px;border:1px solid #e5e7eb;border-radius:999px;
  text-decoration:none;color:var(--tq-ink,#121417);font-weight:600;font-size:14px
}
.matrix-nav a:hover{border-color:#b9c0c7}

.solutions-matrix{margin:12px 0 24px}
.matrix-col{
  background:#fff;border:1px solid #e5e7eb;border-radius:12px;padding:12px;margin:12px 0
}
.matrix-col h2{
  display:flex;align-items:center;gap:8px;margin:.25rem 0 .5rem;font-weight:800;font-size:18px
}
.matrix-col .pill{display:inline-block;padding:2px 8px;border:1px solid #e5e7eb;border-radius:999px;font-size:12px;color:#5b6570}

.stack{border-top:1px dashed #e5e7eb;padding-top:10px;margin-top:10px}
.stack:first-of-type{border-top:0;padding-top:0;margin-top:0}
.stack h3{margin:0 0 .35rem;font-size:16px;font-weight:800;color:var(--tq-ink,#121417)}
.stack ul{margin:0;padding-left:18px}
.stack li{margin:.2rem 0;font-size:15px}

.badge-vendor{display:inline-block;margin:.15rem .35rem .15rem 0;padding:4px 8px;border:1px solid #e5e7eb;border-radius:999px;font-size:12px}
.muted{color:#5b6570}

/* desktop: show three columns side-by-side, still column-first (mobile order preserved) */
@media (min-width: 992px){
  .solutions-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:16px}
  .solutions-promo, .solutions-bottom{padding:20px}
}

/* subtle colored headers */
.icon-cust::before, .icon-emp::before, .icon-sys::before{
  content:""; display:inline-block; width:10px; height:10px; border-radius:2px;
}
.icon-cust::before{background:#CE3531}
.icon-emp::before{background:#1a73e8}
.icon-sys::before{background:#5b6570}

</style>
  <div class="container">

    <!-- HERO -->
    <header class="solutions-hero">
      <h1>Solutions for Customers, Employees, and Systems</h1>
      <p class="muted">Mobile-first view: each column unfolds as you scroll — Customers → Employees → Systems.</p>
      <nav class="matrix-nav" aria-label="Jump to section">
        <a href="#col-customers">Customers</a>
        <a href="#col-employees">Employees</a>
        <a href="#col-systems">Systems</a>
      </nav>
    </header>


    <!-- Partner MERGED BOX -->
    <section class="solutions-bottom" aria-labelledby="cicd-title">
      <h3 id="cicd-title">CI/CD Expert Team (partnership mode)</h3>
      <p>Dedicated team leveraging the matrix above to deliver on shared KPIs — from onboarding speed and STP, to release cadence and quality gates.</p>
    </section>

    <!-- MATRIX (column-first on mobile) -->
    <section class="solutions-matrix">
      <div class="solutions-grid">

        <!-- COLUMN: CUSTOMERS (Front Office) -->
        <article id="col-customers" class="matrix-col" aria-labelledby="hdr-cust">
          <h2 id="hdr-cust" class="icon-cust">Customers <span class="pill">Front office</span></h2>

          <div class="stack">
            <h3>Consulting & Services</h3>
            <ul>
              <li>Branding & product design workshops</li>
              <li>UI/UX audits and journey mapping</li>
              <li>Mobile & web engineering for apps and portals</li>
            </ul>
          </div>

          <div class="stack">
            <h3>Solutions</h3>
            <ul>
              <li>Digital identity wallet</li>
              <li>KYC onboarding</li>
              <li>Electronic signature</li>
              <li>Registered e-delivery (LRE/ERE)</li>
              <li>Trusted archiving</li>
            </ul>
          </div>

          <div class="stack">
            <h3>Accelerators</h3>
            <ul>
              <li>React UI Kit</li>
              <li>Questionnaire & Diagnostic</li>
              <li>Consent & onboarding templates</li>
            </ul>
          </div>
        </article>

        <!-- COLUMN: EMPLOYEES (Back Office / Workflows) -->
        <article id="col-employees" class="matrix-col" aria-labelledby="hdr-emp">
          <h2 id="hdr-emp" class="icon-emp">Employees <span class="pill">Back office / Workflows</span></h2>

          <div class="stack">
            <h3>Consulting & Services</h3>
            <ul>
              <li>Business analysts (France market), process mapping</li>
              <li>Actuarial & product design support</li>
              <li>Backend platform engineering</li>
            </ul>
          </div>

          <div class="stack">
            <h3>Solutions</h3>
            <ul>
              <li>Business Process Management</li>
              <li>Product Administration</li>
              <li>Customer Data Repository</li>
              <li>Unified Ops Workspace</li>
            </ul>
          </div>

          <div class="stack">
            <h3>Accelerators</h3>
            <ul>
              <li>Insurance Data Model (IDM)</li>
              <li>Business Rules Manager</li>
              <li>Process templates & audit modules</li>
            </ul>
          </div>
        </article>

        <!-- COLUMN: SYSTEMS (Integrations) -->
        <article id="col-systems" class="matrix-col" aria-labelledby="hdr-sys">
          <h2 id="hdr-sys" class="icon-sys">Systems <span class="pill">Integrations</span></h2>

          <div class="stack">
            <h3>Consulting & Services</h3>
            <ul>
              <li>Solution architecture & ecosystem assessments</li>
              <li>Integration strategy & domain mapping</li>
              <li>Platform selection & rollout planning</li>
            </ul>
          </div>

          <div class="stack">
            <h3>Solutions</h3>
            <p class="muted" style="margin:0 0 .35rem">Core insurance integrations & patterns:</p>
            <p>
              <span class="badge-vendor">DXC GraphTalk AIA</span>
              <span class="badge-vendor">Guidewire (Policy/Billing/Claim & Digital)</span>
              <span class="badge-vendor">SAP FS-PM / FS-CD</span>
              <span class="badge-vendor">CGI Wynsure</span>
              <span class="badge-vendor">Prima</span>
              <span class="badge-vendor">Acturis France</span>
              <span class="badge-vendor">API / iPaaS (MuleSoft, Boomi, Kafka)</span>
            </p>
          </div>

          <div class="stack">
            <h3>Accelerators</h3>
            <ul>
              <li>Reusable integration modules & OpenAPI scaffolds</li>
              <li>Mapping cookbooks (GraphTalk / Guidewire / SAP)</li>
              <li>CI/CD automation & test harnesses</li>
            </ul>
          </div>
        </article>

      </div>
    </section>
    <!-- CTA MERGED BOX -->
    <section class="solutions-promo" aria-labelledby="clevel-title">
      <h3 id="clevel-title">Consulting at the C-level — with our cofounders</h3>
      <p>Strategic advisory on digital trust, insurance systems, and ecosystem choices. Align roadmap, budgets, and delivery KPIs before you build.</p>
    </section>
	

  </div>

<section class="section-video" aria-labelledby="how-title">
  <div class="video-container">
    <h2 id="how-title">How it works</h2>

    <div class="grid">
      <!-- LEFT -->
      <div class="copy">
        <p class="lead">Problem → Complex change of legacy systems.</p>
        <p><strong>Approach →</strong> An agile, senior team runs an R&amp;D sprint with pre-built accelerators. We quickly prove value against a tightly scoped user journey.</p>
        <p><strong>Value →</strong> In weeks, you have a secure PoC in production-like conditions, clear metrics, and a path to scale without lock-in.</p>
        <div class="cta-row">
          <a class="tq-btn" href="<?php echo esc_url( site_url('/consultation') ); ?>">Start your proof of concept</a>
          <span class="cta-note">Typical PoC: 2–4 weeks, joint team, measurable KPIs.</span>
        </div>
      </div>

      <div id="rfp" >
		<?php
		// Slug of the child page that holds only the YouTube block
		$video_page = get_page_by_path('solutions-video-cta'); 
		if ($video_page) {
		  $orig_post = $post; 
		  $post = $video_page; setup_postdata($post);
		  echo '<div class="video-card">'; 
		  the_content();            // plugin sees this and swaps to click-to-play
		  echo '</div>';
		  wp_reset_postdata();
		  $post = $orig_post;
		}
		?>
		</div>
    </div>
  </div>
</section>

