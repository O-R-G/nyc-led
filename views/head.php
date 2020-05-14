<?
// path to config file
$config = $_SERVER['DOCUMENT_ROOT']."/open-records-generator/config/config.php";
require_once($config);

// specific to this 'app'
$config_dir = $root."/config/";
require_once($config_dir."url.php");
require_once($config_dir."request.php");

require_once("lib/lib.php");

$db = db_connect("guest");

$oo = new Objects();
$mm = new Media();
$ww = new Wires();
$uu = new URL();
$rr = new Request();

// self
if($uu->id)
    $item = $oo->get($uu->id);
else
    $item = $oo->get(0);
$name = ltrim(strip_tags($item["name1"]), ".");

// document title
$item = $oo->get($uu->id);
$title = $item["name1"];
$site_name = "New York Consolidated";
if ($title)
    $title = $site_name." | ".strip_tags($title);
else
    $title = $site_name;

// query strings    ** dev **
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
$query_bg_color = hex_to_rgb ( $query_bg_color );
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

$devhash = rand();  // to force .css reloads

?><!DOCTYPE html>
<html>
    <head>
        <title><? echo $title; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-title" content="nyc-led">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <link rel="apple-touch-icon" href="/media/png/apple-touch-icon.png" />
        <link rel="stylesheet" href="/static/css/font-relative10_pitch.css?<?= $devhash; ?>">
        <link rel="stylesheet" href="/static/css/main.css?<?= $devhash; ?>">
        <link rel="stylesheet" href="/static/css/helveticaocr.css?<?= $devhash; ?>">
        <link rel="stylesheet" href="/static/css/helveticaautospaced.css?<?= $devhash; ?>">
        <script src="https://code.createjs.com/1.0.0/soundjs.min.js"></script>
        <!-- <script src = 'static/js/msgs.js'></script> -->
    </head>
    <body>
    <script>
        // query strings -> js variables
        // json_encode outputs quotes around each val in array[]
        // so no additional quotes here to pass as array to js
        // msgs_array = <?= json_encode($msgs_array); ?>;
        // needs to be invoked after document body loads
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
