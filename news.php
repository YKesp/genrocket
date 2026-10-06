<?php /* Template Name: News Template */ ?>
<?php get_header(); ?>
<?php 
// Use get_queried_object() if this is a category/term archive page
$banner = get_field('category_banner', get_queried_object());

// If it's a standard Post or Page instead of a category, use this line instead:
// $banner = get_field('category_banner');

$fallback_image = get_template_directory_uri() . '/assets/images/img29.jpg';

// Safely extract from the array
$image_url = (is_array($banner) && !empty($banner['url'])) ? $banner['url'] : $fallback_image;
$image_alt = (is_array($banner) && !empty($banner['alt'])) ? $banner['alt'] : 'GenRocket - Test Data Management';
?>

<div class="banner">
	<img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
</div>
<main id="main">
	<div class="block inner-page news-section">
		<div class="container">
			<h1>News & Events</h1>
			<div class="row">
				<div class="col-lg-3 col-md-4 col-12">
					<!-- <h3>Filter By</h3> -->
					<nav class="sidenav">
						<ul>
							<?php 
								// Query custom taxonomy terms for 'News & Events'
								// Replace 'news_category' with your actual custom taxonomy slug if different
								$categories = get_terms(array(
									'taxonomy'   => 'news-category', 
									'hide_empty' => false,
								));

								if (!empty($categories) && !is_wp_error($categories)) {
									foreach($categories as $category) {
										// Skip Uncategorized by slug
										 if (in_array($category->slug, array('uncategorized', 'blog'))) {
											continue;
										}

										$cat_name = $category->name;

										// Determine custom destination URLs
										switch($cat_name) {
											case 'Press Releases':
											case 'Test Data Generation':
											case 'Test Data':
											case 'White Box Testing':
												case 'Blog':
												$link = site_url('/blog');
												break;
											default:
												$link = get_term_link($category);
												break;
										}

										echo '<li><a href="' . esc_url($link) . '">' . esc_html($cat_name) . '</a></li>';
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
						'post_type'        => 'news',
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