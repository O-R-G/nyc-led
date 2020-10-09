/*
    img-zoom
*/

// zoom the image clicked on

var bg = document.getElementById("img-zoom-bg");
function img_zoom(img){
    if (img.style.position!='fixed') {
        img.style.position='fixed';
        img.style.top='50%';
        img.style.left='0px';
        img.style.width='100%';
        img.style.transform='translate(0%, -50%)';
        bg.style.display='block';
        // img.play();
    } else {
        img.style.position='initial';
        img.style.width='';
        img.style.transform='initial';
        bg.style.display='none';
        // img.pause();
    }
}

// add event listeners to #content img *
var content = document.getElementById("content");
if(content !== null){
    var imgs = content.getElementsByTagName("img");
    if(imgs !== null){
        for(var i=0; i<imgs.length; i++) {
            imgs[i].addEventListener("click", function() {
                img_zoom(this);
            });
        }
    }
    var videos = content.getElementsByTagName("video");
    if(videos !== null){
        for(var i=0; i<videos.length; i++) {
            videos[i].addEventListener("click", function() {
                img_zoom(this);
            });
        }
    }
}


