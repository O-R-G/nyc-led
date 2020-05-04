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

function request_json(name = '', request_url, data_type,results_count = false) {
	var counter = 0;
	var counter_max = 5;
    var json = '';
    var hasCache = ( cache_filenames.indexOf(name+'.'+data_type) != -1 ) ? true : false;
    if (window.XMLHttpRequest) { // Mozilla, Safari, IE7+ ...
	    var httpRequest = new XMLHttpRequest();
	} else if (window.ActiveXObject) { // IE 6 and older
	    var httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
	}

	httpRequest.onreadystatechange = function(){
		if (httpRequest.readyState === XMLHttpRequest.DONE) {
	      if (httpRequest.status === 200) {	
	      	if(counter > counter_max && hasCache){
	      		// request cache
	      		// console.log('requesting cache...');
	      		var response = request_cache(name, data_type);
	      		handle_msgs(name, response, results_count); // static/js/msg.js
	      	}else{
	      		// if counter less than counter_max OR cache doesn't exist, keep fetching data
	      		if(data_type == 'json'){
	      			var response = JSON.parse(httpRequest.responseText);
	      		}else if(data_type == 'xml'){
	      			var response = httpRequest.responseText;
	      		}
	      		if(response){
	      			update_cache(name, response, data_type); // update cache
	      			if(ready_now == 0)
	      				timer = setInterval(update, timer_ms);
	      			ready_now ++;
		        	handle_msgs(name, response, results_count); // static/js/msg.js
	      		}
	      		
	      	}
	      	counter++;
	      } else {
	        console.log('please check the request url');
	      }
	    }
	};
	httpRequest.open('GET', request_url);
	if(data_type == 'json' && name != 'train')
		httpRequest.setRequestHeader('Content-Type', 'application/json');

	httpRequest.send();
}

function update_cache(cache_filename = '', response, data_type){
	console.log('update cache: sending json to server...');

	if (window.XMLHttpRequest) { // Mozilla, Safari, IE7+ ...
	    var xhr_update_cache = new XMLHttpRequest();
	} else if (window.ActiveXObject) { // IE 6 and older
	    var xhr_update_cache = new ActiveXObject("Microsoft.XMLHTTP");
	}

	xhr_update_cache.open( 'POST', 'views/receive_cache.php', true );
	if(data_type == 'json'){
		xhr_update_cache.setRequestHeader("Content-Type", "application/json");
		response = JSON.stringify(response);
	}else if(data_type == 'xml')
		xhr_update_cache.setRequestHeader("Content-Type", "application/xml");
	var data = {
		"cache_filename": cache_filename, 
		"response": response, 
		"data_type": data_type
	};
	data = JSON.stringify(data);
	xhr_update_cache.send(data);
}

function request_cache(cache_filename = '', data_type){
	if (window.XMLHttpRequest) { // Mozilla, Safari, IE7+ ...
	    var xhr_request_cache = new XMLHttpRequest();
	} else if (window.ActiveXObject) { // IE 6 and older
	    var xhr_request_cache = new ActiveXObject("Microsoft.XMLHTTP");
	}
	var req_url = 'static/data/'+cache_filename+'.'+data_type;
	xhr_request_cache.onreadystatechange = function(){
		if (xhr_request_cache.readyState === XMLHttpRequest.DONE) {
	      if (xhr_request_cache.status === 200) {	
	      	var response = JSON.parse(xhr_request_cache.responseText);
	      	if(ready_now == 1){
	      		// fire the display first
	      		console.log('fire');
	      		timer = setInterval(update, timer_ms);
	      	}
	      	ready_now ++;
        	return response;
	      }else if(xhr_request_cache.status === 404){
	      	return false;
	      }
	    }
	};
	xhr_request_cache.open( 'GET', req_url, true );
	if(data_type == 'json')
		xhr_request_cache.setRequestHeader("Content-Type", "application/json");
	else if(data_type == 'xml')
		xhr_request_cache.setRequestHeader("Content-Type", "application/xml");
	xhr_request_cache.send();
}

</script>



