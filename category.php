<?php
/**
 * The template for displaying Category pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
get_header(); 

$fallback_image = get_template_directory_uri() . '/assets/images/img29.jpg';
$fallback_alt   = 'GenRocket - Test Data Management';

$image_url = '';
$image_alt = '';

$post_id = get_the_ID();

// 1. Check Post Banner (checks 'category_banner', 'banner_image', 'banner')
$post_banner = get_field('category_banner', $post_id);
if (empty($post_banner)) {
    $post_banner = get_field('banner_image', $post_id);
}
if (empty($post_banner)) {
    $post_banner = get_field('banner', $post_id);
}

if (!empty($post_banner)) {
    if (is_array($post_banner)) {
        $image_url = !empty($post_banner['url']) ? $post_banner['url'] : '';
        $image_alt = !empty($post_banner['alt']) ? $post_banner['alt'] : get_the_title();
    } elseif (is_string($post_banner)) {
        $image_url = $post_banner;
        $image_alt = get_the_title();
    }
}

// 2. If no post banner, check Category Banner from assigned 'news-category'
if (empty($image_url)) {
    $terms = get_the_terms($post_id, 'news-category');
    if (!empty($terms) && !is_wp_error($terms)) {
        foreach ($terms as $term) {
            $cat_banner = get_field('category_banner', $term);
            if (empty($cat_banner)) {
                $cat_banner = get_field('category_banner', 'news-category_' . $term->term_id);
            }
            if (empty($cat_banner)) {
                $cat_banner = get_field('category_banner', 'term_' . $term->term_id);
            }

            if (!empty($cat_banner)) {
                if (is_array($cat_banner)) {
                    $image_url = !empty($cat_banner['url']) ? $cat_banner['url'] : '';
                    $image_alt = !empty($cat_banner['alt']) ? $cat_banner['alt'] : $term->name;
                } elseif (is_string($cat_banner)) {
                    $image_url = $cat_banner;
                    $image_alt = $term->name;
                }
                if (!empty($image_url)) {
                    break;
                }
            }
        }
    }
}

// 3. Fallback to default template image if both post and category have no banner
if (empty($image_url)) {
    $image_url = $fallback_image;
    $image_alt = $fallback_alt;
}

$banner_class = get_field('banner_class', $post_id);
?>
<main id="main">
	<div class="block inner-page news-section">
		<div class="container">
			<!-- <h2><?php //printf( __( '%s', 'twentyfourteen' ), single_cat_title( '', false ) ); ?></h2> -->
			<h2>News & Events</h2>
			<div class="row">
				<div class="col-lg-3 col-md-4 col-12">
					<!-- <h3>Filter By</h3> -->
					<nav class="sidenav">
						<ul>
							<?php 
								$categories = get_terms( array(
								    'taxonomy'   => array( 'news-category', 'category' ),
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
				$current_term = get_queried_object();
				$args = array(
					'posts_per_page'   => -1,
					'offset'           => 0,
					'post_type'        => array( 'news', 'post' ),
					'post_status'      => 'publish',
					'orderby'          => 'post_date',
					'order'            => 'DESC',
					'suppress_filters' => true 
				);
				if ( isset( $current_term->taxonomy ) ) {
					$args['tax_query'] = array(
						array(
							'taxonomy' => $current_term->taxonomy,
							'field'    => 'term_id',
							'terms'    => $current_term->term_id,
						)
					);
				}
				$all_news = get_posts( $args );
		/*echo '<pre>';
		print_r($members);
		exit;*/
		if(count($all_news)>0){
			foreach($all_news as $news){
				$news_title = $news->post_title;
				$description = substr(strip_tags($news->post_content),0,350);
				$categories = get_the_terms( $news->ID, 'news-category' );
				if ( ! $categories || is_wp_error( $categories ) )
					$categories = array();
				$categories = array_values( $categories );
			/*echo '<pre>';
			print_r($news);*/
			?>
			<div class="news-block">  <strong class="title"><a href="<?php echo get_the_permalink($news->ID); ?>"><?php echo $news_title; ?></a></strong> <span class="by"><!-- by <?php //echo the_author_meta( 'display_name' , $news->post_author ); ?> on --> <?php echo get_the_date('M d, Y', $news->ID); ?></span>
				<p><?php echo $description; ?>...</p>
				<a href="<?php echo get_the_permalink($news->ID); ?>" class="btn-more">Read More</a>
			</div>
			<?php
		}
	}
	?>
</div>
				</div>
			</div>
		</div>
	</div>
</main>
<?php get_footer(); ?>