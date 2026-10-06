<?php
/**
 * Template Name: Support */
get_header(); ?>
<div class="banner support-banner <?php echo get_field('banner_class'); ?>">
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
		<div class="container support-text text-center">
			<?php
			    $page_content = get_post(get_the_ID());
			    echo $page_content->post_content;
			?>
		</div>
	</section>
</main>
<?php get_footer(); ?>