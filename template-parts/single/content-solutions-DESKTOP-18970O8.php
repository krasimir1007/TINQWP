<?php
// Template Name: Solutions Hero FR
$lang = function_exists('pll_current_language') ? pll_current_language() : '';
get_header();

?>

<style id="home-hero">
/* === HERO / COPY (mobile-first) === */
.sol-hero{--tq-font:Arial,"Inter",system-ui,-apple-system,"Segoe UI",Roboto,Ubuntu,Cantarell,sans-serif;--ink:#121417;--muted:#5b6570;--bg:#fff;--red:#CE3531;--h1-gray:#8b95a4;background:var(--bg);padding:20px 0;font-family:var(--tq-font)}
.sol-hero>.container>h1{margin:0 0 1rem!important;color:var(--h1-gray);font:800 3.7rem/1 var(--tq-font);letter-spacing:-.01em;max-width:38ch}
.sol-grid{display:grid;gap:20px;align-items:start;max-width:1140px;margin:0 auto;grid-template-columns:1fr}
@media(min-width:992px){.sol-grid{grid-template-columns:1.15fr 1fr;gap:28px}}
.sol-copy h2{margin:0 0 10px;color:var(--ink);font:600 1.3rem/1.3 var(--tq-font);max-width:60ch}
.sol-copy ul{margin:10px 0 18px;padding-left:1rem;color:var(--ink)}
.sol-copy ul li {line-height:1.25!important;font-size:1rem;}
.sol-hero .wp-block-list{list-style-type:"+ "}
.sol-copy li{font-weight:400}.sol-copy li+li{margin-top:6px}.sol-copy li strong{color:var(--red)}
.sol-copy .wp-block-columns{margin:0}
.wp-block-buttons{display:flex;flex-wrap:wrap;gap:6px 10px;margin:0}
.wp-block-button .wp-block-button__link{padding:.78rem 1.25rem;border-radius:9999px;font:600 15px/1 var(--tq-font);transition:.15s}
.wp-block-button:not(.is-style-outline) .wp-block-button__link{background:#f3f4f6;color:var(--ink);border:2px solid var(--red)}
.wp-block-button:not(.is-style-outline) .wp-block-button__link:hover{background:var(--red);color:#fff}
.wp-block-button.is-style-outline .wp-block-button__link{background:#fff;border:1px solid #d6dbe1;color:var(--ink)}
.wp-block-button.is-style-outline .wp-block-button__link:hover{border-color:#c6ccd5}
/* === HERO / COPY — mobile tweaks === */
@media(max-width:680px){
  .sol-hero>.container>h1{max-width:22ch;margin-inline:auto;text-align:center;font-size:2rem}
  .sol-copy h2,.sol-copy .wp-block-buttons{text-align:center}
  .wp-block-buttons{justify-content:center;flex-wrap:nowrap;margin-bottom:1rem;}
  .wp-block-button .wp-block-button__link{font-size:14px;white-space:nowrap}
  .sol-copy ul,.sol-copy li{max-width:none;margin:0;text-align:left}
  .sol-copy .wp-block-list{margin:0 0 2rem;padding-left:1rem;list-style-position:outside} /* ← spacing fix */
}

/* CTA alignment */
@media(min-width:992px){.sol-grid{align-items:stretch}.sol-copy{display:flex;flex-direction:column;height:100%;padding-bottom:12px}.sol-copy .wp-block-buttons{margin-top:auto;margin-bottom:0}}
@media(max-width:991px){.sol-grid{align-items:start}.sol-copy{display:block}.sol-copy .wp-block-buttons{margin-top:1rem}}


/* === CICD ANIMATION (base) === */
.cicd-wrap{--ink:#121417;--red:#CE3531;--accent:#1a73e8;--dur:10s;--stroke:16;--dot:12;position:relative;width:100%;max-width:560px;margin:0.5rem auto;background:#f9f9fa;border:1px solid #e5e7eb;border-radius:8px;contain:layout paint}
.cicd-svg{display:block;width:100%;height:auto}
.cicd-wrap path:first-of-type{stroke:url(#cicd-grad);stroke-width:var(--stroke);fill:none;stroke-linecap:round;stroke-linejoin:round}
.cicd-tracer{stroke:#fff;stroke-width:var(--dot);stroke-linecap:round;fill:none;stroke-dasharray:.04 1;animation:cicd-orbit var(--dur) linear infinite,cicd-fade var(--dur) linear infinite;filter:none}
.cicd-tracer.t2{animation-delay:calc(-1*var(--dur)/3),calc(-1*var(--dur)/3)}
.cicd-tracer.t3{animation-delay:calc(-2*var(--dur)/3),calc(-2*var(--dur)/3)}
@keyframes cicd-orbit{to{stroke-dashoffset:-1}}@keyframes cicd-fade{0%,50%,100%{opacity:1}25%{opacity:0}40%{opacity:.4}}
@media(prefers-reduced-motion:reduce){.cicd-tracer{animation:none!important;opacity:1}}
.cicd-hit{position:absolute;inset:0;z-index:2;pointer-events:auto;background:transparent;transition:background-color .2s,box-shadow .2s}
.cicd-hit.hit-left{right:50%}.cicd-hit.hit-right{left:50%}
.cicd-wrap:has(.hit-left:hover) .hit-left{background:rgba(206,53,49,.1);box-shadow:inset 0 0 0 1px rgba(206,53,49,.18)}
.cicd-wrap:has(.hit-right:hover) .hit-right{background:rgba(26,115,232,.1);box-shadow:inset 0 0 0 1px rgba(26,115,232,.18)}
.cicd-label{position:relative;z-index:3;margin:.35rem 0 .5rem;text-align:center;font:14px/1.3 Arial,system-ui,-apple-system,"Segoe UI",Roboto,Helvetica,sans-serif;color:var(--ink)}
.cicd-label span{display:none}.cicd-label .label-default{display:block}
.cicd-wrap:has(.hit-left:hover) .label-default,.cicd-wrap:has(.hit-right:hover) .label-default{display:none}
.cicd-wrap:has(.hit-left:hover) .label-left{display:block;color:var(--red);text-align:left;padding-left:4px}
.cicd-wrap:has(.hit-right:hover) .label-right{display:block;color:var(--accent);text-align:right;padding-right:4px}
.cicd-label svg{width:1em!important;height:1em!important;display:inline-block!important;vertical-align:-.125em}
.cicd-wrap.paused .cicd-tracer{animation:none!important;opacity:0;pointer-events:none}
/* === CICD — mobile tweaks === */
@media(max-width:768px){
  .sol-grid{grid-template-columns:1fr;gap:16px}
  .cicd-wrap{max-width:100%;padding:12px;border-radius:8px}
  .cicd-svg{aspect-ratio:11/6}
  .wp-block-buttons{flex-direction:column;align-items:stretch;gap:10px}
  .wp-block-button .wp-block-button__link{width:100%}
}


</style>


<script>
/* Auto-stop after N loops (per .cicd-wrap). End state = no dots. */
document.addEventListener('DOMContentLoaded',()=>{
  const wraps=[...document.querySelectorAll('.cicd-wrap')];
  const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  wraps.forEach(wrap=>{
    const loops = 3; // ← change number of laps here
    const dur = parseFloat(getComputedStyle(wrap).getPropertyValue('--dur')) || 6;
    const stop = ()=>wrap.classList.add('paused');

    if (prefersReduced) { stop(); return; }

    // Stop after N full durations
    const timer = setTimeout(stop, dur * loops * 1000);

    // Optional: if user backgrounds the tab, just stop once
    document.addEventListener('visibilitychange',()=>{
      if (document.hidden){ clearTimeout(timer); stop(); }
    }, { once:true, passive:true });
  });
});
</script>

<section class="sol-hero">
  <div class="container mb-lg-5 mb-3">
  <h1><?php the_title(); ?></h1>

    <div class="sol-grid">
      <div class="sol-copy">
        <?php the_content(); ?>
		</div>
<!-- CI/CD Infinity animation (clean, responsive) -->
<div class="cicd-wrap" aria-label="CI/CD animation">
  <svg class="cicd-svg" viewBox="0 0 720 360" preserveAspectRatio="xMidYMin meet" role="img" aria-labelledby="cicdTitle cicdDesc">
    <title id="cicdTitle">CI/CD infinity animation</title>
    <desc id="cicdDesc">Three dots orbit an infinity symbol; dots fade at left and right extremes to suggest feedback flowing from production back to integration.</desc>
    <defs>
      <linearGradient id="cicd-grad" x1="0" y1="0" x2="720" y2="360" gradientUnits="userSpaceOnUse">
        <stop offset="0" stop-color="var(--red)"/><stop offset=".55" stop-color="var(--ink)"/><stop offset="1" stop-color="var(--accent)"/>
      </linearGradient>
    </defs>

    <!-- Ribbon -->
    <path id="cicd-loop" d="M360,180C480,0,705,0,705,180C705,360,480,360,360,180C240,0,15,0,15,180C15,360,240,360,360,180"
          fill="none" stroke="url(#cicd-grad)" stroke-width="var(--stroke)" stroke-linecap="round" stroke-linejoin="round"/>

    <!-- Tracers -->
    <path class="cicd-tracer"  pathLength="1" stroke-dasharray=".04 3" fill="none" stroke="rgba(255,255,255,.85)" stroke-width="var(--dot,12)"
          stroke-linecap="round" stroke-linejoin="round"
          d="M360,180C480,0,705,0,705,180C705,360,480,360,360,180C240,0,15,0,15,180C15,360,240,360,360,180"/>
    <path class="cicd-tracer t2" pathLength="1" stroke-dasharray=".04 1" fill="none" stroke="rgba(255,255,255,.75)" stroke-width="var(--dot,12)"
          stroke-linecap="round" stroke-linejoin="round"
          d="M360,180C480,0,705,0,705,180C705,360,480,360,360,180C240,0,15,0,15,180C15,360,240,360,360,180"/>
    <path class="cicd-tracer t3" pathLength="1" stroke-dasharray=".04 .3" fill="none" stroke="rgba(255,255,255,.6)" stroke-width="var(--dot,12)"
          stroke-linecap="round" stroke-linejoin="round"
          d="M360,180C480,0,705,0,705,180C705,360,480,360,360,180C240,0,15,0,15,180C15,360,240,360,360,180"/>

    <!-- Caption connectors -->
    <line x1="360" y1="20"  x2="360" y2="120" stroke="var(--ink)" stroke-width="1"/>
    <line x1="360" y1="240" x2="360" y2="340" stroke="var(--ink)" stroke-width="1"/>
  </svg>

  <!-- Hit zones -->
  <div class="cicd-hit hit-left"  aria-label="TINQIN pipeline"></div>
  <div class="cicd-hit hit-right" aria-label="Customer environment"></div>

  <!-- Labels -->
  <div class="cicd-label">
    <span class="label-default">
      <svg class="caret-l" viewBox="0 0 10 10" aria-hidden="true"><polygon points="10,0 0,5 10,10"/></svg>
      <strong>SYNCED CI|CD LOOPS&nbsp;</strong>
      <svg class="caret-r" viewBox="0 0 10 10" aria-hidden="true"><polygon points="0,0 10,5 0,10"/></svg><br/>
      Regular Releases » Unified Codebase<br/>Automated Tests « QA and Security
    </span>
    <span class="label-left">
      <svg class="caret-l" viewBox="0 0 10 10" aria-hidden="true"><polygon points="10,0 0,5 10,10"/></svg>
      <strong>TINQIN LOOP</strong><br/>DevSecOps Pipeline<br/>Execution &amp; Delivery
    </span>
    <span class="label-right">
      <strong>CLIENT LOOP</strong>
      <svg class="caret-r" viewBox="0 0 10 10" aria-hidden="true"><polygon points="0,0 10,5 0,10"/></svg><br/>
      Production Pipeline<br/>Validation &amp; Discovery
    </span>
  </div>
</div>

			</div>
		  </div>

</section>


<!-- ===================== HOW IT WORKS (WITH VIDEO) — DROP-IN (aligned + 2 cols) ===================== -->
<style>
:root{--ink:#121417;--muted:#5b6570;--light:#f3f4f6;--red:#CE3531}
.section-video{background:var(--light);color:var(--ink);padding:28px 0}
.section-video h2{font-weight:800;font-size:1.375rem;margin:0 0 14px}

/* Let Gutenberg handle columns (flex). Only tighten spacing & cards */
.section-video .wp-block-columns{gap:18px;margin:0}
.section-video .wp-block-column.copy{display:flex;flex-direction:column;gap:12px;background:#fff;border:1px solid #e5e7eb;border-radius:12px;padding:16px}
.section-video .wp-block-column.copy p{margin:0;color:var(--muted)}
.section-video .wp-block-column.copy .lead{font-weight:700;color:var(--ink)}
.section-video .trust-media{margin-top:auto}
.section-video .trust-media img{display:block;width:100%;height:auto;border-radius:8px}


/* Logos strip in left column — flexible, full width on mobile, ~500px on desktop */
.section-video .copy{display:flex;flex-direction:column}
.section-video figure.trust-media,
.section-video figure.transmedia{margin-top:auto;width:100%;max-width:clamp(280px,50vw,500px)}
.section-video figure.trust-media img,
.section-video figure.transmedia img{display:block;width:100%;height:auto;border-radius:8px}
```
```css
/* Logos strip in left column — flexible, full width on mobile, ~500px on desktop */
.section-video .copy{display:flex;flex-direction:column}
.section-video figure.trust-media,
.section-video figure.transmedia{margin-top:auto;width:100%;max-width:clamp(280px,50vw,500px)}
.section-video figure.trust-media img,
.section-video figure.transmedia img{display:block;width:100%;height:auto;border-radius:8px}
```


/* Video card */
.section-video .wp-block-column.video>figure{margin:0;background:#fff;border:1px solid #e5e7eb;border-radius:12px;overflow:hidden}
.section-video .hd-bcve-thumbnail{display:block;width:100%;height:auto}

@media(min-width:768px){
  .section-video h2{font-size:1.5rem}
  .section-video .wp-block-columns{gap:24px} /* keep 2-cols as WP renders them */
}
</style>

<section class="section-video" aria-labelledby="how-title">
  <div class="container"><!-- align with hero/container -->
    <h2 id="how-title" class="section-title">See Why it Works</h2>
    <?php
      // Child page holds Gutenberg Columns: left .copy, right .video
      if ($video_page = get_page_by_path('solutions-video-cta')) {
        $orig_post = $post; $post = $video_page; setup_postdata($post);
        the_content();                                   // no extra wrappers
        wp_reset_postdata(); $post = $orig_post;
      }
    ?>
  </div>
</section>


<!-- ====== Solutions Hero LIST ====== -->
<style>
/* ===== Solutions Prototype (scoped) ===== */
.solutions-hero{padding:24px 0 12px}
.solutions-hero h2{font-weight:800;margin:0 0 .25rem}
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
      <h2 class="section-title">Solutions for Customers, Employees, and Systems</h2>
      <p class="muted">Mobile-first view: each column unfolds as you scroll — Customers → Employees → Systems.</p>
      <nav class="matrix-nav" aria-label="Jump to section">
        <a href="#col-customers">Customers</a>
        <a href="#col-employees">Employees</a>
        <a href="#col-systems">Systems</a>
      </nav>
    </header>

    <!-- TOP MERGED BOX -->
    <section class="solutions-promo" aria-labelledby="clevel-title">
      <h3 id="clevel-title">Consulting at the C-level — with our cofounders</h3>
      <p>Strategic advisory on digital trust, insurance systems, and ecosystem choices. Align roadmap, budgets, and delivery KPIs before you build.</p>
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

    <!-- BOTTOM MERGED BOX -->
    <section class="solutions-bottom" aria-labelledby="cicd-title">
      <h3 id="cicd-title">CI/CD Expert Team (partnership mode)</h3>
      <p>Dedicated team leveraging the matrix above to deliver on shared KPIs — from onboarding speed and STP, to release cadence and quality gates.</p>
    </section>

  </div>
  

<!-- ===================== RFP CTA (minimal, with single expandable area) ===================== -->
<style>
.section-rfp{background:var(--tq-ink);color:#fff;padding:36px 16px}
.section-rfp h2{margin:0 0 16px;font-weight:800;font-size:1.6rem;color:var(--tq-red);text-align:left}
.rfp-container{max-width:1110px;margin:0 auto}
.rfp-top{display:flex;flex-direction:column;gap:20px;margin-bottom:28px}
.rfp-top p{margin:0}
.rfp-actions{display:flex;flex-direction:column;gap:10px}
.rfp-actions .btn-primary{border:2px solid var(--tq-red);border-radius:32px;font-weight:600;padding:10px 20px;color:var(--tq-red);background:transparent}
.rfp-actions .btn-primary:hover{background:var(--tq-red);color:#fff}
.rfp-actions .btn-secondary{border:1px solid #666;border-radius:32px;font-weight:600;padding:10px 20px;background:transparent;color:#fff}
.rfp-actions .btn-secondary:hover{background:#333}
@media(min-width:768px){.rfp-top{flex-direction:row;justify-content:space-between;align-items:center}.rfp-actions{flex-direction:row}}

.rfp-bottom{background:#1f2329;border-radius:12px;padding:20px;display:grid;grid-template-columns:1fr;gap:16px}
@media(min-width:768px){.rfp-bottom{grid-template-columns:repeat(3,1fr)}}
.rfp-card h3{font-size:1.05rem;margin:0 0 6px}
.rfp-card p{margin:0 0 8px;color:#f3f4f6}
.rfp-card a{font-weight:600;color:var(--tq-blue);text-decoration:none}
.rfp-card a:hover{color:#4a90ff}

/* expandable area (single instance below grid) */
.rfp-expand{display:none;margin-top:14px}
.rfp-expand.on{display:block}
.rfp-expanel{display:none;background:#0f1117;border:1px solid #1e232b;border-radius:10px;padding:14px}
.rfp-expanel.on{display:block}
.rfp-expanel h4{margin:0 0 8px;font-weight:800;font-size:1rem}
.rfp-expanel a{color:var(--tq-blue);font-weight:600}
</style>

<section id="rfp" class="section-rfp" aria-labelledby="rfp-title">
  <div class="rfp-container">
    <h2 id="rfp-title">Start your rfp</h2>

    <div class="rfp-top">
      <p>New customers get €300 in free credits to try our Insurance Platform and other EU-compliant solutions.</p>
      <div class="rfp-actions">
        <a href="<?php echo esc_url( site_url('/consultation') ); ?>" class="btn-primary">Get started for free</a>
        <a href="<?php echo esc_url( site_url('/contact') ); ?>" class="btn-secondary">Contact sales</a>
      </div>
    </div>

    <div class="rfp-bottom" id="rfpGrid">
      <div class="rfp-card">
        <h3>Standalone App Dev (RFP)</h3>
        <p>Browse quickstarts, tutorials, or interactive walkthroughs for Insurance Platform Engine.</p>
        <a href="#" data-panel="p-quickstarts" aria-controls="p-quickstarts" aria-expanded="false">Browse quickstarts</a>
      </div>
      <div class="rfp-card">
        <h3>Custom Project Quote (RFQ)</h3>
        <p>Choose a learning path, build your skills, and validate your knowledge with Insurance Skills Boost.</p>
        <a href="#" data-panel="p-paths" aria-controls="p-paths" aria-expanded="false">Browse learning paths</a>
      </div>
      <div class="rfp-card">
        <h3>CI/CD Insource/Outsource (RFI)</h3>
        <p>Learn and experiment with pre-built solution templates handpicked by our experts.</p>
        <a href="#" data-panel="p-jumpstart" aria-controls="p-jumpstart" aria-expanded="false">Browse Jump Start Solutions</a>
      </div>
    </div>

    <!-- Single expandable area (content swaps based on clicked link) -->
    <div class="rfp-expand" id="rfpExpand" aria-live="polite">
      <div class="rfp-expanel" id="p-quickstarts" role="region">
        <h4>Quickstarts for Standalone Apps</h4>
        <ul>
          <li>PoC sprint template (R&amp;D week plan)</li>
          <li>Security gates: OWASP + ISO 27001 checkpoints</li>
          <li>Sample backlog (10–12 items) and KPI sheet</li>
        </ul>
        <p><a href="#">Open the full quickstarts library →</a></p>
      </div>

      <div class="rfp-expanel" id="p-paths" role="region">
        <h4>Learning paths for RFQ</h4>
        <ul>
          <li>Discovery → Estimation → Proposal flow</li>
          <li>Team mix calculator (roles/FTEs)</li>
          <li>Budget bands &amp; risk drivers template</li>
        </ul>
        <p><a href="#">See all learning paths →</a></p>
      </div>

      <div class="rfp-expanel" id="p-jumpstart" role="region">
        <h4>Jump Start Solutions (CI/CD)</h4>
        <ul>
          <li>DORA score snapshot &amp; 90-day playbook</li>
          <li>Insource/Outsource decision matrix</li>
          <li>SOC &amp; Pentest readiness checklist</li>
        </ul>
        <p><a href="#">Browse Jump Start templates →</a></p>
      </div>
    </div>
  </div>
</section>

<script>
/* One area expands under grid; content swaps based on link */
(function(){
  var grid=document.getElementById('rfpGrid');
  var wrap=document.getElementById('rfpExpand');
  var panels=wrap.querySelectorAll('.rfp-expanel');

  function showPanel(id, link){
    var panel=document.getElementById(id);
    var open=panel.classList.contains('on');

    // reset all
    panels.forEach(function(p){p.classList.remove('on')});
    grid.querySelectorAll('a[data-panel]').forEach(function(a){a.setAttribute('aria-expanded','false')});

    if(open){ wrap.classList.remove('on'); return; }

    panel.classList.add('on');
    wrap.classList.add('on');
    link.setAttribute('aria-expanded','true');
    panel.scrollIntoView({behavior:'smooth',block:'start'});
  }

  grid.addEventListener('click',function(e){
    var a=e.target.closest('a[data-panel]');
    if(!a) return;
    e.preventDefault();
    showPanel(a.getAttribute('data-panel'), a);
  });
})();
</script>

