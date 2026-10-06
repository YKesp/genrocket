<?php get_header();  ?>
<?php $option = get_field('lessons_templates'); ?>
<?php if($option == 'child') {?>
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
.cta {
  background: #a6d540;
  color: #ffffff;
  font-size: 20px;
  padding: 15px 25px 15px 25px;
  text-decoration: none;
  border: none;
}
.cta:hover { 
  background: #27bff0;
  color: #ffffff;
  text-decoration: none;
  border: none;
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
        <nav aria-label="breadcrumb" class="breadcrumb-outer">
          <div class="container d-flex flex-wrap justify-content-between align-items-center">
            <?php 
              //All assigned terms
            $terms =  get_the_terms( $id , 'lessons-category' );
              //get parent terms
            $x = 0;
            foreach($terms as $term){
              if($term->parent == 0){
                $term_parent_id1 = $term->term_id;
                $term_parent_name = $term->name;
                $term_parent_slug = $term->slug;
              }
              $post_terms[$x] = $term->term_id;
              $x++;
            }
              //echo $term_parent_name;
              //get child terms
            $taxonomies = array( 
              'lessons-category',
            );
            $subterms = get_terms($taxonomies, array(
              'parent'   => $term_parent_id1,
              'hide_empty' => false
            ));
            foreach($subterms as $sub_term){
              $sub_term_id1 = $sub_term->term_id;
              if (in_array($sub_term_id1, $post_terms)) {
                $sub_term_id = $sub_term_id1;
                $sub_term_slug = $sub_term->slug;
                $sub_term_name = $sub_term->name;
              }
            }
              //echo '--'.$sub_term_slug;
              //get sub child terms
            $taxonomies = array( 
              'lessons-category',
            );
            $sub_child_terms = get_terms($taxonomies, array(
              'parent'   => $sub_term_id,
              'hide_empty' => false
            ));
            foreach($sub_child_terms as $sub_child_term){
              $sub_child_term_id1 = $sub_child_term->term_id;
              if (in_array($sub_child_term_id1, $post_terms)) {
                $sub_child_term_id = $sub_child_term_id1;
                $sub_child_name = $sub_child_term->name;
              }
            }
              //echo '--'.$sub_child_name;
      $post_id = $post->ID; // current post ID
     /* if( have_rows('lessons_sorting', 'options') ):
    // Loop through rows.
        while( have_rows('lessons_sorting', 'options') ) : the_row();
          $sub_value = get_sub_field('lesson_item');
          $ids[] = $sub_value->ID;
    // End loop.
        endwhile;
      endif;*/
       if( have_rows('parent_repeater', 'options') ):
    // Loop through rows.
        while( have_rows('parent_repeater', 'options') ) : the_row();
          
          $parent_category = get_sub_field('parent_category');
          $ids[] = $parent_category->ID;

            if( have_rows('child_repeater', 'options') ):
          // Loop through rows.
              while( have_rows('child_repeater', 'options') ) : the_row();

                $child_elements = get_sub_field('child_elements');
                //echo 'Hello 1 '.$child_elements->ID; exit();
                $ids[] = $child_elements->ID;

              endwhile;
            endif;

    // End loop.
        endwhile;
      endif;
      // get and echo previous and next post in the same category
      $thisindex = array_search( $post_id, $ids );
      $previd    = isset( $ids[ $thisindex - 1 ] ) ? $ids[ $thisindex - 1 ] : false;
      $nextid    = isset( $ids[ $thisindex + 1 ] ) ? $ids[ $thisindex + 1 ] : false;
      //print_r($terms[0]->name);
      //print("<pre>");print_r($terms);print("</pre>");
      ?>
      <ol class="breadcrumb">
        <?php if($term_parent_name=='Software Tester'){?>
          <li class="breadcrumb-item"><a href="https://www.genrocket.com/flight-school/<?php echo $term_parent_slug; ?>-<?php echo $sub_term_slug; ?>"><?php echo $term_parent_name; ?></a></li>
          <?php } elseif($term_parent_name=='Data Architect'){?>
           <li class="breadcrumb-item"><a href="https://www.genrocket.com/flight-school/<?php echo $sub_term_slug; ?>"><?php echo $term_parent_name; ?></a></li>
        <?php } else{  ?>
          <li class="breadcrumb-item"><a href="https://www.genrocket.com/flight-school/<?php echo $term_parent_slug; ?>"><?php echo $term_parent_name; ?></a></li>
        <?php }?>
        <?php if($term_parent_name=='Software Tester'){?>
          <li class="breadcrumb-item"><a href="https://www.genrocket.com/flight-school/<?php echo $term_parent_slug; ?>-<?php echo $sub_term_slug; ?>"><?php echo $sub_term_name; ?></a></li>
           <?php } elseif($term_parent_name=='Data Architect'){?>
          <li class="breadcrumb-item"><a href="https://www.genrocket.com/flight-school/<?php echo $sub_term_slug; ?>"><?php echo $sub_term_name; ?></a></li>
        <?php } else{  ?>
          <li class="breadcrumb-item"><a href="https://www.genrocket.com/flight-school/<?php echo $term_parent_slug; ?>"><?php echo $sub_term_name; ?></a></li>
        <?php }?>
        <li class="breadcrumb-item active" aria-current="page"><?php echo the_title();?></li>
      </ol>
      <div class="pager-tabs">
        <?php 
        if (false !== $previd ) {
          ?><a rel="prev" href="<?php echo get_permalink($previd) ?>"><img src="<?php bloginfo('template_url'); ?>/assets/images/left-arrow.svg" width="7px"> Previous</a><?php
        }?>
        <?php if($term_parent_name=='Software Tester'){?>
         <a href="https://www.genrocket.com/flight-school/<?php echo $term_parent_slug; ?>-<?php echo $sub_term_slug; ?>" class="btn btn-primary mx-3">Flight Plan</a>
          <?php } elseif($term_parent_name=='Data Architect'){?>
         <a href="https://www.genrocket.com/flight-school/<?php echo $sub_term_slug; ?>" class="btn btn-primary mx-3">Flight Plan</a>
       <?php } else{  ?>
         <a href="https://www.genrocket.com/flight-school/<?php echo $term_parent_slug; ?>" class="btn btn-primary mx-3">Flight Plan</a>
       <?php } ?>
       <?php 
       if (false !== $nextid ) {
        ?><a rel="next" href="<?php echo get_permalink($nextid) ?>">Next <img src="<?php bloginfo('template_url'); ?>/assets/images/right-arrow.svg" width="7px"></a><?php
      }        
      ?>
    </div>
  </div>
</nav>
<main id="main">
  <div class="block inner-page pb-0">
    <div class="container">
      <?php if (have_posts()) : while (have_posts()) : the_post();?>
        <?php the_content(); ?>
      <?php endwhile; else : _e( 'Sorry, no content available.', 'textdomain' ); endif; wp_reset_query(); ?>
      <?php $i=1; if( have_rows('videos') ): ?>
      <?php $count = count(get_field('videos')); ?>
      <div class="videos-box mb-5"> 
        <?php  $youtube_url = get_field('article_video_url'); ?>
        <div class="large-video" <?php if($count<2) {?> style="width: 100%; margin:0;" <?php }?>>
          <?php while( have_rows('videos') ): the_row(); 
            $v_url = get_sub_field('video_url');
            $video_array = explode('https://youtu.be/', $v_url);
            $video_id = '$video_array[1]';
            $v_title = get_sub_field('video_title');
            $v_description = get_sub_field('video_description');
                              
            ?>
            <?php if($i==1):   
            
                $thumbnail_medium = ""; $imgid = explode("/", get_sub_field('video_url'));
                if(strpos($v_url, "vimeo")){
                    $hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/".$imgid[count($imgid)-1].".php"));
                    $thumbnail_medium = $hash[0]['thumbnail_medium'];
                }                                  
                $vid_thumbnail = ""; $vid_play_url = "";
                if($thumbnail_medium != ""){
                    $vid_thumbnail = $thumbnail_medium;
                    $vid_play_url = "https://player.vimeo.com/video/".$imgid[count($imgid)-1];
                     //"https://player.vimeo.com/video/".$imgid[count($imgid)-1]."?h=8951e8b24c&title=0&byline=0&portrait=0";
                }else{
                    $vid_thumbnail = "http://i3.ytimg.com/vi/".$video_id."/hqdefault.jpg";  
                    $vid_play_url = "https://www.youtube.com/embed/".$video_id;   
                }
            ?>
              <div style="padding:56.25% 0 0 0;position:relative;">
                <iframe style="position: absolute; left: 0;right: 0;top: 0;bottom: 0;width: 100%;height: 100%;" width="100%" height="500" src="<?php echo $vid_play_url; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
              </div>
            <?php endif; $i++; endwhile; ?>
          </div>
          <?php if($count>1) {?>
            <div class="thumbnail-video">
              <?php while( have_rows('videos') ): the_row(); 
                $v_url = get_sub_field('video_url');
                $video_array = explode('https://youtu.be/', $v_url);
                $video_id = '$video_array[1]';
                $v_title = get_sub_field('video_title');
                $v_description = get_sub_field('video_description');  
                
                $thumbnail_medium = ""; $imgid = explode("/", get_sub_field('video_url'));
                if(strpos($v_url, "vimeo")){
                    $hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/".$imgid[count($imgid)-1].".php"));
                    $thumbnail_medium = $hash[0]['thumbnail_medium'];
                }                                  
                   $vid_thumbnail = ""; $vid_play_url = "";
                   if($thumbnail_medium != ""){
                     $vid_thumbnail = $thumbnail_medium;
                     $vid_play_url = "https://player.vimeo.com/video/".$imgid[count($imgid)-1]."?autoplay=1";
                         //"https://player.vimeo.com/video/".$imgid[count($imgid)-1]."?h=8951e8b24c&title=0&byline=0&portrait=0";
                   }else{
                     $vid_thumbnail = "http://i3.ytimg.com/vi/".$video_id."/hqdefault.jpg";  
                     $vid_play_url = "https://www.youtube.com/embed/".$video_id."?autoplay=1";   
                   }
                ?>
                <div class="item">
                  <div class="img"><a href="#" title="<?php echo $video_id; ?>" data-video="<?=$vid_play_url?>"><img src="<?php echo $vid_thumbnail; ?>" data-video="<?=$vid_play_url?>" class="img-fluid" alt="GenRocket - Test Data Management"></a></div>
                  <div class="text">
                    <h3><a href="#" title="<?php echo $video_id; ?>"><?php echo $v_title; ?></a></h3>
                    <p><?php echo $v_description; ?></p>
                  </div>
                </div>
              <?php endwhile; ?>
            </div> 
          <?php } ?>
        </div>
      <?php else: ?>
        <?php
        $youtube_url = get_field('article_video_url');
        $vimeo_url = get_field('vimeo_video');
        $vimeo_array = explode('https://vimeo.com/', $vimeo_url);
        ?>
        <?php if($youtube_url) {?>
          <div class="video mb-5"><iframe width="100%" height="500" src="<?php echo $youtube_url;?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
        <?php } elseif($vimeo_url) { $vimeoid = $vimeo_array[1];?>
          <div class="video mb-5"><div style="padding:56.25% 0 0 0;position:relative;"><iframe src="https://player.vimeo.com/video/<?php echo $vimeoid; ?>" style="position:absolute;top:0;left:0;width:100%;height:100%;" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe></div><script src="https://player.vimeo.com/api/player.js"></script></div>
        <?php }?>
      <?php endif; wp_reset_query(); ?>
    </div>
  </div>
  <?php /*<div class="block inner-page pb-0">
    <div class="container">
      <h2>Related Videos</h2>
      <div class="row mb-5">
        <?php
        $posts = array(
          'post_type' => 'flight-school',
          'post_status' => 'publish',
          'posts_per_page' => '-1',
          'order'=>'ASC',
          'orderby' => 'publish_date',
          'post__not_in' => array($post->ID),
          'tax_query' => array(array('taxonomy'=>'lessons-category','field'=>'id','terms' => $term->term_id))
        );
        $the_query = new WP_Query( $posts );
        if( $the_query->have_posts() ):
          while( $the_query->have_posts() ) : $the_query->the_post(); $count = 0; ?>
           <div class="col-lg-3 col-md-6 col-12 mb-4">
            <div style="position:relative; border: 1px solid #000; margin-bottom: 15px;">
             <?php  $video = get_field('article_video_url', $post->ID);  ?>
             <a href="<?php echo the_permalink(); ?>" rel="noopener noreferrer" target="_blank">
               <?php if($video) {?>
                 <?php 
                 $video_array = explode('/embed/', $video);
                 $video_id = '$video_array[1]';
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
        else:
          echo 'NO Data';
      endif; 
    

      wp_reset_query(); 
      ?>
    </div>
  </div>
</div> */?>
<div class="block bg-secondary py-4 mb-5">
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
<div class="container"> 
  <div class="btns d-flex justify-content-center align-items-center mb-4 pager-tabs">   <?php 
  if (false !== $previd ) {
    ?><a rel="prev" href="<?php echo get_permalink($previd) ?>"><img src="<?php bloginfo('template_url'); ?>/assets/images/left-arrow.svg" width="7px"> Previous</a><?php
  }?>
  <?php if($term_parent_name=='Software Tester'){?>
   <a href="https://www.genrocket.com/flight-school/<?php echo $term_parent_slug; ?>-<?php echo $sub_term_slug; ?>" class="btn btn-primary mx-3">Flight Plan</a>
  <?php } elseif($term_parent_name=='Data Architect'){?>
         <a href="https://www.genrocket.com/flight-school/<?php echo $sub_term_slug; ?>" class="btn btn-primary mx-3">Flight Plan</a>
       <?php } else{  ?>
   <a href="https://www.genrocket.com/flight-school/<?php echo $term_parent_slug; ?>" class="btn btn-primary mx-3">Flight Plan</a>
 <?php } ?>
 <?php 
 if (false !== $nextid ) {
  ?><a rel="next" href="<?php echo get_permalink($nextid) ?>">Next <img src="<?php bloginfo('template_url'); ?>/assets/images/right-arrow.svg" width="7px"></a><?php
}        
?>
</div>
</div>
<?php if(get_field('additional_editor')): ?>
  <div class="block inner-page pt-0 pb-2">
    <div class="container">
      <?php echo get_field('additional_editor');?>
    </div>
  </div> 
<?php endif; ?>
<div class="block inner-page pt-0">
  <div class="container">
    <h2 class="text-center">Related Assets</h2>
    <div class="inner-page literatures p-3">
      <div class="row">
        <div class="col-12 col-md-6 col-lg-4 post">
          <div class="inner p-3">
                <?php //$image = get_field('image_box'); 
                $title = get_field('title_box'); 
                $pdf = get_field('pdf_url'); 
                $altpdf = 'https://www.genrocket.com/download-literature/';
                ?>
                <img src="https://www.genrocket.com/wp-content/uploads/2021/04/pdf-img.jpg" alt="GenRocket - Test Data Management" />
                <?php if($title){?>
                  <h3 class="text-uppercase"><?php echo $title; ?></h3>
                <?php } else {?>
                 <h3 class="text-uppercase"> Download Literature</h3>
               <?php } ?>
               <?php if($pdf) {?>
                <a href="<?php echo $pdf; ?>" class="link" target="_blank">Download PDF</a>
              <?php } else {?>
                <a href="<?php echo $altpdf; ?>" class="link" target="_blank">View Literature</a>
              <?php }?>
            </div>
          </div>
          <div class="col-12 col-md-6 col-lg-4 post">
            <div class="inner p-3">
              <?php 
              $article_title = get_field('article_title'); 
              $article_text = get_field('article_text'); 
            //$article_image = get_field('article_image'); 
              $button = get_field('article_button'); 
              $altlink = 'https://www.genrocket.com/blog/';
              ?>
              <img src="https://www.genrocket.com/wp-content/uploads/2021/04/article-img.jpg" alt="GenRocket - Test Data Management" />
              <?php if($article_title){?>
                <h3 class="text-uppercase"><?php echo $article_title; ?></h3>
              <?php } else {?>
               <h3 class="text-uppercase">View Blog</h3>
             <?php } ?>
             <p><?php echo $article_text; ?></p>
             <?php if($button) {?>
              <a href="<?php echo $button; ?>" class="link"  target="_blank">Read More</a>
            <?php } else {?>
             <a href="<?php echo $altlink; ?>" class="link" target="_blank">Read More</a>
           <?php }?>
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
<?php } elseif($option == 'parent') {?>
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
              <li class="darkblue"><a href="https://www.genrocket.com/flight-school-welcome/">Welcome</a></li>
               <li class="orange"><a href="<?php the_permalink(6375); ?>">Orientation</a></li>
               <li class="gray"><a href="<?php the_permalink(6075); ?>">Organization Admin</a></li>
               <li class="lightgreen"><a href="#" style="pointer-events: none;">Data Architect</a>
                 <div class="megadrop">
                  <div class="col">
                    <h3><a href="<?php the_permalink(6590); ?>" class="text-dark">Test Data Project <br> Setup</a></h3>
                    <p style="display: block; margin-bottom: 20px;">The Data Architect Flight Plan courses are designed for users who will be importing or creating the Data Model within each GenRocket Project.</p>
                    <div class="btns d-flex justify-content-center"><a href="<?php the_permalink(6590); ?>" class="btn btn-primary mb-4 btn-sm">View Plan</a></div>
                  </div>
                  <div class="col">
                   <h3><a href="<?php the_permalink(6591); ?>" class="text-dark">Data Consistency Across <br> Projects</a></h3>
                    <p style="display: block; margin-bottom: 20px;">The Data Consistency Across Projects Flight Plan provides information about available GenRocket features for ensuring data consistency across Test Data Projects within an organization.</p>
                   <div class="btns d-flex justify-content-center"><a href="<?php the_permalink(6591); ?>" class="btn btn-primary mb-4 btn-sm">View Plan</a></div>
                  </div>
                  <div class="col">
                   <h3><a href="<?php the_permalink(6592); ?>" class="text-dark">Lifecycle <br> Management</a></h3>
                    <p style="display: block; margin-bottom: 20px;">The Lifecycle Management Flight Plan provides information on what lifecycle management features are available to users and how they can be used within the GenRocket web platform.</p>
                   <div class="btns d-flex justify-content-center"><a href="<?php the_permalink(6592); ?>" class="btn btn-primary mb-4 btn-sm">View Plan</a></div>
                  </div>
                </div>
              </li>
              <li class="yellow"><a href="#" style="pointer-events: none;">Software Tester</a>
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
                  <div class="col">
                   <h3><a href="https://www.genrocket.com/flight-school/software-tester-advance/" class="text-dark">Advance</a></h3>
                    <p style="display: block; margin-bottom: 20px;">In the advance Flight Path, Software Testers will learn intermediate GenRocket concepts including Linked Generators, Parent/Child/Sibling Relationships.</p>
                   <div class="btns d-flex justify-content-center"><a href="https://www.genrocket.com/flight-school/software-tester-advance/" class="btn btn-primary mb-4 btn-sm">View Plan</a></div>
                  </div>
                </div>
              </li>
               <li class="cerise"><a href="<?php the_permalink(6847); ?>">Specialty</a></li>
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
<?php } ?>
<?php get_footer(); ?>