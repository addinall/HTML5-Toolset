<?php
// vim: set expandtab tabstop=4 shiftwidth=4 autoindent smartindent:
//---------------------------------------------------------
// CAPTAIN  SLOG
//---------------------------------------------------------
//
//  FILE:       index.php 
//  SYSTEM:     New Toolset 
//  AUTHOR:     Mark Addinall
//  DATE:       22/03/2013
//  SYNOPSIS:   I put up a HTML website for myself in
//              2002.  I put about six hours worth of
//              work into it and never touched it again.
//              It looks and feels like crap, but I never
//              seemed to have the time nor inclination
//              to do anything about it!  
//              So, 11 years on, let's address this.
//
//              This is going to be a RESPONSIVE, lightweight
//              site based on CSS3 and HTML5.  I have been 
//              playing with this technology in the past,
//              so it is time to implement it in a BRAND
//              SPANKING NEW website of my very own!
//
//              Being RESPONSIVE means that this new code will adjust
//              to differing platforms, pads, pods and telephones
//              as well as the traditional computer based browser.
//
//              My new website is merely a test bed to get
//              this new set of objects and Framework happening.
//              It is intended to replace all previous objects.php,
//              config.php and the general CMS with this new system.
//
//              I have catered for IE8, but only just.  I don't
//              care about older browsers.  This is a HTML5 / CSS3
//              Framework and system.  It requires PHP 5.x
//
//              The AJaX routines, DOM manipulation and dynamic forms are all
//              coded using the jQuery Javascript library.
//
//              Testing moved this lot to Fedora 19 during August 2013
//              
//              It was developed using PHP 5.4.13 (cli)
//              I like to debug on the command line.  MUCH
//              faster than an IDE.
//
//              The framework produces well formed HTML5 and CSS3
//              that validate out of the box (W3C standards).
//
//              WHY do I code my framework using a classic OOD/OOP
//              paradigm aka OBJECTs that ENCAPSULATE like METHODS
//              and PROPERTIES.  All of the PROPERTIES within the
//              OBJECTs are accessable by MUTATORs and ACCESSORs
//              rather than an MVC architecture?
//
//              1.  MVC isn't OOD/OOP.  Not even close.  I really do
//                  not understand HOW people can mention the two
//                  approaches in the same breath.
//              2.  MVC produces crap code that is a nightmare to
//                  debug and maintain.  FAR too many methods are
//                  hidden from plain view.  There is no relation
//                  to Top Down Stepwise Refinement techniques
//                  that were the Grandaddy of OOD circa Ada.
//                  Or even PL/1.
//              3.  MVC is arse about.  GOOD computer programs
//                  worry about the DATA structures first AND
//                  THEN build the OOP structures around clean
//                  and simple DATA STRUCTURES.  I would have thought
//                  this a bit obvious.  MVC tacks on database at the
//                  very end of the show.  And you end up with
//                  40 line cursors sprinkled through the code
//                  doing an obscene amount of JOINS, UNIONS and
//                  other such crap.  Not required.
//                  Algorithms + Data STructures = Programs
//                  Niklaus Wirth - 1985
//
//                  "Yet, this book starts with a chapter on data 
//                  structure for two reasons. First, one has an 
//                  intuitive feeling that data precede algorithms: 
//                  you must have some objects before you can perform 
//                  operations on them." 
//
//              Markup CAN be added to the text that form the
//              Content sections of the application, however
//              I frown on this so DON'T DO IT.
//
//              Why is it heavily documented?  As well as being used
//              for commercial application development, I also use
//              my code libraries as teaching aides.
//
//-----------------------------------------------------------------------------
//  Copyright (c) 2013, Mark Addinall - That's IT - QLD
//  All rights reserved.
//
//  Redistribution and use in source and binary forms, with or without
//  modification, are permitted provided that the following conditions are met:
//      * Redistributions of source code must retain the above copyright
//        notice, this list of conditions and the following disclaimer.
//      * Redistributions in binary form must reproduce the above copyright
//        notice, this list of conditions and the following disclaimer in the
//        documentation and/or other materials provided with the distribution.
//      * Neither the name of That's IT, Mark Addinall, nor the
//        names of its contributors may be used to endorse or promote products
//        derived from this software without specific prior written permission.
//
//  THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
//  ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
//  WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
//  DISCLAIMED. IN NO EVENT SHALL Mark Addinall BE LIABLE FOR ANY
//  DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
//  (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
//  LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
//  ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
//  (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
//  SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
//
//
//
//------------+-------------------------------+------------
// DATE       |    CHANGE                     |    WHO
//------------+-------------------------------+------------
// 22/03/2013 | Initial creation              |  MA
// 06/08/2013 | Resume work on the OOP        |
//            | Distracted by a few projects  |  MA
//------------+-------------------------------+------------
//
//

