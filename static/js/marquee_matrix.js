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

	var thisWord = msg_array[progress];
	if(thisWord.length <= block_num){
		// right now the words are placed at the middle
		// this line is to find out where to start putting thisWord
		var beginHere = Math.round((block_num - thisWord.length)/2);
		for(j = 0; j < thisWord.length; j++){
			var thisBlock = sBlock[beginHere];
			thisBlock.innerHTML = thisWord[j];
			thisBlock.classList.add("on");
			beginHere++;
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