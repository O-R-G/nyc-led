// hide show menu, read url for status

var toggleMenu = function(){
	if (menu.style.display=='block') {
		menu.style.display='none';
		xx_show.style.display='block';
		xx_hide.style.display='none';
	} else {
		menu.style.display='block';
		xx_show.style.display='none';
		xx_hide.style.display='block';
	}
}

var menu = document.getElementById('menu');
var xx_show = document.getElementById('xx_show');
var xx_hide = document.getElementById('xx_hide');
xx_show.addEventListener("click", toggleMenu);
xx_hide.addEventListener("click", toggleMenu);

function outsideClick(event, notelem)	{
    var clickedOut = true, 
    	i, 
    	len = notelem.length;
    if(typeof len == 'undefined'){
		if (event.target == notelem || notelem.contains(event.target)) {
            clickedOut = false;
        }
    }else{
    	for (i = 0;i < len;i++)  {
	        if (event.target == notelem[i] || notelem[i].contains(event.target)) {
	            clickedOut = false;
	        }
	    }
    }
    if (clickedOut) 
    	return true;
    else 
    	return false;
}

var nav_elements = document.querySelectorAll('#menu .nav-level span, #xx_hide, #xx_show');

window.addEventListener('click', function(e){
	var menu_isExpanded = (xx_hide.style.display === 'block');
	if(outsideClick(e, nav_elements)){
		console.log('outside');
	}
	if (outsideClick(e, nav_elements) && menu_isExpanded) {
		console.log('toggle menu');
   		menu.style.display='none';
		xx_show.style.display='block';
		xx_hide.style.display='none';
   }
});