<?php
// Template Name: Home Hero Test
$lang = pll_current_language();
get_header();

?>

<style id="home-hero">
/* ===========================
   TINQIN Home Hero (single block)
   =========================== */

/* Tokens */
.home-hero{
  --ink:#121417; --muted:#5b6570; --bg:#fff; --surface:#f6f7f9;
  --brand-red:#CE3531; --h1-gray:#8b95a4; --r-lg:24px;
}

/* Section layout */
.home-hero{padding-top:clamp(28px,5vw,64px); padding-bottom:16px; background:var(--bg);}
.home-hero .hero-grid{
  display:grid; gap:clamp(24px,4vw,56px); align-items:center;
  grid-template-columns:minmax(0,640px) minmax(0,520px);
}
@media (max-width:992px){ .home-hero .hero-grid{grid-template-columns:1fr; gap:28px;} }

/* Left column */
.home-hero .hero-copy{max-width:720px;}
.home-hero .hero-copy, .home-hero .hero-copy .has-text-align-center{ text-align:left; }

/* H1 */
.home-hero .hero-copy h1,
.home-hero .hero-copy h1.hero-h1{
  font-family:Inter, ui-sans-serif, system-ui, "Segoe UI", Roboto, Helvetica, Arial;
  font-weight:800; letter-spacing:-.02em; line-height:1.06; margin:0 0 12px;
  font-size:clamp(34px,4vw,50px); max-width:14ch; color:var(--h1-gray);
}
.home-hero .hero-copy h1 mark{
  background:transparent; color:#CE3531; padding:0; margin:0; border:0; border-radius:0; line-height:inherit; box-shadow:none; text-decoration:none;
}
.home-hero .hero-copy h1 mark::selection{ background:rgba(206,43,37,.18); }
@media (forced-colors: active){ .home-hero .hero-copy h1 mark{ color:ButtonText; background:transparent; } }
@media print{ .home-hero .hero-copy h1 mark{ background:transparent; color:#c00; } }

/* H2 and lead */
.home-hero .hero-copy h2{
  font-weight:600; color:var(--ink); opacity:.95;
  font-size:clamp(18px,2.1vw,24px); line-height:1.35; margin:0 0 14px; max-width:32ch;
}
.home-hero .hero-copy p:first-of-type,
.home-hero .hero-copy .hero-lead{
  color:var(--muted); font-size:clamp(16px,1.6vw,18px); line-height:1.65; max-width:60ch;
  margin:0 0 28px;
}

/* Buttons */
.home-hero .wp-block-buttons{display:flex; column-gap:20px; row-gap:12px; flex-wrap:wrap; margin:0;}
.home-hero .wp-block-button .wp-block-button__link{
  padding:.78rem 1.25rem; border-radius:9999px; font-weight:600; font-size:16px; line-height:1;
  transition:background-color .15s ease, border-color .15s ease, color .15s ease, box-shadow .15s ease; box-shadow:none;
}
.home-hero .wp-block-button:not(.is-style-outline) .wp-block-button__link{ background:#f3f4f6; color:#121417; border:2px solid #CC2B25; }
.home-hero .wp-block-button:not(.is-style-outline) .wp-block-button__link:hover{ background:#CC2B25; border-color:#CC2B25; color:#fff; }
.home-hero .wp-block-button.is-style-outline .wp-block-button__link{ background:#fff; border:1px solid #d6dbe1; color:#121417; }
.home-hero .wp-block-button.is-style-outline .wp-block-button__link:hover{ border-color:#c6ccd5; background:#fff; }

/* Right column container, 1:1 dark terminal card */
.hero-media{
  position:relative; aspect-ratio:1/1; width:100%; max-width:min(560px,42vw);
  justify-self:end; border-radius:24px; overflow:hidden;
  background:#0f1117; border:1px solid #1e232b;
}
.hero-media > *{width:100%; height:100%; display:block;}
@media(max-width:992px){ .hero-media{justify-self:start; max-width:520px; margin-inline:auto;} }

/* Dark terminal */
.tq-term{display:grid; grid-template-rows:40px 1fr; background:#0f1117;}
.tq-titlebar{
  display:flex; align-items:center; gap:8px; padding:10px 12px;
  border-bottom:1px solid #1f2430; background:#141821;
}
.tq-dot{width:10px; height:10px; border-radius:2px; background:#3a4250;}
.tq-red{background:#ae2f37;}
.tq-fn{margin-left:6px; font:12px/1 ui-sans-serif,system-ui,-apple-system,"Segoe UI",Roboto,Arial; color:#c9d4e3;}

/* Terminal output (bigger font, dark bg) */
.tq-out{
  margin:0; padding:16px 18px; overflow:hidden;
  font:15px/1.7 ui-monospace,SFMono-Regular,Consolas,Monaco,monospace;
  color:#e6e9ef; background:#0f1117;
  white-space:pre-wrap; tab-size:2;
}

/* Accents on dark */
.tq-out .kw{color:#7ab7ff; font-weight:600;}
.tq-out .ok{color:#54d38e;}
.tq-out .cm{color:#9aa3ad; font-style:italic;}

/* Brand cursor */
.tq-cursor{display:inline-block; width:14px; height:14px; background:#ae2f37; border-radius:2px; translate:0 2px; animation:tq-blink .9s steps(1) infinite;}
@keyframes tq-blink{50%{opacity:.15;}}

/* Logos headline */
.home-hero + .container.mt-lg-5.mb-lg-5.mt-3.mb-3{margin-top:8px!important;}
.home-hero-logos{padding-top:10px; padding-bottom:16px; background:var(--bg);}
.home-hero-logos .logos-title{font-weight:700; color:var(--muted); font-size:clamp(16px,1.6vw,18px); letter-spacing:.01em; margin:0 0 8px 8px;}
.home-hero-logos .customer-logos .slide{display:flex !important; align-items:center; justify-content:center;}
.home-hero-logos .customer-logos img{height:52px; width:auto; max-width:170px; object-fit:contain; filter:none; opacity:.95; transition:transform .15s ease, opacity .15s ease;}
.home-hero-logos .customer-logos img:hover{transform:translateY(-1px); opacity:1;}
.home-hero-logos .slick-list{mask-image:linear-gradient(to right, transparent 0, #000 24px, #000 calc(100% - 24px), transparent 100%);}

/* Remove legacy wrappers gap above hero */
.container.mt-lg-5.mb-3.pt-lg-5.mt-3.pt-5{margin-top:0 !important; padding-top:0 !important;}

/* Mobile centering */
@media(max-width:680px){
  .home-hero .hero-copy, .home-hero .hero-copy *{text-align:center;}
}

/* Promo banner */
.home-hero .hero-copy{ --lead-width:60ch; }
.home-hero .promo-banner{
  display:flex; align-items:center; gap:12px;
  width:min(100%, var(--lead-width)); padding:12px 14px; margin:0 0 18px;
  background:#fff1f1; color:#121417; border:1px solid #f3c7c5; border-radius:12px; text-decoration:none;
}
.home-hero .promo-banner .promo-text{flex:1 1 auto;}
.home-hero .promo-banner b{color:#CE3531;}
.home-hero .promo-banner .promo-icon{
  margin-left:16px; width:28px; height:28px; flex:0 0 28px;
  display:grid; place-items:center; border-radius:9999px; background:#CE3531; color:#fff;
  box-shadow:0 2px 8px rgba(206,43,37,.28);
}
.home-hero .promo-banner .promo-icon svg{width:18px; height:18px; fill:currentColor;}
.home-hero .promo-banner:hover{filter:brightness(.98);}
@media (max-width:680px){ .home-hero .promo-banner{ width:100%; } }
</style>




<div class="container mt-lg-5 mb-3 pt-lg-5 mt-3 pt-5">
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
      <span class="tq-fn">deploy.TINQIN_customFix.sh</span>
    </div>
    <pre id="tq-term-out" class="tq-out" aria-live="polite"></pre>
    <noscript>
      <pre class="tq-out">
		$ export APP=tq-web ENV=staging
		$ git fetch --all
		$ git checkout main
		$ git pull --rebase
		$ TAG=$(git rev-parse --short HEAD)
		$ docker build -t ghcr.io/tinqin/$APP:$TAG .
		$ docker push ghcr.io/tinqin/$APP:$TAG
		$ helm upgrade --install $APP charts/$APP -n $ENV --set image.tag=$TAG
		Release "$APP" upgraded in namespace "$ENV"
		$ kubectl rollout status deploy/$APP -n $ENV
		deployment "$APP" successfully rolled out
		$ curl -fsS https://$APP.$ENV.tinqin.cloud/health
		{ "status":"ok","commit":"$TAG" }
		$ ENV=prod
		$ helm upgrade --install $APP charts/$APP -n $ENV --set image.tag=$TAG
		Release "$APP" upgraded in namespace "$ENV"
		$ kubectl rollout status deploy/$APP -n $ENV
		deployment "$APP" successfully rolled out
		$ echo "Deployed $APP:$TAG to prod"
		DONE
      </pre>
    </noscript>
  </div>
</div>



<script>
(function(){
  const out = document.getElementById('tq-term-out');
  if(!out) return;

  // Knobs
  const TYPE_MS = 8;    // lower = faster
  const LINE_GAP = 120;  // pause between lines

  // ~20 lines, staging then prod
  const LINES = [
"$ deploy.TINQIN_customFix.sh",
"$ export APP=tq-web ENV=staging",
"$ git pull --rebase && npm ci && npm test --silent",
"$ trivy fs . --quiet                     # sec scan",
"$ TAG=$(git rev-parse --short HEAD)      # commit tag",
"$ docker build -t ghcr.io/tinqin/${APP}:$TAG . && \\",
"  docker push ghcr.io/tinqin/${APP}:$TAG # build+push",
"$ helm upgrade --install ${APP} charts/${APP} -n $ENV \\",
"  --set image.tag=$TAG   # deploy",
"$ kubectl rollout status deploy/${APP} -n $ENV && \\",
"  kubectl get pods -n $ENV -l app=${APP} # verify",
"$ curl -fsS https://staging.tinqin.com/health | jq .status",
"healthy        # app OK",
"$ notify: slack #devops \"${APP}@$TAG deployed to $ENV\"",
"$ audit: artifacts stored, change approved by prod",
"$ DONE",
"$ " // blinking cursor
  ];

  // Red square brand cursor
  const cursor = document.createElement('span');
  cursor.className = 'tq-cursor';

  let lineIdx = 0;

  function typeLine(txt){
    return new Promise(resolve => {
      const line = document.createElement('div');
      out.appendChild(line);

      let i = 0;
      function nextChar(){
        // slow down a bit for longer lines
        const delay = TYPE_MS + (i % 12 === 0 ? 6 : 0);
        line.textContent = txt.slice(0, i++);
        line.appendChild(cursor);
        if(i <= txt.length){ setTimeout(nextChar, delay); }
        else resolve();
      }
      nextChar();
    });
  }

  async function run(){
    for(; lineIdx < LINES.length; lineIdx++){
      /* decorate a few tokens cheaply for readability */
      const raw = LINES[lineIdx]
        .replace(/\b(helm|kubectl|docker|git|curl|echo)\b/g,'<span class="kw">$1</span>')
        .replace(/\b(successfully|ok|upgraded)\b/g,'<span class="ok">$1</span>')
        .replace(/# .*/g,'<span class="cm">$&</span>');

      // temp element to strip innerHTML markers back into text during typing
      const tmp = document.createElement('div'); tmp.innerHTML = raw;
      const plain = tmp.textContent;

      await typeLine(plain);
      await new Promise(r => setTimeout(r, LINE_GAP));
    }
    // keep the cursor blinking on the last line
    const last = out.lastChild;
    if(last) last.appendChild(cursor);
  }

  run();
})();
</script>


		</div>
	  </div>
	</section>
  </div>
<!-- Clients -->
  <div class="container mt-lg-5 mb-lg-5 mt-3 mb-3" data-aos="fade-up" data-aos-duration='1000' data-aos-delay='200'>
	<section class="home-hero-logos">
	  <div class="container" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
		<section class="customer-logos slider">
		  <?php
		  $logos = get_posts(array(
			'post_type'   => 'testimonials',
			'numberposts' => -1
		  ));
		  if ($logos) {
			foreach ($logos as $logo) {
			  ?>
			  <div class="slide">
				<img src="<?php echo esc_url( get_the_post_thumbnail_url($logo->ID) ); ?>"
					 alt="<?php echo esc_attr( $logo->post_title ); ?>">
			  </div>
			  <?php
			}
		  }
		  ?>
		</section>
	  </div>
	</section>
  </div>


  
  <!-- TINQIN Blog -->
          <?php

            $news = get_posts(
              array(
                'post_type'     => 'post',
                'numberposts'   => 6,
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
        <img data-aos="fade-up" data-aos-duration='1000' data-aos-delay='350' src="<?php echo get_template_directory_uri(); ?>/images/meet-the-team-1.jpg" class="img-fluid" />
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