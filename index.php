<?
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');

$request = $_SERVER['REQUEST_URI'];
$requestclean = strtok($request,"?");
$uri = explode('/', $requestclean);

require_once('./views/head.php');  

// get time
date_default_timezone_set("America/New_York");
$now = date("h:i:sa");
    
// get temperature
if (end($uri) == 'receive_cache.php') {
	require_once('./views/receive_cache.php');
} else {
	require_once('views/msgs.php');
	if (!$uri[1]) {
		require_once('views/home.php');
		require_once('views/menu.php');
	} else {
		require_once('views/main.php');
		require_once('views/menu.php');
	}

	require_once('./views/json.php');
	require_once('./views/call_request_json.php');

	// require_once('./views/temp.php');
	// require_once('./views/nytimes.php');
	// require_once('./views/train.php');
	// require_once('./views/covidtracking.php');
	// require_once('./views/311.php');
	// require_once('./views/jobs.php');
	// require_once('./views/permitted_event.php');

	
}



require_once('views/foot.php');

?>
