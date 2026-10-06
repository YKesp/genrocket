<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
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
 <main id="main" role="main">
  <section class="salesforce-sectionn" style="color:#000; min-height:200px;">
    <div class="container">
      <h1><?php _e( 'Oops! That page can&rsquo;t be found.', 'twentyfifteen' ); ?></h1>
      <p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'twentyfifteen' ); ?></p>
    </div>
  </section>
</main>

<?php
get_footer();
