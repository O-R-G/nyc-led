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
var letters = [];
var words = [];

var bg_color = query_bg_color;
var color = query_color;
var rows;
var columns;
var font = query_font;
var font_size = query_font_size;        // [18] 24 36 48
if(window.innerWidth < 768)
    font_size = 22;
var font_leading = font_size * 1.1667;  // [21]
var font_w_to_h = .605;                 // helveticaautospaced
var font_letterspacing = 10;            // 5 [7] 10 20
var font_char_w = (font_w_to_h * font_size) + font_letterspacing;

var delay;                  // pause between messages
var timer_ms = 50;          // ms before next update [30] 50
var delay_ms = 5000;        // ms after msg complete 1000 5000 [6000]. will be overwritten when the response is received.
var updates = 0;            // counter
var updates_max = 50;       // times to try to match letter [50]
var pointer = 0;
var current_position = 0;

// d_html is to add <br> in #d
var d_html = '';
// init size
// var size = init_size(42, font_char_w);
// this should be buried into init_()
// so that can be called at different sizes

if (typeof is_main_hack === "undefined") {
    var size = init_size(48, font_char_w);
} else {
    var size = init_size(1, font_char_w);
}
// if (isHome) {
//     var size = init_size(48, font_char_w);
// } else {
//     var size = init_size(1, font_char_w);
// }

// var size = init_size(48, font_char_w);

columns = size[0];
rows = size[1];

// should be cleaned up below so updates on window.resize() event

var d = document.getElementById('d');
d.style.fontSize = font_size + 'px';
d.style.letterSpacing = font_letterspacing + 'px'; 
d.style.width = (font_w_to_h * font_size * columns) +
                (font_letterspacing * columns) + 'px';
d.style.lineHeight = 1.1667 * font_size + 'px';
d.style.height = font_leading * rows + 'px';

d.onclick = stop_start;

var mask = document.getElementById('mask');
// mask.style.height = d.style.height;
// mask.style.width = d.style.width;

// hidden, but contains all text to speak
// divided by message


var click = click_load();       // soundjs

var isBeginning = true;    
var counter = 0;

function update() {
    if(isBeginning){
        if(!hasStarted){
            hasStarted = true;
        }
        else
        {
            request_live('https://now.n-y-c.org/now', isHome);
        }
        isBeginning = false;
    }
    if(counter == 0){
        d.classList.remove('waiting');
        d.classList.add('opening');
    }
    if(counter == 1){
        d.classList.remove('opening');
    }

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
    for(i = 0; i < letters.length ; i++){
        if(i % columns == 0 && i > 0)
            d_html += '<br>';
        d_html += letters[i];
    }
    d.innerHTML = d_html;
    d_html = '';
    // all letters resolved or timed out, move to next msg
    if (letters.join('') == msg.join('')) {
        clearInterval(timer);
        ticking_end = new Date();
        ticking_duration = ticking_end - ticking_start + ticking_progress;
        delay_ms = screen_interval - ticking_duration;
        delay = setInterval(stop_start, delay_ms);
        letters = [];
        pointer += msg.length;
        ticking_progress = 0;
        if(pointer == msgs.length){
            pointer = 0;
            isBeginning = true;
        }
        else if (pointer > msgs.length - columns*rows){
            // **filling the text with "—" at the last slide**
            while(msgs.length - columns*rows < pointer){
                msgs.push('•');
            }
        }
        msg = msgs.join('').substr(pointer,columns*rows).split('');
        timer = false;
        updates = 0;
        if(counter < 2)
            counter++;
        // update speak, should call speak text here also?
        // speak.innerText = msg.join('');
    } else
        updates++;
}

function stop_start() {
    if (!timer) {
        clearInterval(delay);
        delay = false;
        ticking_start = new Date();
        timer = setInterval(update, timer_ms);
    } else {
        clearInterval(timer);
        timer = false;
        ticking_progress = new Date() - ticking_start;
    }
}

function stop() {
    clearInterval(delay);
    delay = false;
    clearInterval(timer);
    timer = false;

}

// requires soundjs library in views/head
function click_load() {
    if (createjs.Sound.registerSound('/static/sounds/ding-faststart_01.mp3', 'click')) 
        return true;
}

function init_size(chars_total, char_w) {

    // takes target character count and character width
    // returns _columns, _rows
    // _columns * _rows must be <= chars_max
    // ** should be called on any window resize event **

    var size = [];
    var _w_percent = 0.75;
    var _w = window.innerWidth * _w_percent;
    var _h = window.innerHeight;

    var _columns = Math.floor(_w / (char_w * 12)) * 12;
    if(_columns == 36)
        _columns = 24;
    var _rows = Math.floor(chars_total / _columns);

    // normalize edge values
    _columns = Math.min(_columns, chars_total);
    _rows = Math.max(_rows, 1);

    size.push(_columns);
    size.push(_rows);

    return size;
}
