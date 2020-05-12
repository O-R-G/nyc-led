/* 
    collect and assemble msg[] for matrix.js
    includes cacheing
*/    

// date / time

Date.prototype.today = function () { 
    var days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    return days[this.getDay()] + " " + this.getDate() + " " + months[this.getMonth()] + " " + this.getFullYear();
}
Date.prototype.now = function () {
     return this.hour() + ":" + this.minute() +":"+ this.second();
}
Date.prototype.hour = function () {
     return ((this.getHours() < 10)?"0":"") + this.getHours();
}
Date.prototype.minute = function () {
     return ((this.getMinutes() < 10)?"0":"") + this.getMinutes();
}
Date.prototype.second = function () {
    return ((this.getSeconds() < 10)?"0":"") + this.getSeconds();
}

function get_time(){
    var d = new Date();
	return [d.today().toUpperCase(), d.now().toUpperCase()];
}

var now = new Date();
var now_hr = now.hour();
var now_min = now.minute();

var req_array = [
	{	
		'name': 'new-york-times',
		'req_url': 'https://api.nytimes.com/svc/news/v3/content/all/all.json?api-key=FJ5pNfQtwlkTP27jg62s2De8IM0Ozvjk', 
		'data_type': 'json',
        'results_count': 3,
        'use_header': false,
        'cache_lifecycle': 1
	},
	{	
		'name': 'covidtracking',
		'req_url': 'https://covidtracking.com/api/v1/states/current.json', 
		'data_type': 'json',
        'results_count': '',
        'use_header': true, 
        'cache_lifecycle': 10
	},
	{	
		'name': '311',
		'req_url': 'https://data.cityofnewyork.us/resource/erm2-nwe9.json?$$app_token=LTyWtvrOoHffWyAwXcdEIQDup&$limit=2', 
		'data_type': 'json',
        'results_count': '',
        'use_header': true,
        'cache_lifecycle': 10
	},
	{	
		'name': 'train',
		'req_url': "https://mtaapi.herokuapp.com/times?hour="+now_hr+"&minute="+now_min,
		'data_type': 'json',
        'results_count': '',
        'use_header': false,
        'cache_lifecycle': 1
	},
	{	
		'name': 'temp',
		'req_url': 'https://w1.weather.gov/xml/current_obs/KNYC.xml', 
		'data_type': 'xml',
        'results_count': '',
        'use_header': false,
        'cache_lifecycle': false
	}
	,{
		'name':'population',
		'req_url': 'https://data.cityofnewyork.us/resource/xywu-7bv9.json',
		'data_type': 'json',
		'results_count': '',
		'use_header': false,
		'cache_lifecycle': 1440
	}
	,{
		'name':'hotspot',
		'req_url': 'https://data.cityofnewyork.us/resource/varh-9tsp.json',
		'data_type': 'json',
		'results_count': '',
		'use_header': false,
		'cache_lifecycle': 1440
	}
	,{
		'name':'restaurant-inspection',
		'req_url': 'https://data.cityofnewyork.us/resource/43nn-pn8j.json',
		'data_type': 'json',
		'results_count': '',
		'use_header': false,
		'cache_lifecycle': 1440
	}

	
];

var now_msg = get_time();
var msgs, // the final msgs for display. array of letters
	msgs_sections = {}, // the kept msgs in the form of opening, mid, ending. it needs to stay array so that it has the flexibility to be updated.
	msgs_temp = []; // the internediate msgs to hold updated msgs, and wait until the current frame is settled. 
var msgs_array = [], 
	msgs_array_temp = [];

// msgs_opening_1.push('––––––––––––––––––––'); // en-dash (S)
// msgs_opening_1.push('————————————————————'); // em-dash (M)
/*
msgs_opening_1.push('•••••••••••••••••••••');    // bullet (L)
msgs_opening_1.push('•••••••••••••••••••••');    // bullet (L)
msgs_opening_1.push('•••••••••••••••••••••');    // bullet (L)
msgs_opening_1.push('•••••••••••••••••••••');    // bullet (L)
*/

msgs_sections['opening'] = [];
msgs_sections['opening'][0] = [];
msgs_sections['opening'][0].push('NEW YORK CONSOLIDATED'); 
msgs_sections['opening'][0].push('                     '); 
msgs_sections['opening'][0].push('                     '); 
msgs_sections['opening'][0].push('                     '); 
msgs_sections['opening'][0] = msgs_sections['opening'][0].join('');
msgs_sections['opening'][1] = [];
msgs_sections['opening'][1].push(now_msg[0]); 
msgs_sections['opening'][1].push(now_msg[1]); 
msgs_sections['opening'][1].push('–––––––––––––––––––––'); 
msgs_sections['opening'][1].push('—————————————————————'); 
msgs_sections['opening'][1] = msgs_sections['opening'][1].join('');
/*
msgs_opening_3.push('Nueva York           '); 
msgs_opening_3.push('Consolidada          '); 
msgs_opening_3.push('紐約合作基金會              '); 
msgs_opening_3.push('                     '); 
msgs_opening_3.push('      نيويورك الموحدة');
msgs_opening_3.push('                     '); 
msgs_opening_3.push('...........hello?....'); 
msgs_opening_3.push('....:)...............');
msgs_opening_3 = msgs_opening_3.join('');
msgs_opening = msgs_opening_1.concat(msgs_opening_2, msgs_opening_3);
*/

