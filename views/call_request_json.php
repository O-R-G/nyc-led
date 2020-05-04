<?
?>

<script type="text/javascript">
function call_request_json(){
    for(i = 0 ; i < req_array.length ; i++){
    	request_json(req_array[i]['name'], req_array[i]['req_url'], req_array[i]['results_count']);
    }
}
call_request_json();
setInterval(call_request_json, 20000);

</script>
