<style type="text/css">
<p>body #wpforms-11378 {
		background-color:#ffffff ;border-width:1px ;border-color:#cecece ;
			border-style: solid;}</p>
<p>/* Styling for Tablets */
@media only screen and (max-width: 800px) and (min-width:481px) {</p>
<p>}</p>
<p>@media only screen and (max-width: 480px){</p>
<p>}
/*Option to add custom CSS */</p>
</style>

<div class="wpforms-container wpforms-container-full" id="wpforms2-11378">
<form id="wpforms2-form-123" class="wpforms2-validate wpforms-form" method="post" enctype="multipart/form-data" action=""><noscript class="wpforms-error-noscript">Please enable JavaScript in your browser to complete this form.</noscript><p></p>
<div class="wpforms-field-container">
<div id="wpforms-11378-field_1-container" class="wpforms-field wpforms-field-name" data-field-id="1"><label class="wpforms-field-label" for="wpforms-11378-field_1">Name <span class="wpforms-required-label">*</span></label><input type="text" id="wpforms-11378-field_1" class="wpforms-field-medium wpforms-field-required" name="name"></div>
<div id="wpforms-11378-field_2-container" class="wpforms-field wpforms-field-email" data-field-id="2"><label class="wpforms-field-label" for="wpforms-11378-field_2">Business Email <span class="wpforms-required-label">*</span></label><input type="email" id="wpforms-11378-field_2" class="wpforms-field-medium wpforms-field-required" name="email" spellcheck="false"></div>
</div>
<p><!-- .wpforms-field-container --></p>
<div class="wpforms-submit-container"><button type="submit" name="submit" id="wpforms2-submit" class="wpforms2-submit btn btn-success" value="submit">SUBMIT</button>
            <input type="hidden" name="action" value="usertest_form_send_request">    
            </div>
</form>
</div>

<script>
window.onload = function() {
    jQuery("#wpforms2-form-123").submit(function(e){
        e.preventDefault();
		$("#wpforms2-submit").prop("disabled", true).text("Please wait...");
        var form_data = $(this).serialize();
		$.post("<?php echo home_url(); ?>/wp-admin/admin-ajax.php", form_data, function(response){
            if (response) {
                if (response.success == false) {
                    alert(response.data.message);
                } else {
                    //console.log('Request completed');
                    window.location.href = 'https://www.genrocket.com/ai-quiz/';
                }
				$("#wpforms2-submit").prop("disabled", false).text("SUBMIT");
            } else {
                console.log('Error');
            }		
        },"json");
    });    
}
</script>