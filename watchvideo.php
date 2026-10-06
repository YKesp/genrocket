<?php /* Template Name: watchvideo Template */ ?>
<?php get_header(); ?>
<div class="video-banner">
<div class="video-box container">
	<div style="padding:56.25% 0 0 0;position:relative;">
		<?php echo get_field('banner-video');?>
	</div>
</div>
<main id="main">
	<div class="block">
		<div class="container text-center">
			<?php if (have_posts()) : while (have_posts()) : the_post();?>
				<?php the_content(); ?>
			<?php endwhile; else : _e( 'Sorry, no content available.', 'textdomain' ); endif; wp_reset_query(); ?>
		</div>
	</div>
	<div class="block blck2 gray-blk">
		<div class="container text-center">
			<?php echo get_field('additional_editor');?>
		</div>
	</div>
</main>
<?php get_footer(); ?>