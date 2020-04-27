// hide show menu, read url for status

var toggleMenu = function(){
	if (menu.style.display=='block') {
		menu.style.display='none';
		xx.style.display='block';
	} else {
		menu.style.display='block';
		xx.style.display='none';
	}
}

var cv = document.getElementById('cv');
var selected = document.getElementById('selected');
var menu = document.getElementById('menu');
var xx = document.getElementById('xx');
xx.addEventListener("click", toggleMenu);
