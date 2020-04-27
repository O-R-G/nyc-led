<?
// $msgs can be an array split on ' '
// or could be array of msgs split on '///' which are then
// split into 2d array [msgs][words]
// do in php or in js?


$msgs = [];
$break = '///';

// opening msg
$msgs[] = 'NEW YORK CONSOLIDATED';
$msgs[] = '                     ';

$msgs[] = '                     ';
$msgs[] = '                     ';

$msgs[] = 'Nueva York           ';
$msgs[] = 'Consolidada          ';

$msgs[] = '纽约合并                 ';
$msgs[] = '                     ';

$msgs[] = '      نيويورك الموحدة';
$msgs[] = '                     ';

$msgs[] = '...........hello?....';
$msgs[] = '....:)...............';

// msgs in between
// 4/23 Wei: Every group of msg is put in $msgs_temp first then added to $msgs_shuffle
// In other words, $msgs_shuffle = array of msg groups (nyt, covid, etc...)
// Then shuffle them, and add them back to $msgs.

$msgs_shuffle = [];

$msgs_temp = array();
$msgs_temp[] =  ' Currently ' . $output['temp_f'] . '°....' . $break;
$msgs_temp[] = ' Winds ' . $output['wind_string'] . $break;
$msgs_shuffle[] = $msgs_temp;

$msgs_temp = array();
$msgs_temp[] = ' There is a train arriving now : ' . $output_train."." . $break;
$msgs_shuffle[] = $msgs_temp;

$msgs_temp = array();
$msgs_temp[] = 'UNIQUE COPY CENTER   ';
$msgs_temp[] = '     No Thin Special ';
$msgs_temp[] = 'STORE for RENT call  ';
$msgs_temp[] = '(347) 680-3340 / / . ';
$msgs_temp[] = 'Tai Loong Landromat  ';
$msgs_temp[] = '> Work-in-Progress 合 ';
$msgs_shuffle[] = $msgs_temp;

$msgs_temp = array();
$msgs_temp[] = ' from the NYTimes : ' . $break;
for ($i=0; $i<5; $i++) {
    $msgs_temp[] = $output_nyt[$i] . $break;              // could be an array
}
$msgs_shuffle[] = $msgs_temp;

$msgs_temp = array();
$msgs_temp[] = ' from covidtracking.com : ' . $break;
foreach($output_covid as $oc)
    $msgs_temp[] = $oc . $break;
$msgs_shuffle[] = $msgs_temp;

shuffle($msgs_shuffle);
foreach ($msgs_shuffle as $m_shuffle) {
    foreach($m_shuffle as $ms)
        $msgs[] = $ms;
}

// ending msg
$msgs[]  = ' 0 1 2 3 4 5 6 7 8 9 Have a nice day.';

// other feeds, could use same syntax as above
// array_push($msg_array, ' ' . $output_jobs["job_agency"] . ' is hiring ' . $output_jobs["job_title"] . " at " . $output_jobs["job_division"] . ", " . $output_jobs["job_location"] . "." . $break);
// array_push($msg_array, ' ' . $output_permitted_event["event_name"] . ' will be happening from ' . $output_permitted_event["event_start_time"] . " until " . $output_permitted_event["event_end_time"] . ", at " . $output_permitted_event["event_location"] . "." . $break);
/*
// o-r-g
$children = $oo->children($uu->id);
foreach($children as $c)
    array_push($msg_array, " " . $c['name1']);
*/

// shuffle($msgs);

// for debug
// $msgs = $msg;                   // array
$msgs_array = $msgs;
// var_dump($msgs_array);
// var_dump(json_encode($msgs_array));

$msgs = implode($msgs, ' ');      // string

// added by Wei 4/20
// get query strings
$query_color_changing = $_GET['color_changing'];
if($query_color_changing == NULL)
    $query_color_changing = '#FF0';
else
    $query_color_changing = '#'.$query_color_changing;

$query_color_settled = $_GET['color_settled'];
if($query_color_settled == NULL)
    $query_color_settled = '#FF0';
else
    $query_color_settled = '#'.$query_color_settled;

$query_rows = $_GET['rows'];
if($query_rows == NULL)
    $query_rows = 4;

$query_columns = $_GET['columns'];
if($query_columns == NULL)
    $query_columns = 21;

$query_bg_color = $_GET['bg_color'];
if($query_bg_color == NULL)
    $query_bg_color = '#000';
else
    $query_bg_color = '#'.$query_bg_color;

$query_font = $_GET['font'];
if($query_font == NULL)
    $query_font = 'helveticaautospaced';

$query_font_size = $_GET['font_size'];
if($query_font_size == NULL)
    $query_font_size = '18';

function hex_to_rgb( $colour ) {
    if ( $colour[0] == '#' ) {
            $colour = substr( $colour, 1 );
    }
    if ( strlen( $colour ) == 6 ) {
            list( $r, $g, $b ) = array( $colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5] );
    } elseif ( strlen( $colour ) == 3 ) {
            list( $r, $g, $b ) = array( $colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2] );
    } else {
            return false;
    }
    $r = hexdec( $r );
    $g = hexdec( $g );
    $b = hexdec( $b );
    // return array( 'red' => $r, 'green' => $g, 'blue' => $b );
    return $r.', '.$g.', '.$b;
}

$query_bg_color = hex_to_rgb ( $query_bg_color );

?>

<style>
* {
    margin: 0; 
    padding: 0;   
}
body {
    /* background: #FFF;*/
}
#mask {
    /* height: 400px; */
    height: 100px;
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
    var msgs = '<?= $msgs; ?>';
    // json_encode outputs quotes around each val in array[]
    // so no additional quotes here to pass as array to js
    var msgs_array = <?= json_encode($msgs_array); ?>;

    // added by Wei 4/20
    // query strings -> js variables
    var query_color_changing = "<? echo $query_color_changing; ?>";
    var query_color_settled = "<? echo $query_color_settled; ?>";
    var query_rows = "<? echo $query_rows; ?>";
    var query_columns = "<? echo $query_columns; ?>";
    var query_bg_color = "<? echo $query_bg_color; ?>";
    var query_font = "<? echo $query_font; ?>";
    var query_font_size = "<? echo $query_font_size; ?>";

    var sBody = document.body;
    sBody.style.background = 'rgb('+query_bg_color+')';
</script>
<script src='/static/js/matrix.js'></script>
