<?php
        
   // Controller::addBox("left"   ,"separator.tpl");
    Controller::addBox("left"   ,"user_edit_menu.tpl");
    
    $sub = $_GET['sub'];
    switch ($sub) {
        case "edit_profile_pic":
            Controller::addBox("middle" ,"user_edit_photo.tpl");
           break;
        case "edit_info":
            Controller::addBox("middle" ,"user_edit_info.tpl");
           break;
        case "edit_networks":
            Controller::addBox("middle" ,"user_edit_networks.tpl");
           break;
        case "edit_friends":
            Controller::addBox("middle" ,"user_edit_friends.tpl");
           break; 
    }
  
?>