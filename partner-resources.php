<?php /* Template Name: Partner Resources Template */ ?>
<?php get_header(); ?>
<?php 
$parent_term_id = $_GET['parent-partner-cat'];
$child_term_id = $_GET['child-partner-cat'];
?>
<style type="text/css">
	.page-id-7906 .carousel-indicators li {opacity: 1;}
	.page-id-7906 .carousel-indicators li a { text-decoration: none;}
	.page-id-7906 .partner-filter {padding: 15px 30px 5px;}
	.country-list li { color: black; }
	.inner-page ul li::after { display: none; }
	.carousel-indicators .btn-primary{background:#a6d540;border:1px solid #a6d540;}
	.page-id-7906 .carousel-indicators li{border: 0 !important;}
	#reset-pass-submit,
	#password-lost-form-wrap button[type="submit"]{
		width: 180px;
    max-width: 180px;
    height: 40px !important;
    border-radius: 0 !important;
    color: #fff !important;
    font-weight: 700;
    background: #a6d540 !important;
    border-color: #a6d540 !important;
    display: block !important;
    margin: 0 auto !important;
    padding: 0 15px;
	}
	<?php if(!is_user_logged_in() ){ ?>
		.carousel-control-prev {display:none !important;}
		.carousel-control-next {display:none !important;}
	<? } ?>
</style>
<div id="carousel-example-1z" class="carousel slide" data-ride="carousel">
  	<?/*?><ol class="carousel-indicators">
  		<?php if(have_rows('slider1')):
  			$count = 0;
  			while(have_rows('slider1')): the_row(); 
  				$slide_sub_heading = get_sub_field('slide_sub_heading'); 
  				$slide_description = get_sub_field('slide_description'); ?>
    			<li>
    				<a href="<?=get_sub_field('external_link')?>" target="_blank">
    				<?php if(!empty($slide_sub_heading)){ ?>
    					<h3><?php echo $slide_sub_heading; ?></h3>
    				<?php }
    				if(!empty($slide_description)){ ?>
    					<p><?php //echo substr($slide_description, 0, 30); 
    					echo $slide_description; ?></p>
    				<?php } ?>
                    </a>
    			</li>
    		<?php $count++;
    		endwhile;
    	endif; ?>
    	</ol><?*/?>
    	<?php if(!is_user_logged_in() ){ ?>
    		<div class="bnr-login">
    			<div class="carousel-inner" role="listbox">
    				<?php
    				$count = 1;
    				$slide_image = get_field('slide_banner_image', 7906);
    				$slide_caption = get_field('slide_banner_caption', 7906); 
    				?>
    				<div class="carousel-item <?php if($count == 1){echo 'active';} ?>">
    					<img class="d-block w-100" src="<?php echo $slide_image; ?>" alt="slide <?php echo $count; ?>">
    					<div class="caption">
    						<?php echo $slide_caption; ?>
    					</div>
    				</div>
    			</div>
    		</div>
    	<?php }else{ ?>
    		<div class="carousel-inner" role="listbox">
    			<?php if(have_rows('slider1')):
    				$count = 1;
    				while(have_rows('slider1')): the_row(); 
    					$slide_image = get_sub_field('slide_image');
    					$slide_caption = get_sub_field('slide_caption'); ?>
    					<div class="carousel-item <?php if($count == 1){echo 'active';} ?>">
    						<img class="d-block w-100" src="<?php echo $slide_image; ?>" alt="slide <?php echo $count; ?>">
    						<div class="caption">
    							<?php echo $slide_caption; ?>
    						</div>
    						<ol class="carousel-indicators">
    							<?php 
    							$slide_sub_heading = get_sub_field('slide_sub_heading'); 
    							$slide_description = get_sub_field('slide_description'); 
    							?>
    							<li>
    								<a href="#" target="_blank" class="btn btn-primary">
    									<?php if(!empty($slide_sub_heading)){ ?>
    										<?php echo $slide_sub_heading; ?>
		    				<?php } /*
		    				if(!empty($slide_description)){ ?>
		    					<p><?php //echo substr($slide_description, 0, 30); 
		    					echo $slide_description; ?></p>
		    				<?php } */?>
		    			</a>
		    		</li>
		    	</ol>
		    </div>
		    <?php $count++;
		  endwhile;
		endif; ?>
	</div>
<?php } ?>
<a class="carousel-control-prev d-none d-lg-flex" href="#carousel-example-1z" role="button" data-slide="prev">
	<span class="carousel-control-prev-icon" aria-hidden="true"></span>
	<span class="sr-only">Previous</span>
