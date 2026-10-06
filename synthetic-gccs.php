<?php /* Template Name: Synthetic Data for GCCs */ ?>
<?php get_header(); ?>
<style>
	.banner .caption h1{color:#fff!important;font:700 62px/1 'Catamaran',sans-serif!important;text-align:center;}
	.title.mb-0 span{color:#a6d540!important;}
	.banner .caption {background: none !important;}
	#main, #wrapper{overflow: inherit !important;}
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
	<div class="block inner-page">
		<div class="container">
			<?php if (have_posts()) : while (have_posts()) : the_post();?>
				<?php the_content(); ?>
			<?php endwhile; else : _e( 'Sorry, no content available.', 'textdomain' ); endif; wp_reset_query(); ?>
		</div>
	</div>
	<?php if(get_field('additional_editor')): ?>
		<?php echo get_field('additional_editor');?>
	<?php endif; ?>
</main>
<?php get_footer();
