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
var rows = query_rows;                  // [4] 
var columns = query_columns;            // [21]
var font = query_font;
var font_size = query_font_size;        // [18] 24 36 48
var font_leading = font_size * 1.1667;  // [21]
var font_w_to_h = .605;                 // helveticaautospaced
var font_letterspacing = 10;            // 5 [7] 10 20

document.body.style.background = bg_color;
document.body.style.color = color;
document.body.style.fontFamily = font;

var timer;                  // update
var delay;                  // pause between messages
var timer_ms = 50;          // ms before next update [30] 50
var delay_ms = 5000;        // ms after msg complete 1000 5000 [6000]
var updates = 0;            // counter
var updates_max = 50;       // times to try to match letter [50]
var pointer = 0;

var d = document.getElementById('d');
d.style.fontSize = font_size + 'px'; 
d.style.letterSpacing = font_letterspacing + 'px'; 
d.style.width = (font_w_to_h * font_size * columns) +
                (font_letterspacing * columns) + 'px';
d.style.height = font_leading * rows + 'px';
// d.style.backgroundColor = '#00F';
d.onclick = stop_start;

var mask = document.getElementById('mask');
mask.style.height = d.style.height;
mask.style.width = d.style.width;

var click = click_load();       // soundjs

var isBeginning = true;     


function update() {

    click_();   // play sound (soundjs)
    
// -----> ** fix **
// init * should this be moved? *    
// isBeginning in setInterval calls -- variable closure?
// console.log(isBeginning);

    if(isBeginning){
        update_msgs_opening();
        update_msgs(isBeginning);
        msgs = msgs_temp;
        msgs_array = msgs_array_temp;
        msg = msgs.join('').substr(pointer,columns*rows).split('');
        isBeginning = false;
    }

    // display, compare to random letter
    var i;          
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
        if (pointer >= msgs.length - 100){
            pointer = 0;

// ----> ** fix **
// never gets here on the last one ... 
console.log('finished');

            isBeginning = true;
            call_request_json();
        }
        call_update_cache_mtime();
        msg = msgs.join('').substr(pointer,columns*rows).split('');
        timer = false;
        updates = 0;
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
