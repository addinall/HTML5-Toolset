<?php
// vim: set tabstop=4 shiftwidth=4 autoindent smartindent expandtab:
//---------------------------------------------------------
// CAPTAIN  SLOG
//---------------------------------------------------------
//
//  FILE:       parser.php    
//  SYSTEM:     New Tools 2013
//  AUTHOR:     Mark Addinall
//  DATE:       08/05/2013 
//  SYNOPSIS:   This is a tiny SQL parser that provides a front
//              end to a noSQL system. Firstly, Mongo
//              This will apply to other flavours of
//              noSQL.  As the syntax to generate queries
//              on a noSQL database is VERY different to
//              that of our other DBMS systems, I decided
//              to write a small SQL subset compiler/
//              interpreter that will parse SQL queries
//              into Mongo system calls via an iCode
//              stack.  This seems to be the best way
//              of allowing an application coder the
//              facility to use "Cloud" based (local or
//              otherwise) tools such as Mongo noSQL without
//              going to the trouble of learning the somewhat
//              tortured syntax.  After all, one of the
//              aims of a toolset/Framework is to provide
//              abstraction from the DBMS.  We do it between
//              RDBMS systems, so we just extend this
//              philosophy to cover noSQL.
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
// 08/05/2013 | Added an SQL Parser for Mongo |  MA
//------------+-------------------------------+------------


//----------
class Parser {


    //------------------------------------------
    function __construct(ErrorLogger $logger) {


    } // constructor


    function token() {


    }


} // class Parser 



?>

