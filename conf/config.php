<?php
// vim: set expandtab tabstop=4 shiftwidth=4 autoindent smartindent:
//---------------------------------------------------------
// CAPTAIN  SLOG
//---------------------------------------------------------
//
//  FILE:       config.php 
//  SYSTEM:     New Tools
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
//              This is one of the oldest files in my systems.
//              First made a debut in 1996 as a Perl file.
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
//------------+-------------------------------+------------
//
//

//------------
class Config {

// this started out in life as an array,
// VERY briefly, an XML document for a
// specific customer, then morphed into
// a JSON collation, which didn't really
// offer much over the origional array.
// So in line with the rest of the PURE
// OOD 2013 re-write, it is now a classic
// object.  All of the new objects in this 
// have accessors and mutators to re-write
// process properties.  I got a bit slack
// over the last few decades and relaxed this
// a little too much.
//
// If the security visibility looks a little 
// odd, this is the very first object that is
// created in the system.  The object method
// I use in this version is one of object
// chaining by REFERENCE rather than
// polymorphism by inheritance. That is, in
// these SYSTEM level of object where ONLY ONE
// instance is EVER going to be allowed
// during the course of the application run.
//
// So, the next object to be created after this
// will be the error logger which will accept this object
// by REFERENCE into its constuctor.  So, sort of
// inheritance.
//
//  class Test {
//
//  public $configuration;
//
//    function __construct(Config $config) {
//        $this->configuration = $config;
//        $this->configuration->set_user('Marky');
//        echo $this->configuration->get_user();
//    }
//  }
//
//
//
// Common database elements follow a polymorphism
// paradigm as usual.

private $user;              // who am I?
private $password;          // database password for the CMS
private $database;          // database name, qualified
private $hostname;          // hostname, qualified
private $db_type;           // mySQL, ORACLE, DB2, PostgreSQL so far (added Mongo)
private $stream;            // this is a socket() pointer returned by the DBMS
private $root_dir;          // execution root directory
private $theme;             // CSS3 Skin to use.  This can change on the fly
private $error_log;         // where to stick the error logs
private $log_level;         // level of verbosity
private $os_type;           // which operating system for some low level functions

    //-----------------------------------------------------------------------------------------------
    function __construct($usr, $pass, $db, $host, $dbtype, $strm, $rdir, $css, $errl, $errlev, $os) {

        $this->set_user($usr);
        $this->set_password($pass);
        $this->set_database($db);
        $this->set_hostname($host);
        $this->set_dbtype($dbtype);
        $this->set_stream($strm);
        $this->set_rootdir($rdir);
        $this->set_theme($css);
        $this->set_errlog($errl);
        $this->set_errlevel($errlev);
        $this->set_os($os);
    }



    //----------------------------------
    public function set_user($usr) {

        $this->user = $usr;
    }

    //-----------------------------
    public function get_user() {

        return $this->user; 
    }

    //--------------------------------------
    public function set_password($pass) {

        $this->password = $pass;
    }

    //---------------------------------
    public function get_password() {

        return $this->password; 
    }


    //------------------------------------
    public function set_database($db) {

        $this->database = $db;
    }

    //---------------------------------
    public function get_database() {

        return $this->database; 
    }

    //------------------------------------
    public function set_hostname($host) {

        $this->hostname = $host;
    }

    //---------------------------------
    public function get_hostname() {

        return $this->hostname; 
    }


    //------------------------------------
    public function set_dbtype($type) {

        $this->db_type = $type;
    }

    //-------------------------------
    public function get_dbtype() {

        return $this->db_type; 
    }


    //------------------------------------
    public function set_stream($strm) {

        $this->stream = $strm;
    }

    //-------------------------------
    public function get_stream() {

        return $this->stream; 
    }

    //------------------------------------
    public function set_rootdir($dir) {

        $this->root_dir = $dir;
    }

    //--------------------------------
    public function get_rootdir() {

        return $this->root_dir; 
    }

    //----------------------------------
    public function set_theme($css) {

        $this->theme = $css;
    }

    //------------------------------
    public function get_theme() {

        return $this->theme; 
    }


    //-----------------------------------
    public function set_errlog($log) {

        $this->error_log = $log;
    }

    //-------------------------------
    public function get_errlog() {

        return $this->error_log; 
    }


    //-------------------------------------
    public function set_errlevel($err) {

        $this->log_level = $err;
    }

    //---------------------------------
    public function get_errlevel() {

        return $this->log_level; 
    }

    //-------------------------------------
    public function set_os($os) {

        $this->os_type = $os;
    }

    //---------------------------------
    public function get_os() {

        return $this->os_type; 
    }

} // end of Config Object

//---------------------------------------
//
// fill in the values that reflect
// your site.  This information in
// PLAIN looks a little old fashioned,
// but storing all of this stuff in a database
// makes for difficult recovery, and it adds
// a deal of overhead to an otherwise lightweight
// process.  So the stuff lives in here.
// this file MUST be CHMOD 640, the security
// manager built into the application will
// bitch and stop otherwise.
//
// DON'T leave any of these out, or get the order wrong!
// It'll fall in a heap!  I thought about putting this stuff
// back into an associative array INSIDE the object, but
// hey, you can do JUST a LEETLE work!
// so make a copy of this first, comment it out, then
// add your stuff.
//
// The two entries that ask for directories:
// 1.  If you are on a windoze box LEAVE THE SLASHES ALONE!
// 2.  They are not allowed to contain the strings:
// 2.1 http
// 2.2 https
// 2.3 ftp
// 2.4 stdio
// 2.5 stderr
// 2.6 stdin
// 2.7 <
// 2.8 >
// 2.9 |
// 2.a &
//
// The system will spit and STOP.

$configuration = New Config('addinall',                 // database username
                            'S0laris7.1',               // database password for the CMS
                            'chameleon',                // database name, qualified
                            'localhost',                // local host does it for 90% of installs
                            'mySQL',                    // mySQL, ORACLE, DB2, PostgreSQL so far (added Mongo)
                            '',                         // this is a socket() pointer returned by the DBMS
                            'Light',                    // CSS3 Skin to use.  This can change on the fly
                            '/var/www/html/newsite/',   // execution root directory, TRAILING SLASH IMPORTANT!
                            'tmp/logs/',                // where to stick the error logs. NB trailing slash
                            'DEBUG',                    // level of verbosity, DEBUG, WORDY, SPARSE, SILENT
                            'deadrat');                 // operating system, deadrat, debian, windoze, bsd, solaris, zos

?>


