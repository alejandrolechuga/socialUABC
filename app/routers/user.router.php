<?php 

	class userRouter extends Router{
		public $URLArray = array (
			"register_action"        => array(SECTION_KEY => "user", ACTION_KEY => "register") ,
			"email_confirm"          => array(SECTION_KEY => "user", ACTION_KEY => "emailConfirm"),
			"profile"                => array(SECTION_KEY => "user", ACTION_KEY => "profile"),
			"profile_edit"           => array(SECTION_KEY => "user", ACTION_KEY => "profile_edit"),
			"entry_box_action"       => array(SECTION_KEY => "user", ACTION_KEY => "addPost"),
			"remove_post_action"     => array(SECTION_KEY => "user", ACTION_KEY => "removePost"),
			"read_more_posts_action" => array(SECTION_KEY => "user", ACTION_KEY => "readMorePosts")
		);
        
		function index () {
			return array(
				"register_action"   => $this->getURL("register_action"),
				"login_action"      => $this->getURL("login_action"),
				"logout_action"     => $this->getURL("logout_action"),
                "activity"          => $this->getURL("activity"),
                "newUsers"          => $this->getURL("newUsers") 			
			);	
		}
        
        function profile () {
            return array(
                "logout_action"             => $this->getURL("logout_action"),
                "remove_post_action"        => $this->getURL("remove_post_action"),
                "read_more_posts_action"    => $this->getURL("read_more_posts_action"),
                "edit_info"         => $this->getURL("edit", array(
                    "sub" => "edit_info"
                )),
                "activity"          => $this->getURL("activity"),
                "newUsers"          => $this->getURL("newUsers")
            );
        }
        
        function friendProfile () {
            
        }
        
        function edit () {
            return array (
                "edit_profile_pic"  => $this->getURL("edit", array(
                    "sub" => "edit_profile_pic"
                )),
                "edit_info"         => $this->getURL("edit", array(
                    "sub" => "edit_info"
                )),
                "edit_networks"     => $this->getURL("edit", array(
                    "sub" => "edit_networks"
                )),
                "edit_friends"      => $this->getURL("edit", array(
                    "sub" => "edit_friends"
                )),
                "activity"          => $this->getURL("activity"),
                "newUsers"          => $this->getURL("newUsers")
            );
        }
	}
?>