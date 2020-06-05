/*
    img-zoom
*/

// zoom the image clicked on

function img_zoom(img){
    if (img.style.position!='fixed') {
        img.style.position='fixed';
        img.style.top='0px';
        img.style.left='0px';
        img.style.width='100%';
    } else {
        img.style.position='initial';
        img.style.width='';
    }
}

// add event listeners to #main img *
var main = document.getElementById("main");
var imgs = main.getElementsByTagName("img");
for(var i=0; i<imgs.length; i++) {
    imgs[i].addEventListener("click", function() {
        img_zoom(this);
    });
}

