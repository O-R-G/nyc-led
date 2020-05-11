<?
// check cache
$cache_dir = 'static/data/';
$cache_filenames = scandir($cache_dir);
$cache_mtime = array();
clearstatcache();
foreach($cache_filenames as $key => $name){
	if(substr($name[0], 0, 1) == '.'){
		unset($cache_filenames[$key]);
	}
	else{
		$this_mtime = filemtime( $cache_dir . $name );
		$cache_mtime[$name] = $this_mtime;
	}
	
}
$cache_filenames = array_values($cache_filenames);
// $now_timestamp = time();
?>
<script type = 'text/javascript'>
Date.prototype.addDays = function(days) {
    var date = new Date(this.valueOf());
    date.setDate(date.getDate() + days);
    return date;
}
var document_root = '<? echo $_SERVER["DOCUMENT_ROOT"] ?>';
var cache_filenames = <? echo json_encode($cache_filenames); ?>;
var cache_mtime = <? echo json_encode($cache_mtime); ?>;

// check if a data is already on cache, 
// if it is, stop requesting cache.
// but it will keep requesting live once the lifecycle is due.
var cache_status = {};
for (const p in cache_mtime){
	cache_status[p] = false;
}

function request_json(name, request_url, data_type, results_count = false, use_header = true, cache_lifecycle = false) {
    var json = '';
    var hasCache = ( cache_filenames.indexOf(name+'.'+data_type) != -1 ) ? true : false;
    var this_mtime = cache_mtime[name+'.'+data_type];
    var now_timestamp = new Date().getTime();
    now_timestamp = parseInt(now_timestamp/1000); // ms to s
    
    if(cache_lifecycle)
    	cache_lifecycle = cache_lifecycle * 60;

    if( (cache_lifecycle && now_timestamp - this_mtime > cache_lifecycle) || 
    	!cache_lifecycle || 
    	!hasCache){
    	// if has cache lifecycle and cache expired
    	// or cache lifecycle is not specified
    	// or cache doesn't exist
		// request live data
		request_live(name, request_url, data_type, results_count, use_header, hasCache, now_timestamp);

    }else{
    	// request 
    	request_cache(name, data_type, results_count);
    }
}

function request_live(name, request_url, data_type,results_count = false, use_header = true, hasCache, now_timestamp){
	var counter = 0;
	var counter_max = 3;
	
	if (window.XMLHttpRequest) { // Mozilla, Safari, IE7+ ...
	    var httpRequest = new XMLHttpRequest();
	} else if (window.ActiveXObject) { // IE 6 and older
	    var httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
	}
	httpRequest.onreadystatechange = function(){
		
		if (httpRequest.readyState === XMLHttpRequest.DONE) {
			
	      if (httpRequest.status === 200) {	
	      	if(counter > counter_max && hasCache){
	      		// console.log('requesting cache...');
	      		console.log('reaches maximum');
	      		request_cache(name, data_type, results_count);

	      	}
      		// if counter less than counter_max OR cache doesn't exist, keep fetching data
      		
      		if(data_type == 'json'){
      			var response = JSON.parse(httpRequest.responseText);
      		}else if(data_type == 'xml'){
      			var response = httpRequest.responseText;
      		}
      		if(response){
      			update_cache(name, response, data_type, now_timestamp); // updat
      			if(ready_now == 2){
      				timer = setInterval(update, timer_ms);
      			}
      			ready_now ++;
	        	handle_msgs(name, response, results_count); // static/js/msg.js
      		}
	      	counter++;
	      } else {
	      	if(hasCache){
	      		console.log('status !== 200, use cached file for '+name);
	      		request_cache(name, data_type, results_count);
	      	}else{
	      		console.log('please check the request url');
	      	}
	      }
	    }
	};
	httpRequest.open('GET', request_url);
	if(use_header)
		httpRequest.setRequestHeader('Content-Type', 'application/'+data_type);

	httpRequest.send();
}

function update_cache(cache_filename = '', response, data_type, now_timestamp){
	// console.log('update cache: sending json to server...');
	if (window.XMLHttpRequest) { // Mozilla, Safari, IE7+ ...
	    var xhr_update_cache = new XMLHttpRequest();
	} else if (window.ActiveXObject) { // IE 6 and older
	    var xhr_update_cache = new ActiveXObject("Microsoft.XMLHTTP");
	}

	xhr_update_cache.open( 'POST', 'views/receive_cache.php', true );
	// if(data_type == 'json'){
	// 	xhr_update_cache.setRequestHeader("Content-Type", "application/json");
	// 	response = JSON.stringify(response);
	// }else if(data_type == 'xml')
	// 	xhr_update_cache.setRequestHeader("Content-Type", "application/xml");
	xhr_update_cache.setRequestHeader("Content-Type", "application/"+data_type);
	// if(data_type == 'json')
	// 	response = JSON.stringify(response);
	var data = {
		"cache_filename": cache_filename, 
		"response": response, 
		"data_type": data_type
	};
	data = JSON.stringify(data);
	xhr_update_cache.send(data);
	cache_mtime[cache_filename+'.'+data_type] = now_timestamp;
}

function request_cache(cache_filename = '', data_type, results_count = false){
	// console.log('requesting cache for '+cache_filename);
	if(!cache_status[cache_filename]){
		if (window.XMLHttpRequest) { // Mozilla, Safari, IE7+ ...
		    var xhr_request_cache = new XMLHttpRequest();
		} else if (window.ActiveXObject) { // IE 6 and older
		    var xhr_request_cache = new ActiveXObject("Microsoft.XMLHTTP");
		}
		var req_url = 'static/data/'+cache_filename+'.'+data_type;
		// console.log(req_url);
		xhr_request_cache.onreadystatechange = function(){
			if (xhr_request_cache.readyState === XMLHttpRequest.DONE) {
		      if (xhr_request_cache.status === 200) {	
		      	var response = xhr_request_cache.responseText;
		      	// console.log(response);
		      	response = JSON.parse(response);
		      	if(ready_now == 2){
		      		timer = setInterval(update, timer_ms);
		      	}
		      	ready_now ++;
	        	handle_msgs(cache_filename, response, results_count);
	        	cache_status[cache_filename] = true;
		      }else if(xhr_request_cache.status === 404){
		      	return false;
		      }
		    }
		};
		xhr_request_cache.open( 'GET', req_url, true );
		xhr_request_cache.setRequestHeader("Content-Type", "application/"+data_type);
		xhr_request_cache.send();
	}
}

</script>