</a>
<a class="carousel-control-next d-none d-lg-flex" href="#carousel-example-1z" role="button" data-slide="next">
	<span class="carousel-control-next-icon" aria-hidden="true"></span>
	<span class="sr-only">Next</span>
</a>
</div>
<main id="main" class="p-0">
	<div class="block inner-page literatures">
		<div class="container">
			<?php if(!is_user_logged_in()){ ?>
				<div class="row justify-content-around">
					<div class="col-lg-5 col-12 mb-5 mb-lg-0">
						<div class="inner resource-type clearfix">
							<h2 class="text-uppercase title2 mb-xl-5 mb-3"><?php the_field('section1_heading'); ?></h2>
							<?php the_field('section1_content'); ?>
						</div>
					</div>
					<div class="col-lg-5 col-12">
						<div class="inner register-box">
							<div id="partner-login-form">
								<?php the_field('section2_login_content'); ?>
								<div class="pt-2">
									<?php //echo do_shortcode('[wp_login_form redirect="https://www.genrocket.com/partner-resources/"]'); ?>	
									<form name="loginform" id="loginform" action="<?php echo get_page_link(7906); ?>" method="post">   
										<div id="loginMsg">
											<div class="errorMsg" style="clear:both;padding-top:15px;display:none;">
												<div class="alert alert-danger">
													<span></span>
												</div>
											</div>    
											<div class="noticeMsg" style="clear:both;padding-top:15px;display:none;">
												<div class="alert alert-success">
													<span></span>
												</div>
											</div></div>
											<p class="login-username">
												<label for="user_login">Email Address</label>
												<input type="text" name="log" id="user_login" class="input" value="" size="20">
											</p>
											<p class="login-password">
												<label for="user_pass">Password</label>
												<input type="password" name="pwd" id="user_pass" class="input" value="" size="20">
											</p>
											<p class="login-remember"><label><input name="rememberme" type="checkbox" id="rememberme" value="forever"> Remember Me</label></p>
											<p class="login-submit">
												<input type="submit" name="wp-submit" id="wp-submit" class="button button-primary" value="Log In">
												<input type="hidden" name="redirect_to" value="https://www.genrocket.com/partner-resources/">
												<input type="hidden" name="action" value="clogin">                
											</p>
										</form>
									</div>
									<p class="mb-0">Don't have a login? <a href="#" id="partner-register-trigger">Register Here</a></p>
									<p>Forget Password <a href="#" id="partner-forget-trigger">Click Here</a></p>
								</div>
								<div id="partner-register-form" class="d-none">
									<?php the_field('section2_register_content'); ?>
									<?php //echo do_shortcode('[wpforms id="7751"]'); ?>
									<form id="wpforms-form-copy" class="wpforms-validate-copy wpforms-form-copy wpforms-ajax-form-copy" data-formid="7751" method="post" enctype="multipart/form-data" action="/partner-resources/" data-token="2cec4060ce241536fbfb48a221fc41b4" novalidate="novalidate">
										<noscript class="wpforms-error-noscript">
											Please enable JavaScript in your browser to complete this form.
										</noscript>
										<div id="loginMsg">
											<div class="errorMsg" style="clear:both;padding-top:15px;display:none;">
												<div class="alert alert-danger">
													<span></span>
												</div>
											</div>    
											<div class="noticeMsg" style="clear:both;padding-top:15px;display:none;">
												<div class="alert alert-success">
													<span></span>
												</div>
											</div></div>
											<div class="wpforms-field-container">
												<div id="wpforms-7751-field_3-container" class="wpforms-field wpforms-field-text" data-field-id="3">
													<label class="wpforms-field-label" for="wpforms-7751-field_3">Full Name <span class="wpforms-required-label">*</span></label>
													<input type="text" id="fullname" class="wpforms-field-large wpforms-field-required" name="fullname" required="">
												</div>
												<div id="wpforms-7751-field_5-container" class="wpforms-field wpforms-field-text" data-field-id="5">
													<label class="wpforms-field-label" for="wpforms-7751-field_5">Company <span class="wpforms-required-label">*</span></label>
													<input type="text" id="company" class="wpforms-field-large wpforms-field-required" name="company" required="">
												</div>
												<div id="wpforms-7751-field_6-container" class="wpforms-field wpforms-field-phone" data-field-id="6">
													<label class="wpforms-field-label" for="wpforms-7751-field_6">Phone <span class="wpforms-required-label">*</span></label>
													<div class="iti iti--allow-dropdown">
														<input type="text" id="phone-7751-field_6" class="wpforms-field-large wpforms-field-required" data-rule-smart-phone-field="true" name="phone" required="" autocomplete="off" style="padding-left: 12px !important;">
													</div>
												</div>
												<div id="wpforms-7751-field_1-container" class="wpforms-field wpforms-field-email" data-field-id="1">
													<label class="wpforms-field-label" for="wpforms-7751-field_1">Email <span class="wpforms-required-label">*</span></label>
													<input type="email" id="email" class="wpforms-field-large wpforms-field-required" name="email" required="">
												</div>
												<div id="wpforms-7751-field_4-container" class="wpforms-field wpforms-field-text" data-field-id="4">
													<label class="wpforms-field-label" for="wpforms-7751-field_4">Password <span class="wpforms-required-label">*</span></label>
													<input type="password" id="password" class="wpforms-field-large wpforms-field-required" name="password" required="">
												</div>
											</div>
											<div class="wpforms-submit-container">
												<p>&nbsp;</p>
												<div class="d-flex justify-content-between align-items-center">
													<button type="submit" name="wpforms[submit]" style="margin: 0 !important;" id="wpforms-submit-7751" class="wpforms-submit-copy btn btn-success m-0" data-alt-text="Sending..." data-submit-text="Submit Form" aria-live="assertive" value="wpforms-submit">Submit Form</button>
													<a href="/partner-resources" class="btn btn-light">Back</a>
												</div>
												<input type="hidden" name="redirect_to" value="https://www.genrocket.com/partner-resources/">
												<input type="hidden" name="action" value="cregister">  
											</div>
										</form>
									</div>
									<div id="partner-forget-form" class="d-none">
										<?php echo do_shortcode('[reset_password]'); ?>
										<p>Go to <a href="/partner-resources">Back</a> For Login</p>
									</div>
								</div>
							</div>
						</div>
					<?php } else {
						if ( have_posts() ) :
							while ( have_posts() ) : the_post();
								the_content();
							endwhile;
						endif; ?>
						<div class="partner-filter mb-5">
							<form method="get" action="<?php the_permalink(); ?>">
								<h3 class="mb-3 mb-md-0 text-center text-white">Partner Resources</h3>
								<h4 class="mb-3 mb-md-0">Filter By:</h4>
								<div class="d-md-flex justify-content-between">
									<div class="d-md-flex align-items-center">
										<div class="custom-select">
											<select name="parent-partner-cat" id="parent-partner-cat">
												<option value="">All Assets</option>
												<option value="">All Assets</option>
												<?php 
												$args = array(
													'orderby'    => 'date',
													'order'      => 'ASC',
													'hide_empty' => false,
													'parent' => 186,
												);
												$parent_terms = get_terms( 'partner-category', $args );
												foreach($parent_terms as $p){ ?>
													<option value="<?php echo $p->term_id; ?>" <?php if($parent_term_id == $p->term_id){echo 'selected="selected"';} ?>><?php echo $p->name; ?></option>
												<?php }
												?>
											</select>
										</div>
										<div class="custom-select">
											<select name="child-partner-cat" id="child-partner-cat">
												<option value="">All Industries</option>
												<option value="">All Industries</option>
												<?php 
												$args = array(
													'orderby'    => 'date',
													'order'      => 'ASC',
													'hide_empty' => false,
													'parent' => 197,
												);
												$child_terms = get_terms( 'partner-category', $args );
												foreach($child_terms as $c){ 
													if($c->parent != 0 ){ ?>
														<option value="<?php echo $c->term_id; ?>" <?php if($child_term_id == $c->term_id){echo 'selected="selected"';} ?>><?php echo $c->name; ?></option>
													<?php }
												}
												?>
											</select>
										</div>
									</div>
									<div class="search-form open">
										<a href="javascript:void(0)" class="serach-opner"><i class="fa fa-search"></i></a>
										<div class="field">
											<input placeholder="search" name="search-partner" class="input" type="search">
											<button type="submit" id="partner-submit"><i class="fa fa-search"></i></button>
										</div>
									</div>
								</div>
							</form>
						</div>
						<div class="row">
							<?php 
							$partner_search = $_GET['search-partner'];
							$tax_query = array( 'relation' => 'AND' );
							if(!empty($parent_term_id)){
								$tax_query[] = array(
									'taxonomy' => 'partner-category',
									'field'    => 'term_id',
									'terms'    => $parent_term_id,
								);
							}
							if(!empty($child_term_id)){
								$tax_query[] = array(
									'taxonomy' => 'partner-category',
									'field'    => 'term_id',
									'terms'    => $child_term_id,
								);
							}
							$post = array(
								'post_type' => 'partner-resource',
								'posts_per_page' => -1,
								'post_status' => 'publish',
								'orderby' => 'date',
								'order' => 'DESC',
								'tax_query' => $tax_query,
								's' => $partner_search,
							);
							$the_query = new WP_Query( $post );
							if( $the_query->have_posts() ):
								while( $the_query->have_posts() ) : $the_query->the_post(); 
									$image = get_field('featured_image');
									$assets = get_field('assets');
									$industries = get_field('industries');
									$heading = get_the_title();
									$post_title = get_field('post_title');
									$description = get_field('short_description');
									$external_link = get_field('exlink');
									$pdf = get_field('pdf_file');
									$extension = pathinfo($pdf, PATHINFO_EXTENSION);
									$video = get_field('video_link'); ?>
									<div class="col-12 col-md-6 col-lg-4 post">
										<div class="inner">
											<div class="image">
												<img src="<?php echo $image; ?>" class="img-fluid m-0 w-100" alt="">
												<h3><?php echo $post_title; ?></h3>
											</div>
											<div class="d-flex justify-content-between mb-3">
												<span><?php echo $assets; ?></span>
												<span><?php echo $industries; ?></span>
											</div>
											<h3><?php echo $heading; ?></h3>
											<p><?php echo $description; ?></p>
											<?php if(!empty($pdf)){ ?>
												<a href="<?php echo $pdf; ?>" class="link" download>Download <?=$extension=="pdf"?"PDF":"PPT"?></a>
											<?php } else if(!empty($video)){ ?>
												<a href="<?php echo $video; ?>" class="link" target="_blank">Watch Video</a>
											<?php } else if(!empty($external_link)){ ?>
												<a href="<?php echo $external_link; ?>" class="link" target="_blank">Read More</a>
											<?php } else { ?>
												<a href="<?php the_permalink(); ?>" class="link">Read More</a>
											<?php } ?>
										</div>
									</div>
								<?php endwhile; 
							else:
								echo '<div class="col-12 col-md-6 col-lg-4 post">no results found.</div>';
							endif; ?>
						</div>
					<?php } ?>
				</div>
			</main>
			<script>
				errorMsgDiv = function(formId, string) {
					$("#"+formId+" .errorMsg span").html(string);
					$("#"+formId+" .errorMsg").show();
					$("#"+formId+" .noticeMsg").hide();
	//setTimeout(function(){ $("#"+formId+" .errorMsg").hide(); }, 3000);
};
noticeMsgDiv = function(formId, string) {
	$("#"+formId+" .noticeMsg span").html(string);
	$("#"+formId+" .noticeMsg").show();
	$("#"+formId+" .errorMsg").hide();
	//setTimeout(function(){ $("#"+formId+" .noticeMsg").hide(); }, 3000);
};
jQuery(document).ready(function()
{
	$(document).on("submit", "#loginform", function(e) {
		e.preventDefault();
		var formId = "loginform";
		myForm = document.getElementById(formId);
		if(myForm.user_login.value == "")
		{
			errorMsgDiv(formId, "Please type Email Address!");
			myForm.user_login.focus()
			return false;
		}
		if(myForm.user_pass.value == "")
		{
			errorMsgDiv(formId, "Please type Password!");
			myForm.user_pass.focus()
			return false;
		}
		$.post("<?php echo get_page_link(7906); ?>", $("#loginform").serialize(),
			function(data){		
				if(data.status == 'OK') {                
			   //alert('You have successfully login!');
			   document.location.href = '<?php echo get_page_link(7906); ?>';
			 }else{
			 	errorMsgDiv("loginform", data.message);                
			 }	
			}, "json");
		return false; 
	});
	$(document).on("submit", "#wpforms-form-copy", function(e) {
		e.preventDefault();
		var formId = "wpforms-form-copy";
		myForm = document.getElementById(formId);
		phone = document.getElementById('phone-7751-field_6');
		if(myForm.fullname.value == "")
		{
			errorMsgDiv(formId, "Please type your Full Name!");
			myForm.fullname.focus()
			return false;
		}
		if(myForm.company.value == "")
		{
			errorMsgDiv(formId, "Please type Company!");
			myForm.company.focus()
			return false;
		}
		if(phone.value == "")
		{
			errorMsgDiv(formId, "Please type your Phone number!");
			phone.focus()
			return false;
		}
		if(myForm.email.value == "")
		{
			errorMsgDiv(formId, "Please type your Email!");
			myForm.email.focus()
			return false;
		}
		if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(myForm.email.value)))
		{	
			errorMsgDiv(formId, "Invalid Email! Please re-enter.");
			myForm.email.focus()
			return false;
		}
		if(myForm.password.value == "")
		{
			errorMsgDiv(formId, "Please type Password!");
			myForm.password.focus()
			return false;
		}
		$('#wpforms-submit-7751').prop('disabled', true);
		$.post("<?php echo get_page_link(7906); ?>", $("#wpforms-form-copy").serialize(),
			function(data){
				$('#wpforms-submit-7751').prop('disabled', false);
				if(data.status == 'OK') {                
			   //alert('You have successfully login!');
			   document.location.href = '<?php echo get_page_link(7906); ?>';
			 }else{
			 	errorMsgDiv("wpforms-form-copy", data.message);                
			 }	
			}, "json");
		return false;
	});
});
</script>
<script>
	window.onload = (event) => {
 	if(jQuery('#partner-forget-form .som-password-error-message').length) {
 	//alert();
 	jQuery("#partner-login-form").addClass("d-none");
			jQuery("#partner-register-form").addClass("d-none");
			jQuery("#partner-forget-form").removeClass("d-none");
			return false;
 }
};
	

	jQuery("#partner-register-trigger").on("click", function(){
			jQuery("#partner-login-form").addClass("d-none");
			jQuery("#partner-register-form").removeClass("d-none");
			return false;
		});

	jQuery("#partner-forget-trigger").on("click", function(){
		jQuery("#partner-login-form").addClass("d-none");
		jQuery("#partner-register-form").addClass("d-none");
		jQuery("#partner-forget-form").removeClass("d-none");
		return false;
	});
	jQuery(document).ready(function(){
		<?php if(isset($_GET["somresetpass"]) && $_GET["somresetpass"] == true){  ?>
			jQuery("#partner-login-form").addClass("d-none");
			jQuery("#partner-register-form").addClass("d-none");
			jQuery("#partner-forget-form").removeClass("d-none");
			return false;
			//alert();
		<?php } ?>
	});
