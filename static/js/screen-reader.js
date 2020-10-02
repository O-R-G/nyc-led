var speechStarts, speechEnds;

( function( document ) {
	'use strict';

	let isRunning = false;
	let gotLength = false;
	let focusList = [];
	let focusIndex = 0;
	var text;
	
	var utterance;
	var current_voice = 0;
	var synth = window.speechSynthesis;
	var voices = false;
	var voices_options = [];

	var speak_progress_bar = document.getElementById('speak_progress_bar');
	const mappings = {
		a: 'link',
		button: 'button',
		h2: 'heading',
		p: 'paragraph',
		html: 'page',
		img: 'image'
	};

	function computeAccessibleName( element ) {
		const content = element.textContent.trim();

		if ( element.getAttribute( 'aria-label' ) ) {
			return element.getAttribute( 'aria-label' );
		} else if ( element.getAttribute( 'alt' ) ) {
			return element.getAttribute( 'alt' );
		}

		return content;
	}

	const announcers = {
		page( element ) {
			const title = element.querySelector( 'title' ).textContent;

			say( `Page ${ title }` );
		},

		link( element ) {
			say( `Link, ${ computeAccessibleName( element ) }. To follow the link, press Enter key.` );
		},

		button( element ) {
			say( `Button, ${ computeAccessibleName( element ) }. To press the button, press Space key.` );
		},

		heading( element ) {
			const level = element.getAttribute( 'aria-level' ) || element.tagName[ 1 ];

			say( `Heading level ${ level }, ${ computeAccessibleName( element ) }` );
		},

		paragraph( element ) {
			say( element.textContent );
		},

		image( element ) {
			say( `Image, ${ computeAccessibleName( element ) }` );
		},

		default( element ) {
			// say( `${ element.tagName } element: ${ computeAccessibleName( element ) }` );
			say( `${ computeAccessibleName( element ) }` );
		}
	};

	function addStyles() {
		const styleElement = document.createElement( 'style' );

		styleElement.textContent = `[tabindex="-1"] {
			outline: none;;
		}
		[data-sr-current] {
			// outline: 5px rgba( 0, 0, 0, .7 ) solid !important;
			background-color: #ffff00 !important;
            /* 
            filter: blur(10px);
            transition: filter 2s;
            */
   		}
		html[data-sr-current] {
			outline-offset: -5px;
		}`;

		document.head.appendChild( styleElement );
	}

	function say( speech, callback ) {

		text = new SpeechSynthesisUtterance( speech );
		// const text = new SpeechSynthesisUtterance( "hello, world." );
		text.addEventListener('end', function(){
			if(isRunning){
				console.log('reload?');
			}
		});
		if ( callback ) {
			text.addEventListener('end', callback);
		}

		// a good way to find all the english voices
		// https://www.digitalocean.com/community/tutorials/how-to-build-a-text-to-speech-app-with-web-speech-api
		
		text.voice =  current_voice;
		synth.cancel();
		synth.speak( text );
		text.addEventListener('boundary', function(event){
			if(speech != 'Screen reader off' && speech != 'Screen reader on'){
				speak_progress++;
				if(speak_progress > speak_all_words.length)
					speak_progress = speak_all_words.length;
				speak_progress_bar.style.width = parseInt(speak_progress / speak_all_words.length * 1000)/10 + '%';
			}			
		});
		
	}

	function computeRole( element ) {
		const name = element.tagName.toLowerCase();

		if ( element.getAttribute( 'role' ) ) {
			return element.getAttribute( 'role' );
		}

		return mappings[ name ] || 'default';
	}

	function announceElement( element ) {
		const role = computeRole( element );

		if ( announcers[ role ] ) {
			announcers[ role ]( element );
		} else {
			announcers.default( element );
		}
	}



    /* focusList */

	function createFocusList() {
		// focusList = span.speak_word
		
		// waiting for the response...
		// if(document.querySelectorAll( 'span' ).length == 0){
		// 	setTimeout(createFocusList, 500);
		// 	return false;
		// }
		focusList.push( ...document.querySelectorAll( 'html, body >:not( [aria-hidden=true] )' ) );
		// focusList.push( ...document.querySelectorAll( 'html, body >:not( [aria-hidden=true]), span.speak_word' ) );
		focusList = focusList.filter( ( element ) => {
			const styles = getComputedStyle( element );
			if ( styles.visibility === 'hidden' || styles.display === 'none' ) {
				return false;
			}
			return true;
		} );
        // *hack* filter all except div id=speak
        // --> span.word_speak
		focusList = focusList.filter( ( element ) => {
			// console.log(element);
			if ( element.id !== 'speak' ) {
				return false;
			}
			else{ 
				if(!isHome){
					speak_all_words = document.getElementById('speak').innerText.split(/\s+/);
					// console.log(speak_all_words);
				}
			}
			// if ( !element.classList.contains('speak_word')) {
			// 	return false;
			// }

			return true;
		} );

        /*
		focusList.forEach( function (element) {
            console.log('filtered element.id ------> ' + element.id);
        } );
        */

		focusList.forEach( ( element ) => {
			element.setAttribute( 'tabindex', element.tabIndex );
		} );
	}

	function getActiveElement() {
		if ( document.activeElement && document.activeElement !== document.body ) {
			return document.activeElement;
		}
		return focusList[ 0 ];
	}

	function focus( element ) {
		if ( element === document.body ) {
			element = document.documentElement;
		}

		element.setAttribute( 'data-sr-current', true );
		element.focus();

// console.log('======> ' + element.id);

		announceElement( element );
	}

	function moveFocus( offset ) {
		const last = document.querySelector( '[data-sr-current]' );
		if ( last ) {
			last.removeAttribute( 'data-sr-current' );
		}

		if ( offset instanceof HTMLElement ) {
			focusIndex = focusList.findIndex( ( element ) => {
				return element === offset;
			} );
			// console.log('offset = '+offset);
			return focus( offset );
		}

		focusIndex = focusIndex + offset;

		if ( focusIndex < 0 ) {
			focusIndex = focusList.length - 1;
		} else if ( focusIndex > focusList.length - 1 ) {
			focusIndex = 0;
		}

		// this works with a option tab so could set timeout maybe
		// force to use div id='speak' ** hack **
		// focusIndex = 2;
		console.log('focusList ------> ' + focusList);
		console.log('focusIndex =====> ' + focusIndex);
		focus( focusList[ focusIndex ] );
	}
	
	function start(screen_reader_switch) {
		screen_reader_switch.classList.add('active');
		
		say( 'Screen reader on', () => {
			moveFocus( getActiveElement() );
			isRunning = true;
		} );
	}

	function stop() {
		const current = document.querySelector( '[data-sr-current]' );
		screen_reader_switch.classList.remove('active');
		if ( current ) {
			current.removeAttribute( 'data-sr-current' );
		}

		focusIndex = 0;
		isRunning = false;
		synth.cancel();
		say( 'Screen reader off' );
		speak_progress_bar.style.width = 0;
		speak.innerText = msg_speak;
		speak_progress = 0;
	}

	function keyDownHandler( evt ) {
		// if ( evt.altKey && evt.keyCode === 82 ) {
		// 	evt.preventDefault();

		// 	if ( !isRunning ) {
		// 		start();
		// 	} else {
		// 		stop();
		// 	}
		// }

		if ( !isRunning ) {
			return false;
		}

		if ( evt.keyCode === 32 ) {
			evt.preventDefault();
			moveFocus( evt.shiftKey ? -1 : 1 );
		} else if ( evt.keyCode === 9 ) {
			setTimeout( () => {
				moveFocus( document.activeElement );
			}, 0 );
		}
	}
	
	addStyles();
	createFocusList();
	document.addEventListener( 'keydown', keyDownHandler );
	var screen_reader_switch = document.getElementById('screen-reader-switch');
	var voice_option_ctner =document.getElementById('voice_option_ctner');

	screen_reader_switch.addEventListener('click', function(){
		if( !isRunning ) {
			// voice_option_ctner.classList.add('expanded');
			
			start(screen_reader_switch);
		} else {
			// voice_option_ctner.classList.remove('expanded');
			stop(screen_reader_switch);
		}
	});


	// synth.getVoices(); only workd in setTimeout(0) 
	setTimeout(function(){
		if(!voices){
			voices = synth.getVoices();
			for(var i = 0; i<voices.length; i++ ){
				if(	voices[i]['name'] == 'Samantha' ||
					voices[i]['name'] == 'Vicky' ||
					voices[i]['name'] == 'Google US English'){
					voices_options.push(voices[i]);
					if(current_voice == 0){
						current_voice = voices[i];
					}
					// console.log(current_voice);
				}
			}
			// current_voice = voices_options[0][];
			// for(var i = 0; i< voices_options.length ; i++){
			// 	var this_option = document.createElement('div');
			// 	this_option.className = 'voice_option';
			// 	this_option.innerText = voices_options[i]['name'].toUpperCase();
			// 	this_option.setAttribute('voice', i);
			// 	// if(i == 0)
			// 	// 	this_option.classList.add('current');
			// 	voice_option_ctner.appendChild(this_option);
			// }
			// var sVoice_option = document.getElementsByClassName('voice_option');
			// Array.prototype.forEach.call(sVoice_option, function(el, i){
		 //        el.addEventListener('click', function(){
		 //        	if(isRunning)
		 //        		stop();
		 //        	var sCurrent = document.querySelector('.voice_option.current');
		 //        	if(sCurrent != null)
		 //        		sCurrent.classList.remove('current');
		 //        	if(sCurrent == el){
		 //        		stop();
		 //        		return false;
		 //        	}
		 //        	el.classList.add('current');
		 //            var this_voice = parseInt(el.getAttribute('voice'));
		 //            current_voice = this_voice;
		 //            isRunning = true;
		 //            setTimeout(start, 500);

		 //        });
		 //    });
		}
	}, 50);
	


}( document ) );