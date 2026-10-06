<?php /* Template Name: Landing Page Management */ ?>
<?php get_header(); ?>
<style type="text/css">
	.form-box div.wpforms-container-full .wpforms-form .wpforms-field {
		padding: 10px 0 0 !important;
		clear: both;
	}
	.logo-caption{max-width: 230px !important;}
	.banner .caption{background: none;}
	.banner .caption .inner{
		background: rgba(34,60,76,.75);
		text-align: center;
		font-size: 25px;
		line-height: 1.3;
	}
	.banner .caption h1{
		color: #a6d540;
	}
	.banner .caption h3{
		border-bottom: 2px solid #fff;
		padding-bottom: 15px;
		font-size: 42px;
		line-height: 1.3;
		font-weight: 600;
		text-align: center;
		margin-bottom:30px;
	}
	.paradigm-block .col-12 img{
		max-width: 107px;
		min-height: 152px;
		object-fit: contain;
	}
	.paradigm-block h3{
		text-transform: uppercase;
		font-size: 25px;
		font-weight: 600;
	}
	.block {color: #000;}
	.global-logoes{
		justify-content: center;
	}
	.global-logoes li{
		width: 133px;
		min-width: 133px;
	}
	.form-box{
		background: #fff;
		padding:20px 30px;
		border: 2px solid #bfbfbf;
	}
	.form-box h3{
		font-size: 24px;
		line-height: 1.4;
		color: #213c4b;
	}
	.form-box .form-control input{
		background: #e0e0e0 !important;
		padding:10px 20px !important;
		line-height: 40px !important;
		margin: 0 !important;
		height: 60px !important;
	}
	.form-box div.wpforms-container-full .wpforms-form .wpforms-field{padding: 0 0 12px;}
	.form-box .form-control::-webkit-input-placeholder { color: #6b6b6b;}
	.form-box .form-control:-moz-placeholder {color: #6b6b6b;}
	.form-box .form-control::-moz-placeholder {
		color: #6b6b6b;`
		opacity: 1;
	}
	/*.mPS2id-target{padding: 0 !important;border: 0 !important;}*/
	.form-box .form-control:-ms-input-placeholder {color: #6b6b6b;}
	.form-box .btn-block{
		background: #a6d540 !important;
		color: #fff !important;
		font:600 22px/24px Catamaran,sans-serif !important;
		padding: 10px !important;
		height: 44px !important;
	}
	.newslider .slide .caption h1{
		font-size: 48px;
		text-align: left !important;
	}
	.newslider .slide .caption {font-size: 32px !important;line-height: 1.3 !important;}
	/*.newslider .slide .caption:before{display: none !important;}*/
	.video-column h2{
/*		font-size: 47px !important;*/
		color: #fff;
		font-weight: 600;
		margin: 0 0 10px;
	}
	.video-column p{
		font-size: 25px;
		margin-bottom: 15px;
	}
	.click-demo{
		background: #27bff0;
		padding:15px 30px;
		line-height: 1.4;
		color: #fff;
		font-size: 36px;
		text-align: center;
		display: block;
		font-weight: 600;
	}
	.block h1, .block h2 {
			font-size: 36px;
			line-height: 1.2;
			font-weight: 600;
		}
	@media screen and (max-width:1399px){
		.form-box{padding:25px;}
	}
	@media screen and (min-width:1399px){
		.banner .caption h1{
			font-size: 50px;
			margin: 0 0 30px;
		}
		.banner .caption h2{
			font-size: 60px;
		}
		.newslider{height: 700px;}
		/*.container{max-width: 1522px;}
		.block {font: 28px/1.4 Catamaran,sans-serif;}
		.block.bg-blue{font: 34px/1.4 Catamaran,sans-serif;}*/
		.block h1, .block h2 {
			font-size: 36px;
			line-height: 1.2;
			font-weight: 600;
		}
		.global-logoes li{
			width: 180px;
			min-width: 180px;
		}
		.form-box h3{
			font-size: 25px;
			line-height: 1.4;
			color: #213c4b;
		}
		.platform-box li h3{font-size: 28px;}
		.newslider .slide .caption h1{font-size: 60px;text-align: left !important;}
		.newslider .slide .caption {font-size: 32px !important;line-height: 1.3 !important;}
	}
	@media screen and (max-width:1199px){
		.newslider {height: 350px;}
		.newslider .slide .caption h1 {font-size: 30px;}
		.newslider .slide .caption {
			font-size: 22px !important;
			line-height: 1.3 !important;
		}
		/*.newslider .slide .caption{background: none !important;}*/
		.block h1, .block h2 {
			font-size: 30px;
		}
		.video-column p{
			font-size: 20px;
			margin-bottom: 10px;
		}
	}
	@media screen and (max-width:991px){
		.form-box{
			padding: 25px;
		}
		.form-box h3{font-size: 15px;text-align: center !important;}
		.banner{overflow: hidden;}
		.banner img {
			width: 200%;
			margin: 0 -50%;
			max-width: inherit;
		}
	}
	@media screen and (max-width:767px){
		.banner .caption .inner{
			padding: 0 20px;
			font-size: 20px;
		}
		.banner .caption h3{margin-bottom: 10px;padding-bottom: 10px;}
		.banner .caption{
			background: none !important;
			padding: 0 !important;
			position: absolute !important;
		}
		.paradigm-block img{
			max-width: 80px;
		}
		.paradigm-block h3{
			font-size: 22px;
		}
		.video-column h2{
			font-size: 25px !important;
			line-height: 1.2;
			margin: 0 0 20px;
		}
		.click-demo{
			padding:5px 30px;
			line-height: 25px;
			font-size: 20px;
		}
		.block h1, .block h2 {
			font-size: 25px;
		}
		.video-column p{
			font-size: 18px;
			margin-bottom: 10px;
		}
	}
</style>
<div class="banner <?php echo get_field('banner_class'); ?>">
	<?php 
	$image = get_field('page_banner');
	$mobile = 'medium';
	$tablet = 'large';
	$full = 'full';
	?>
	<?php if(get_field('page_banner')): ?>
		<picture>
			<source srcset="<?php echo wp_get_attachment_image_url ($image['ID'], $mobile); ?>" media="(max-width: 767px)">
				<source srcset="<?php echo wp_get_attachment_image_url ($image['ID'], $tablet); ?>" media="(max-width: 1024px)">
					<source srcset="<?php echo wp_get_attachment_image_url ($image['ID'], $size); ?>">
						<img src="<?php echo wp_get_attachment_image_url ($image['ID'], $full); ?>" alt="GenRocket - Test Data Management">
					</picture>
				<?php endif; ?>
				<?php if(get_field('banner_caption')): ?>
					<div class="caption">
						<div class="row h-100">
							<div class="col-lg-6 col-12 h-100">
								<div class="inner h-100 w-100 d-flex flex-column justify-content-center">
									<?php //echo get_field('banner_caption'); ?>
									<div class="data">
										<img class="logo-caption" src="https://www.genrocket.com/wp-content/themes/genrocket/assets/images/GenRocket-logo.svg" alt="GenRocket - Test Data Management" class="mx-auto mb-3" width="240">
										<h1 class="text-center">The Future of <br class="d-none d-xl-inline-block"> Test Data Management</h1>
										<span>GenRocket Synthetic Test Data</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php endif; ?>
			</div>
			<main id="main">
				<?php if (have_posts()) : while (have_posts()) : the_post();?>
					<div class="block">
						<div class="container">
							<?php the_content(); ?>
						</div> 
					</div>
					<div class="block paradigm-block"  style="background: #e7f9ff;">
						<div class="container">
							<?php echo get_field('section_1'); ?>							
						</div> 
					</div>
					<div class="block platform">
						<div class="container">
							<h2 class="text-center small-title">The synthetic data platform chosen by 50 <big>+</big> of the Forbes Global 2000</h2>
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
			<div class="block bg-blue video-column" id="form-section">
				<div class="container">
					<h2 class="text-center small-title mb-5">See the Industry`s Most Advanced Synthetic Data Platform</h2>
					<div class="row align-items-center">
						<div class="col-lg-7 text-white mb-4 mb-lg-0 col-12">
							<?php echo get_field('section_2_content'); $url = get_field( "video_url" ); ?>
							<?php if($url){?>
								<div class="video-player mb-4" style="border: 3px solid #fff; max-width: 580px; margin: 0 auto;">
									<a href="#" class="btn-play btn-play2" title="<?php echo $url; ?>"><img src="https://www.genrocket.com/wp-content/uploads/2023/06/TDA-Thumbnail.jpg" class="img-fluid" alt="">
									</a>
								</div>
							<?php } ?>
							<p class="text-center"><?php echo get_field('bootom_text'); ?></p>
						</div>
						<div class="col-lg-5 col-12">
							<p class="text-center">See it in Action</p>
							<div class="form-box">
								<h3 class="text-center">Let us show you the GenRocket difference. Schedule a demo today.</h3>
								<?php $form = get_field('section_2_form'); ?>
								<?php echo do_shortcode($form); ?>
							</div>
						</div>
					</div>
				</div> 
			</div>
			<div class="block bg-block benefits-block">
				<div class="container text-center">
					<?php echo get_field('benefits_block'); ?>
				</div>
			</div>
			<div class="block global bg-light">
				<div class="container">
					<h2 class="text-center">Trusted by the World’s Top Systems Integrators </h2>
					<div class=""><!-- global-carousel slider-carousel -->
						<div class="mask">
							<ul class="global-logoes flex-wrap">
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
					</div>
				</div>
			</div>
			<div class="block">
				<div class="container">
					<?php echo get_field('section_4'); ?>
				</div> 
			</div>
			<a href="#form-section" class="click-demo">Click Here Schedule a Demo</a>
		</div>
	</div>
<?php endwhile; else : _e( 'Sorry, no content available.', 'textdomain' ); endif; wp_reset_query(); ?>
</main>
<?php get_footer(); ?>