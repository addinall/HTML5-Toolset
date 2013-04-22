// vim: set expandtab tabstop=4 shiftwidth=4 autoindent smartindent:
//---------------------------------------------------------
// CAPTAIN  SLOG
//---------------------------------------------------------
//
<<<<<<< HEAD
//  FILE:       hero.js
//  SYSTEM:     My new Websiite 
//  AUTHOR:     Mark Addinall
//  DATE:       22/04/2013
//  SYNOPSIS:   After using sliders for many many years,
//              I could never figure out why they where 
//              so big fat and ugly.  So as part of the
//              toolkit rewrite, a tiny little hero slider.
=======
//	FILE:       hero.js
//	SYSTEM:     My new Websiite 
//	AUTHOR:     Mark Addinall
//	DATE:       22/04/2013
//	SYNOPSIS:   After using sliders for many many years,
//				I could never figure out why they where 
//				so big fat and ugly.  So as part of the
//				toolkit rewrite, a tiny little hero slider.
>>>>>>> 5cb952f78489c2bcda2770a35ec2aa81dd8faa27
//
//
//------------+-------------------------------+------------
// DATE       |    CHANGE                     |    WHO
//------------+-------------------------------+------------
// 22/04/2013 | Initial creation              |  MA
//------------+-------------------------------+------------
//
//

(function($){
<<<<<<< HEAD
    $.fn.Hero = function(interval) {                    // extend jQuery

    var slides;                                         // array of hero slides
    var number;
    var index;

    //--------------
    function run() {

        // hide previous image and showing next
        $(slides[index]).fadeOut(1000);
        index++;

        if (index >= number) { 
            index = 0;
        }

        $(slides[index]).fadeIn(1000);

        // loop
        setTimeout(run, interval);
    }

    slides = $('#hero').children();
    number = slides.length;
    index=0;

    setTimeout(run, interval);
    };
=======
	$.fn.Hero = function(interval) {					// extend jQuery

	var slides;											// array of hero slides
	var number;
	var index;

	//--------------
	function run() {

		// hide previous image and showing next
		$(slides[index]).fadeOut(1000);
		index++;

		if (index >= number) { 
			index = 0;
		}

		$(slides[index]).fadeIn(1000);

		// loop
		setTimeout(run, interval);
	}

	slides = $('#hero').children();
	number = slides.length;
	index=0;

	setTimeout(run, interval);
	};
>>>>>>> 5cb952f78489c2bcda2770a35ec2aa81dd8faa27
})(jQuery);

//
//jQuery(window).load(function() {
//$('.hero').Hero(3000);
//});

