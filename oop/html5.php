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
        $ajax = FALSE;                              // turn off AJaX by default
    
    }

    //----------------------------
    public function start_head() {

        $this_document .= "<head>\n\n";

    }

    //---------------------------------
    public function load_javascript() {

    }


    //------------------------
    public function fix_IE() {


    }


    //----------------------------
    public function load_theme() {


    }


    //----------------------------
    public function close_head() {


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

        $this->document .= "\n\n <!--  \n $comment \n --> \n\n";

    }

}

?>


