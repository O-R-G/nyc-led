/*
    new york consolidated
    matrix rain flipboard

    adapted from https://codepen.io/P3R0/pen/MwgoKv
    in process
*/

// rework rows and columns logic

var c = document.getElementById("c");
var ctx = c.getContext("2d");

var rows = 4;
var columns = 21;
var font_size = 18;     // relative sizes depend on font_size [18]
var timer;              // update
var delay;              // pause between messages
var timer_ms = 30;      // ms before next update [30]
var delay_ms = 3000;    // ms after msg complete
var updates = 0;        // counter
var pointer = 0;
var msg = msgs.substr(pointer,rows*columns).toUpperCase().split("");
var letters = [];
// pass an array from php to js?
// msgs = msgs.join('');     // array to string
// msgs = msgs.join('').toUpperCase().split("");
msgs = msgs.toUpperCase().split('');
c.height = font_size * rows * 3;
c.width = font_size * columns;
c.onclick = stop_start;

function update() {
    // ctx.fillStyle = "#FF0";
    ctx.fillStyle = "#FFF";
    ctx.font = font_size + "px relative10_pitch";
    ctx.rect(0,0,c.width, c.height);
    ctx.fill();
// could use use a 2d array (letters[row][column]) 
// instead of just a string
// or maybe more efficient to do it in the loop
// like x+y*10 to produce correct row-column lookup in letters[]

    var i;  // index to current position in letters
    for (var y = 0; y < rows; y++) {
        for (var x = 0; x < columns; x++) {
            i = x+y*columns;
            if ((letters[i] !== msg[i]) && (updates <= 50)) {
                letters[i] = msgs[Math.floor(Math.random()*msgs.length)];   // one random char
                ctx.fillStyle = "rgba(255, 255, 255, .75)";
                ctx.fillRect(x*font_size, y*font_size, font_size, font_size+10);
                ctx.fillStyle = "#000";
                ctx.fillText(letters[i], x*font_size, (y+1)*font_size);
            } else {
                letters[i] = msg[i];
                ctx.fillStyle = "rgba(255, 255, 255, 1.0)";
                ctx.fillRect(x*font_size, y*font_size, font_size, font_size+10);
                ctx.fillStyle = "#00F";
                ctx.fillText(letters[i], x*font_size, (y+1)*font_size);
            }
        }
    }

    // all letters resolved or timed out
    if (letters.join('') == msg.join('')) {
        clearInterval(timer);
        delay = setInterval(stop_start, delay_ms);
        // clear and load next message to match
        // this could use an array passed in from php 
        // of the messages in the order they are to be displayed
        // or just take the messages 21 characters at a time
        // as substrings checking to wrap around as needed
        letters = [];
        pointer += msg.length;
        if (pointer >= msgs.length)
            pointer = 0;
        msg = msgs.join('').substr(pointer,columns*rows).toUpperCase().split('');
        timer = false;
        updates = 0;
    } else
        updates++;
}

function stop_start() {
    if (!timer) {
        clearInterval(delay);
        delay = false;
        timer = setInterval(update, timer_ms);
    } else {
        clearInterval(timer);
        timer = false;
    }
}

// start
var timer = setInterval(update, timer_ms);
// pointer += msg.length;    // better way to do this w/ columns
