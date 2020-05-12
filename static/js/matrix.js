/*
    new york consolidated
    matrix rain flipboard

    adapted from https://codepen.io/P3R0/pen/MwgoKv
    now using d-o-m instead of canvas

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
        letters
        words
*/

var rows = query_rows;                  // [4] 
var columns = query_columns;            // [21]
var font_size = query_font_size;        // [18] 24 36 48
var font_leading = font_size * 1.1667;  // [21]
var font = query_font;
var timer;                  // update
var delay;                  // pause between messages
var timer_ms = 30;          // ms before next update [30]
var delay_ms = 6000;        // ms after msg complete
var updates = 0;            // counter
var updates_max = 50;       // times to try to match letter [50]
var pointer = 0;

var d = document.getElementById('d');

// ** fix **  ----->
// currently uses letter-spacing to accommodate (in main.css)
// could use proportion of the letter to do the same thing
// then possibly adjust letter-spacing after that
d.style.width = font_size * columns + 'px';     // ** fix **
d.style.height = font_leading * rows + 20 + 'px';  // ** fix **

d.style.fontSize = font_size + 'px';
// d.style.backgroundColor = '#00F';        // debug
d.innerHTML = '••••••••••••••••••';   
d.onclick = stop_start;

var mask = document.getElementById('mask');
mask.style.height = d.style.height;
mask.style.width = d.style.width;         

// this has to do with how it reloads ... ** fix **
var isBeginning = true;     /* fix */

function update() {
    // init * should this be moved? *
    if(isBeginning){
        update_msgs_opening();
        update_msgs(isBeginning);
        msgs = msgs_temp;
        msgs_array = msgs_array_temp;
        msg = msgs.join('').substr(pointer,columns*rows).split('');
        isBeginning = false;
    }

// ** debug **
// this is drawing in funny places on screen ** fix **
// the issue is to do with length of msg[] and length of letters[]
// and seems to happen in consistent positions
console.log(msg.join('').length + ' : ' + msg.join(''));

    // display, compare to random letter
    var i;          
    for (var y = 0; y < rows; y++) {
        for (var x = 0; x < columns; x++) {
            i = (y * columns) + x;
            if ((letters[i] !== msg[i]) && (updates <= updates_max)) {
                letters[i] = msgs[Math.floor(Math.random()*msgs.length)];   // one random char
            } else {
                letters[i] = msg[i];                

// ** debug **
// these are the consistent positions (see above)
if ((i == 21) || (i == 42) || (i == 63))
    console.log('---->' + i + ' : ' + letters[i]);

                if(typeof letters[i] == 'undefined')
                    letters[i] = '•';
            }
        }
    }

// ** check / compare speed ** ---->
    // d.innerText = letters.join('');
    d.innerHTML = letters.join('');

    // all letters resolved or timed out, move to next msg
    if (letters.join('') == msg.join('')) {
        clearInterval(timer);
        delay = setInterval(stop_start, delay_ms);
        letters = [];
        pointer += msg.length;
        if (pointer >= msgs.length){
            pointer = 0;
            isBeginning = true;
            call_request_json();
        }
        // update_msgs();
        call_update_cache_mtime();
        msg = msgs.join('').substr(pointer,columns*rows).split('');
        timer = false;
        updates = 0;
    } else
        updates++;

// how when to reload?
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

// ** fix ** -----> 
// how does this start now?
// > grep -rE 'setInterval' *
// start
// var timer = setInterval(update, timer_ms);
