/*
    new york consolidated
    matrix rain flipboard

    adapted from https://codepen.io/P3R0/pen/MwgoKv

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

    values passed from html query:

        query_bg_color
        query_color_changing
        query_color_settled
        query_rows
        query_columns
        query_font_size
        query_font

    values passed from php

        msgs
*/

var c = document.getElementById("c");
var ctx = c.getContext("2d");

var rows = query_rows;                  // [4] 
var columns = query_columns;            // [21]

var font_size = query_font_size;        // [18] 24 36 48
var font_leading = font_size * 1.1667;  // [21]
var font = query_font;

var timer;              // update
var delay;              // pause between messages
var timer_ms = 30;      // ms before next update [30]
var delay_ms = 6000;    // ms after msg complete
var updates = 0;        // counter
var pointer = 0;

var msg = msgs.substr(pointer,rows*columns).split("");
msgs = msgs_array.join('');     // array to string
msgs = msgs.toUpperCase();      // all to upper case
msgs = msgs.split('');
var letters = [];
var words = [];
words = msgs_array[0].split(' ');

c.height = font_leading * rows + 20;
c.width = font_size * columns;
c.onclick = stop_start;

var sMask = document.getElementById('mask');
sMask.style.height = c.height+'px';

function update() {
    ctx.font = font_size + "px " + font;
    ctx.fillStyle = "rgb("+query_bg_color+")";
    ctx.rect(0,0,c.width, c.height);
    ctx.fill();
    // display, compare to random letter
    var i;          
    for (var y = 0; y < rows; y++) {
        for (var x = 0; x < columns; x++) {
            i = x+y*columns;
            if ((letters[i] !== msg[i]) && (updates <= 50)) {
                letters[i] = msgs[Math.floor(Math.random()*msgs.length)];   // one random char
                ctx.fillStyle = "rgba("+query_bg_color+", .75)";
                ctx.fillRect(x*font_size, y*font_leading, font_size, font_leading);
                ctx.fillStyle = query_color_changing;
                ctx.fillText(letters[i], x*font_size, (y+1)*(font_leading));
            } else {
                letters[i] = msg[i];
                if(typeof letters[i] == 'undefined'){
                    ctx.fillStyle = query_color_settled;
                    ctx.fillText(' ', x*font_size, (y+1)*(font_leading));
                } else {
                    ctx.fillStyle = query_color_settled;
                    ctx.fillText(letters[i], x*font_size, (y+1)*font_leading);
                }
            }
        }
    }
    // all letters resolved or timed out, move to next msg
    if (letters.join('') == msg.join('')) {
        clearInterval(timer);
        delay = setInterval(stop_start, delay_ms);
        letters = [];
        pointer += msg.length;
        if (pointer >= msgs.length)
            pointer = 0;
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
// var timer = setInterval(update, timer_ms);
