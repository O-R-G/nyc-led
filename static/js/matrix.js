/*
    new york consolidated
    matrix rain flipboard

    adapted from https://codepen.io/P3R0/pen/MwgoKv
*/

var c = document.getElementById("c");
var ctx = c.getContext("2d");

// full screen
c.height = window.innerHeight;
c.width = window.innerWidth;

c.onclick = stop_start;

var font_size = 36;
var columns = c.width/font_size; 

// msg set dynamically in views/home
// var msg = "田NEW申甴甽YORK畄畅畆畇CONSOLIDATED畈畎畏畐畑";
// var msg = "NEW YORK CONSOLIDATED 田NEW申甴甽YORK畄畅畆畇CONSOLIDATED畈畎畏畐畑";
// var msg = "NEW YORK CONSOLIDATED";
// msg += "田NEW申甴甽YORK畄畅畆畇CONSOLIDATED畈畎畏畐畑田NEW申甴甽YORK畄畅畆畇CONSOLIDATED畈畎畏畐畑田NEW申甴甽YORK畄畅畆畇CONSOLIDATED畈畎畏畐畑田NEW申甴甽YORK畄畅畆畇CONSOLIDATED畈畎畏畐畑田NEW申甴甽YORK畄畅畆畇CONSOLIDATED畈畎畏畐畑田NEW申甴甽YORK畄畅畆畇CONSOLIDATED畈畎畏畐畑田NEW申甴甽YORK畄畅畆畇CONSOLIDATED畈畎畏畐畑田NEW申甴甽YORK畄畅畆畇CONSOLIDATED畈畎畏畐畑田NEW申甴甽YORK畄畅畆畇CONSOLIDATED畈畎畏畐畑田NEW申甴甽YORK畄畅畆畇CONSOLIDATED畈畎畏畐畑田NEW申甴甽YORK畄畅畆畇CONSOLIDATED畈畎畏畐畑田NEW申甴甽YORK畄畅畆畇CONSOLIDATED畈畎畏畐畑田NEW申甴甽YORK畄畅畆畇CONSOLIDATED畈畎畏畐畑田NEW申甴甽YORK畄畅畆畇CONSOLIDATED畈畎畏畐畑田NEW申甴甽YORK畄畅畆畇CONSOLIDATED畈畎畏畐畑";
msg = msg.toUpperCase();
msg = msg.split("");    // str to array of chars

// array of drops - one per column
var drops = [];
// init y coords
for(var y = 0; y < columns; y++)
    drops[y] = 1;

// console.log(msg);
// console.log(drops);

function update() {
    ctx.fillStyle = "rgba(255, 255, 255, 0.5)";
    ctx.fillRect(0, 0, c.width, c.height);
    ctx.fillStyle = "#00F";
    ctx.font = font_size + "px relative10_pitch";
    for(var i = 0; i < drops.length; i++) {
        var text = msg[Math.floor(Math.random()*msg.length)];   // one random char
        // x = i*font_size, y = value of drops[i]*font_size
        ctx.fillText(text, i*font_size, drops[i]*font_size);
        
        // sending the drop back to the top randomly after it has crossed the screen
        // adding a randomness to the reset to make the drops scattered on the Y axis
        if(drops[i]*font_size > c.height && Math.random() > 0.975)
            drops[i] = 0;
        
        // increment Y (rain)
        // drops[i]++;
    }
}

var timer = setInterval(update, 33);

function stop_start() {
    if (!timer) {
        timer = setInterval(update, 33);
    } else {
        clearInterval(timer);
        timer = false;
    }
}
