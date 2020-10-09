<?
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
$request = $_SERVER['REQUEST_URI'];
$requestclean = strtok($request,"?");
$uri = explode('/', $requestclean);
date_default_timezone_set("America/New_York");
$now = date("h:i:sa");

require_once('views/head.php');

if ($uri[1] == 'receive-cache')
    require_once('views/receive_cache.php');
else if (!$uri[1])
    require_once('views/home.php');
else{
    require_once('views/main.php');
    if ($uri[1] == 'buy')
	require_once('views/stripe_checkout_onetime.php');
}

require_once('views/screen-reader.php');
require_once('views/json.php');
require_once('views/menu.php');
require_once('views/foot.php');
?>
