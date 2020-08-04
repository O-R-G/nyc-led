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

// query strings        ** dev **
$query_bg_color = $_GET['bg_color'];
$query_bg_color = ($query_bg_color == NULL) ? '#FFF' : '#' . $query_bg_color;
$query_bg_color = hex_to_rgb ( $query_bg_color );
$query_color = $_GET['color'];
$query_color = ($query_color == NULL) ? '#000' : '#' . $query_color;
$query_rows = $_GET['rows'];
$query_rows = ($query_rows == NULL) ? 2 : $query_rows;
$query_columns = $_GET['columns'];
$query_columns = ($query_columns == NULL) ? 21 : $query_columns;
$query_font = $_GET['font'];
$query_font = ($query_font == NULL) ? 'helveticaautospaced' : $query_font;
$query_font_size = $_GET['font_size'];
$query_font_size = ($query_font_size == NULL) ? '36' : $query_font_size;
function hex_to_rgb( $colour ) {
    if ( $colour[0] == '#' )
            $colour = substr( $colour, 1 );
    if ( strlen( $colour ) == 6 )
            list( $r, $g, $b ) = array( $colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5] );
    elseif ( strlen( $colour ) == 3 )
            list( $r, $g, $b ) = array( $colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2] );
    else
            return false;
    $r = hexdec( $r );
    $g = hexdec( $g );
    $b = hexdec( $b );
    return 'rgb(' . $r . ', ' . $g . ', ' . $b . ')';
}

$devhash = rand();  // to force .css reloads

$isHome = false;
if(!$uri[1])
    $isHome = true;
?><!DOCTYPE html>
<html lang='en'>
    <head>
        <title><? echo $title; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-title" content="nyc-led">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <link rel="apple-touch-icon" href="/media/png/apple-touch-icon.png" />
        <link rel="stylesheet" href="/static/css/relative10_pitch.css?<?= $devhash; ?>">
        <link rel="stylesheet" href="/static/css/helveticaocr.css?<?= $devhash; ?>">
        <link rel="stylesheet" href="/static/css/helveticaneuer.css?<?= $devhash; ?>">
        <link rel="stylesheet" href="/static/css/helveticaautospaced.css?<?= $devhash; ?>">
        <link rel="stylesheet" href="/static/css/nycon.css?<?= $devhash; ?>">
        <link rel="stylesheet" href="/static/css/main.css?<?= $devhash; ?>">    
        <script src="https://code.createjs.com/1.0.0/soundjs.min.js"></script>
    </head>
    <body>
    <script>
        // query strings -> js variables    ** dev **
        var query_bg_color = "<?= $query_bg_color; ?>";
        var query_color = "<?=$query_color; ?>";
        var query_rows = "<?= $query_rows; ?>";
        var query_columns = "<?= $query_columns; ?>";
        var query_font = "<?= $query_font; ?>";
        var query_font_size = "<?= $query_font_size; ?>";
        var isHome = <? echo json_encode($isHome); ?>;
    </script>
