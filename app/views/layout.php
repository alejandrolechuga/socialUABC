<?php
    global $JS_BOTTOM_ARRAY;
	//Sections
    switch ($_SESSION['CURRENT']['SECTION']){
        case "user":
        case "friends":
            $JS_BOTTOM_ARRAY[] = WEB_JS . DS . "user.js";
            $JS_BOTTOM_ARRAY[] = WEB_JS . DS . "friends.js";
        break;
    }
?>