<?php /* Template Name: Newsletter Template */ ?>
<?php get_header(); ?>
<div class="banner <?php echo get_field('banner_class'); ?>">
	<img src="<?php bloginfo('template_url'); ?>/assets/images/img29.jpg" alt="GenRocket - Test Data Management">
</div>
<main id="main">
	<div class="block inner-page news-section">
		<div class="container">
			<h1>Newsletters</h1>
			<div class="row">
				<div class="col-lg-3 col-md-4 col-12">
					<!-- <h3>Filter By</h3> -->
					<nav class="sidenav">
						<ul>
							<?php 
								$categories = get_terms( array(
								    'taxonomy' => 'newsletter-category',
								    'hide_empty' => false,
									'orderby' => 'term_id',
									'order' => 'DESC'
								) );;
								foreach($categories as $category) {
									$cat_link =  get_category_link($category->term_id);
									$cat_name = $category->name;
									if($cat_name != 'Uncategorized'){
										echo '<li><a href="' . get_category_link($category->term_id) . '">' . $category->name . '</a></li>';
									}
								}
							?>
						</ul>
					</nav>
				</div>
				<div class="col-lg-9 col-md-8 col-12">
					<div class="blocks-holder">
					<?php $args = array(
						'posts_per_page'   => -1,
						'offset'           => 0,
						'orderby'          => 'post_date',
						'order'            => 'DESC',
						'post_type'        => 'newsletter',
						'post_status'      => 'publish',
						'suppress_filters' => true
						);
						$all_news = get_posts( $args );
						if(count($all_news)>0){
							foreach($all_news as $news){
								$news_title = $news->post_title;
								$description = substr(strip_tags($news->post_content),0,350);
								$categories = get_the_terms( $news->ID, 'news-category' );
								if ( ! $categories || is_wp_error( $categories ) )
								$categories = array();
								$categories = array_values( $categories );
								?>
								<div class="news-block"><strong class="title"><a href="<?php echo get_the_permalink($news->ID); ?>"><?php echo $news_title; ?></a></strong> <span class="by"><!-- by <?php //echo the_author_meta( 'display_name' , $news->post_author ); ?> on  --><?php echo get_the_date('M d, Y', $news->ID); ?></span>
								<p><?php echo $description; ?>...</p>
								<a href="<?php echo get_the_permalink($news->ID); ?>" class="btn-more">Read More</a>
								</div>
						<?php } } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
<?php get_footer(); ?>