<?php
// Template Name: Home Hero
$lang = pll_current_language();
get_header();

?>
<style id="home-hero">
/* ========== TINQIN Home Hero (single block) ========== */

/* Tokens */
.home-hero{
  --ink:#121417; --muted:#5b6570; --bg:#fff; --surface:#f6f7f9;
  --brand-red:#CE3531; --h1-gray:#8b95a4; --r-lg:24px;
  --mono:ui-monospace,SFMono-Regular,Consolas,Monaco,"Liberation Mono",Menlo,monospace;
  --tb:36px; /* titlebar height */
}

/* Section layout */
.home-hero{padding:clamp(8px,5vw,14px) 0 16px; background:var(--bg);}
.home-hero .hero-grid{display:grid;gap:clamp(24px,4vw,56px);align-items:center;grid-template-columns:minmax(0,640px) minmax(0,520px);}
@media(max-width:992px){.home-hero .hero-grid{grid-template-columns:1fr;gap:28px;}}

/* Left column */
.home-hero .hero-copy{max-width:720px;text-align:left;}
.home-hero .hero-copy h1,
.home-hero .hero-copy h1.hero-h1{font-family:Inter,ui-sans-serif,system-ui,"Segoe UI",Roboto,Helvetica,Arial;font-weight:800;letter-spacing:-.02em;line-height:1.18;margin:0 0 10px;font-size:clamp(32px,4vw,50px) !important;max-width:20ch;color:var(--h1-gray);}
.home-hero .hero-copy h1 mark{background:transparent;color:#54d38e;padding:0;margin:0;border:0;border-radius:0;line-height:inherit;box-shadow:none;text-decoration:none;}
@media(max-width:680px){.home-hero .hero-copy,.home-hero .hero-copy *{text-align:center;} .home-hero .hero-copy h1,.home-hero .hero-copy h1.hero-h1{max-width:18ch;margin:0 auto 12px;}}
.home-hero .hero-copy h2{font-weight:600;color:var(--ink);opacity:.95;font-size:clamp(18px,2.1vw,24px);line-height:1.33;margin:0 0 12px;max-width:32ch;}
.home-hero .hero-copy p:first-of-type{color:var(--muted);font-size:clamp(16px,1.6vw,18px);line-height:1.6;max-width:60ch;margin:0 0 24px;}

/* Promo banner */
.home-hero .promo-banner {
  display: flex;
  align-items: center;         /* vertically center text + icon */
  justify-content: space-between;
  width: min(100%, var(--lead-width, 60ch));
  padding: 12px 14px;           /* slightly tighter but still airy */
  margin: 0 0 8px;
  background: #fff1f1;
  border: 1px solid #f3c7c5;
  border-radius: 12px;
  color: #121417 !important;
  text-decoration: none !important;
  box-shadow: 0 2px 8px rgba(206,43,37,.08);
  gap: 12px;
}

.home-hero .promo-banner .promo-text {
  flex: 1 1 auto;              /* text grows/shrinks naturally */
  line-height: 1.35;
  margin: 0!important;                /* remove inherited bottom margin */
}

.home-hero .promo-banner b {
  color: #CE3531;
  font-weight: 700;
}

.home-hero .promo-banner .promo-icon {
  margin: 0!important;   
  flex: 0 0 28px;
  width: 28px;
  height: 28px;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 50%;
  background: #CE3531;
  color: #fff;
  box-shadow: 0 2px 8px rgba(206,43,37,.28);
}

.home-hero .promo-banner .promo-icon svg {
  width: 18px;
  height: 18px;
  fill: currentColor;
  display: block;
}

.home-hero .promo-banner:hover {
  filter: brightness(.98);
}

@media(max-width:680px){.home-hero .promo-banner{width:100%;}}

/* Buttons */
.home-hero .wp-block-buttons{display:flex;gap:12px 20px;flex-wrap:wrap;margin:0;}
.home-hero .wp-block-button .wp-block-button__link{padding:.78rem 1.25rem;border-radius:9999px;font-weight:600;font-size:16px;line-height:1;transition:background-color .15s,border-color .15s,color .15s,box-shadow .15s;box-shadow:none;}
.home-hero .wp-block-button:not(.is-style-outline) .wp-block-button__link{background:#f3f4f6;color:#121417;border:2px solid #CC2B25;}
.home-hero .wp-block-button:not(.is-style-outline) .wp-block-button__link:hover{background:#CC2B25;border-color:#CC2B25;color:#fff;}
.home-hero .wp-block-button.is-style-outline .wp-block-button__link{background:#fff;border:1px solid #d6dbe1;color:#121417;}
.home-hero .wp-block-button.is-style-outline .wp-block-button__link:hover{border-color:#c6ccd5;background:#fff;}

/* Right column: terminal card */
.hero-media{position:relative;aspect-ratio:1/1;width:100%;max-width:min(560px,42vw);justify-self:end;border-radius:24px;overflow:hidden;background:#0f1117;border:1px solid #1e232b;}
.hero-media>*{width:100%;height:100%;display:block;}
@media(max-width:992px){.hero-media{justify-self:start;max-width:520px;margin-inline:auto;aspect-ratio:auto;}}

/* Terminal */
.tq-term{display:grid;grid-template-rows:var(--tb) 1fr;background:#0f1117;height:100%;border-radius:8px;overflow:hidden;font-family:var(--mono);color:#e6edf3;}
.tq-titlebar{display:flex;align-items:center;gap:8px;padding:8px 12px;border-bottom:1px solid #1f2430;background:#141821;height:var(--tb);}
.tq-dot{width:10px;height:10px;border-radius:2px;background:#3a4250}.tq-red{background:#ae2f37;}
.tq-fn{margin-left:6px;font:12px/1 ui-sans-serif,system-ui,-apple-system,"Segoe UI",Roboto,Arial;color:#c9d4e3;}
.tq-out{margin:0;padding:14px 16px;box-sizing:border-box;overflow:auto;color:#e6e9ef;background:#0f1117;font:14px/1.5 var(--mono);white-space:pre-wrap;tab-size:2;-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;width:100%;max-width:none;overflow-wrap:anywhere;}
.tq-out *, .tq-out span, .tq-out .ok, .tq-out .cm, .tq-out .kw, .tq-out .prompt{font-family:var(--mono)!important;font-size:inherit;line-height:inherit;letter-spacing:0;}
.tq-out .kw{color:#7ab7ff;font-weight:600;}
.tq-out .ok{color:#54d38e;}
.tq-out .cm{color:#9aa3ad;font-style:italic;}
.tq-out .prompt{color:#00c853;font-weight:700;}

/* terminal tokens */
.ok  { color:#16a34a }                 /* green-ish success */
.cmd { color:#d97706 }                 /* amber/orange for commands */
.var { color:#a21caf }                 /* magenta for $VARS */
.num { color:#f4c2d7; font-weight:600; } /* pinkish white */
.cm  { color:#5b6570 }                 /* muted gray comments */


/* Cursor */
.tq-cursor{display:inline-block;width:14px;height:16px;background:#ae2f37;border-radius:2px;translate:0 2px;animation:tq-blink .9s steps(1) infinite;}
@keyframes tq-blink{50%{opacity:.15;}}

/* Mobile overrides */
@media(max-width:680px){
  .tq-titlebar{height:34px;}
  .tq-term{grid-template-rows:34px 1fr;min-height:350px;aspect-ratio:1/1;}
  .tq-out{font:11px/1.45 var(--mono);padding:12px;max-height:58vh;min-height:inherit;}
}

/* Mobile-only line breaks */
@media(max-width:768px){br.mobile-break{display:inline;}}
@media(min-width:769px){br.mobile-break{display:none;}}
@media (max-width:680px){
  .home-hero .hero-copy h1,
  .home-hero .hero-copy h1.hero-h1 {
    font-size: clamp(28px, 6vw, 32px);  /* bigger floor */
    max-width: 19ch;                    /* slightly wider */
  }

  .home-hero .wp-block-buttons {
    flex-wrap: nowrap;
    justify-content: center;
  }
  .home-hero .wp-block-buttons .wp-block-button__link {
    font-size: 14px;   /* slightly smaller text */
    font-size: 14px;   /* slightly smaller text */
    padding: .7rem 1rem;
    white-space: nowrap; /* prevent wrapping inside button */
  }
}
/* Mobile: give the hero a little breathing room below the fixed header */
@media (max-width: 991.98px){
.home-hero{padding:clamp(54px,5vw,14px) 0 16px; background:var(--bg);}
}

</style>



<div class="container mt-lg-2 mb-3 pt-lg-2 mt-2 pt-2">
  <div class="row">
	<section class="home-hero">
	  <div class="container">
		<div class="hero-grid">
		  <!-- Left: editable content from Gutenberg -->
		  <div class="hero-copy">
			<?php the_content(); ?>
		  </div>

		<!-- Right: terminal widget, square card -->
		<div class="hero-media">
		  <div class="tq-term" role="region" aria-label="Deployment terminal">
			<div class="tq-titlebar">
			  <span class="tq-dot"></span><span class="tq-dot tq-red"></span><span class="tq-dot"></span>
			  <span class="tq-fn">ssh tinqin@staging.insurance.co</span>
			</div>
			<pre id="tq-term-out" class="tq-out" aria-live="polite"></pre>
			<noscript>
			  <pre class="tq-out">
				$ deploy.TINQIN_customFix.sh
				$ git pull --rebase && npm ci && npm test -s
				Already up to date.
				 
				$ trivy fs . --sev HIGH,CRIT -q --exit-code 1
				0 vulnerabilities found
				 
				$ TAG=$(git rev-parse --short HEAD)
				91ab23c
				$ docker build -t ghcr.io/tinqin/tqweb:91ab23c .
				Successfully built 91ab23c
				$ docker push ghcr.io/tinqin/tqweb:91ab23c
				Pushed ghcr.io/tinqin/tqweb:91ab23c
				 
				$ helm upgrade --install tqweb charts/tqweb -n staging \
				  --set image.tag=91ab23c --atomic --wait --timeout 5m
				Release "tqweb" has been upgraded.
				$ kubectl rollout status deploy/tqweb -n staging
				deployment "tqweb" successfully rolled out
				$ 
			  </pre>
			</noscript>
		  </div>
		</div>

		</div>
	  </div>
	</section>
  </div>

  <!-- TINQIN Blog -->
          <?php

            $news = get_posts(
              array(
                'post_type'     => 'post',
                'numberposts'   => 3,
				  'ignore_sticky_posts' => true,
				  'category__in'        => [1, 8, 12],
				  'suppress_filters'    => false // keeps Polylang filters working
              )
            );
            if( $news ){
              ?>

  <div class="container" data-aos="fade-up" data-aos-duration='1000' data-aos-delay='200'>
    <div class="row">
      <div class="col-8 mb-lg-4 mb-md-3">
        <h2 class="section-title"><a href="<?php echo get_permalink( pll_get_post( 94 ) ); ?>"><?php echo function_exists('pll__') ? pll__('Latest from TINQIN') : 'Latest from TINQIN'; ?></a></h2>

      </div>
      <div class="col-4 text-right">
        <a href="<?php echo get_permalink( pll_get_post( 94 ) ); ?>"><?php pll_e( '>>', 'tinqin' ) ?></a>
      </div>
    </div>
    <div class="row">

              <?php
		      $delay = 50;
              foreach( $news as $position ){
				
                ?>

      <div class="col-lg-4 col-md-6 team-panel mb-lg-5 mb-4"  data-aos="fade-up" data-aos-duration='1000' data-aos-delay='<?php echo $delay; ?>'>
        <a href="<?php echo get_permalink( $position->ID ); ?>">
			<div style="">
          <img src="<?php echo get_the_post_thumbnail_url( $position->ID ) ?>" alt="<?php echo $position->post_title; ?>" class="img-fluid" />
			</div>
        </a>
        <a href="<?php echo get_permalink( $position->ID ); ?>" class="team-title ">
          <h3 class="font-weight-500"><?php echo $position->post_title; ?></h3>
        </a>
      </div>
                <?php
				$delay += 150;
              }
              ?>
    </div>
  </div>  

            <?php
        }
            ?>



  <!-- Quality primer -->
  <div class="accent-box tq-benefits--dark pt-5 pb-5 mt-lg-5 mt-md-3" id='parent-offer'>
    <div class="container">
      <div class="row">
        <div class="col-lg-12 mb-5 mt-4 text-center" data-aos="fade-up" data-aos-duration='1000' data-aos-delay='200'>
          <h2><?php pll_e( 'Можеш да разчиташ на TINQIN. Ето защо...' ) ?></h2>
        </div>
      </div>
      <div class="row mt-3 mb-3">
        <div class="col-md-4 text-center"  data-aos="fade-up" data-aos-duration='1000' data-aos-delay='350'>
			<div class="d-flex justify-content-center align-items-center" style="height:100px;">
				          <img src="<?php echo get_template_directory_uri(); ?>/images/tinqin-consultants.svg"  /  style="height:100%;">
			</div>

          <h5 class="mt-4"><?php pll_e( 'Познаваме клиентите ти, познаваме бизнеса ти! Нашите консултантите са на твое разположение!' ) ?></h5>
        </div>
        <div class="col-md-4 pt-3-small text-center "  data-aos="fade-up" data-aos-duration='1000' data-aos-delay='500'>
			<div class="d-flex justify-content-center align-items-center" style="height:100px;">
				          <img src="<?php echo get_template_directory_uri(); ?>/images/tinqin-technology.svg" /  style="height:100%;">
			</div>

          <h5 class="mt-4"><?php pll_e( 'Използваме последните и най-добри технологии, не следваме модите - създаваме ги!' ) ?></h5>
        </div>
        <div class="col-md-4 pt-3-small text-center"  data-aos="fade-up" data-aos-duration='1000' data-aos-delay='650'>
			<div class="d-flex justify-content-center align-items-center" style="height:100px;">
				          <img src="<?php echo get_template_directory_uri(); ?>/images/tinqin-quality.svg" / style="height:90%;">
			</div>

          <h5 class="mt-4"><?php pll_e( 'Фокусирани сме върху качеството и доброто изживяване за крайния потребител! Клиентите и служителите ти до заслужават!' ) ?></h5>
        </div>
      </div>
    </div>
  </div>    




  <!-- TINQIN Team primer -->
  <div class="container mb-lg-5 mb-sm-3">
    <div class="row">
      <div class="col-12 mb-5 mt-5 pt-4 pt-3-small" data-aos="fade-up" data-aos-duration='1000' data-aos-delay='200'>
        <h2 class="section-title"><?php pll_e( 'Как постигаме целите си' ) ?></h2>
        <p class="section-subtitle"><?php pll_e( 'В TINQIN вярваме, че всичко е постижимо. Ето защо изградихме екип от млади, мотивирани, талантливи и иновативни експерти.' ) ?></p>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12 text-center" id='parent-team'>
		<?php $rand = rand(1, 2); ?>
        <!-- <img data-aos="fade-up" data-aos-duration='1000' data-aos-delay='350' src="<?php echo get_template_directory_uri(); ?>/images/meet-the-team-1.jpg" class="img-fluid" /> -->
		<div class="col" data-aos="fade-up" data-aos-duration='1000' data-aos-delay='350' data-aos-anchor='#parent-team' data-aos-once="true">
			<a href="<?php echo get_permalink( pll_get_post( 35 ) ); ?>" class="mt-5 mb-5 btn btn-primary btn-lg"><?php pll_e( 'Запознай се с екипа' ) ?></a>
		</div>
      </div>
    </div>
  </div>
  

  <?php

    $testimonials = get_posts( array(
        'post_type'       => 'testimonials',
        'numberposts'     => 6,
        'orderby'         => 'rand',
        'meta_query' => array(
            array(
                'key' => 'tq-client-testimonial',
                'value' => 1,
                'compare' => '=',
                'type' => 'NUMERIC',
            ),
        ),
    ) );

    if( $testimonials ){

      ?>


  <!-- Client random post -->
  <div class="client-box tq-benefits--dark pt-5 pb-5" data-aos="fade-up" data-aos-duration='1000' data-aos-delay='200'>	  
	  <div id="testimonialCarousel" class="carousel slide" data-ride="carousel" data-interval="false">
		  <div class="carousel-inner"> 
			  <?php $i = 0; foreach ( $testimonials as $testimonal ) { ?>
			  <div class="carousel-item pb-5 <?php if( $i == 0 ) echo 'active'; ?>" style="position: relative;">
				  <div class="container">
					  <div class="row d-flex justify-content-center">
						  <div class="col-lg-7 col-md-12">
							  <h2 class="mb-3 white"><?php pll_e( 'Стани един от доволните ни клиенти!' ) ?></h2>
							  <?php echo $testimonal->post_content; ?>
						  </div>
						  <div class="col-lg-3 col-md-12 text-right" data-aos="fade-up" data-aos-duration='1000' data-aos-delay='350' data-aos-anchor='#parent1'>
							  <img src="<?php echo get_template_directory_uri(); ?>/images/icon-speech-bubble.svg"  /  style="max-width:180px;">
						  </div>	
					  </div>
				  </div>
			  </div>
			  <?php $i++; } ?>
		  </div>
		  <ol class="carousel-indicators">
			  <?php $i = 0; foreach ( $testimonials as $testimonal ) {
			  	if( $i == 0 ) $active = 'class="active"';
			  ?>
			  <li data-target="#testimonialCarousel" data-slide-to="<?php echo $i; ?>" <?php echo $active; ?>></li>
			  <?php $i++; } ?>
		  </ol>
	  </div>
  </div>  

      <?php

    }

  ?> 


<?php get_footer(); ?>


<script>
window.addEventListener('DOMContentLoaded', () => {
  const out = document.getElementById('tq-term-out');
  if (!out) return;

  // Speed knobs
  const TYPE_MS = 10;          // per char (lower = faster)
  const LINE_GAP = 380;        // between lines
  const EMPTY_DELAY = 1200;    // extra wait for blank lines
  const START_DELAY = 3000;    // 3s before typing starts

  const LINES_DESKTOP = [
    "$ deploy.TINQIN_customApp.sh",
    "+ git pull --rebase && npm ci && npm test",
    "Already up to date.",
    "342 tests passed (3.2s)",
    "+ trivy fs . --sev HIGH,CRIT -q --exit-code 1",
    "No vulnerabilities found",
    "",
    "+ TAG=$(git rev-parse --short HEAD) && echo $TAG",
    "91ab23c",
    "+ docker build -t ghcr.io/tinqin/tqweb:91ab23c .",
    "Successfully built 91ab23c",
    "",
    "+ docker push ghcr.io/tinqin/tqweb:91ab23c",
    "Pushed ghcr.io/tinqin/tqweb:91ab23c",
    "+ helm upgrade --install tqweb charts/tqweb -n",
    "  staging --set image.tag=91ab23c --wait",
    "Release \"tqweb\" upgraded.",
    "+ kubectl rollout status deploy/tqweb -n staging",
    "Deployment \"tqweb\" successfully rolled out",
  ];

  const LINES_MOBILE = [
    "$ deploy.TINQIN_customApp.sh",
    "+ git pull --rebase && npm ci && npm test",
    "Already up to date.",
    "342 tests passed (3.2s)",
    "+ trivy fs . --sev HIGH,CRIT -q --exit-code 1",
    "No vulnerabilities found",
    "+ TAG=$(git rev-parse --short HEAD) && echo $TAG",
    "91ab23c",
    "+ docker build -t ghcr.io/tinqin/tqweb:91ab23c .",
    "Successfully built 91ab23c",
    "+ docker push ghcr.io/tinqin/tqweb:91ab23c",
    "Pushed ghcr.io/tinqin/tqweb:91ab23c",
    "+ helm upgrade --install tqweb charts/tqweb -n",
    "  staging --set image.tag=91ab23c --wait",
    "Release \"tqweb\" upgraded.",
    "+ kubectl rollout status deploy/tqweb -n staging",
    "Deployment \"tqweb\" successfully rolled out",
  ];

  const LINES = window.matchMedia('(max-width:680px)').matches ? LINES_MOBILE : LINES_DESKTOP;

  // Red brand cursor
  const cursor = document.createElement('span');
  cursor.className = 'tq-cursor';
  out.appendChild(cursor);

  // Split into parts with classes:
  // 1) ok words, 2) variables like $TAG, 3) shell comments, 4) the 'echo' command
  function splitParts(text) {
    const esc = text; // no HTML escaping in this snippet
    const parts = [];
    let lastIndex = 0;

const regex = new RegExp(
  "\\b(Successfully|successfully|upgraded|Running|Pushed|found|Already up to date|tests passed|built)\\b" +
  "|(\\becho\\b|\\b(?:git|npm|trivy|docker|helm|kubectl)\\b)" +
  "|(\\$[A-Za-z_][A-Za-z0-9_]*|91ab23c)" + 
  "|((?<![A-Za-z])\\d+(?:\\.\\d+)?(?:%|ms|[smhd])?(?![A-Za-z]))" +
  "|(#[^\\n]*)",
  "g"
);


    let match;
    while ((match = regex.exec(esc))) {
      if (match.index > lastIndex) {
        parts.push({ text: esc.slice(lastIndex, match.index), cls: null });
      }
      if (match[1]) {
        parts.push({ text: match[1], cls: 'ok' });
      } else if (match[2]) {
        parts.push({ text: match[2], cls: 'cmd' }); // echo → orange
      } else if (match[3]) {
        parts.push({ text: match[3], cls: 'var' }); // $VARS → magenta
      } else if (match[4]) {
	  parts.push({ text: match[4], cls: 'num' }); // numbers (incl. 3.2s, 5m, 100%)
	} else if (match[5]) {
	  parts.push({ text: match[5], cls: 'cm' });  // comments
	}
      lastIndex = regex.lastIndex;
    }
    if (lastIndex < esc.length) {
      parts.push({ text: esc.slice(lastIndex), cls: null });
    }
    return parts;
  }

  function typeLine(original) {
    return new Promise(resolve => {
      const row = document.createElement('div');
      out.insertBefore(row, cursor); // keep cursor always last

      // Empty line: insert &nbsp; and wait longer
      if (original === "") {
        row.innerHTML = "&nbsp;";
        setTimeout(resolve, LINE_GAP + EMPTY_DELAY);
        return;
      }

      let text = original;

      // Handle prompt at start
      if (text.startsWith('$ ')) {
        const p = document.createElement('span');
        p.className = 'prompt';
        p.textContent = '$ ';
        row.appendChild(p);
        text = text.slice(2);
      }

      const parts = splitParts(text);
      let partIndex = 0, charIndex = 0, span = null;

      (function tick() {
        if (partIndex >= parts.length) {
          setTimeout(resolve, LINE_GAP);
          return;
        }
        const part = parts[partIndex];
        if (charIndex === 0) {
          span = document.createElement('span');
          if (part.cls) span.className = part.cls;
          row.appendChild(span);
        }
        span.textContent += part.text[charIndex++];
        if (charIndex < part.text.length) {
          setTimeout(tick, TYPE_MS);
        } else {
          partIndex++; charIndex = 0;
          setTimeout(tick, TYPE_MS);
        }
      })();
    });
  }

  (async function run(){
    await new Promise(r => setTimeout(r, START_DELAY));
    for (const line of LINES) {
      await typeLine(line);
    }

    // realistic ending: prompt + cursor, same line
    const row = document.createElement('div');
    const p = document.createElement('span');
    p.className = 'prompt';
    p.textContent = '$ ';
    row.appendChild(p);
    row.appendChild(cursor); // keep cursor blinking here
    out.appendChild(row);
  })();
});
</script>


<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "SoftwareOrganization",
  "name": "TINQIN",
  "url": "https://www.tinqin.com",
  "logo": "https://www.tinqin.com/wp-content/themes/tinqin/images/logo.svg",
  "foundingDate": "2013",
  "description": "TINQIN develops custom software solutions for the insurance and finance industries across Europe.",
  "founders": [
    {
      "@type": "Person",
      "name": "Jean-Charles Miginiac"
    },
    {
      "@type": "Person",
      "name": "François Miginiac"
    }
  ],
"location": [
  {
    "@type": "Place",
    "name": "TINQIN Sofia",
    "address": {
      "@type": "PostalAddress",
      "streetAddress": "Megapark115G Tsarigradsko shose Blvd, , fl. 5",
      "addressLocality": "Sofia",
      "postalCode": "1784",
      "addressCountry": "BG"
    },
    "telephone": "+359 2 8056898"
  },
  {
    "@type": "Place",
    "name": "TINQIN Paris",
    "address": {
      "@type": "PostalAddress",
      "streetAddress": "15 – 17 rue Scribe",
      "addressLocality": "Paris",
      "postalCode": "75009",
      "addressCountry": "FR"
    },
    "telephone": "+33 1 85730282"
  }
],
  "numberOfEmployees": "520",
  "email": "engage@tinqin.com",
  "telephone": "+359 2 805 68 98",
  "sameAs": [
    "https://www.linkedin.com/company/tinqin",
    "https://www.facebook.com/tinqin.solutions" 
  ]
}
</script>