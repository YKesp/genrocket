<?php
/**
 * Template Name: Lesson 2 */
get_header(); 
?>
<style type="text/css">
  .videos-box{
    position: relative; 
    width: 100%;  
    display: flex;
    flex-wrap: wrap;
    margin: 0 0 30px;
  }
  .videos-box .large-video{
    width:calc(60% - 20px); 
    margin-right: 20px;
  }
  .videos-box .thumbnail-video{
    width: 40%; 
    height: 100%;
    max-height: 340px;
    overflow: auto;
  }
  .videos-box .thumbnail-video .item{
    display: flex;
    flex-wrap: wrap;
  }
  .videos-box .thumbnail-video .item .img{
    width: 120px;
    margin-right: 15px;
  }
  .videos-box .thumbnail-video .item .img img, .videos-box .thumbnail-video .item .img iframe{
    width: 100%;
    height: 70px;
    object-fit: cover;  
  }
  .videos-box .thumbnail-video .item .text{
    width:calc(100% - 135px);  
    font-size: 16px;  
    line-height: 1.4;
    color: #000;  
  }
  .videos-box .thumbnail-video .item .text p{
   white-space: nowrap;
   text-overflow: ellipsis;
   overflow: hidden; 
 }
 .videos-box .thumbnail-video .text h3{
  font-size: 18px;  
  line-height: 1.2; 
  font-weight: 700; 
  color: #000;  
  white-space: nowrap;
  text-overflow: ellipsis;
  overflow: hidden; 
  margin: 0;  
}
@media screen and (max-width:991px){
  .videos-box .large-video{
    width:100%; 
    margin:0 0 20px;
  }
  .videos-box .thumbnail-video{
    width: 100%;
  }
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
      <nav aria-label="breadcrumb" class="breadcrumb-outer">
        <div class="container d-flex flex-wrap justify-content-between align-items-center">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="https://www.genrocket.com/flight-school/software-tester/">Software Tester</a></li>
            <li class="breadcrumb-item"><a href="#">Basic </a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo the_title();?></li>
          </ol>
          <div class=""><a href="#" class="text-dark"><i class="fa fa-chevron-left" aria-hidden="true"></i>
          Previous </a><a href="#" class="btn btn-primary mx-3">More Lessons</a><a href="#" class="text-dark">Next <i class="fa fa-chevron-right" aria-hidden="true"></i></a></div>
        </div>
      </nav>
      <main id="main">
        <div class="block inner-page pb-0">
          <div class="container">
            <?php if (have_posts()) : while (have_posts()) : the_post();?>
              <?php the_content(); ?>
            <?php endwhile; else : _e( 'Sorry, no content available.', 'textdomain' ); endif; wp_reset_query(); ?>
            <?php if( have_rows('videos') ): ?>
              <?php $count = count(get_field('videos')); ?>
              <div class="videos-box mb-5"> 
                <?php $vemo_id = get_field('article_video'); ?>
               <div class="large-video" <?php if($count<2) {?> style="width: 100%; margin:0;" <?php }?>>
                <div style="padding:56.25% 0 0 0;position:relative;">
                  <iframe src="https://player.vimeo.com/video/261399496" width="100%" height="334" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" style="position:absolute;top:0;left:0;width:100%;height:100%;" allowfullscreen ></iframe>
                </div>
              </div>
              <?php if($count>1) {?>
                <div class="thumbnail-video">
                  <?php while( have_rows('videos') ): the_row(); 
                    $v_id = get_sub_field('vimeo_id');
                    $v_title = get_sub_field('vimeo_title');
                    $v_description = get_sub_field('vimeo_description');
                    ?>
                    <div class="item">
                      <div class="img"><a href="#" title="<?php echo $v_id; ?>"><img src="https://vumbnail.com/<?php echo $v_id; ?>.jpg" class="img-fluid" alt="GenRocket - Test Data Management"></a></div>
                      <div class="text">
                        <h3><a href="#" title="<?php echo $v_id; ?>"><?php echo $v_title; ?></a></h3>
                        <p><?php echo $v_description; ?></p>
                      </div>
                    </div>
                  <?php endwhile; ?>
                </div> 
              <?php } ?>
            </div>
            <?php else: ?>
              <div class="video mb-5"><iframe src="https://www.youtube.com/embed/o5Vf8fo27Gw?rel=0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen="allowfullscreen" width="100%" height="500" frameborder="0"><span style="display: inline-block; width: 0px; overflow: hidden; line-height: 0;" data-mce-type="bookmark" class="mce_SELRES_start">﻿</span></iframe></div>
            <?php endif; ?>
          </div>
        </div>
        <div class="block bg-secondary py-4">
          <div class="container">
            <div class="search-box">
              <h4 class="text-uppercase">Search GenRocket Knowledge Base</h4>
              <div class="d-flex" style="background: #f0f0f0">
               <input type="search" placeholder="Enter your search term here..." id="inputURL2" class="form-control" style="background: #f0f0f0;">
               <button style="width: 120px;" type="Submit" OnClick="buttonClick2()"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
             </div>
           </div>
         </div>
       </div>
       <div class="block inner-page pb-0">
        <div class="container">
          <h2>Other Lesson Videos</h2>
          <?php /* <div class="row mb-5">
            <div class="col-lg-3 col-md-6 col-12 mb-4">
             <div style="position:relative; border: 1px solid #000; margin-bottom: 15px;">
              <a href="#"><img src="https://www.genrocket.com/wp-content/uploads/2021/04/lessons-img1.jpg" class="img-fluid w-100 mb-0" alt=""></a>
            </div>
            <h5><a href="#" class="text-dark">What is a GenRocket Attribute?</a></h5>
          </div>
          <div class="col-lg-3 col-md-6 col-12 mb-4">
           <div style="position:relative; border: 1px solid #000; margin-bottom: 15px;">
            <a href="#"><img src="https://www.genrocket.com/wp-content/uploads/2021/04/lessons-img2.jpg" class="img-fluid w-100 mb-0" alt=""></a></div>
            <h5>  <a href="#" class="text-dark">What is a GenRocket Generator?</a></h5>
          </div>
          <div class="col-lg-3 col-md-6 col-12 mb-4">
           <div style="position:relative; border: 1px solid #000; margin-bottom: 15px;">
            <a href="#"><img src="https://www.genrocket.com/wp-content/uploads/2021/04/lessons-img3.jpg" class="img-fluid w-100 mb-0" alt=""></a> </div>
            <h5> <a href="#" class="text-dark">What is a GenRocket Receiver?</a></h5>
          </div>
          <div class="col-lg-3 col-md-6 col-12 mb-4">
           <div style="position:relative; border: 1px solid #000; margin-bottom: 15px;">
            <a href="#"><img src="https://www.genrocket.com/wp-content/uploads/2021/04/lessons-img4.jpg" class="img-fluid w-100 mb-0" alt=""></a></div>
            <h5> <a href="#" class="text-dark">What is a GenRocket Scenario?</a></h5>
          </div>
          </div> */?>
          <?php if( have_rows('lesson_videos') ): ?>
           <div class="row mb-5">
            <?php while( have_rows('lesson_videos') ): the_row(); 
              $image = get_sub_field('lesson_image');
              $title = get_sub_field('lesson_title');
              $url = get_sub_field('lesson_url');
              ?>
              <div class="col-lg-3 col-md-6 col-12 mb-4">
                <div style="position:relative; border: 1px solid #000; margin-bottom: 15px;"><a href="<?php echo $url; ?>"><img src="<?php echo $image['url']; ?>" class="img-fluid w-100 mb-0" alt="GenRocket - Test Data Management"></a></div>
                <h5><a href="#" class="text-dark"><?php echo $title; ?></a></h5>
              </div>
            <?php endwhile; ?>
          </div>
        <?php endif; ?>
        <div class="btns d-flex justify-content-center align-items-center mb-4"><a href="#" class="text-dark"><i class="fa fa-chevron-left" aria-hidden="true"></i>
        Previous </a><a href="#" class="btn btn-primary mx-3">More Lessons</a><a href="#" class="text-dark">Next <i class="fa fa-chevron-right" aria-hidden="true"></i></a></div>
      </div>
    </div>
    <div class="block inner-page pt-0">
      <div class="container">
        <?php if(get_field('additional_editor')): ?>
          <?php echo get_field('additional_editor');?>
        <?php endif; ?>
      </div>
    </div> 
    <div class="block inner-page">
      <div class="container">
        <h2 class="text-center">Related Assets</h2>
        <div class="inner-page literatures p-3">
          <div class="row">
            <div class="col-12 col-md-6 col-lg-4 post">
              <div class="inner p-3">
                <?php //$image = get_field('image_box'); 
                //$title = get_field('title_box'); 
                $pdf = get_field('pdf_url'); 
                ?>
                <img src="https://www.genrocket.com/wp-content/uploads/2021/04/pdf-img.jpg" alt="GenRocket - Test Data Management" />
                <h3 class="text-uppercase">Synthetic Test Data</h3>
                <a href="<?php/* echo $pdf['url']; */?>https://www.genrocket.com/wp-content/uploads/2021/02/GenRocket-Enterprise-Class-Synthetic-Test-Data-Features.pdf" class="link">Download PDF</a>
              </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 post">
              <div class="inner p-3">
                <?php 
                /*$article_title = get_field('article_title'); 
                $article_text = get_field('article_text'); 
                $article_image = get_field('article_image'); 
                $button = get_field('article_button'); */
                ?>
                <img src="https://www.genrocket.com/wp-content/uploads/2021/04/article-img.jpg" alt="GenRocket - Test Data Management" />
                <h3 class="text-uppercase"><?php /* echo $article_title; */?>Article Box</h3>
                <p><?php /* echo $article_text; */?>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea nisi, maiores non eos eaque.</p>
                <a href="<?php/* echo $button['url']; */?>#" class="link">Read More</a>
              </div>
            </div>  
            <div class="col-12 col-md-6 col-lg-4 post">
              <div class="inner p-3">
                <img src="https://www.genrocket.com/wp-content/uploads/2021/04/search-img.jpg" alt="GenRocket - Test Data Management" />
                <h3 class="text-uppercase">How can we help <br>  you today?</h3>
                <input type="search" placeholder="Enter your search term here..." id="inputURL" class="form-control">
                <input type="submit" class="link btn-block" OnClick="buttonClick()" value="Search">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <?php get_footer(); ?>