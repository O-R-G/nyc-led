<?
// $msg can be an array split on ' '
// or could be array of msgs split on '///' which are then
// split into 2d array [msgs][words]
// do in php or in js?

$msg = [];
$msg[0] = 'New York Consolidated ... ';

$break = '///';
$msg[] =  ' Currently ' . $output['temp_f'] . '°.' . $break;
$msg[] = ' Winds ' . $output['wind_string'] . $break;
$msg[] = ' There are trains arriving at: ' . $output_train."." . $break;
$msg[]  = ' 0 1 2 3 4 5 6 7 8 9 Have a nice day.';

// other feeds, could use same syntax as above
// array_push($msg_array, ' ' . $output_jobs["job_agency"] . ' is hiring ' . $output_jobs["job_title"] . " at " . $output_jobs["job_division"] . ", " . $output_jobs["job_location"] . "." . $break);
// array_push($msg_array, ' ' . $output_permitted_event["event_name"] . ' will be happening from ' . $output_permitted_event["event_start_time"] . " until " . $output_permitted_event["event_end_time"] . ", at " . $output_permitted_event["event_location"] . "." . $break);
/*
// o-r-g
$children = $oo->children($uu->id);
foreach($children as $c)
    array_push($msg_array, " " . $c['name1']);
*/

// shuffle($msg);

// for debug
// $msgs = $msg;                   // array
$msg = implode($msg, ' ');      // string
?>

<style>
* {
    margin: 0; 
    padding: 0;   
}
body {
    background: #FFF;    
}
#mask {
    height: 150px;
}
#display {
    text-align: center;
}
#c {
}
</style>

<div id="mask">
    <div id="display">
        <canvas id="c"></canvas>
    </div>   
</div>   
    
<script>
    var msg = "<?= $msg ?>";
    // var msgs = "<? print_r($msgs) ?>";
</script>

<script src='/static/js/matrix.js'></script>
