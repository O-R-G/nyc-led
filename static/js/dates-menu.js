/*
    dates-menu   
*/

// hide / show menu

function hide_show(div){
    if (div.style.visibility!='visible') {
        div.style.visibility='visible';
    } else {
        div.style.visibility='hidden';
    }
}

// add event listeners to #date, #dates-menu

var date = document.getElementById("date");
var dates_menu = document.getElementById("dates-menu");
date.addEventListener("click", function() {
    hide_show(dates_menu);    
});

