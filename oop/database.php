<?php
// vim: set tabstop=4 shiftwidth=4 autoindent smartindent expandtab:
//---------------------------------------------------------
// CAPTAIN  SLOG
//---------------------------------------------------------
//
//  FILE:       database.php    
//  SYSTEM:     New Tools 2013
//  AUTHOR:     Mark Addinall
//  DATE:       16/04/2013 
//  SYNOPSIS:   This file contains the object that will 
//              encapsulate database methods and
//              properties.
//
//              This file has seen some major re-use over
//              the years.  Apart from the quicktools suite,
//              this file has been part of the Chameleon CMS
//              and several specific applications, ACCLOUD
//              accounting, What's Mine (Mining industry ERP
//              and assett management) and BetMe, a horce racing
//              statistical data gathering and reporting application
//              to name a few.
//
//              In the previous incarnation of quicktools this application
//              provides a number of different functions:
//
//              1. Machine health test (NOC) in various ways using SNMP and MIB traps.
//              2. An asset register controlling resource an locations
//              3. NOC ticket tracker
//              4. NOC and beyond network diagram browsing
//
//              This incarnation has made it into a set of Web 2.0 tools that
//              make up a FRAMEWORK for developing RESPONSIVE web pages over
//              a number of different devices.  This file/object has become more
//              generic and will support the Web 2.0 applications and will also
//              continue to support the CMS, Chameleon.
//
//              It has ALWAYS been the philosophy of this system that it be
//                  -   operating system agnostic, and,
//                  -   DBMS agnostic
//
//              That is, the code lying closer to the application layer and
//              IN the application layer NEVER changes regardless of OS or
//              type of DBMS.  Choosing is as simple as changing a line in the
//              one and only little configuration file.
//
//              However, this is a computer program, not magic.  If you want to run this
//              on a DB2 database, you need to build PHP and DB2 with the correct extentions,
//              ditto postgreSQL and ORACLE.  mySQL is built into the PHP distributions
//              as that has been the usual suspect over the history of WAMP-LAMP
//              development.
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
// 02/10/2005 | Initial creation Toolset V1.0 |  MA
// 29/04/2007 | Adept to Telstra NOC          |  MA
// 12/08/2009 | Complete re-write v2.x own use|  MA
// 18/02/2010 | Re-write CITEC (unfinished)   |  MA
// 12/02/2012 | Re-write v3.x new object model|  MA
// 16/04/2013 | Re-write v4 new object model  |  MA
// 02/05/2013 | Added support for Mongo noSQL |  MA
//------------+-------------------------------+------------

//-----------------
class ResultArray {             // little object looks kinda weird, it
                                // serving as a container for an array
                                // of SQL results.

private $table = array();       // table of SQL results
                        
    function __construct() {
        // nothing to do
    }

    public function push($value) {
        $table() = $value;
    }

}



//----------
class DBMS {

// This object opens, closes, manages, manipulates
// and reports on our database.  This is pointed
// only at mySQL at the moment.  
// This level of abstraction will allow us to use 
// ORACLE, DB2, mySQL and Postgress drivers easily
// by the application programmers.
//
// Going to add a noSQL database in a later version
// and also add support for MS-SQL.
//
// I had a couple of requests from people wanting
// to build 'cloudy' applications so I decided
// to implement support for Mongo noSQL in this
// version.  Might as well since it is a re-development
// pretty much from concepts.
//
// Investigating persistant LOCAL databases on
// mobile devices.  The implementation of this
// technology is a few minor versions in the future.
// Possibly December 2013.
//


private     $alive;
private     $result;
private     $log_config;

private     $user;              // these are all of the DB connect
private     $database;          // variables
private     $db_type;           // the needs of different databases
private     $password;          // change so on occasion some of
private     $stream;            // this will remain empty for the
private     $hostname;          // duration of the application
private     $mongo_fp;

    //------------------------------------------
    function __construct(ErrorLogger $logger) {

        $this->log_config = $logger;                            // get our own copy of the data logger.
                                                                // this is passed as a REFERENCE variable,
                                                                // and it contains the Configuration Object
                                                                //
                                                                // In this the latest re-write, the Configuration
                                                                // Object replaces the tried and tested array
                                                                // that has been flung around these systems
                                                                // for so many years!  In the v4.x, I have adopted
                                                                // a fully OOD/OOP paradigm.  The confuguration
                                                                // methods and properties are percolated up
                                                                // through several object APIs, each addressing
                                                                // application security at the appropriate level.
                                                                //
                                                                // At this stage, all of the  MUTATORS
                                                                // have been closed off with the exception of
                                                                // set_stream.
                                                                //
                                                                // The commonly used database variables will be moved
                                                                // into Private properties of this object so that
                                                                // subsequent DBMS access atoms will not require
                                                                // a call to a method in a related object.  Since
                                                                // after a successful CONNECT is established,
                                                                // 90% of the  properties are no
                                                                // longer of interest to the application.

        $this->user     = $this->log_config->get_user();        // make the copies into private static
        $this->database = $this->log_config->get_database();    // properties
        $this->db_type  = $this->log_config->get_dbtype();
        $this->password = $this->log_config->get_password();
        $this->hostname = $this->log_config->get_hostname();
        $this->stream   = 0;                                    // stream will come back from the DBMS
                                                                // if a connection is made, we hope!

        $this->connect() ;                                      // try to connect to the database
                                                                // this level of abstraction will allow for
                                                                // mySQL, ORACLE, PostgreSQL or DB2 databases
                                                                // without changing the application code

    } // constructor

