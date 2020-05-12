/*
    new york consolidated
    matrix flipboard

    from query string:
    query_bg_color    
    query_color_changing    
    query_color_settled
    query_rows
    query_columns
    query_font_size        
    query_font

    from msgs.js:
    msg[]       text to be shown

    currently triggered from static/js/json.js:
    var timer = setInterval(update, timer_ms);
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
d.innerHTML = '••••••••••••••••••'; 
d.onclick = stop_start;

var mask = document.getElementById('mask');
mask.style.height = d.style.height;
mask.style.width = d.style.width;

var isBeginning = true;     

function update() {
    // init * should this be moved? *
    // isBeginning is the problem, likely to do with variable closure
    // in setInterval calls
    console.log(isBeginning);

    if(isBeginning){
        update_msgs_opening();
        update_msgs(isBeginning);
        msgs = msgs_temp;
        msgs_array = msgs_array_temp;
        msg = msgs.join('').substr(pointer,columns*rows).split('');
        isBeginning = false;
    }

// html swallows the repeated spaces
// even though css white-space: pre-wrap
// so replace every ' ' with \xa0
// \xa0 == non-breaking space (&nbsp)
// ugly way for now, before reworking 
// update_msgs() and update_msgs_opening()

// now does not match on \xa0 when comparing to ' ' below
// damn!

// msg_str = msg.join('').replace(/ /g, '\xa0');
msg_str = msg.join('').replace(/ /g, '•');
msg = msg_str.split('');
// console.log(msg_str);
// console.log(msg);

    // display, compare to random letter
    var i;          
    for (var y = 0; y < rows; y++) {
        for (var x = 0; x < columns; x++) {
            i = (y * columns) + x;
            if ((letters[i] !== msg[i]) && (updates <= updates_max)) {
                letters[i] = msgs[Math.floor(Math.random()*msgs.length)];   // one random char
            } else {
                // letters[i] = msg[i];                
                letters[i] = i % 10;

// ** debug **
// so this above is not counting the right numbers when working through ... 
// actually just not drawing the correct number of columns
// which was juryrigged above using letterspacing so also need to sort that
// maybe is ignoring spaces?
// these are the consistent positions (see above)
// first column of each row
    
// if ((i == 21) || (i == 42) || (i == 63))
//     console.log('---->' + i + ' : ' + letters[i]);

                if(typeof letters[i] == 'undefined')
                    letters[i] = '•';
            }
        }
    }

    // check / compare speed ----> ** fix **
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
// never gets here on the last one ... 
// may have to do with collapsing whitespace and removing blanks at end-of-line
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
