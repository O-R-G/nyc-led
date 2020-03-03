var wW = window.innerWidth,
	wH = window.innerHeight;

var sDisplay = document.getElementById("display"),
	sTitle = document.getElementsByClassName("title"),
	sScroller = document.getElementsByClassName("scroller");


var cLetter = document.createElement("span");
	cLetter.innerHTML = ".";
	sScroller[0].append(cLetter);
var title_width =  sTitle[0].offsetWidth,
	letter_width = cLetter.offsetWidth;
	cLetter.remove();
var	block_num = Math.round(title_width/letter_width);
	console.log(letter_width, block_num);
var block_num_sum = sScroller.length*block_num;
for(j = 0; j<sTitle.length;j++){
	for ( i = 0 ; i < block_num ; i ++ ){
		var cBlock = document.createElement("span");
		cBlock.innerHTML = ".";
		cBlock.className = "block";
		cBlock.setAttribute("id", "block"+(i+j*block_num));
		sScroller[j].append(cBlock);
	}
}

var sBlock = document.getElementsByClassName("block");
var block_width = sBlock[0].offsetWidth;
