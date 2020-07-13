/* 
    collect and assemble msg[] for matrix.js
    includes cacheing
*/    

var msgs; // the final msgs for display. array of letters
var	msgs_original; // the intermediate msgs to hold updated msgs, and wait until the current frame is settled. 
var msg;

var now_timestamp = new Date().getTime();

var timer;
var screen_interval;
// using ticking_start and tick_end to justify duration of each slide.
// ticking_progress is used when the animation is paused.
var ticking_start, ticking_end, ticking_duration, ticking_progress = 0;
var screen_interval_remain;

// display something while waiting for response;
var waiting = setInterval(function(){
	d.innerText = '–';
	setTimeout(function(){d.innerText = '';}, 500);
}, 1000);

// if the whole thing has started;
var hasStarted = false;

var speak = document.getElementById('speak');

function request_live(request_url){
	console.log('request live');
	fetch(request_url)
		.then(response =>  response.json())
		.then(function(data){
			handle_response(data);
		})
}
function handle_response(response){
	// console.log(response);
	now_timestamp = new Date().getTime();
	screen_interval = response['screen_interval'];
	var full_loop_ms = response['full_loop_ms'];
	var wait = screen_interval - (now_timestamp % full_loop_ms % screen_interval);

	msgs_original = response['msgs'].toUpperCase().split('');
	if(!hasStarted){
		// the website is loaded for the first time.
		current_position = response['position'];
		current_position += 48;
		if(current_position > msgs_original.length)
			current_position = 48;
		
		msgs = response['msgs'];
		msgs = msgs.slice(0, current_position) + response['msgs_beginning'] + msgs.slice(current_position);
		msgs = msgs.toUpperCase().split('');

	}
	else{
		// when the loop restart again.
		msgs = response['msgs'].toUpperCase().split('');
		current_position = 0;
	}
	
	pointer = current_position;
	msg = msgs.join('').substr(pointer,columns*rows).split('');
	speak.innerText = msg.join('');

	if(!hasStarted){
		setTimeout(function(){
			clearInterval(waiting);
			ticking_start = new Date();
			// remove the waiting animation
			timer = setInterval(update, timer_ms);
		}, wait);
	}

}

request_live('https://now.n-y-c.org/now');
