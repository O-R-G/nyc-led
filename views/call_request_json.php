<?
?>

<script type="text/javascript">
function call_request_json(){
	console.log('call_request_json');
	now = new Date();
	now_hr = now.hour();
	now_min = now.minute();
    for(i = 0 ; i < req_array.length ; i++){
    	if(req_array[i]['name'] == 'train')
    		req_array[i]['req_url'] = "https://mtaapi.herokuapp.com/times?hour="+now_hr+"&minute="+now_min;
    	request_json(req_array[i]['name'], req_array[i]['req_url'], req_array[i]['data_type'], req_array[i]['results_count'], req_array[i]['use_header']);
    }
}
call_request_json();
// setInterval(call_request_json, 20000);

</script>
