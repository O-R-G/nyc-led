// 54 DEGREES AND WINDY
var progress = 0; 
var msg_array;


var text_marquee = function(msg){
	// medthod 1
	for(i = 0 ; i < block_num ; i++){
		msg += " ";
	}
	msg_array = msg.split("");
	setInterval(draw1, 250);

	// medthod 2
	// msg_array = msg.split(" ");
	// setInterval(draw2, 500);
}

var draw2 = function(){
	for(i = 0 ; i < block_num ; i++){
		sBlock[i].innerHTML = ".";
		sBlock[i].classList.remove("on");
	}

	var thisMsg = msg_array[progress];
	if(thisMsg.length <= block_num){
		var startingBlock_order = Math.round((block_num - thisMsg.length)/2);
		for(j = 0; j < thisMsg.length; j++){
			var thisBlock = sBlock[startingBlock_order];
			thisBlock.innerHTML = thisMsg[j];
			thisBlock.classList.add("on");
			startingBlock_order++;
		}
	}else{
		console.log("Got a word longer than "+block_num+" letters")
	}
	if(progress<msg_array.length-1){
		progress++;
	}else{
		progress = 0;
	}
}

var draw1  = function(){

	if (progress < msg_array.length){
		progress++;
	}else {
		progress = 0;
	}

	for(i = 0 ; i < progress ; i ++){
		var block_order = block_num - progress + i;
		var thisBlock = sBlock[block_order];
		if (block_order >= 0){
			if(msg_array[i]!==" "){
				thisBlock.classList.add("on");
				thisBlock.innerHTML = msg_array[i];
			}else{
				thisBlock.classList.remove("on");
				thisBlock.innerHTML = ".";
			}
		}
	}
	
}