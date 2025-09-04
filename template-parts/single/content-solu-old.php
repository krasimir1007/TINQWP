<?php
// Template Name: Solutions Hero
$lang = function_exists('pll_current_language') ? pll_current_language() : '';
get_header();
?>
<style id="home-hero">
/* ========== TINQIN Solutions Hero (single block, trimmed CSS + CLS fixes) ========== */

/* Tokens (only what we use here) */
.home-hero{
  --ink:#121417;
  --muted:#5b6570;
  --bg:#fff;
  --brand-red:#CE3531;
  --h1-gray:#8b95a4;
}

/* Section layout */
.home-hero{padding:clamp(8px,5vw,14px) 0 16px;background:var(--bg);}
.home-hero .hero-grid{
  display:grid;gap:clamp(24px,4vw,24px);align-items:center;
  grid-template-columns:1fr 1fr; /* 1 copy, 1/3 image */
  max-width:1140px;margin:0 auto;
}
@media (max-width:992px){
  .home-hero .hero-grid{grid-template-columns:1fr;gap:28px;}
}

/* Left column (copy) */
.home-hero .hero-copy{max-width:720px;text-align:left;}
.home-hero .hero-copy h1{
  /* Web-safe stack (no webfont) */
  font-family: Arial, system-ui, -apple-system, "Segoe UI", Roboto, Helvetica, sans-serif;
  font-weight:800;letter-spacing:-.02em;line-height:1.18;
  margin:0 0 10px;font-size:clamp(28px,4vw,32px);max-width:38ch;color:var(--h1-gray);
}
.home-hero .hero-copy h2{
  font-weight:600;color:var(--ink);opacity:.95;
  font-size:clamp(18px,2.1vw,24px);line-height:1.33;margin:0 0 12px;max-width:52ch;
}
.home-hero .hero-copy p:first-of-type{
  color:var(--muted);font-size:clamp(16px,1.6vw,18px);line-height:1.6;max-width:70ch;margin:0 0 24px;
}
@media (max-width:680px){
  .home-hero .hero-copy,.home-hero .hero-copy *{text-align:center;}
  .home-hero .hero-copy h1{max-width:21ch;margin:0 auto 12px;}
}

/* Promo banner (Gartner-style) */
.home-hero .promo-banner{
  display:flex;align-items:center;justify-content:space-between;gap:12px;
  width:min(100%,60ch);padding:12px 14px;margin:0 0 8px;
  background:#fff1f1;border:1px solid #f3c7c5;border-radius:12px;
  color:#121417;text-decoration:none;box-shadow:0 2px 8px rgba(206,43,37,.08);
}
.home-hero .promo-banner .promo-text{flex:1 1 auto;line-height:1.35;margin:0;}
.home-hero .promo-banner b{color:var(--brand-red);font-weight:700;}
.home-hero .promo-banner .promo-icon{
  flex:0 0 28px;width:28px;height:28px;display:flex;align-items:center;justify-content:center;
  border-radius:50%;background:var(--brand-red);color:#fff;box-shadow:0 2px 8px rgba(206,43,37,.28);
}
.home-hero .promo-banner:hover{filter:brightness(.98);}
@media (max-width:680px){.home-hero .promo-banner{width:100%;}}

