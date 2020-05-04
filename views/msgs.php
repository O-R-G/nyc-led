<?
	$msgs_opening = [];
	// opening msg
	$msgs_opening[] = 'NEW YORK CONSOLIDATED';
	$msgs_opening[] = '                     ';

	$msgs_opening[] = '                     ';
	$msgs_opening[] = '                     ';

	$msgs_opening[] = 'Nueva York           ';
	$msgs_opening[] = 'Consolidada          ';

	$msgs_opening[] = '纽约合并                 ';
	$msgs_opening[] = '                     ';

	$msgs_opening[] = '      نيويورك الموحدة';
	$msgs_opening[] = '                     ';

	$msgs_opening[] = '...........hello?....';
	$msgs_opening[] = '....:)...............';

?>
<script type="text/javascript">
var req_array = [
	{	
		'name': 'new-york-times',
		'req_url': 'https://api.nytimes.com/svc/news/v3/content/all/all.json?api-key=FJ5pNfQtwlkTP27jg62s2De8IM0Ozvjk', 
        'results_count': 3
	},
	{	
		'name': 'covidtracking',
		'req_url': 'https://covidtracking.com/api/v1/states/current.json', 
        'results_count': ''
	},
];

var ready_now = 0;
var ready_full = req_array.length;
var timer;

var msgs = [];
var msgs_array = [];

var msgs_opening = "<?= implode($msgs_opening, ' ') ?>"; 

var msgs_mid = [];
var msgs_ending = ' 0 1 2 3 4 5 6 7 8 9 Have a nice day.';

var msgs_break = '///';

var msg = [];
var letters = [];
var words = [];

function handle_msgs(name, response, results_count = false){
	if(results_count == '')
		results_count = false;

	var response = response;
	console.log(results_count);
	// opening msg for each section;
	if(name == 'new-york-times'){
		var this_msgs = [' from the NYTimes : ' + msgs_break ];
		response = response['results'];
	}else if(name == 'covidtracking'){
		var this_msgs = [' from covidtracking.com : ' + msgs_break];
		for(i = 0 ; i < response.length ; i++){
			if(response[i]['state'] == 'NY'){
				console.log(response[i]);
				response = response[i];
				break;
			}
		}
	}else{
		var this_msgs = [ ];
	}

	if(results_count){
		if(name == 'new-york-times'){
			for(i = 0 ; i < results_count ; i++){
				var this_msg = response[i]['title'];
				if(typeof this_msg != 'undefined')
					this_msgs.push(this_msg);
			}
		}
	}else{
		if(name == 'covidtracking'){
			this_msgs.push('Positive cases: '+response['positive']);
			this_msgs.push('Negative cases: '+response['negative']);
			this_msgs.push('Currently hospitalized cases: '+response['hospitalizedCurrently']);
		}
		
	}
	msgs_mid.push(this_msgs);
	console.log(this_msgs);
	update_msgs();
}

function shuffle(array) {
  array.sort(() => Math.random() - 0.5);
}

function update_msgs(){
	shuffle(msgs_mid);

	msgs = [msgs_opening];

	for(i = 0 ; i < msgs_mid.length ; i++){
		for(j = 0 ; j < msgs_mid[i].length ; j++)
			msgs.push(msgs_mid[i][j]);
	}

	msgs.push(msgs_ending);
	msgs_array = msgs;
	msgs = msgs.join(' ');
	var msg = msgs.substr(pointer,rows*columns).split("");
	console.log(msg);
	msgs = msgs.toUpperCase();
	msgs = msgs.split('');
	
	// words = msgs_array[0].toUpperCase().split(' ');
	words = msgs_array[0].split(' ');
}
</script>