/*
    new york consolidated
    matrix rain flipboard

    adapted from https://codepen.io/P3R0/pen/MwgoKv
*/

var c = document.getElementById("c");
var ctx = c.getContext("2d");

c.height = window.innerHeight;
c.width = window.innerWidth;
c.onclick = stop_start;

var font_size = 36;
// var font_size = 18;
var refresh = 30;     // lower = faster, really delay before update
var pause = 3000;
var updates = 0;
// var columns = c.width/font_size; 

// var base = "NEW YORK CONSOLIDATED";
// better variable names!
var base_pointer = 0;
var base_size = 21;
// var base_size = 90;
var base = msg.substr(base_pointer,base_size).toUpperCase();
base_pointer += base.length;
base = base.split("");    // str to array of chars
var columns = base.length; 

// msg set dynamically in views/home
// var msg = "田NEW申甴甽YORK畄畅畆畇CONSOLIDATED畈畎畏畐畑";
// var msg = "NEW YORK CONSOLIDATED 田NEW申甴甽YORK畄畅畆畇CONSOLIDATED畈畎畏畐畑";
// var msg = "NEW YORK CONSOLIDATED";
// adding specific extra letters so they resolve more quickly
// msg += "3333333399999999°°°°°°°°°°WWWWWWWWKKKKKKK田NEW申甴甽YORK畄畅畆畇CONSOLIDATED畄畅畆畈畎畏畐畑田NEW申甴甽YORK畄畅畆畇CONSOLIDATED畈畎畏畐畑田NEW申甴甽YORK畄畅畆畇CONSOLIDATED畈畎畏畐畑田NEW申甴甽YORK畄畅畆畇CONSOLIDATED畈畎畏畐畑田NEW申甴甽YORK畄畅畆畇CONSOLIDATED畈畎畏畐畑田NEW申甴甽YORK畄畅畆畇CONSOLIDATED畈畎畏畐畑田NEW申甴甽YORK畄畅畆畇CONSOLIDATED畈畎畏畐畑田NEW申甴甽YORK畄畅畆畇CONSOLIDATED畈畎畏畐畑田NEW申甴甽YORK畄畅畆畇CONSOLIDATED畈畎畏畐畑田NEW申甴甽YORK畄畅畆畇CONSOLIDATED畈畎畏畐畑田NEW申甴甽YORK畄畅畆畇CONSOLIDATED畈畎畏畐畑田NEW申甴甽YORK畄畅畆畇CONSOLIDATED畈畎畏畐畑田NEW申甴甽YORK畄畅畆畇CONSOLIDATED畈畎畏畐畑田NEW申甴甽YORK畄畅畆畇CONSOLIDATED畈畎畏畐畑田NEW申甴甽YORK畄畅畆畇CONSOLIDATED畈畎畏畐畑";
msg = msg.toUpperCase();
msg = msg.split("");    // str to array of chars

var slots = [];
var letters = [];
for(var y = 0; y < columns; y++)
    slots[y] = 1;

function update() {
    ctx.fillStyle = "#000";
    ctx.font = font_size + "px relative10_pitch";
    for (var i = 0; i < slots.length; i++) {
        if ((letters[i] !== base[i]) && (updates <= 50)) {
        // if ((letters[i] !== base[i])) {
            letters[i] = msg[Math.floor(Math.random()*msg.length)];   // one random char
            ctx.fillStyle = "rgba(255, 255, 255, .75)";
            ctx.fillRect(i*font_size, slots[i]*font_size-font_size, font_size, font_size+10);
            ctx.fillStyle = "#000";
            ctx.fillText(letters[i], i*font_size, slots[i]*font_size);
        } else {
            letters[i] = base[i];
            ctx.fillStyle = "rgba(255, 255, 255, 1.0)";
            ctx.fillRect(i*font_size, slots[i]*font_size-font_size, font_size, 100);
            ctx.fillStyle = "#000";
            ctx.fillText(letters[i], i*font_size, slots[i]*font_size);
        }

        // x = i*font_size, y = value of slots[i]*font_size        
        // sending the drop back to the top randomly after it has crossed the screen
        // adding a randomness to the reset to make the slots scattered on the Y axis
        if (slots[i]*font_size > c.height && Math.random() > 0.975)
            slots[i] = 0;        
        // slots[i]++;  // incr y (rain)
    }
    // all letters resolved or timed out ?
    if (letters.join('') == base.join('')) {
        clearInterval(timer);
        delay = setInterval(stop_start, pause);
        // clear and load next message to match
        // this could use an array passed in from php 
        // of the messages in the order they are to be displayed
        // or just take the messages 21 characters at a time
        // as substrings checking to wrap around as needed
        letters = [];
        base = msg.join('').substr(base_pointer,base_size).toUpperCase();
        base_pointer += base.length;
        if (base_pointer >= msg.length)
            base_pointer = 0;
        base = base.split("");    
        timer = false;
        updates = 0;
    } else {
        updates++;
    }
}

var delay;
var timer = setInterval(update, refresh);

function stop_start() {
    if (!timer) {
        clearInterval(delay);
        delay = false;
        timer = setInterval(update, refresh);
    } else {
        clearInterval(timer);
        timer = false;
    }
}
