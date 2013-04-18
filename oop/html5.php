<?php
// vim: set expandtab tabstop=4 shiftwidth=4 autoindent smartindent:
//---------------------------------------------------------
// CAPTAIN  SLOG
//---------------------------------------------------------
//
//	FILE:       html5.php 
//	SYSTEM:     My new Websiite 
//	AUTHOR:     Mark Addinall
//	DATE:       22/03/2013
//	SYNOPSIS:   I put up a HTML website for myself in
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
class HTML5_document() {

private $document;          // basic HTML document
private $ajax;              // do we require AJaX?

    //-------------------------
    function HTML5_document() {

        $this->document = "<!DOCTYPE html5>\n\n";   // standard lead in
        $ajax = FALSE;                              // turn off AJaX by default
    }
}

?>


