<?php get_header();  ?>
<style type="text/css">
  .block.inner-page img{
    max-width: 100% !important;
    display: block !important;
    margin: 0 auto 20px !important;
  }
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
.pager-tabs a{color: #343a40 !important;}
.pager-tabs a.btn{color: #fff !important;}
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
<?php $id = get_the_ID(); ?>
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
        <?php else:?>
         <picture>
          <source srcset="https://www.genrocket.com/wp-content/uploads/2021/04/flight-school-banner-1-640x184.jpg" media="(max-width: 767px)">
            <source srcset="https://www.genrocket.com/wp-content/uploads/2021/04/flight-school-banner-1-1024x295.jpg" media="(max-width: 1024px)">
              <source srcset="https://www.genrocket.com/wp-content/uploads/2021/04/flight-school-banner-1.jpg">
                <img src="https://www.genrocket.com/wp-content/uploads/2021/04/flight-school-banner-1.jpg" alt="GenRocket - Test Data Management">
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
            <div class="block inner-page pb-0">
              <div class="container">
                <h1>All Lesson Videos</h1>
                <div class="row mb-5">
                  <?php
                  $posts = array(
                    'post_type' => 'flight-school',
                    'post_status' => 'publish',
                    'posts_per_page' => '999',
                    'order'=>'DESC',
                    //'orderby' => 'publish_date',
                    'post__not_in' => array(5485)
                  );
                  $the_query = new WP_Query( $posts );
                  if( $the_query->have_posts() ):
                    while( $the_query->have_posts() ) : $the_query->the_post(); $count = 0; ?>
                     <div class="col-lg-3 col-md-6 col-12 mb-4">
                      <div style="position:relative; border: 1px solid #000; margin-bottom: 15px;">
                       <?php  $video = get_field('article_video_url', $post->ID);  ?>
                       <a href="<?php echo the_permalink(); ?>">
                         <?php if($video) {?>
                           <?php 
                           $video_array = explode('/embed/', $video);
                           $video_id = $video_array[1];
                           ?>
                           <img src="http://i3.ytimg.com/vi/<?php echo $video_id; ?>/hqdefault.jpg" style="width: 253px; height: 144px; object-fit: cover;" class="img-fluid w-100 mb-0" alt="GenRocket - Test Data Management">
                         <?php } else {?>
                          <img src="https://www.genrocket.com/wp-content/uploads/2021/04/lessons-img0.jpg" class="img-fluid w-100 mb-0" alt="GenRocket - Test Data Management">
                        <?php }?>
                      </a>
                    </div>
                    <h5><a href="<?php the_permalink();?>" class="text-dark"><?php echo the_title(); ?></a></h5>
                  </div>
                  <?php $count++; endwhile;
                endif; 
                wp_reset_query(); 
                ?>
              </div>
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