<?

$data = json_decode(file_get_contents("php://input"), true); 
// $today = date('Y-m-d');
if( $data['cache_filename'] != '')
	$file_name = $data['cache_filename'].".json";
else
	$file_name = "test.json"; // supposedly a cache_name is always assigned


// path relative to receive_cache.php
$file = fopen('../static/data/' . $file_name, 'w') or die("can't create / open file");

fwrite($file, json_encode($data));
fclose($file);
