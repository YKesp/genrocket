<div class="pricing-content">
<?php
global $wpdb;

genrocket_start_session();

$user_name  = $_SESSION['user_name'] ?? '';
$user_email = $_SESSION['user_email'] ?? '';

session_write_close();

//if((isset($_SESSION['user_name']) && !empty($_SESSION['user_name'])) && (isset($_SESSION['user_email']) && !empty($_SESSION['user_email']))){
if ( !empty($user_name) && !empty($user_email) ) {

$results1 = $wpdb->get_results( 'select * from wp_usertest order by formula_result desc', OBJECT );
if($wpdb->num_rows > 0){
	
	$count = 0; $show_user_result = true; $users_data = array();
	foreach($results1 as $result1){ $count = $count+1;
		//if((isset($_SESSION['user_name']) && $_SESSION['user_name'] == $result1->user_name) && (isset($_SESSION['user_email']) && $_SESSION['user_email'] == $result1->user_email) && $show_user_result){
		
		if (
                $user_name === $result1->user_name &&
                $user_email === $result1->user_email &&
                $show_user_result
            ) {
		
			$show_user_result = true;
			$timeTaken = isset($result1->total_time_spend) ? (int)$result1->total_time_spend : 0;
			$minutes = floor($timeTaken / 60);
			$seconds = $timeTaken % 60;
			
			$users_data[] = array('no'=>$count, 'name'=>$result1->user_name, 'result'=>$result1->result, 'spend_time'=>sprintf("%02d:%02d", $minutes, $seconds));
 		} 
	}
}
if(isset($users_data[count($users_data)-1]['no'])){
?>	
<div class="table-responsive">
<table cellspacing="0" cellpadding="0" border="0" class="table overviewtable">
<tbody>
<tr>
<td class="tableprehead" colspan="4">Your Result</td>
</tr>
<tr class="top-head">
<th title="#" width="20">#</th>
<th title="Name" width="">Name</th>
<th title="Score" width="20%">Score</th>
<th title="Finish In" width="20%">Finish In</th>
</tr>

<tr>
<td title="#" style="min-width:20px !important;font-size: 20px !important;font-weight: 700 !important;"><?php echo $users_data[count($users_data)-1]['no']; ?></td>
<td title="Name"><?php echo $users_data[count($users_data)-1]['name']; ?></td>
<td title="Score"><?php echo $users_data[count($users_data)-1]['result']; ?>%</td>
<td title="Finish In"><?php echo $users_data[count($users_data)-1]['spend_time']; ?></td>
</tr>
	
</tbody>
</table>
</div>
<?php } }
	
$results = $wpdb->get_results( 'select * from wp_usertest order by formula_result desc limit 0, 5', OBJECT );
if($wpdb->num_rows > 0){
	?>
	
<div class="table-responsive">
<table cellspacing="0" cellpadding="0" border="0" class="table overviewtable">
<tbody>
<tr>
<td class="tableprehead" colspan="4">Leaderboard</td>
</tr>
<tr class="top-head">
<th title="#" width="20">#</th>
<th title="Name" width="">Name</th>
<th title="Score" width="20%">Score</th>
<th title="Finish In" width="20%">Finish In</th>
</tr>

<?php 
	$count = 0;
	foreach($results as $result){ $count = $count+1;
		$timeTaken = isset($result->total_time_spend) ? (int)$result->total_time_spend : 0;
		$minutes = floor($timeTaken / 60);
		$seconds = $timeTaken % 60;
?>
<tr>
<td title="#" style="min-width:20px !important;font-size: 20px !important;font-weight: 700 !important;"><?php echo $count; ?></td>
<td title="Name"><?php echo $result->user_name; ?></td>
<td title="Score"><?php echo $result->result; ?>%</td>
<td title="Finish In"><?php echo sprintf("%02d:%02d", $minutes, $seconds); ?></td>
</tr>
<?php } ?>
	
</tbody>
</table>
</div>
</div>
<?php 
    
} 

if ( session_status() === PHP_SESSION_ACTIVE ) {
    session_write_close();
}


?>