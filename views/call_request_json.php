<?
	// $msgs_opening = [];
	// // opening msg
	// $msgs_opening[] = 'NEW YORK CONSOLIDATED';
	// $msgs_opening[] = '                     ';

	// $msgs_opening[] = '                     ';
	// $msgs_opening[] = '                     ';

	// $msgs_opening[] = 'Nueva York           ';
	// $msgs_opening[] = 'Consolidada          ';

	// $msgs_opening[] = '纽约合并                 ';
	// $msgs_opening[] = '                     ';

	// $msgs_opening[] = '      نيويورك الموحدة';
	// $msgs_opening[] = '                     ';

	// $msgs_opening[] = '...........hello?....';
	// $msgs_opening[] = '....:)...............';
?>

<script type="text/javascript">
	// var req_array = [
	// 	{	
	// 		'name': 'new-york-times',
	// 		'req_url': 'https://api.nytimes.com/svc/news/v3/content/all/all.json?api-key=FJ5pNfQtwlkTP27jg62s2De8IM0Ozvjk', 
	//         'results_count': 3
	// 	},
	// 	{	
	// 		'name': 'covidtracking',
	// 		'req_url': 'https://covidtracking.com/api/v1/states/current.json', 
	//         'results_count': 2
	// 	},
	// ];

	// var ready_now = 0;
	// var ready_full = req_array.length;
	// var timer;

	// var msgs = [];
	// var msgs_array = [];

	// var msgs_opening = ''; 
 //    var msgs_mid = [];
 //    var msgs_ending = ' 0 1 2 3 4 5 6 7 8 9 Have a nice day.';

 //    var msgs_break = '///';

 //    // var msg = [];
 //    var letters = [];
	// var words = [];
	

    for(i = 0 ; i < req_array.length ; i++){
    	request_json(req_array[i]['name'], req_array[i]['req_url'], req_array[i]['results_count']);
    }
</script>