msgs_sections['mid'] = {};

msgs_sections['ending'] = ' 0 1 2 3 4 5 6 7 8 9 Have a nice day.';
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
	// console.log('handle_msgs...'+name);
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
				this_msgs.push(this_msg+msgs_break);
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
		if(typeof response['positive'] != 'undefined')
			this_msgs.push('Positive cases: '+response['positive'] + msgs_break+' ');
		if(typeof response['negative'] != 'undefined')
			this_msgs.push('Negative cases: '+response['negative'] + msgs_break+' ');
		if(typeof response['hospitalizedCurrently'] != 'undefined')
			this_msgs.push('Currently hospitalized cases: '+response['hospitalizedCurrently'] + msgs_break+' ');

	}else if(name == '311'){
		for(i = 0 ; i < response.length ; i++){
        	var this_msg = ' from '+response[i]['agency']+': ';
        	this_msg += response[i]['descriptor']+' is reported around '+response[i]['landmark']+' ';
        	this_msgs.push( msgs_break+this_msg.toUpperCase()+msgs_break );
        }

	}else if(name == 'temp'){
		var oParser = new DOMParser();
		var oDOM = oParser.parseFromString(response, "application/xml");
		var current = oDOM.getElementsByTagName('weather')[0];
		var temp_f = oDOM.getElementsByTagName('temp_f')[0];
		var temp_c = oDOM.getElementsByTagName('temp_c')[0];
		var wind_string = oDOM.getElementsByTagName('wind_string')[0];
		if(typeof temp_f != 'undefined')
			this_msgs.push( ' Currently ' + temp_f.innerHTML + '°....' + msgs_break );
		if(typeof wind_string != 'undefined')
			this_msgs.push( ' Winds ' + wind_string.innerHTML + msgs_break );

	}
	else if(name == 'train'){
		this_msgs = [' There is a train arriving now at : ' + response['result'][0]['name'] + ". " + msgs_break ];
	}
	else if(name == 'population'){

		// console.log(response[0]);
		this_msgs = [' Total population in NYC: ' + response[0]['_2020']+". " + msgs_break ];
		for(i = 1 ; i <response.length ; i++ ){
			this_msgs.push(' Population in ' + response[i]['borough'].replace('   ', '') + ": " + response[i]['_2020']+"("+response[i]['_2020_boro_share_of_nyc_total']+"%)"+msgs_break );
		}
	}
	else if(name == 'hotspot'){
		var index = parseInt( response.length * Math.random() );
		var data_count = 0;
		this_msgs = [];
		while(data_count < 1){
			
			if(response[index]['type'] == 'Free'){
				this_msgs.push(' Free public hotspot "'+response[index]['ssid']+'" at '+response[index]['location']);
				data_count++;
			}
			index = parseInt( response.length * Math.random() );
			
		}
	}
	else if(name == 'restaurant-inspection'){
		var index = parseInt( response.length * Math.random() );
		var data_count = 0;
		this_msgs = [];
		this_msgs = [' From DOHMH New York City Restaurant Inspection Results : ' ];
		
		while(data_count < 1){
			if(response[index]['critical_flag'] == 'N' && response[index]['grade'] == 'A'){
				this_msgs.push(response[index]['dba'] + ' on '+ response[index]['street']+' is graded as A. '+msgs_break);
				data_count++;
			}
			index = parseInt( response.length * Math.random() );
			
		}
		console.log(this_msgs);
	}
	msgs_sections['mid'][name] = this_msgs;
	
	update_msgs();
}

function shuffle(array) {
  array.sort(() => Math.random() - 0.5);
}

function update_msgs(isBegining = false){
	// console.log('update_msgs...');
	msgs_mid_array = Object.keys(msgs_sections['mid']).map(function (key) { 
        return msgs_sections['mid'][key]; 
    }); 
	if(isBegining)
		shuffle(msgs_mid_array);

	msgs_temp = [msgs_sections['opening']];
	for(i = 0 ; i < msgs_mid_array.length ; i++){
		for(j = 0 ; j < msgs_mid_array[i].length ; j++)
			msgs_temp.push(msgs_mid_array[i][j]);
	}
	msgs_temp.push(msgs_sections['ending']);

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
	msgs_sections['opening'][1] = [];
	msgs_sections['opening'][1].push(now_msg[0]); 
	msgs_sections['opening'][1].push(now_msg[1]); 
    msgs_sections['opening'][1].push('–––––––––––––––––––––'); // en-dash (S)
    msgs_sections['opening'][1].push('—————————————————————'); // em-dash (L)
	msgs_sections['opening'][1] = msgs_sections['opening'][1].join('');
	msgs_temp[0] = msgs_sections['opening'][0].concat(msgs_sections['opening'][1]);
}
