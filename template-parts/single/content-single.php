<style id="post-editorial">
/* Tokens */
body.single-post{
  --accent:#CE3531;
  --ink:#14171a; --muted:#5b6570; --rule:#e5e7eb;
  --meta-bg:#343a40;  /* dark gray pill */
  --meta-text:#fff;
  --serif:Georgia,"Times New Roman",serif;
  --sans:ui-sans-serif,system-ui,-apple-system,"Segoe UI",Roboto,Helvetica,Arial;
}

/* Article card */
body.single-post .container.news .col-md-12{
  background:#fff; color:var(--ink); line-height:1.7;
  width:100%; margin:0 auto; padding:clamp(10px,4vw,40px);
  border-radius:14px; box-shadow:0 10px 30px rgba(20,23,26,.06);
  font-family:var(--sans);
}

/* Sticky header wraps title + date */
@media (min-width: 992px){
  .post-sticky-header{
    position: sticky; top: 0; z-index: 6;
    background:#fff; padding-block:.4rem; box-shadow:0 1px 0 rgba(0,0,0,.06);
  }
  .post-sticky-header .section-title{ margin:0 0 .4rem; }
  .post-sticky-header .section-subtitle.post-date{ margin:.2rem 0 0; }
}
body.admin-bar .post-sticky-header{ top:32px; } /* WP admin bar */

/* Main title with left accent, kill any theme bullet */
body.single-post h2.section-title{
  position:relative; background:none; border:0;
  font-family:var(--serif); font-weight:800;
  font-size:clamp(28px,4vw,40px); line-height:1.15;
  padding-left:14px; margin:0 0 .5rem 0; color:var(--ink);
}
body.single-post h2.section-title::before{ content:none !important; }
body.single-post h2.section-title::after{
  content:""; position:absolute; left:0; top:.2em; bottom:.2em;
  width:6px; border-radius:4px; background:var(--accent);
}

/* Date pill, wide, dark, with progress fill */
body.single-post .section-subtitle.post-date{
  width:calc(100% - 12px); margin:.5rem auto 1.25rem;
  background:var(--meta-bg); color:var(--meta-text);
  text-align:center; padding:.5rem 1rem; border-radius:.75rem;
  font-weight:600; letter-spacing:.2px; font-size:.95rem;
  position:relative; overflow:hidden; isolation:isolate;
}
body.single-post .section-subtitle.post-date i{ display:none; }
body.single-post .section-subtitle.post-date .date-label{ position:relative; z-index:2; }

/* progress fill, 0..1 via --progress or CSS scroll when supported */
body.single-post .section-subtitle.post-date::after{
  content:""; position:absolute; inset:0; z-index:1;
  background:var(--accent); opacity:.32; transform-origin:0 50%;
  transform:scaleX(var(--progress, 0));
}
@supports (animation-timeline: scroll()){
  body.single-post .section-subtitle.post-date::after{
    transform:none; animation:tinqin-read linear both; animation-timeline:scroll(root);
  }
  @keyframes tinqin-read{ from{clip-path:inset(0 100% 0 0);} to{clip-path:inset(0 0 0 0);} }
}

/* Section headings with red accent bars */
body.single-post .col-md-12 h2.wp-block-heading,
body.single-post .col-md-12 h3.wp-block-heading{
  font-family:var(--serif); font-weight:700; line-height:1.25; color:var(--ink);
  margin:2rem 0 .6rem; padding-left:.85rem; position:relative;
}
body.single-post .col-md-12 h2.wp-block-heading{ font-size:clamp(22px,2.6vw,30px); }
body.single-post .col-md-12 h3.wp-block-heading{ font-size:clamp(20px,2.2vw,26px); }
body.single-post .col-md-12 h2.wp-block-heading::before,
body.single-post .col-md-12 h3.wp-block-heading::before{
  content:""; position:absolute; left:0; top:.2em; bottom:.2em;
  width:4px; border-radius:3px; background:var(--accent);
}

/* Fallback for plain H2s inside the article, exclude the main title */
body.single-post .col-md-12 h2:not(.section-title):not(.wp-block-post-title):not(.wp-block-heading){
  font-family:var(--serif); font-weight:700; margin:2rem 0 .6rem; color:var(--ink);
  padding-left:.85rem; position:relative;
}
body.single-post .col-md-12 h2:not(.section-title):not(.wp-block-post-title):not(.wp-block-heading)::before{
  content:""; position:absolute; left:0; top:.2em; bottom:.2em;
  width:4px; border-radius:3px; background:var(--accent);
}

/* Utility: opt out of accents anywhere */
h1.no-accent, h2.no-accent, h3.no-accent{ padding-left:0 !important; }
h1.no-accent::before, h2.no-accent::before, h3.no-accent::before,
h1.no-accent::after,  h2.no-accent::after,  h3.no-accent::after{ content:none !important; }

/* Body text and links */
body.single-post .col-md-12 > p:first-of-type{ font-size:1.125rem; color:var(--muted); }
body.single-post .col-md-12 a{ color:var(--accent); text-decoration:none; border-bottom:1px solid currentColor; }
body.single-post .col-md-12 a:hover{ opacity:.85; }

/* Quotes, rules, tables, mobile card */
body.single-post .col-md-12 blockquote,
body.single-post .col-md-12 .wp-block-quote,
body.single-post .col-md-12 .wp-block-pullquote{
  margin:1.4rem 0; padding:1rem 1.2rem;
  background:rgba(206,53,49,.06); border-left:4px solid var(--accent);
  border-radius:10px; font-style:italic;
}
body.single-post .col-md-12 hr{
  border:0; height:1px;
  background:linear-gradient(90deg, rgba(206,53,49,.3), rgba(206,53,49,0));
  margin:2rem 0;
}
body.single-post .col-md-12 table{ width:100%; border-collapse:collapse; margin:1rem 0; font-size:.98rem; }
body.single-post .col-md-12 th, body.single-post .col-md-12 td{
  padding:.6rem .5rem; border-top:1px solid var(--rule); text-align:left;
}
@media (max-width:576px){
  body.single-post .container.news .col-md-12{ padding:18px; box-shadow:none; border-radius:0; }
}
</style>


<?php
// Template Name: Single blog post template
global $post;
?>

  <div class="container news mt-1 pt-1">
    <div class="row">
      <div class="col-12">
        <div class="row">
			<div class="col-md-12">

				<div class="post-sticky-header">
				  <h2 class="section-title"><?php the_title(); ?></h2>
				  <p class="section-subtitle post-date mb-1">
					<span class="date-label">
					  <time datetime="<?php echo esc_attr( get_the_date('c') ); ?>">
						<?php echo esc_html( get_the_date('d.m.Y') ); ?>
					  </time>
					</span>
				  </p>
				</div>

			  <?php the_content(); ?>
			</div>

      </div>
    </div>
  </div>