    //------------------------
    private function connect() {
    
            // connect to the RDMS first 

            $this->alive = FALSE ;                              // start out dead
            //------------------------------------------------------------------------------------------
            if ($this->db_type == 'mySQL') {                    // cater for several types of database
                $this->stream =                                 // the stream used to be a socket
                new mysqli( $this->hostname,                    // since the re-write it is now an      
                            $this->user,                        // mysqli database object.  Perhaps on
                            $this->password,                    // the TO DO list is including mySQL
                            $this->database);                   // PDO sopprt.  Perhaps....
                if (!$this->stream) {
                    $this->log_config->error('Database not started : '
                        . $stream->connect_error, TRUE);        // fail? quit with the error
                }                                               // I like the msqli OOP implementation so
                                                                // we are using that API
            }                                                   // end of mySQL
            //------------------------------------------------------------------------------------------
            if ($this->db_type == 'Mongo') {                    // cater for trendy new database
                $this->mongo_fp =                               // looks a lot like old CISAM to me...
                    new mongo ( $this->hostname);               // wrapped up in an object.  I seem 
                if (!$this->mongo_fp) {
                    $this->log_config->error('Database not started : New mongo failed', TRUE);
                }                                              
                                                                // Mongo is a two part connect
                                                                // like the others USED to be.
                                                                // BAH!  Just as it all got simpler!
                $this->stream = $this->mongo_fp->{$this->database};
                if (!$this->stream) {
                    $this->log_config->error('Database not started : DBNAME failed', TRUE);
                }                                              

            }                                                   // end of  Mongo
            //------------------------------------------------------------------------------------------
            else if ($this->db_type == 'postgreSQL') {          // horrid old fashioned wreck of a database

                $this->stream = 
                    pg_connect("host=$this->hostname dbname=$this->database user=$this->user password=$this->password");
                if (!$this->stream) {
                    $this->log_config->error('Could not connect: ' . 
                                                    pg_last_error(), TRUE);
                }
            }                                                   // end of postgreSQL
            //-------------------------------------------------------------------------------------------
            else if ($this->db_type == 'ORACLE') {              // database for grown-ups ;-) 
            
                $this->stream =                         
                    oci_connect($this->user,            
                                $this->password,    
                                $this->hostname); 
                if (!$this->stream) {
                    $message = oci_error();
                    $this->log_config->error('Database not started :    '. 
                                                $message['message'], TRUE );
                }
            }                                                   // end of ORACLE
            //--------------------------------------------------------------------------------------------
            else if ($this->db_type == 'DB2') {                 // The IBM offering.  This is important
                                                                // as mainframes haven't gone away.
                                                                // IBM has Linux and DB2 running native
                                                                // in the zEnterprize models and implementing
                                                                // dozens to tens of thousands virtual
                                                                // hosts on the mainframe.
                                                                // Important to note for we coders.  A number
                                                                // of centuries ago, an organisation hired me
                                                                // as a Java Guru.  When I asked WHAT it was they
                                                                // wanted to do, the answer was "develop a web
                                                                // interface to the existing payroll.  They spent
                                                                // half a million bucks and 3/4 of a year trying
                                                                // to do it in Java, J2EE, Netbeans, Weblogic,
                                                                // etc., etc., and still couldn't get it.
                                                                // I asked them if I could show them a prototype
                                                                // in PHP (a language they hadn't really heard of).
                                                                // I stuck a Zend PHP server up into the iSeries
                                                                // and had prototype web pages chewing DB2 data
                                                                // in four days.  From scratch.  They were a little
                                                                // amazed to say the least.  So remember, the BIG
                                                                // COMPLEX asks, may be simpler than people expect.
                $this->stream =                     
                    db2_connect($this->database,                // DB2 used to be a little little weird, better now
                                $this->user,                    // user in catalog 
                                $this->password);               // password in plain 
                if (! $this->stream) {
                    $this->log_config->error('Database not started :    ' .
                                                db2_con_errormsg(), TRUE);  
                }
            }                                                   // end of DB2
            //----------------------------------------------------------------------------------------------

            $this->alive = TRUE;                                // if we got here one of the databases is UP!

        } // end of connect()  


