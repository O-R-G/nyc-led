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

<style>
* {
    margin: 0; 
    padding: 0;   
}
body {
    background: #FFF;    
}
canvas {
    display: block;
    /* specify width and height? */
}
div#mask {
    /* background-color: #FF0; */
    height: 25%;
    width: 75%;
}
</style>

<div id="mask">
    <div id="display">
        <canvas id="c"></canvas>
    </div>   
</div>   
    
<!--
<script>    
    text_marquee("<?= $msg ?>");
</script>
-->

<script src='/static/js/matrix.js'></script>

