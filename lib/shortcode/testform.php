<?php
$questions = [
    1 => [
        "question" => "What is GenRocket's core differentiator in the synthetic data space?",
        "options"  => ["A" => " Speed of data processing", "B" => "Design-Driven Data platform", "C" => "Low-code test automation", "D" => "AI model hosting capabilities"],
        "answer"   => "B"
    ],
    2 => [
        "question" => "In the tax fraud detection case study, how long did it take to generate the final dataset after designing it?",
        "options"  => ["A" => "24 hours", "B" => "1 week", "C" => "Under 2 hours", "D" => "3 days"],
        "answer"   => "C"
    ],
    3 => [
        "question" => "What was the AI use case for the global bank mentioned in the deck?",
        "options"  => ["A" => "Credit scoring improvement", "B" => "Fraudulent transaction detection", "C" => "Bank check OCR training", "D" => "Loan default risk prediction"],
        "answer"   => "C"
    ],
    4 => [
        "question" => "Which types of checks were included in the synthetic data set for AI training?",
        "options"  => ["A" => "Valid and duplicate checks", "B" => "Blank and filled checks", "C" => "Good, bad, and edge case checks", "D" => "Canceled and processed checks"],
        "answer"   => "C"
    ],
    5 => [
        "question" => "What advantage did the law firm gain from using GenRocket’s platform for AI legal document generation?",
        "options"  => ["A" => "Reduced employee headcount", "B" => "Enhanced security, data quality, and scalability", "C" => "Elimination of legal fees", "D" => "Faster court settlements"],
        "answer"   => "B"
    ],
    6 => [
        "question" => "According to MIT Sloan, what percentage of AI performance is driven by data quality?",
        "options"  => ["A" => "50%", "B" => "65%", "C" => "80%", "D" => "95%"],
        "answer"   => "C"
    ],
    7 => [
        "question" => "McKinsey reports that 65–80% of AI project time is spent on which activity?",
        "options"  => ["A" => "Model deployment", "B" => "Data preparation", "C" => "Algorithm selection", "D" => "Bias mitigation"],
        "answer"   => "B"
    ],
    8 => [
        "question" => "Compared to traditional testing, how much more diverse data does AI typically require?",
        "options"  => ["A" => "10x", "B" => "100x", "C" => "1000x", "D" => "10,000x"],
        "answer"   => "C"
    ],
    9 => [
        "question" => "According to IBM, how much does bad data cost U.S. businesses annually?",
        "options"  => ["A" => "$1 trillion", "B" => "$2.1 trillion", "C" => "$3.1 trillion", "D" => "$5 trillion"],
        "answer"   => "C"
    ],
    10 => [
        "question" => "Which of the following is not listed as a pain point of real-world data?",
        "options"  => ["A" => "Delayed QA cycles", "B" => "Skyrocketing costs", "C" => "Compliance risks", "D" => "Enhanced edge-case coverage"],
        "answer"   => "D"
    ],
];
?>


<div id="stopwatch">Time Spent: 00:00</div>
<div class="wpforms-container wpforms-container-full" id="wpforms-11417">
<form id="wpforms2-form-123" class="wpforms-validate wpforms-form" method="post" enctype="multipart/form-data" action="">
<noscript class="wpforms-error-noscript">Please enable JavaScript in your browser to complete this form.</noscript><p></p>
<div class="wpforms-field-container">
 <?php foreach ($questions as $qNo => $qData): ?>
<div id="wpforms-11417-field_14-container" class="wpforms-field wpforms-field-radio" data-field-id="14"><label class="wpforms-field-label"> <?php echo "$qNo. " . $qData["question"]; ?></label><p></p>
<ul id="wpforms-11417-field_14" class="wpforms-field-required">
<?php $counter = 0; foreach ($qData["options"] as $key => $value):  $counter = $counter+1;?>
<li class="choice-1 depth-1"><input type="radio" id="wpforms-<?php echo $qNo; ?>_<?php echo $counter; ?>" name="q<?php echo $qNo; ?>" value="<?php echo $key; ?>"><label class="wpforms-field-label-inline" for="wpforms-<?php echo $qNo; ?>_<?php echo $counter; ?>"><?php echo "$key. $value"; ?></label></li>
<?php endforeach; ?>
</ul>
</div>
<?php endforeach; ?>
<p></p></div>
<p><!-- .wpforms-field-container --></p>
<div class="wpforms-recaptcha-container wpforms-is-recaptcha wpforms-is-recaptcha-type-v3"><input type="hidden" name="wpforms[recaptcha]" value=""></div>
<div class="wpforms2-submit-container"><button type="submit" name="submit" id="wpforms2-submit" class="wpforms2-submit btn btn-success" value="submit">SUBMIT</button>
            <input type="hidden" name="time_taken" id="time_taken" value="0">
            <input type="hidden" name="action" value="test_form_send_request">
            </div>
</form>


<script>
window.onload = function() {
    var secondsPassed = 0;
    var stopwatch = document.getElementById("stopwatch");
    var hiddenField = document.getElementById("time_taken");
    setInterval(function(){
        secondsPassed++;
        var minutes = Math.floor(secondsPassed / 60);
        var seconds = secondsPassed % 60;
        if (seconds < 10) seconds = "0" + seconds;
        if (minutes < 10) minutes = "0" + minutes;
        stopwatch.innerHTML = "Time Spent: " + minutes + ":" + seconds;
        hiddenField.value = secondsPassed;
    }, 1000);
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
                    window.location.href = 'https://www.genrocket.com/ai-quiz-thanks/';
                }
				$("#wpforms2-submit").prop("disabled", false).text("SUBMIT");
            } else {
                console.log('Error');
            }		
        },"json");
    });    
}
</script>

</div>