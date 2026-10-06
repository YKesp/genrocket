<?php
/**
 * Template Name: Flight School */
get_header(); 
?>
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
				<section class="second_nav">
					<div class="container">
						<ul id="menu-products-submenu">
							<li class="first-tab"><a href="https://www.genrocket.com/flight-school-welcome/">Welcome</a></li>
							<li class="second-tab"><a href="#)">Data Architect</a></li>
							<li class="third-tab"><a href="#">Test Data Engineer</a></li>
							<li class="forth-tab"><a href="https://www.genrocket.com/flight-school/software-tester/">Software Tester</a>
								<div class="megadrop">
									<div class="col">
										<h3>Basic</h3>
										<ul>
											<li>Lorem ipsum dolor sit amet consectetur</li>
											<li>Lorem ipsum dolor sit amet consectetur</li>
											<li>Lorem ipsum dolor sit amet consectetur</li>
											<li>Lorem ipsum dolor sit amet consectetur</li>
											<li>Lorem ipsum dolor sit amet consectetur</li>
											<li>Lorem ipsum dolor sit amet consectetur</li>
											<li>Lorem ipsum dolor sit amet consectetur</li>
										</ul>
									</div>
									<div class="col">
										<h3>Intermediate</h3>
										<ul>
											<li>Lorem ipsum dolor sit amet consectetur</li>
											<li>Lorem ipsum dolor sit amet consectetur</li>
											<li>Lorem ipsum dolor sit amet consectetur</li>
											<li>Lorem ipsum dolor sit amet consectetur</li>
											<li>Lorem ipsum dolor sit amet consectetur</li>
											<li>Lorem ipsum dolor sit amet consectetur</li>
											<li>Lorem ipsum dolor sit amet consectetur</li>
										</ul>
									</div>
									<div class="col">
										<h3>Advance</h3>
										<ul>
											<li>Lorem ipsum dolor sit amet consectetur</li>
											<li>Lorem ipsum dolor sit amet consectetur</li>
											<li>Lorem ipsum dolor sit amet consectetur</li>
											<li>Lorem ipsum dolor sit amet consectetur</li>
											<li>Lorem ipsum dolor sit amet consectetur</li>
											<li>Lorem ipsum dolor sit amet consectetur</li>
											<li>Lorem ipsum dolor sit amet consectetur</li>
										</ul>
									</div>
								</div>
							</li>
							<li class="fifth-tab"><a href="#">Test Data Manager</a></li>
						</ul>
					</div>
				</section>
				<?php if (have_posts()) : while (have_posts()) : the_post();?>
					<?php the_content(); ?>
				<?php endwhile; else : _e( 'Sorry, no content available.', 'textdomain' ); endif; wp_reset_query(); ?>
				<?php if(get_field('additional_editor')): ?>
					<?php echo get_field('additional_editor');?>
				<?php endif; ?>
			</main>
			<?php get_footer(); ?>