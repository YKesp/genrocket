<?php
/**
 * Template Name: Ask an Expert */
get_header(); 
$HTTP_REFERER = isset($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : "";
$showPopUp = false;
//isset($HTTP_REFERER) && $HTTP_REFERER != "" && 
if(!strpos($HTTP_REFERER, "genrocket.com")){
	$showPopUp = false;
}
?>
<style type="text/css">
	.btn-close-custom{
		border-radius: 30px;
		padding: 0px 6px 5px !important;
		background-color: green !important;
		color: #fff;
		opacity: unset !important;
		outline: none;
	}
	.btn-close-custom:hover{
		color: #fff;
	}
    .modal-width{
        width: 100%;
        max-width:100%;
    }
	#myModal{
		top: 20% !important;
	}
    #myModal .modal-body{
    	text-align: center;
    }
    #myModal .read-more-link{
		font: 100 20px/27px 'Open Sans',sans-serif;
		width: 135px;
		text-align: center;
		padding: 5px 15px;
		background: #26aae1;
		border: 1px solid #26aae1 !important;
		color: #fff;
		transition: all .4s ease;
		margin-top: 15px;
		display: inline-block;
		display: block;
		margin: 15px auto 0;
    }
    .custom-link {
    	margin-top: 15px;
	    margin-bottom: 19px;
	    display: inline-block;
	    color: #212529;
	    font-weight: 600;
	    text-decoration: underline;
	}
	@media only screen and (min-width: 768px) { 
	    .modal-width{
	        width: 600px;
	        max-width:600px;
	    }
	}
	@media only screen and (max-width: 768px) {
		#myModal{
			top: 25% !important;
		}
		#myModal h2{
			font-size: 1.5rem !important;
		}
	}
</style>
<div class="banner support-banner <?php echo get_field('banner_class'); ?>">
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
<!-- contain main informative part of the site -->
<main id="main" role="main">
	<section class="contact-section">
		<div class="container support-text text-center">
					<?php
					//$page_content = get_post(get_the_ID());
					//echo $page_content->post_content;
					?>
				<h2>Ask an Expert</h2>
				<p>&nbsp;</p>
    			<div class="row">
    				<div class="col-12 col-lg-12">
                        <iframe src="https://genrocket.freshdesk.com/support/home" style="border:0px" width="100%" height="1500"></iframe>
    				</div>
    			</div>
			</div>
		</div>
	</section>
</main>
<style type="text/css">
    #launcher-frame{
        right: 10px !important;
        bottom: 10px !important;
    }
</style>
<script>
window.fwSettings={
'widget_id':19000000310
};
!function(){if("function"!=typeof window.FreshworksWidget){var n=function(){n.q.push(arguments)};n.q=[],window.FreshworksWidget=n}}() 
</script>
<script type='text/javascript' src='https://widget.freshworks.com/widgets/19000000310.js' async defer></script>
<div class="modal fade" id="myModal" role="dialog">
	<div class="modal-dialog modal-width">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-body">
			  <button type="button" class="close btn-close-custom" data-dismiss="modal"><span>&times;</span></button>
			    <h2>WOULD YOU LIKE TO<br>
			        SUBMIT A TICKET?</h2>
			  <img src="https://www.genrocket.com/wp-content/uploads/2020/11/pop-up-ask-an-expert.jpg" alt="GenRocket - Test Data Management">
			  <a href="/submit-a-trouble-ticket/" class="read-more-link">Yes Please!</a>
			  <a href="javascript:void(0)" data-dismiss="modal" class="custom-link">No, I want to ask an expert</a>
			</div>
		</div>      
	</div>
</div>
<?php if($showPopUp): ?>
<script>
    jQuery(document).ready(function(){
        jQuery("#myModal").modal('show');
    });
</script>
<?php endif; ?>
<?php get_footer(); ?>