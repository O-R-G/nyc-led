<?

?>
<script type="text/javascript">
var now = new Date();
var now_hr = now.getHours();
var now_min = now.getMinutes();
if(now_hr < 10)
	now_hr = "0"+now_hr;
if(now_min < 10)
	now_min = "0"+now_min;

var req_array = [
	{	
		'name': 'new-york-times',
		'req_url': 'https://api.nytimes.com/svc/news/v3/content/all/all.json?api-key=FJ5pNfQtwlkTP27jg62s2De8IM0Ozvjk', 
		'data_type': 'json',
        'results_count': 3
	},
	{	
		'name': 'covidtracking',
		'req_url': 'https://covidtracking.com/api/v1/states/current.json', 
		'data_type': 'json',
        'results_count': ''
	},
	{	
		'name': '311',
		'req_url': 'https://data.cityofnewyork.us/resource/erm2-nwe9.json?$$app_token=LTyWtvrOoHffWyAwXcdEIQDup&$limit=2', 
		'data_type': 'json',
        'results_count': ''
	},
	{	
		'name': 'train',
		'req_url': "https://mtaapi.herokuapp.com/times?hour="+now_hr+"&minute="+now_min,
		'data_type': 'json',
        'results_count': ''
	},
	{	
		'name': 'temp',
		'req_url': 'https://w1.weather.gov/xml/current_obs/KNYC.xml', 
		'data_type': 'xml',
        'results_count': ''
	}
];


// prepareing current date + time
var month_names = ["Jan.", "Feb.", "Mar.", "Apr.", "May", "Jun.",
  "Jul.", "Aug.", "Sep.", "Oct.", "Nov.", "Dec."
];

var now_msg = get_time();

var msgs = [], 
	msgs_temp = [];
var msgs_array = [], 
	msgs_array_temp = [];
var msgs_opening = [],
	msgs_opening_1 = [],
	msgs_opening_2 = [],
	msgs_opening_3 = [];
msgs_opening_1.push('NEW YORK CONSOLIDATED'); 
msgs_opening_1.push('                     '); 
msgs_opening_1 = msgs_opening_1.join('');
msgs_opening_2.push(now_msg[0]); 
msgs_opening_2.push(now_msg[1]); 
msgs_opening_2 = msgs_opening_2.join('');
msgs_opening_3.push('Nueva York           '); 
msgs_opening_3.push('Consolidada          '); 
msgs_opening_3.push('纽约合并                 '); 
msgs_opening_3.push('                     '); 
msgs_opening_3.push('      نيويورك الموحدة');
msgs_opening_3.push('                     '); 
msgs_opening_3.push('...........hello?....'); 
msgs_opening_3.push('....:)...............');
msgs_opening_3 = msgs_opening_3.join('');
msgs_opening = msgs_opening_1.concat(msgs_opening_2, msgs_opening_3);

var msgs_mid = {};
var msgs_ending = ' 0 1 2 3 4 5 6 7 8 9 Have a nice day.';
var msgs_break = '///';

var timer;
var msg, msg_temp;
var letters = [];
var words = [];

// preventing from the animation starts before data loaded.
// if ready_now == 0 when an api is loaded, 
// it fires timer then reading_now++
// ( json.php )
var ready_now = 0;
var ready_full = req_array.length;

