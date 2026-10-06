<?php
get_header(); 

$fallback_image = get_template_directory_uri() . '/assets/images/img29.jpg';
$fallback_alt   = 'GenRocket - Test Data Management';

$image_url = '';
$image_alt = '';

$post_id = get_the_ID();

// 1. Check Post Banner (checks 'banner_image', then 'category_banner', 'banner')
$post_banner = get_field('banner_image', $post_id);
if (empty($post_banner)) {
    $post_banner = get_field('category_banner', $post_id);
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
<div class="banner <?php echo esc_attr($banner_class); ?>">
  <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
</div>
<main id="main">
  <div class="block news-section news-detail">
    <div class="container">
     <!-- <h2>News</h2> -->
     <div class="blocks-holder">
      <?php
      while ( have_posts() ) : the_post();
        ?>
        <div class="news-block p-0" style="padding-bottom:0px;"> <h1 class="title"><?php echo the_title(); ?></h1> <span class="by">by admin<?php //echo get_the_author(); ?> on <?php echo get_the_date('M d, Y', get_the_ID()); ?></span> </div>
        <section class="detail-section">
          <?php echo the_content(); ?>
        </section>
        <section class="single-pgn">
          <?php
          the_post_navigation( array(
            'next_text' => '<span class="screen-reader-text"><strong>' . __( 'Next post:', 'twentyfifteen' ) . '</strong></span> ' .
            '<span class="post-title">%title</span>',
            'prev_text' => '<span class="screen-reader-text"><strong>' . __( 'Previous post:', 'twentyfifteen' ) . '</strong></span> ' .
            '<span class="post-title">%title</span>',
            'screen_reader_text'=> '&nbsp;',
          ) );
          ?>
        </section>
        <?php
      endwhile;
      ?>
    </div>
  </div>
</div>
</main>
<?php get_footer(); ?>
