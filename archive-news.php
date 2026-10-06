<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */
get_header(); ?>
<div class="banner <?php echo get_field('banner_class'); ?>">
	<img src="<?php bloginfo('template_url'); ?>/assets/images/img29.jpg" alt="GenRocket - Test Data Management">
</div>
<main id="main">
	<div class="block inner-page news-section">
		<div class="container">
			<h1>News</h1>
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
			<div class="news-block"><strong class="title"><?php echo $news_title; ?></strong> <span class="by">by <?php echo the_author_meta( 'display_name' , $news->post_author ); ?> on <?php echo get_the_date('F d, Y', $news->ID); ?></span>
				<p><?php echo $description; ?>...</p>
				<a href="<?php echo get_the_permalink($news->ID); ?>" class="btn-more">Read More</a>
				<footer> <span class="posted">Posted in</span>
					<ul class="posted-list list-unstyled list-inline">
						<?php
						foreach($categories as $category){
							echo '<li><a href="'.get_category_link( $category->term_id ).'">'.$category->name.'</a></li>';
						}
						?>
						<li><a href="<?php echo get_the_permalink($news->ID); ?>#leave-comment">Leave a comment</a></li>
					</ul>
				</footer>
			</div>
			<?php
		}
	}
	?>
</div>
</div>
</div>
</main>
<?php get_footer(); ?>