/* Buttons (match theme style) */
.home-hero .wp-block-buttons{display:flex;gap:12px 20px;flex-wrap:wrap;margin:0;}
.home-hero .wp-block-button .wp-block-button__link{
  padding:.78rem 1.25rem;border-radius:9999px;font-weight:600;font-size:16px;line-height:1;transition:.15s;box-shadow:none;
}
.home-hero .wp-block-button:not(.is-style-outline) .wp-block-button__link{background:#f3f4f6;color:#121417;border:2px solid var(--brand-red);}
.home-hero .wp-block-button:not(.is-style-outline) .wp-block-button__link:hover{background:var(--brand-red);border-color:var(--brand-red);color:#fff;}
.home-hero .wp-block-button.is-style-outline .wp-block-button__link{background:#fff;border:1px solid #d6dbe1;color:#121417;}
.home-hero .wp-block-button.is-style-outline .wp-block-button__link:hover{border-color:#c6ccd5;background:#fff;}
@media (max-width:680px){
  .home-hero .wp-block-buttons{flex-wrap:nowrap;justify-content:center;}
  .home-hero .wp-block-button .wp-block-button__link{font-size:14px;padding:.7rem 1rem;white-space:nowrap;}
}

/* Right column: featured image — CLS-safe */
.hero-media{
  justify-self:end;border-radius:24px;overflow:hidden;
  max-width:380px;aspect-ratio:1/1; /* reserve space to prevent CLS */
}
.hero-media picture{display:block;}
.hero-media img{display:block;width:100%;height:100%;object-fit:cover;}
@media (max-width:992px){
  .hero-media{justify-self:center;max-width:382px;margin-inline:auto;}
}

/* ================================================================
   HOW IT WORKS — CLS-hardened (web-safe fonts + reserved sizes)
   ================================================================= */
.section-how{
  background:#121417;
  color:#fff;
  padding:28px 0;
  font-family: Arial, system-ui, -apple-system, "Segoe UI", Roboto, Helvetica, sans-serif; /* prevent font-swap reflow */
}

/* container independent of Bootstrap */
.solutions-container{width:100%;max-width:1100px;margin:0 auto;padding:0;}

.section-how h2{
  font-weight:800;font-size:1.375rem;line-height:1.2;margin:0 0 14px;color:#fff;
}

/* Reserve layout space for the whole grid before paint.
   If this section is above-the-fold, prefer min-height values (see note below). */
.section-how .grid{
  display:grid;grid-template-columns:1fr;gap:18px;
  content-visibility:auto;                 /* defer offscreen, avoids late shifts */
  contain-intrinsic-size: 560px;           /* reserved block height (tune if needed) */
}

/* LEFT: copy block — reserve a minimum, prevents push when text wraps */
.section-how .copy{
  background:rgba(255,255,255,.06);
  border:1px solid rgba(255,255,255,.12);
  border-radius:12px;
  padding:16px;
  min-height: 180px;                       /* small floor to avoid jitter */
}
.section-how .copy p{color:#f4f6f8;margin:0 0 12px;}
.section-how .copy .lead{font-size:1.05rem;font-weight:700;color:#fff;}

/* CTA button (unchanged) */
.section-how .tq-btn{
  display:inline-block;border:2px solid #CE3531;color:#CE3531;background:#fff;
  border-radius:28px;padding:10px 16px;font-weight:600;font-size:.95rem;text-decoration:none;transition:.2s;
}
.section-how .tq-btn:hover,.section-how .tq-btn:focus{background:#CE3531;color:#fff;box-shadow:0 0 0 3px rgba(206,53,49,.18);outline:0;}
.section-how .cta-row{margin-top:8px;}
.section-how .cta-note{display:block;font-size:.85rem;color:#ffdedc;margin-top:6px;}

/* RIGHT: media tiles — set intrinsic sizing for row stack + fixed tile height */
.section-how [aria-label="Process overview"]{
  content-visibility:auto;
  contain-intrinsic-size: 270px;           /* ~3 tiles × ~90px default each */
}

.media-tile{
  background:rgba(255,255,255,.06);
  border:1px solid rgba(255,255,255,.12);
  border-radius:12px;
  padding:12px;
  display:grid;
  grid-template-columns:56px 1fr;
  gap:12px;
  align-items:center;
  min-height: 84px;                        /* reserve per-tile height */
}
.media-tile+.media-tile{ margin-top:10px; }

.media-icon{
  width:56px; height:56px;
  border-radius:12px; background:#fff; color:#121417;
  display:flex; align-items:center; justify-content:center;
  font-weight:800; font-size:1rem;
  aspect-ratio:1/1;                        /* ensure stable square box */
}

.media-copy h4{margin:0 0 2px; font-weight:800; font-size:1rem; color:#fff;}
.media-copy p{margin:0; color:#e9ecef; font-size:.94rem;}

@media (min-width:768px){
  .section-how h2{font-size:1.5rem;}
  .section-how .grid{grid-template-columns:1fr 1fr; gap:24px; contain-intrinsic-size: 420px;} /* two columns need less reserved height */
}


/* ================================================================
   PRODUCTS / ACCELERATORS (Row list, 1/3 meta : 2/3 content)
   ================================================================= */
.section-products{
  --ink:#121417; --muted:#5b6570; --red:#CE3531;
  background:#fff; padding:24px 0; border-top:1px solid #f0f2f5;
}
.section-products .section-head{margin:0 0 10px;}
.section-products .eyebrow{
  font-size:.75rem;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:var(--muted);
}

/* list wrapper */
.features-list{display:grid;grid-template-columns:1fr;gap:12px;}

/* one row = 1/3 : 2/3 on md+, stacked on mobile */
.feature-row{
  display:grid;grid-template-columns:1fr;gap:10px;
  padding:8px 12px;border:1px solid #e5e7eb;border-radius:12px;background:#fff;
  transition:transform .15s ease, box-shadow .15s ease, border-color .15s ease;
  /* CLS guard: reserve space until fonts/content paint */
  content-visibility:auto;contain-intrinsic-size:260px;
}
.feature-row:hover{transform:translateY(-1px);box-shadow:0 6px 16px rgba(18,20,23,.06);border-color:#e2e2e2;}
@media (min-width:768px){.feature-row{grid-template-columns:1fr 2fr;gap:18px;}}

/* left: tag + headline */
.feature-meta{display:block;}
.feature-meta h3{
  margin:0 0 6px;font-weight:800;font-size:1.05rem;color:var(--ink);
}

/* tag list container */
.tag-list{display:flex;flex-wrap:wrap;gap:8px;}

/* base pill (softer, accessible) */
.tag{
  display:inline-block;padding:4px 10px;line-height:1;font-size:.75rem;font-weight:700;
  border-radius:999px;border:1px solid #e5e8ee;background:#f3f4f6;color:#2b3036;white-space:nowrap;
}

/* tag types */
.tag.industry{background:#f6f7fb;border-color:#e3e7f0;color:#3a4150;}
.tag.application{background:#eef5ff;border-color:#d7e6ff;color:#1a73e8;}
.tag.integration{background:#eefaf3;border-color:#d5f0e0;color:#2f7d4c;}

.tag:focus,.tag:hover{box-shadow:0 0 0 3px rgba(26,115,232,.12);outline:0;}

/* container padding only on mobile (your alignment tweak) */
@media (max-width:768px){
  .solutions-container{padding:0 16px;}
}
/* ================================================================
   CI/CD box layout (hero right column)
   ================================================================= */
	  .hero-cicd-box{display:flex;justify-content:center;align-items:center}
	  .cicd-wrap{width:100%;max-width:550px}                 /* ~half screen on desktop */
	  .cicd-wrap svg{display:block;width:100%;height:auto}   /* responsive SVG */
	  @media (max-width:768px){ .cicd-wrap{max-width:none} } /* full width on mobile */

	  /* === Animation tokens (web-safe) === */
	  .cicd-wrap{
		--ink:#121417; --brand-red:#CE3531; --accent:#1a73e8;
		--dur:6s;           /* lap duration */
		--stroke:22;        /* loop thickness */
		--dot:18;           /* dot thickness */
	  }

	  /* Moving dots */
	  .cicd-tracer{
		stroke:#fff; stroke-width:var(--dot); stroke-linecap:round; fill:none;
		stroke-dasharray:.04 1;
		animation: cicd-orbit var(--dur) linear infinite, cicd-fade-h var(--dur) linear infinite;
		filter:drop-shadow(0 1px 2px rgba(0,0,0,.25));
	  }
	  .cicd-tracer.t2{ animation-delay: calc(-1 * var(--dur) / 3), calc(-1 * var(--dur) / 3); }
	  .cicd-tracer.t3{ animation-delay: calc(-2 * var(--dur) / 3), calc(-2 * var(--dur) / 3); }

	  @keyframes cicd-orbit { to { stroke-dashoffset:-1; } }
	  /* Fade only at LEFT/RIGHT extremes (approx. 25% & 75% of the path) */
	  @keyframes cicd-fade-h { 0%,50%,100%{opacity:1} 10%,90%{opacity:.4} 25%,75%{opacity:0} 40%,80%{opacity:.4
	  }}

	  @media (prefers-reduced-motion:reduce){ .cicd-tracer{animation:none;opacity:1} }

	  /* Caption */
	  .cicd-label{margin-top:.5rem;text-align:center;font:14px/1.3 Arial,system-ui,-apple-system,"Segoe UI",Roboto,Helvetica,sans-serif;color:var(--ink)}
</style>

<section class="home-hero">
  <div class="container mb-lg-5 mb-3">
    <div class="hero-grid">
      <!-- Left: Gutenberg content (H1/H2/copy/buttons/promo) -->
      <div class="hero-copy">
        <?php the_content(); ?>
      </div>

<div class="cicd-wrap" aria-label="CI/CD animation">
	  <!-- Tight box: minimal whitespace (extremes near edges). viewBox 0 0 720 500; path peaks ~x:20/700, y:20/480 -->
	  <svg width="720" height="500" viewBox="0 0 720 500" role="img" aria-labelledby="cicdTitle cicdDesc">
		<title id="cicdTitle">CI/CD infinity animation</title>
		<desc id="cicdDesc">Three dots orbit an infinity symbol; dots fade at left and right extremes to suggest feedback flowing from production back to integration.</desc>

		<defs>
		  <linearGradient id="cicd-grad" x1="0" y1="0" x2="720" y2="500" gradientUnits="userSpaceOnUse">
			<stop offset="0"   stop-color="var(--brand-red)"/>
			<stop offset=".55" stop-color="var(--ink)"/>
			<stop offset="1"   stop-color="var(--accent)"/>
		  </linearGradient>
		</defs>

		<!-- Infinity path STARTING AT CENTER (tight geometry) -->
		<!-- Center = (360,250); top/bottom ~20/480; left/right ~20/700 -->
		<path d="M360,250
				 C480,20  700,20  700,250
				 C700,480 480,480 360,250
				 C240,480  20,480   20,250
				 C20,20   240,20   360,250"
			  fill="none"
			  stroke="url(#cicd-grad)"
			  stroke-width="var(--stroke)"
			  stroke-linecap="round"
			  stroke-linejoin="round"/>

		<!-- Three moving dots (evenly phased) -->
		<path class="cicd-tracer" pathLength="1" stroke-dasharray=".04 3"
			  d="M360,250
				 C480,20  700,20  700,250
				 C700,480 480,480 360,250
				 C240,20  20,20   20,250
				 C20,480   240,480   360,250"/>
		<path class="cicd-tracer t2" pathLength="1" stroke-dasharray=".04 1"
			  d="M360,250
				 C480,20  700,20  700,250
				 C700,480 480,480 360,250
				 C240,20  20,20   20,250
				 C20,480   240,480   360,250"/>
		<path class="cicd-tracer t3" pathLength="1" stroke-dasharray=".04 .3"
			  d="M360,250
				 C480,20  700,20  700,250
				 C700,480 480,480 360,250
				 C240,20  20,20   20,250
				 C20,480   240,480   360,250"/>

		<!-- Connector line to caption (just below center to avoid overlap) -->
		<line x1="360" y1="258" x2="360" y2="500" stroke="var(--ink)" stroke-width="2"/>
	  </svg>

	  <div class="cicd-label">
		<?php
		  // Polylang caption (fallback to EN if Polylang not active)
		  echo function_exists('pll__')
			? pll__('CI/CD · Intégration & Livraison Continues')
			: 'CI/CD · Integration & Continuous Delivery';
		?>
	  </div>
	</div>
    </div>
  </div>

</section>

<!-- ===================== HOW IT WORKS (HIGH-CONTRAST + CTA) ===================== -->
<section class="section-how" aria-labelledby="how-title">
  <div class="solutions-container">
    <h2 id="how-title">How it works</h2>
    <div class="grid">
      <!-- LEFT: Problem → Approach → Value -->
      <div class="copy">
        <p class="lead">Problem → Complex change of legacy systems.</p>
        <p><strong>Approach →</strong> An agile, senior team runs an R&amp;D sprint with pre-built accelerators. We quickly prove value against a tightly scoped user journey.</p>
        <p><strong>Value →</strong> In weeks, you have a secure PoC in production-like conditions, clear metrics, and a path to scale without lock-in.</p>

        <div class="cta-row">
          <a class="tq-btn" href="<?php echo esc_url( site_url('/consultation') ); ?>">Start your proof of concept</a>
          <span class="cta-note">Typical PoC: 2–4 weeks, joint team, measurable KPIs.</span>
        </div>
      </div>

      <!-- RIGHT: Icon stack / media tiles (MVP placeholders) -->
      <div aria-label="Process overview">
        <div class="media-tile">
          <div class="media-icon" aria-hidden="true">1</div>
          <div class="media-copy">
            <h4>Discovery</h4>
            <p>Target a single journey. Define KPIs and integration points.</p>
          </div>
        </div>

        <div class="media-tile">
          <div class="media-icon" aria-hidden="true">2</div>
          <div class="media-copy">
            <h4>Build with guards</h4>
            <p>Wire SAST/DAST/SCA and quality gates into CI/CD.</p>
          </div>
        </div>

        <div class="media-tile">
          <div class="media-icon" aria-hidden="true">3</div>
          <div class="media-copy">
            <h4>Demo &amp; handover</h4>
            <p>Run in a production-like env with live KPIs.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ====== Solutions Hero LIST ====== -->
<style>
/* ===== Solutions Prototype (scoped) ===== */
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

<!-- ====== HERO BOX ====== -->
<section class="home-hero">
  <div class="container mb-lg-5 mb-3">
    <div class="hero-grid">
      <!-- Left: Gutenberg content (H1/H2/copy/buttons/promo) -->
      <div class="hero-copy">
        <?php the_content(); ?>
      </div>

      <!-- Right: Featured image via <picture> (mobile 1x/2x + desktop 1x/2x) -->
		<div class="hero-media">
		  <picture>
			<source media="(max-width: 768px)" sizes="382px"
			  srcset="<?php echo get_template_directory_uri(); ?>/images/solutions-hero-mobile@1x.webp 360w,
					  <?php echo get_template_directory_uri(); ?>/images/solutions-hero-mobile@2x.webp 720w,
					  <?php echo get_template_directory_uri(); ?>/images/solutions-hero-mobile@3x.webp 1146w">
			<source media="(min-width: 769px)" sizes="380px"
			  srcset="<?php echo get_template_directory_uri(); ?>/images/solutions-hero-desktop@1x.webp 380w,
					  <?php echo get_template_directory_uri(); ?>/images/solutions-hero-desktop@2x.webp 760w">
			<img
			  src="<?php echo get_template_directory_uri(); ?>/images/solutions-hero-desktop@1x.webp"
			  alt="TINQIN Solutions illustration"
			  width="380" height="380"
			  fetchpriority="high" decoding="async">
		  </picture>
		</div>

</section>




<!-- ====== FEATURES LIST ====== -->
<section class="section-products" aria-labelledby="solutions-products-title">
  <div class="solutions-container">
    <div class="section-head">
      <span class="eyebrow">Features</span>
    </div>

    <div class="features-list" role="list" aria-label="TINQIN accelerators and solution starters">
      <!-- Row 1 -->
      <article class="feature-row" role="listitem" id="feature-policy-claims">
        <div class="feature-meta">
          <h3>Policy &amp; Claims Starter</h3>
          <div class="tag-list" aria-label="Tags">
            <span class="tag industry">Insurance</span>
            <span class="tag application">Claims</span>
            <span class="tag integration">Core/CRM</span>
          </div>
        </div>
        <div class="feature-content">
          <ul class="bullets">
            <li>Core flows for FNOL, reserving, subrogation</li>
            <li>ISO/IEC 27001-aligned SDLC &amp; auditing hooks</li>
            <li>Connectors for pricing, fraud, CRM</li>
          </ul>
        </div>
      </article>

      <!-- Row 2 -->
      <article class="feature-row" role="listitem" id="feature-appsec">
        <div class="feature-meta">
          <h3>AppSec Pipeline Kit</h3>
          <div class="tag-list" aria-label="Tags">
            <span class="tag industry">Insurance</span>
            <span class="tag application">Security</span>
            <span class="tag integration">AIA Server</span>
          </div>
        </div>
        <div class="feature-content">
          <ul class="bullets">
            <li>DAST/SAST/SCA templates for CI/CD</li>
            <li>Threat modeling &amp; SBOM export</li>
            <li>OWASP ASVS quick checks</li>
          </ul>
        </div>
      </article>

      <!-- Row 3 -->
      <article class="feature-row" role="listitem" id="feature-eidas">
        <div class="feature-meta">
          <h3>eIDAS Trust Modules</h3>
          <div class="tag-list" aria-label="Tags">
            <span class="tag industry">Insurance</span>
            <span class="tag application">Identity</span>
            <span class="tag integration">Qualified e-Sign</span>
          </div>
        </div>
        <div class="feature-content">
          <ul class="bullets">
            <li>Qualified e-signature &amp; sealing</li>
            <li>Remote ID verification flows</li>
            <li>Audit trails &amp; time-stamping</li>
          </ul>
        </div>
      </article>

      <!-- Row 4 -->
      <article class="feature-row" role="listitem" id="feature-soc">
        <div class="feature-meta">
          <h3>SOC-Ready Telemetry</h3>
          <div class="tag-list" aria-label="Tags">
            <span class="tag industry">Insurance</span>
            <span class="tag application">Observability</span>
            <span class="tag integration">SIEM/SOAR</span>
          </div>
        </div>
        <div class="feature-content">
          <ul class="bullets">
            <li>Unified logs &amp; alerts schema</li>
            <li>MITRE mappings &amp; runbooks</li>
            <li>Cloud/on-prem deploy patterns</li>
          </ul>
        </div>
      </article>

      <!-- Row 5 -->
      <article class="feature-row" role="listitem" id="feature-analytics">
        <div class="feature-meta">
          <h3>Claims Analytics Pack</h3>
          <div class="tag-list" aria-label="Tags">
            <span class="tag industry">Insurance</span>
            <span class="tag application">Analytics</span>
            <span class="tag integration">Data Lake</span>
          </div>
        </div>
        <div class="feature-content">
          <ul class="bullets">
            <li>Loss ratio &amp; leakage dashboards</li>
            <li>Explainable risk scoring</li>
            <li>Export to data lake/warehouse</li>
          </ul>
        </div>
      </article>

      <!-- Row 6 -->
      <article class="feature-row" role="listitem" id="feature-rd-lab">
        <div class="feature-meta">
          <h3>R&amp;D Lab Sprint</h3>
          <div class="tag-list" aria-label="Tags">
            <span class="tag industry">Insurance</span>
            <span class="tag application">Delivery</span>
            <span class="tag integration">DevSecOps</span>
          </div>
        </div>
        <div class="feature-content">
          <ul class="bullets">
            <li>2–4 week PoC blueprint</li>
            <li>KPIs, security gates, demo day</li>
            <li>Handover playbook</li>
          </ul>
        </div>
      </article>
    </div>
  </div>
</section>



<?php
/**
 * Paste this near the end of footer.php, right before </body>.
 * Pure inline CSS + HTML + JS. No external files.
 */
?>
<style>
/* --- External Media Consent: minimal, mobile-first, TINQIN style --- */
.tq-ext-overlay{position:relative;border:1px solid #e5e7eb;border-radius:12px;background:#f3f4f6;overflow:hidden}
.tq-ext-overlay .tq-reserved{width:100%;aspect-ratio:16/9;display:block}
.tq-ext-overlay .tq-mask{position:absolute;inset:0;display:flex;align-items:center;justify-content:center;flex-direction:column;text-align:center;background:rgba(255,255,255,.94);padding:14px}
.tq-ext-overlay .tq-mask p{margin:0 0 .5rem;color:#121417;font:500 14px/1.4 Inter,system-ui,-apple-system,"Segoe UI",Roboto,Helvetica,Arial,sans-serif}
.tq-ext-overlay .tq-actions{display:flex;gap:8px;flex-wrap:wrap;justify-content:center}
.tq-btn{appearance:none;border:1px solid #5b6570;background:#fff;border-radius:999px;padding:8px 12px;font:600 14px/1 Inter,system-ui,-apple-system,"Segoe UI",Roboto,Helvetica,Arial,sans-serif;cursor:pointer}
.tq-btn--primary{border-color:#CE3531}
.tq-btn--primary:hover{background:#CE3531;color:#fff}
.tq-remember{margin-top:6px;font:500 12px/1.4 Inter,system-ui,-apple-system,"Segoe UI",Roboto,Helvetica,Arial,sans-serif;color:#5b6570}

/* Bottom sheet */
.tq-sheet{position:fixed;left:0;right:0;bottom:0;z-index:9999;transform:translateY(100%);transition:transform .28s ease;box-shadow:0 -8px 24px rgba(0,0,0,.12)}
.tq-sheet--open{transform:translateY(0)}
.tq-sheet__inner{background:#ffffff;border-top:3px solid #CE3531;border-radius:12px 12px 0 0;padding:14px 16px}
.tq-sheet h3{margin:0 0 6px;font:800 16px/1.2 Inter,system-ui,-apple-system,"Segoe UI",Roboto,Helvetica,Arial,sans-serif;color:#121417}
.tq-sheet p{margin:0 0 10px;font:500 14px/1.4 Inter,system-ui,-apple-system,"Segoe UI",Roboto,Helvetica,Arial,sans-serif;color:#121417}
.tq-sheet .tq-actions{justify-content:flex-start}
.tq-sheet .tq-link{font:600 13px/1.4 Inter,system-ui,-apple-system,"Segoe UI",Roboto,Helvetica,Arial,sans-serif;color:#1a73e8;text-decoration:underline;cursor:pointer;margin-left:8px}
@media (min-width:768px){.tq-sheet__inner{padding:16px 18px}}
</style>

<!-- Bottom Sheet (appears only if external media detected and no stored choice) -->
<div id="tqExtSheet" class="tq-sheet" aria-hidden="true" role="dialog" aria-label="External media privacy">
  <div class="tq-sheet__inner">
    <h3>External media (Maps & Video)</h3>
    <p>For privacy and performance, we block YouTube/Google Maps until you enable them.</p>
    <div class="tq-actions">
      <button type="button" class="tq-btn tq-btn--primary" data-tq="sheet-allow">Enable external media</button>
      <button type="button" class="tq-btn" data-tq="sheet-deny">Continue without</button>
      <span class="tq-link" data-tq="sheet-close" aria-label="Close">Close</span>
    </div>
  </div>
</div>

<script>
/*!
 * TINQIN minimal external-media consent
 * Blocks YouTube/Vimeo/Google Maps iframes until user consents.
 * Stores choice in localStorage (no cookies).
 */
(function(){
  var KEY = 'tq_ext_media_consent'; // 'yes' | 'no'
  var SELECTOR = 'iframe[src*="youtube.com" i],iframe[src*="youtu.be" i],iframe[src*="vimeo.com" i],iframe[src*="google.com/maps" i],iframe[src*="google.bg/maps" i]';

  var sheet = document.getElementById('tqExtSheet');
  var state = localStorage.getItem(KEY); // may be null on first visit
  var hasExternal = false;

  /**
   * Wrap a third-party iframe with a consent overlay.
   * Creates reserved box to avoid CLS and defers loading until allowed.
   */
  function wrapIframe(iframe){
    // Already handled?
    if (iframe.dataset.tqWrapped) return;

    // Extract src, width/height for aspect ratio if present
    var src = iframe.getAttribute('src');
    if (!src) return;
    hasExternal = true;

    // Reserve aspect-ratio from attributes if available
    var w = parseInt(iframe.getAttribute('width') || '', 10);
    var h = parseInt(iframe.getAttribute('height') || '', 10);
    var ratio = (w > 0 && h > 0) ? (w + '/' + h) : '16/9';

    // Build wrapper
    var wrapper = document.createElement('div');
    wrapper.className = 'tq-ext-overlay';
    var reserved = document.createElement('div');
    reserved.className = 'tq-reserved';
    reserved.style.aspectRatio = ratio;

    var mask = document.createElement('div');
    mask.className = 'tq-mask';
    var p = document.createElement('p');
    // Service label
    var label = 'External media';
    try {
      var u = new URL(src);
      if (/youtube|youtu\.be/i.test(u.hostname)) label = 'YouTube';
      else if (/vimeo/i.test(u.hostname)) label = 'Vimeo';
      else if (/google\./i.test(u.hostname) && /maps/i.test(u.pathname+u.search)) label = 'Google Maps';
    } catch(e){}

    p.textContent = label + ' is blocked until you allow external media.';
    var actions = document.createElement('div');
    actions.className = 'tq-actions';

    var btnOnce = document.createElement('button');
    btnOnce.type = 'button';
    btnOnce.className = 'tq-btn tq-btn--primary';
    btnOnce.textContent = 'Load once';

    var btnAlways = document.createElement('button');
    btnAlways.type = 'button';
    btnAlways.className = 'tq-btn';
    btnAlways.textContent = 'Enable always';

    var rememberWrap = document.createElement('div');
    rememberWrap.className = 'tq-remember';
    rememberWrap.innerHTML = '<label><input type="checkbox" data-tq="remember"> remember my choice</label>';

    actions.appendChild(btnOnce);
    actions.appendChild(btnAlways);
    mask.appendChild(p);
    mask.appendChild(actions);
    mask.appendChild(rememberWrap);

    // Move iframe -> wrapper, defer src
    iframe.setAttribute('data-tq-src', src);
    iframe.removeAttribute('src'); // prevent immediate load
    iframe.setAttribute('loading', 'lazy');
    iframe.setAttribute('referrerpolicy', 'no-referrer');
    iframe.style.display = 'none'; // hidden until allowed

    wrapper.appendChild(reserved);
    wrapper.appendChild(mask);
    iframe.parentNode.insertBefore(wrapper, iframe);
    wrapper.appendChild(iframe);

    // Handlers
    btnOnce.addEventListener('click', function(){
      hydrateIframe(iframe, wrapper);
    });

    btnAlways.addEventListener('click', function(){
      var remember = wrapper.querySelector('input[data-tq="remember"]');
      if (remember && remember.checked) {
        localStorage.setItem(KEY, 'yes');
      }
      allowAll(); // load all
    });

    iframe.dataset.tqWrapped = '1';
  }

  function hydrateIframe(iframe, wrapper){
    var src = iframe.getAttribute('data-tq-src');
    if (!src) return;
    iframe.setAttribute('src', src);
    iframe.style.display = '';
    // remove mask for this one
    var mask = wrapper.querySelector('.tq-mask');
    if (mask) mask.remove();
  }

  function allowAll(){
    localStorage.setItem(KEY, 'yes');
    document.querySelectorAll('iframe[data-tq-src]').forEach(function(ifr){
      var wrap = ifr.closest('.tq-ext-overlay');
      hydrateIframe(ifr, wrap || ifr.parentNode);
    });
    closeSheet();
  }

  function denyAll(){
    localStorage.setItem(KEY, 'no');
    closeSheet();
  }

  function openSheet(){
    if (!sheet) return;
    sheet.classList.add('tq-sheet--open');
    sheet.setAttribute('aria-hidden','false');
  }

  function closeSheet(){
    if (!sheet) return;
    sheet.classList.remove('tq-sheet--open');
    sheet.setAttribute('aria-hidden','true');
  }

  // Init on DOM ready
  document.addEventListener('DOMContentLoaded', function(){
    // Find and wrap target iframes
    document.querySelectorAll(SELECTOR).forEach(wrapIframe);

    // If user has allowed before, hydrate all immediately
    if (localStorage.getItem(KEY) === 'yes') {
      allowAll();
    } else {
      // If there are blocked items and no stored choice, show bottom sheet once per session
      if (hasExternal && state == null) {
        openSheet();
      }
    }
  });

  // Bottom sheet actions
  document.addEventListener('click', function(e){
    var t = e.target;
    if (!t) return;
    if (t.matches('[data-tq="sheet-allow"]')) {
      allowAll();
    } else if (t.matches('[data-tq="sheet-deny"]')) {
      denyAll();
    } else if (t.matches('[data-tq="sheet-close"]')) {
      closeSheet();
    }
  });

  // Expose a small API for a footer “Privacy settings” link if you add one
  window.TQExternalMedia = {
    openSettings: function(){ openSheet(); },
    reset: function(){ localStorage.removeItem(KEY); openSheet(); }
  };
})();
</script>




<div class="cicd-label">
  <span class="label-default">
    <!-- Left triangle -->
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 10"
         width="1em" height="1em" style="vertical-align:-0.15em;margin-right:.35em">
      <polygon points="10,0 0,5 10,10" fill="currentColor"/>
    </svg>
    <strong>&nbsp;&nbsp;&nbsp;BOUCLES CI|CD ALIGNÉES&nbsp;</strong>
    <!-- Right triangle -->
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 10"
         width="1em" height="1em" style="vertical-align:-0.15em;margin-left:.35em">
      <polygon points="0,0 10,5 0,10" fill="currentColor"/>
    </svg>
    <br/>Livraisons régulières &raquo; Base de code unifiée<br/>Tests automatisés &laquo; Qualité & Sécurité
  </span>

  <span class="label-left">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 10"
         width="1em" height="1em" style="vertical-align:-0.15em;margin-right:.35em">
      <polygon points="10,0 0,5 10,10" fill="currentColor"/>
    </svg>
    <strong>BOUCLE TINQIN</strong><br/>Pipeline DevSecOps<br/>Concevoir & Delivrer
  </span>

  <span class="label-right">
    <strong>BOUCLE CLIENT</strong>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 10"
         width="1em" height="1em" style="vertical-align:-0.15em;margin-left:.35em">
      <polygon points="0,0 10,5 0,10" fill="currentColor"/>
    </svg>
    <br/>Pipeline Production<br/>Validation & Découverte
  </span>
</div>






