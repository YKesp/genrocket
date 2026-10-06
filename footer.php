<?php require get_template_directory() . '/inc/cookie-consent.php'; ?>
<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage genrocket
 * @since 1.0
 * @version 1.2
 */
?>
<style>
	div.wpforms-container-full .wpforms-form .wpforms-recaptcha-container {
	padding: 0 !important;
}
.cross-btn span{
	width: 20px;
  height: 20px;
  display: block;
  background: var(--dark);
  border-radius: 50%;
  color: #fff;
  text-align: center;
  line-height: 16px;
  font-size: 16px;
}
</style>
<?php $page_id = get_the_ID(); if($page_id != 45 && $page_id != 9540  && $page_id != 9573 && $page_id != 9612 && $page_id != 9951 && $page_id != 10027 && $page_id != 10060 && $page_id != 10065)
		{ ?>
<?php get_template_part( 'inc/demo-form' );
 } ?>

<?php
if(get_the_ID() != 4019 && get_the_ID() != 9540  && $page_id != 9573 && $page_id != 9612 && $page_id != 10027 && $page_id != 10060 && $page_id != 10065){
	?>
	<footer id="newfooter" class="no-print">
		<div class="upper-footer">
			<div class="container">
				<div class="row">
					<div class="col-6 col-md-3">
						<h3>Quick Links</h3>
						<nav>
							<?php
							if(has_nav_menu('top')){
								wp_nav_menu(array(
									'theme_location'  => 'footer-nav',
									'container'       => 'ul',
									'menu_class'      => '',
									'menu_id'         => '',
									'echo'            => true,
									'fallback_cb'     => 'wp_page_menu',
									'before'          => '',
									'after'           => '',
									'link_before'     => '',
									'link_after'      => '',
									'depth'           => 0
								));
							}
							?>
						</nav>
						<div class="logo">
							<a href="<?php echo site_url();?>"><img src="<?php bloginfo('template_url'); ?>/assets/images/GenRocket-logo-white.svg" alt="GenRocket - Test Data Management"></a>
						</div>
					</div>
					<div class="col-6 col-md-3">
						<h3>Contact Us</h3>
						<ul class="site-info">
							<li>
								<i class="icon-pin"></i>
								<address>GenRocket, Inc.<br> 2930 East Ojai Ave<br> Ojai, CA 93023<br> USA</address>
							</li>
							<li><i class="icon-telephone"></i><a href="tel:8058362879">(805) 836-2879</a></li>
							<li><i class="icon-mail"></i><a href="mailto:info@genrocket.com">info@genrocket.com</a></li>
						</ul>
						<div class="followus">
							<h3>Follow Us On</h3>
							<ul>
								<li><a href="https://www.facebook.com/GenRocket/" target="_blank"><i class="icon-facebook"><span class="d-none">facebook</span></i></a></li>
								<li><a href="https://twitter.com/genrocketinc" target="_blank"><i class="icon-twitter"><span class="d-none">Twitter</span></i></a></li>
								<li><a href="https://www.youtube.com/user/GenRocketINC" target="_blank"><i class="icon-youtube"><span class="d-none">Youtube</span></i></a></li>
								<li><a href="https://www.linkedin.com/company/genrocket" target="_blank"><i class="icon-linkedinn"><span class="d-none">linkedin</span></i></a></li>
							</ul>
						</div>
					</div>
					<div class="col-12 col-md-6 col-lg-5 offset-lg-1">
						<h3>Latest On Blog</h3>
						<div class="latestblog">
							<?php echo dynamic_sidebar( 'latest-posts' ); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="lower-footer">
			<div class="container">
				<p class="copyright">© <?php echo date("Y") ?> GenRocket, Inc. All rights reserved <span class="designedby">Designed By: <a href="http://www.espinspire.com/" target="_blank"><img src="<?php bloginfo('template_url'); ?>/assets/images/espinspire.png" alt="https://www.espinspire.com/"></a> </span></p>
			</div>
		</div>
	</footer>
	<div class="sticky-bar">
		<a href="#main" class="scrollTop" style="line-height: 62px;"><svg style="width:52px; height:52px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path fill="#fff" d="M256 0C114.6 0 0 114.6 0 256c0 141.4 114.6 256 256 256s256-114.6 256-256C512 114.6 397.4 0 256 0zM390.6 310.6c-12.5 12.5-32.75 12.5-45.25 0L256 221.3L166.6 310.6c-12.5 12.5-32.75 12.5-45.25 0s-12.5-32.75 0-45.25l112-112C239.6 147.1 247.8 144 256 144s16.38 3.125 22.62 9.375l112 112C403.1 277.9 403.1 298.1 390.6 310.6z"/></svg></a>
		<div class="subscribe-box">
			<a href="javascript:;" class="opener">
				<i class="fa fa-envelope-open" aria-hidden="true"></i>
				<span>Newsletter</span>
			</a>
			<div class="inner">
				<sup><i class="cross-btn" aria-hidden="true"><span>&times;</span></i></sup>
				<?php /* echo do_shortcode('[contact-form-7 id="341" title="Newsletter"]') */?>
				<?php echo do_shortcode( '[wpforms id="7863"]' ); ?>
			</div>
		</div>
		<a href="<?php echo esc_url(site_url()); ?>/demo-request/" title="Request Demo" class="request-demo">
			<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
			<span>Request Demo</span></a>
		</div>
	<?php } ?>
