<?php /* Template Name: revisied-home Test */ ?>
<?php get_header(); ?>
<main id="main" style="padding: 0 !important; border: none !important;">
	<div class="newslider">
		<div class="slideset">
			<?php
				// check if the repeater field has rows of data
			if( have_rows('fade_slider') ):
				// loop through the rows of data
				while ( have_rows('fade_slider') ) : the_row();
					$image = get_sub_field('slide_image');
					$caption = get_sub_field('slide_caption');
					$mobile = 'medium';
					$tablet = 'large';
					$full = 'full';
					if(!empty($caption)){
						?>
						<div class="slide w-100">
							<?php if(get_sub_field('slide_image')): ?>
								<picture>
									<source srcset="<?php echo wp_get_attachment_image_url ($image['ID'], $mobile); ?>" media="(max-width: 767px)">
										<source srcset="<?php echo wp_get_attachment_image_url ($image['ID'], $tablet); ?>" media="(max-width: 1024px)">
											<source srcset="<?php echo wp_get_attachment_image_url ($image['ID'], $full); ?>">
												<img src="<?php echo wp_get_attachment_image_url ($image['ID'], $full); ?>" alt="GenRocket Test Data Management">
											</picture>
										<?php endif; ?>
										<div class="caption container">
											<div class="row">
												<div class="col-lg-5 text-left"><?php echo the_sub_field('slide_caption');?></div>
												<div class="col-lg-7 d-none d-lg-block">
													<div class="video-player" style="border: 10px solid #000;">
													    <a href="#" class="btn-play"><img src="<?php bloginfo('template_url'); ?>/assets/images/video-placeholder.jpg" class="img-fluid" alt="">
													     <iframe style="display: none;"  src="https://www.youtube.com/embed/qRfFfZvXgRk" title="YouTube video player" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe></a>
													 </div>
												</div>
											</div>
										</div>
									</div>
									<?php
								}else{
									?>
									<div class="slide">
										<a href="https://www.genrocket.com/webinar-test-automation-requires-test-data-automation/" target="_blank">
											<?php if(get_sub_field('slide_image')): ?>
												<picture>
													<source srcset="<?php echo wp_get_attachment_image_url ($image['ID'], $mobile); ?>" media="(max-width: 767px)">
														<source srcset="<?php echo wp_get_attachment_image_url ($image['ID'], $tablet); ?>" media="(max-width: 1024px)">
															<source srcset="<?php echo wp_get_attachment_image_url ($image['ID'], $size); ?>">
																<img src="<?php echo wp_get_attachment_image_url ($image['ID'], $full); ?>" alt="GenRocket Test Data Management">
															</picture>
														<?php endif; ?>
													</a>
												</div>
												<?php
											}
											?>
										<?php endwhile; else : endif; ?>
										<div class="pagination d-none d-md-block"></div>
									</div>
								</div>
								<div class="d-block d-lg-none" style="padding: 15px; background: #0070c0;">
									<div class="container">
										<div class="row">
											<div class="col-sm-10 offset-sm-1">
													<div class="video-player" style="border: 10px solid #000;">
													    <a href="#" class="btn-play"><img src="<?php bloginfo('template_url'); ?>/assets/images/video-placeholder.jpg" class="img-fluid" alt="">
													     <iframe style="display: none;"  src="https://www.youtube.com/embed/qRfFfZvXgRk" title="YouTube video player" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe></a>
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
									<div class="block bg-light homefeature-boxes">
										<div class="container">
											<div class="row">
												<?php
												if ( have_rows( 'homefeature_boxes' ) ):
													while ( have_rows( 'homefeature_boxes' ) ):
														the_row();
														$title = get_sub_field( 'title' ); 
														$content = get_sub_field( 'content' ); 
														$link = get_sub_field( 'link' ); 
														?>
														<div class="col-12 col-md-6 col-lg-3 box mb-3 mb-lg-0">
															<div class="inner">
																<h3><?php echo $title; ?></h3>
																<p><?php echo $content; ?></p>
																<a href="<?php echo $link['url']; ?>" class="btn btn-primary" target="_blank">Learn More</a>	
															</div>
														</div>
													<?php endwhile;
												endif; ?>
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
																	<img src="<?php echo $image['url']; ?>" class="img-fluid mb-3" alt="GenRocket Test Data Management">
																	<h3 class="text-center mb-0"><?php echo $title; ?></h3>
																</li>
															<?php endwhile;
														endif; 
														?>
													</ul>
												</div>
												<a href="#" class="btn-prev">
													<svg width="20" height="45" style="fill: #213c4b;" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
													viewBox="0 0 20.9 45" style="enable-background:new 0 0 20.9 45;" xml:space="preserve">
													<path d="M0,22.5l0.9,1.1L18.4,45l2.5-2.2L4.3,22.5L20.9,2.2L18.4,0L0.9,21.4L0,22.5L0,22.5z"/>
												</svg>
											</a>
											<a href="#" class="btn-next">
												<svg  width="20" height="45" style="fill: #213c4b;" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
												viewBox="0 0 20.9 45" style="enable-background:new 0 0 20.9 45;" xml:space="preserve">
												<path d="M20.9,22.5L20,23.6L2.5,45L0,42.8l16.6-20.3L0,2.2L2.5,0L20,21.4L20.9,22.5L20.9,22.5z"/>
											</svg>
										</a>
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
																			<a href="<?php echo $link; ?>" target="_blank"><img class="img-fluid" src="<?php echo $image['url'];?>" alt="GenRocket Test Data Management"></a>
																		</div>
																	</div>
																</div>
															<?php endwhile;
														endif; 
														?>
													</div>
												</div>
												<a href="#" class="btn-prev">
													<svg width="20" height="45" style="fill: #213c4b;" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
													viewBox="0 0 20.9 45" style="enable-background:new 0 0 20.9 45;" xml:space="preserve">
													<path d="M0,22.5l0.9,1.1L18.4,45l2.5-2.2L4.3,22.5L20.9,2.2L18.4,0L0.9,21.4L0,22.5L0,22.5z"/>
												</svg>
											</a>
											<a href="#" class="btn-next">
												<svg  width="20" height="45" style="fill: #213c4b;" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
												viewBox="0 0 20.9 45" style="enable-background:new 0 0 20.9 45;" xml:space="preserve">
												<path d="M20.9,22.5L20,23.6L2.5,45L0,42.8l16.6-20.3L0,2.2L2.5,0L20,21.4L20.9,22.5L20.9,22.5z"/>
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
												<li><img src="<?php echo $image['url']; ?>" alt="GenRocket Test Data Management - Partners"></li>
											<?php endwhile;
										endif; 
										?>
									</ul>
								</div>
								<a href="#" class="btn-prev">
									<svg width="20" height="45" style="fill: #213c4b;" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
									viewBox="0 0 20.9 45" style="enable-background:new 0 0 20.9 45;" xml:space="preserve">
									<path d="M0,22.5l0.9,1.1L18.4,45l2.5-2.2L4.3,22.5L20.9,2.2L18.4,0L0.9,21.4L0,22.5L0,22.5z"/>
								</svg>
							</a>
							<a href="#" class="btn-next">
								<svg  width="20" height="45" style="fill: #213c4b;" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
								viewBox="0 0 20.9 45" style="enable-background:new 0 0 20.9 45;" xml:space="preserve">
								<path d="M20.9,22.5L20,23.6L2.5,45L0,42.8l16.6-20.3L0,2.2L2.5,0L20,21.4L20.9,22.5L20.9,22.5z"/>
							</svg>
						</a>
					</div>
				</div>
			</div>
			<div class="block td-automation text-center text-md-left dataBlock">
				<div class="container">
					<?php echo get_field('data_block'); ?>
				</div>
			</div>
			<!-- wp:html -->
			<div class="block bg-block benefits-block">
				<div class="container text-center">
					<?php echo get_field('benefits_block'); ?>
				</div>
			</div>
			<div class="block generation-tool">
				<div class="container"><img src="https://www.genrocket.com/wp-content/uploads/2019/06/pto-icon.png" class="pto-left" alt="Test Data Management - GenRocket">
					<div class="text">
						<h2>One of a Kind Test Data Automation Platform</h2>
						<p>GenRocket was awarded US patent #9,552,266 B2 for systems and methods for test data generation.</p>
					</div>
				</div>
			</div>
		<?php endwhile; else : _e( 'Sorry, no content available.', 'textdomain' ); endif; wp_reset_query(); ?>
		<?php if(get_field('additional_editor')): ?>
			<?php echo get_field('additional_editor');?>
		<?php endif; ?>
	</main>
	<?php get_footer(); ?>
	 <script src="<?php bloginfo('template_url'); ?>/assets/js/jquery.inview.min.js"></script>
	 <script src="<?php bloginfo('template_url'); ?>/assets/js/jquery.youtube-inview-autoplay.js"></script>
	 <script>
	// Load the IFrame Player API code asynchronously.
	  var tag = document.createElement('script');
	  tag.src = "https://www.youtube.com/player_api";
	  var firstScriptTag = document.getElementsByTagName('script')[0];
	  firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
	  function onYouTubeIframeAPIReady() {
	    $('.youtube-video').inViewAutoplay({
	      autohide: 1,
	      modestbranding: 1,
	      rel: 0,
	      //quality: 'hd720'
	    });
	  }
	</script>