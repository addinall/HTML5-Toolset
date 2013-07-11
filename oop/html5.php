<?php
// vim: set expandtab tabstop=4 shiftwidth=4 autoindent smartindent:
//---------------------------------------------------------
// CAPTAIN  SLOG
//---------------------------------------------------------
//
//	FILE:       html5.php 
//	SYSTEM:     New Tools 
//	AUTHOR:     Mark Addinall
//	DATE:       22/03/2013
//	SYNOPSIS:   This is going to be a RESPONSIVE, lightweight
//              site based on CSS3 and HTML5.  I have been 
//              playing with this technology in the past,
//              so it is time to implement it in a BRAND
//              SPANKING NEW website of my very own!
//
//              This file is part of the new set of objects
//              I created for this, and future sites.  They
//              are not completely new as some of the objects
//              in use started out in life during 2002 and have
//              been carried across my code for years.
//
//              As mentioned, the new stuff is to be RESPONSIVE.
//              When I first started coding PHP way back when,
//              tablets and smartphones didn't exist.
//
//              This object forms the basis for the HTML5 application.
//
//              Why do it in PHP and not in plain ol' HTML?  A number
//              of reasons:
//              1.  Ass this is an APPLICATION framwork and not just
//                  a web page builder, we rely a great deal on the
//                  ability to use and manipulate dynamic data.  Having
//                  the framework built in modern PHP5 facilitates
//                  the process of Rapid Application Design.
//              2.  Having strict control over the syntax of the HTML
//                  generated we can ensure well formed HTML5 "out
//                  of the box" that will validate (W3C) and execute
//                  without error.
//
//
//------------+-------------------------------+------------
// DATE       |    CHANGE                     |    WHO
//------------+-------------------------------+------------
// 22/03/2013 | Initial creation              |  MA
//------------+-------------------------------+------------
//
//


//----------------------
class HTML5 {

private $document;          // basic HTML document
private $ajax;              // do we require AJaX?
private $content;           // a private copy of the content manager
                            // passed IN as REFERENCE
private $tab_count;         // used to format generated HTML.  The code still
                            // needs to be human readable AFTER generation.


    //-----------------------------------------
    public function __construct(CMS $content) {

        $this->content = $content;                  // make a private copy to use
        $this->document = "<!DOCTYPE html>\n\n";    // standard lead in
        $this->document .= "<html>\n\n";            // ditto
        $this->ajax = FALSE;                        // turn off AJaX by default
    
    }

    //---------------------------------
    private function tabs($tab_count) {

        // this is just an aide to provide us
        // with "pretty printing" during HTML
        // code generation.

        return str_repeat("\t", $tab_count);
    }


    //----------------------------
    public function start_head() {

        $this->document .= "<head>\n\n";
        $this->tab_count++;
        $this->document .= $this->tabs($this->tab_count) . 
                            "<meta charset='utf-8'> \n\n";

        // make sure the latest version of IE is used in versions of IE that 
        // contain multiple rendering engines. Even if a site visitor is using 
        // IE8 or IE9, it's possible that they're not using the latest rendering 
        // engine their browser contains.

        $this->document .= '<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">' .
                            "\n\n";

        // disable iPhone inital scale
        // and set up the view port area to reflect the size of the device we are on

        $this->document .= $this->tabs($this->tab_count) . 
                        "<meta name='viewport' content='width=device-width; initial-scale=1.0'> \n\n";

        // this next field will be in the CMS.  Just sticking it in here for testing purposes.

        $this->document .= $this->tabs($this->tab_count) . 
                        "<title>Toolset v4.0 - HTML5/CSS3/jQuery - Mark Addinall</title> \n\n";

        // OK.  The latest and greatest GOOGLE Analytics tracking code

        echo $this->content->config->get_google();


        $google =<<< EOT
        <script>
          var _gaq = [['_setAccount', $this->content->config->get_google()], ['_trackPageview']];
            (function(d) {
                    var g = d.createElement('script'),
                            s = d.scripts[0];
                                g.src = '//www.google-analytics.com/ga.js';
                                    s.parentNode.insertBefore(g, s);
                                      }(document));
            </script>
EOT;

        $this->document .= $this->tabs($this-tab_count) . $google . "\n\n";



    }


    //--------------------------------------------
    public function micro_data($context, $value) {
        
        
        // allow the application programmer to include
        // micro data into the structure of the document.
        // this is to appease the idiots at Google that
        // just COULD NOT leave html5 CLEAN just for a few
        // months at least.  Some dimwit at Google dreamed
        // up a brand new ontology for the addition of
        // structured data that goes to increase the SEO
        // worthiness of the page(s).


    }


    //---------------------------------
    public function load_javascript() {

        // jQuery 1.9 is significantly different to earlier versions
        // this may take some testing

        $this->document .= $this->tabs($this->tab_count) . 
                            "<script src='js/jquery-1.9.1.min.js'></script> \n\n";
       
        // now for our brand new mini hero slider

        $this->document .= $this->tabs($this->tab_count) . 
                            "<script src='js/hero.js'></script> \n\n";

    }


