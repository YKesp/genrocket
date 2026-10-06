<?php

/**

 * The template for displaying search results pages.

 *

 * @package WordPress

 * @subpackage Twenty_Fifteen

 * @since Twenty Fifteen 1.0

 */



get_header(); ?>





 <div class="banner">

	<?php

		$image = get_field('page_banner');

		$mobile = 'medium';

		$tablet = 'large';

		$full = 'full';

	?>

	<?php if( $image ) { ?>

		<picture>

			<source srcset="<?php echo wp_get_attachment_image_url ($image['ID'], $mobile); ?>" media="(max-width: 767px)">

			<source srcset="<?php echo wp_get_attachment_image_url ($image['ID'], $tablet); ?>" media="(max-width: 1024px)">

			<source srcset="<?php echo wp_get_attachment_image_url ($image['ID'], $size); ?>">

			<img src="<?php echo wp_get_attachment_image_url ($image['ID'], $full); ?>" alt="GenRocket - Test Data Management">

		</picture>

	<?php } else { ?>

		<img src="<?php bloginfo('template_url'); ?>/assets/images/WhyGenRocket_Header.jpg" alt="GenRocket - Test Data Management">

	<?php   } ?>

	<?php if(get_field('banner_title')): ?>

	<div class="caption">

		<div class="container text-center">

			<div class="inner">

				<h1><?php echo get_field('banner_title'); ?></h1>

				<?php if(get_field('banner_text')): ?>

					<p><?php echo get_field('banner_text'); ?></p>

				<?php endif; ?>

			</div>

		</div>

	</div>

	<?php endif; ?>

</div>

<!-- contain main informative part of the site -->

<main id="main">

	<div class="block inner-page news-section">

		<div class="container">

			<h2><?php printf( __( 'Search Results for: %s', 'twentyfifteen' ), get_search_query() ); ?></h2>

      <?php if ( have_posts() ) : ?>

      <div class="blocks-holder">

        <?php

			while ( have_posts() ) : the_post();

			$content = substr(strip_tags(get_the_content()),0,350);

			//$content = apply_filters('the_content', $content);

		 ?>

        <div class="news-block"> <strong class="title"><?php echo the_title(); ?></strong>

          <p><?php echo $content; ?>...</p>

          <a href="<?php echo get_the_permalink(get_the_ID()); ?>" class="btn-more">Read More</a>

        </div>

        <?php





			// End the loop.

			endwhile;







			if(function_exists('wp_paginate')) {

				wp_paginate();

			}

			else {

				// Previous/next page navigation.

				the_posts_pagination( array(

					'prev_text'          => __( 'Previous page', 'twentyfifteen' ),

					'next_text'          => __( 'Next page', 'twentyfifteen' ),

					'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentyfifteen' ) . ' </span>',

				) );

			}



			?>

      </div>

      <?php

	  // If no content, include the "No posts found" template.

		else :

			printf( __( 'Sorry, we couldn’t find any results for: %s', 'twentyfifteen' ), get_search_query() );

			get_template_part( 'content', 'none' );

		endif;

		?>



		</div>

	</div>

</main>

<?php get_footer(); ?>

