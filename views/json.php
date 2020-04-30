<?
// check cache
$cache_dir = 'static/data/';
$cache_filenames = scandir($cache_dir);

?>
<script type = 'text/javascript'>
Date.prototype.addDays = function(days) {
    var date = new Date(this.valueOf());
    date.setDate(date.getDate() + days);
    return date;
}
var document_root = '<? echo $_SERVER["DOCUMENT_ROOT"] ?>';
var cache_filenames = <? echo json_encode($cache_filenames); ?>;
console.log(cache_filenames);

function request_json_api(request_url, endpoint, cache = false){
	if (cache) {
        var doc_root = "<? echo $_SERVER["DOCUMENT_ROOT"]; ?>/";
        var json = json_cached_api_results(doc_root + '/static/data/' + endpoint + '/' + argument + '.json', json_host + '/' + endpoint + '/' + argument);
    } else {
        var json = request_json(request_url);
    }
}

function request_json(request_url, cache_filename = '') {
	var counter = 0;
	var counter_max = 5;
    var json = '';
    var hasCache = ( cache_filenames.indexOf(cache_filename+'.json') != -1 ) ? true : false;
    console.log(hasCache);
    if (window.XMLHttpRequest) { // Mozilla, Safari, IE7+ ...
	    var httpRequest = new XMLHttpRequest();
	} else if (window.ActiveXObject) { // IE 6 and older
	    var httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
	}

	httpRequest.onreadystatechange = function(){
		if (httpRequest.readyState === XMLHttpRequest.DONE) {
	      if (httpRequest.status === 200) {	
	      	console.log('httpRequest.status === 200'); 
	      	if(counter > counter_max && hasCache){
	      		// request cache
	      		console.log('requesting cache...');
	      		output.push(hasCache);
	      	}else{
	      		// if counter less than counter_max OR cache doesn't exist
	      		var response = JSON.parse(httpRequest.responseText);
	      		if(response){
	      			update_cache(response, cache_filename); // update cache
		        	output.push(response); // add the result to output
	      		}
	      	}
	      	counter++;
	      	console.log(counter);
	      } else {
	        // request cache
	      }
	    }
	};
	httpRequest.open('GET', request_url);
	httpRequest.setRequestHeader('Content-Type', 'application/json');
	httpRequest.send();
}

function update_cache(response, cache_filename = ''){
	console.log('update cache: sending json to server...');

	if (window.XMLHttpRequest) { // Mozilla, Safari, IE7+ ...
	    var xhr_update_cache = new XMLHttpRequest();
	} else if (window.ActiveXObject) { // IE 6 and older
	    var xhr_update_cache = new ActiveXObject("Microsoft.XMLHTTP");
	}

	xhr_update_cache.open( 'POST', 'views/receive_cache.php', true );
	xhr_update_cache.setRequestHeader("Content-Type", "application/json");
	var data = response;
	data['cache_filename'] = cache_filename;
	data = JSON.stringify(data);
	xhr_update_cache.send(data);
}

function request_cache(cache_filename = ''){
	if (window.XMLHttpRequest) { // Mozilla, Safari, IE7+ ...
	    var xhr_request_cache = new XMLHttpRequest();
	} else if (window.ActiveXObject) { // IE 6 and older
	    var xhr_request_cache = new ActiveXObject("Microsoft.XMLHTTP");
	}
	var req_url = 'static/data/'+cache_filename+'.json';
	console.log(req_url);
	xhr_request_cache.onreadystatechange = function(){
		if (xhr_request_cache.readyState === XMLHttpRequest.DONE) {
	      if (xhr_request_cache.status === 200) {	
	      	var response = JSON.parse(xhr_request_cache.responseText);
        	return response;
	      }else if(xhr_request_cache.status === 404){
	      	return false;
	      }
	    }
	};
	xhr_request_cache.open( 'GET', req_url, true );
	xhr_request_cache.setRequestHeader("Content-Type", "application/json");
	xhr_request_cache.send();
}

</script>



