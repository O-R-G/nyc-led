<?
// docket.php
$json_host = 'https://www.ica.art';
if ((!$days) && (!$uri[1])) $days = 28;
$json_films = request_json_api($json_host, 'json-films', build_json_date($date, $days), $cache);
// $cache = true | false;
// json.php
function request_json_api($json_host, $endpoint, $argument, $cache) {
    if ($cache) {
        $doc_root = $_SERVER["DOCUMENT_ROOT"]."/";
        $json = json_cached_api_results($doc_root . '/static/data/' . $endpoint . '/' . $argument . '.json', $json_host . '/' . $endpoint . '/' . $argument);
    } else {
        $json = request_json($json_host . '/' . $endpoint . '/' . $argument);
    }
    return $json;
}

function request_json($endpoint) {
    $arrContextOptions=array(
        "ssl"=>array(
            "verify_peer"=>false,
            "verify_peer_name"=>false,
        ),
    );
    $data = @file_get_contents($endpoint, false, stream_context_create($arrContextOptions));
    $json = json_decode($data);
    return $json;
}

function build_json_date($date, $days) {

    // drupal url format : YYYY-MM-DD
    // drupal url ranges : YYYY-MM-DD--YYYY-MM-DD

    $date_formatted = date('d-m-Y', strtotime($date));
    $date_exploded = explode("-", $date_formatted);
    $date = $date_exploded[2] . '-' . $date_exploded[1] . '-' . $date_exploded[0];
    if ($days > 0)
        $date .= '--' . date('Y-m-d', strtotime($date . ' +' . $days . ' days'));
    return $date;
}

function json_cached_api_results( $cache_file = NULL, $url = NULL, $expires = NULL ) {
	global $request_type, $purge_cache, $limit_reached, $request_limit;

	if( !$cache_file ) $cache_file = dirname(__FILE__) . '/api-cache.json';
	if( !$expires) $expires = time() - 2*24*60*60;      // 2 days
	// if( !$expires) $expires = time() - 2*60*60;      // 2 hrs
	// if( !$expires) $expires = time() - 1*60*60;      // 1 hr
	// if( !$expires) $expires = time() - 10*60;        // 10 min
	// if( !$expires) $expires = time() - 2*60;         // 2 min (dev)
	// if( !$expires) $expires = time() - 1*60;         // 1 min (dev)

	if( !file_exists($cache_file) ) {

	    $api_results = request_json($url);
		$json_results = json_encode($api_results);

		// Remove cache file on error to avoid writing wrong xml
		if ( $api_results && $json_results )
			file_put_contents($cache_file, $json_results);
		else
			unlink($cache_file);
    }

	// Check that the file is older than the expire time and that it's not empty
	if ( filectime($cache_file) < $expires || file_get_contents($cache_file)  == '' || $purge_cache && intval($_SESSION['views']) <= $request_limit ) {
    if (!$url) die ("Missing URL");
		// File is too old, refresh cache
		$api_results = request_json($url);
		$json_results = json_encode($api_results);

		// Remove cache file on error to avoid writing wrong xml
		if ( $api_results && $json_results )
			file_put_contents($cache_file, $json_results);
		else
			unlink($cache_file);
	} else {
		// Check for the number of purge cache requests to avoid abuse
		if( intval($_SESSION['views']) >= $request_limit )
			$limit_reached = " <span class='error'>Request limit reached ($request_limit). Please try purging the cache later.</span>";
		// Fetch cache
		$json_results = file_get_contents($cache_file);
		$request_type = 'JSON';
	}
	return json_decode($json_results);
}