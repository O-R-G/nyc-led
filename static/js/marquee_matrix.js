var progress_senetnce = 0,
	progress_word = 0; //which word in msg
var thisRow = 0,
	thisRow_text = sTitle[thisRow].innerHTML;
var msg_array = [];


var text_marquee = function(msg){
	// split msg into words
	console.log(msg);
	console.log("hihi");
	for(i = 0; i<msg.length;i++){
		msg_array[i]  = msg[i].split(" ");
		while(msg_array[i][msg_array[i].length] == "" || msg_array[i][msg_array[i].length] == " "){
			msg_array[i].pop();
		}
		while(msg_array[i][0] == "" || msg_array[i][0] == " "){
			msg_array[i].shift();
		}
	}
	
	setInterval(draw3, 500);
}

var draw3 = function(){
	// reset all blocks
	if(progress_word == 0){
		sTitle[thisRow].innerHTML = thisRow_text;
		thisRow = (thisRow+1)%sScroller.length;
		thisRow_text = sTitle[thisRow].innerHTML;
		sTitle[thisRow].innerHTML = "&#160;";
	}
	for(i = 0 ; i < block_num_sum ; i++){
		sBlock[i].innerHTML = ".";
		sBlock[i].classList.remove("on");
	}

	var thisWord = msg_array[progress_senetnce][progress_word];
	if(thisWord.length <= block_num){
		var beginHere = thisRow*block_num;
		for(j = 0; j < thisWord.length; j++){
			var thisBlock = sBlock[beginHere];
			thisBlock.innerHTML = thisWord[j];
			thisBlock.classList.add("on");
			beginHere++;
		}
	}else{
		console.log("Got a word longer than "+block_num+" letters")
	}
	if(progress_word<msg_array[progress_senetnce].length-1){
		progress_word++;
	}else{
		progress_word = 0;
		progress_senetnce = (progress_senetnce+1)%msg_array.length;
		
		
	}
}