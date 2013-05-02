<?php
// vim: set tabstop=4 shiftwidth=4 autoindent smartindent expandtab:
//---------------------------------------------------------
// CAPTAIN  SLOG
//---------------------------------------------------------
//
//  FILE:       widget.php    
//  SYSTEM:     New Tools 2013
//  AUTHOR:     Mark Addinall
//  DATE:       30/04/2013 
//  SYNOPSIS:   This file contains the object that will 
//              encapsulate some lightweight widgets.  
//             
//
//
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
// 30/04/2013 | Re-write v4 new object model  |  MA
//------------+-------------------------------+------------

//------------
class Widget {


// this object contains some lightweight commonly used widgets
// that are called from the framework.  Because the methods
// are so small, I decided to encapsulate the lot into one object
// rather than have several Widget classes.  This MAY change if
// my number of Widgets increases dramatically, or the same
// happens to the size/complexity.  I can't see this happening
// at the moment.

private $facebook_javascript;
private $facebook_html5;

    //-----------------------------
    public function __construct() {

        $this->facebook_javascript  = <<<EOT
            <div id="fb-root"></div>
            <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
            fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));</script>

EOT;


        $this->facebook_html5 = <<<EOT
            <div class="fb-like" data-href="http://www.addinall.net/ehealth" 
                data-send="false" data-layout="button_count" data-width="280" 
                data-show-faces="true" data-font="tahoma">
            </div>

EOT;

    }

    //-----------------------------------------
    public function add_widget($which_widget) {

        switch($which_widget) {
            case 'googleplus':

                break;

            case 'facebook':

                break;

            case 'pinterest':

                break;
        }
    }
}



?>

