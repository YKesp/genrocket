<?php /* Template Name:  Test Video */ ?>
<?php get_header(); ?>
<main id="main" style="padding: 0 !important; border: none !important;">
	<div class="newslider">
		<div class="slideset">
			<div class="slide w-100">
				<picture>
					<source srcset="https://www.genrocket.com/wp-content/uploads/2022/09/banner-new-2-640x166.jpg" media="(max-width: 767px)">
						<source srcset="https://www.genrocket.com/wp-content/uploads/2022/09/banner-new-2-1024x266.jpg" media="(max-width: 1024px)">
							<source srcset="https://www.genrocket.com/wp-content/uploads/2022/09/banner-new-2.jpg">
								<img src="https://www.genrocket.com/wp-content/uploads/2022/09/banner-new-2.jpg" alt="GenRocket Test Data Management">
							</picture>
							<div class="caption container">
								<div class="row">
									<div class="col-lg-5 text-left"><h1 class="text-left"><strong class="d-block">We Automate the Design of </strong> Synthetic Data</h1>
										<p class="mb-0 mb-md-4">The Only Synthetic Data Platform That Combines:</p>
										<ul class="m-0"><li>Enterprise-Class Scalability</li><li>Dynamic Data Generation</li><li>Integration with any Test Environment</li><li>Value for Money</li></ul></div>
										<div class="col-lg-7 d-none d-lg-block">
											<div class="video-player">
												<div id="jquery-script-menu" style="padding:56.25% 0 0 0;position:relative;">
													<div class="youtube-video" style="border: 10px solid #000;position:absolute;top:0;left:0;width:100%;height:100%; background: #000;"  id="demo-1" data-video-id="qRfFfZvXgRk" width="560" height="315"></div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="pagination d-none d-md-block"></div>
						</div>
					</div>
					<div class="" style="padding: 15px; background: #0070c0;">
						<div class="container">
							<div class="row">
								<div class="col-sm-10 offset-sm-1">
									<div class="video-player">
										<div id="jquery-script-menu" style="padding:56.25% 0 0 0;position:relative;">
											<div class="youtube-video" style="border: 10px solid #000;position:absolute;top:0;left:0;width:100%;height:100%; background: #000;"  id="demo-2" data-video-id="qRfFfZvXgRk" width="560" height="315"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</main>
				<iframe width="560" height="315" src="https://www.youtube.com/embed/qRfFfZvXgRk" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
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
							quality: 'hd720'
						});
					}
				</script>