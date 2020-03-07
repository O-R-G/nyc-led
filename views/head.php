<?
// path to config file
$config = $_SERVER['DOCUMENT_ROOT']."/open-records-generator/config/config.php";
require_once($config);

// specific to this 'app'
$config_dir = $root."/config/";
// require_once($config_dir."url.php");
// require_once($config_dir."request.php");

// require_once("lib/lib.php");

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

?><!DOCTYPE html>
<html>
    <head>
        <title>New York Consolidated</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-title" content="nyc-led">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <link rel="apple-touch-icon" href="./media/png/apple-touch-icon.png" />
        <link rel="stylesheet" href="./static/css/font-relative10_pitch.css">
        <link rel="stylesheet" href="./static/css/main.css">
    </head>
    <body>