</div>
<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="video-popup" tabindex="-1" role="dialog" aria-labelledby="video" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<button style="z-index: 99;" type="button" class="close btnclose" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			<div class="modal-body p-0">
				<div style="padding:56.25% 0 0 0;position:relative;"> <iframe  style="position:absolute;top:0;left:0;width:100%;height:100%;" width="100%" height="400" src="" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
			</div>
		</div>
	</div>
</div>
<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="quiz-popup" tabindex="-1" role="dialog" aria-labelledby="video" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<button style="z-index: 99;" type="button" class="close btnclose" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			<div class="modal-body p-0 pricing-content">
				<div class="table-responsive">
		<table cellspacing="0" cellpadding="0" border="0" class="table overviewtable">
			<tbody>
				<tr>
					<td class="tableprehead" colspan="4">Leaderboard</td>
				</tr>
				<tr class="top-head">
					 <th title="#">#</th>
					<th title="Name">Name</th>
					<th title="Score" width="20%">Score</th>
					<th title="Finish In" width="20%">Finish In</th>
				</tr>
				<tr>
					<td title="#">1.</td>
					<td title="Name">Kay</td>
					<td title="Score">85%</td>
					<td title="Finish In">1.25 min</td>
				</tr>
				<tr>
					<td title="#">2.</td>
					<td title="Name">Kay</td>
					<td title="Score">85%</td>
					<td title="Finish In">1.25 min</td>
				</tr>
				<tr>
					<td title="#">3.</td>
					<td title="Name">Kay</td>
					<td title="Score">85%</td>
					<td title="Finish In">1.25 min</td>
				</tr>
			</tbody>
		</table>
	</div>
			</div>
		</div>
	</div>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="<?php bloginfo('template_url'); ?>/assets/js/jquery.main.js"></script>
