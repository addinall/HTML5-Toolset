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
//              to do anything about it!  So, 11 years on,
//              let's address this.
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
//              It was developed using PHP 5.4.13 (cli)
//              I like to debug on the command line.  MUCH
//              faster than an IDE.
//
//              The framework produces well formed HTML5 and CSS3
//              that validate out of the box (W3C standards).
//
//              Markup CAN be added to the text that form the
//              Content sections of the application, however
//              I frown on this so DON'T DO IT.
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
                    $application->cms('index','logo');              // insert the content.
                    $application->cms('index','description');       // logo and description
                $application->close_logo();                         // shut down the logo div
                $application->add_navigation();                     // whatever nav structure the theme defines
                    $application->add_nav_item("Home","#");         // start to build the menu
                    $application->add_nav_item("eHealth",
                                    "http://ehealth.addinall.org");
                    $application->add_nav_item("Movies",
                                    "http://movies.addinall.org");
                    $application->add_nav_item("DJs",
                                    "http://www.crosscitydjs.com.au");
                    $application->add_nav_item("Contact",
                                                "contact.php");
                $application->close_navigation();                   // close off the menu
                $application->add_heros();                          // HERO slider section, can be blank
                    $application->cms('index','hero');              // insert the content.  images and forms if
                $application->close_heros();                        // shut down banner slider
            $application->close_header();                           // and close of the HEADER div
            $applications->add_column_one();                        // this is a ONE to TWO column application,
                                                                    // with the CSS theming, and the content that
                                                                    // has been added in the CMS system, the code here
                                                                    // doesn't change when developing a new application.
                                                                    // that way, we only ever get to fix syntax errors
                                                                    // and spelling mistakes once, not every
                                                                    // application we write.  This will change into
                                                                    // a THREE column model in the near future when
                                                                    // I have the RESPONSIVENESS mapped out without
                                                                    // errors on a few devices and screen sizes.
                $application->cms('index', 'col_one');              // insert the content.  images and forms if
                                                                    // used are directly coded into the content
                                                                    // using HTML5.  NO inline CSS allowed
            $application->close_column_one();                       // close of first column
            $application->add_column_two();                         // second screen part
                $application->add_widget('social_buttons');         // stick the various 'likes' in the column, 
                                                                    // change this to suit
                $application->cms('index', 'col_two');              // add the content
                $application->add_widget('flickr');                 // add a flickr widget, change this to suit
            $application->close_column_two();                       // and close it

            $application->add_footer();                             // finally, add the footer
                $application->cms('index', 'footer');               // add the content
            $application->close_footer();                           // and close it
        $application->close_wrapper();                              // close out wrapper
    $application->close_body();                                     // close out the body
$application->close_HTML5();                                        // close off the application
$application->run();                                                // go and do it then
?>


