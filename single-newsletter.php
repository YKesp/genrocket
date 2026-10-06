<?php
get_header(); ?>
<div class="banner <?php echo get_field('banner_class'); ?>">
  <img src="<?php bloginfo('template_url'); ?>/assets/images/img29.jpg" alt="GenRocket - Test Data Management">
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