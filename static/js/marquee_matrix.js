<<<<<<< HEAD
var progress = 0; //how many letters in msg has been fed in screen
=======
var progress = 0; //which word in msg
>>>>>>> text_matrix2
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

<<<<<<< HEAD
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
	
=======
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
>>>>>>> text_matrix2
}