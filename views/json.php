<?
?>
<script type = 'text/javascript'>
Date.prototype.addDays = function(days) {
    var date = new Date(this.valueOf());
    date.setDate(date.getDate() + days);
    return date;
}


function request_json_api(json_host, endpoint, argument, cache = false){
	if (cache) {
        var doc_root = "<? echo _SERVER["DOCUMENT_ROOT"]; ?>/";
        var json = json_cached_api_results(doc_root . '/static/data/' . endpoint . '/' . argument . '.json', json_host . '/' . endpoint . '/' . argument);
    } else {
        var json = request_json(json_host . '/' . endpoint . '/' . argument);
    }
    return json;
}

function request_json(endpoint) {
    var json = '';
    if (window.XMLHttpRequest) { // Mozilla, Safari, IE7+ ...
	    var httpRequest = new XMLHttpRequest();
	} else if (window.ActiveXObject) { // IE 6 and older
	    var httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
	}

	httpRequest.onreadystatechange = function(){
		if (httpRequest.readyState === XMLHttpRequest.DONE) {
	      if (httpRequest.status === 200) {	    
	      	console.log('httpRequest.status === 200');    
	        var response = JSON.parse(httpRequest.responseText);
	        send_json(response);
	        return response;
	      } else {
	        // alert('There was a problem with the request.');
	        console.log('There was a problem with the request.');
	      }
	    }
	};
	httpRequest.open('GET', endpoint);
	httpRequest.setRequestHeader('Content-Type', 'application/json');
	httpRequest.send();
}

function send_json(data){
	// var data = new FormData();
	// data.append("data" , "the_text_you_want_to_save");
	var xhr = (window.XMLHttpRequest) ? new XMLHttpRequest() : new activeXObject("Microsoft.XMLHTTP");
	xhr.open( 'post', '/static/data/receive_cache.php', true );
	xhr.send(data);
}

function build_json_date(date, days) {

    // drupal url format : YYYY-MM-DD
    // drupal url ranges : YYYY-MM-DD--YYYY-MM-DD

    var date_formatted = new Date(date);
    var date_end = new Date(date);
    var date_exploded = split("-", date_formatted);
    date = date_exploded[2] + '-' + date_exploded[1] + '-' + date_exploded[0];
    if (days > 0){
    	date_end.addDays(days)
        date += '--' + date_end;
        console.log(date, date_end);
    }
    return date;
}

function json_cached_api_results( cache_file = NULL, url = NULL, expires = NULL ) {
	global request_type, purge_cache, limit_reached, request_limit;

	if( !cache_file ) cache_file = dirname(__FILE__) . '/api-cache.json';
	if( !expires) expires = time() - 2*24*60*60;      // 2 days
	// if( !expires) expires = time() - 2*60*60;      // 2 hrs
	// if( !expires) expires = time() - 1*60*60;      // 1 hr
	// if( !expires) expires = time() - 10*60;        // 10 min
	// if( !expires) expires = time() - 2*60;         // 2 min (dev)
	// if( !expires) expires = time() - 1*60;         // 1 min (dev)

	if( !file_exists(cache_file) ) {

	    api_results = request_json(url);
		json_results = json_encode(api_results);

		// Remove cache file on error to avoid writing wrong xml
		if ( api_results && json_results )
			file_put_contents(cache_file, json_results);
		else
			unlink(cache_file);
    }

	// Check that the file is older than the expire time and that it's not empty
	if ( filectime(cache_file) < expires || file_get_contents(cache_file)  == '' || purge_cache && intval(_SESSION['views']) <= request_limit ) {
    if (!url) die ("Missing URL");
		// File is too old, refresh cache
		api_results = request_json(url);
		json_results = json_encode(api_results);

		// Remove cache file on error to avoid writing wrong xml
		if ( api_results && json_results )
			file_put_contents(cache_file, json_results);
		else
			unlink(cache_file);
	} else {
		// Check for the number of purge cache requests to avoid abuse
		if( intval(_SESSION['views']) >= request_limit )
			limit_reached = " <span class='error'>Request limit reached (request_limit). Please try purging the cache later.</span>";
		// Fetch cache
		json_results = file_get_contents(cache_file);
		request_type = 'JSON';
	}
	return json_decode(json_results);
}
</script>