require_once('conf/config.php');                                    // this has some very basic primitives
                                                                    // described.  Name of the database,
                                                                    // base URL, type of database and other
                                                                    // runtime options.  the file is simple,
                                                                    // and this is the ONLY configuration
                                                                    // file we use in this framework.
                                                                    // ALL of the information is encapsulated
                                                                    // into the methods and properties of ONE
                                                                    // Configuration object.  We don't have many
                                                                    // configuration options.  KISS.

require_once('lib/prepare.inc');                                    // this is required by the IBM DB2 API
                                                                    // it does not do anything if we are not
                                                                    // a DB2 implementation.  Sets two constants
                                                                    // otherwise.  No big deal.

require_once('oop/error.php');                                      // error logging object
require_once('oop/database.php');                                   // database connectivity object
require_once('oop/cms.php');                                        // Content Management System primities
require_once('oop/forms.php');                                      // tricky dynamic forms
require_once('oop/widgets.php');                                    // a collection (small) of widget objects.
require_once('oop/html5.php');                                      // load our HTML5 document object
                                                                    // small footprint and fast loading

    $logger         = new ErrorLogger($configuration);              // turn on the error system first
    $database       = new DBMS($logger);                            // fire up the database with details
                                                                    // collected from config.php
    $content        = new CMS($database);                           // fire up the Content Management system

    $application    = new HTML5($content);                          // and create the application
                                                                    // there is a Widget class encapsulated
                                                                    // in this object

    $application->start_head();                                     // start the <head> section
        $application->load_javascript();                            // and load the correct Javascript library
                                                                    // for this application.  NB.  there will
                                                                    // be more javascript loads in THEMES
                                                                    // and FORMS.
        $application->fix_IE();                                     // munge to make IE behave in a
                                                                    // HTML5/CSS3 RESPONSIVE application
        $application->load_theme();                                 // load the correct CSS instructions
                                                                    // and the right set of images etc.
    $application->close_head();                                     // close the head section

    $application->start_body();
        $application->start_wrapper();                              // as all of this application (and future
                                                                    // applications) will have the look and
                                                                    // feel completely driven by CSS3
                                                                    // with a little jQuery to handle forms
                                                                    // and IE, this outline need not ever change.
            $application->add_header();                             // the HEADING section, NOT  <head>
                $application->add_logo();                           // the logo, can be empty
                    $application->build_logo();                     // insert the content.
                $application->close_logo();                         // shut down the logo div
                $application->add_navigation();                     // whatever nav structure the theme defines
                    $application->build_navigation();               // build an unordered list of sorts
                $application->close_navigation();                   // close off the menu
                $application->add_heros();                          // HERO slider section, can be blank
                    $application->cms_get(array('index','hero'));   // insert the content. 
                                                                    // I have been asked "why send an array
                                                                    // down to the function?".  For as much
                                                                    // as I love OOD there is a place for the
                                                                    // humble array, or list, or bag, or hash.
                                                                    // It is by far the easiest way to send
                                                                    // multiple arguments to a function.
                                                                    // the CMS object(s) manipulate the
                                                                    // database obviously, and depending where
                                                                    // and when this manipulation is asked for,
                                                                    // the arguments required can be usually
                                                                    // 2..N, where N is not a very large number,
                                                                    // but large enough to make coding a pain.
                                                                    // using an array as an argument we can:
                                                                    //    count()
                                                                    //    sizeof()
                                                                    //    foreach()
                                                                    // making the code simple and understandable.
                $application->close_heros();                        // shut down banner slider
            $application->close_header();                           // and close of the HEADER div
            $application->start_section();                          // just making W3C lint happy.  This seems to do.
                $applications->add_column_one();                    // this is a ONE to TWO column application,
                                                                    // with the CSS theming, and the content that
                                                                    // has been added in the CMS system, the code here
                                                                    // doesn't change when developing a new application.
                                                                    // that way, we only ever get to fix syntax errors
                                                                    // and spelling mistakes once, not every
                                                                    // application we write.  This will change into
                                                                    // a THREE column model in the near future when
                                                                    // I have the RESPONSIVENESS mapped out without
                                                                    // errors on a few devices and screen sizes.
                                                                    // now we get the articles stored by the CMS
                    while ($application->cms_get(array('index',
                                                         'articles',// get each article that is stored in the CMS and 
                                                    'col_one'))){}; // insert the content.  images and forms if
                                                                    // used are directly coded into the content
                                                                    // using HTML5.  NO inline CSS allowed.
                                                                    // this is the first time we have examined the
                                                                    // BOOLEAN value returned from cms_get
                                                                    // now, from various places in the frame work
                                                                    // the user can make an AJAX section like this
                    $application->ajax( 'temperature.php',          // the server side code to send a request to
                                        'GET',                      // POST or GET.  No RAW AJAX.  Makes it too hard to use
                                        'temp_div',                 // the name of the division to be manipulated
                                        'buttonclick',              // this tells our routine to display a button to hit
                                                                    // this can be a mouse event or a keyboard event
                                                                    // as well. 'keyup' 'mouseclick'
                                        'Today Outside',            // button text.  Of course the look and feel are
                                                                    // described in the CSS file of the theme we are using.
                                                                    // if the type of event is NOT a buttonclick, this
                                                                    // field is ignored
                                        'Thermometer Broken');      // this indicates to our AJAX creation routine
                                                                    // that we DO want to ALERT any errors, and display
                                                                    // this message.  If this is empty we ignore
                                                                    // jqXHR.fail events.
                                                                    // it looks a little complex, but it allows the
                                                                    // application programmer to generate multiple
                                                                    // AJAX events in the application more or less
                                                                    // at a whim.
                $application->close_column_one();                   // close of first column
            $application->end_section();                            // you can send a section id in that block
            $application->start_section();                          // start_section will take an id=value
                $application->add_column_two();                     // second screen part
                    $application->widgets->add_widget('facebook');  // stick the various 'likes' in the column, 
                    $application->widgets->add_widget('pinterest'); // stupid pictures of cats
                    $application->widgets->add_widget('googleplus');// the lads at GOOGLE use this in the SEO score...
                                                                    // change this to suit or just empty the divs
                                                                    // in the CSS descriptions
                    while ($application->cms_get(array('index',
                                                        'articles', // again, let the function know we want articles
                                                     'col_two'))){};// add the content
                    $application->widgets->add_widget('flickr');    // add a flickr widget, change this to suit
                $application->close_column_two();                   // and close it
            $application->end_section();                            // end of <article>s
            $application->add_footer();                             // finally, add the footer
                $application->cms_get(array('index', 'footer'));    // add the content
            $application->close_footer();                           // and close it
        $application->close_wrapper();                              // close out wrapper
    $application->close_body();                                     // close out the body
$application->close_HTML5();                                        // close off the application
$application->run();                                                // go and do it then
?>


