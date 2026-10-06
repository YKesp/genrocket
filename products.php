<?php /* Template Name: products Template */ ?>
<?php get_header(); ?>
<div class="banner <?php echo get_field('banner_class'); ?>">
	<div class="container">
		<div class="row">
			<div class="col-md-6 visual-img">
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
			</div>
			<?php if(get_field('banner_caption')): ?>
				<div class="col-md-6 traning-content pull-right text-center">
					<?php echo get_field('banner_caption'); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>
<main id="main">
	<?php if (have_posts()) : while (have_posts()) : the_post();?>
		<?php the_content(); ?>
	<?php endwhile; else : _e( 'Sorry, no content available.', 'textdomain' ); endif; wp_reset_query(); ?>
</main>
<?php get_footer(); ?>