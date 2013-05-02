// vim: set expandtab tabstop=4 shiftwidth=4 autoindent smartindent:
//---------------------------------------------------------
// CAPTAIN  SLOG
//---------------------------------------------------------
//
//  FILE:       forms.js
//  SYSTEM:     My new Websiite 
//  AUTHOR:     Mark Addinall
//  DATE:       03/05/2013
//  SYNOPSIS:   Since we are writing this for a cross platform
//              RESPONSIVE distribution, the forms manager
//              makes use of HTML5 localStorage and sessionStorage
//              to enable persistant data stores on mobile
//              devices. 
//              
//              Local storage
//              --------------
//              -   Long term data persistence
//              -   The local storage object spans multiple windows and 
//                  persists beyond the current session
//              -   Values put into localStorage are shared across all 
//                  windows from the same origin
//              -   Data is stored on the client. Behaving similarly to 
//                  cookies, values persist beyond when the browser’s session ends
//
//              Session storage
//              ---------------
//              -   Short term data persistence
//              -   Once the browser’s session ends (window/tab closed), 
//                  sessionStorage ends
//              -   Values put into sessionStorage are only visible in the 
//                  window/tab that created them
//              -   Data is stored on the server
//
//              Both objects are properties of the browser's window object, 
//              and you can access them by using jQuery.
//
//              These forms are tricky.  They are VERY dynamic
//              and each form field is goverened by conditional
//              logic.  There is also the ability to transfer
//              data values between forms, allowing 'autobuild'
//              lists and the like.
//
//------------+-------------------------------+------------
// DATE       |    CHANGE                     |    WHO
//------------+-------------------------------+------------
// 03/05/2013 | Initial creation              |  MA
//------------+-------------------------------+------------
//
//

function getStorage() {

    var storage;

    if (!window["Storage"]) {
        return;
    } else {
        storage = window["localStorage"];
        $(storage).each(function(a){

        var id = storage.key(a);

        if ($("#" + id).length > 0) {
            $("#" + id).val(storage.getItem(id));
        }
       });
    }
}


$(function () {

    $(document).ready(function () {
        $("input,textarea,select").live("keyup change", function () {
        if ($(this).attr("id").length > 0) {
            localStorage.setItem($(this).attr("id"), $(this).val());
        }
    });

    $("form").live("submit", function() {
        localStorage.clear();
    });
    getStorage();
    });
});