<?php wp_footer(); ?>
<?php if(get_the_ID() != 4019 && get_the_ID() != 4963){ ?>
	<!-- New Chat Script 
	<script>
		window.fcSettings = {
			token: "aec746a8-64af-4b27-96cf-62b0ad5efcd9",
			host: "https://wchat.freshchat.com",
			siteId: "SITE_ID"
    // OPTIONAL: id unique to your site
};
</script> -->
<?php /*<script src="https://player.vimeo.com/api/player.js"></script> */ ?>
<script src="https://player.vimeo.com/api/player.js" integrity="sha384-fYgai7z8Tr2FqnmPbT+J2mR66tN6O0vGzHRvtszof8FM4X9PhmqYJuhwVjCK5JDl" crossorigin="anonymous"></script>
<script language="javascript" type="text/javascript">
	function buttonClick(){
		/*var url = document.getElementById("inputURL").value;
		var mainurl = 'https://genrocket.freshdesk.com/support/search/solutions?term=';
		var wholeurl = mainurl+url
    //window.location = wholeurl;
    window.open(wholeurl, "_blank")
    console_log(wholeurl);*/
}
function buttonClick2(){
	/*var url = document.getElementById("inputURL2").value;
	var mainurl = 'https://genrocket.freshdesk.com/support/search/solutions?term=';
	var wholeurl = mainurl+url
    //window.location = wholeurl;
    window.open(wholeurl, "_blank")
    console_log(wholeurl);*/
}
$(".thumbnail-video a").click(function(e){
	e.preventDefault();
		//as noted in addendum, check for querystring exitence
		/*var symbol = $(this).attr('title');
		var viemo_path = 'https://www.youtube.com/embed/';
		$('.large-video').find('iframe')[0].src = viemo_path + symbol + "?autoplay=1";*/
		var iframesourceurl = $(this).data('video');
		console.log('iframesourceurl -->> '+iframesourceurl)
		$('.large-video').find('iframe')[0].src = iframesourceurl;
	});
</script>
<script type="text/javascript">
	deleteAllCookies();
	function deleteAllCookies() {
		console.log('deleteAllCookies');
	    const cookies = document.cookie.split(";");

	    for (let i = 0; i < cookies.length; i++) {
	        const cookie = cookies[i];
	        const eqPos = cookie.indexOf("=");
	        const name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
	        document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT";
	    }
	}
</script>
<script language="javascript" type="text/javascript">
	$(document).ready(function(){
    // Autoplay and prevent suggestions for .btn-play1
    $(".btn-play1").click(function(e){
        e.preventDefault();
        
        // Get video URL from the 'title' attribute and add autoplay and rel=0 parameters
        var videoUrl = $(this).attr('title') + "?rel=0&autoplay=1";
        
        // Set iframe source and open modal
        $('#video-popup').find('iframe').attr("src", videoUrl);
        $('#video-popup').modal();

        console.log(videoUrl); // For debugging
    });

    // Autoplay and prevent suggestions for .btn-play2
    $(".btn-play2").click(function(e){
        e.preventDefault();
        
        // Get video URL from the 'title' attribute and add autoplay and rel=0 parameters
        var videoUrl = $(this).attr('title') + "?rel=0&autoplay=1";
        
        // Set iframe source and open modal
        $('#video-popup').find('iframe').attr("src", videoUrl);
        $('#video-popup').modal();

        console.log(videoUrl); // For debugging
    });

    // Remove the video URL when the modal is closed to stop playback
    $('#video-popup').on('hidden.bs.modal', function () {
        $(this).find('iframe').attr("src", "");
    });
});

	$(document).ready(function(){
		//use .one to ensure this only happens once
		$(".btn2-play").click(function(e){
			e.preventDefault();
			//as noted in addendum, check for querystring exitence
			var symbol = $(this).find('iframe')[0].src;
			$('#video-popup').find('iframe').attr("src", symbol + "?rel=0&autoplay=1");
			$('#video-popup').modal();
			console.log(symbol);
		});
	});
	$(function(){
		$('.btnclose').click(function(){      
			$("#video-popup iframe").attr("src", '');
			var frame_url = $("#video-popup iframe").attr("src", '');
			console.log(frame_url);
		});
		// $('#video-popup').click(function(){      
		// 	$("#video-popup iframe").attr("src", '');
		// 	var frame_url = $("#video-popup iframe").attr("src", '');
		// 	console.log(frame_url);
		// });
	});
</script>
<!-- Old Chat Script Now Disabled -->
<!--<script src="https://wchat.freshchat.com/js/widget.js" async></script>-->
<!-- <script>
    document.addEventListener( 'wpcf7mailsent', function( event ) {
        location = '<?php echo esc_url(site_url()); ?>/thank-you/';
    }, false );
</script> -->
<?php
}
?>
<script type="application/javascript">
	/*jQuery(window).on('load', function() {
		jQuery("#wrapper ~ div").css("display", "none");
		jQuery("#wpadminbar").css("display", "block");
		jQuery("#fc_frame").css("display", "block");
		jQuery(".grecaptcha-badge").parents('div').css("display", "block");
	})*/
</script>
<script type="text/javascript">
	$(function () {
		var hh = $('#newheader').height();
		$('.collapse').on('shown.bs.collapse', function(e) {
			var $card = $(this).closest('.card');
			$('html,body').animate({
				scrollTop: $card.offset().top-hh
			}, 500);
		});
		<?php
		$page_id = get_the_ID();
		if($page_id == 45 || $page_id == 6797 || $page_id == 65){
			$page_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			?>
			$("#wpcf7-f189-p45-o1 .wpcf7-submit").click(function(){ 
				return gtag_report_conversion('<? echo $page_link; ?>');
			});
			<?php
		}
		?>
	});
