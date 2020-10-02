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
        img.play();
    } else {
        img.style.position='initial';
        img.style.width='';
        img.pause();
    }
}

// add event listeners to #main img *
var main = document.getElementById("main");
if(main !== null){
    var imgs = main.getElementsByTagName("img");
    if(imgs !== null){
        for(var i=0; i<imgs.length; i++) {
            imgs[i].addEventListener("click", function() {
                img_zoom(this);
            });
        }
    }
    var videos = main.getElementsByTagName("video");
    if(videos !== null){
        for(var i=0; i<videos.length; i++) {
            videos[i].addEventListener("click", function() {
                img_zoom(this);
            });
        }
    }
}


