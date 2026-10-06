<?php
/**
 * Template Name: flight welcome */
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
.btn-sm{
  padding: 5px 18px !important;
  line-height: 25px !important;
  border-radius: 30px;
  font-size: 16px !important;
  font-weight: 700;
  min-width: inherit !important;
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
      <main id="main">
        <section class="second_nav">
          <div class="container">
            <ul id="menu-products-submenu" class="w-100">
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
                    <h3><a href="https://www.genrocket.com/flight-school/software-tester-basic/" class="text-dark">Basic</a></h3>
                    <p style="display: block; margin-bottom: 20px;">In the Basic Flight Plan, Software Testers will learn essential GenRocket concepts and skills that are needed to generate test data by creating and running Scenarios</p>
                    <div class="btns d-flex justify-content-center"><a href="https://www.genrocket.com/flight-school/software-tester-basic/" class="btn btn-primary mb-4 btn-sm">View Plan</a></div>
                  </div>
                  <div class="col">
                   <h3><a href="https://www.genrocket.com/flight-school/software-tester-intermediate/" class="text-dark">Intermediate</a></h3>
                    <p style="display: block; margin-bottom: 20px;">In the Intermediate Flight Path, Software Testers will learn intermediate GenRocket concepts including Linked Generators, Parent/Child/Sibling Relationships, Generator Tagging, and Self Service Portal.</p>
                   <div class="btns d-flex justify-content-center"><a href="https://www.genrocket.com/flight-school/software-tester-intermediate/" class="btn btn-primary mb-4 btn-sm">View Plan</a></div>
                  </div>
                  <div class="col">
                   <h3><a href="https://www.genrocket.com/flight-school/software-tester-advance/" class="text-dark">Advanced</a></h3>
                    <p style="display: block; margin-bottom: 20px;">In the advanced flight plan, Software Testers will learn advanced GenRocket Concepts including performance testing, stories, epics, and working with databases.</p>
                   <div class="btns d-flex justify-content-center"><a href="https://www.genrocket.com/flight-school/software-tester-advance/" class="btn btn-primary mb-4 btn-sm">View Plan</a></div>
                  </div>
                </div>
              </li>
               <li class="cerise"><a href="<?php the_permalink(6847); ?>">Specialty</a></li>
            </ul>
          </div>
        </section>
        <div class="block inner-page">
          <div class="container">
            <?php if (have_posts()) : while (have_posts()) : the_post();?>
              <?php the_content(); ?>
            <?php endwhile; else : _e( 'Sorry, no content available.', 'textdomain' ); endif; wp_reset_query(); ?> 
            <?php /*
            <?php if( have_rows('videos') ): ?>
              <?php $count = count(get_field('videos')); ?>
              <div class="videos-box mb-5"> 
               <?php $vemo_id = get_sub_field('vimeo_id'); ?>
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
                      <div class="img"><a href="#" title="<?php echo $v_id; ?>"><img src="https://vumbnail.com/<?php echo $v_id; ?>.jpg" class="img-fluid" alt=""></a></div>
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
              
            <?php endif; ?>
            */?>

       <div class="block inner-page pb-0">
        <div class="container">
          <h2>Related Videos</h2>
          <div class="row mb-5 related-videos">
           <div class="col-lg-3 col-md-6 col-12 mb-4 videoBox">
            <a href="#" class="btn-play">                                                        
              <div style="position:relative; border: 1px solid #000; margin-bottom: 15px;">
                <img src="http://i3.ytimg.com/vi/7EpOKTwG7uI/hqdefault.jpg" style="width: 253px; height: 144px; object-fit: cover;" class="img-fluid w-100 mb-0" alt="GenRocket - Why Synthetic Data">
                <iframe src="https://player.vimeo.com/video/531378000?h=408578f976&title=0&byline=0&portrait=0" frameborder="0"></iframe>
              </div>
              <h5>Why Synthetic Data</h5>
            </a>
          </div>
          <div class="col-lg-3 col-md-6 col-12 mb-4 videoBox">
            <a href="#" class="btn-play">                                                      
              <div style="position:relative; border: 1px solid #000; margin-bottom: 15px;">
                <img src="http://i3.ytimg.com/vi/KbRtlfAkaWw/hqdefault.jpg" style="width: 253px; height: 144px; object-fit: cover;" class="img-fluid w-100 mb-0" alt="GenRocket - 5 Key Components">
                <iframe src="https://player.vimeo.com/video/531373803?h=6425582b46&title=0&byline=0&portrait=0" frameborder="0"></iframe>
              </div>
              <h5>5 Key Components</h5>
            </a>
          </div>
          <div class="col-lg-3 col-md-6 col-12 mb-4 videoBox">
            <a href="#" class="btn-play">                                                       
              <div style="position:relative; border: 1px solid #000; margin-bottom: 15px;">
                <img src="http://i3.ytimg.com/vi/fV2PhLgyWrw/hqdefault.jpg" style="width: 253px; height: 144px; object-fit: cover;" class="img-fluid w-100 mb-0" alt="GenRocket - 5 Self Service Components">
                <iframe src="https://player.vimeo.com/video/535306574?h=89d810ec4c&title=0&byline=0&portrait=0" frameborder="0"></iframe>
              </div>
              <h5>5 Self Service Components</h5>
            </a>
          </div>
          <div class="col-lg-3 col-md-6 col-12 mb-4 videoBox">
            <a href="#" class="btn-play">                                                  
              <div style="position:relative; border: 1px solid #000; margin-bottom: 15px;">
                <img src="http://i3.ytimg.com/vi/5Aju11PA90M/hqdefault.jpg" style="width: 253px; height: 144px; object-fit: cover;" class="img-fluid w-100 mb-0" alt="The GenRocket Ecosystem">
                <iframe src="https://player.vimeo.com/video/535282454?h=6dcade2a06&title=0&byline=0&portrait=0" frameborder="0"></iframe>
              </div>
              <h5>The GenRocket Ecosystem</h5>
            </a>
          </div>
          <div class="col-lg-3 col-md-6 col-12 mb-4 videoBox">
            <a href="#" class="btn-play">                                                       
              <div style="position:relative; border: 1px solid #000; margin-bottom: 15px;">
                <img src="http://i3.ytimg.com/vi/tso12Q_vfco/hqdefault.jpg" style="width: 253px; height: 144px; object-fit: cover;" class="img-fluid w-100 mb-0" alt="GenRocket Implementation">
                <iframe src="https://player.vimeo.com/video/535284130?h=2af2102498&title=0&byline=0&portrait=0" frameborder="0"></iframe>
              </div>
              <h5>GenRocket Implementation</h5>
            </a>
          </div>
          <div class="col-lg-3 col-md-6 col-12 mb-4 videoBox">
            <a href="#" class="btn-play">                                                       
              <div style="position:relative; border: 1px solid #000; margin-bottom: 15px;">
                <img src="http://i3.ytimg.com/vi/a58Jqdh3fF0/hqdefault.jpg" style="width: 253px; height: 144px; object-fit: cover;" class="img-fluid w-100 mb-0" alt="GenRocket - Return on Investment">
                <iframe src="https://player.vimeo.com/video/535310213?h=28392ebfcf&title=0&byline=0&portrait=0" frameborder="0"></iframe>
              </div>
              <h5>Return on Investment</h5>
            </a>
          </div>
          <div class="col-lg-3 col-md-6 col-12 mb-4 videoBox">
            <a href="#" class="btn-play">                                                       
              <div style="position:relative; border: 1px solid #000; margin-bottom: 15px;">
                <img src="http://i3.ytimg.com/vi/Cje2pd9YG1M/hqdefault.jpg" style="width: 253px; height: 144px; object-fit: cover;" class="img-fluid w-100 mb-0" alt="Working With GenRocket">
                <iframe src="https://player.vimeo.com/video/535367959?h=e0480d2807&title=0&byline=0&portrait=0" frameborder="0"></iframe>
              </div>
              <h5>Working With GenRocket</h5>
            </a>
          </div>
        </div>
      </div>
    </div>
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
    <?php if(get_field('additional_editor')): ?>
      <div class="block inner-page pt-0">
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
                <a href="<?php echo $pdf['url']; ?>" class="link" target="_blank">Download PDF</a>
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
              <a href="<?php echo $button['url']; ?>" class="link" target="_blank">Read More</a>
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
  <?php /*<section class="block"><div class="container">
<h2 class="text-center">Flight School</h2>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
<div id="accordion5" class="accordion-expand">
  <div class="card">
    <div class="card-header">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#data1" aria-expanded="true" aria-controls="data1">
          Data Architect
        </button>
      </h5>
    </div>
    <div id="data1" class="collapse show"  data-parent="#accordion5">
      <div class="card-body">
       <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
        <div class="btns">
          <a href="#" class="btn btn-block">Basic</a>
          <a href="#" class="btn btn-block">Intermediate</a>
          <a href="#" class="btn btn-block">Advanced</a>
        </div>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#data2" aria-expanded="false" aria-controls="data2">
        Test Data Engineer
        </button>
      </h5>
    </div>
    <div id="data2" class="collapse" data-parent="#accordion5">
      <div class="card-body">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
        <div class="btns">
          <a href="#" class="btn btn-block">Basic</a>
          <a href="#" class="btn btn-block">Intermediate</a>
          <a href="#" class="btn btn-block">Advanced</a>
        </div>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#data3" aria-expanded="false" aria-controls="data3">
          Software Tester
        </button>
      </h5>
    </div>
    <div id="data3" class="collapse" data-parent="#accordion5">
      <div class="card-body">
       <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
        <div class="btns">
          <a href="https://www.genrocket.com/basic-software-tester/" class="btn btn-block">Basic</a>
          <a href="#" class="btn btn-block">Intermediate</a>
          <a href="#" class="btn btn-block">Advanced</a>
        </div>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#data4" aria-expanded="false" aria-controls="data4">
          Test Data Manager
        </button>
      </h5>
    </div>
    <div id="data4" class="collapse" data-parent="#accordion5">
      <div class="card-body">
       <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
        <div class="btns">
          <a href="#" class="btn btn-block">Basic</a>
          <a href="#" class="btn btn-block">Intermediate</a>
          <a href="#" class="btn btn-block">Advanced</a>
        </div> 
      </div>
    </div>
  </div>
</div>
</div></section> */?>
</main>
<?php get_footer(); ?>