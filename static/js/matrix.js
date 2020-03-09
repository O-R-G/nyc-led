/*
    new york consolidated
    matrix rain flipboard

    adapted from https://codepen.io/P3R0/pen/MwgoKv
    in process
*/

var c = document.getElementById("c");
var ctx = c.getContext("2d");

var font_size = 18;     // relative sizes depend on font_size
var base_size = 21;     // base message length [21]
var timer;              // update
var delay;              // pause between messages
var timer_ms = 30;      // ms before next update
var delay_ms = 3000;    // ms after msg complete
var updates = 0;        // counter
var base_pointer = 0;
var base = msg.substr(base_pointer,base_size).toUpperCase().split("");
// clean up use of base_size and columns, these are redundant
var columns = base.length; 
var slots = [];
var letters = [];
for(var y = 0; y < columns; y++)
    slots[y] = 1;       // for rain only, can rm and use columns
// msg = msg.join('');     // array to string
// msg = msg.join('').toUpperCase().split("");
// trouble passing an array from php to js and then using it
msg = msg.toUpperCase().split('');
// console.log(msgs);
c.height = font_size;
c.width = font_size * columns;
c.onclick = stop_start;

function update() {
    ctx.fillStyle = "#000";
    ctx.font = font_size + "px relative10_pitch";

    for (var i = 0; i < slots.length; i++) {
        if ((letters[i] !== base[i]) && (updates <= 50)) {
            letters[i] = msg[Math.floor(Math.random()*msg.length)];   // one random char
            ctx.fillStyle = "rgba(255, 255, 255, .75)";
            ctx.fillRect(i*font_size, slots[i]*font_size-font_size, font_size, font_size+10);
            ctx.fillStyle = "#000";
            ctx.fillText(letters[i], i*font_size, slots[i]*font_size);
        } else {
            letters[i] = base[i];
            ctx.fillStyle = "rgba(255, 255, 255, 1.0)";
            ctx.fillRect(i*font_size, slots[i]*font_size-font_size, font_size, font_size*2);
            ctx.fillStyle = "#00F";
            ctx.fillText(letters[i], i*font_size, slots[i]*font_size);
        }
    }

    // all letters resolved or timed out
    if (letters.join('') == base.join('')) {
        clearInterval(timer);
        delay = setInterval(stop_start, delay_ms);
        // clear and load next message to match
        // this could use an array passed in from php 
        // of the messages in the order they are to be displayed
        // or just take the messages 21 characters at a time
        // as substrings checking to wrap around as needed
        letters = [];
        base = msg.join('').substr(base_pointer,base_size).toUpperCase().split('');
        base_pointer += base.length;
        if (base_pointer >= msg.length)
            base_pointer = 0;
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
base_pointer += base.length;    // better way to do this w/ columns
