<?php /* Template Name: Updated-home */ ?>
<?php get_header(); ?>
<main id="main">
    <div class="newslider-banner">
        <div class="slideset">
            <?php
			if( have_rows('fade_slider') ):				
				while ( have_rows('fade_slider') ) : the_row();
					$image = get_sub_field('slide_image');
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
                    <source id='srcbnr0' srcset="" media="(max-width: 767px)"
                        data-src='<?php echo wp_get_attachment_image_url ($image['ID'], $mobile); ?>'>
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
                        <div class="col-lg-5 text-left"><?php echo the_sub_field('slide_caption');?></div>
                        <div class="col-lg-7 d-none d-lg-block">
                            <div class="video-player" style="overflow: hidden;">
                                <a href="#" class="btn-play btn-play1"
                                    title="https://www.youtube.com/embed/OvOxWatdbKs"><img id="videoimg" src=""
                                        data-src="https://www.genrocket.com/wp-content/uploads/2024/10/TDA-Video-Thumbnail-2410.jpg"
                                        class="img-fluid" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
            <?php endwhile; else : endif; ?>
            <div class="pagination d-none d-md-block"></div>
        </div>
    </div>
    <div class="d-block d-lg-none" style="padding: 15px; background: #e9f9fe;">
        <div class="container">
            <div class="row">
                <div class="col-sm-10 offset-sm-1">
                    <div class="video-player">
                        <a href="#" class="btn-play btn-play2" title="https://www.youtube.com/embed/OvOxWatdbKs"><img
                                id="videoimg2" src=""
                                data-src="https://www.genrocket.com/wp-content/uploads/2024/10/TDA-Video-Thumbnail-2410.jpg"
                                class="img-fluid" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="greenbar">
        <div class="container d-md-flex justify-content-between align-items-center text-center text-md-start">
            <?php echo get_field('greenbar');?>
        </div>
    </div>
    <?php if (have_posts()) : while (have_posts()) : the_post();?>
    <?php //the_content(); ?>
    <div class="block bg-gradient-whitegray">
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
    <div class="block bg-light automate-block">
        <div class="container">
            <?php echo get_field('automate_and_orchestrate'); ?>
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
                <img src="<?php bloginfo('template_url'); ?>/assets/images/One_Data_Platform2.svg"
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
    <div class="block bg-gradient-whitegray mb-30">
        <div class="container">
        <?php echo get_field('evolutionary'); ?>
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