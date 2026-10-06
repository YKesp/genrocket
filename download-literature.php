<?php /* Template Name: Download Literature Template */ ?>
<?php get_header(); ?>
<?php 
	$search_title = $_GET['search-cat']; 
	$parent_term_id = $_GET['search-cat']; 
?>
<style type="text/css">
	.search-inner{
		background-color:#fff;
		width:100%;
		padding:10px;
		box-shadow: 0 0 20px rgba(0,0,0,0.1);
		border-radius: 5px;
		overflow: hidden;
		margin-bottom: 10px;
	}
	.search-inner .custom-select {
		position: relative;
		border: none;
		padding: 0;
		width: 230px;
		height: 32px;
	}
	.search-inner select, .search-inner select:active, .search-inner select:focus {
		background: #fff;
		border: none;
		height: 32px;
		color: rgb(41, 49, 90);
		outline: 0;
		box-shadow: none;
		font-weight: 500;
		width: 100%;
	}
	.searchfield{position: relative;}
	.searchfield #search-submit {
		background: none;
		border: 0;
		color: #000;
		min-width: 30px;
		height: 30px;
		position: absolute;
		left: 2px;
		z-index: 999;
		top: 1px;
	}
	.searchfield .input {
		width: 100%;
		background: #eceef0;
		height: 32px;
		line-height: 30px;
		border: 1px solid #eceef0 !important;
		border-radius: 3px;
		z-index: 99;
		padding: 0 23px 0 34px;
		color: #868a90;
		margin-right: 0;
		text-transform: lowercase;
	}
	@media screen and (max-width:767px){
		.searchfield,
		.search-inner .custom-select,
		.search-inner .partner-filter .searchform,
		.search-inner select, .search-inner select:active, .search-inner select:focus{
			width: 100%;
		}
		.search-inner .custom-select{padding-right: 0 !important;}
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
<?php /*
<main id="main">
	<div class="block inner-page literatures">
		<div class="container">
			<?php if (have_posts()) : while (have_posts()) : the_post();?>
				<?php the_content(); ?>
				<div class="row">
					<?php if( have_rows('literature') ):
						while ( have_rows('literature') ) : the_row(); ?>
							<div class="col-12 col-md-6 col-lg-4 post">
								<div class="inner">
									<?php 
										$link = get_sub_field('literature_pdf');
										$image = get_sub_field('literature_image');
									?>
									<img src="<?php echo $image['url'] ?>" alt="GenRocket - Test Data Management">
									<h3><?php echo the_sub_field('literature_title'); ?></h3>
									<p><?php echo the_sub_field('literature_para'); ?></p>
									<?php if($link): ?>
										<a href="<?php echo $link['url'] ?>" class="link"><?php echo $link['title'] ?></a>
									<?php endif; ?>
								</div>
							</div>
						<?php endwhile; else : endif; ?>
					</div>
				<?php endwhile; else : _e( 'Sorry, no content available.', 'textdomain' ); endif; wp_reset_query(); ?>
			</div>
		</div>
		</main> */?>
		<main id="main">
			<div class="block inner-page literatures">
				<div class="container">
					<?php if (have_posts()) : while (have_posts()) : the_post();?>
						<?php the_content(); ?>
						<!-- Search Form -->
						<form method="get" action="<?php the_permalink(); ?>" class="searchform">
							<div class="search-inner d-flex flex-wrap justify-content-between">
								<div class="custom-select">
									<select name="search_litcategory" id="search-cat">
										<option value="" class="d-none">All Categories</option>
										<option value="">All Categories</option>
										<?php
										$categories = array();
										if ( have_rows( 'literature' ) ):
											while ( have_rows( 'literature' ) ) : the_row();
												$cat = get_sub_field( 'literatures_cat' );
												if (!in_array($cat, $categories)) {
													$categories[] = $cat;
													?>
													<option value="<?php echo $cat; ?>" <?php echo isset($_GET['search_litcategory']) && $_GET['search_litcategory'] == $cat ? 'selected' : ''; ?>><?php echo $cat; ?></option>
													<?php
												}
											endwhile;
										endif;
										?>
									</select>
								</div>
								<div class="searchfield">
									<input type="text" class="input" name="search_title" placeholder="Search by Title" value="" />
									<button type="submit" value="Search" id="search-submit"><i class="fa fa-search"></i></button>
								</div>
							</div>
						</form>
						<!-- End of Search Form -->
						<div class="row">
							<?php  $counter = 0; if( have_rows('literature') ):
								while ( have_rows('literature') ) : the_row();
                            // Retrieve literature details
									$link = get_sub_field('literature_pdf');
									$image = get_sub_field('literature_image');
									$title = get_sub_field('literature_title');
									$para = get_sub_field('literature_para');
									$lit_category = get_sub_field('literatures_cat');
                            // Apply search filter
									$search_title = isset($_GET['search_title']) ? strtolower($_GET['search_title']) : '';
									$search_litcategory = isset($_GET['search_litcategory']) ? $_GET['search_litcategory'] : '';
									if (($search_title === '' || stripos(strtolower($title), $search_title) !== false) &&
										($search_litcategory === '' || $search_litcategory === $lit_category)) {
											$counter++; ?>
											<div class="col-12 col-md-6 col-lg-4 post">
												<div class="inner">
													<img src="<?php echo $image['url']; ?>" alt="<?php echo $title; ?>">
													<h3><?php echo $title; ?></h3>
													<p><?php echo $para; ?></p>
													<?php if($link): ?>
														<a href="<?php echo $link['url']; ?>" class="link"><?php echo $link['title']; ?></a>
													<?php endif; ?>
												</div>
											</div>
											<?php
										}
										 //if ($counter >= 8) break;
									endwhile;
								else :
		                        // No literature found
									echo 'No literature found.';
								endif; ?>
							</div>
						<?php endwhile; else : _e( 'Sorry, no content available.', 'textdomain' ); endif; wp_reset_query(); ?>
					</div>
				</div>
			</main>
			<?php 
			$search_title = isset($_GET['search_title']) ? $_GET['search_title'] : ''; // Get the search term from the query string
			$parent_term_id = isset($_GET['saerch-cat']) ? $_GET['saerch-cat'] : '';
			?>
			<?php get_footer(); ?>
			<script type="text/javascript">
				$('#search-cat').on('change', function() {
					$( "#search-submit" ).trigger('click');
				});
			</script>