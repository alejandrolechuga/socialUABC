<?php 
    //console(_::$global['user']['entry_box']);
    
    Controller::addBox("left"   ,"user_profile_name.tpl");
    Controller::addBox("left"   ,"user_profile_photo.tpl");
    Controller::addBox("left"   ,"user_profile_info.tpl");
    Controller::addBox("left"   ,"separator.tpl");
    //Controller::addBox("left" ,"user_profile_friend_options.tpl");
    if (_::$global['user']['friends']) {
        Controller::addBox("left"   ,"user_profile_friends.tpl");
    }
    
    $status = _::$global['user']['friends']['friendship_status'];
    if ( $status == 0 || $status == 1) {
        Controller::addBox("middle" ,"friends_friendship.tpl");
    } else {
        echo "Ya somos amigos wey!!!!";
    }  
    
   // Controller::addBox("middle" ,"user_profile_menu.tpl");
    //Controller::addBox("middle"   ,"separator.tpl");
    if (_::$global['user']['entry_box']) {
        Controller::addBox("middle" ,"user_profile_share_something.tpl");
        Controller::addBox("middle" ,"separator.tpl");
    }
    
    if (_::$global['user']['stream']) {
        Controller::addBox("middle" ,"user_profile_post.tpl");
    }
    
    Controller::addBox("right"  ,"user_profile_friend_options.tpl");
    Controller::addBox("right"  ,"user_profile_ads.tpl");
?>