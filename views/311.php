<?
$output_311 = array();
$token = 'LTyWtvrOoHffWyAwXcdEIQDup';
$req_url = 'https://data.cityofnewyork.us/resource/erm2-nwe9.json'."?$$app_token=".$token.'&unique_key=46067780';


// $results = file_get_contents($req_url, false, $context);
// $results_decoded = json_decode($results, true);
// var_dump($results_decoded);
// die();

?>
<script>
	var req_url = "https://data.cityofnewyork.us/resource/erm2-nwe9.json?$$app_token=LTyWtvrOoHffWyAwXcdEIQDup&$limit=2";
	if (window.XMLHttpRequest) { // Mozilla, Safari, IE7+ ...
	    httpRequest = new XMLHttpRequest();
	} else if (window.ActiveXObject) { // IE 6 and older
	    httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
	}

	httpRequest.onreadystatechange = displayresult;
	httpRequest.open('GET', req_url);
	httpRequest.setRequestHeader('Content-Type', 'application/json');
	httpRequest.send();
	function displayresult(){
		console.log('displayresult');
		if (httpRequest.readyState === XMLHttpRequest.DONE) {
	      if (httpRequest.status === 200) {	    
	      	console.log('httpRequest.status === 200');    
	        var response = JSON.parse(httpRequest.responseText);
	        var msgs_temp = msgs.join('');
	        var index = msgs_temp.indexOf(msgs_ending);
	        msgs_temp += msgs_temp.substring(0, index);
	        for(i = 0 ; i < response.length ; i++){
	        	var thisMsg = ' from '+response[i]['agency']+': ';
	        	thisMsg += response[i]['descriptor']+' is reported around '+response[i]['landmark']+' ';
	        	// msgs_array.push(thisMsg);
	        	msgs_temp += msgs_break+thisMsg.toUpperCase();
	        }
	        msgs_temp+= msgs_break + msgs_ending;
	        console.log(msgs_ending);
	        msgs = msgs_temp.split('');
	      } else {
	        // alert('There was a problem with the request.');
	        console.log('There was a problem with the request.');
	      }
	    }
	}
</script>