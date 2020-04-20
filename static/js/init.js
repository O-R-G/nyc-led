var wW = window.innerWidth,
	wH = window.innerHeight;

var sDisplay = document.getElementById("display"),
	sTitle = document.getElementsByClassName("title"),
	sScroller = document.getElementsByClassName("scroller");

var cBlock = document.createElement("span");
	cBlock.className = "block";
var block_num = sTitle.innerHTML.split("").length;

// overlap div#scroller on p#title, and add div.block in #scroller
// then feed msg in .block in marquee_matrix.js
// .block is styled opacity:0 and will gain a class "on", which makes opacity 1, 
// when used to display a letter
// .block also has content "." to prevent its width from collapsing

for ( i = 0 ; i < block_num ; i ++ ){
	var cBlock = document.createElement("span");
	cBlock.innerHTML = ".";
	cBlock.className = "block";
	cBlock.setAttribute("id", "block"+i);
	sScroller.append(cBlock);
}

var sBlock = document.getElementsByClassName("block");
var block_width = sBlock[0].offsetWidth;
