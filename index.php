<?
$request = $_SERVER['REQUEST_URI'];
$requestclean = strtok($request,"?");
$uri = explode('/', $requestclean);

require_once('./views/head.php');  

// get time
date_default_timezone_set("America/New_York");
$now = date("h:i:sa");
    
// get temperature
require_once('./views/temp.php');
require_once('./views/train.php');
require_once('./views/jobs.php');
require_once('./views/permitted_event.php');

if (!$uri[1])
	require_once('views/home.php');
else 
	require_once('views/main.php');

require_once('views/foot.php');

?>