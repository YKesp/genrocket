<?php
/**
 * Template Name: Contact Us */
/*******************Contact Us Page**********************/
get_header(); ?>
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
<!-- contain main informative part of the site -->
<main id="main" role="main">
	<section class="contact-section block">
		<div class="container">
			<div class="row">
				<div class="contact-block col-12 col-md-6">
					<?php
					$page_content = get_post(get_the_ID());
					echo $page_content->post_content;
					?>
					<footer> <strong class="follow">Follow us on</strong>
						<ul class="social-networks list-unstyled list-inline">
							<?php
							if( have_rows('social_links', 'option') ):
								while ( have_rows('social_links', 'option') ) : the_row();
									?>
									<li class="list-inline-item"><a href="<?php echo the_sub_field('media_url', 'option'); ?>" target="_blank" class="<?php echo get_sub_field('media_name', 'option')?>"><?php echo get_sub_field('media_name', 'option')?></a></li>
									<?php
								endwhile;
							else :
							endif;
							?>
						</ul>

					</footer>
				</div>
				<div class="contact-block col-12 col-md-5 pull-right">
					<h2><small>Message Us / Request A Demo</small></h2>
					<!-- <div class="contact-form"><?php //echo do_shortcode('[contact-form-7 id="3649" title="Contact Us"]')?></div> -->
					<div class="contact-form"><?php echo do_shortcode('[wpforms id="7745"]')?></div>
				</div>
			</div>
		</div>
	</section>
	<?php if(get_field('additional_editor')): ?>
		<?php echo get_field('additional_editor');?>
	<?php endif; ?>
		
		<div class="map-holder">
		<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d13161.522294715547!2d-119.209042!3d34.442486!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x54e9e2a5f08b6949!2sGen%20Rocket%2F%20Powerful%20Test%20Data%20Generation%20Software!5e0!3m2!1sen!2s!4v1604922611338!5m2!1sen!2s"  height="330" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
		</div>
	
</main>
<?php get_footer(); ?>