function handle_msgs(name, response, results_count = false){
	if(results_count == '')
		results_count = false;

	var response = response;
	var this_msgs = [];
	// opening msg for each section;
	if(name == 'new-york-times'){
		// console.log('updaing new-york-times');
		this_msgs = [' from the NYTimes : ' + msgs_break ];
		response = response['results'] ;

		for(i = 0 ; i < results_count ; i++){
			var this_msg = response[i]['title'];
			if(typeof this_msg != 'undefined')
				this_msgs.push(this_msg);
		}

	}else if(name == 'covidtracking'){
		// console.log('updaing covidtracking');
		this_msgs.push(' from covidtracking.com : ' + msgs_break);
		for(i = 0 ; i < response.length ; i++){
			if(response[i]['state'] == 'NY'){
				response = response[i];
				break;
			}
		}

		this_msgs.push('Positive cases: '+response['positive']);
		this_msgs.push(' Negative cases: '+response['negative']);
		this_msgs.push(' Currently hospitalized cases: '+response['hospitalizedCurrently']);

	}else if(name == '311'){
		// console.log('updating 311');
		for(i = 0 ; i < response.length ; i++){
        	var this_msg = ' from '+response[i]['agency']+': ';
        	this_msg += response[i]['descriptor']+' is reported around '+response[i]['landmark']+' ';
        	this_msgs.push( msgs_break+this_msg.toUpperCase() );
        }
	}else if(name == 'temp'){
		var oParser = new DOMParser();
		var oDOM = oParser.parseFromString(response, "application/xml");
		var current = oDOM.getElementsByTagName('weather')[0].innerHTML;
		var temp_f = oDOM.getElementsByTagName('temp_f')[0].innerHTML;
		var temp_c = oDOM.getElementsByTagName('temp_c')[0].innerHTML;
		var wind_string = oDOM.getElementsByTagName('wind_string')[0].innerHTML;

		this_msgs.push( ' Currently ' + temp_f + '°....' + msgs_break );
		this_msgs.push( ' Winds ' + wind_string + msgs_break );

	}

	msgs_mid[name] = this_msgs;
	update_msgs();
}

function shuffle(array) {
  array.sort(() => Math.random() - 0.5);
}

function update_msgs(){
	// console.log('update_msgs...');
	msgs_mid_array = Object.keys(msgs_mid).map(function (key) { 
        return msgs_mid[key]; 
    }); 
	// console.log(msgs_mid_array);
	shuffle(msgs_mid_array);

	msgs_temp = [msgs_opening];
	for(i = 0 ; i < msgs_mid_array.length ; i++){
		for(j = 0 ; j < msgs_mid_array[i].length ; j++)
			msgs_temp.push(msgs_mid_array[i][j]);
	}
	msgs_temp.push(msgs_ending);

	msgs_array_temp = msgs_temp;
	msgs_temp = msgs_temp.join('');
	msg_temp = msgs_temp.substr(pointer,columns*rows).split('');
	msgs_temp = msgs_temp.toUpperCase();
	msgs_temp = msgs_temp.split('');
	
}

// this is different from update_msgs() (at least for now)
// update_msgs(): fired every whatever seconds setInverval sets;
// update_msgs_opening(): fired every time the msgs loop is done;
function update_msgs_opening(){
	now_msg = get_time();
	msgs_opening_2 = [];
	msgs_opening_2.push(now_msg[0]); 
	msgs_opening_2.push(now_msg[1]); 
	msgs_opening_2 = msgs_opening_2.join('');
	msgs_opening = msgs_opening_1.concat(msgs_opening_2, msgs_opening_3);
}

function get_time(){
	var now = new Date();
	// set the time to EST
	now.setTime(now.getTime()+now.getTimezoneOffset()*60*1000);
	var offset = -300; //Timezone offset for EST in minutes.
	var now_est = new Date(now.getTime() + offset*60*1000);
	if(now_est.getHours() >= 12){
		var m = 'p.m.';
	}else{
		var m = 'a.m.';
	}
	now_est_hours = now_est.getHours();
	now_est_mins = now_est.getMinutes();
	now_est_secs = now_est.getSeconds();
	if(now_est_hours < 10)
		now_est_hours = "0"+now_est_hours;
	if(now_est_mins < 10)
		now_est_mins = "0"+now_est_mins;
	if(now_est_secs < 10)
		now_est_secs = "0"+now_est_secs;

	var now_msg_date = month_names[now_est.getMonth()]+' '+
					now_est.getDay()+', '+
					now_est.getFullYear();
	var now_msg_time = now_est_hours+':'+
						now_est_mins+':'+
						now_est_secs+' '+m;
	var row_char_num = 21;
	var char_difference = 21 - now_msg_date.length;
	for(i = 0 ; i < char_difference ; i++){
		now_msg_date += ' ';
	}
	char_difference = 21 - now_msg_time.length;
	for(i = 0 ; i < char_difference ; i++){
		now_msg_time += ' ';
	}
	now_msg_date = now_msg_date.toUpperCase();
	now_msg_time = now_msg_time.toUpperCase();
	return [now_msg_date, now_msg_time];
}

</script>