    //------------------------
    public function fix_IE() {

        // IE8 doesn't like HTML5.  It is tempting to ignore the thing, but there are FAR to many
        // copies of IE8 still running out in the world. This Javascript makes it behave.


        $this->document .= $this->tabs($this-tab_count) . 
        "<!--[if lt IE 9]> \n <script src='http://html5shim.googlecode.com/svn/trunk/html5.js'>"  . 
            "</script>\n <![endif]-->\n\n";

        // IE8 ALSO doesn't like the CSS media queries that are used to drive the
        // RESPONSIVE bits of the Framework/Toolset.  This next bit of Javascript
        // adds that functionality to IE8.

        $this->document .= $this->tabs($this->tab_count) . 
            "<script src='http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js'></script> \n\n";


    }


    //----------------------------
    public function load_theme() {


        // main css theme
        
        $this->document .= $this->tabs($this->tab_count) . 
            "<link href='themes/' . $this->content->get_theme() . '/style.css' rel='stylesheet' type='text/css'> \n";

        // media queries css

        $this->document .= $this->tabs($this->tab_count) . 
            "<link href='themes/' . $this->content->get_theme() . '/media-queries.css' rel='stylesheet' type='text/css'> \n\n";

        // css theme for the hero slider
        
        $this->document .= $this->tabs($this->tab_count) . 
            "<link href='themes/' . $this->content->get_theme() . '/hero.css' rel='stylesheet' type='text/css'> \n\n";

    }


    //----------------------------
    public function close_head() {

        $this->tab_count--;
        $this->document .= "</head> \n\n";

    }


    //----------------------------
    public function start_body() {

        $this->document .= "<body> \n\n";
        $this->tab_count++;
    }


    //-------------------------------
    public function start_wrapper() {

        $this->document .= $this->tabs($this->tabcount) . "<div id='wrapper'> \n";
        $this->tab_count++;

    }


    //----------------------------   
    public function add_header() {

        $this->document .= $this->tabs($this->tab_count) . "<header id='header'> \n";
        $this->tab_count++;

    }


    //--------------------------
    public function add_logo() {

        $this->document .= $this->tabs($this->tab_count) . "<hgroup> \n";
        $this->tab_count++;
        
    }


    //----------------------------
    public function build_logo() {

			$this->document .= $this->tabs($this->tab_count) . 
                "h1 id='logo'>$this->content->get('index','logo')</h1> \n";
			$this->document .= $this->tabs($this-tab_count) . 
                "<h2 id='description'>$this->content->get('index', 'description')</h2> \n";

    }

    //----------------------------
    public function close_logo() {

        $this->tab_count--;
        $this->document .= $this->tabs($this->tab_count) . "</hgroup> \n";

    }

    //---------------------------
    public function add_heros() {


    }


    //-----------------------------
    public function close_heros() {


    }



    //-------------------------------
    public function close_headers() {

        $this->tab_count--;
        $this->document .= $this->tabs($this->tab_count) . "</header> \n";

    
    }

    //-------------------------------------------
    public function add_navigation($menu_items) {

        
        $this->document .= $this->tabs($this->tab_count) . "<nav> \n";
        $this->tab_count++;


        $this->tab_count--;
        $this->document .= $this->tabs($this->tab_count) . "</nav> \n";
    }



    //----------------------------------
    public function ajax($script,
                         $type,
                         $div_name,
                         $event,
                         $optional_text,
                         $error_alarm) {

    // this method allows the application programmer a convenient
    // way of implementing ajax DOM areas and functionality
    // from within the application framework.
    //
    // script           - the name of the script of program to execute
    // type             - POST or GET
    // div_name         - DOM <div> for the result
    // optional text    - if this is to be a button event, the this will
    //                    be used as button text.  It may be used as a lable otherwise
    //                    but generally not used
    // error_alarm      - generat a Javascript ALARM with this text on any
    //                    AJAX error.  If this field is blank, let the errors
    //                    through to the keeper
    //
    // Again, no formatting is done withing this code.  The look
    // and feel and placement/actions of any data returned by the AJAX
    // script is to be formatted by using the theme CSS constructs
    // on $div_name
    //
    // This is a general AJAX handler.  It is generally used for routines
    // NOT RELATED TO SPECIFIC FORMS or LINKS.
    //
    // In the file forms.php, as part of the object FORM, there are more
    // specific AJAX handlers that relate to specific dynamic forms being
    // built and operated.
    //
    // This object's method is usually called on a DOCUMENT event, a key
    // event or a mouse event and is generally tied to most if not all
    // of the current document.


        $ajax = '';


        $ajax =<<<EOT
            <div $div_name></div>

            <script>
                $('#wrapper).$event(function() {
                    .$type($script, function(data) {
                        $($div_name).empty().append(data)
                    ).fail(function() {
                        alert($error_alarm);
                    })
                });

            </script>

EOT;

        $this->document .= $ajax;
       
        $this->add_comment('End of Automagically created AJAX function and div');

    }


    //-------------------------------------
    public function add_comment($comment) {

    // this allows us to insert a comment into the HTML5
    // that is being generated.  This is useful for
    // providing run time documentation and for debugging
    // purposes.


        $this->document .= "\n\n <!--  \n $comment \n --> \n\n";

    }
    //---------------------
    public function run() {

        print($this->document);

    }

}

?>


