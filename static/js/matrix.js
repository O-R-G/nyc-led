/*
    new york consolidated
    matrix rain flipboard

    adapted from https://codepen.io/P3R0/pen/MwgoKv
    in process
*/

// rework rows and columns logic?
// get clear on msg, msgs, letters, words

/*

    msgs[]      all messages assembled, indexed
                array passed from .php
    words[]     words in a message
                array split from each msgs[]
    letters[]   letters in a word
                array split from each words[]
    msg?    

build msg
compare msgs[current] to number of characters available
assemble msg which fits in rows * columns characters
pad strings as necc w/_ or + or * or .

work in progess
*/

var c = document.getElementById("c");
var ctx = c.getContext("2d");

                        // 2 rows x 21 columns = 42
                        // 4 rows x 21 columns = 84
                        // 9 rows x 9 columns  = 81
                        // 9 rows x 10 columns  = 90
var rows = 4;
var columns = 21;
var font_size = 18;     // relative sizes depend on font_size [18]
var font_leading = 21;  // [21]
var timer;              // update
var delay;              // pause between messages
// var timer_ms = 30;      // ms before next update [30]
// var delay_ms = 3000;    // ms after msg complete
var timer_ms = 30;      // ms before next update [30]
var delay_ms = 6000;    // ms after msg complete
var updates = 0;        // counter
var pointer = 0;
// var msg = msgs.substr(pointer,rows*columns).toUpperCase().split("");
var msg = msgs.substr(pointer,rows*columns).split("");
console.log(msg);
// var msgs_array from .php
// msgs_array = msgs_array.join('');     // array to string
msgs = msgs_array.join('');     // array to string
// msgs = msgs.join('').toUpperCase().split("");
// msgs = msgs.toUpperCase().split('');
msgs = msgs.toUpperCase();      // temp force all to upper case
msgs = msgs.split('');


// ** fix **

var letters = [];
var words = [];
// words = msgs_array[0].toUpperCase().split(' ');
words = msgs_array[0].split(' ');

// console.log(msgs_array);
// console.log(msgs_array);
// console.log(words);

c.height = font_size * rows * 3;
c.width = font_size * columns;
c.onclick = stop_start;

function update() {
    ctx.font = font_size + "px helveticaocr";
    // ctx.font = font_size + "px relative10_pitch";
    // ctx.fillStyle = "#FFF";
    ctx.fillStyle = "#000";
    ctx.rect(0,0,c.width, c.height);
    ctx.fill();

    // display, compare to random letter
    var i;  // index to current position in letters
    for (var y = 0; y < rows; y++) {
        for (var x = 0; x < columns; x++) {
            i = x+y*columns;
            if ((letters[i] !== msg[i]) && (updates <= 50)) {
                letters[i] = msgs[Math.floor(Math.random()*msgs.length)];   // one random char
                // ctx.fillStyle = "rgba(255, 255, 255, .75)";
                ctx.fillStyle = "rgba(0, 0, 0, .75)";
                ctx.fillRect(x*font_size, y*font_leading, font_size, font_leading);
                // ctx.fillStyle = "#000";
                ctx.fillStyle = "#FF0";
                ctx.fillText(letters[i], x*font_size, (y+1)*(font_leading));
            } else {
                letters[i] = msg[i];
                // ctx.fillStyle = "rgba(255, 255, 255, 1.0)";
                // ctx.fillRect(x*font_size, y*font_leading, font_size, font_leading);
                // ctx.fillStyle = "#00F";
                ctx.fillStyle = "#FF0";
                ctx.fillText(letters[i], x*font_size, (y+1)*font_leading);
            }
        }
    }

    // all letters resolved or timed out, move to next msg
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
        // msg = msgs.join('').substr(pointer,columns*rows).toUpperCase().split('');
        msg = msgs.join('').substr(pointer,columns*rows).split('');
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
