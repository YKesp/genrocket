<?php
/**
 * The template for displaying News Category archive pages
 */
get_header(); ?>
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
			<h2>News & Events</h2>
			<div class="row">
				<div class="col-lg-3 col-md-4 col-12">
					<nav class="sidenav">
						<ul>
							<?php 
								$categories = get_terms( array(
								    'taxonomy'   => 'news-category',
								    'hide_empty' => false,
									'orderby'    => 'name',
									'order'      => 'ASC'
								) );

								$current_term_id = get_queried_object_id();

								if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
									foreach ( $categories as $category ) {
										if ( $category->name != 'Uncategorized' ) {
											$active = ( $current_term_id == $category->term_id ) ? 'active' : '';
											echo '<li class="' . $active . '"><a href="' . get_term_link( $category ) . '">' . esc_html( $category->name ) . '</a></li>';
										}
									}
								}
							?>
						</ul>
					</nav>
				</div>
				<div class="col-lg-9 col-md-8 col-12">
					<div class="blocks-holder">
				<?php 
				$args = array(
					'posts_per_page'   => -1,
					'post_type'        => 'news',
					'post_status'      => 'publish',
					'tax_query'        => array(
						array(
							'taxonomy' => 'news-category',
							'field'    => 'term_id',
							'terms'    => $current_term_id,
						)
					),
					'orderby'          => 'post_date',
					'order'            => 'DESC',
					'suppress_filters' => true 
				);
				$all_news = get_posts( $args );

				if ( ! empty( $all_news ) ) {
					foreach ( $all_news as $news ) {
						$news_title = $news->post_title;
						$description = substr( strip_tags( $news->post_content ), 0, 350 );
						$categories = get_the_terms( $news->ID, 'news-category' );
						if ( ! $categories || is_wp_error( $categories ) ) {
							$categories = array();
						}
						$categories = array_values( $categories );
						?>
						<div class="news-block">
							<strong class="title"><a href="<?php echo get_the_permalink( $news->ID ); ?>"><?php echo esc_html( $news_title ); ?></a></strong>
							<span class="by"><?php echo get_the_date( 'M d, Y', $news->ID ); ?></span>
							<p><?php echo $description; ?>...</p>
							<a href="<?php echo get_the_permalink( $news->ID ); ?>" class="btn-more">Read More</a>
						</div>
						<?php
					}
				} else {
					echo '<p>No news items found in this category.</p>';
				}
				?>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
<?php get_footer(); ?>
