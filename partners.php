<?php /* Template Name: Partners Template */ ?>
<?php get_header(); ?>
<style type="text/css">
	#main.mPS2id-target{padding: 0 !important;}
	.contain .container{max-width: 1140px !important;}
	.partners-logoes li{
		width: 16.66%;
		padding: 0 10px;
		min-height: 150px;
		display: flex;
		flex-direction: column;
		justify-content: center;
	}
	.partners-logoes li img{
		max-width: 145px;
	}
	.partners-logoes{max-width: 100% !important;display: flex;flex-wrap: wrap;justify-content: center;}
	@media screen and (max-width:991px){
		.partners-logoes li{
			width: 33.32%;
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
		<div class="container text-center">
			<div class="inner">
				<?php echo get_field('banner_caption'); ?>
			</div>
		</div>
	</div>
	<?php endif; ?>
</div>
<main id="main">
	<!--<div class="contain first-blk block">
        <div class="container">
        	<?php if (have_posts()) : while (have_posts()) : the_post();?>
		<?php the_content(); ?>
	<?php endwhile; else : _e( 'Sorry, no content available.', 'textdomain' ); endif; wp_reset_query(); ?>
        </div>
    </div>-->
    <div class="contain partners block">
        <div class="container">
            <h1>Global Systems Integrators</h1>
            <ul class="partners-logoes">
				<?php if( have_rows('partners', 'option') ):
					while ( have_rows('partners', 'option') ) : the_row(); ?>
					<li><img src="<?php echo the_sub_field('logos');?>" alt="Partners logo"></li>
				<?php endwhile; else : endif; ?>
			</ul>
        </div>
    </div>
	<div class="contain partners block">
        <div class="container">
            <h2>Regional Systems Integrators</h2>
            <ul class="partners-logoes">
				<?php if( have_rows('quality', 'option') ):
					while ( have_rows('quality', 'option') ) : the_row(); ?>
					<li><img src="<?php echo the_sub_field('qa_logos');?>" alt="Quality Assurance logo"></li>
				<?php endwhile; else : endif; ?>
			</ul>
        </div>
    </div>
    <div class="contain partners block">
        <div class="container">
            <h2>Resellers</h2>
            <ul class="partners-logoes">
				<?php if( have_rows('resellers', 'option') ):
					while ( have_rows('resellers', 'option') ) : the_row(); ?>
					<li><img src="<?php echo the_sub_field('resellers_logo');?>" alt="Resellers logo"></li>
				<?php endwhile; else : endif; ?>
			</ul>
        </div>
    </div>
    <div class="contain partners block">
        <div class="container">
            <h2>Technology Partners</h2>
			<ul class="partners-logoes">
				<?php if( have_rows('technology', 'option') ):
					while ( have_rows('technology', 'option') ) : the_row(); ?>
					<li><img src="<?php echo the_sub_field('technology_logo');?>" alt="Partners logo"></li>
				<?php endwhile; else : endif; ?>
			</ul>
        </div>
    </div>
    <?php echo get_field('deal_registration'); ?>
</main>
<?php get_footer(); ?>