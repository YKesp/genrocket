<?php get_header(); ?>
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
      <main id="main">
        <section class="second_nav">
          <div class="container">
            <ul id="menu-products-submenu"  class="w-100">
              <li class="first-tab"><a href="https://www.genrocket.com/flight-school-welcome/">Welcome</a></li>
              <li class="new-tab"><a href="<?php the_permalink(6375); ?>">Orientation</a></li>
              <!-- <li class="second-tab"><a href="#)">Data Architect</a></li>
              <li class="third-tab"><a href="#">Test Data Engineer</a></li> -->
               <li class="forth-tab"><a href="#" style="pointer-events: none;">Software Tester</a>
                <div class="megadrop">
                  <div class="col">
                    <h3><a href="https://www.genrocket.com/flight-school/software-tester/" class="text-dark">Basic</a></h3>
                    <p style="display: block; margin-bottom: 20px;">In the Basic Flight Plan, Software Testers will learn essential GenRocket concepts and skills that are needed to generate test data by creating and running Scenarios</p>
                    <div class="btns d-flex justify-content-center"><a href="https://www.genrocket.com/flight-school/software-tester-basic/" class="btn btn-primary mb-4 btn-sm">View Plan</a></div>
                  </div>
                  <div class="col">
                   <h3><a href="https://www.genrocket.com/flight-school/software-tester-intermediate/" class="text-dark">Intermediate</a></h3>
                    <p style="display: block; margin-bottom: 20px;">In the Intermediate Flight Path, Software Testers will learn intermediate GenRocket concepts including Linked Generators, Parent/Child/Sibling Relationships, Generator Tagging, and Self Service Portal.</p>
                   <div class="btns d-flex justify-content-center"><a href="https://www.genrocket.com/flight-school/software-tester-intermediate/" class="btn btn-primary mb-4 btn-sm">View Plan</a></div>
                  </div>
                </div>
              </li>
             <li class="fifth-tab"><a href="<?php the_permalink(6075); ?>">Organization Admin</a></li>
              <li class="sixth-tab"><a href="<?php the_permalink(6326); ?>">Data Architect</a></li>
            </ul> 
          </div>
        </section>
        <?php if (have_posts()) : while (have_posts()) : the_post();?>
          <?php the_content(); ?>
        <?php endwhile; else : _e( 'Sorry, no content available.', 'textdomain' ); endif; wp_reset_query(); ?>
        <?php if(get_field('additional_editor')): ?>
          <?php echo get_field('additional_editor');?>
        <?php endif; ?>
      </main>
      <?php get_footer(); ?>