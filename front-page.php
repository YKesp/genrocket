<?php /* Template Name: Updated-home-2025 */ ?>
<?php get_header(); ?>
<style>
	.newslider, .newslider-banner{
	
			height:auto !important;
	}
	.newslider .slide, .newslider-banner .slide{
			position:static;
		}
	.slide .caption h1, .slide .caption{
		color:#fff !important;
	}
	.slide .caption h1 span{color:#a6d540;}
	.newslider .slide .caption, .newslider-banner .slide .caption {
		position: absolute;
		left: 0;
		right: 0;
		top: 0;
		transform: unset;
		z-index: 1;
		color: #fff;
		padding: 110px 0;
		font: 30px/1.4 'Catamaran',sans-serif !important;
	}
	#main .btn-primary {
		min-width: 186px;
		padding: 10px 20px 9px 20px;
		line-height: 25px;
		border-radius: 10px;
		font-size: 18px;
		font-weight: 700;
		text-transform: uppercase;
		background: #24ace3;
		border: none;
	}
	.d-flex.gap-3{
		gap:40px;
	}
	.btn-primary:hover {
	  background: #24e3cf;
	}
	#main .btn-primary-outline {
		min-width: 186px;
		padding: 11px 20px 9px 20px;
		line-height: 25px;
		border-radius: 10px;
		font-size: 18px;
		font-weight: 700;
		text-transform: uppercase;
		border:2px solid #24ace3;
		color:#fff !important;
	}
	.btn-primary-outline:hover {
	  background: #24ace3;
	}
	.bg-bluish-gray{
		background:#e9f0f3;
	}
	.bg-thin{
		background:#f4f8f9;
	}
	@media screen and (max-width:1199px){
		.newslider .slide .caption, .newslider-banner .slide .caption {
			padding: 30px 0;
			font: 20px/1.4 'Catamaran',sans-serif !important;
		}
	}
	@media screen and (max-width:991px){
		.image-resize {
			max-width: 100%;
			margin: 0 auto;
			height: auto;
			display: block;
		}
		 .newslider .slide .caption h1, .newslider-banner .slide .caption h1 {
			font-size: 40px;
		  }
		.newslider, .newslider-banner {		
			height:auto !important;
		}
		.newslider .slide .caption, .newslider-banner .slide .caption {
			padding:30px 0;
			font: 18px/1.3 'Catamaran',sans-serif !important;
			background:transparent !important;
			justify-content: start!important;
		}
		.newslider .slide, .newslider-banner .slide{
			position:static;
		}
		.d-flex.gap-3{
			gap:10px;
		}
		#main .btn-primary, #main .btn-primary-outline{
			font-size: 15px;
		}
	}
	@media screen and (max-width:767px){
		.newslider .slide .caption h1, .newslider-banner .slide .caption h1{font-size:70px}
		.newslider .slide .caption, .newslider-banner .slide .caption {
			font: 34px/1.4 'Catamaran',sans-serif !important;
			max-width: 540px !important;
		}
		.newslider-banner .slide .caption br{display:none !important;}
		.slide .caption h1 span{
			display:block;
		}
		#main .btn-primary, #main .btn-primary-outline{
			font-size: 18px;
		}
	}
	@media screen and (max-width:639px){
		.newslider .slide .caption h1, .newslider-banner .slide .caption h1{font-size:40px}
		.newslider .slide .caption, .newslider-banner .slide .caption {
			padding: 9%;
			font: 19px/1.3 'Catamaran',sans-serif !important;
			background:transparent !important;
			justify-content: start!important;
		}
		.d-flex.gap-3{
			gap:10px;
		}
		#main .btn-primary, #main .btn-primary-outline{
			font-size: 15px;
			min-width:204px;
		}
	}
	@media screen and (max-width:574px){
		.newslider .slide .caption h1, .newslider-banner .slide .caption h1{font-size:30px}
		.newslider .slide .caption, .newslider-banner .slide .caption {
			padding: 9%;
			font: 17px/1.3 'Catamaran',sans-serif !important;
			/*background:rgba(0,92,155,0.7) !important;*/
			background:transparent !important;
			justify-content: start!important;
		}
		.d-flex.gap-3{
			gap:10px;
		}
		#main .btn-primary, #main .btn-primary-outline{
			font-size: 15px;
		}
	}
	
	:root {
  /* ── GenRocket Official Brand Colors ── */
  --gr-blue:        #27BFF0;   /* Primary sky blue */
  --gr-blue-dark:   #23A6DE;   /* Secondary blue */
  --gr-green:       #A6D540;   /* Primary lime green */
  --gr-green-dark:  #6DBF42;   /* Secondary green */
  --gr-navy:        #213C4B;   /* Dark navy — main dark bg */
  --gr-navy-deep:   #172E3A;   /* Slightly deeper navy for hero */
  --gr-navy-mid:    #1A3344;   /* Mid navy for gradients */
  --gr-light-bg:    #E9F0F3;   /* Light background */
  --gr-white:       #FFFFFF;
  --gr-off:         #F4F8FA;   /* Off-white section bg */
  --gr-text:        #213C4B;   /* Body text = brand navy */
  --gr-muted:       #5A7280;   /* Muted text */
  --gr-border:      rgba(255,255,255,0.12);
  /* ── Secondary palette for accents ── */
  --gr-amber:       #FFC000;
  --gr-orange:      #ED7D31;
  --gr-purple:      #5C3497;
  /* ── Layout ── */
  --gr-radius:      12px;
  --gr-radius-sm:   8px;
  font-family: 'Montserrat', 'Gotham', 'Arial', sans-serif;
  color: var(--gr-text);
}