</script>
<script type="text/javascript">
	jQuery("#data1-link").click(function() {
		jQuery(".tabs-links li a").removeClass('active');
		jQuery(this).addClass('active');
		jQuery('.scroll-data').addClass('hide');
		jQuery('.data1').removeClass('hide');
		preventDefault();
	});
	jQuery("#data2-link").click(function() {
		jQuery(".tabs-links li a").removeClass('active');
		jQuery(this).addClass('active');
		jQuery('.scroll-data').addClass('hide');
		jQuery('.data2').removeClass('hide');
		preventDefault();
	});
	jQuery("#data3-link").click(function() {
		jQuery(".tabs-links li a").removeClass('active');
		jQuery(this).addClass('active');
		jQuery('.scroll-data').addClass('hide');
		jQuery('.data3').removeClass('hide');
		preventDefault();
	});
	jQuery("#data4-link").click(function() {
		jQuery(".tabs-links li a").removeClass('active');
		jQuery(this).addClass('active');
		jQuery('.scroll-data').addClass('hide');
		jQuery('.data4').removeClass('hide');
		preventDefault();
	});
</script>
<script>
	$(document).ready(function(){
		$(".btnVideo").click(function(){
			$("#video1")[0].src += "?end=216&rel=0&autoplay=1";
			$('#videobtn').addClass('pointer');
			$('#videobtn').fadeOut();
		      //alert('btnVideo');
		  });
		$("#videobtn").click(function(){
			$("#video1")[0].src += "?end=216&rel=0&autoplay=1";
			$(this).fadeOut();
			$(this).addClass('pointer');
		      //alert('videobtn');
		  });
	});
</script>
<script type="text/javascript">
	// $(function () {
	// 	$(window).scroll(function(){
	// 		var bpt = $('.benefits-block').position().top - 300;
	// 		var wpt = $(window).scrollTop();
	// 		if (wpt > bpt) {
	// 			$('.benefits-block').addClass('activeBlock');
	// 			console.log(bpt);
	// 		} else {
	// 			$('.benefits-block').removeClass('activeBlock');
	// 			console.log(bpt);
	// 		}
	// 	});
	// });
</script>
<script type="text/javascript">
	/*var email = jQuery('.wpforms-form').find('input[type="email"]');
		email.after('');	
		email.keyup(function() {
            var str = this.value;
                str = str.split('@')[1];
            var myarr = ['mail.com','yahoo.com','gmail.com','aol.com','hotmail.com','live.com','msn.com','.cn','.ru','.kr','.ua','.oo'];
           var arraycontains = (myarr.indexOf(str) > -1);
            if(arraycontains==true){
            	//email.after('');	
            	email.after('<label class="wpforms-error" style="display: inline-block !important;">This email address is not allowed.</label>');
            	// this.addClass("wpforms-error");
            	jQuery('#wpforms-submit-8749').prop('disabled', true);
            	return false;
            }else{
            	jQuery('#wpforms-submit-8749').prop('disabled', false);
            }
        });*/
    </script>
<!-- <script src="<?php //bloginfo('template_url'); ?>/assets/js/jquery.inview.min.js"></script>
	<script src="<?php //bloginfo('template_url'); ?>/assets/js/jquery.youtube-inview-autoplay.js"></script> -->
	<script>
		// Load the IFrame Player API code asynchronously.
		/*var tag = document.createElement('script');
		tag.src = "https://www.youtube.com/player_api";
		var firstScriptTag = document.getElementsByTagName('script')[0];
		firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
		function onYouTubeIframeAPIReady() {
			$('.youtube-video').inViewAutoplay({
				autohide: 1,
				modestbranding: 1,
				rel: 0,
				quality: 'hd720'
			});
		}*/
	</script>
	<script>
		$('#parent-partner-cat').on('change', function() {
			$( "#partner-submit" ).trigger('click');
		});
		$('#child-partner-cat').on('change', function() {
			$( "#partner-submit" ).trigger('click');
		});
 //  var home_url = '<?php //echo home_url()?>';
 //  var url = home_url+'/wp-admin/admin-ajax.php'
 //  var ajaxurl = url;
 //  $('#parent-partner-cat').on('change', function() {
 //   var catID = this.value;
 //   jQuery.ajax({
 //    type: 'POST',
 //    url: ajaxurl,
 //    data: {"action": "load-filter-subcat" ,"catID":catID },
 //    success: function(response) {
 //      jQuery("#child-partner-cat").html(response);
 //      console.log(response);
 //      jQuery("#child-partner-cat").attr("required","required");
 //     return false;
 //   }
 // });
 // });
</script>
</body>
</html>