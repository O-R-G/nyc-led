// 54 DEGREES AND WINDY
var progress = 0; 
var msg_array;


var text_marquee = function(msg){
	// medthod 1
		// Wei: was wondering if more spacing between streamed words will improve
		// the legibility of NEW YORK CONSOLIDATED.

		// Add extra spaces between words in msg
		msg_array = msg.split(" ");
		msg = "";
		for(i = 0 ; i<msg_array.length; i++){
			msg += msg_array[i]+"   ";
		}

	// Adding extra spaces at the very end of msg
	for(i = 0 ; i < block_num ; i++){
		msg += " ";
	}

	msg_array = msg.split("");
	setInterval(draw1, 200);
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