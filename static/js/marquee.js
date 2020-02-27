var wW = window.innerWidth,
	wH = window.innerHeight;
var sLoop;
var Text_marquee = function(elm_id, msg, speed){
	// speed = px/sec;
	var elm = document.getElementById(elm_id);
	elm.innerHTML = msg;
	var elm_w = elm.offsetWidth;
	var elm_duration = elm_w/speed;
	elm.style.animation = "run "+elm_duration+"s infinite linear";
}