</script>
<script type="text/javascript">
	var x, i, j, l, ll, selElmnt, a, b, c;
	/* Look for any elements with the class "custom-select": */
	x = document.getElementsByClassName("custom-select");
	l = x.length;
	for (i = 0; i < l; i++) {
		selElmnt = x[i].getElementsByTagName("select")[0];
		ll = selElmnt.length;
		/* For each element, create a new DIV that will act as the selected item: */
		a = document.createElement("DIV");
		a.setAttribute("class", "select-selected");
		a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
		x[i].appendChild(a);
		/* For each element, create a new DIV that will contain the option list: */
		b = document.createElement("DIV");
		b.setAttribute("class", "select-items select-hide");
		for (j = 1; j < ll; j++) {
    /* For each option in the original select element,
    create a new DIV that will act as an option item: */
    c = document.createElement("DIV");
    c.innerHTML = selElmnt.options[j].innerHTML;
    c.addEventListener("click", function(e) {
        /* When an item is clicked, update the original select box,
        and the selected item: */
        var y, i, k, s, h, sl, yl;
        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
        sl = s.length;
        h = this.parentNode.previousSibling;
        for (i = 0; i < sl; i++) {
        	if (s.options[i].innerHTML == this.innerHTML) {
        		s.selectedIndex = i;
        		h.innerHTML = this.innerHTML;
        		y = this.parentNode.getElementsByClassName("same-as-selected");
        		yl = y.length;
        		for (k = 0; k < yl; k++) {
        			y[k].removeAttribute("class");
        		}
        		this.setAttribute("class", "same-as-selected");
        		break;
        	}
        }
        h.click();
        $( "#partner-submit" ).trigger('click');
      });
    b.appendChild(c);
  }
  x[i].appendChild(b);
  a.addEventListener("click", function(e) {
    /* When the select box is clicked, close any other select boxes,
    and open/close the current select box: */
    e.stopPropagation();
    closeAllSelect(this);
    this.nextSibling.classList.toggle("select-hide");
    this.classList.toggle("select-arrow-active");
  });
}
function closeAllSelect(elmnt) {
  /* A function that will close all select boxes in the document,
  except the current select box: */
  var x, y, i, xl, yl, arrNo = [];
  x = document.getElementsByClassName("select-items");
  y = document.getElementsByClassName("select-selected");
  xl = x.length;
  yl = y.length;
  for (i = 0; i < yl; i++) {
  	if (elmnt == y[i]) {
  		arrNo.push(i)
  	} else {
  		y[i].classList.remove("select-arrow-active");
  	}
  }
  for (i = 0; i < xl; i++) {
  	if (arrNo.indexOf(i)) {
  		x[i].classList.add("select-hide");
  	}
  }
}
/* If the user clicks anywhere outside the select box,
then close all select boxes: */
document.addEventListener("click", closeAllSelect);
</script>
<?php get_footer(); ?>