.gr-page { 
  width: 100%; overflow-x: hidden; 
}

/* ---- UTILITY ---- */
.gr-container { max-width: 1200px; margin: 0 auto; padding: 0 24px; }
.gr-section { padding: 80px 0; }
.gr-section-sm { padding: 48px 0; }
.gr-badge {
  display: inline-block; font-size: 11px; font-weight: 600;
  letter-spacing: .06em; text-transform: uppercase;
  padding: 4px 12px; border-radius: 20px; margin-bottom: 12px;
}
/* Brand-correct badge colors */
.gr-badge-purple { background: rgba(39,191,240,0.12); color: var(--gr-blue-dark); }
.gr-badge-teal   { background: rgba(166,213,64,0.18); color: #3D6B10; }
.gr-badge-amber  { background: rgba(255,192,0,0.15); color: #7A5500; }
.gr-badge-white  { background: rgba(255,255,255,0.12); color: rgba(255,255,255,0.9); border: 1px solid rgba(255,255,255,0.2); }
/* Typography — Gotham web substitute = Montserrat */
.gr-h1 { font-family: 'Montserrat', 'Gotham', sans-serif; font-size: clamp(32px, 4vw, 52px); font-weight: 700; line-height: 1.15; }
.gr-h2 { font-family: 'Montserrat', 'Gotham', sans-serif; font-size: clamp(24px, 2.5vw, 36px); font-weight: 700; line-height: 1.25; }
.gr-h3 { font-family: 'Montserrat', 'Gotham', sans-serif; font-size: 18px; font-weight: 600; line-height: 1.35; }
.gr-body { font-size: 16px; line-height: 1.7; color: var(--gr-muted); }
.gr-body-sm { font-size: 14px; line-height: 1.65; color: var(--gr-muted); }
.gr-accent { color: var(--gr-blue); }
.gr-divider { height: 1px; background: #D9E5EB; margin: 0; }



/* ============================================================
   SECTION 3: INTRO VIDEO + SIDE STATS — brand navy #213C4B
   ============================================================ */
.gr-intro {
  /* Brand navy — matches the dark-section pattern from GenRocket guidelines */
  background: var(--gr-navy);
  padding: 80px 0;
  position: relative;
  overflow: hidden;
}
/* Brand blue radial glow */
.gr-intro::before {
  content: '';
  position: absolute; inset: 0;
  background-image: radial-gradient(circle at 80% 50%, rgba(39,191,240,0.12) 0%, transparent 60%);
  pointer-events: none;
}

/* New layout: text left (1fr) | video right (1.2fr) */
.gr-intro-inner {
  display: grid;
  grid-template-columns: 1fr 1.2fr;
  gap: 64px;
  align-items: center;
  position: relative; z-index: 1;
}

/* LEFT: text column */
.gr-intro-text-col {
  display: flex;
  flex-direction: column;
  gap: 0;
}

/* RIGHT: video column */
.gr-intro-video-col {
  position: relative;
}

/* Stats as 2x2 grid inside left col */
.gr-stats-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 12px;
  margin: 24px 0 20px;
}

/* Eyebrow label — brand blue */
.gr-intro-label {
  font-size: 11px; font-weight: 700; letter-spacing: .1em;
  text-transform: uppercase; color: var(--gr-blue);
  margin-bottom: 12px; display: flex; align-items: center; gap: 8px;
  font-family: 'Montserrat', sans-serif;
}
.gr-intro-label::before { content: ''; display: block; width: 20px; height: 2px; background: var(--gr-blue); }

/* Section title */
.gr-intro-title {
  font-family: 'Montserrat', 'Gotham', sans-serif;
  font-size: 28px; font-weight: 700;
  color: #fff; line-height: 1.3;
  margin-bottom: 16px;
}
.gr-intro-sub {
  font-size: 15px; line-height: 1.7;
  color: rgba(255,255,255,0.65);
  margin-bottom: 24px;
  font-family: 'Montserrat', sans-serif;
  font-weight: 400;
}

/* Video embed wrapper */
.gr-video-wrap {
  position: relative;
  width: 100%;
  padding-bottom: 56.25%;
  border-radius: var(--gr-radius);
  overflow: hidden;
  /* Brand blue border tint on video frame */
  border: 1.5px solid rgba(39,191,240,0.25);
  background: #0F1F28;
}
.gr-video-wrap iframe,
.gr-video-wrap video {
  position: absolute; inset: 0;
  width: 100%; height: 100%;
  border: none;
}
/* Placeholder */
.gr-video-placeholder {
  position: absolute; inset: 0;
  display: flex; flex-direction: column;
  align-items: center; justify-content: center; gap: 14px;
  background: linear-gradient(135deg, #172E3A, #0F2230);
  cursor: pointer;
}
/* Play button — brand green */
.gr-play-btn {
  width: 64px; height: 64px; border-radius: 50%;
  background: var(--gr-green);
  display: flex; align-items: center; justify-content: center;
  transition: transform .2s, box-shadow .2s;
}
.gr-play-btn:hover { transform: scale(1.1); box-shadow: 0 0 0 10px rgba(166,213,64,0.2); }
.gr-play-arrow {
  width: 0; height: 0;
  border-top: 12px solid transparent;
  border-bottom: 12px solid transparent;
  border-left: 20px solid var(--gr-navy);
  margin-left: 4px;
}
.gr-video-caption { font-size: 14px; color: rgba(255,255,255,0.7); font-family: 'Montserrat', sans-serif; font-weight: 600; }
.gr-video-sub { font-size: 12px; color: rgba(255,255,255,0.35); font-family: 'Montserrat', sans-serif; }

/* Stats grid is now inside left text col — see .gr-stats-grid above */
.gr-stat-card {
  background: rgba(255,255,255,0.04);
  border: 1px solid rgba(39,191,240,0.18);
  border-radius: var(--gr-radius-sm);
  padding: 18px 20px;
  transition: border-color .2s, background .2s;
}
.gr-stat-card:hover {
  border-color: var(--gr-blue);
  background: rgba(39,191,240,0.06);
}
/* Stat number = brand blue */
.gr-stat-num {
  font-family: 'Montserrat', 'Gotham', sans-serif;
  font-size: 32px; 
  font-weight: 700;
  color: var(--gr-blue);
  line-height: 1;
  margin-bottom: 4px;
}
.gr-stat-label { font-size: 13px; color: rgba(255,255,255,0.65); line-height: 1.4; font-family: 'Montserrat', sans-serif; }

/* Disclaimer note — brand green left border */
.gr-intro-note {
  margin-top: 20px;
  font-size: 12px; color: rgba(255,255,255,0.45);
  line-height: 1.6;
  padding: 12px 16px;
  border-left: 3px solid var(--gr-green);
  font-family: 'Montserrat', sans-serif;
}


/* ============================================================
   RESPONSIVE
   ============================================================ */
@media (max-width: 1024px) {
  
  .gr-intro-inner  { grid-template-columns: 1fr; gap: 40px; }
  .gr-intro-video-col { order: 2; }
  .gr-intro-text-col  { order: 1; }
  
}
@media (max-width: 639px) {
    .gr-stat-num {font-size: 23px; }
}
	
</style>
<main id="main">
    <div class="newslider-banner">
        <div class="slideset">
            <?php
			if( have_rows('fade_slider') ):				
				while ( have_rows('fade_slider') ) : the_row();
					$image = get_sub_field('slide_image');
                    $mobile_image = get_sub_field('mobile_image');
					$caption = get_sub_field('slide_caption');
					$url = get_sub_field( "youtube_url" );;
					$mobile = 'medium';
					$tablet = 'large';
					$full = 'full';
					if(!empty($caption)){
						?>
			            <div class="slide w-100">
<?php if(get_sub_field('slide_image')): ?>
                <picture>
                   <?php /* <source id='srcbnr0' srcset="" media="(max-width: 767px)"
                        data-src='<?php echo wp_get_attachment_image_url ($image['ID'], $mobile); ?>'> */ ?>
					
					<source id='srcbnr0' srcset="" media="(max-width: 767px)"
                        data-src='<?php echo $mobile_image['url']; ?>'>
					
                    <source id='srcbnr1' srcset="" media="(max-width: 1024px)"
                        data-src='<?php echo wp_get_attachment_image_url ($image['ID'], $tablet); ?>'>
                    <source id='srcbnr2' srcset=""
                        data-src='<?php echo wp_get_attachment_image_url ($image['ID'], $full); ?>'>
                    <img id='imgbnr1' src="" alt="GenRocket Test Data Management"
                        data-src='<?php echo wp_get_attachment_image_url ($image['ID'], $full); ?>'>
                </picture>

                <?php endif; ?>
                <div class="caption container">
                    <div class="row">
                        <div class="col-lg-9 text-left"><?php echo the_sub_field('slide_caption');?></div>
                        <div class="col-lg-3 d-none d-lg-block"></div>
                    </div>
                </div>
            </div>
            <?php } ?>
            <?php endwhile; else : endif; ?>
            <div class="pagination d-none d-md-block"></div>
        </div>
    </div>
    <?php if (have_posts()) : while (have_posts()) : the_post();?>
    <?php //the_content(); ?>
	<div class="block global">
        <div class="container">
            <h2 class="text-center small-title"><?php echo get_field('global_integrators_heading'); ?></h2>
            <div class="global-carousel slider-carousel">
                <div class="mask">
                    <ul class="global-logoes">
                        <?php
											if ( have_rows( 'global_integrators_images' ) ):
												while ( have_rows( 'global_integrators_images' ) ):
													the_row();
													$image = get_sub_field( 'image' ); 
													?>
                        <li><img src="<?php echo $image['url']; ?>" alt="GenRocket Test Data Management - Partners">
                        </li>
                        <?php endwhile;
											endif; 
											?>
                    </ul>
                </div>
                <a href="#" class="btn-prev">
                    <svg width="20" height="45" style="fill: #213c4b;" version="1.1" id="Layer_1"
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                        viewBox="0 0 20.9 45" style="enable-background:new 0 0 20.9 45;" xml:space="preserve">
                        <path d="M0,22.5l0.9,1.1L18.4,45l2.5-2.2L4.3,22.5L20.9,2.2L18.4,0L0.9,21.4L0,22.5L0,22.5z" />
                    </svg>
                </a>
                <a href="#" class="btn-next">
                    <svg width="20" height="45" style="fill: #213c4b;" version="1.1" id="Layer_1"
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                        viewBox="0 0 20.9 45" style="enable-background:new 0 0 20.9 45;" xml:space="preserve">
                        <path d="M20.9,22.5L20,23.6L2.5,45L0,42.8l16.6-20.3L0,2.2L2.5,0L20,21.4L20.9,22.5L20.9,22.5z" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
<?php if ( have_rows( 'understand_genrocket' ) ): ?>
  <div class="gr-page">
  <section class="gr-intro">
    <div class="gr-container">
      <div class="gr-intro-inner">
        <?php while ( have_rows( 'understand_genrocket' ) ):
          the_row();
          $content = get_sub_field('content'); 
          $video_iframe = get_sub_field('video_iframe');
        ?>
        <div class="gr-intro-text-col">
          <?php echo $content; ?>
        </div>
        <div class="gr-intro-video-col">
          <div class="gr-video-wrap">
              <?php echo $video_iframe; ?>
          </div>
        </div>
  <?php endwhile; ?>
     </div>
    </div>
  </section>
</div>
<?php endif; ?>
    <div class="block bg-bluish-gray">
        <div class="container">
            <?php echo get_field('data_security_is_paramount'); ?>
        </div>
    </div>
    <div class="block bg-blue text-white">
        <div class="container">
        <?php echo get_field('quality_critical'); ?>
        </div>
    </div>
    <div class="block bg-dark text-white">
        <div class="container">
        <?php echo get_field('release_cycles'); ?>
        </div>
    </div>
    <div class="block bg-thin">
        <div class="container">
			<h2 class="text-center small-title mb-0">Evolutionary Synthetic Data Transformation</h2>
			<img src="https://www.genrocket.com/wp-content/uploads/2025/10/TDM-Bridge-1.svg" style="width:100%;max-width: 900px; margin: 0 auto; display: block;" class="img-fluid" />
			<img src="https://www.genrocket.com/wp-content/uploads/2025/10/tdm-bridge.png" style="width:100%;max-width: 900px; margin: 0 auto; display: block;" class="img-fluid" />
            <?php //echo get_field('automate_and_orchestrate'); ?>
        </div>
    </div>
    <div class="block">
        <div class="container slider-carousel">
        <?php echo get_field('design-driven_data'); ?>
            <div class="video-container">
                <video autoplay muted loop playsinline>
                    <source src="<?php bloginfo('template_url'); ?>/assets/videos/designdriven.mp4" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
        </div>
    </div>
    <div class="block bg-light">
        <div class="container">
        <?php echo get_field('platform_for_any'); ?>    
        <!-- Image map for desktop -->
        <div class="maping">
                <img src="https://www.genrocket.com/wp-content/uploads/2025/10/One-Data-Platform.svg"
                    style="max-width:666px;" alt="Image 7" usemap="#Map" class="img-fluid d-block mx-auto mb-4">
                <map name="Map">
                    <area shape="poly" coords="337,34,397,42,450,71,399,142,339,124,336,33" href="#"
                        data-info="<h3>DATA MASKING</h3><p>Part of GenRocket’s data subsetting solution. Sensitive (PII) data is never looked at or stored - it’s synthetically replaced. This approach is 100% secure, faster and provides higher quality test data.</p>" data-bgcolor="#FFEB3B" data-left="300" data-top="100" data-popup-class="data-masking">
                    <area shape="poly" coords="407,147,460,76,500,116,529,170,443,200,408,149" href="#"
                        data-info="<h3>DATA SUBSETTING</h3><p>Standard functionality for 6 popular SQL databases (Oracle, DB2, MS SQL, MySQL, PostgreSQL & Sybase). Data is delivered at a rate of 2.5 million rows of data per minute and 100 million rows of data in 30 minutes.</p>" data-popup-class="data-subsetting">
                    <area shape="poly" coords="447,209,531,182,541,241,530,300,447,269,447,208" href="#"
                        data-info="<h3>DATA ORCHESTRATION</h3><p>Subsets of data and synthetic data sets can be orchestrated to one or many test environments in parallel, on demand.</p>" data-popup-class="data-orchestration">
                    <area shape="poly" coords="442,282,528,309,500,366,460,404,406,330,443,283" href="#"
                        data-info="<h3>DATA PROFILING</h3><p>16 methods to automate data modelling using metadata. Integration with 3rd party data profiling tools that deeply scan and profile entire data sets.</p>" data-popup-class="data-profiling">
                    <area shape="poly" coords="398,338,453,410,399,436,337,446,338,358,398,339" href="#"
                        data-info="<h3>TDM SELF-SERVICE</h3><p>G-Portal is a Self-Service portal for dev & test teams to search for and request test data. G-Questionnaire allows teams to create their own permutations of test data without being GenRocket experts.</p>" data-popup-class="tdm-self-service">
                    <area shape="poly" coords="330,355,329,446,270,437,216,410,269,337,331,357" href="#"
                        data-info="<h3>GENROCKET ACCELERATORS</h3><p>GenRocket accelerators enable rapid deployment of complex synthetic test data solutions for healthcare (X12 EDI), banking, and COTS applications (Salesforce).</p>" data-popup-class="genrocket-accelerators">
                    <area shape="poly" coords="225,281,262,331,210,404,167,363,140,309,224,281" href="#"
                        data-info="<h3>AI/ML TRAINING DATA</h3><p>Production data for training ML algorithms can be biased, contain sensitive data or not available. GenRocket data generators can be used to provision secure & unbiased training, validation and test data.</p>" data-popup-class="ai-ml-training-data">
                    <area shape="poly" coords="223,211,218,237,224,271,137,299,126,241,135,181,222,210" href="#"
                        data-info="<h3>PIPELINE INTEGRATION</h3><p>Integrate the GenRocket platform with any development tool or testing framework to fully automate your CI/CD release pipelines.  GenRocket’s TDA solution provides the right data, at the right time, in the right place.</p>" data-popup-class="pipeline-integration">
                    <area shape="poly" coords="208,76,261,149,225,200,139,172,165,116,207,75" href="#"
                        data-info="<h3>PLATFORM MANAGEMENT</h3><p>Monitor dev and test teams to identify strategies for accelerated test cycles and greater test coverage. Track the pace of adoption and use value metrics to measure continuous improvement and ROI.</p>" data-popup-class="platform-management">
                    <area shape="poly" coords="271,145,217,70,263,44,330,32,331,122,270,145" href="#"
                        data-info="<h3>DATA GENERATION</h3><p>Industry leader & US patent holder for test data generation with referential integrity. Over 750 data generators & 109 data formats supported. Thousands of use cases delivered since 2018.</p>" data-popup-class="data-generation">
                </map>
                <!-- Popup info box -->
                <div id="infoBox"></div>
            </div>
            <!-- Accordion for mobile -->
            <div class="accordion d-block d-lg-none" id="mapAccordion">
                <div class="card">
                    <div class="card-header" id="headingOne" style="background-color: #23a6de;">
                        <h5 class="mb-0">
                            <button class="btn btn-link d-flex align-items-center" type="button" data-toggle="collapse"
                                data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <i class="icon-data-masking mr-2"></i> Data Masking.
                            </button>
                        </h5>
                    </div>
                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                        data-parent="#mapAccordion">
                        <div class="card-body">
                            Part of GenRocket's data subsetting solution. Sensitive (PII) data is never looked at or
                            stored - it's synthetically replaced. This approach is 100% secure, faster and provides
                            higher quality test data.
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingTwo" style="background-color: #27bff0;">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed d-flex align-items-center" type="button"
                                data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"
                                aria-controls="collapseTwo">
                                <i class="icon-data-subsetting mr-2"></i> Data Subsetting
                            </button>
                        </h5>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#mapAccordion">
                        <div class="card-body">
                            Standard functionality for 6 popular SQL databases (Oracle, DB2, MS SQL, MySQL, PostgreSQL &
                            Sybase). Data is delivered at a rate of 2.5 million rows of data per minute and 100 million
                            rows of data in 30 minutes.
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" id="headingThree" style="background-color: #93dff8;">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed d-flex align-items-center" type="button"
                                data-toggle="collapse" data-target="#collapseThree" aria-expanded="false"
                                aria-controls="collapseThree">
                                <i class="icon-data-orchestration mr-2"></i> Data Orchestration
                            </button>
                        </h5>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#mapAccordion">
                        <div class="card-body">
                            Subsets of data and synthetic data sets can be orchestrated to one or many test environments
                            in parallel, on demand.
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" id="headingFour" style="background-color: #6dbf42;">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed d-flex align-items-center" type="button"
                                data-toggle="collapse" data-target="#collapseFour" aria-expanded="false"
                                aria-controls="collapseFour">
                                <i class="icon-data-profiling mr-2"></i> Data Profiling
                            </button>
                        </h5>
                    </div>
                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#mapAccordion">
                        <div class="card-body">
                            16 methods to automate data modelling using metadata. Integration with 3rd party data
                            profiling tools that deeply scan and profile entire data sets.
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" id="headingFive" style="background-color: #a6d540;">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed d-flex align-items-center" type="button"
                                data-toggle="collapse" data-target="#collapseFive" aria-expanded="false"
                                aria-controls="collapseFive">
                                <i class="icon-TDM-self-service mr-2"></i> TDM Self-Service
                            </button>
                        </h5>
                    </div>
                    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#mapAccordion">
                        <div class="card-body">
                            G-Portal is a Self-Service portal for dev & test teams to search for and request test data.
                            G-Questionnaire allows teams to create their own permutations of test data without being
                            GenRocket experts.
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" id="headingSix" style="background-color: #ffc000;">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed d-flex align-items-center" type="button"
                                data-toggle="collapse" data-target="#collapseSix" aria-expanded="false"
                                aria-controls="collapseSix">
                                <i class="icon-genrocket-accelerator mr-2"></i> Genrocket Accelerators
                            </button>
                        </h5>
                    </div>
                    <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#mapAccordion">
                        <div class="card-body">
                            GenRocket accelerators enable rapid deployment of complex synthetic test data solutions for
                            healthcare (X12 EDI), banking, and COTS applications (Salesforce).
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingSeven" style="background-color: #ed7d31;">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed d-flex align-items-center" type="button"
                                data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false"
                                aria-controls="collapseSeven">
                                <i class="icon-AI-ML-Traning-data mr-2"></i> AI/Ml Training Data
                            </button>
                        </h5>
                    </div>
                    <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#mapAccordion">
                        <div class="card-body">
                            Production data for training ML algorithms can be biased, contain sensitive data or not
                            available. GenRocket data generators can be used to provision secure & unbiased training,
                            validation and test data.
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" id="headingEight" style="background-color: #c04f15;">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed d-flex align-items-center" type="button"
                                data-toggle="collapse" data-target="#collapseEight" aria-expanded="false"
                                aria-controls="collapseEight">
                                <i class="icon-pipeline-integration mr-2"></i> Pipeline Integration
                            </button>
                        </h5>
                    </div>
                    <div id="collapseEight" class="collapse" aria-labelledby="headingEight" data-parent="#mapAccordion">
                        <div class="card-body">
                            Integrate the GenRocket platform with any development tool or testing framework to fully
                            automate your CI/CD release pipelines. GenRocket’s TDA solution provides the right data, at
                            the right time, in the right place.
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" id="headingNine" style="background-color: #5c3497;">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed  d-flex align-items-center" type="button"
                                data-toggle="collapse" data-target="#collapseNine" aria-expanded="false"
                                aria-controls="collapseNine">
                                <i class="icon-platform-management mr-2"></i> Platform Management
                            </button>
                        </h5>
                    </div>
                    <div id="collapseNine" class="collapse" aria-labelledby="headingNine" data-parent="#mapAccordion">
                        <div class="card-body">
                            Monitor dev and test teams to identify strategies for accelerated test cycles and greater
                            test coverage. Track the pace of adoption and use value metrics to measure continuous
                            improvement and ROI.
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" id="headingTen" style="background-color: #213c4b;">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed d-flex align-items-center" type="button"
                                data-toggle="collapse" data-target="#collapseTen" aria-expanded="false"
                                aria-controls="collapseTen">
                                <i class="icon-data-generation mr-2"></i> Data Generation
                            </button>
                        </h5>
                    </div>
                    <div id="collapseTen" class="collapse" aria-labelledby="headingTen" data-parent="#mapAccordion">
                        <div class="card-body">
                            Industry leader & US patent holder for test data generation with referential integrity.
                            Over750 data generators & 109 data formats supported. Thousands of use cases delivered since
                            2018.
                        </div>
                    </div>
                </div>
            </div>    
        </div>
    </div>
    <div class="block platform">
        <div class="container">
            <h2 class="text-center small-title"><?php echo get_field('platform_main_heading'); ?></h2>
            <div class="platform-carousel slider-carousel">
                <div class="mask">
                    <ul class="platform-box">
                        <?php
													if ( have_rows( 'platform' ) ):
														while ( have_rows( 'platform' ) ):
															the_row();
															$image = get_sub_field( 'platform_image' ); 
															$title = get_sub_field( 'platform_title' ); 
															?>
                        <li>
                            <img src="<?php echo $image['url']; ?>" class="img-fluid mb-3"
                                alt="GenRocket Test Data Management">
                            <h3 class="text-center mb-0"><?php echo $title; ?></h3>
                        </li>
                        <?php endwhile;
													endif; 
													?>
                    </ul>
                </div>
                <a href="#" class="btn-prev">
                    <svg width="20" height="45" style="fill: #213c4b;" version="1.1" id="Layer_1"
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                        viewBox="0 0 20.9 45" style="enable-background:new 0 0 20.9 45;" xml:space="preserve">
                        <path d="M0,22.5l0.9,1.1L18.4,45l2.5-2.2L4.3,22.5L20.9,2.2L18.4,0L0.9,21.4L0,22.5L0,22.5z" />
                    </svg>
                </a>
                <a href="#" class="btn-next">
                    <svg width="20" height="45" style="fill: #213c4b;" version="1.1" id="Layer_1"
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                        viewBox="0 0 20.9 45" style="enable-background:new 0 0 20.9 45;" xml:space="preserve">
                        <path d="M20.9,22.5L20,23.6L2.5,45L0,42.8l16.6-20.3L0,2.2L2.5,0L20,21.4L20.9,22.5L20.9,22.5z" />
                    </svg></a>
            </div>
        </div>
    </div>
    <div class="block bg-light">
        <div class="container slider-carousel">
            <div class="row justify-content-center">
                <h2 class="text-center small-title"><?php echo get_field('top_rated_main_heading'); ?></h2>
                <div class="col-md-10" style="position: static;">
                    <div class="rated-carousel">
                        <div class="mask">
                            <div class="rated-slider">
                                <?php
														if ( have_rows( 'top_rated' ) ):
															while ( have_rows( 'top_rated' ) ):
																the_row();
																$image = get_sub_field( 'toprated_image' ); 
																$link = get_sub_field( 'link' ); 
																?>
                                <div class="slide">
                                    <div class="row align-items-center">
                                        <div class="col-12">
                                            <a href="<?php echo $link; ?>" target="_blank"><img class="img-fluid"
                                                    src="<?php echo $image['url'];?>"
                                                    alt="GenRocket Test Data Management"></a>
                                        </div>
                                    </div>
                                </div>
                                <?php endwhile;
															endif; 
															?>
                            </div>
                        </div>
                        <a href="#" class="btn-prev">
                            <svg width="20" height="45" style="fill: #213c4b;" version="1.1" id="Layer_1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
                                y="0px" viewBox="0 0 20.9 45" style="enable-background:new 0 0 20.9 45;"
                                xml:space="preserve">
                                <path
                                    d="M0,22.5l0.9,1.1L18.4,45l2.5-2.2L4.3,22.5L20.9,2.2L18.4,0L0.9,21.4L0,22.5L0,22.5z" />
                            </svg>
                        </a>
                        <a href="#" class="btn-next">
                            <svg width="20" height="45" style="fill: #213c4b;" version="1.1" id="Layer_1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
                                y="0px" viewBox="0 0 20.9 45" style="enable-background:new 0 0 20.9 45;"
                                xml:space="preserve">
                                <path
                                    d="M20.9,22.5L20,23.6L2.5,45L0,42.8l16.6-20.3L0,2.2L2.5,0L20,21.4L20.9,22.5L20.9,22.5z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="block generation-tool">
				<div class="container"><img src="https://www.genrocket.com/wp-content/uploads/2019/06/pto-icon.png" class="pto-left" alt="Test Data Management - GenRocket">
					<div class="text">
						<h2>One of a Kind Test Data Automation Platform</h2>
						<p>GenRocket was awarded US patent #9,552,266 B2 for systems and methods for data generation.</p>
					</div>
				</div>
			</div>
    <?php endwhile; else : _e( 'Sorry, no content available.', 'textdomain' ); endif; wp_reset_query(); ?>
    <?php if(get_field('additional_editor')): ?>
    <?php echo get_field('additional_editor');?>
    <?php endif; ?>
</main>
<?php get_footer(); ?>
<script>
$(function() {
    console.log('setting banners');
    $("#imgbnr1").attr('src', $("#imgbnr1").attr('data-src'));
    $("#srcbnr0").attr('srcset', $("#srcbnr0").attr('data-src'));
    $("#srcbnr1").attr('srcset', $("#srcbnr1").attr('data-src'));
    $("#srcbnr2").attr('srcset', $("#srcbnr2").attr('data-src'));
    $("#videoimg").attr('src', $("#videoimg").attr('data-src')).load(function() {
        $(this).css({
            'border': '0 solid #000'
        });
    });
    $("#videoimg2").attr('src', $("#videoimg2").attr('data-src')).load(function() {
        $(this).css({
            'border': '0 solid #000'
        });
    });
    //$('.video-player').css({'border': '10px solid #000'})
});
</script>
<script>
// Show and hide info box on map area click
const infoBox = document.getElementById('infoBox');

document.querySelectorAll('area').forEach(function(area) {
    area.addEventListener('click', function(event) {
        event.preventDefault();

        const info = area.getAttribute('data-info');
        const popupClass = `popup-${area.getAttribute('data-popup-class')}`;

        infoBox.innerHTML = info;
        infoBox.className = `popup ${popupClass}`; // Apply the specific popup class

        // Position the info box near the mouse click
        const x = event.pageX;
        const y = event.pageY;
        infoBox.style.left = x + 'px';
        infoBox.style.top = y + 'px';

        // Show the info box
        infoBox.style.display = 'block';
    });
});

// Hide the info box when clicking outside of it
document.addEventListener('click', function(event) {
    const target = event.target;

    // If the clicked target is not an area or the info box, hide the info box
    if (!target.closest('area') && target !== infoBox) {
        infoBox.style.display = 'none';
    }
});
</script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const sections = document.querySelectorAll(".block");

    const observerOptions = {
        threshold: 0.3 // Adjust this to determine how much of the section should be visible before triggering/removing the animation
    };

    const sectionObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            const video = entry.target.querySelector("video"); // Find the video in the section

            if (entry.isIntersecting) {
                // Add the 'animate' class when the section is in the viewport
                entry.target.classList.add("animate");

                // Play the video if it exists
                if (video) {
                    video.play(); // Play the video when the section is visible
                }
            } else {
                // Remove the 'animate' class when the section is out of the viewport
                entry.target.classList.remove("animate");

                // Pause the video if it exists
                if (video) {
                    video.pause(); // Pause the video when the section is out of view
                    video.currentTime =
                        0; // Reset video to the beginning if you want it to replay from the start
                }
            }
        });
    }, observerOptions);

    sections.forEach(section => {
        sectionObserver.observe(section);
    });
});
</script>