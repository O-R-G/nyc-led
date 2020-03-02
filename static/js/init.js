var wW = window.innerWidth,
	wH = window.innerHeight;

var sDisplay = document.getElementById("display"),
	sTitle = document.getElementById("title"),
	sScroller = document.getElementById("scroller");

//  adding blocks for text replacement
var cBlock = document.createElement("span");
	cBlock.className = "block";
var block_num = sTitle.innerHTML.split("").length;

for ( i = 0 ; i < block_num ; i ++ ){
	var cBlock = document.createElement("span");
	cBlock.innerHTML = ".";
	cBlock.className = "block";
	cBlock.setAttribute("id", "block"+i);
	sScroller.append(cBlock);
}

var sBlock = document.getElementsByClassName("block");
var block_width = sBlock[0].offsetWidth;
