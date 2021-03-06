<?php
// vim: set tabstop=4 shiftwidth=4 autoindent smartindent expandtab:
//---------------------------------------------------------
// CAPTAIN  SLOG
//---------------------------------------------------------
//
//  FILE:       cms_light.php    
//  SYSTEM:     New Tools 2013
//  AUTHOR:     Mark Addinall
//  DATE:       17/04/2013 
//  SYNOPSIS:   This file contains the object that will 
//              encapsulate CMS methods and
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
//
//              So, although this file is now a part of Tools v4.x,
//              it also represents Chameleon CMS v 5.0
//
//              This was split into
//
//              1. cms_base.php
//              2. cms_light.php
//              3. cms.php
//
//              For the following reasons.
//
//              1.  The applications that just consist of a web page that either
//                  is going to be static, or merely READ from a CMS data store
//                  do not require the complexity of the full model.  So to save
//                  page load time, especially for smaller mobile devices, I split
//                  the CMS functions into 3 parts.
//
//              2.  It made good computentional sense to define the METHODS used
//                  by this OBJECT into READ ONLY, READ WRITE, and  READ, WRITE
//                  BUILD.  Usually only Chameleon and business applications
//                  require the full set of CMS METHODS.
//
//              3.  The OOD/OOP paradigm has not been lost.  We use polymorphism in
//                  the shape of inheritance cms_light EXTENDS cms_base and CMS
//                  EXTENDS cms_light.  The object cms_light is used for applications
//                  that have a LIMITED capacity to WRITE to a data store.  This is
//                  usually in the guise of a CONTACT FORM or a BLOG store.  The full
//                  CMS object contains all of the CMS build and maintain METHODS
//                  used by the CMS Chameleon, of full blown web applications such
//                  as the ACCLOUD Accounting system.
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
// 02/10/2005 | Initial creation Toolset V1.0 |  MA
// 29/04/2007 | Adept to Telstra NOC          |  MA
// 12/08/2009 | Complete re-write v2.x own use|  MA
// 18/02/2010 | Re-write CITEC (unfinished)   |  MA
// 12/02/2012 | Re-write v3.x new object model|  MA
// 17/04/2013 | Re-write v4 new object model  |  MA
// 14/05/2013 | Split into three objects      |  MA
//------------+-------------------------------+------------



require_once('cms_base.php');           // the primitive objects
                                        // that go to build these CMS
                                        // classes.

//----------
class CMS_light extends CMS_base  {
    // 2011 - This object has been used in several versions of
    // chameleon.  Now being used in eHealth.  I left the
    // above commenents in for MY historical purpose.
    //
    // The database strategy now is half traditional (on application
    // start, loading major stacks of objects) and AJAXy database
    // updates which obviously do not require a document re-fetch.
    //
    // Mid 2011, this is now being used in Family Law Settlement
    // centres web application.  Modified of course.
    //
    // April 2013  v4.0 Tools, v5.0 of Chameleon
    // Complete re-write this time to extend the toolset
    // and the CMS to cater for RESPONSIVE Web applications.
    // That is, to cater for HTML5, CSS3 and various differing
    // devices such as iPods, Android Smartphones, Fondleslabs
    // etc.  As when these tools were first written, such beasts
    // did not exist, this version got a MAJOR re-write!


    //---------------
    function __construct(DBMS $db) {

    // this object can be created in two different ways.
    // To create and define a brand new object to go into the
    // database, or be created to retrieve an existing object
    // from the database.  As such, the constructor has nothing
    // to do once the memory is allocated.  In the latter
    // case, objects can be PUSHED onto a stack.  And generally are.

    
    }

    //---------------------------------
    public function add_content()
    {
    // add new web content into the database
    // the row nu (id) is auto generated
    // the short_name MUST be unique or the SQL
    // function wil fail.
    // short_name is one of the primary keys into ALL
    // of our tables.


        $sql = "INSERT INTO content ( short_name, active, name, description, tags, created ) ". 
                                    "VALUES( '$this->short_name', ".
                                            "'$this->active', ".
                                            "'$this->name', ".
                                            "'$this->description', ".
                                            "'$this->tags', ".
                                            "'$this->created' )";

        if ($db->is_alive())        // no use trying to add to a database
        {                           // that is not turned on!
            $db->execute($sql) ;    // doit.., execute has it's own error routines
        }
    } // add_content


    //----------------------------------------  
    public function get_content( $short_name, $db ) {
    // fetch ONE content entry from the database
    // and return it to calling entity

        $sql = "SELECT * FROM content WHERE short_name = '$short_name'";

        if ($db->is_alive())                    // no sense querying a dead database
        {
            $db->execute($sql) ;                // do it through the DB object
        }
    
        $this->populate( $db->fetch() ) ;       // fetch returns a ROWTYPE object.
                                                // we now populate THIS object
                                                // with the column values from the row returned
    }
}

?>

