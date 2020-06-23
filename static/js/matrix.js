/*
    new york consolidated
    matrix flipboard

    from query string:
    query_bg_color    
    query_color
    query_rows
    query_columns
    query_font
    query_font_size        

    from msgs.js:
    msg[]       text to be shown

    triggered static/js/json.js:
    var timer = setInterval(update, timer_ms);
*/

var bg_color = query_bg_color;
var color = query_color;
var rows;
var columns;
var font = query_font;
var font_size = query_font_size;        // [18] 24 36 48
var font_leading = font_size * 1.1667;  // [21]
var font_w_to_h = .605;                 // helveticaautospaced
var font_letterspacing = 10;            // 5 [7] 10 20
var font_char_w = (font_w_to_h * font_size) + font_letterspacing;

// document.body.style.background = bg_color;
document.body.style.color = color;
document.body.style.fontFamily = font;

var timer;                  // update
var delay;                  // pause between messages
var timer_ms = 50;          // ms before next update [30] 50
var delay_ms = 5000;        // ms after msg complete 1000 5000 [6000]. will be overwritten when the response is received.
var updates = 0;            // counter
var updates_max = 50;       // times to try to match letter [50]
var pointer = 0;
var current_position = 0;
// init size
// var size = init_size(42, font_char_w);
// this should be buried into init_()
// so that can be called at different sizes
if (typeof is_main_hack === "undefined") {
    var size = init_size2(48, font_char_w);
} else {
    var size = init_size2(1, font_char_w);
}

columns = size[0];
rows = size[1];

console.log('*****************');
console.log('columns : ' + columns);
console.log('rows : ' + rows);
console.log('*****************');

// should be cleaned up below so updates on window.resize() event
 
var d = document.getElementById('d');
d.style.fontSize = font_size + 'px'; 
d.style.letterSpacing = font_letterspacing + 'px'; 
d.style.width = (font_w_to_h * font_size * columns) +
                (font_letterspacing * columns) + 'px';
d.style.height = font_leading * rows + 'px';
d.onclick = stop_start;

var mask = document.getElementById('mask');
mask.style.height = d.style.height;
mask.style.width = d.style.width;

// hidden, but contains all text to speak
// divided by message
var speak = document.getElementById('speak');

var click = click_load();       // soundjs

var isBeginning = true;     


function update() {
    click_();   // play sound (soundjs)
// -----> ** fix **
// init * should this be moved? *    
// isBeginning in setInterval calls -- variable closure?
// console.log(isBeginning);

    if(isBeginning){
        console.log('isBeginning');
        // **set msgs back to the original string without placeholder blocks.**
        // var msgs_temp = ;
        msgs = msgs_original;
        
        // update_msgs_opening();
        // update_msgs(isBeginning);
        // msgs = response_msgs.split('');
        // msgs_array = msgs_array_temp;
        msg = msgs.join('').substr(pointer,columns*rows).split('');
        isBeginning = false;

        // print whole msg to speak
        speak.innerText = msg.join('');
    }
    // console.log(msgs);
    // console.log(msg);
    // display, compare to random letter
    
    var i;
    // console.log(letters);
    // console.log(msgs);
    for (var y = 0; y < rows; y++) {
        for (var x = 0; x < columns; x++) {
            i = (y * columns) + x;
            if ((letters[i] !== msg[i]) && (updates <= updates_max)) {
                letters[i] = msgs[Math.floor(Math.random()*msgs.length)];   // one random char
            } else {
                letters[i] = msg[i];
                if(typeof letters[i] == 'undefined')
                    letters[i] = '•';
            }
        }
    }

    d.innerText = letters.join('');

    // all letters resolved or timed out, move to next msg
    if (letters.join('') == msg.join('')) {
        clearInterval(timer);
        delay = setInterval(stop_start, delay_ms);
        letters = [];
        pointer += msg.length;

console.log('msgs.length : ' + msgs.length);
console.log('pointer : ' + pointer);
        // if (pointer >= msgs.length){
// ----> ** fix **
// hack !
// somehow there are extra characters in msgs beyond this count
// maybe because does not add chars when fills out empty spaces?
// not sure
        if(pointer == msgs.length){
            console.log('finished');
            pointer = 0;
            isBeginning = true;
        }
        else if (pointer > msgs.length - columns*rows){
            // **filling the text with "—" at the last slide**
            while(msgs.length - columns*rows < pointer){
                msgs.push('•');
            }
// ----> ** fix **
// never gets here on the last one ... 
            // call_request_json();
        }
        // call_update_cache_mtime();
        msg = msgs.join('').substr(pointer,columns*rows).split('');
        timer = false;
        updates = 0;

        // update speak, should call speak text here also?
        // speak.innerText = msg.join('');
        speak.innerText = msgs.join('');
    } else
        updates++;
}

// ** fix ** something funky here
// maybe how the body click is received
// or multiple timers?

function stop_start() {
    if (!timer) {
        clearInterval(delay);
        delay = false;
        timer = setInterval(update, timer_ms);
    } else {
        clearInterval(timer);
        timer = false;
    }
    click_();
}

function stop() {
    clearInterval(delay);
    delay = false;
    clearInterval(timer);
    timer = false;
    click_();
}

// requires soundjs library in views/head
function click_load() {
    if (createjs.Sound.registerSound('/static/sounds/ding-faststart_01.mp3', 'click')) 
        return true;
}

function click_() {
    // createjs.Sound.play('click');
}

function init_size(chars_max, char_w) {

    // takes target character count and character width
    // returns _columns, _rows
    // _columns * _rows must be <= chars_max
    // ** should be called on any window resize event **

    var size = [];
    var _w_percent = 0.75;
    var _w = window.innerWidth * _w_percent;
    var _h = window.innerHeight;

    var _columns = Math.floor(_w / char_w);
    var _rows = Math.floor(chars_max / _columns);

    // normalize edge values
    _columns = Math.min(_columns, chars_max);
    _rows = Math.max(_rows, 1);

    console.log('_w : ' + _w);
    console.log('_h : ' + _h);
    console.log('char_w : ' + char_w);
    console.log('chars_max : ' + chars_max);
    console.log('_columns : ' + _columns);
    console.log('_rows : ' + _rows);

    size.push(_columns);
    size.push(_rows);

    return size;
}

function init_size2(chars_total, char_w) {

    // takes target character count and character width
    // returns _columns, _rows
    // _columns * _rows must be <= chars_max
    // ** should be called on any window resize event **

    var size = [];
    var _w_percent = 0.75;
    var _w = window.innerWidth * _w_percent;
    var _h = window.innerHeight;

    var _columns = Math.floor(_w / (char_w * 12)) * 12;
    
    var _rows = Math.floor(chars_total / _columns);

    // normalize edge values
    _columns = Math.min(_columns, chars_total);
    _rows = Math.max(_rows, 1);

    console.log('_w : ' + _w);
    console.log('_h : ' + _h);
    console.log('char_w : ' + char_w);
    console.log('chars_total : ' + chars_total);
    console.log('_columns : ' + _columns);
    console.log('_rows : ' + _rows);

    size.push(_columns);
    size.push(_rows);

    return size;
}
