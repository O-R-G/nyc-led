<?
$msg_beginning  = 'New York Consolidated . . . ';
$msg_ending  = ' 0 1 2 3 4 5 6 7 8 9 Have a nice day.';
$msg_array = array();
$children = $oo->children($uu->id);
foreach($children as $c)
    array_push($msg_array, " " . $c['name1']);

array_push($msg_array, ' currently ' . $output['wind_string']);
array_push($msg_array, ' /// Currently ' . $output['temp_f'] . ' degrees.');
array_push($msg_array, ' There are trains arriving at: ' . $output_train.".");
array_push($msg_array, ' ' . $output_jobs["job_agency"] . ' is hiring ' . $output_jobs["job_title"] . " at " . $output_jobs["job_division"] . ", " . $output_jobs["job_location"] . ".");
array_push($msg_array, ' ' . $output_permitted_event["event_name"] . ' will be happening from ' . $output_permitted_event["event_start_time"] . " until " . $output_permitted_event["event_end_time"] . ", at " . $output_permitted_event["event_location"] . ".");

shuffle($msg_array);

foreach($msg_array as $ma){
	$msg .= $ma;
}

// $msg = $msg_beginning . $msg . $msg_ending;

?>

<div id="mask">
    <div id="display">
    	<div class = "title_wrapper">
	    	<p class = "title"><span id = "letter_measure">N</span>EW</p>
	    	<div class = "scroller"></div>
	    </div>
		<div class = "title_wrapper">
			<p class = "title">YORK</p>
    		<div class = "scroller"></div>
    	</div>
    	<div class = "title_wrapper">
    		<p class = "title">CONSOLIDATED</p>
    		<div class = "scroller"></div>
    	</div>
    	
    </div>   
</div>   
<script>
</script>
<script src="./static/js/init.js"></script>
<script src="./static/js/marquee_matrix.js"></script>
<script>  
	var msg_array_php = <?php echo json_encode($msg_array); ?>;
    
	// var msg_array_php = ["a a a", "Hello, World!","This is a test string.","How are you?","I am a computer."];
    text_marquee(msg_array_php);
</script>