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
//
//------------+-------------------------------+------------
// DATE       |    CHANGE                     |    WHO
//------------+-------------------------------+------------
// 22/03/2013 | Initial creation              |  MA
//------------+-------------------------------+------------
//
//

//----------------------
class HTML5_document {

private $document;          // basic HTML document
private $ajax;              // do we require AJaX?
private $content;           // a private copy of the content manager
                            // passed IN as REFERENCE

    //-----------------------------------------
    public function __construct(CMS $content) {

        $this->content = $content;                  // make a private copy to use
        $this->document = "<!DOCTYPE html5>\n\n";   // standard lead in
        $this->ajax = FALSE;                        // turn off AJaX by default
    
    }

    //----------------------------
    public function start_head() {

        $this_document .= "<head>\n\n";
        $this->document .= "<meta charset='utf-8'> \n\n";

        // disable iPhone inital scale

        $this->document .= "<meta name='viewport' content='width=device-width; initial-scale=1.0'> \n\n";

        $this->document .= "<title>Toolset v4.0 - HTML5/CSS3/jQuery - Mark Addinall</title> \n\n";


    }

    //---------------------------------
    public function load_javascript() {

        // jQuery 1.9 is significantly different to earlier versions
        // this may take some testing

        $this->document .= "<script src='js/jquery-1.9.1.min.js'></script> \n\n";
       
        // now for our brand new mini hero slider

        $this->document .= "<script src='js/hero.js'></script> \n\n";

    }


    //------------------------
    public function fix_IE() {

        // IE8 doesn't like HTML5.  It is tempting to ignore the thing, but there are FAR to many
        // copies of IE8 still running out in the world. This Javascript makes it behave.


        $this->document .= "<!--[if lt IE 9]> \n <script src='http://html5shim.googlecode.com/svn/trunk/html5.js'></script>\n <![endif]-->\n\n";

        // IE8 ALSO doesn't like the CSS media queries that are used to drive the
        // RESPONSIVE bits of the Framework/Toolset.  This next bit of Javascript
        // adds that functionality to IE8.

        $this->document .= "<script src='http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js'></script> \n\n";


    }


    //----------------------------
    public function load_theme() {


        // main css theme
        
        $this->document .= "<link href='themes/' . $this->content->get_theme() . '/style.css' rel='stylesheet' type='text/css'> \n";

        // media queries css

        $this->document .= "<link href='themes/' . $this->content->get_theme() . '/media-queries.css' rel='stylesheet' type='text/css'> \n\n";

        // css theme for the hero slider
        
        $this->document .= "<link href='themes/' . $this->content->get_theme() . '/hero.css' rel='stylesheet' type='text/css'> \n\n";

    }


    //----------------------------
    public function close_head() {

        $this->document .= "</head> \n\n";

    }


    //----------------------------
    public function start_body() {


    }


    //-------------------------------
    public function start_wrapper() {


    }


    //----------------------------   
    public function add_header() {


    }


    //--------------------------
    public function add_logo() {


    }


    //----------------------------
    public function close_logo() {


    }

    //---------------------------
    public function add_heros() {


    }


    //-----------------------------
    public function close_heros() {


    }


    //-------------------------------
    public function close_headers() {


    }


    //------------------------------------
    public function cms($page, $section) {

        $this->document .= $this->content->get_content($page, $section);
        $this->document .= "\n\n";
    }


    //--------------------------------------------------
    public function implement_ajax($function_callback) {


    }


    //-------------------------------------
    public function add_comment($comment) {

     Google that    $this->document .= "\n\n <!--  \n $comment \n --> \n\n";

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



}

?>


