var progress = 0; //which word in msg
var msg_array;


var text_marquee = function(msg){
	// split msg into words
	msg_array = msg.split(" ");
	setInterval(draw2, 500);
}

var draw2 = function(){
	// reset all blocks
	for(i = 0 ; i < block_num ; i++){
		sBlock[i].innerHTML = ".";
		sBlock[i].classList.remove("on");
	}

	msg_array = msg.split("");
	setInterval(draw1, 200);
}

var draw1  = function(){

	

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
	if (progress < msg_array.length){
		progress++;
	}else {
		progress = 1;
	}
	
}