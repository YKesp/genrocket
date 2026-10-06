<?php /* Template Name: Executive Briefing */ ?>
<?php get_header(); ?>
<style type="text/css">
	.banner .caption h1{
		color: #a6d540 !important;
		font: 700 62px/1 'Catamaran',sans-serif !important;
		text-align: center;
	}
	.banner .caption h2 {
		color: #fff !important;
		font: 600 49px/1 'Catamaran',sans-serif !important;
		text-align: center;
		margin-bottom: 55px;
	}
	.form-box div.wpforms-container-full .wpforms-form .wpforms-field {
		padding: 10px 0 0 !important;
		clear: both;
	}
	.paradigm-block h3{
		text-transform: uppercase;
		font-size: 35px;
		font-weight: 600;
	}
	.block p{color: #000;}
	.global-logoes{
		justify-content: center;
	}
	.global-logoes li{
		width: 133px;
		min-width: 133px;
	}
	.form-box{
		background: #fff;
		padding:40px 58px;
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
	.block h3{font-size:30px;}
	.form-box div.wpforms-container-full .wpforms-form .wpforms-field{padding: 0 0 12px;}
	.form-box .form-control::-webkit-input-placeholder { color: #6b6b6b;}
	.form-box .form-control:-moz-placeholder {color: #6b6b6b;}
	.form-box .form-control::-moz-placeholder {
		color: #6b6b6b;`
		opacity: 1;
	}
	.mPS2id-target{padding: 0 !important;border: 0 !important;}
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
		font-size: 47px !important;
		color: #fff;
		font-weight: 600;
		margin: 0 0 10px;
	}
	.video-column p{
		font-size: 30px;
		margin-bottom: 30px;
	}
	@media screen and (max-width:1399px){
		.form-box{padding:25px;}
	}
	@media screen and (min-width:1399px){
		.banner .caption h1{
			font-size: 80px;
			margin: 0 0 30px;
		}
		.banner .caption h2{
			font-size: 60px;
		}
		.newslider{height: 700px;}
		.block .container{max-width: 1522px;}
		.block {font: 28px/1.4 Catamaran,sans-serif;}
		.block.bg-blue{font: 34px/1.4 Catamaran,sans-serif;}
		.block h1, .block h2 {
			font-size: 60px;
			line-height: 1.4;
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
		.banner .caption h1{
			font: 700 32px/1 'Catamaran',sans-serif !important;
		}
		.banner .caption h1 br{display:none;}
		.newslider {height: 350px;}
		.newslider .slide .caption h1 {font-size: 30px;}
		.newslider .slide .caption {
			font-size: 22px !important;
			line-height: 1.3 !important;
		}
		/*.newslider .slide .caption{background: none !important;}*/
	}
	@media screen and (min-width:768px){.banner .caption{background: none !important;}}
	@media screen and (max-width:991px){
		.form-box{
			padding: 25px;
		}
		.form-box h3{font-size: 15px;text-align: center !important;}
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
						<div class="container text-center">
							<div class="inner">
								<?php echo get_field('banner_caption'); ?>
							</div>
						</div>
					</div>
				<?php endif; ?>
			</div>
			<main id="main">
				<?php /*<div class="block inner-page">
					<div class="container"> */?>
						<?php //if (have_posts()) : while (have_posts()) : the_post();?>
							<?php //the_content(); ?>
						<?php //endwhile; else : _e( 'Sorry, no content available.', 'textdomain' ); endif; wp_reset_query(); ?>
					<?php /*</div>
				</div> */?>
				<div class="block inner-page">
					<div class="container">
						<?php echo get_field('section_1'); ?>
					</div> 
				</div>
				<div class="block bg-blue">
					<div class="container">
						<div class="row align-items-center">
							<div class="col-md-6 text-white text-white mb-4 mb-md-0 col-12">
								<?php echo get_field('section_2_content'); ?>
							</div>
							<div class="col-md-6">
								<div class="form-box">
									<?php $form = get_field('section_2_form'); ?>
									<?php echo do_shortcode($form); ?>
								</div>
							</div>
						</div>
					</div> 
				</div>
				<div class="block">
					<div class="container">
						<?php echo get_field('section_3'); ?>
					</div> 
				</div>
				<div class="block" style="background: #e7f9ff;">
					<div class="container">
						<?php echo get_field('section_4'); ?>
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
			</div>
		</div>
	</main>
	<?php get_footer(); ?>