    //--------------------------------------
    public function execute($sql) {
    // just execute SQL Statement
    // given the nature of web applications and the
    // data structure in content management systems
    // (well mine anyway) the SQL statements tend to be
    // simplistic in nature.  As a result, placeholders,
    // least cost maps etc. are dutifully ignored.
    //
    // When this model was first written in the dim dark
    // ages, the syntax for connections and executions
    // between the different DBMS engines was VERY VERY
    // different.  Swathes of different looking coding
    // to get the basics established.  Now in 2013, they
    // are all looking very similar (with the exceptions
    // of the noSQL crowd, they have taken us back to
    // the 1980s CISAM model).  So similar it is tempting
    // to write a function aliasing API.  But, we might look
    // at that in the future.  Right now, the code size
    // has dropped significantly, and the code is easy to
    // read.


        if ($this->db_type == 'mySQL') {                                // mySQL sorta works as one would
            $result = $this->stream->query($sql);                       // expect from a modern database.
            if (!$result) {                                             // it gets a STREAM from a CONNECT
                $this->log_config->error('Query failed: ' . $sql . ' ' .// function (now it is an object that
                        $mysqli->errno . "-" . $mysqli->error . ' ');   // encapsulates the STREAM, and queries
            }                                                           // to that handle or STREAM, therebye a
        }                                                               // script can open more than one database.
        //---------------------------------------------------------
        else if ($this->db_type == 'postgreSQL') {                      // postgreSQL is similar, although it
            $result = pg_query($sql);                                   // ignores the STREAM received from
            if (!$result) {                                             // CONNECT meaning that any one script
                $this->log_config->error('Query failed: ' . $sql .      // can only have one database open at
                                        ' : ' . pg_last_error(), TRUE); // one time.  Usually not a big deal
            }                                                           // for web sites.
        }
        //----------------------------------------------------------
        else if ($this->db_type == 'Mongo') {                           // Mongo LOOKS similar on the outside.
            $result = pg_query($sql);                                   // internals are VERY different
            if (!$result) {                                             // Mongo is flavour of the month so
                $this->log_config->error('Query failed: ' . $sql .      // we are here a little sooner than I
                                        ' : ' . pg_last_error(), TRUE); // expected.
            }                                                         
        }
        //----------------------------------------------------------
        else if ($this->db_type == 'ORACLE') {              
            $plan = oci_parse($this->stream, $sql);                     // OK, ORACLE is a little different            
            if (!$plan) {                                               // to mySQL and postgreSQL again. It has
                $error = oci_error($this->stream);                      // a two part execution process that
                $this->log_config->error('Query not PARSED: ' .         // produces iCode known in ORACLE
                                            $error['message'], TRUE);   // speak as a PLAN. What is does in the
            }                                                           // PHP environment is to set up the
            $result = oci_execute($plan);                               // statement for BIND variables.
            if (!$result) {                                             // It DOES NOT VALIDATE SQL!!  It
                $error = oci_error($plan);                              // SHOULD!  But this is an OLD OLD
                $this->log_config->error('Query not EXECUTED: ' .       // leftover from CIA Ada and the cost
                                            $error['message'], TRUE);   // of CPU cycles!
            }
        }
        //-------------------------------------------------------------
        else if ($this->db_type == 'DB2') {                             // DB2 operation is very similar to
            $result = db2_exec($this->stream, $sql,                     // that of mySQL.  It uses the CONNECT
                                    array('cursor' => DB2_SCROLLABLE)); // STREAM and multiple database can be
            if (!$result) {                                             // open at the same time.  For QUERY
                $this->log_config->error('Query failed: ' . $sql . ' ' .// statements, the DB2_SCROLLABLE is important,
                                            db2_stmt_errormsg(), TRUE); // otherwise the return set will be empty
            }                                                           // Trap for young player!  ;-)

        }
    } // execute 


    //-----------------------
    public function fetch() {
    // fetch the TOP row array from the returned SELECT
    // call.
    // this is normally called when only SELECTing one
    // element from the database ie: one particular 
    // UNIQUE row in a table.

        if ($this->db_type == 'mySQL') {

        }
        else if ($this->db_type == 'Mongo') {

        }
        else if ($this->db_type == 'postgreSQL') {

        }
        else if ($this->db_type == 'ORACLE') {

        }
        else if ($this->db_type == 'DB2') {

        }
    } //  fetch


    //---------------------------
    public function fetch_all() {
    // fetch the entire array from the returned SELECT call.
    // this is normally called when SELECTing a list of 
    // elements from the database and you want the results
    // back quick smart.
    //
    // 'SELECT account_number,name,postcode from CLIENT'
    //
    // $table_list = $database->fetch_all();

        $result = new ResultArray();                            // container to send upstairs

        if ($this->db_type == 'mySQL') {

        }
        else if ($this->db_type == 'postgreSQL') {

        }
        else if ($this->db_type == 'ORACLE') {

        }
        else if ($this->db_type == 'DB2') {

        }

        return $result;

    } //  fetch
    //--------------------------------------
    public function close() {

        if ($this->db_type == 'mySQL') {

        }
        else if ($this->db_type == 'Mongo') {

        }
        else if ($this->db_type == 'postgreSQL') {

        }
        else if ($this->db_type == 'ORACLE') {

        }
        else if ($this->db_type == 'DB2') {

        }

    } // close  

    
    //--------------------------    
    public function is_alive() {
    // NUMBER FIVE IS ALIVE!!!
    
        return $this->alive ;
    }

} // class Database 



?>

